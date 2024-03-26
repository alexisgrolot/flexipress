<?php
function flexipress_general_disableattachmentpages() {
    add_action(
	    'template_redirect',
	    function () {
		    global $post;
		    if ( ! is_attachment() || ! isset( $post->post_parent ) || ! is_numeric( $post->post_parent ) ) {
			    return;
		    }

		    // Does the attachment have a parent post?
		    // If the post is trashed, fallback to redirect to homepage.
		    if ( 0 !== $post->post_parent && 'trash' !== get_post_status( $post->post_parent ) ) {
			    // Redirect to the attachment parent.
			    wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
		    } else {
			    // For attachment without a parent redirect to homepage.
			    wp_safe_redirect( get_bloginfo( 'wpurl' ), 302 );
		    }
		    exit;
	    },
	    1
    );
}

/**
 * Reactivate disabled attachment pages.
 */
function flexipress_general_disableattachmentpages_deactivate() {
    remove_action('template_redirect', 'flexipress_general_disableattachmentpages', 1);
}

