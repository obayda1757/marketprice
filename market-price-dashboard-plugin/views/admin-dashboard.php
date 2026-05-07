<?php
/**
 * Admin Dashboard Page
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die('Unauthorized');
}
?>

<div class="wrap">
    <h1>Market Price Dashboard</h1>

    <div class="mpd-admin-container">
        <div class="mpd-admin-info">
            <h2>Welcome to Market Price Dashboard</h2>
            <p>Use the shortcode <code>[market_price_dashboard]</code> to display the dashboard on any page or post.</p>

            <h3>Features:</h3>
            <ul>
                <li>Real-time price analytics from Google Sheets CSV</li>
                <li>Interactive price trend charts</li>
                <li>Category-based price comparison</li>
                <li>Multi-item trend comparison</li>
                <li>Advanced filtering by category, item, and year</li>
                <li>Dark/Light mode toggle</li>
                <li>Export charts as PNG images</li>
                <li>Fully responsive design</li>
            </ul>

            <h3>Getting Started:</h3>
            <ol>
                <li>Go to <strong>Price Dashboard → Settings</strong> to configure your CSV data source</li>
                <li>Create a new page in WordPress</li>
                <li>Add the shortcode: <code>[market_price_dashboard]</code></li>
                <li>Publish and view your dashboard</li>
            </ol>

            <h3>Default CSV Source:</h3>
            <p>By default, the plugin uses a public Google Sheet. You can configure your own CSV URL in the Settings page.</p>

            <div class="mpd-admin-preview">
                <h3>Dashboard Preview:</h3>
                <p><em>The dashboard will display here when you use the shortcode on a page.</em></p>
            </div>
        </div>

        <div class="mpd-admin-sidebar">
            <div class="mpd-admin-box">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo admin_url('admin.php?page=market-price-dashboard-settings'); ?>">⚙️ Settings</a></li>
                    <li><a href="<?php echo admin_url('post-new.php'); ?>">➕ New Page</a></li>
                    <li><a href="https://docs.google.com/spreadsheets" target="_blank">📊 Google Sheets</a></li>
                </ul>
            </div>

            <div class="mpd-admin-box">
                <h3>Support</h3>
                <p>For issues or feature requests, please contact your site administrator.</p>
            </div>
        </div>
    </div>
</div>

<style>
.mpd-admin-container {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 20px;
    margin-top: 20px;
}

.mpd-admin-info {
    background: white;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.mpd-admin-info h2 {
    color: #333;
    margin-bottom: 15px;
}

.mpd-admin-info h3 {
    color: #0ea5e9;
    margin-top: 20px;
    margin-bottom: 10px;
}

.mpd-admin-info ul, .mpd-admin-info ol {
    margin-left: 20px;
}

.mpd-admin-info li {
    margin-bottom: 8px;
    color: #555;
}

.mpd-admin-info code {
    background: #f5f5f5;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}

.mpd-admin-preview {
    background: #f9f9f9;
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    margin-top: 20px;
}

.mpd-admin-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.mpd-admin-box {
    background: white;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.mpd-admin-box h3 {
    color: #0ea5e9;
    margin-bottom: 12px;
    font-size: 14px;
}

.mpd-admin-box ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.mpd-admin-box li {
    margin-bottom: 8px;
}

.mpd-admin-box a {
    color: #0ea5e9;
    text-decoration: none;
}

.mpd-admin-box a:hover {
    text-decoration: underline;
}

.mpd-admin-box p {
    color: #666;
    font-size: 13px;
    margin: 0;
}

@media (max-width: 768px) {
    .mpd-admin-container {
        grid-template-columns: 1fr;
    }
}
</style>
