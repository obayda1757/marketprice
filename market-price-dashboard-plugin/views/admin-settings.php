<?php
/**
 * Admin Settings Page
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die('Unauthorized');
}

$csv_url = get_option('mpd_csv_url', 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTNWtrnKZES6GHvZfjYekNf1U3rYr2jxAkP8lXHMypu60-krf0gDR7vp5Eu4e0ycUBFHfcmPdpFll_l/pub?gid=0&single=true&output=csv');
?>

<div class="wrap">
    <h1>Market Price Dashboard - Settings</h1>

    <div class="mpd-settings-container">
        <form method="POST" action="">
            <?php wp_nonce_field('mpd_save_settings', 'mpd_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="mpd_csv_url">CSV Data Source URL</label>
                    </th>
                    <td>
                        <input
                            type="text"
                            id="mpd_csv_url"
                            name="mpd_csv_url"
                            value="<?php echo esc_attr($csv_url); ?>"
                            class="regular-text"
                            placeholder="https://example.com/data.csv"
                        />
                        <p class="description">
                            Enter the URL to your CSV file. The CSV should have columns: Sl, Item, Specification, Category, Year, Price, Unit
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">CSV Format Requirements</th>
                    <td>
                        <div style="background: #f9f9f9; padding: 10px; border-radius: 4px; border-left: 4px solid #0ea5e9;">
                            <p><strong>Required Columns:</strong></p>
                            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                                <li><code>Sl</code> - Serial number</li>
                                <li><code>Item</code> - Product name (required)</li>
                                <li><code>Specification</code> - Product details</li>
                                <li><code>Category</code> - Product category</li>
                                <li><code>Year</code> - Year of price record (required)</li>
                                <li><code>Price</code> - Numerical price value (required)</li>
                                <li><code>Unit</code> - Unit of measurement</li>
                            </ul>
                            <p style="margin-top: 10px;"><strong>Example CSV Row:</strong></p>
                            <code style="background: white; padding: 8px; display: block; border-radius: 3px; margin-top: 5px;">
                                1,Rice,Premium Basmati,Cereals,2024,450,per kg
                            </code>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Current Status</th>
                    <td>
                        <div id="mpd-csv-status" style="background: #f0f0f0; padding: 10px; border-radius: 4px;">
                            <p>Testing CSV connection...</p>
                        </div>
                    </td>
                </tr>
            </table>

            <p class="submit">
                <button type="submit" name="save_settings" class="button button-primary">Save Settings</button>
            </p>
        </form>
    </div>
</div>

<style>
.mpd-settings-container {
    background: white;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-top: 20px;
}

.form-table th {
    text-align: left;
    width: 200px;
}

.form-table code {
    background: #f5f5f5;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
    font-size: 12px;
}

.description {
    display: block;
    color: #666;
    font-size: 13px;
    margin-top: 8px;
}

.button-primary {
    background: #0ea5e9;
    border-color: #0284c7;
    color: white;
    padding: 8px 20px;
}

.button-primary:hover {
    background: #0284c7;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusEl = document.getElementById('mpd-csv-status');
    const csvUrl = document.getElementById('mpd_csv_url').value;

    fetch(csvUrl, { method: 'HEAD' })
        .then(res => {
            if (res.ok) {
                statusEl.innerHTML = '<p style="color: #10b981;">✓ CSV source is accessible</p>';
            } else {
                statusEl.innerHTML = '<p style="color: #ef4444;">✗ CSV source returned an error</p>';
            }
        })
        .catch(err => {
            statusEl.innerHTML = '<p style="color: #ef4444;">✗ Could not reach CSV source</p>';
        });
});
</script>
