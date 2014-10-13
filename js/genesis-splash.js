/*jslint browser: true, devel: true */

// Hide body ASAP
jQuery('.genesis-splash-hidden .site-container').hide();

jQuery(document).ready(function ($) {
    "use strict";

    // Hide body
    $('.genesis-splash-hidden .site-container').hide();

    // Set height/width of splash
    $('.genesis-splash').height($(document).height()).width($(document).width()).css({background: 'rgba(255,255,255,0.5)', position: 'absolute'});

    // Add dismiss
    $('.genesis-splash').prepend('<div class="genesis-splash-dismiss">&#215;</div>');
    $('.genesis-splash-dismiss').css({position: 'absolute', top: '10px', right: '10px'});

    // Add click listener
    $('.genesis-splash').on('click', function () {

        // Hide the splash page
        $('.genesis-splash').fade('slow');

        // Show the body
        $('body').show('slow');
    });
});
