<?php
// Disable auto-update emails.
function flexipress_general_disableautomaticupdatesemails() {
    add_filter( 'auto_core_update_send_email', '__return_false' );

    // Disable auto-update emails for plugins.
    add_filter( 'auto_plugin_update_send_email', '__return_false' );

    // Disable auto-update emails for themes.
    add_filter( 'auto_theme_update_send_email', '__return_false' );
}

/**
 * Reactivate deactivated automatic update emails.
 */
function flexipress_general_disableautomaticupdatesemails_deactivate() {
    remove_filter('auto_core_update_send_email', '__return_false');
    remove_filter('auto_plugin_update_send_email', '__return_false');
    remove_filter('auto_theme_update_send_email', '__return_false');
}
