<?php
function flexipress_wordpressadmin_removewordpressversionnumber() {
    add_filter('the_generator', '__return_empty_string');
}

/**
 * Re-enable WordPress version number display.
 */
function flexipress_wordpressadmin_removewordpressversionnumber_deactivate() {
    remove_filter('the_generator', '__return_empty_string');
}
