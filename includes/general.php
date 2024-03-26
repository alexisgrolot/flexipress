<?php
// File: includes/general.php

// Include general features
require_once(plugin_dir_path(__FILE__) . 'disable-automatic-updates-emails/disable-automatic-updates-emails.php');
require_once(plugin_dir_path(__FILE__) . 'disable-automatic-updates/disable-automatic-updates.php');
require_once(plugin_dir_path(__FILE__) . 'disable-attachment-pages/disable-attachment-pages.php');
require_once(plugin_dir_path(__FILE__) . 'completely-disable-comments/completely-disable-comments.php');

// Checks if features are enabled
if (get_option('general_enabled_disableautomaticupdatesemails', false)) {
    // Calls up the function to display the feature
    flexipress_general_disableautomaticupdatesemails();
} else {
    // Disables feature if not activated
    flexipress_general_disableautomaticupdatesemails_deactivate();
}
if (get_option('general_enabled_disableautomaticupdates', false)) {
    // Calls up the function to display the feature
    flexipress_general_disableautomaticupdates();
} else {
    // Disables feature if not activated
    flexipress_general_disableautomaticupdates_deactivate();
}
if (get_option('general_enabled_disableattachmentpages', false)) {
    // Calls up the function to display the feature
    flexipress_general_disableattachmentpages();
} else {
    // Disables feature if not activated
    flexipress_general_disableattachmentpages_deactivate();
}
if (get_option('general_enabled_completelydisablecomments', false)) {
    // Calls up the function to display the feature
    flexipress_general_completelydisablecomments();
} else {
    // Disables feature if not activated
    flexipress_general_completelydisablecomments_deactivate();
}