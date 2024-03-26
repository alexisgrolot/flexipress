<?php
// File : admin/performance-settings.php

// Include feature files
require_once(plugin_dir_path(__FILE__) . '/../includes/allow-svg-files-upload/allow-svg-files-upload.php');

// Checks if features are enabled
$allowsvgfilesupload_enabled = get_option('performance_enabled_allowsvgfilesupload', false);

// Form processing during submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $allowsvgfilesupload_enabled = isset($_POST['allowsvgfilesupload_enabled']) && $_POST['allowsvgfilesupload_enabled'] === 'on';

    // Records toggle switch status
    update_option('performance_enabled_allowsvgfilesupload', $allowsvgfilesupload_enabled);
}


// Displays the form and switch toggles
?>
<div class="wrap" id="flexipress-plugin">
    <h2><?php _e('Performance Settings', 'flexipress'); ?></h2>

    <form method="post" action="">
        <?php
        // Features and their status
        $features = array(
            'allowsvgfilesupload' => __('Allow SVG Files Upload', 'flexipress'),
            // Add other features as needed
        );

        foreach ($features as $key => $label) :
            $enabled = get_option("performance_enabled_$key", false);
        ?>
            <div class="feature-toggle-pair">
                <label class="switch">
                    <input type="checkbox" name="<?php echo $key; ?>_enabled" <?php checked($enabled); ?>>
                    <span class="toggle-slider round"></span>
                </label>
                
                <div class="feature-details">
                    <h3><?php echo $label; ?></h3>
                    <?php if ($key === 'allowsvgfilesupload'): ?>
                        <p><?php _e('Add support for SVG files to be uploaded in WordPress media.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php else: ?>
                        <p>.</p> <!-- Default description -->
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

        <button type="submit" name="save_changes"><?php _e('Save Changes', 'flexipress'); ?></button>
    </form>
</div>