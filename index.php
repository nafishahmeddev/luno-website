<?php
/**
 * Index Page - Home
 * =================
 */

$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_path = rtrim($request_path, '/');
$route = $request_path === '' ? '/' : basename($request_path);

if ($route === 'privacy') {
  include __DIR__ . '/privacy.php';
  exit;
}

if ($route === 'terms') {
  include __DIR__ . '/terms.php';
  exit;
}

if ($route !== '/' && $route !== 'index.php') {
  http_response_code(404);
}

include_once __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-glow"></div>
  <div class="hero-pill"><span class="hero-pill-dot"></span>Phase 2 — Premium Available</div>
  <h1>Your money.<br><em>Your rules.</em></h1>
  <p class="hero-sub">Luno is a privacy-first personal finance manager. Track every transaction, understand your runway, and keep 100% of your data on your device. Core features are free — unlock advanced analytics with premium.</p>
  <div class="hero-actions">
    <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn-primary">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 12l4 4 4-4M12 8v8"/></svg>
      Download Free
    </a>
    <a href="#features" class="btn-ghost">See Features</a>
  </div>
  <div class="phone-stack">
    <div class="phone-item p1"><img src="<?php echo IMG_URL; ?>/mint_fresh_1.png" alt="Onboarding"/></div>
    <div class="phone-item p2"><img src="<?php echo IMG_URL; ?>/mint_fresh_2.png" alt="Profile"/></div>
    <div class="phone-item p3"><img src="<?php echo IMG_URL; ?>/mint_fresh_3.png" alt="Dashboard"/></div>
    <div class="phone-item p4"><img src="<?php echo IMG_URL; ?>/mint_fresh_4.png" alt="Stats"/></div>
    <div class="phone-item p5"><img src="<?php echo IMG_URL; ?>/mint_fresh_5.png" alt="Transactions"/></div>
  </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
  <div class="stat-item"><div class="stat-n">50+</div><div class="stat-l">Built-in Categories</div></div>
  <div class="stat-item"><div class="stat-n">100%</div><div class="stat-l">Local Storage</div></div>
  <div class="stat-item"><div class="stat-n">0</div><div class="stat-l">Cloud Servers</div></div>
  <div class="stat-item"><div class="stat-n">Free</div><div class="stat-l">+ Premium Option</div></div>
</div>

<!-- FEATURES -->
<div id="features">
<div class="section">
  <div class="section-label">Features</div>
  <h2 class="section-title">Powerful features,<br>built for clarity.</h2>
  <p class="section-sub">Free tier gives you everything you need for transaction tracking. Premium unlocks advanced analytics—choose subscription or lifetime purchase.</p>

  <div class="features-grid">
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
      </div>
      <div class="feat-title">Multi-Account Tracking</div>
      <p class="feat-desc">Track balances across wallets, banks, and cash accounts. See your total net position at a glance.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      </div>
      <div class="feat-title">Advanced Analytics <span style="font-size: 10px; color: var(--accent); text-transform: uppercase; font-weight: 600; margin-left: 8px;">Premium</span></div>
      <p class="feat-desc">Daily burn rate, savings rate, financial runway, and in/out ratio. Filter across 7D, 30D, 90D, or all time.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
      </div>
      <div class="feat-title">50+ Customizable Categories</div>
      <p class="feat-desc">Pre-seeded with categories across Essentials, Transport, Health, Lifestyle, and more. Fully customizable icons and colors.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      </div>
      <div class="feat-title">Precision Transaction Logging</div>
      <p class="feat-desc">Add notes, timestamps, and multi-account links to every transaction. Swipe to edit or delete with automatic balance reversal.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
      <div class="feat-title">100% Local & Private</div>
      <p class="feat-desc">All data stays on your device via SQLite. No account required. No cloud sync. No tracking whatsoever. Your money, your device.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>
      </div>
      <div class="feat-title">Light, Dark & System Themes</div>
      <p class="feat-desc">Full light, dark, and system-adaptive modes. Custom icons and color palettes for every account and category.</p>
    </div>
  </div>
</div>
</div>

<!-- ANALYTICS SPLIT -->
<div id="analytics" class="split">
  <div>
    <div class="section-label">Premium Analytics</div>
    <h2 class="section-title">See what your money tells you.</h2>
    <p class="section-sub">Advanced metrics that reveal your true financial health. Premium features unlock deep insights into your spending and savings patterns.</p>
    <div class="metrics-list">
      <div class="metric-row">
        <span class="metric-name">Avg Daily Burn</span>
        <span class="metric-val red">-₹1,579 / day</span>
      </div>
      <div class="metric-row">
        <span class="metric-name">Savings Rate</span>
        <span class="metric-val">86.5%</span>
      </div>
      <div class="metric-row">
        <span class="metric-name">Financial Runway</span>
        <span class="metric-val">2,357 days</span>
      </div>
      <div class="metric-row">
        <span class="metric-name">In / Out Ratio</span>
        <span class="metric-val">7.41x</span>
      </div>
    </div>
  </div>
  <div class="split-phone">
    <div class="split-glow"></div>
    <div class="split-phone-frame">
      <img src="assets/images/mint_fresh_4.png" alt="Luno Stats Screen"/>
    </div>
  </div>
</div>

<!-- PRIVACY BANNER -->
<div id="privacy-section" class="privacy-banner">
  <div class="section-label" style="text-align:center;">Privacy First</div>
  <h2>Your data never leaves<br>your device.</h2>
  <p>Luno was built local-first from day one. Free or premium, all your financial data is stored exclusively on your device using SQLite. No servers. No accounts. No tracking. Just you and your finances.</p>
  <div class="privacy-chips">
    <div class="chip"><span class="chip-dot"></span>No Cloud Storage</div>
    <div class="chip"><span class="chip-dot"></span>No Account Required</div>
    <div class="chip"><span class="chip-dot"></span>No Analytics SDK</div>
    <div class="chip"><span class="chip-dot"></span>No Ads Ever</div>
    <div class="chip"><span class="chip-dot"></span>SQLite On-Device</div>
  </div>
</div>

<!-- CTA -->
<div id="download" class="cta-section">
  <div class="cta-glow"></div>
  <div class="section-label">Get Started</div>
  <h2 class="section-title">Download today.<br>No account needed.</h2>
  <p>Start tracking for free. Upgrade to premium anytime with a subscription or lifetime purchase.</p>
  <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="playstore-btn">
    <svg class="playstore-icon" viewBox="0 0 24 24" fill="currentColor">
      <path d="M3.18 23.76c.37.2.8.22 1.19.04L15.34 12 4.37.2C3.98.02 3.55.04 3.18.24 2.46.64 2 1.42 2 2.28v19.44c0 .86.46 1.64 1.18 2.04z"/>
      <path d="M20.09 10.27L17.2 8.68 13.6 12l3.6 3.32 2.9-1.59c.83-.45 1.37-1.31 1.37-2.23 0-.92-.54-1.77-1.38-2.23z"/>
      <path d="M4.37.2L15.34 12 4.37 23.8l11.9-6.51L13.6 12l2.67-5.29z" opacity=".6"/>
    </svg>
    Get it on Google Play
  </a>
  <p style="font-size:13px;color:var(--dim);margin-top:20px;font-family:var(--mono);">Android 8.0+ required · Free core features</p>
</div>

<!-- FOOTER -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>
