# Quick Start Guide

Get your Market Price Dashboard running in 3 minutes!

## Installation (1 minute)

1. **Upload Plugin**
   - Extract `market-price-dashboard-plugin` folder
   - Upload to `/wp-content/plugins/`
   - Go to WordPress Admin → **Plugins**
   - Click **Activate** on "Market Price Dashboard"

## Configuration (1 minute)

1. **Go to Settings**
   - In WordPress Admin, click **Price Dashboard** → **Settings**
   
2. **Set CSV URL (Optional)**
   - Default: Uses public Google Sheet (no setup needed!)
   - Custom: Enter your own CSV URL
   - Click **Save Settings**

## Display Dashboard (1 minute)

1. **Create a Page**
   - Go to **Pages** → **New Page**
   - Add shortcode: `[market_price_dashboard]`
   - Click **Publish**

2. **View Dashboard**
   - Click **View Page**
   - Your dashboard is live!

## That's It! 🎉

Your market price dashboard is now displaying live data with:
- Interactive price trend charts
- Category comparisons
- Multi-item overlays
- Advanced filtering
- Dark/Light mode
- Export functionality

## Common Tasks

### Change Data Source
1. Go to **Price Dashboard** → **Settings**
2. Enter new CSV URL
3. Save and refresh

### Show on Home Page
1. Edit your home page
2. Add: `[market_price_dashboard]`
3. Update

### Customize Theme
1. Use the **Dark/Light mode** toggle in dashboard
2. Or add custom CSS to your theme

## CSV Format (If Using Custom Data)

Your CSV needs these columns:
```
Sl,Item,Specification,Category,Year,Price,Unit
1,Rice,Premium,Cereals,2024,450,per kg
```

## Features at a Glance

✅ Real-time price analytics  
✅ Interactive charts  
✅ Advanced filtering  
✅ Dark mode  
✅ Mobile responsive  
✅ Chart export  
✅ Zero configuration setup  

## Need Help?

- See **README.md** for detailed features
- See **INSTALLATION.md** for troubleshooting
- Check browser console (F12) for errors
- Contact your site administrator

## Default Data Source

The plugin uses a public Google Sheet with real market data:
- Multiple product categories
- Historical price data from 2022-2024
- Ready to use out of the box

## Ready to Customize?

For advanced customization, see **INSTALLATION.md** → Advanced Configuration section.

---

Enjoy your dashboard! 📊
