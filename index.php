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

<!-- ── HERO ── -->
<section class="relative overflow-hidden" style="padding: 6rem 0 5rem;">
    <div class="glow absolute -top-40 left-1/2 -translate-x-1/2" style="width:900px;height:600px;"></div>
    <div class="absolute inset-0 pointer-events-none"
        style="background-image:linear-gradient(color-mix(in srgb,var(--primary) 3%,transparent) 1px,transparent 1px),linear-gradient(90deg,color-mix(in srgb,var(--primary) 3%,transparent) 1px,transparent 1px);background-size:60px 60px;">
    </div>

    <div class="hero-grid max-w-[1100px] mx-auto px-6 grid grid-cols-2 gap-14 items-center relative z-10">
        <div>
            <div class="pill anim anim-d1 mb-7"><span class="pill-dot"></span>Phase 2 — Premium Available</div>
            <h1 class="hero-title anim anim-d2 mb-6">Your money.<br><em>Your rules.</em></h1>
            <p class="anim anim-d3 mb-9 leading-[1.8]" style="font-size:16px;color:var(--muted);max-width:420px;">
                Luno is a privacy-first personal finance manager. Track every transaction, get weekly spending insights,
                and keep 100% of your data on-device. Core features are free — advanced analytics unlocked with
                premium.
            </p>
            <div class="flex gap-3 flex-wrap anim anim-d4">
                <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-fill btn-md">
                    <i class="ph ph-download-simple"></i>Download Free
                </a>
                <a href="#features" class="btn btn-ghost btn-md">See Features</a>
            </div>
        </div>

        <div class="phone-wrap relative anim anim-d5" style="height:480px;">
            <div class="glow absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full"
                style="width:340px;height:340px;"></div>
            <div class="phone-item p1"><img src="<?php echo IMG_URL; ?>/mint_fresh_1.png" alt="Onboarding"/></div>
            <div class="phone-item p2"><img src="<?php echo IMG_URL; ?>/mint_fresh_2.png" alt="Profile"/></div>
            <div class="phone-item p3"><img src="<?php echo IMG_URL; ?>/mint_fresh_3.png" alt="Dashboard"/></div>
            <div class="phone-item p4"><img src="<?php echo IMG_URL; ?>/mint_fresh_4.png" alt="Analytics"/></div>
            <div class="phone-item p5"><img src="<?php echo IMG_URL; ?>/mint_fresh_5.png" alt="Transactions"/></div>
        </div>
    </div>
</section>

<!-- ── STATS ── -->
<div class="div-line"></div>
<div style="background:var(--card);">
    <div class="stats-grid max-w-[1100px] mx-auto px-6 py-8 grid grid-cols-4 gap-4">
        <div class="stat-card anim">
            <div class="stat-n">50+</div>
            <div class="stat-l">Categories</div>
        </div>
        <div class="stat-card anim anim-d2">
            <div class="stat-n">100%</div>
            <div class="stat-l">Local Storage</div>
        </div>
        <div class="stat-card anim anim-d3">
            <div class="stat-n">0</div>
            <div class="stat-l">Cloud Servers</div>
        </div>
        <div class="stat-card anim anim-d4">
            <div class="stat-n">Free</div>
            <div class="stat-l">+ Premium</div>
        </div>
    </div>
</div>
<div class="div-line"></div>

<!-- ── FEATURES ── -->
<section id="features" style="padding: 6rem 0;">
    <div class="max-w-[1100px] mx-auto px-6">
        <div class="anim mb-4">
            <div class="sec-label">Features</div>
        </div>
        <h2 class="anim anim-d2 font-extrabold c-text mb-3"
            style="font-size:clamp(28px,4vw,46px);line-height:1.1;letter-spacing:-0.03em;">Everything you
            need.<br>Nothing you don't.</h2>
        <p class="anim anim-d3 c-muted mb-12 max-w-[500px] leading-relaxed" style="font-size:15px;">Free tier covers
            daily tracking. Premium unlocks analytics with a one-time lifetime purchase.</p>

        <div class="feat-grid grid grid-cols-3 gap-3">
            <div class="feat-card anim"><span class="feat-idx">01</span>
                <div class="feat-icon"><i class="ph ph-wallet"></i></div>
                <div class="feat-title">Multi-Account Tracking</div>
                <p class="feat-desc">Track balances across wallets, banks, and cash. See your total net position at a glance.</p>
            </div>
            <div class="feat-card anim anim-d2"><span class="feat-idx">02</span>
                <div class="feat-icon"><i class="ph ph-chart-line-up"></i></div>
                <div class="feat-title">Advanced Analytics<span class="feat-badge">Premium</span></div>
                <p class="feat-desc">Daily burn rate, savings rate, runway, and in/out ratio. Filter 7D · 30D · 90D · all time.</p>
            </div>
            <div class="feat-card anim anim-d3"><span class="feat-idx">03</span>
                <div class="feat-icon"><i class="ph ph-stack"></i></div>
                <div class="feat-title">50+ Categories</div>
                <p class="feat-desc">Pre-seeded across Essentials, Transport, Health, Lifestyle, and more. Fully customizable.</p>
            </div>
            <div class="feat-card anim"><span class="feat-idx">04</span>
                <div class="feat-icon"><i class="ph ph-note-pencil"></i></div>
                <div class="feat-title">Precision Logging</div>
                <p class="feat-desc">Notes, timestamps, multi-account links per transaction. Swipe to edit with auto balance reversal.</p>
            </div>
            <div class="feat-card anim anim-d2"><span class="feat-idx">05</span>
                <div class="feat-icon"><i class="ph ph-shield-check"></i></div>
                <div class="feat-title">100% Local &amp; Private</div>
                <p class="feat-desc">All data on-device via SQLite. No account. No cloud. No tracking. Your money, your device.</p>
            </div>
            <div class="feat-card anim anim-d3"><span class="feat-idx">06</span>
                <div class="feat-icon"><i class="ph ph-palette"></i></div>
                <div class="feat-title">Adaptive Themes</div>
                <p class="feat-desc">Light, dark, and system modes. Custom icons and color palettes per account and category.</p>
            </div>
            <div class="feat-card anim"><span class="feat-idx">07</span>
                <div class="feat-icon"><i class="ph ph-lightbulb"></i></div>
                <div class="feat-title">Smart Insights</div>
                <p class="feat-desc">Spending alerts, runway tracking, savings feedback — contextual cards right inside your dashboard.</p>
            </div>
            <div class="feat-card anim anim-d2"><span class="feat-idx">08</span>
                <div class="feat-icon"><i class="ph ph-calendar-check"></i></div>
                <div class="feat-title">Weekly &amp; Monthly Reports</div>
                <p class="feat-desc">Full summary and review views so you always know exactly where your money went.</p>
            </div>
            <div class="feat-card anim anim-d3"><span class="feat-idx">09</span>
                <div class="feat-icon"><i class="ph ph-fire"></i></div>
                <div class="feat-title">Streaks &amp; Reminders</div>
                <p class="feat-desc">Consistency tracking and lightweight reminders keep you logging and on top of your finances.</p>
            </div>
        </div>
    </div>
</section>

<div class="div-line"></div>

<!-- ── ANALYTICS SPLIT ── -->
<section id="analytics" style="padding: 6rem 0;">
    <div class="split-grid max-w-[1100px] mx-auto px-6 grid grid-cols-2 gap-16 items-center">
        <div>
            <div class="anim mb-4">
                <div class="sec-label">Premium Analytics</div>
            </div>
            <h2 class="anim anim-d2 font-extrabold c-text mb-3"
                style="font-size:clamp(26px,3.5vw,42px);line-height:1.1;letter-spacing:-0.03em;">See what
                your<br>money tells you.</h2>
            <p class="anim anim-d3 c-muted leading-relaxed mb-8" style="font-size:15px;">Advanced metrics that
                reveal your true financial health — one-time lifetime unlock.</p>
            <div class="anim anim-d4 rounded-2xl overflow-hidden" style="border:1px solid var(--surface);">
                <div class="metric-row"><span class="metric-name">Avg Daily Burn</span><span class="metric-val dr">-&#8377;1,579 / day</span></div>
                <div class="metric-row"><span class="metric-name">Savings Rate</span><span class="metric-val">86.5%</span></div>
                <div class="metric-row"><span class="metric-name">Financial Runway</span><span class="metric-val">2,357 days</span></div>
                <div class="metric-row"><span class="metric-name">In / Out Ratio</span><span class="metric-val">7.41&times;</span></div>
            </div>
        </div>

        <div class="flex items-center justify-center relative anim anim-d2">
            <div class="glow absolute rounded-full" style="width:300px;height:300px;"></div>
            <div class="relative z-10"
                style="width:224px;border-radius:32px;overflow:hidden;border:1px solid var(--surface);box-shadow:0 40px 100px rgba(0,0,0,0.65);">
                <img src="<?php echo IMG_URL; ?>/mint_fresh_4.png" alt="Analytics screen" class="block w-full"/>
            </div>
        </div>
    </div>
</section>

<div class="div-line"></div>

<!-- ── INSIGHTS SPLIT ── -->
<section id="insights" style="padding: 6rem 0;">
    <div class="split-grid max-w-[1100px] mx-auto px-6 grid grid-cols-2 gap-16 items-center">

        <!-- insight cards mockup -->
        <div class="anim flex flex-col gap-3 relative">
            <div class="glow absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full"
                style="width:280px;height:280px;opacity:0.7;"></div>
            <div class="insight-card relative z-10">
                <div class="insight-icon warn"><i class="ph ph-trend-up"></i></div>
                <div>
                    <div class="insight-title">Spending up 20% this week</div>
                    <div class="insight-sub">You spent &#8377;3,240 more than your 4-week average. Food &amp; Dining drove the spike.</div>
                </div>
            </div>
            <div class="insight-card relative z-10">
                <div class="insight-icon ok"><i class="ph ph-piggy-bank"></i></div>
                <div>
                    <div class="insight-title">You saved &#8377;12,800 this month</div>
                    <div class="insight-sub">Your savings rate hit 86.5% — the highest in the last 90 days.</div>
                </div>
            </div>
            <div class="insight-card relative z-10">
                <div class="insight-icon info"><i class="ph ph-clock-countdown"></i></div>
                <div>
                    <div class="insight-title">Runway extended by 34 days</div>
                    <div class="insight-sub">Based on current burn rate, you can sustain for 2,357 more days.</div>
                </div>
            </div>
        </div>

        <div>
            <div class="anim mb-4">
                <div class="sec-label">Insights Layer</div>
            </div>
            <h2 class="anim anim-d2 font-extrabold c-text mb-3"
                style="font-size:clamp(26px,3.5vw,42px);line-height:1.1;letter-spacing:-0.03em;">Your
                money<br>speaks clearly.</h2>
            <p class="anim anim-d3 c-muted leading-relaxed mb-6" style="font-size:15px;">Luno surfaces contextual
                intelligence right inside your dashboard — no digging required. Spending alerts, runway changes, and
                savings wins, all in plain language.</p>
            <ul class="anim anim-d4 flex flex-col gap-3" style="list-style:none;">
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Weekly financial summaries</li>
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Spending spike alerts</li>
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Runway increase / decrease tracking</li>
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Savings feedback in plain language</li>
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Monthly &amp; weekly report views</li>
                <li class="flex items-center gap-3 t-sm c-muted"><i class="ph ph-check-circle c-primary" style="font-size:17px;flex-shrink:0;"></i>Usage streaks + consistency reminders</li>
            </ul>
        </div>
    </div>
</section>

<div class="div-line"></div>

<!-- ── PRIVACY ── -->
<section id="privacy" class="relative overflow-hidden text-center" style="padding: 7rem 0;">
    <!-- large bg wordmark -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none" style="overflow:hidden;">
        <span style="font-family:'JetBrains Mono',monospace;font-weight:700;font-size:clamp(120px,22vw,260px);letter-spacing:0.15em;color:var(--surface);line-height:1;user-select:none;">LUNO</span>
    </div>
    <div class="glow absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="width:700px;height:400px;"></div>

    <div class="max-w-[1100px] mx-auto px-6 relative z-10">
        <div class="anim flex justify-center mb-5">
            <div class="sec-label" style="justify-content:center;">Privacy First</div>
        </div>
        <h2 class="anim anim-d2 font-extrabold c-text mb-5"
            style="font-size:clamp(28px,4.5vw,54px);line-height:1.1;letter-spacing:-0.03em;">Your data
            never<br>leaves your device.</h2>
        <p class="anim anim-d3 c-muted leading-relaxed max-w-[480px] mx-auto mb-10" style="font-size:15px;">Built
            local-first from day one. Your financial data lives exclusively in SQLite on your device — free or
            premium. No servers. No accounts. No trackers. Full stop.</p>
        <div class="anim anim-d4 flex flex-wrap gap-3 justify-center">
            <div class="chip"><span class="chip-dot"></span>No Cloud Storage</div>
            <div class="chip"><span class="chip-dot"></span>No Account Required</div>
            <div class="chip"><span class="chip-dot"></span>No Analytics SDK</div>
            <div class="chip"><span class="chip-dot"></span>No Ads Ever</div>
            <div class="chip"><span class="chip-dot"></span>SQLite On-Device</div>
        </div>
    </div>
</section>

<div class="div-line"></div>

<!-- ── CTA ── -->
<section id="download" class="relative overflow-hidden text-center" style="padding:7rem 0;">
    <div class="glow absolute bottom-0 left-1/2 -translate-x-1/2" style="width:700px;height:500px;"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2"
        style="width:120px;height:2px;background:var(--primary);opacity:0.6;border-radius:999px;"></div>

    <div class="max-w-[1100px] mx-auto px-6 relative z-10">
        <div class="anim flex justify-center mb-5">
            <div class="sec-label" style="justify-content:center;">Get Started</div>
        </div>
        <h2 class="anim anim-d2 font-extrabold c-text mb-4"
            style="font-size:clamp(32px,5vw,62px);line-height:1.05;letter-spacing:-0.04em;">Download today.<br>No
            account needed.</h2>
        <p class="anim anim-d3 c-muted leading-relaxed mb-10" style="font-size:15px;">Start tracking for free.
            Upgrade to premium anytime with a one-time lifetime purchase.</p>
        <div class="anim anim-d4">
            <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="btn btn-fill btn-lg"
                style="display:inline-flex;">
                <i class="ph ph-google-play-logo" style="font-size:21px;"></i>
                Get it on Google Play
            </a>
        </div>
        <p class="anim anim-d4 font-mono mt-5"
            style="font-size:10px;color:var(--dim);letter-spacing:0.14em;text-transform:uppercase;">Android 8.0+
            Required &middot; Free Core Features</p>
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
