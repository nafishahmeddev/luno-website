<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Luno — Launch Marketing Kit</title>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
  --bg:#0A0F07;
  --bg2:#0f1a0a;
  --bg3:#141C0C;
  --card:#18220F;
  --border:rgba(134,197,60,0.12);
  --border2:rgba(134,197,60,0.25);
  --accent:#86C53C;
  --accent-dim:rgba(134,197,60,0.08);
  --text:#EDF3E0;
  --muted:rgba(237,243,224,0.55);
  --dim:rgba(237,243,224,0.25);
  --red:#FF5C4A;
  --blue:#4A9EFF;
  --orange:#FF8C4A;
  --purple:#9B6EFF;
  --mono:'JetBrains Mono',monospace;
  --sans:'Bricolage Grotesque',sans-serif;
}
html{scroll-behavior:smooth;}
body{background:var(--bg);color:var(--text);font-family:var(--sans);font-size:15px;line-height:1.65;-webkit-font-smoothing:antialiased;}

/* NAV */
nav{position:sticky;top:0;z-index:100;background:rgba(10,15,7,0.97);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);padding:0 40px;height:56px;display:flex;align-items:center;justify-content:space-between;}
.nav-logo{font-family:var(--mono);font-size:15px;font-weight:600;letter-spacing:0.06em;}
.nav-logo span{color:var(--accent);}
.nav-tabs{display:flex;gap:6px;}
.nav-tab{font-family:var(--mono);font-size:10px;font-weight:500;letter-spacing:0.06em;text-transform:uppercase;padding:5px 12px;border-radius:6px;cursor:pointer;color:var(--muted);border:1px solid transparent;transition:all .15s;text-decoration:none;}
.nav-tab:hover{color:var(--text);border-color:var(--border);}
.nav-tab.active{color:var(--accent);border-color:var(--border2);background:var(--accent-dim);}

/* LAYOUT */
.layout{display:grid;grid-template-columns:220px 1fr;min-height:100vh;}
.sidebar{border-right:1px solid var(--border);padding:28px 0;position:sticky;top:56px;height:calc(100vh - 56px);overflow-y:auto;}
.sidebar-group{margin-bottom:24px;}
.sidebar-label{font-family:var(--mono);font-size:9px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--dim);padding:0 20px;margin-bottom:8px;}
.sidebar-link{display:flex;align-items:center;gap:10px;padding:8px 20px;font-size:13px;color:var(--muted);cursor:pointer;transition:all .15s;text-decoration:none;border-left:2px solid transparent;}
.sidebar-link:hover{color:var(--text);background:var(--accent-dim);}
.sidebar-link.active{color:var(--accent);border-left-color:var(--accent);background:var(--accent-dim);}
.platform-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}

/* MAIN */
main{padding:40px 48px;max-width:860px;}
.page{display:none;}
.page.active{display:block;}

/* SECTION HEADERS */
.page-title{font-size:32px;font-weight:800;letter-spacing:-0.03em;margin-bottom:8px;}
.page-sub{font-size:15px;color:var(--muted);margin-bottom:40px;line-height:1.6;}

.platform-header{display:flex;align-items:center;gap:14px;margin:48px 0 24px;}
.platform-header:first-child{margin-top:0;}
.platform-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;}
.platform-title{font-size:20px;font-weight:700;letter-spacing:-0.02em;}
.platform-meta{font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:0.05em;margin-top:2px;}

/* POST CARDS */
.post-card{background:var(--card);border:1px solid var(--border);border-radius:12px;margin-bottom:16px;overflow:hidden;}
.post-card-head{display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-bottom:1px solid var(--border);background:var(--bg3);}
.post-label{font-family:var(--mono);font-size:10px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);}
.copy-btn{font-family:var(--mono);font-size:10px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;background:var(--accent-dim);color:var(--accent);border:1px solid var(--border2);border-radius:5px;padding:4px 12px;cursor:pointer;transition:all .15s;}
.copy-btn:hover{background:var(--accent);color:#0A0F07;}
.copy-btn.copied{background:rgba(74,232,122,0.15);color:#4AE87A;border-color:rgba(74,232,122,0.3);}
.post-body{padding:18px 20px;}
.post-text{font-size:14px;line-height:1.75;color:var(--text);white-space:pre-wrap;word-break:break-word;}
.post-tags{margin-top:12px;padding-top:12px;border-top:1px solid var(--border);}
.post-tags-label{font-family:var(--mono);font-size:9px;color:var(--dim);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:8px;}
.tags-row{display:flex;flex-wrap:wrap;gap:6px;}
.tag{font-family:var(--mono);font-size:11px;color:var(--accent);background:var(--accent-dim);border:1px solid var(--border2);border-radius:4px;padding:2px 8px;}
.char-count{font-family:var(--mono);font-size:10px;color:var(--dim);margin-top:8px;}
.char-count span{color:var(--accent);}

/* THUMB SPECS */
.thumb-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:20px 24px;margin-bottom:16px;}
.thumb-title{font-size:15px;font-weight:700;margin-bottom:4px;}
.thumb-sub{font-size:13px;color:var(--muted);margin-bottom:16px;}
.spec-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.spec-row{background:var(--bg3);border-radius:8px;padding:10px 14px;}
.spec-key{font-family:var(--mono);font-size:9px;color:var(--dim);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;}
.spec-val{font-size:13px;color:var(--text);font-weight:600;}
.copy-block{background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:14px 16px;margin-top:14px;cursor:pointer;position:relative;transition:border-color .15s;}
.copy-block:hover{border-color:var(--border2);}
.copy-block-label{font-family:var(--mono);font-size:9px;color:var(--dim);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:8px;display:flex;justify-content:space-between;align-items:center;}
.copy-block pre{font-family:var(--mono);font-size:12px;color:var(--muted);white-space:pre-wrap;line-height:1.6;}

/* CHECKLIST */
.checklist{display:flex;flex-direction:column;gap:8px;margin-top:16px;}
.check-item{display:flex;align-items:flex-start;gap:12px;background:var(--card);border:1px solid var(--border);border-radius:8px;padding:12px 16px;}
.check-box{width:18px;height:18px;border:1.5px solid var(--border2);border-radius:4px;flex-shrink:0;margin-top:1px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;}
.check-box.done{background:var(--accent);border-color:var(--accent);}
.check-box.done::after{content:'';width:5px;height:9px;border:2px solid #0A0F07;border-top:none;border-left:none;transform:rotate(45deg) translateY(-1px);}
.check-text{font-size:13px;color:var(--muted);line-height:1.5;}
.check-text strong{color:var(--text);font-weight:600;}

/* TIMELINE */
.timeline{position:relative;padding-left:28px;margin-top:24px;}
.timeline::before{content:'';position:absolute;left:7px;top:8px;bottom:8px;width:1px;background:var(--border);}
.tl-item{position:relative;margin-bottom:28px;}
.tl-dot{position:absolute;left:-28px;top:4px;width:14px;height:14px;border-radius:50%;border:2px solid var(--accent);background:var(--bg);display:flex;align-items:center;justify-content:center;}
.tl-dot.done{background:var(--accent);}
.tl-week{font-family:var(--mono);font-size:10px;color:var(--accent);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:4px;}
.tl-title{font-size:15px;font-weight:700;margin-bottom:4px;}
.tl-desc{font-size:13px;color:var(--muted);line-height:1.6;}

/* DIVIDER */
.divider{border:none;border-top:1px solid var(--border);margin:36px 0;}

/* NOTICE */
.notice{background:var(--accent-dim);border:1px solid var(--border2);border-radius:10px;padding:14px 18px;margin-bottom:24px;font-size:13px;color:var(--muted);line-height:1.6;}
.notice strong{color:var(--accent);}

@media(max-width:768px){
  .layout{grid-template-columns:1fr;}
  .sidebar{display:none;}
  main{padding:24px 20px;}
  nav{padding:0 20px;}
  .nav-tabs{display:none;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-logo">LUNO<span>.</span> Launch Kit</div>
  <div class="nav-tabs">
    <a class="nav-tab active" onclick="showPage('reddit')">Reddit</a>
    <a class="nav-tab" onclick="showPage('twitter')">Twitter/X</a>
    <a class="nav-tab" onclick="showPage('producthunt')">Product Hunt</a>
    <a class="nav-tab" onclick="showPage('alternativeto')">Directories</a>
    <a class="nav-tab" onclick="showPage('thumbs')">Thumbnails</a>
    <a class="nav-tab" onclick="showPage('checklist')">Checklist</a>
  </div>
</nav>

<div class="layout">
<aside class="sidebar">
  <div class="sidebar-group">
    <div class="sidebar-label">Platforms</div>
    <a class="sidebar-link active" onclick="showPage('reddit')">
      <span class="platform-dot" style="background:#FF4500;"></span>Reddit
    </a>
    <a class="sidebar-link" onclick="showPage('twitter')">
      <span class="platform-dot" style="background:#1DA1F2;"></span>Twitter / X
    </a>
    <a class="sidebar-link" onclick="showPage('producthunt')">
      <span class="platform-dot" style="background:#DA552F;"></span>Product Hunt
    </a>
    <a class="sidebar-link" onclick="showPage('alternativeto')">
      <span class="platform-dot" style="background:#86C53C;"></span>Directories
    </a>
  </div>
  <div class="sidebar-group">
    <div class="sidebar-label">Assets</div>
    <a class="sidebar-link" onclick="showPage('thumbs')">
      <span class="platform-dot" style="background:#9B6EFF;"></span>Thumbnail Specs
    </a>
    <a class="sidebar-link" onclick="showPage('checklist')">
      <span class="platform-dot" style="background:#4A9EFF;"></span>Launch Checklist
    </a>
  </div>
</aside>

<main>

<!-- ─── REDDIT ─────────────────────────────────────────────────────── -->
<div id="page-reddit" class="page active">
  <div class="page-title">Reddit Posts</div>
  <p class="page-sub">Post in r/androidapps, r/privacy, r/personalfinance, r/financialindependence, r/SideProject, r/IndieGaming. Use separate posts for each subreddit — never cross-post the same text.</p>

  <div class="notice"><strong>Timing:</strong> Post Tuesday–Thursday between 9–11 AM EST. Avoid weekends. Title is the most important element on Reddit — nail it before anything else.</div>

  <!-- POST 1 -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">r/androidapps — Launch Post</div>
      <div class="platform-meta">Best for initial install volume</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Title</span>
      <button class="copy-btn" onclick="copyText(this, 'r-title-1')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-title-1">I built a personal finance tracker that stores everything locally — no cloud, no account, no tracking. It's called Luno.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Body</span>
      <button class="copy-btn" onclick="copyText(this, 'r-body-1')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-body-1">Hey r/androidapps,

I've been building Luno for the past few months — a personal finance manager for Android that takes privacy seriously.

The core idea: your financial data should never leave your device. No sync servers, no accounts, no analytics SDKs. Everything lives in SQLite on your phone.

What it does:
- Track income and expenses across multiple accounts
- 50+ built-in categories (Essentials, Transport, Health, Lifestyle, etc.)
- Advanced metrics: daily burn rate, savings rate, financial runway, in/out ratio
- 7D / 30D / 90D / All-time filters
- Period-over-period comparison
- Swipe to edit or delete transactions with automatic balance reversal
- Light, dark, and system themes

Free tier covers full transaction tracking and account management. Premium unlocks the analytics engine (savings rate, runway, burn metrics).

There's a lifetime unlock option at an early-adopter price right now before I raise it.

Built with React Native + Expo + Drizzle ORM + SQLite.

Happy to answer any questions. Would love honest feedback from this community.</div>
      <div class="char-count">No character limit on Reddit body. This length is ideal.</div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- POST 2 -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">r/privacy — Privacy Angle</div>
      <div class="platform-meta">High intent, privacy-first audience</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Title</span>
      <button class="copy-btn" onclick="copyText(this, 'r-title-2')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-title-2">Built a finance tracker where your data never touches a server — fully offline, SQLite on-device, no account required</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Body</span>
      <button class="copy-btn" onclick="copyText(this, 'r-body-2')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-body-2">I got frustrated with finance apps that require you to hand over bank credentials or sync to some cloud you don't control. So I built Luno.

The privacy design is simple: there are no servers. Your transactions, balances, and categories live exclusively in a SQLite database on your device. There's no backend to breach, no account to hack, no company storing your financial life.

What this means practically:
- Zero network requests to any Luno infrastructure (ever)
- No account creation or sign-in
- No analytics SDK, no crash reporter, no ad framework
- Full factory reset built-in to wipe everything locally
- Uninstalling removes everything

It's a fully functional finance tracker — multiple accounts, 50+ categories, analytics with burn rate / savings rate / runway metrics.

Free to download. No subscription. There's a lifetime premium option for the advanced analytics.

Would genuinely appreciate feedback from people who care about this stuff.</div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- POST 3 -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">r/personalfinance — Value Angle</div>
      <div class="platform-meta">Largest relevant audience. Be helpful, not salesy.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Title</span>
      <button class="copy-btn" onclick="copyText(this, 'r-title-3')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-title-3">I built a free finance tracker because I wanted to know my "financial runway" — how many days my savings would last at my current spend rate</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Body</span>
      <button class="copy-btn" onclick="copyText(this, 'r-body-3')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-body-3">The metric that changed how I think about money isn't net worth or monthly budget — it's financial runway.

Runway = current balance / average daily spend

It tells you exactly how many days you could survive without any income. It's the number that makes abstract "savings" feel real and urgent.

I built Luno specifically because I couldn't find a simple app that showed me this, plus daily burn rate and savings rate, without requiring cloud sync or a subscription.

The app tracks:
- Daily burn rate (avg spend per day)
- Savings rate (% of income retained)
- Financial runway (days your balance lasts)
- In/out ratio (income vs expenses)

Everything works offline. No account needed. Data stays on your device.

Free to download on Android. Would love to know if this resonates with anyone else here.</div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- POST 4 -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">r/SideProject — Builder Angle</div>
      <div class="platform-meta">Community of makers. Be authentic about the journey.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Title</span>
      <button class="copy-btn" onclick="copyText(this, 'r-title-4')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-title-4">Launched Luno — a local-first finance tracker I built with React Native + Expo + SQLite. Here's what I learned.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head">
      <span class="post-label">Body</span>
      <button class="copy-btn" onclick="copyText(this, 'r-body-4')">Copy</button>
    </div>
    <div class="post-body">
      <div class="post-text" id="r-body-4">Just shipped v1.0 of Luno after several months of building. Here's a quick post-mortem on the technical choices.

Stack:
- React Native + Expo + Expo Router
- Drizzle ORM + Expo SQLite
- React Native Reanimated for animations
- Bricolage Grotesque + JetBrains Mono for typography

The hardest part: building a freemium paywall system (PremiumGuard) that gates features at the component level without being annoying. Usage-based triggers + non-intrusive upgrade prompts.

The most fun part: the analytics engine. Calculating burn rate, savings rate, runway, and in/out ratio from raw transaction data and making it feel instant even with hundreds of records.

What I'd do differently: start with a design system earlier. I refactored spacing and typography three times.

The app is live on Android. Local-first, no cloud, lifetime purchase option.

Happy to talk tech with anyone building something similar.</div>
    </div>
  </div>
</div>

<!-- ─── TWITTER/X ──────────────────────────────────────────────────── -->
<div id="page-twitter" class="page">
  <div class="page-title">Twitter / X Posts</div>
  <p class="page-sub">280 characters per tweet. Use threads for launch day. Post consistently 3–4x per week with #buildinpublic to build an audience before the big launch.</p>

  <div class="notice"><strong>Strategy:</strong> Start with dev logs now. Save the big launch thread for when Phase 3 (Insights Layer) is shipped. That's when the product is truly ready for public attention.</div>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(29,161,242,0.15);">𝕏</div>
    <div>
      <div class="platform-title">Launch Thread — Day 1</div>
      <div class="platform-meta">Pin this. Post all tweets back-to-back as a thread.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 1 of 7 — Hook</span><button class="copy-btn" onclick="copyText(this, 'tw-1')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-1">Spent months building Luno — a personal finance tracker that stores everything on your device.

No cloud. No account. No tracking.

Just launched on Android. Here's what I built and why. 🧵</div>
      <div class="char-count">Characters: <span>190</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 2 of 7 — The Problem</span><button class="copy-btn" onclick="copyText(this, 'tw-2')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-2">Most finance apps want your bank login. Or they sync to a cloud you don't control. Or they show you ads.

I wanted an app where my financial data never leaves my phone.

So I built it.</div>
      <div class="char-count">Characters: <span>185</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 3 of 7 — The Product</span><button class="copy-btn" onclick="copyText(this, 'tw-3')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-3">Luno tracks:

— Income + expenses across multiple accounts
— 50+ built-in categories
— Daily burn rate
— Savings rate
— Financial runway (days your balance lasts)
— In/out ratio

All calculated locally. All stored in SQLite on your device.</div>
      <div class="char-count">Characters: <span>248</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 4 of 7 — The Stack</span><button class="copy-btn" onclick="copyText(this, 'tw-4')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-4">Built with:

React Native + Expo + Expo Router
Drizzle ORM + Expo SQLite
React Native Reanimated
Bricolage Grotesque + JetBrains Mono

The local-first architecture was the biggest challenge. Worth it.

#reactnative #expo #buildinpublic</div>
      <div class="char-count">Characters: <span>267</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 5 of 7 — The Model</span><button class="copy-btn" onclick="copyText(this, 'tw-5')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-5">Free tier: full transaction tracking, accounts, categories.

Premium: analytics engine (burn rate, savings rate, runway, period comparisons).

Lifetime unlock available at early adopter pricing. No subscription ever.

Free = Tracking. Premium = Insights.</div>
      <div class="char-count">Characters: <span>254</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 6 of 7 — Privacy Angle</span><button class="copy-btn" onclick="copyText(this, 'tw-6')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-6">The privacy model is simple:

There are no servers.

No backend to breach. No account to hack. No data to sell.

Factory reset wipes everything locally. Uninstall removes everything.

Your money. Your phone. Your data.</div>
      <div class="char-count">Characters: <span>212</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tweet 7 of 7 — CTA</span><button class="copy-btn" onclick="copyText(this, 'tw-7')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-7">Luno is live on Android. Free to download.

If you care about owning your financial data, I'd love for you to try it.

Link in bio. Feedback welcome — I read everything.

#indiedev #personalfinance #privacy #android</div>
      <div class="char-count">Characters: <span>220</span> / 280</div>
    </div>
  </div>

  <hr class="divider"/>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(29,161,242,0.15);">𝕏</div>
    <div>
      <div class="platform-title">Build-in-Public Tweets</div>
      <div class="platform-meta">Post 3–4x/week before and after launch</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log — Analytics</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-1')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-dev-1">The metric I'm most proud of in Luno:

Financial Runway = balance / avg daily spend

One number that tells you exactly how many days you could go without income.

Most apps don't show this. I made it front and center.

#buildinpublic #indiedev</div>
      <div class="char-count">Characters: <span>256</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log — Privacy</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-2')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-dev-2">Building Luno local-first meant:

— No auth system to build
— No backend to maintain
— No cloud costs
— No GDPR headaches
— No data breach risk

The best privacy feature is not collecting data in the first place.

#buildinpublic #privacy</div>
      <div class="char-count">Characters: <span>261</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log — Freemium</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-3')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-dev-3">The Luno freemium model in one line:

Free = Tracking. Premium = Insights.

You can log every transaction forever for free. The analytics engine (burn rate, savings rate, runway) is premium.

Makes the paywall feel fair. Early feedback confirms it.

#buildinpublic</div>
      <div class="char-count">Characters: <span>272</span> / 280</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log — Milestone</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-4')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tw-dev-4">Luno v1.0 is live.

Months of nights and weekends.
React Native + Expo + SQLite.
Local-first. No cloud. No tracking.

First indie Android app. Lifetime pricing. No subscription.

If you've ever wanted a finance app that respects your data — this is for you.

#indiedev #buildinpublic</div>
      <div class="char-count">Characters: <span>278</span> / 280</div>
    </div>
  </div>

  <hr class="divider"/>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(29,161,242,0.15);">𝕏</div>
    <div>
      <div class="platform-title">Hashtag Sets</div>
      <div class="platform-meta">Copy the right set for each tweet type</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Launch Day Tags</span><button class="copy-btn" onclick="copyText(this, 'tags-launch')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tags-launch">#indiedev #buildinpublic #android #personalfinance #privacy #mobileapp #reactnative #SideProject</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log Tags</span><button class="copy-btn" onclick="copyText(this, 'tags-dev')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tags-dev">#buildinpublic #indiedev #reactnative #expo #mobiledev</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Privacy Angle Tags</span><button class="copy-btn" onclick="copyText(this, 'tags-privacy')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="tags-privacy">#privacy #localfirst #opensource #android #degoogle #privacytools</div>
    </div>
  </div>
</div>

<!-- ─── PRODUCT HUNT ───────────────────────────────────────────────── -->
<div id="page-producthunt" class="page">
  <div class="page-title">Product Hunt</div>
  <p class="page-sub">Launch on Tuesday or Wednesday, 12:01 AM PST. Prepare everything 2 weeks in advance. Ask supporters to upvote only on launch day — not before.</p>

  <div class="notice"><strong>Critical:</strong> Your first comment on your own post matters a lot. It should be a personal story — why you built this. Not a feature list.</div>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(218,85,47,0.15);">🏹</div>
    <div>
      <div class="platform-title">Listing Copy</div>
      <div class="platform-meta">All fields for your Product Hunt submission</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Product Name</span><button class="copy-btn" onclick="copyText(this, 'ph-name')">Copy</button></div>
    <div class="post-body"><div class="post-text" id="ph-name">Luno</div></div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tagline (60 chars max)</span><button class="copy-btn" onclick="copyText(this, 'ph-tagline')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="ph-tagline">Personal finance tracker. Local-first. No cloud. No tracking.</div>
      <div class="char-count">Characters: <span>62</span> / 60 — trim one phrase if needed</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Tagline Alt (shorter)</span><button class="copy-btn" onclick="copyText(this, 'ph-tagline2')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="ph-tagline2">Your money stays on your phone. No cloud, no account, no tracking.</div>
      <div class="char-count">Characters: <span>67</span> / 60 — use for description if too long</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Description</span><button class="copy-btn" onclick="copyText(this, 'ph-desc')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="ph-desc">Luno is a personal finance manager built for people who want real control over their money — without giving their data to anyone.

Everything you track — transactions, balances, categories — lives in SQLite on your device. There are no servers, no accounts, and no analytics. Just you and your finances.

Key features:
- Multi-account tracking with live net position
- 50+ built-in categories across Essentials, Transport, Health, Lifestyle
- Analytics: daily burn rate, savings rate, financial runway, in/out ratio
- Time filters: 7D, 30D, 90D, All-time
- Period-over-period delta tracking
- Swipe gestures with automatic balance reversal
- Full light/dark/system theme support

Free tier covers full transaction tracking. Premium unlocks the analytics engine with a lifetime purchase option.

No subscription. No cloud. No compromise.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">First Comment (Maker Comment — Write this yourself)</span><button class="copy-btn" onclick="copyText(this, 'ph-comment')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="ph-comment">Hey Product Hunt — I'm the solo developer behind Luno.

I started building this because I was frustrated. Every finance app I tried either wanted my bank credentials, pushed me toward a $10/month subscription, or quietly synced my spending data to servers I'd never see.

I just wanted a simple answer to: how many days could I survive if I stopped earning tomorrow?

That number — financial runway — is what drove me to build Luno. It's the metric that makes abstract savings feel real.

The app is local-first by design. No backend infrastructure exists. Your data never leaves your phone. This was a conscious choice, not a limitation.

I built it solo with React Native + Expo + SQLite over several months of nights and weekends.

The free tier gives you full transaction tracking forever. Premium unlocks the analytics engine with a one-time lifetime purchase.

I'd genuinely love your feedback — especially on the freemium split and the UX. Happy to answer anything.</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Topics / Tags</span><button class="copy-btn" onclick="copyText(this, 'ph-tags')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="ph-tags">Finance, Productivity, Android, Privacy, No-Code</div>
    </div>
  </div>
</div>

<!-- ─── DIRECTORIES ────────────────────────────────────────────────── -->
<div id="page-alternativeto" class="page">
  <div class="page-title">App Directories</div>
  <p class="page-sub">Submit to these directories for long-tail organic installs. These work slowly but compound over months. Do it once, benefit forever.</p>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">📂</div>
    <div>
      <div class="platform-title">AlternativeTo — Description</div>
      <div class="platform-meta">List as alternative to: Mint, YNAB, Money Manager, Spendee</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">AlternativeTo Description</span><button class="copy-btn" onclick="copyText(this, 'alt-desc')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="alt-desc">Luno is a privacy-first personal finance manager for Android. Unlike Mint, YNAB, or Money Manager, Luno stores all data exclusively on your device — no cloud sync, no account required, no tracking of any kind.

Track income and expenses across multiple accounts, with 50+ built-in categories. Get practical financial insights including daily burn rate, savings rate, financial runway, and in/out ratio. Filter across 7D, 30D, 90D, or all-time windows.

Free tier includes full transaction tracking and account management. Premium unlocks the analytics engine with a lifetime purchase option — no subscription.

Luno is built with React Native, Expo, and SQLite (Drizzle ORM). All data lives locally on your device.</div>
    </div>
  </div>

  <hr class="divider"/>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">📂</div>
    <div>
      <div class="platform-title">AppBrain / General Directories</div>
      <div class="platform-meta">Use for AppBrain, APKPure listings, F-Droid description</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Short Directory Description</span><button class="copy-btn" onclick="copyText(this, 'dir-short')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="dir-short">Luno is a local-first personal finance tracker for Android. No cloud, no account, no tracking. All data is stored on-device via SQLite. Track income, expenses, and accounts. Get insights including burn rate, savings rate, and financial runway. Free with optional lifetime premium.</div>
    </div>
  </div>

  <hr class="divider"/>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">📂</div>
    <div>
      <div class="platform-title">Outreach Template — YouTubers / Newsletters</div>
      <div class="platform-meta">For Techlore, The Hated One, privacy-focused creators</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Creator Outreach Email</span><button class="copy-btn" onclick="copyText(this, 'outreach-email')">Copy</button></div>
    <div class="post-body">
      <div class="post-text" id="outreach-email">Subject: Privacy-first Android finance app — no cloud, no tracking, might interest your audience

Hi [Name],

I've been following your content for a while — particularly your coverage of privacy-respecting tools. I built something I think your audience would genuinely find useful.

Luno is a personal finance tracker for Android that stores everything locally. No cloud sync, no account creation, no analytics SDK, no advertising framework. All financial data lives in SQLite on the user's device.

It's fully functional as a finance tracker — multiple accounts, 50+ categories, daily burn rate, savings rate, financial runway metrics. Free tier for basic tracking, lifetime premium for the analytics layer.

I'm not asking for a sponsored segment — just thought it might be worth a mention if it fits your content. Happy to provide a promo code for premium access or answer any technical questions about how the local-first architecture works.

Play Store link: [YOUR LINK]
Landing page: [YOUR URL]

Thanks for your time either way.

[Your name]</div>
    </div>
  </div>
</div>

<!-- ─── THUMBNAILS ─────────────────────────────────────────────────── -->
<div id="page-thumbs" class="page">
  <div class="page-title">Thumbnail Specs</div>
  <p class="page-sub">Visual assets you need for each platform. All specs are exact requirements — wrong sizes get auto-cropped or rejected.</p>

  <div class="thumb-card">
    <div class="thumb-title">Google Play Store</div>
    <div class="thumb-sub">Required assets for your store listing</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Feature Graphic</div><div class="spec-val">1024 x 500 px</div></div>
      <div class="spec-row"><div class="spec-key">Screenshots</div><div class="spec-val">Min 320px, Max 3840px</div></div>
      <div class="spec-row"><div class="spec-key">App Icon</div><div class="spec-val">512 x 512 px PNG</div></div>
      <div class="spec-row"><div class="spec-key">Promo Video</div><div class="spec-val">YouTube link, 30–120s</div></div>
    </div>
    <div class="copy-block" onclick="copyBlock(this, 'spec-play')">
      <div class="copy-block-label">Screenshot copy for Play Store listing <span>click to copy</span></div>
      <pre id="spec-play">Screenshot captions (use these as on-image text):

1. "Build your finance cockpit" — Onboarding screen
2. "Everything at a glance" — Dashboard with net position
3. "Know your runway" — Stats screen with burn rate + savings rate
4. "Every transaction, tracked" — Transaction list view
5. "Your data. Your device." — Privacy/settings screen</pre>
    </div>
  </div>

  <div class="thumb-card">
    <div class="thumb-title">Product Hunt</div>
    <div class="thumb-sub">Gallery images for your PH listing</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Thumbnail</div><div class="spec-val">240 x 240 px</div></div>
      <div class="spec-row"><div class="spec-key">Gallery Images</div><div class="spec-val">1270 x 760 px</div></div>
      <div class="spec-row"><div class="spec-key">Format</div><div class="spec-val">PNG or JPG</div></div>
      <div class="spec-row"><div class="spec-key">Max per listing</div><div class="spec-val">8 images</div></div>
    </div>
    <div class="copy-block" onclick="copyBlock(this, 'spec-ph')">
      <div class="copy-block-label">Suggested gallery order <span>click to copy</span></div>
      <pre id="spec-ph">Gallery image order for Product Hunt:
1. Feature graphic (1024x500 scaled to 1270x760)
2. Dashboard screenshot — "Your net position, always visible"
3. Stats screen — "Burn rate. Savings rate. Runway."
4. Transaction list — "Every transaction, every account"
5. Onboarding — "Up and running in 60 seconds"
6. Privacy callout card — "No cloud. No account. No tracking."</pre>
    </div>
  </div>

  <div class="thumb-card">
    <div class="thumb-title">Twitter / X Media</div>
    <div class="thumb-sub">For tweet images that drive clicks</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Single image</div><div class="spec-val">1600 x 900 px</div></div>
      <div class="spec-row"><div class="spec-key">2-image grid</div><div class="spec-val">700 x 800 px each</div></div>
      <div class="spec-row"><div class="spec-key">Profile banner</div><div class="spec-val">1500 x 500 px</div></div>
      <div class="spec-row"><div class="spec-key">Format</div><div class="spec-val">PNG, max 5MB</div></div>
    </div>
    <div class="copy-block" onclick="copyBlock(this, 'spec-tw')">
      <div class="copy-block-label">Best image combos for launch tweets <span>click to copy</span></div>
      <pre id="spec-tw">Tweet image combinations:

Launch thread:
- Tweet 1: Feature graphic (1600x900)
- Tweet 3: Dashboard + Stats side by side (2-image)
- Tweet 6: Dark background with "No cloud. No tracking." text card

Build-in-public:
- Single screenshot per tweet, cropped to 1600x900
- Add dark overlay text with the key metric being discussed</pre>
    </div>
  </div>

  <div class="thumb-card">
    <div class="thumb-title">Reddit</div>
    <div class="thumb-sub">Images attached to Reddit posts</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Max size</div><div class="spec-val">20 MB</div></div>
      <div class="spec-row"><div class="spec-key">Recommended</div><div class="spec-val">1:1 or 4:3 ratio</div></div>
      <div class="spec-row"><div class="spec-key">Format</div><div class="spec-val">PNG or JPG</div></div>
      <div class="spec-row"><div class="spec-key">Max images</div><div class="spec-val">20 per post</div></div>
    </div>
    <div class="copy-block" onclick="copyBlock(this, 'spec-reddit')">
      <div class="copy-block-label">Suggested image set for Reddit launch post <span>click to copy</span></div>
      <pre id="spec-reddit">Reddit image gallery (attach to r/androidapps post):
1. Feature graphic — establishes the brand
2. Dashboard screenshot — shows core UI
3. Stats screen — shows the premium analytics value
4. Transaction list — shows daily usage
5. Onboarding screen — shows ease of setup

Keep images clean — no heavy marketing text overlays for r/androidapps.</pre>
    </div>
  </div>
</div>

<!-- ─── CHECKLIST ─────────────────────────────────────────────────── -->
<div id="page-checklist" class="page">
  <div class="page-title">Launch Checklist</div>
  <p class="page-sub">Sequenced exactly in the order you should execute. Don't jump ahead. Check items off as you go.</p>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(74,158,255,0.15);">📋</div>
    <div>
      <div class="platform-title">Pre-Launch (2 Weeks Before)</div>
      <div class="platform-meta">Do all of this before announcing publicly</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Play Store listing complete</strong> — all screenshots, feature graphic, short desc, long desc uploaded</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Landing page live</strong> — index.html, privacy.html, terms.html deployed to a real domain</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Twitter/X account created</strong> — @lunofin or similar handle, bio with Play Store link</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Phase 3 Insights shipped</strong> — weekly summary, spending alerts, runway insights live before public launch</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Product Hunt pre-launch page</strong> — set up "coming soon" page and collect followers</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>5 build-in-public tweets posted</strong> — warm up the account before launch day</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>AlternativeTo listing submitted</strong> — list vs Mint, YNAB, Money Manager</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Support email active</strong> — support@lunofin.app (or your domain) responding</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(74,158,255,0.15);">🚀</div>
    <div>
      <div class="platform-title">Launch Day</div>
      <div class="platform-meta">Execute in this exact order</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>12:01 AM PST — Product Hunt goes live</strong> — post your maker comment immediately</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post launch thread on Twitter/X</strong> — all 7 tweets back to back as a thread</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post on r/androidapps</strong> — launch post with image gallery</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post on r/privacy</strong> — privacy angle post</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post on r/SideProject</strong> — builder story post</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Notify your personal network</strong> — DM friends and ask for honest reviews on Play Store</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Monitor and respond</strong> — reply to every comment on Reddit and PH within 2 hours</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(74,158,255,0.15);">📈</div>
    <div>
      <div class="platform-title">Post-Launch (Week 1–4)</div>
      <div class="platform-meta">Sustain momentum after the initial spike</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post on r/personalfinance</strong> — wait 3 days after initial launch, use the financial runway angle</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Post on r/financialindependence</strong> — angle toward FIRE community and the runway metric</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Send outreach to 5 privacy YouTubers</strong> — use the email template in Directories section</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>3 more build-in-public tweets</strong> — share first week download numbers, first user feedback</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Respond to every Play Store review</strong> — 5-star or 1-star, respond thoughtfully</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Ship Phase 3 update</strong> — post an update thread on Twitter and Reddit showing new insight cards</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>AppBrain listing submitted</strong> — secondary directory for long-tail organic</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(74,158,255,0.15);">🌐</div>
    <div>
      <div class="platform-title">Launch Timeline</div>
      <div class="platform-meta">Rough week-by-week plan</div>
    </div>
  </div>

  <div class="timeline">
    <div class="tl-item">
      <div class="tl-dot done"></div>
      <div class="tl-week">Now</div>
      <div class="tl-title">Store listing + assets ready</div>
      <div class="tl-desc">Feature graphic, screenshots, long description, short description, privacy policy URL all submitted and approved.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Week 1–2</div>
      <div class="tl-title">Build in public warm-up</div>
      <div class="tl-desc">Post 5–6 dev log tweets. Set up PH coming soon page. Finish Phase 3 Insights Layer.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Week 3</div>
      <div class="tl-title">Launch day</div>
      <div class="tl-desc">Product Hunt + Reddit r/androidapps + r/privacy + Twitter thread. All on the same day.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Week 4</div>
      <div class="tl-title">Finance community push</div>
      <div class="tl-desc">r/personalfinance + r/financialindependence posts. Begin YouTuber outreach.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Month 2</div>
      <div class="tl-title">Phase 3 update launch</div>
      <div class="tl-desc">Ship weekly summaries + spending alerts. Post update thread everywhere. Second wave of attention.</div>
    </div>
  </div>
</div>

</main>
</div>

<script>
function showPage(id) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
  document.getElementById('page-' + id).classList.add('active');
  document.querySelectorAll('.nav-tab').forEach(t => { if(t.getAttribute('onclick').includes("'"+id+"'")) t.classList.add('active'); });
  document.querySelectorAll('.sidebar-link').forEach(l => { if(l.getAttribute('onclick') && l.getAttribute('onclick').includes("'"+id+"'")) l.classList.add('active'); });
}

function copyText(btn, id) {
  const el = document.getElementById(id);
  const text = el.innerText;
  navigator.clipboard.writeText(text).then(() => {
    btn.textContent = 'Copied!';
    btn.classList.add('copied');
    setTimeout(() => { btn.textContent = 'Copy'; btn.classList.remove('copied'); }, 2000);
  });
}

function copyBlock(el, id) {
  const text = document.getElementById(id).innerText;
  navigator.clipboard.writeText(text).then(() => {
    const label = el.querySelector('.copy-block-label span');
    label.textContent = 'Copied!';
    setTimeout(() => { label.textContent = 'click to copy'; }, 2000);
  });
}
</script>
</body>
</html>