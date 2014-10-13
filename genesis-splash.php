<?php

/*
 * Plugin Name: Genesis Splash
 * Plugin URI: http://wordpress.org/extend/plugins/genesis-splash
 * Description: Enables Captivate submissions within WordPress.
 * Version: 1.0.0
 * Author: Ernie Falconer & Travis Smith
 * Author URI: http://www.wpsmith.net/
 * Text Domain: genesis-splash
 * Domain Path: languages
 * License: GPLv2

    Copyright 2014    Ernie Falconer    (email : http://disrupt2create.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA    02110-1301    USA
*/

/**
 * Splash Functions
 *
 * @package     Splash
 * @author      Ernie Falconer <disrupt2create@gmail.com>
 * @copyright   Copyright (c) 2014, Ernie Falconer
 * @license     http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link        https://wordpress.org/extend/plugins/genesis-splash/
 * @todo
 *      Verify that Genesis is installed on activation
 *      Add background splash color with transparency
 *      Add background image stretch option
 *      Add translation/localization call
 *      Add languages folder
 *      Add auto-dismiss option & JS timer
 */ 

define( 'GSPLASH_VERSION', '1.0.0' );

// Add admin page if we are in the admin
add_action( 'genesis_admin_menu', 'gsplash_add_child_theme_settings' );
/**
 * Instantiate the Settings Page
 *
 * @since 1.0.0
 */
function gsplash_add_child_theme_settings() {
    
    if ( !is_admin() ) {
        return;
    }
    
    require_once( 'lib/splash-settings.php' );

    global $_gsplash_settings;
    
    // Instantiate class, automatically executes the stuff in the __construct() method.
    $_gsplash_settings = new GSplash_Settings;      
}

add_action( 'genesis_before', 'gsplash_do_splash', 1 );
/**
 * Do splash content
 */
function gsplash_do_splash() {
    printf( '<div class="genesis-splash">BOB: %s</div>', genesis_get_option( 'splash_content', 'gsplash-settings' ) );
}

add_action( 'init', 'gsplash_register_scripts' );
/**
 * Register script for the splash page on frontend.
 */
function gsplash_register_scripts() {
    if ( is_admin() ) {
        return;
    }
    // Determine suffix based on whether site is in debug mode or not
    $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || defined( 'WP_DEBUG' ) && WP_DEBUG ? '.js' : '.min.js';
    wp_register_script( 'genesis-splash', plugins_url( 'js/genesis-splash' . $suffix, __FILE__ ), array( 'jquery', ), GSPLASH_VERSION, false );
}

add_action( 'wp_enqueue_scripts', 'gsplash_enqueue_scripts' );
/**
 * Enqueue script for the splash page.
 * Since this will appear on every page, just enqueue.
 */
function gsplash_enqueue_scripts() {
    wp_enqueue_script( 'genesis-splash' );
    $handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';
    wp_add_inline_style( $handle, '.genesis-splash-hidden .site-container{display:none;}' );
}

add_action( 'body_class', 'gsplash_body_class' );
/**
 * Hide the body ASAP.
 * 
 * @param $classes array Array of body classes.
 * @return $classes array Modified array of body classes.
 */
function gsplash_body_class( $classes ) {
    $classes[] = 'genesis-splash-hidden';
    return $classes;
}
