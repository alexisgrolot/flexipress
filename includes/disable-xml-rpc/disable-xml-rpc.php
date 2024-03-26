<?php
function flexipress_security_disablexmlrpc() {
    add_filter( 'xmlrpc_enabled', '__return_false' );
}

/**
 * Re-enable XML-RPC disabled.
 */
function flexipress_security_disablexmlrpc_deactivate() {
    remove_filter('xmlrpc_enabled', '__return_false');
}
