<?php
/**
 * Splash Settings
 * Requires Genesis 1.8 or later
 *
 * This file registers all of this child theme's specific Theme Settings, accessible from
 * Genesis > Child Theme Settings.
 *
 * @package     Splash
 * @author      Ernie Falconer <disrupt2create@gmail.com>
 * @copyright   Copyright (c) 2014, Ernie Falconer
 * @license     http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link        https://wordpress.org/extend/plugins/genesis-splash/
 */

/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @package Splash
 * @subpackage Admin
 *
 * @since 1.0.0
 */
class GSplash_Settings extends Genesis_Admin_Boxes {

    /**
     * Create an admin menu item and settings page.
     *
     * @since 1.0.0
     */
    function __construct() {

        // Specify a unique page ID. Customize page ID.
        $page_id = 'genesis-splash';

        // Set it as a child to genesis, and define the menu and page titles
        $menu_ops = array(
            'submenu' => array(
                'parent_slug' => 'genesis',
                'page_title'  => __( 'Genesis Splash Settings', 'genesis-splash' ),
                'menu_title'  => __( 'Splash Page', 'genesis-splash' ),
            )
        );

        // Give it a unique settings field.
        // You'll access them from genesis_get_option( 'option_name', 'gsplash-settings' );
        $settings_field = 'gsplash-settings';

        // Set the default values
        $default_settings = array(
            'splash_content' => '',
        );

        // Create the Admin Page
        $this->create( $page_id, $menu_ops, array(), $settings_field, $default_settings );

        // Initialize the Sanitization Filter
        add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

    }

    /**
     * Set up Sanitization Filters
     *
     * Filters available: safe_html, abs_int, one_zero, no_html, url, email_address
     *
     * @since 1.0.0
     */
    function sanitization_filters() {

        genesis_add_option_filter( 'requires_unfiltered_html', $this->settings_field,
            array(
                'splash_content',
            ) );
        
    }

    /**
     * Register metaboxes on Settings page
     *
     * @since 1.0.0
     *
     * @see GSplash_Settings::splash_mb() Callback for the splash content
     */
    function metaboxes() {

        add_meta_box( 'splash-content', __( 'Splash Page', 'genesis-splash' ), array( $this, 'splash_mb' ), $this->pagehook, 'main', 'high' );

    }

    /**
     * Callback for Splash Content metabox
     *
     * @since 1.0.0
     *
     * @see GSplash_Settings::metaboxes()
     */
    function splash_mb() {
        wp_editor( $this->get_field_value( 'splash_content' ), $this->get_field_name( 'splash_content' ) );

    }
}
