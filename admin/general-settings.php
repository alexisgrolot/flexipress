<?php
// File : admin/general-settings.php

// Include feature files
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-automatic-updates-emails/disable-automatic-updates-emails.php');
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-attachment-pages/disable-attachment-pages.php');
require_once(plugin_dir_path(__FILE__) . '/../includes/completely-disable-comments/completely-disable-comments.php');

// Checks if features are enabled
$disableautomaticupdatesemails_enabled = get_option('general_enabled_disableautomaticupdatesemails', false);
$disableattachmentpages_enabled = get_option('general_enabled_disableattachmentpages', false);
$completelydisablecomments_enabled = get_option('general_enabled_completelydisablecomments', false);

// Form processing during submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $disableautomaticupdatesemails_enabled = isset($_POST['disableautomaticupdatesemails_enabled']) && $_POST['disableautomaticupdatesemails_enabled'] === 'on';
    $disableattachmentpages_enabled = isset($_POST['disableattachmentpages_enabled']) && $_POST['disableattachmentpages_enabled'] === 'on';
    $completelydisablecomments_enabled = isset($_POST['completelydisablecomments_enabled']) && $_POST['completelydisablecomments_enabled'] === 'on';

    // Records toggle switch status
    update_option('general_enabled_disableautomaticupdatesemails', $disableautomaticupdatesemails_enabled);
    update_option('general_enabled_disableattachmentpages', $disableattachmentpages_enabled);
    update_option('general_enabled_completelydisablecomments', $completelydisablecomments_enabled);
}


// Displays the form and switch toggles
?>
<div class="wrap" id="flexipress-plugin">
    <h2><?php _e('General Settings', 'flexipress'); ?></h2>

    <form method="post" action="">
        <?php
        // Features and their status
        $features = array(
            'disableautomaticupdatesemails' => __('Disable Automatic Updates Emails', 'flexipress'),
            'disableattachmentpages' => __('Disable Attachment Pages', 'flexipress'),
            'completelydisablecomments' => __('Completely Disable Comments', 'flexipress'),
            // Add other features as needed
        );

        foreach ($features as $key => $label) :
            $enabled = get_option("general_enabled_$key", false);
        ?>
            <div class="feature-toggle-pair">
                <label class="switch">
                    <input type="checkbox" name="<?php echo $key; ?>_enabled" <?php checked($enabled); ?>>
                    <span class="toggle-slider round"></span>
                </label>
                
                <div class="feature-details">
                    <h3><?php echo $label; ?></h3>
                    <?php if ($key === 'disableautomaticupdatesemails'): ?>
                        <p><?php _e('Stop getting emails about automatic updates on your WordPress site.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php elseif ($key === 'disableattachmentpages'): ?>
                        <p><?php _e('Hide the Attachment/Attachments pages on the frontend from all visitors.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php elseif ($key === 'completelydisablecomments'): ?>
                        <p><?php _e('Disable comments for all post types, in the admin and the frontend.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php else: ?>
                        <p>.</p> <!-- Default description -->
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

        <button type="submit" name="save_changes"><?php _e('Save Changes', 'flexipress'); ?></button>
    </form>
</div>