<?php
/**
 * Index Page — Home
 * =================
 */

$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_path = rtrim($request_path, '/');
$route = $request_path === '' ? '/' : basename($request_path);

if ($route === 'privacy') { include __DIR__ . '/privacy.php'; exit; }
if ($route === 'terms')   { include __DIR__ . '/terms.php';   exit; }
if ($route !== '/' && $route !== 'index.php') { http_response_code(404); }

include_once __DIR__ . '/includes/header.php';
?>

<!-- ════════════════════════════════════
     HERO — open, no card boxes
     ════════════════════════════════════ -->
<section class="hero-s">
  <div class="hero-glow-a"></div>
  <div class="hero-glow-b"></div>

  <div class="wrap">
    <div class="hero-inner">

      <!-- Left: text -->
      <div class="anim">
        <span class="badge" style="width:fit-content;margin-bottom:1.75rem">
          <span class="badge-dot"></span>Phase 2 — Premium Available
        </span>
        <h1 class="hero-headline">Your money.<br><em>Your rules.</em></h1>
        <p class="hero-desc">Privacy-first personal finance that lives entirely on your device. Track every transaction, get spending insights, and never share a byte with anyone.</p>
        <div class="hero-ctas">
          <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-primary btn-lg">
            <i class="ph ph-download-simple"></i>Download Free
          </a>
          <a href="#features" class="btn btn-ghost btn-lg">Explore</a>
        </div>
      </div>

      <!-- Right: phone -->
      <div class="hero-phone-wrap anim d1">
        <div class="hero-phone-glow"></div>
        <div class="hero-phone-glow-2"></div>
        <img src="<?php echo IMG_URL; ?>/mint_fresh_3.png" alt="Luno dashboard" class="hero-phone-img"/>
      </div>

    </div>

    <!-- Stats strip — 1px gap grid acts as divider -->
    <div class="stat-row anim d2">
      <div class="stat-card">
        <div class="stat-n">50+</div>
        <div class="stat-l">Categories</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">100%</div>
        <div class="stat-l">Local Storage</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">0</div>
        <div class="stat-l">Cloud Servers</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">&#8734;</div>
        <div class="stat-l">Transactions</div>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     FEATURES BENTO
     1px gaps = visible grid separators
     ════════════════════════════════════ -->
<section id="features" class="features-s">
  <div class="wrap">
    <div class="feat-bento" style="background:rgba(255,255,255,0.04);border-radius:20px;overflow:hidden">

      <!-- PRIVACY — big tall card, primary tinted -->
      <div class="card fc-privacy anim">
        <div class="fc-priv-icon"><i class="ph ph-lock-key"></i></div>
        <h3 class="fc-priv-title">Your data never leaves your phone.</h3>
        <p class="fc-priv-sub">Built local-first from day one. Zero cloud. Zero tracking. Zero compromise. Your financial life belongs to you — literally, physically, on your device.</p>
        <div class="fc-pills">
          <span class="fc-pill"><span class="fc-pill-dot"></span>No Cloud Storage</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No Account Required</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No Analytics SDK</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>SQLite On-Device</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No Ads. Ever.</span>
        </div>
      </div>

      <!-- ANALYTICS — wide card -->
      <div class="card fc-analytics anim d1" id="analytics">
        <div class="fca-head">
          <h3 class="fca-title">See what your money tells you.</h3>
          <span class="tag">Premium</span>
        </div>
        <p class="fca-sub">Advanced metrics that reveal your true financial health — one-time lifetime unlock.</p>
        <div class="metric-table">
          <div class="m-row"><span class="m-key">Avg Daily Burn</span><span class="m-val bad">-&#8377;1,579 / day</span></div>
          <div class="m-row"><span class="m-key">Savings Rate</span><span class="m-val ok">86.5%</span></div>
          <div class="m-row"><span class="m-key">Financial Runway</span><span class="m-val ok">2,357 days</span></div>
          <div class="m-row"><span class="m-key">In / Out Ratio</span><span class="m-val ok">7.41&times;</span></div>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="card fc-small fc-tracking anim">
        <div class="fc-num">01</div>
        <div class="fc-icon"><i class="ph ph-wallet"></i></div>
        <div class="fc-name">Multi-Account Tracking</div>
        <p class="fc-desc">Wallets, banks, and cash — unified. See your net position at a glance.</p>
      </div>

      <div class="card fc-small fc-cats anim d1">
        <div class="fc-num">02</div>
        <div class="fc-icon"><i class="ph ph-stack"></i></div>
        <div class="fc-name">50+ Categories</div>
        <p class="fc-desc">Pre-seeded across Essentials, Transport, Health, and more. Fully customizable.</p>
      </div>

      <div class="card fc-small fc-logging anim d2">
        <div class="fc-num">03</div>
        <div class="fc-icon"><i class="ph ph-note-pencil"></i></div>
        <div class="fc-name">Precision Logging</div>
        <p class="fc-desc">Notes, timestamps, linked accounts. Swipe to edit with auto balance reversal.</p>
      </div>

      <!-- Row 3 -->
      <div class="card fc-small fc-themes anim">
        <div class="fc-num">04</div>
        <div class="fc-icon"><i class="ph ph-palette"></i></div>
        <div class="fc-name">Adaptive Themes</div>
        <p class="fc-desc">Light, dark, system. Custom icons and colors per account and category.</p>
      </div>

      <div class="card fc-small fc-insights anim d1" id="insights">
        <div class="fc-num">05</div>
        <div class="fc-icon"><i class="ph ph-lightbulb"></i></div>
        <div class="fc-name">Smart Insights</div>
        <p class="fc-desc">Spending alerts, runway tracking, savings feedback — right in your dashboard.</p>
      </div>

      <div class="card fc-small fc-reports anim d2">
        <div class="fc-num">06</div>
        <div class="fc-icon"><i class="ph ph-calendar-check"></i></div>
        <div class="fc-name">Weekly &amp; Monthly Reports</div>
        <p class="fc-desc">Full summary views so you always know exactly where your money went.</p>
      </div>

      <div class="card fc-small fc-streaks anim d3">
        <div class="fc-num">07</div>
        <div class="fc-icon"><i class="ph ph-fire"></i></div>
        <div class="fc-name">Streaks &amp; Reminders</div>
        <p class="fc-desc">Consistency tracking and lightweight reminders keep your finances in check.</p>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     INSIGHTS CALLOUT
     ════════════════════════════════════ -->
<section class="insights-s">
  <div class="insights-bg-glow"></div>
  <div class="wrap">
    <div class="split split-rev">

      <div class="insight-stack anim">
        <div class="insight-card">
          <div class="icard-icon" style="background:rgba(245,158,11,0.12);color:var(--warning)">
            <i class="ph ph-trend-up"></i>
          </div>
          <div>
            <div class="icard-title">Spending up 20% this week</div>
            <p class="icard-text">You spent &#8377;3,240 more than your 4-week average. Food &amp; Dining drove the spike.</p>
          </div>
        </div>
        <div class="insight-card">
          <div class="icard-icon" style="background:rgba(14,159,110,0.12);color:var(--success)">
            <i class="ph ph-piggy-bank"></i>
          </div>
          <div>
            <div class="icard-title">You saved &#8377;12,800 this month</div>
            <p class="icard-text">Your savings rate hit 86.5% — the highest in the last 90 days.</p>
          </div>
        </div>
        <div class="insight-card">
          <div class="icard-icon" style="background:var(--primary-dim);color:var(--primary)">
            <i class="ph ph-clock-countdown"></i>
          </div>
          <div>
            <div class="icard-title">Runway extended by 34 days</div>
            <p class="icard-text">Based on current burn rate, you can sustain for 2,357 more days.</p>
          </div>
        </div>
      </div>

      <div>
        <div class="s-label anim">Insights Layer</div>
        <h2 class="s-title anim d1">Your money<br>speaks clearly.</h2>
        <p class="s-body anim d2">Luno surfaces contextual intelligence right inside your dashboard — no digging required. Spending alerts, runway changes, and savings wins, all in plain language.</p>
        <ul class="checklist anim d3">
          <li><i class="ph ph-check-circle"></i>Weekly financial summaries</li>
          <li><i class="ph ph-check-circle"></i>Spending spike alerts</li>
          <li><i class="ph ph-check-circle"></i>Runway increase / decrease tracking</li>
          <li><i class="ph ph-check-circle"></i>Savings feedback in plain language</li>
          <li><i class="ph ph-check-circle"></i>Monthly &amp; weekly report views</li>
          <li><i class="ph ph-check-circle"></i>Usage streaks + consistency reminders</li>
        </ul>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     CTA — big open typography section
     ════════════════════════════════════ -->
<section id="download" class="cta-s">
  <div class="cta-glow"></div>
  <div class="cta-glow-2"></div>
  <div class="wrap cta-inner">
    <div class="cta-eyebrow">Free</div>
    <h2 class="cta-title">Download today.<br><em>No account needed.</em></h2>
    <p class="cta-sub">Start tracking for free. Upgrade to premium anytime<br>with a one-time lifetime purchase.</p>
    <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-primary btn-lg">
      <i class="ph ph-google-play-logo"></i>Get it on Google Play
    </a>
    <p class="cta-note">Android 8.0+ Required &middot; Free Core Features</p>
  </div>
</section>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L39J4VVHHC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-L39J4VVHHC');
</script>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
