# Installation & Setup Guide

## Step-by-Step Installation

### Prerequisites
- WordPress 5.0 or higher installed
- Admin access to WordPress dashboard
- A CSV file with market price data (or use the default Google Sheet)

### Installation Steps

1. **Download the Plugin**
   - Extract the `market-price-dashboard-plugin` folder
   
2. **Upload to WordPress**
   - Connect via FTP or use WordPress File Manager
   - Navigate to `/wp-content/plugins/`
   - Upload the entire `market-price-dashboard-plugin` folder

3. **Activate Plugin**
   - Go to WordPress Admin Dashboard
   - Navigate to **Plugins** → **Installed Plugins**
   - Find "Market Price Dashboard"
   - Click **Activate**

4. **Configure Settings**
   - In WordPress Admin, go to **Price Dashboard** (new menu item)
   - Click **Settings**
   - Enter your CSV data source URL
   - Click **Save Settings**

5. **Display Dashboard**
   - Create a new Page or Post
   - Add the shortcode: `[market_price_dashboard]`
   - Publish the page
   - View the page to see your dashboard

## Configuration

### Option A: Use Default Google Sheet
The plugin comes with a default public Google Sheet. No configuration needed!

### Option B: Use Your Own CSV File

#### From Google Sheets
1. Create a Google Sheet with your data
2. Include columns: Sl, Item, Specification, Category, Year, Price, Unit
3. Go to **File** → **Share**
4. Change to "Anyone with the link can view"
5. Go to **File** → **Publish to the web**
6. Select **Comma-separated values (.csv)** format
7. Copy the URL
8. Paste in **Price Dashboard → Settings**

#### From Other Sources
1. Prepare a CSV file on your server
2. Ensure it's publicly accessible (no authentication)
3. Copy the direct URL to the CSV file
4. Paste in **Price Dashboard → Settings**

### CSV Format Requirements

Your CSV must have these columns in this order:

```
Sl,Item,Specification,Category,Year,Price,Unit
```

**Column Details:**

| Column | Type | Example | Notes |
|--------|------|---------|-------|
| Sl | Number | 1 | Row number |
| Item | Text | Rice | Product name (required) |
| Specification | Text | Premium Basmati | Optional details |
| Category | Text | Cereals | Product category |
| Year | Number | 2024 | Year of record (required) |
| Price | Number | 450 | Numerical value (required) |
| Unit | Text | per kg | Measurement unit |

### Example CSV Data

```csv
Sl,Item,Specification,Category,Year,Price,Unit
1,Rice,Premium Basmati,Cereals,2022,380,per kg
2,Rice,Premium Basmati,Cereals,2023,420,per kg
3,Rice,Premium Basmati,Cereals,2024,450,per kg
4,Wheat,Whole Grain,Cereals,2022,280,per kg
5,Wheat,Whole Grain,Cereals,2023,300,per kg
6,Wheat,Whole Grain,Cereals,2024,320,per kg
7,Oil,Sunflower,Oils,2022,140,per liter
8,Oil,Sunflower,Oils,2023,160,per liter
9,Oil,Sunflower,Oils,2024,180,per liter
```

## Using the Dashboard

### Adding to Pages/Posts

**Method 1: Using Shortcode**
```
[market_price_dashboard]
```

**Method 2: In WordPress Editor**
1. Add a **Custom HTML block** (if using block editor)
2. Paste: `[market_price_dashboard]`
3. Publish

### Dashboard Interface

**Header Section:**
- Dashboard title and description
- Record count badge
- Dark/Light mode toggle

**Overview Cards:**
- Total number of items in dataset
- Latest year average price
- Highest and lowest prices

**Filters Section:**
- Category dropdown
- Item dropdown
- Year dropdown
- Apply button (updates all charts)
- Reset button (clears all filters)

**Charts Section:**

1. **Price Trend Chart**
   - Select an item from dropdown
   - View price history over years
   - Export as PNG

2. **Category Price Comparison**
   - Select year or view all years
   - Compare average prices by category
   - Export as PNG

3. **Multi-Item Comparison**
   - Click item names (chips) to select up to 6 items
   - View overlaid price trends
   - Export as PNG

### Features

**Dark Mode Toggle:**
- Click the moon icon (🌙) in header
- Automatically saved per session

**Export Charts:**
- Click download button (⬇) on any chart
- Saves as PNG image

**Responsive Design:**
- Works on desktop (1400px+)
- Optimized for tablets (768px-1024px)
- Mobile-friendly (under 768px)

## Troubleshooting

### Plugin Not Appearing
- Verify plugin is activated in WordPress Plugins page
- Check file permissions (755 for folders, 644 for files)
- Ensure WordPress cache is cleared

### Dashboard Shows "Loading market data..."
- Check CSV URL is correct
- Verify CSV file is publicly accessible
- Check CORS settings on your server
- Open browser console (F12) for error messages

### Charts Not Displaying
- Verify Chart.js is loading (check Network tab in browser)
- Ensure Price column has valid numbers
- Check Year column contains valid dates
- Try refreshing the page

### Filters Not Working
- Ensure CSV has Category data
- Verify Item column has product names
- Check Year column format

### CSS/Styling Issues
- Clear WordPress cache
- Clear browser cache
- Disable conflicting CSS from other plugins
- Check browser console for CSS errors

## Performance Tips

**For Large Datasets:**
- Keep CSV file size under 5MB
- Limit to ~1000 rows for optimal performance
- Consider hosting CSV on fast server

**For Better Speed:**
- Enable WordPress caching
- Use CDN for static assets
- Optimize CSV file structure

## Security Notes

- CSV files should be publicly accessible URLs
- Avoid putting sensitive data in price files
- Use HTTPS URLs if available
- Plugin automatically sanitizes all user inputs

## Support

If you encounter issues:

1. Check browser console for errors (F12 → Console tab)
2. Verify CSV format is correct
3. Test with default Google Sheet first
4. Clear all caches (WordPress, browser, server)
5. Contact your site administrator

## Advanced Configuration

### Custom CSS

Add custom CSS to your theme's additional CSS section:

```css
#mpd-dashboard .mpd-chart-title {
  color: your-color;
  font-size: 16px;
}
```

### Change Default CSV URL

In WordPress admin, under **Price Dashboard → Settings**, modify the CSV URL permanently for your site's branding.

## Uninstallation

1. Go to **Plugins** → **Installed Plugins**
2. Find "Market Price Dashboard"
3. Click **Deactivate**
4. Click **Delete** (or manually delete from `/wp-content/plugins/`)

All plugin data is cleaned up automatically.

---

For more information, see README.md or contact your site administrator.
