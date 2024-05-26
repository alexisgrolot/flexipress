<?php
// File name: admin/wordpress-admin-settings.php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include feature files
require_once(plugin_dir_path(__FILE__) . '/../includes/remove-wordpress-version-number/remove-wordpress-version-number.php');
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-gutenberg-editor/disable-gutenberg-editor.php');
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-the-wp-admin-bar/disable-the-wp-admin-bar.php');

// Checks if features are enabled
$removewordpressversionnumber_enabled = get_option('flexipress_wordpress-admin_enabled_removewordpressversionnumber', false);
$disablegutenbergeditor_enabled = get_option('flexipress_wordpress-admin_enabled_disablegutenbergeditor', false);
$disablethewpadminbar_enabled = get_option('flexipress_wordpress-admin_enabled_disablethewpadminbar', false);

// Form processing during submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    // Verify nonce
    if ( !isset( $_POST['flexipress_settings_nonce'] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['flexipress_settings_nonce'] ) ) , 'flexipress_save_settings' ) ) {
        // Nonce verification failed; do something like display an error message or redirect
        // For example: wp_die( 'Security check failed' );
    } else {
        // Nonce verification succeeded; continue processing form data
		$removewordpressversionnumber_enabled = isset($_POST['removewordpressversionnumber_enabled']) && $_POST['removewordpressversionnumber_enabled'] === 'on';
		$disablegutenbergeditor_enabled = isset($_POST['disablegutenbergeditor_enabled']) && $_POST['disablegutenbergeditor_enabled'] === 'on';
		$disablethewpadminbar_enabled = isset($_POST['disablethewpadminbar_enabled']) && $_POST['disablethewpadminbar_enabled'] === 'on';

        // Records toggle switch status
		update_option('flexipress_wordpress-admin_enabled_removewordpressversionnumber', $removewordpressversionnumber_enabled);
		update_option('flexipress_wordpress-admin_enabled_disablegutenbergeditor', $disablegutenbergeditor_enabled);
		update_option('flexipress_wordpress-admin_enabled_disablethewpadminbar', $disablethewpadminbar_enabled);
    }
}


// Displays the form and switch toggles
?>
<div class="wrap" id="flexipress-plugin">
    <h2><?php esc_html_e('WordPress Admin Settings', 'flexipress'); ?></h2>

    <form method="post" action="">
        <?php
		// Ajoute un nonce au formulaire
        wp_nonce_field( 'flexipress_save_settings', 'flexipress_settings_nonce' );
		
        // Features and their status
        $features = array(
            'removewordpressversionnumber' => __('Remove WordPress Version Number', 'flexipress'),
            'disablegutenbergeditor' => __('Disable Gutenberg Editor (use Classic Editor)', 'flexipress'),
            'disablethewpadminbar' => __('Disable The WP Admin Bar', 'flexipress'),
            // Add other features as needed
        );

        foreach ($features as $key => $label) :
            $enabled = get_option("flexipress_wordpress-admin_enabled_$key", false);
			$is_not_recommended = false; // By default, the feature is not marked as non-recommended
			
			// Check whether the feature is non-recommended and set $is_not_recommended accordingly.
			if ($key === 'removewordpressversionnumber' || $key === 'disablethewpadminbar') {
			$is_not_recommended = true;
			}
        ?>
            <div class="feature-toggle-pair">
                <label class="switch">
                    <input type="checkbox" name="<?php echo esc_attr( $key ); ?>_enabled" <?php checked($enabled); ?>>
                    <span class="toggle-slider round"></span>
                </label>
                
                <div class="feature-details">
                    <h3><?php echo esc_html( $label ); ?><?php if ($is_not_recommended): ?><span class="not-recommended-badge"><?php esc_html_e( 'Not recommended', 'flexipress' ); ?></span><?php endif; ?></h3>
                    <?php if ($key === 'removewordpressversionnumber'): ?>
                        <p><?php esc_html_e('Hide the WordPress version number from your site\'s frontend and feeds.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php elseif ($key === 'disablegutenbergeditor'): ?>
                        <p><?php esc_html_e('Switch back to the Classic Editor by disablling the Block Editor.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php elseif ($key === 'disablethewpadminbar'): ?>
                        <p><?php esc_html_e('Hide the WordPress Admin Bar for all users in the frontend.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php else: ?>
                        <p>.</p> <!-- Default description -->
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

        <button type="submit" name="save_changes"><?php esc_html_e('Save Changes', 'flexipress'); ?></button>
    </form>
</div>