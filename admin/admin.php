<?php
// Add menu entry to dashboard
add_action('admin_menu', 'flexipress_admin_menu');

function flexipress_admin_menu() {
    add_menu_page(__('FlexiPress Settings', 'flexipress'), __('FlexiPress', 'flexipress'), 'manage_options', 'flexipress', 'flexipress_admin_page', plugins_url( 'flexipress/images/icon_menu.png' ));
}

// Generate tab URL with nonce
function flexipress_tab_url($tab) {
    return add_query_arg(array(
        'page' => 'flexipress',
        'tab' => $tab,
        '_wpnonce' => wp_create_nonce('flexipress_tab_nonce')
    ), admin_url('admin.php'));
}

// Administration page
function flexipress_admin_page() {
    ?>
    <div class="wrap" id="flexipress-plugin">
        <h2><?php esc_html_e('FlexiPress Settings', 'flexipress'); ?></h2>

        <!-- Administration page content with tabs -->
        <?php
        // Tab management with nonce verification
		$active_tab = 'general';
        if (isset($_GET['tab']) && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'flexipress_tab_nonce')) {
            $active_tab = sanitize_key($_GET['tab']);
        }
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="<?php echo esc_url(flexipress_tab_url('general')); ?>" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('performance')); ?>" class="nav-tab <?php echo $active_tab === 'performance' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Performance', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('styling')); ?>" class="nav-tab <?php echo $active_tab === 'styling' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Styling', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('animation')); ?>" class="nav-tab <?php echo $active_tab === 'animation' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Animation', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('security')); ?>" class="nav-tab <?php echo $active_tab === 'security' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Security', 'flexipress'); ?></a>  
            <a href="<?php echo esc_url(flexipress_tab_url('wordpress-admin')); ?>" class="nav-tab <?php echo $active_tab === 'wordpress-admin' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('WordPress Admin', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('javascript')); ?>" class="nav-tab <?php echo $active_tab === 'javascript' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Javascript', 'flexipress'); ?></a>
            <a href="<?php echo esc_url(flexipress_tab_url('tracking-analytics')); ?>" class="nav-tab <?php echo $active_tab === 'tracking-analytics' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Tracking and Analytics', 'flexipress'); ?></a>

        <!-- Sponsor button -->
        <div class="sponsor-button">
            <a href="https://www.paypal.com/donate?hosted_button_id=265GHTXFX8F58" target="_blank" class="button-primary"><?php esc_html_e('Sponsor', 'flexipress'); ?></a>
        </div>
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

