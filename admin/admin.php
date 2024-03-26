<?php
// Add menu entry to dashboard
add_action('admin_menu', 'flexipress_admin_menu');

function flexipress_admin_menu() {
    add_menu_page(__('FlexiPress Settings', 'flexipress'), __('FlexiPress', 'flexipress'), 'manage_options', 'flexipress', 'flexipress_admin_page', plugins_url( 'flexipress/images/icon_menu.png' ));
}

// Administration page
function flexipress_admin_page() {
    ?>
    <div class="wrap" id="flexipress-plugin">
        <h2><?php _e('FlexiPress Settings', 'flexipress'); ?></h2>

        <!-- Administration page content with tabs -->
        <?php
        // Tab management
        $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'general';
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=flexipress&tab=general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=performance" class="nav-tab <?php echo $active_tab === 'performance' ? 'nav-tab-active' : ''; ?>"><?php _e('Performance', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=styling" class="nav-tab <?php echo $active_tab === 'styling' ? 'nav-tab-active' : ''; ?>"><?php _e('Styling', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=animation" class="nav-tab <?php echo $active_tab === 'animation' ? 'nav-tab-active' : ''; ?>"><?php _e('Animation', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=security" class="nav-tab <?php echo $active_tab === 'security' ? 'nav-tab-active' : ''; ?>"><?php _e('Security', 'flexipress'); ?></a>  
            <a href="?page=flexipress&tab=wordpress-admin" class="nav-tab <?php echo $active_tab === 'wordpress-admin' ? 'nav-tab-active' : ''; ?>"><?php _e('WordPress Admin', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=javascript" class="nav-tab <?php echo $active_tab === 'javascript' ? 'nav-tab-active' : ''; ?>"><?php _e('Javascript', 'flexipress'); ?></a>
            <a href="?page=flexipress&tab=tracking-analytics" class="nav-tab <?php echo $active_tab === 'tracking-analytics' ? 'nav-tab-active' : ''; ?>"><?php _e('Tracking and Analytics', 'flexipress'); ?></a>
        </h2>

        <div class="tab-content">
            <?php
            // Displays content according to active tab
            switch ($active_tab) {
                case 'performance':
                    include_once(plugin_dir_path(__FILE__) . 'performance-settings.php');
                    break;
                case 'styling':
                    include_once(plugin_dir_path(__FILE__) . 'styling-settings.php');
                    break;
                case 'animation':
                    include_once(plugin_dir_path(__FILE__) . 'animation-settings.php');
                    break;
                case 'security':
                    include_once(plugin_dir_path(__FILE__) . 'security-settings.php');
                    break;
                case 'wordpress-admin':
                    include_once(plugin_dir_path(__FILE__) . 'wordpress-admin-settings.php');
                    break;
                case 'javascript':
                    include_once(plugin_dir_path(__FILE__) . 'javascript-settings.php');
                    break;
                case 'tracking-analytics':
                    include_once(plugin_dir_path(__FILE__) . 'tracking-analytics-settings.php');
                    break;
                default:
                    include_once(plugin_dir_path(__FILE__) . 'general-settings.php');
            }
            ?>
        </div>
    </div>
    <?php
}

