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
      <i class="ph ph-download-simple" aria-hidden="true"></i>
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
  <p class="section-sub">Free tier gives you everything you need for transaction tracking. Premium unlocks advanced analytics with a one-time lifetime purchase.</p>

  <div class="features-grid">
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-wallet" aria-hidden="true"></i>
      </div>
      <div class="feat-title">Multi-Account Tracking</div>
      <p class="feat-desc">Track balances across wallets, banks, and cash accounts. See your total net position at a glance.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-chart-line-up" aria-hidden="true"></i>
      </div>
      <div class="feat-title">Advanced Analytics <span style="font-size: 10px; color: var(--accent); text-transform: uppercase; font-weight: 600; margin-left: 8px;">Premium</span></div>
      <p class="feat-desc">Daily burn rate, savings rate, financial runway, and in/out ratio. Filter across 7D, 30D, 90D, or all time.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-stack" aria-hidden="true"></i>
      </div>
      <div class="feat-title">50+ Customizable Categories</div>
      <p class="feat-desc">Pre-seeded with categories across Essentials, Transport, Health, Lifestyle, and more. Fully customizable icons and colors.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-note-pencil" aria-hidden="true"></i>
      </div>
      <div class="feat-title">Precision Transaction Logging</div>
      <p class="feat-desc">Add notes, timestamps, and multi-account links to every transaction. Swipe to edit or delete with automatic balance reversal.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-shield-check" aria-hidden="true"></i>
      </div>
      <div class="feat-title">100% Local & Private</div>
      <p class="feat-desc">All data stays on your device via SQLite. No account required. No cloud sync. No tracking whatsoever. Your money, your device.</p>
    </div>
    <div class="feat-card">
      <div class="feat-icon">
        <i class="ph ph-palette" aria-hidden="true"></i>
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
  <p>Start tracking for free. Upgrade to premium anytime with a one-time lifetime purchase.</p>
  <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="playstore-btn">
    <i class="ph ph-google-play-logo playstore-icon" aria-hidden="true"></i>
    Get it on Google Play
  </a>
  <p style="font-size:13px;color:var(--dim);margin-top:20px;font-family:var(--mono);">Android 8.0+ required · Free core features</p>
</div>

<!-- FOOTER -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>
