<?php
/* Disable WordPress Admin Bar for all users */
function flexipress_wordpressadmin_disablethewpadminbar() {
    add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * Reactivate the disabled WordPress admin bar for all users.
 */
function flexipress_wordpressadmin_disablethewpadminbar_deactivate() {
    remove_filter('show_admin_bar', '__return_false');
}
