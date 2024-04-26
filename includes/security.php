<?php
// File: includes/security.php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include specific security features
require_once(plugin_dir_path(__FILE__) . 'disable-xml-rpc/disable-xml-rpc.php');
require_once(plugin_dir_path(__FILE__) . 'disable-wordpress-rest-api/disable-wordpress-rest-api.php');

// Checks if features are enabled
if (get_option('flexipress_security_enabled_disablexmlrpc', false)) {
    // Calls up the function to display the feature
    flexipress_security_disablexmlrpc();
} else {
    // Disables feature if not activated
    flexipress_security_disablexmlrpc_deactivate();
}
if (get_option('flexipress_security_enabled_disablewordpressrestapi', false)) {
    // Calls up the function to display the feature
    flexipress_security_disablewordpressrestapi();
} else {
    // Disables feature if not activated
    flexipress_security_disablewordpressrestapi_deactivate();
}