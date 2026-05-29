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
     HERO
     ════════════════════════════════════ -->
<section class="hero-s">
  <div class="hero-glow-a"></div>
  <div class="hero-glow-b"></div>

  <div class="wrap">
    <div class="hero-inner">

      <!-- Left: text -->
      <div class="anim">
        <span class="badge" style="width:fit-content;margin-bottom:1.75rem">
          <span class="badge-dot"></span>v1.1.0 &mdash; iOS &amp; Android
        </span>
        <h1 class="hero-headline">Your money.<br><em>Your rules.</em></h1>
        <p class="hero-desc">Privacy-first personal finance for iOS and Android. Log transactions, manage accounts in 160+ currencies, and keep every byte on your device. Free for daily tracking — Pro adds analytics, search, and export.</p>
        <div class="hero-ctas">
          <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-primary btn-lg">
            <i class="ph ph-google-play-logo"></i>Google Play
          </a>
          <a href="#features" class="btn btn-ghost btn-lg">See features</a>
        </div>
      </div>

      <!-- Right: phone -->
      <div class="hero-phone-wrap anim d1">
        <div class="hero-phone-glow"></div>
        <div class="hero-phone-glow-2"></div>
        <img src="<?php echo IMG_URL; ?>/mint_fresh_3.png" alt="Luno dashboard" class="hero-phone-img"/>
      </div>

    </div>

    <!-- Stats strip -->
    <div class="stat-row anim d2">
      <div class="stat-card">
        <div class="stat-n">160+</div>
        <div class="stat-l">Currencies</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">44+</div>
        <div class="stat-l">Categories</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">0</div>
        <div class="stat-l">Cloud Servers</div>
      </div>
      <div class="stat-card">
        <div class="stat-n">1&#215;</div>
        <div class="stat-l">Pay. Forever.</div>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     FEATURES BENTO
     ════════════════════════════════════ -->
<section id="features" class="features-s">
  <div class="wrap">
    <div class="feat-bento" style="background:rgba(255,255,255,0.04);border-radius:20px;overflow:hidden">

      <!-- PRIVACY — tall left card, always free -->
      <div class="card fc-privacy anim">
        <div class="fc-priv-icon"><i class="ph ph-lock-key"></i></div>
        <h3 class="fc-priv-title">Your data never leaves your device.</h3>
        <p class="fc-priv-sub">All data encrypted and stored locally via SQLite. No cloud. No account. No tracking. Not even Luno can see it.</p>
        <div class="fc-pills">
          <span class="fc-pill"><span class="fc-pill-dot"></span>No cloud storage</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No account required</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No analytics SDK</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>On-device SQLite</span>
          <span class="fc-pill"><span class="fc-pill-dot"></span>No ads. Ever.</span>
        </div>
      </div>

      <!-- ANALYTICS — wide Pro card -->
      <div class="card fc-analytics anim d1" id="analytics">
        <div class="fca-head">
          <h3 class="fca-title">Understand your money, deeply.</h3>
          <span class="tag">Pro</span>
        </div>
        <p class="fca-sub">Visual charts, behavioral metrics, and period comparisons — one lifetime unlock.</p>
        <div class="metric-table">
          <div class="m-row"><span class="m-key">Daily Burn Rate</span><span class="m-val bad">-&#8377;1,240 / day</span></div>
          <div class="m-row"><span class="m-key">Savings Rate</span><span class="m-val ok">76.3%</span></div>
          <div class="m-row"><span class="m-key">Financial Runway</span><span class="m-val ok">2,180 days</span></div>
          <div class="m-row"><span class="m-key">Active Days</span><span class="m-val ok">28 of 30</span></div>
        </div>
      </div>

      <!-- SEARCH — Pro -->
      <div class="card fc-small fc-search anim">
        <div class="fc-num">Pro</div>
        <div class="fc-icon"><i class="ph ph-magnifying-glass"></i></div>
        <div class="fc-name">Global Search</div>
        <p class="fc-desc">Find any transaction, account, or category instantly across your entire history.</p>
      </div>

      <!-- EXPORT — Pro -->
      <div class="card fc-small fc-export anim d1">
        <div class="fc-num">Pro</div>
        <div class="fc-icon"><i class="ph ph-file-csv"></i></div>
        <div class="fc-name">CSV Export</div>
        <p class="fc-desc">Export filtered transactions to a spreadsheet. Filter by date, account, and type. Save or share.</p>
      </div>

      <!-- MULTI-ACCOUNT -->
      <div class="card fc-small fc-tracking anim d2">
        <div class="fc-num">Free</div>
        <div class="fc-icon"><i class="ph ph-wallet"></i></div>
        <div class="fc-name">Multi-account</div>
        <p class="fc-desc">Unlimited accounts — bank, cash, wallet. 160+ currencies, custom icons and colours.</p>
      </div>

      <!-- CATEGORIES -->
      <div class="card fc-small fc-cats anim">
        <div class="fc-num">Free</div>
        <div class="fc-icon"><i class="ph ph-stack"></i></div>
        <div class="fc-name">44+ Categories</div>
        <p class="fc-desc">44 defaults across Essentials, Food, Transport, Health, and more. Add custom with icons.</p>
      </div>

      <!-- TRANSACTION LOGGING -->
      <div class="card fc-small fc-logging anim d1">
        <div class="fc-num">Free</div>
        <div class="fc-icon"><i class="ph ph-note-pencil"></i></div>
        <div class="fc-name">Transaction logging</div>
        <p class="fc-desc">Log income, expenses, and transfers. Swipe to edit or delete. Grouped by day.</p>
      </div>

      <!-- THEMES -->
      <div class="card fc-small fc-themes anim d2">
        <div class="fc-num">Free</div>
        <div class="fc-icon"><i class="ph ph-palette"></i></div>
        <div class="fc-name">Dark mode + themes</div>
        <p class="fc-desc">Light, dark, and system theme. Custom icons and colours per account and category.</p>
      </div>

      <!-- STREAK & REMINDERS -->
      <div class="card fc-small fc-streaks anim d3">
        <div class="fc-num">Free</div>
        <div class="fc-icon"><i class="ph ph-fire"></i></div>
        <div class="fc-name">Streak &amp; reminders</div>
        <p class="fc-desc">Track daily logging consistency. Set a reminder notification at your preferred time.</p>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     DASHBOARD INSIGHTS (Pro callout)
     ════════════════════════════════════ -->
<section class="insights-s" id="insights">
  <div class="insights-bg-glow"></div>
  <div class="wrap">
    <div class="split split-rev">

      <!-- Left: example insight cards -->
      <div class="insight-stack anim">
        <div class="insight-card">
          <div class="icard-icon" style="background:rgba(245,158,11,0.12);color:var(--warning)">
            <i class="ph ph-trend-up"></i>
          </div>
          <div>
            <div class="icard-title">Spending spike — Food &amp; Dining</div>
            <p class="icard-text">Up 28% vs your 4-week average. You spent &#8377;3,240 more than usual this week.</p>
          </div>
        </div>
        <div class="insight-card">
          <div class="icard-icon" style="background:rgba(14,159,110,0.12);color:var(--success)">
            <i class="ph ph-piggy-bank"></i>
          </div>
          <div>
            <div class="icard-title">Savings rate up 12% this week</div>
            <p class="icard-text">Your 7-day savings rate reached 76% — your best week this month.</p>
          </div>
        </div>
        <div class="insight-card">
          <div class="icard-icon" style="background:rgba(96,165,250,0.12);color:var(--info)">
            <i class="ph ph-calendar-check"></i>
          </div>
          <div>
            <div class="icard-title">Weekly summary ready</div>
            <p class="icard-text">&#8377;14,200 income &middot; &#8377;3,380 spent &middot; &#8377;10,820 saved. Best week in 90 days.</p>
          </div>
        </div>
      </div>

      <!-- Right: text -->
      <div>
        <div class="s-label anim">Luno Pro</div>
        <h2 class="s-title anim d1">Your dashboard,<br>smarter.</h2>
        <p class="s-body anim d2">Dashboard Insights surfaces real-time spending alerts, saving trends, and weekly summaries — right on your home screen. No digging required.</p>
        <ul class="checklist anim d3">
          <li><i class="ph ph-check-circle"></i>Real-time spending spike alerts</li>
          <li><i class="ph ph-check-circle"></i>Saving trend notifications</li>
          <li><i class="ph ph-check-circle"></i>Weekly financial summaries</li>
          <li><i class="ph ph-check-circle"></i>Burn rate + financial runway</li>
          <li><i class="ph ph-check-circle"></i>Period flow &amp; category breakdown</li>
          <li><i class="ph ph-check-circle"></i>Weekday spending heatmap</li>
        </ul>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════
     CTA
     ════════════════════════════════════ -->
<section id="download" class="cta-s">
  <div class="cta-glow"></div>
  <div class="cta-glow-2"></div>
  <div class="wrap cta-inner">
    <div class="cta-eyebrow">One price. Forever.</div>
    <h2 class="cta-title">Free to track.<br><em>Pro to understand.</em></h2>
    <p class="cta-sub">Start with free daily tracking — no account, no cloud, no catch.<br>Upgrade to Pro once. Keep every feature. Every future update.</p>
    <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-primary btn-lg">
      <i class="ph ph-google-play-logo"></i>Get it on Google Play
    </a>
    <p class="cta-note">iOS &amp; Android &middot; Free core features &middot; No subscription</p>
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
