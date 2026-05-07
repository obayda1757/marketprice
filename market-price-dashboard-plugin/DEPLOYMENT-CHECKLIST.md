# Deployment Checklist

Use this checklist to ensure your Market Price Dashboard plugin is properly deployed and configured.

## Pre-Deployment

- [ ] All files present and correct
- [ ] File permissions set (755 for folders, 644 for files)
- [ ] No debug information in code
- [ ] Tested on local WordPress installation
- [ ] CSV data source URL tested and working
- [ ] All documentation reviewed

## Installation

- [ ] Plugin folder uploaded to `/wp-content/plugins/`
- [ ] Plugin activated in WordPress Admin → Plugins
- [ ] No error messages in WordPress admin
- [ ] Plugin menu appears in sidebar

## Configuration

- [ ] CSV source URL configured in settings
- [ ] CSV file publicly accessible
- [ ] CSV format verified (all required columns present)
- [ ] CSV data tested with at least 10 rows
- [ ] Settings page shows "CSV source is accessible"

## Frontend Testing

- [ ] Shortcode `[market_price_dashboard]` added to test page
- [ ] Dashboard displays without errors
- [ ] Summary cards show correct data
- [ ] Filters populate with data from CSV
- [ ] Charts render correctly
- [ ] Dark/Light mode toggle works
- [ ] Charts export as PNG

## Responsive Testing

- [ ] Desktop view (1400px+) looks correct
- [ ] Tablet view (768px-1024px) responsive
- [ ] Mobile view (<768px) responsive
- [ ] Touch controls work on mobile
- [ ] Charts scale properly on all screen sizes

## Browser Testing

- [ ] Chrome/Edge - Working
- [ ] Firefox - Working
- [ ] Safari - Working
- [ ] Mobile Safari (iOS) - Working
- [ ] Chrome Mobile (Android) - Working

## Performance

- [ ] Dashboard loads within 3 seconds
- [ ] No JavaScript errors in console
- [ ] No CSS conflicts with theme
- [ ] Charts render smoothly with 100+ data points
- [ ] No memory leaks (check Performance tab)

## Security

- [ ] WordPress nonces verified working
- [ ] No sensitive data in CSV
- [ ] CSV URL uses HTTPS (if available)
- [ ] No admin functions exposed to frontend
- [ ] Input validation working

## Functionality

- [ ] Category filter works correctly
- [ ] Item filter works correctly
- [ ] Year filter works correctly
- [ ] Apply filters button updates all charts
- [ ] Reset filters button clears all selections
- [ ] Line chart updates on item selection
- [ ] Bar chart updates on year selection
- [ ] Multi-line chart selection works (up to 6 items)
- [ ] Export buttons download PNG correctly

## Admin Testing

- [ ] Admin dashboard page accessible
- [ ] Settings page accessible
- [ ] CSV URL configuration saves
- [ ] Settings persist after page reload
- [ ] Settings visible only to administrators

## Data Validation

- [ ] Empty categories handled gracefully
- [ ] Missing years handled gracefully
- [ ] Non-numeric prices handled gracefully
- [ ] Empty CSV shows no errors
- [ ] Malformed CSV shows error message

## Documentation

- [ ] README.md reviewed and accurate
- [ ] INSTALLATION.md covers all setup steps
- [ ] QUICK-START.md works as described
- [ ] PLUGIN-SUMMARY.md reflects actual features
- [ ] All links in documentation work

## Cleanup

- [ ] Removed all debug code
- [ ] Removed all test data
- [ ] Removed all comments with sensitive info
- [ ] No development files included
- [ ] No unnecessary files in plugin folder

## Deployment to Live Server

- [ ] All tests passed above
- [ ] Backup of production site created
- [ ] Plugin uploaded via FTP or file manager
- [ ] Plugin activated in live WordPress
- [ ] Live site tested immediately after deployment
- [ ] Monitor for errors in next 24 hours

## Post-Deployment

- [ ] Dashboard URL bookmarked
- [ ] Admin notified of deployment
- [ ] Users notified of new feature
- [ ] Monitor server logs for errors
- [ ] Check database for issues
- [ ] Gather user feedback

## Troubleshooting Verification

- [ ] You can identify if CSV URL is wrong
- [ ] You can identify if charts aren't loading
- [ ] You can identify if filters aren't working
- [ ] You can check browser console for errors
- [ ] You can access browser network tab for debugging

## Maintenance

- [ ] WordPress updated regularly
- [ ] Plugin code reviewed for security
- [ ] CSV data updated as needed
- [ ] Performance monitored
- [ ] User feedback tracked

## Rollback Plan

- [ ] Know how to deactivate plugin
- [ ] Know how to delete plugin folder
- [ ] Have backup of previous version
- [ ] Have plan to restore old dashboard if needed
- [ ] Have contact for technical support

---

## Sign-Off

- **Deployed By**: ___________________
- **Date**: ___________________
- **Tested By**: ___________________
- **Date**: ___________________
- **Approved By**: ___________________
- **Date**: ___________________

---

## Notes

Use this space for any additional notes or observations:

```
[Add notes here]
```

---

## Quick Command Reference

### Check File Permissions
```bash
ls -la /wp-content/plugins/market-price-dashboard-plugin/
```

### Set Correct Permissions
```bash
chmod 755 /wp-content/plugins/market-price-dashboard-plugin/
chmod 644 /wp-content/plugins/market-price-dashboard-plugin/*.*
```

### Test CSV URL (Linux/Mac)
```bash
curl -I "YOUR_CSV_URL"
```

### WordPress Debug
Add to `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

---

For help with any checklist items, see:
- **README.md** - Full documentation
- **INSTALLATION.md** - Detailed setup guide
- **QUICK-START.md** - Quick reference

---

**This checklist ensures a professional, secure, and reliable deployment. Complete all items before going live.**
