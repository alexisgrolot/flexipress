<?php
// File : admin/performance-settings.php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include feature files
require_once(plugin_dir_path(__FILE__) . '/../includes/allow-svg-files-upload/allow-svg-files-upload.php');

// Checks if features are enabled
$allowsvgfilesupload_enabled = get_option('flexipress_performance_enabled_allowsvgfilesupload', false);

// Form processing during submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    // Verify nonce
    if ( !isset( $_POST['flexipress_settings_nonce'] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['flexipress_settings_nonce'] ) ) , 'flexipress_save_settings' ) ) {
        // Nonce verification failed; do something like display an error message or redirect
        // For example: wp_die( 'Security check failed' );
    } else {
        // Nonce verification succeeded; continue processing form data
        $allowsvgfilesupload_enabled = isset($_POST['allowsvgfilesupload_enabled']) && $_POST['allowsvgfilesupload_enabled'] === 'on';

        // Records toggle switch status
        update_option('flexipress_performance_enabled_allowsvgfilesupload', $allowsvgfilesupload_enabled);
    }
}


// Displays the form and switch toggles
?>
<div class="wrap" id="flexipress-plugin">
    <h2><?php esc_html_e('Performance Settings', 'flexipress'); ?></h2>

    <form method="post" action="">
        <?php
		// Ajoute un nonce au formulaire
        wp_nonce_field( 'flexipress_save_settings', 'flexipress_settings_nonce' );
		
        // Features and their status
        $features = array(
            'allowsvgfilesupload' => __('Allow SVG Files Upload', 'flexipress'),
            // Add other features as needed
        );

        foreach ($features as $key => $label) :
            $enabled = get_option("flexipress_performance_enabled_$key", false);
        ?>
            <div class="feature-toggle-pair">
                <label class="switch">
                    <input type="checkbox" name="<?php echo esc_attr( $key ); ?>_enabled" <?php checked($enabled); ?>>
                    <span class="toggle-slider round"></span>
                </label>
                
                <div class="feature-details">
                    <h3><?php echo esc_html( $label ); ?></h3>
                    <?php if ($key === 'allowsvgfilesupload'): ?>
                        <p><?php esc_html_e('Add support for SVG files to be uploaded in WordPress media.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php else: ?>
                        <p>.</p> <!-- Default description -->
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

        <button type="submit" name="save_changes"><?php esc_html_e('Save Changes', 'flexipress'); ?></button>
    </form>
</div>