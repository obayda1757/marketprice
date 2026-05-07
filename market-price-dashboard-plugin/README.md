# Market Price Dashboard - WordPress Plugin

A powerful, fully-featured WordPress plugin for displaying real-time market price analytics with interactive charts, advanced filtering, and responsive design.

## Features

- **Interactive Charts**: Line charts for price trends, bar charts for category comparison, and multi-item overlay comparisons
- **Advanced Filtering**: Filter by category, item, and year
- **Summary Cards**: Quick overview of total items, average price, highest, and lowest prices
- **Dark/Light Mode**: Toggle between themes for better readability
- **Chart Export**: Download charts as PNG images
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Easy CSV Integration**: Use Google Sheets or any CSV file as your data source
- **Admin Dashboard**: Dedicated admin menu for management and settings
- **Shortcode Support**: Use `[market_price_dashboard]` to display the dashboard anywhere

## Installation

1. Download the plugin folder to your WordPress plugins directory:
   ```
   /wp-content/plugins/market-price-dashboard-plugin/
   ```

2. Activate the plugin in WordPress Admin → Plugins

3. Go to **Price Dashboard → Settings** to configure your CSV data source

## Usage

### Basic Setup

1. Navigate to **Price Dashboard → Settings** in WordPress admin
2. Enter your CSV file URL (Google Sheets or any publicly accessible CSV)
3. Create a new page or post
4. Add the shortcode: `[market_price_dashboard]`
5. Publish and view your dashboard

### CSV Format

Your CSV file should have the following columns:

| Column | Type | Required | Description |
|--------|------|----------|-------------|
| Sl | Number | Yes | Serial/Row number |
| Item | Text | Yes | Product name |
| Specification | Text | No | Product details/variant |
| Category | Text | Yes | Product category |
| Year | Number | Yes | Year of price record |
| Price | Number | Yes | Numerical price value |
| Unit | Text | No | Unit of measurement (kg, liter, etc.) |

### Example CSV Row

```
1,Rice,Premium Basmati,Cereals,2024,450,per kg
2,Wheat,Whole Grain,Cereals,2024,320,per kg
3,Oil,Sunflower,Oils,2024,180,per liter
```

### Using Google Sheets

1. Create a Google Sheet with your data
2. Go to **File → Share** and make it "Anyone with the link can view"
3. Click **File → Publish to the web**
4. Select CSV format
5. Copy the URL and paste it in plugin settings

### Dashboard Features

**Summary Cards**: Display key metrics at a glance
- Total number of unique items
- Average price for the latest year
- Highest and lowest prices in the dataset

**Filters**: 
- Filter by Category, Item, and Year
- Apply filters to update all charts and statistics
- Reset button to clear all filters

**Charts**:
- **Price Trend**: Select an item to view its price history over years
- **Price by Category**: Compare average prices across categories
- **Multi-Item Comparison**: Select up to 6 items for overlay price comparison

**Export**:
- Download any chart as a PNG image by clicking the download button

## Settings

### CSV Data Source URL

Configure the URL to your CSV file. The plugin will:
- Fetch data from the URL
- Parse the CSV format
- Display it in the dashboard

Requirements:
- CSV file must be publicly accessible
- File should not require authentication
- CORS should be enabled on the hosting server

## Troubleshooting

**Dashboard not displaying data:**
- Check that your CSV URL is correct and publicly accessible
- Ensure the CSV file has all required columns
- Check browser console for error messages

**Charts not rendering:**
- Verify Chart.js library is loaded (check browser console)
- Ensure you have valid numerical data in the Price column
- Check that Year column contains valid numbers

**Settings not saving:**
- Verify you have admin permissions
- Ensure WordPress nonces are enabled
- Check server file permissions

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher
- Chart.js 4.4.2 (loaded via CDN)

## Plugin Structure

```
market-price-dashboard-plugin/
├── market-price-dashboard.php     # Main plugin file
├── views/
│   ├── dashboard.php              # Frontend dashboard template
│   ├── admin-dashboard.php        # Admin dashboard page
│   └── admin-settings.php         # Settings page
├── assets/
│   ├── frontend.css               # Frontend styles
│   ├── frontend.js                # Frontend script
│   ├── admin.css                  # Admin styles
│   └── admin.js                   # Admin script
└── README.md                       # This file
```

## Shortcodes

### Market Price Dashboard

Display the full dashboard:

```
[market_price_dashboard]
```

## Hooks & Filters

Developers can extend the plugin using WordPress hooks and filters:

```php
// Example: Custom CSV URL per page
add_filter('mpd_csv_url', function($url) {
    return 'https://custom-url.com/data.csv';
});
```

## Support

For issues, feature requests, or contributions, please contact your site administrator or the plugin author.

## License

GPL v2 or later. See LICENSE file for details.

## Changelog

### Version 1.0.0
- Initial release
- Dashboard with interactive charts
- Advanced filtering
- Settings page
- Dark/Light mode
- Chart export functionality

---

Built with care for data visualization and WordPress integration.
