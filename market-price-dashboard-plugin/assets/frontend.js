/**
 * Market Price Dashboard - Frontend Script
 */

(function() {
  const dashboard = document.getElementById('mpd-dashboard');
  if (!dashboard) return;

  const CSV_URL = mpdFrontend.csv_url;
  let allData = [], filteredData = [];
  let lineChart, barChart, multiLineChart;
  const COLORS = ['#0ea5e9','#10b981','#f59e0b','#ef4444','#06b6d4','#8b5cf6','#f97316','#84cc16'];

  function parseCSV(text) {
    const lines = text.trim().split('\n');
    if (lines.length < 2) return [];
    const headers = lines[0].split(',').map(h => h.trim().replace(/^"|"$/g, '').toLowerCase());
    const rows = [];
    for (let i = 1; i < lines.length; i++) {
      const cols = splitCSVLine(lines[i]);
      if (cols.every(c => !c.trim())) continue;
      const row = {};
      headers.forEach((h, idx) => {
        row[h] = (cols[idx] || '').replace(/^"|"$/g, '').trim();
      });
      const price = parseFloat(row.price);
      row.price = isNaN(price) ? null : price;
      const year = parseInt(row.year);
      row.year = isNaN(year) ? null : year;
      rows.push(row);
    }
    return rows.filter(r => r.item && r.price !== null && r.year !== null);
  }

  function splitCSVLine(line) {
    const result = [];
    let cur = '', inQ = false;
    for (let i = 0; i < line.length; i++) {
      const c = line[i];
      if (c === '"') { inQ = !inQ; continue; }
      if (c === ',' && !inQ) { result.push(cur); cur = ''; continue; }
      cur += c;
    }
    result.push(cur);
    return result;
  }

  async function loadData() {
    try {
      const res = await fetch(CSV_URL);
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const text = await res.text();
      allData = parseCSV(text);
      if (!allData.length) throw new Error('No data found');
      init();
    } catch (err) {
      console.error(err);
      const overlay = dashboard.querySelector('.mpd-loading-overlay');
      overlay.innerHTML = `<div style="text-align:center;color:var(--mpd-text2);padding:40px 20px"><div style="font-size:28px;margin-bottom:12px">⚠️</div><div style="font-weight:600">Failed to load data</div><div style="font-size:11px;opacity:0.7;margin-top:8px">${err.message}</div></div>`;
    }
  }

  function init() {
    filteredData = [...allData];
    populateFilters();
    updateSummaryCards(allData);
    renderLineChart();
    renderBarChart();
    renderMultiLineChart();
    bindEvents();
    dashboard.querySelector('#mpdLastUpdated').textContent = `${allData.length} records`;
    hideLoading();
  }

  function hideLoading() {
    const el = dashboard.querySelector('.mpd-loading-overlay');
    el.style.opacity = '0';
    el.style.pointerEvents = 'none';
  }

  function populateFilters() {
    const cats = [...new Set(allData.map(r => r.category).filter(Boolean))].sort();
    const items = [...new Set(allData.map(r => r.item).filter(Boolean))].sort();
    const years = [...new Set(allData.map(r => r.year).filter(Boolean))].sort((a,b)=>a-b);

    fillSelect('mpdFilterCategory', cats);
    fillSelect('mpdFilterItem', items);
    fillSelect('mpdFilterYear', years);
    fillSelect('mpdTrendItem', items);
    fillSelect('mpdBarYear', years);

    const wrap = dashboard.querySelector('#mpdMultiItemSelect');
    wrap.innerHTML = items.slice(0, 25).map(it => `<span class="mpd-item-chip" data-item="${it}">${it}</span>`).join('');
    wrap.querySelectorAll('.mpd-item-chip').forEach(chip => {
      chip.addEventListener('click', () => {
        const active = wrap.querySelectorAll('.mpd-item-chip.active');
        if (!chip.classList.contains('active') && active.length >= 6) return;
        chip.classList.toggle('active');
        renderMultiLineChart();
      });
    });
  }

  function fillSelect(id, opts) {
    const sel = dashboard.querySelector(`#${id}`);
    while (sel.options.length > 1) sel.remove(1);
    opts.forEach(v => {
      const o = document.createElement('option');
      o.value = v;
      o.textContent = v;
      sel.appendChild(o);
    });
  }

  function applyFilters() {
    const cat = dashboard.querySelector('#mpdFilterCategory').value;
    const item = dashboard.querySelector('#mpdFilterItem').value;
    const year = dashboard.querySelector('#mpdFilterYear').value;

    filteredData = allData.filter(r => {
      if (cat && r.category !== cat) return false;
      if (item && r.item !== item) return false;
      if (year && r.year !== parseInt(year)) return false;
      return true;
    });

    updateSummaryCards(filteredData);
    renderBarChart();
  }

  function resetFilters() {
    dashboard.querySelector('#mpdFilterCategory').value = '';
    dashboard.querySelector('#mpdFilterItem').value = '';
    dashboard.querySelector('#mpdFilterYear').value = '';
    filteredData = [...allData];
    updateSummaryCards(allData);
    renderBarChart();
  }

  function updateSummaryCards(data) {
    const items = [...new Set(data.map(r => r.item))];
    const years = [...new Set(data.map(r => r.year))].sort((a,b)=>b-a);
    const latestYear = years[0];
    const latestData = data.filter(r => r.year === latestYear);
    const avgLatest = latestData.length ? latestData.reduce((s,r) => s + r.price, 0) / latestData.length : 0;
    const prices = data.filter(r => r.price !== null).sort((a,b) => b.price - a.price);
    const highest = prices[0];
    const lowest = prices[prices.length - 1];

    dashboard.querySelector('#mpdStatTotal').textContent = items.length;
    dashboard.querySelector('#mpdStatTotalSub').textContent = `${data.length} records`;
    dashboard.querySelector('#mpdStatAvg').textContent = avgLatest ? formatPrice(avgLatest) : '—';
    dashboard.querySelector('#mpdStatAvgSub').textContent = latestYear ? `Year ${latestYear}` : 'n/a';
    dashboard.querySelector('#mpdStatHigh').textContent = highest ? formatPrice(highest.price) : '—';
    dashboard.querySelector('#mpdStatHighSub').textContent = highest ? highest.item.substring(0,15) : '—';
    dashboard.querySelector('#mpdStatLow').textContent = lowest ? formatPrice(lowest.price) : '—';
    dashboard.querySelector('#mpdStatLowSub').textContent = lowest ? lowest.item.substring(0,15) : '—';
  }

  function renderLineChart() {
    const selectedItem = dashboard.querySelector('#mpdTrendItem').value;
    const ctx = dashboard.querySelector('#mpdLineChart').getContext('2d');
    if (lineChart) lineChart.destroy();

    if (!selectedItem) {
      ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
      return;
    }

    const itemData = allData.filter(r => r.item === selectedItem && r.price !== null && r.year !== null).sort((a,b) => a.year - b.year);
    if (!itemData.length) return;

    const labels = itemData.map(r => r.year);
    const prices = itemData.map(r => r.price);

    lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: selectedItem,
          data: prices,
          borderColor: COLORS[0],
          backgroundColor: hexToRgba(COLORS[0], 0.1),
          fill: true,
          tension: 0.4,
          pointRadius: 4,
          borderWidth: 2
        }]
      },
      options: chartOptions()
    });
  }

  function renderBarChart() {
    const selectedYear = dashboard.querySelector('#mpdBarYear').value;
    const ctx = dashboard.querySelector('#mpdBarChart').getContext('2d');
    if (barChart) barChart.destroy();

    const data = selectedYear ? filteredData.filter(r => r.year === parseInt(selectedYear)) : filteredData;
    dashboard.querySelector('#mpdBarSubtitle').textContent = selectedYear ? `Year ${selectedYear}` : 'All years';

    const catMap = {};
    data.forEach(r => {
      if (!r.category || r.price === null) return;
      if (!catMap[r.category]) catMap[r.category] = [];
      catMap[r.category].push(r.price);
    });

    const cats = Object.keys(catMap).sort();
    if (!cats.length) return;

    const avgs = cats.map(c => catMap[c].reduce((s,v) => s+v, 0) / catMap[c].length);

    barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: cats,
        datasets: [{
          label: 'Avg Price',
          data: avgs,
          backgroundColor: cats.map((_, i) => hexToRgba(COLORS[i % COLORS.length], 0.8)),
          borderColor: cats.map((_, i) => COLORS[i % COLORS.length]),
          borderWidth: 1
        }]
      },
      options: chartOptions()
    });
  }

  function renderMultiLineChart() {
    const selected = [...dashboard.querySelectorAll('.mpd-item-chip.active')].map(c => c.dataset.item);
    const ctx = dashboard.querySelector('#mpdMultiLineChart').getContext('2d');
    if (multiLineChart) multiLineChart.destroy();

    if (!selected.length) return;

    const allYears = [...new Set(allData.map(r => r.year).filter(Boolean))].sort((a,b)=>a-b);
    const datasets = selected.map((item, idx) => {
      const yearMap = {};
      allData.filter(r => r.item === item && r.price !== null && r.year !== null).forEach(r => { yearMap[r.year] = r.price; });
      return {
        label: item,
        data: allYears.map(y => yearMap[y] ?? null),
        borderColor: COLORS[idx % COLORS.length],
        tension: 0.4,
        pointRadius: 3,
        borderWidth: 2
      };
    });

    multiLineChart = new Chart(ctx, {
      type: 'line',
      data: { labels: allYears, datasets },
      options: { ...chartOptions(), plugins: { ...chartOptions().plugins, legend: { display: true, position: 'top' } } }
    });
  }

  function chartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    };
  }

  function formatPrice(v) {
    if (v === null || isNaN(v)) return '—';
    return new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }).format(v);
  }

  function hexToRgba(hex, alpha) {
    const r = parseInt(hex.slice(1,3), 16);
    const g = parseInt(hex.slice(3,5), 16);
    const b = parseInt(hex.slice(5,7), 16);
    return `rgba(${r},${g},${b},${alpha})`;
  }

  function bindEvents() {
    dashboard.querySelector('#mpdApplyFilters').addEventListener('click', applyFilters);
    dashboard.querySelector('#mpdResetFilters').addEventListener('click', resetFilters);
    dashboard.querySelector('#mpdThemeToggle').addEventListener('click', () => {
      const isDark = dashboard.getAttribute('data-theme') === 'dark';
      dashboard.setAttribute('data-theme', isDark ? 'light' : 'dark');
      dashboard.querySelector('#mpdThemeToggle').textContent = isDark ? '🌙' : '☀️';
    });
    dashboard.querySelector('#mpdTrendItem').addEventListener('change', renderLineChart);
    dashboard.querySelector('#mpdBarYear').addEventListener('change', renderBarChart);
    dashboard.querySelector('#mpdExportLine').addEventListener('click', () => exportChart(lineChart));
    dashboard.querySelector('#mpdExportBar').addEventListener('click', () => exportChart(barChart));
    dashboard.querySelector('#mpdExportMulti').addEventListener('click', () => exportChart(multiLineChart));
  }

  function exportChart(chartInstance) {
    if (!chartInstance) return;
    const link = document.createElement('a');
    link.href = chartInstance.toBase64Image();
    link.download = 'chart.png';
    link.click();
  }

  loadData();
})();
