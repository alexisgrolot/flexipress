<?php
function flexipress_security_disablewordpressrestapi() {
    add_filter(
	    'rest_authentication_errors',
	    function ( $access ) {
		    return new WP_Error(
			    'rest_disabled',
			    __( 'The WordPress REST API has been disabled.' , 'flexipress' ),
			    array(
				    'status' => rest_authorization_required_code(),
			    )
		    );
	    }
    );
}

/**
 * Re-enable the deactivated WordPress REST API.
 */
function flexipress_security_disablewordpressrestapi_deactivate() {
    remove_filter('rest_authentication_errors', 'flexipress_security_disablewordpressrestapi');
}
