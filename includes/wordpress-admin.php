<?php
// File: includes/wordpress-admin.php

// Include specific wordpress-admin features
require_once(plugin_dir_path(__FILE__) . 'remove-wordpress-version-number/remove-wordpress-version-number.php');
require_once(plugin_dir_path(__FILE__) . 'disable-gutenberg-editor/disable-gutenberg-editor.php');
require_once(plugin_dir_path(__FILE__) . 'disable-the-wp-admin-bar/disable-the-wp-admin-bar.php');

// Checks if features are enabled
if (get_option('flexipress_wordpress-admin_enabled_removewordpressversionnumber', false)) {
    // Calls up the function to display the feature
    flexipress_wordpressadmin_removewordpressversionnumber();
} else {
    // Disables feature if not activated
    flexipress_wordpressadmin_removewordpressversionnumber_deactivate();
}
if (get_option('flexipress_wordpress-admin_enabled_disablegutenbergeditor', false)) {
    // Calls up the function to display the feature
    flexipress_wordpressadmin_disablegutenbergeditor();
} else {
    // Disables feature if not activated
    flexipress_wordpressadmin_disablegutenbergeditor_deactivate();
}
if (get_option('flexipress_wordpress-admin_enabled_disablethewpadminbar', false)) {
    // Calls up the function to display the feature
    flexipress_wordpressadmin_disablethewpadminbar();
} else {
    // Disables feature if not activated
    flexipress_wordpressadmin_disablethewpadminbar_deactivate();
}