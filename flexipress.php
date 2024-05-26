<?php
/**
 * @package WP Express
 * Plugin Name: FlexiPress
 * Plugin URI: https://express-wp.com/en/
 * Description: FlexiPress is the ultimate WordPress plugin, combining performance, security and customization in one simple, elegant solution. Everything you need.
 * Version: 1.0.2
 * Author Name: Alexis GROLOT (alexis.wpexpress@gmail.com)
 * Author: Alexis GROLOT (WP Express)
 * Text Domain: flexipress
 * Domain Path: /languages
 * Author URI: https://express-wp.com/en/about
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Activating and deactivating the plugin
register_activation_hook(__FILE__, 'flexipress_activate');
register_deactivation_hook(__FILE__, 'flexipress_deactivate');

// Activation and deactivation functions
function flexipress_activate() {
    // Actions to perform on activation
    
    // Checks if the WordPress version is compatible
    if (version_compare(get_bloginfo('version'), '5.0', '<')) {
        wp_die(esc_html__('FlexiPress requires at least WordPress 5.0. Please update your installation.', 'flexipress'));
    }
    
    // Creates an option to store default settings
    $default_settings = array(
        'general_enabled' => true,
        'performance_enabled' => true,
        'styling_enabled' => true,
        'animation_enabled' => true,
        'security_enabled' => true,
        'wordpress-admin_enabled' => true,
        'javascript_enabled' => true,
        'tracking-analytics_enabled' => true,
    );
    add_option('flexipress_settings', $default_settings);
    
    // Adds a page to the FlexiPress admin menu
    $page_id = add_menu_page(
        __('FlexiPress Settings', 'flexipress'),
        __('FlexiPress', 'flexipress'),
        'manage_options',
        'flexipress',
        'flexipress_admin_page',
		plugins_url( 'flexipress/images/icon_menu.png' )
    );
    
    // Saves page in option to enable tab management
    update_option('flexipress_menu_page_id', $page_id);
}

function flexipress_load_textdomain() {
    load_plugin_textdomain('flexipress', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'flexipress_load_textdomain');

function flexipress_deactivate() {
    // Actions to be taken on deactivation
    
    // Deletes configuration option on deactivation
    delete_option('flexipress_settings');
    
    // Retrieves page ID from administrator menu
    $menu_page_id = get_option('flexipress_menu_page_id');
    
    // Deletes the administrator's menu page
    remove_menu_page($menu_page_id);
    
}

// Include necessary files
require_once(plugin_dir_path(__FILE__) . 'admin/admin.php');
require_once(plugin_dir_path(__FILE__) . 'includes/general.php');
require_once(plugin_dir_path(__FILE__) . 'includes/performance.php');
require_once(plugin_dir_path(__FILE__) . 'includes/styling.php');
require_once(plugin_dir_path(__FILE__) . 'includes/animation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/security.php');
require_once(plugin_dir_path(__FILE__) . 'includes/wordpress-admin.php');
require_once(plugin_dir_path(__FILE__) . 'includes/javascript.php');
require_once(plugin_dir_path(__FILE__) . 'includes/tracking-analytics.php');

require_once 'vendor/autoload.php';

// Saves CSS styles
function flexipress_enqueue_styles() {
	$css_file = plugin_dir_path(__FILE__) . 'css/flexipress-styles.css';
    $version = file_exists($css_file) ? filemtime($css_file) : '1.1.0';
    wp_enqueue_style('flexipress-styles', plugins_url('css/flexipress-styles.css', __FILE__), array(), $version);
}
add_action('admin_enqueue_scripts', 'flexipress_enqueue_styles');