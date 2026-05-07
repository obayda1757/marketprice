<?php
/**
 * Dashboard Frontend Template
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div id="mpd-dashboard" data-theme="light">
<div class="mpd-loading-overlay" id="mpdLoadingOverlay">
  <div class="mpd-spinner"></div>
  <div style="color: var(--mpd-text2); font-size: 12px;">Loading market data...</div>
</div>

<div class="mpd-header">
  <div class="mpd-header-left">
    <div class="mpd-header-logo">
      <svg viewBox="0 0 24 24"><path d="M3 3h18v2H3V3zm0 4h12v2H3V7zm0 4h18v2H3v-2zm0 4h12v2H3v-2zm0 4h18v2H3v-2z" fill="white"/></svg>
    </div>
    <div>
      <div class="mpd-header-title">Market Price Dashboard</div>
      <div class="mpd-header-subtitle">Real-time analytics</div>
    </div>
  </div>
  <div class="mpd-header-right">
    <span class="mpd-badge" id="mpdLastUpdated">Loading...</span>
    <button class="mpd-theme-btn" id="mpdThemeToggle">🌙</button>
  </div>
</div>

<div class="mpd-main">
  <div class="mpd-section-label">Overview</div>
  <div class="mpd-cards-grid">
    <div class="mpd-card">
      <div class="mpd-card-icon">📦</div>
      <div class="mpd-card-label">Total Items</div>
      <div class="mpd-card-value" id="mpdStatTotal">—</div>
      <div class="mpd-card-sub" id="mpdStatTotalSub">products</div>
    </div>
    <div class="mpd-card">
      <div class="mpd-card-icon">📅</div>
      <div class="mpd-card-label">Avg Price</div>
      <div class="mpd-card-value" id="mpdStatAvg">—</div>
      <div class="mpd-card-sub" id="mpdStatAvgSub">latest year</div>
    </div>
    <div class="mpd-card">
      <div class="mpd-card-icon">📈</div>
      <div class="mpd-card-label">Highest</div>
      <div class="mpd-card-value" id="mpdStatHigh">—</div>
      <div class="mpd-card-sub" id="mpdStatHighSub">price</div>
    </div>
    <div class="mpd-card">
      <div class="mpd-card-icon">📉</div>
      <div class="mpd-card-label">Lowest</div>
      <div class="mpd-card-value" id="mpdStatLow">—</div>
      <div class="mpd-card-sub" id="mpdStatLowSub">price</div>
    </div>
  </div>

  <div class="mpd-section-label">Filters</div>
  <div class="mpd-filters-bar">
    <div class="mpd-filter-group">
      <span class="mpd-filter-label">Category</span>
      <select class="mpd-filter-select" id="mpdFilterCategory"><option value="">All</option></select>
    </div>
    <div class="mpd-filter-group">
      <span class="mpd-filter-label">Item</span>
      <select class="mpd-filter-select" id="mpdFilterItem"><option value="">All</option></select>
    </div>
    <div class="mpd-filter-group">
      <span class="mpd-filter-label">Year</span>
      <select class="mpd-filter-select" id="mpdFilterYear"><option value="">All</option></select>
    </div>
    <button class="mpd-filter-btn" id="mpdApplyFilters">Apply</button>
    <button class="mpd-filter-btn mpd-secondary" id="mpdResetFilters">Reset</button>
  </div>

  <div class="mpd-section-label">Charts</div>
  <div class="mpd-charts-grid">
    <div class="mpd-chart-card">
      <div class="mpd-chart-header">
        <div>
          <div class="mpd-chart-title">Price Trend</div>
          <div class="mpd-chart-subtitle">Select item to view</div>
        </div>
        <button class="mpd-icon-btn" id="mpdExportLine">⬇</button>
      </div>
      <select class="mpd-filter-select" id="mpdTrendItem" style="margin-bottom:8px;max-width:100%;"><option value="">Select Item</option></select>
      <div class="mpd-chart-wrap"><canvas id="mpdLineChart"></canvas></div>
    </div>

    <div class="mpd-chart-card">
      <div class="mpd-chart-header">
        <div>
          <div class="mpd-chart-title">Price by Category</div>
          <div class="mpd-chart-subtitle" id="mpdBarSubtitle">Latest year</div>
        </div>
        <button class="mpd-icon-btn" id="mpdExportBar">⬇</button>
      </div>
      <select class="mpd-filter-select" id="mpdBarYear" style="margin-bottom:8px;max-width:100%;"><option value="">All Years</option></select>
      <div class="mpd-chart-wrap"><canvas id="mpdBarChart"></canvas></div>
    </div>

    <div class="mpd-chart-card mpd-full">
      <div class="mpd-chart-header">
        <div>
          <div class="mpd-chart-title">Multi-Item Comparison</div>
          <div class="mpd-chart-subtitle">Select up to 6 items</div>
        </div>
        <button class="mpd-icon-btn" id="mpdExportMulti">⬇</button>
      </div>
      <div class="mpd-multi-select-wrap" id="mpdMultiItemSelect"></div>
      <div class="mpd-chart-wrap" style="height:280px;"><canvas id="mpdMultiLineChart"></canvas></div>
    </div>
  </div>
</div>

</div>
