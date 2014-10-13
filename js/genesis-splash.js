/*jslint browser: true, devel: true */
 
jQuery(document).ready(function ($) {
    "use strict";
    
    // Hide body
    $('.genesis-splash-hidden').hide();
    
    // Add dismiss
    $('.genesis-splash').prepend('<div class="genesis-splash-dismiss">&#215;</div>');
 
    // Add click listener
    $('.genesis-splash').on('click', function () {
        
        // Hide the splash page
        $('.genesis-splash').fade('slow');
 
        // Show the body
        $('body').show('slow');
    });
});
