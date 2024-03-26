<?php
function flexipress_wordpressadmin_disablegutenbergeditor() {
    add_filter('gutenberg_can_edit_post', '__return_false', 5);
    add_filter('use_block_editor_for_post', '__return_false', 5);
}

/**
 * Reactivate the deactivated Gutenberg editor.
 */
function flexipress_wordpressadmin_disablegutenbergeditor_deactivate() {
    remove_filter('gutenberg_can_edit_post', '__return_false', 5);
    remove_filter('use_block_editor_for_post', '__return_false', 5);
}
