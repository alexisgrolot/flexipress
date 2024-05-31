<?php
function flexipress_wordpressadmin_frontendcommentmoderation() {
	// Add delete and cancel icons to comment actions
	function flexipress_modify_comment_reply_link($link, $args, $comment, $post) {
		if (!is_admin() && current_user_can('administrator')) {
			// Buttons will have CSS classes for styles
			$delete_icon = '<a href="#" class="flexipress-delete-comment" data-comment-id="' . $comment->comment_ID . '" style="color: red;"> 🗑️ Supprimer</a>';
			$undo_icon = '<a href="#" class="flexipress-undo-delete" data-comment-id="' . $comment->comment_ID . '" style="display:none; color: green;"> ↩️ Annuler</a>';

			// Add delete and cancel icons after comment actions
			$link .= ' ' . $delete_icon . ' ' . $undo_icon;
		}
		return $link;
	}
	add_filter('comment_reply_link', 'flexipress_modify_comment_reply_link', 10, 4);
	
	// AJAX action to delete a comment
	function flexipress_ajax_delete_comment() {
		// Verify nonce
        if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'flexipress_ajax_nonce')) {
            wp_send_json_error('Invalid nonce');
            return;
        }
		
		if (!isset($_POST['comment_id']) || !current_user_can('administrator')) {
			wp_send_json_error('Permission denied or missing comment ID');
			return;
		}

		$comment_id = intval($_POST['comment_id']);
		wp_trash_comment($comment_id);
		wp_send_json_success('Comment deleted');
	}
	add_action('wp_ajax_flexipress_delete_comment', 'flexipress_ajax_delete_comment');

	// AJAX action to restore a comment
	function flexipress_ajax_undo_delete_comment() {
		// Verify nonce
        if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'flexipress_ajax_nonce')) {
            wp_send_json_error('Invalid nonce');
            return;
        }
		
		if (!isset($_POST['comment_id']) || !current_user_can('administrator')) {
			wp_send_json_error('Permission denied or missing comment ID');
			return;
		}

		$comment_id = intval($_POST['comment_id']);
		wp_untrash_comment($comment_id);
		wp_send_json_success('Comment restored');
	}
	add_action('wp_ajax_flexipress_undo_delete_comment', 'flexipress_ajax_undo_delete_comment');
	
	function flexipress_enqueue_scripts() {
		// Set the version number here
		$script_version = '1.0.0'; // You can update this version number as needed
		
		wp_enqueue_script('flexipress-ajax-script', plugins_url('/js/flexipress-ajax.js', __FILE__), array('jquery'), $script_version, true);
		wp_localize_script('flexipress-ajax-script', 'flexipress_ajax_object', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('flexipress_ajax_nonce')
		));
	}
	add_action('wp_enqueue_scripts', 'flexipress_enqueue_scripts');
}

function flexipress_wordpressadmin_frontendcommentmoderation_deactivate() {
    // Remove the filter for modifying comment reply link
    remove_filter('comment_reply_link', 'flexipress_modify_comment_reply_link', 10);

    // Remove the AJAX actions
    remove_action('wp_ajax_flexipress_delete_comment', 'flexipress_ajax_delete_comment');
    remove_action('wp_ajax_flexipress_undo_delete_comment', 'flexipress_ajax_undo_delete_comment');

    // Dequeue the script
    remove_action('wp_enqueue_scripts', 'flexipress_enqueue_scripts');
}
