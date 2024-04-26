<?php
// File: admin/security-settings.php

// Include feature files
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-xml-rpc/disable-xml-rpc.php');
require_once(plugin_dir_path(__FILE__) . '/../includes/disable-wordpress-rest-api/disable-wordpress-rest-api.php');

// Checks if features are enabled
$disablexmlrpc_enabled = get_option('security_enabled_disablexmlrpc', false);
$disablewordpressrestapi_enabled = get_option('security_enabled_disablewordpressrestapi', false);

// Form processing during submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $disablexmlrpc_enabled = isset($_POST['disablexmlrpc_enabled']) && $_POST['disablexmlrpc_enabled'] === 'on';
    $disablewordpressrestapi_enabled = isset($_POST['disablewordpressrestapi_enabled']) && $_POST['disablewordpressrestapi_enabled'] === 'on';

    // Records toggle switch status
    update_option('security_enabled_disablexmlrpc', $disablexmlrpc_enabled);
    update_option('security_enabled_disablewordpressrestapi', $disablewordpressrestapi_enabled);
}


// Displays the form and switch toggles
?>
<div class="wrap" id="flexipress-plugin">
    <h2><?php esc_html_e('Security Settings', 'flexipress'); ?></h2>

    <form method="post" action="">
        <?php
        // Features and their status
        $features = array(
            'disablexmlrpc' => __('Disable XML-RPC', 'flexipress'),
            'disablewordpressrestapi' => __('Disable WordPress REST API', 'flexipress'),
            // Add other features as needed
        );

        foreach ($features as $key => $label) :
            $enabled = get_option("security_enabled_$key", false);
        ?>
            <div class="feature-toggle-pair">
                <label class="switch">
                    <input type="checkbox" name="<?php echo esc_js( $key ); ?>_enabled" <?php checked($enabled); ?>>
                    <span class="toggle-slider round"></span>
                </label>
                
                <div class="feature-details">
                    <h3><?php echo esc_html( $label ); ?></h3>
                    <?php if ($key === 'disablexmlrpc'): ?>
                        <p><?php esc_html_e('On sites running WordPress 3.5+, disable XML-RPC completely.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php elseif ($key === 'disablewordpressrestapi'): ?>
                        <p><?php esc_html_e('Easily disable the WP REST API on your website.', 'flexipress'); ?></p> <!-- Function description -->
                    <?php else: ?>
                        <p>.</p> <!-- Default description -->
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

        <button type="submit" name="save_changes"><?php esc_html_e('Save Changes', 'flexipress'); ?></button>
    </form>
</div>