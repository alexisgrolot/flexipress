<?php
// Disable core auto-updates
function flexipress_general_disableautomaticupdates() {
    add_filter( 'auto_update_core', '__return_false' );
    // Disable auto-updates for plugins.
    add_filter( 'auto_update_plugin', '__return_false' );
    // Disable auto-updates for themes.
    add_filter( 'auto_update_theme', '__return_false' );
}

/**
 * Re-enable disabled automatic updates.
 */
function flexipress_general_disableautomaticupdates_deactivate() {
    remove_filter('auto_update_core', '__return_false');
    remove_filter('auto_update_plugin', '__return_false');
    remove_filter('auto_update_theme', '__return_false');
}
