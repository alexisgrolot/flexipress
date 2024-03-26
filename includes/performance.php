<?php
// File: includes/performance.php

// Include specific performance features
require_once(plugin_dir_path(__FILE__) . 'allow-svg-files-upload/allow-svg-files-upload.php');

// Checks if features are enabled
if (get_option('performance_enabled_allowsvgfilesupload', false)) {
    // Calls up the function to display the feature
    flexipress_performance_allowsvgfilesupload();
} else {
    // Disables feature if not activated
    flexipress_performance_allowsvgfilesupload_deactivate();
}