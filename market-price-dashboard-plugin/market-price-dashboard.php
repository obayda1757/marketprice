<?php
/**
 * Plugin Name: Market Price Dashboard
 * Plugin URI: https://example.com/market-price-dashboard
 * Description: Real-time market price analytics dashboard with interactive charts and filtering
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: market-price-dashboard
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MARKET_PRICE_DASHBOARD_VERSION', '1.0.0');
define('MARKET_PRICE_DASHBOARD_PATH', plugin_dir_path(__FILE__));
define('MARKET_PRICE_DASHBOARD_URL', plugin_dir_url(__FILE__));

class Market_Price_Dashboard {
    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
        add_shortcode('market_price_dashboard', [$this, 'render_dashboard']);
        add_action('wp_ajax_mpd_get_data', [$this, 'ajax_get_data']);
        add_action('wp_ajax_nopriv_mpd_get_data', [$this, 'ajax_get_data']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'Market Price Dashboard',
            'Price Dashboard',
            'manage_options',
            'market-price-dashboard',
            [$this, 'render_admin_page'],
            'dashicons-chart-line',
            30
        );

        add_submenu_page(
            'market-price-dashboard',
            'Settings',
            'Settings',
            'manage_options',
            'market-price-dashboard-settings',
            [$this, 'render_settings_page']
        );
    }

    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'market-price-dashboard') === false) {
            return;
        }

        wp_enqueue_script(
            'chart-js',
            'https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js',
            [],
            '4.4.2',
            true
        );

        wp_enqueue_style(
            'mpd-admin-style',
            MARKET_PRICE_DASHBOARD_URL . 'assets/admin.css',
            [],
            MARKET_PRICE_DASHBOARD_VERSION
        );

        wp_enqueue_script(
            'mpd-admin-script',
            MARKET_PRICE_DASHBOARD_URL . 'assets/admin.js',
            ['jquery', 'chart-js'],
            MARKET_PRICE_DASHBOARD_VERSION,
            true
        );

        wp_localize_script('mpd-admin-script', 'mpdAdmin', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mpd_nonce'),
            'csv_url' => get_option('mpd_csv_url', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTNWtrnKZES6GHvZfjYekNf1U3rYr2jxAkP8lXHMypu60-krf0gDR7vp5Eu4e0ycUBFHfcmPdpFll_l/pub?gid=0&single=true&output=csv'),
        ]);
    }

    public function enqueue_frontend_scripts() {
        wp_enqueue_script(
            'chart-js',
            'https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js',
            [],
            '4.4.2',
            true
        );

        wp_enqueue_style(
            'mpd-frontend-style',
            MARKET_PRICE_DASHBOARD_URL . 'assets/frontend.css',
            [],
            MARKET_PRICE_DASHBOARD_VERSION
        );

        wp_enqueue_script(
            'mpd-frontend-script',
            MARKET_PRICE_DASHBOARD_URL . 'assets/frontend.js',
            ['jquery', 'chart-js'],
            MARKET_PRICE_DASHBOARD_VERSION,
            true
        );

        wp_localize_script('mpd-frontend-script', 'mpdFrontend', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mpd_nonce'),
            'csv_url' => get_option('mpd_csv_url', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTNWtrnKZES6GHvZfjYekNf1U3rYr2jxAkP8lXHMypu60-krf0gDR7vp5Eu4e0ycUBFHfcmPdpFll_l/pub?gid=0&single=true&output=csv'),
        ]);
    }

    public function render_dashboard($atts) {
        ob_start();
        include MARKET_PRICE_DASHBOARD_PATH . 'views/dashboard.php';
        return ob_get_clean();
    }

    public function render_admin_page() {
        include MARKET_PRICE_DASHBOARD_PATH . 'views/admin-dashboard.php';
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }

        if (isset($_POST['save_settings']) && wp_verify_nonce($_POST['mpd_nonce'], 'mpd_save_settings')) {
            $csv_url = sanitize_text_field($_POST['mpd_csv_url'] ?? '');
            update_option('mpd_csv_url', $csv_url);
            echo '<div class="updated"><p>Settings saved.</p></div>';
        }

        include MARKET_PRICE_DASHBOARD_PATH . 'views/admin-settings.php';
    }

    public function ajax_get_data() {
        check_ajax_referer('mpd_nonce');
        wp_send_json_success(['message' => 'Data retrieved']);
    }
}

function market_price_dashboard() {
    return Market_Price_Dashboard::get_instance();
}

market_price_dashboard();

register_activation_hook(__FILE__, function() {
    add_option('mpd_csv_url', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTNWtrnKZES6GHvZfjYekNf1U3rYr2jxAkP8lXHMypu60-krf0gDR7vp5Eu4e0ycUBFHfcmPdpFll_l/pub?gid=0&single=true&output=csv');
});

register_deactivation_hook(__FILE__, function() {
    // Cleanup if needed
});
