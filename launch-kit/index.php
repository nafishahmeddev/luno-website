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
.nav-tab{font-family:var(--mono);font-size:10px;font-weight:500;letter-spacing:0.06em;text-transform:uppercase;padding:5px 12px;border-radius:6px;cursor:pointer;color:var(--muted);border:1px solid transparent;transition:all .15s;text-decoration:none;background:none;}
.nav-tab:hover{color:var(--text);border-color:var(--border);}
.nav-tab.active{color:var(--accent);border-color:var(--border2);background:var(--accent-dim);}

/* LAYOUT */
.layout{display:grid;grid-template-columns:220px 1fr;min-height:100vh;}
.sidebar{border-right:1px solid var(--border);padding:28px 0;position:sticky;top:56px;height:calc(100vh - 56px);overflow-y:auto;}
.sidebar-group{margin-bottom:24px;}
.sidebar-label{font-family:var(--mono);font-size:9px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--dim);padding:0 20px;margin-bottom:8px;}
.sidebar-link{display:flex;align-items:center;gap:10px;padding:8px 20px;font-size:13px;color:var(--muted);cursor:pointer;transition:all .15s;text-decoration:none;border-left:2px solid transparent;background:none;border-right:none;border-top:none;border-bottom:none;width:100%;text-align:left;font-family:var(--sans);}
.sidebar-link:hover{color:var(--text);background:var(--accent-dim);}
.sidebar-link.active{color:var(--accent);border-left-color:var(--accent);background:var(--accent-dim);}
.platform-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}

/* MAIN */
main{padding:40px 48px;max-width:900px;}
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
.thumb-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:20px 24px;margin-bottom:20px;}
.thumb-title{font-size:17px;font-weight:700;margin-bottom:4px;}
.thumb-sub{font-size:13px;color:var(--muted);margin-bottom:16px;}
.spec-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.spec-row{background:var(--bg3);border-radius:8px;padding:10px 14px;}
.spec-key{font-family:var(--mono);font-size:9px;color:var(--dim);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;}
.spec-val{font-size:13px;color:var(--text);font-weight:600;}
.copy-block{background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:14px 16px;margin-top:14px;cursor:pointer;position:relative;transition:border-color .15s;}
.copy-block:hover{border-color:var(--border2);}
.copy-block-label{font-family:var(--mono);font-size:9px;color:var(--dim);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:8px;display:flex;justify-content:space-between;align-items:center;}
.copy-block pre{font-family:var(--mono);font-size:12px;color:var(--muted);white-space:pre-wrap;line-height:1.6;}

/* THUMBNAIL GALLERY */
.thumb-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;margin-top:16px;}
.thumb-item{background:var(--bg3);border:1px solid var(--border);border-radius:10px;overflow:hidden;transition:border-color .15s;}
.thumb-item:hover{border-color:var(--border2);}
.thumb-img-wrap{background:#0A0F07;padding:8px;display:flex;align-items:center;justify-content:center;min-height:130px;}
.thumb-img-wrap img{max-width:100%;max-height:160px;object-fit:contain;border-radius:4px;display:block;}
.thumb-item-body{padding:10px 12px;border-top:1px solid var(--border);}
.thumb-item-name{font-family:var(--mono);font-size:10px;color:var(--accent);letter-spacing:0.04em;margin-bottom:3px;word-break:break-all;}
.thumb-item-desc{font-size:12px;color:var(--muted);margin-bottom:6px;line-height:1.4;}
.thumb-item-dim{font-family:var(--mono);font-size:10px;color:var(--dim);}

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

/* ROADMAP */
.roadmap-phase{margin-bottom:40px;}
.phase-header{display:flex;align-items:center;gap:14px;margin-bottom:20px;}
.phase-badge{font-family:var(--mono);font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:4px 12px;border-radius:5px;border:1px solid;flex-shrink:0;}
.phase-badge.phase-prep{background:rgba(155,110,255,0.1);border-color:rgba(155,110,255,0.3);color:var(--purple);}
.phase-badge.phase-warmup{background:rgba(255,140,74,0.1);border-color:rgba(255,140,74,0.3);color:var(--orange);}
.phase-badge.phase-launch{background:rgba(255,92,74,0.1);border-color:rgba(255,92,74,0.3);color:var(--red);}
.phase-badge.phase-post{background:rgba(74,158,255,0.1);border-color:rgba(74,158,255,0.3);color:var(--blue);}
.phase-badge.phase-sustain{background:rgba(134,197,60,0.1);border-color:rgba(134,197,60,0.3);color:var(--accent);}
.phase-title{font-size:20px;font-weight:800;letter-spacing:-0.02em;}
.phase-meta{font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:0.04em;margin-top:2px;}

.step-list{display:flex;flex-direction:column;gap:12px;}
.step-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;}
.step-card-head{display:flex;align-items:center;gap:12px;padding:12px 18px;border-bottom:1px solid var(--border);background:var(--bg3);}
.step-number{width:22px;height:22px;border-radius:50%;background:var(--accent-dim);border:1px solid var(--border2);color:var(--accent);font-family:var(--mono);font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.step-timing{font-family:var(--mono);font-size:10px;color:var(--dim);letter-spacing:0.06em;text-transform:uppercase;}
.step-card-body{padding:14px 18px;}
.step-title{font-size:15px;font-weight:700;margin-bottom:6px;color:var(--text);}
.step-desc{font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:10px;}
.step-actions{display:flex;flex-direction:column;gap:6px;}
.step-action{display:flex;align-items:flex-start;gap:8px;font-size:13px;color:var(--muted);line-height:1.5;}
.step-action::before{content:'→';color:var(--accent);font-family:var(--mono);font-weight:600;flex-shrink:0;margin-top:1px;}
.step-action strong{color:var(--text);}
.step-refs{display:flex;flex-wrap:wrap;gap:6px;margin-top:10px;padding-top:10px;border-top:1px solid var(--border);}
.step-ref{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;color:var(--accent);background:var(--accent-dim);border:1px solid var(--border2);border-radius:4px;padding:3px 8px;cursor:pointer;text-decoration:none;transition:all .15s;}
.step-ref:hover{background:var(--accent);color:#0A0F07;}
.step-ref-label{font-size:9px;color:var(--dim);letter-spacing:0.08em;text-transform:uppercase;font-family:var(--mono);}
.thumb-ref{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;color:var(--purple);background:rgba(155,110,255,0.08);border:1px solid rgba(155,110,255,0.25);border-radius:4px;padding:3px 8px;cursor:pointer;text-decoration:none;transition:all .15s;}
.thumb-ref:hover{background:var(--purple);color:#0A0F07;}
.platform-ref{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;color:var(--blue);background:rgba(74,158,255,0.08);border:1px solid rgba(74,158,255,0.25);border-radius:4px;padding:3px 8px;cursor:pointer;text-decoration:none;transition:all .15s;}
.platform-ref:hover{background:var(--blue);color:#0A0F07;}

/* DIVIDER */
.divider{border:none;border-top:1px solid var(--border);margin:36px 0;}

/* NOTICE */
.notice{background:var(--accent-dim);border:1px solid var(--border2);border-radius:10px;padding:14px 18px;margin-bottom:24px;font-size:13px;color:var(--muted);line-height:1.6;}
.notice strong{color:var(--accent);}

/* ALERT */
.alert{border-radius:10px;padding:14px 18px;margin-bottom:16px;font-size:13px;line-height:1.6;}
.alert-warn{background:rgba(255,140,74,0.08);border:1px solid rgba(255,140,74,0.25);color:rgba(237,243,224,0.7);}
.alert-warn strong{color:var(--orange);}
.alert-red{background:rgba(255,92,74,0.08);border:1px solid rgba(255,92,74,0.25);color:rgba(237,243,224,0.7);}
.alert-red strong{color:var(--red);}
.alert-blue{background:rgba(74,158,255,0.08);border:1px solid rgba(74,158,255,0.25);color:rgba(237,243,224,0.7);}
.alert-blue strong{color:var(--blue);}

@media(max-width:768px){
  .layout{grid-template-columns:1fr;}
  .sidebar{display:none;}
  main{padding:24px 20px;}
  nav{padding:0 20px;}
  .nav-tabs{display:none;}
  .thumb-gallery{grid-template-columns:1fr 1fr;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-logo">LUNO<span>.</span> Launch Kit</div>
  <div class="nav-tabs">
    <button class="nav-tab active" onclick="showPage('roadmap')">Roadmap</button>
    <button class="nav-tab" onclick="showPage('reddit')">Reddit</button>
    <button class="nav-tab" onclick="showPage('twitter')">Twitter/X</button>
    <button class="nav-tab" onclick="showPage('producthunt')">Product Hunt</button>
    <button class="nav-tab" onclick="showPage('alternativeto')">Directories</button>
    <button class="nav-tab" onclick="showPage('thumbs')">Thumbnails</button>
    <button class="nav-tab" onclick="showPage('checklist')">Checklist</button>
  </div>
</nav>

<div class="layout">
<aside class="sidebar">
  <div class="sidebar-group">
    <div class="sidebar-label">Strategy</div>
    <button class="sidebar-link active" onclick="showPage('roadmap')">
      <span class="platform-dot" style="background:var(--accent);"></span>Full Roadmap
    </button>
    <button class="sidebar-link" onclick="showPage('checklist')">
      <span class="platform-dot" style="background:var(--blue);"></span>Launch Checklist
    </button>
  </div>
  <div class="sidebar-group">
    <div class="sidebar-label">Post Content</div>
    <button class="sidebar-link" onclick="showPage('reddit')">
      <span class="platform-dot" style="background:#FF4500;"></span>Reddit
    </button>
    <button class="sidebar-link" onclick="showPage('twitter')">
      <span class="platform-dot" style="background:#1DA1F2;"></span>Twitter / X
    </button>
    <button class="sidebar-link" onclick="showPage('producthunt')">
      <span class="platform-dot" style="background:#DA552F;"></span>Product Hunt
    </button>
    <button class="sidebar-link" onclick="showPage('alternativeto')">
      <span class="platform-dot" style="background:var(--accent);"></span>Directories
    </button>
  </div>
  <div class="sidebar-group">
    <div class="sidebar-label">Assets</div>
    <button class="sidebar-link" onclick="showPage('thumbs')">
      <span class="platform-dot" style="background:var(--purple);"></span>Thumbnails
    </button>
  </div>
</aside>

<main>

<!-- ─── ROADMAP ────────────────────────────────────────────────────── -->
<div id="page-roadmap" class="page active">
  <div class="page-title">Launch Roadmap</div>
  <p class="page-sub">Full execution plan — exactly what to do, when to do it, and which assets to use. Follow in order. Each step references the exact post content and thumbnails to use.</p>

  <div class="notice"><strong>How to use:</strong> Start at Phase 0 and work through each step sequentially. Click the <span style="color:var(--accent);font-family:var(--mono);font-size:11px;">→ post refs</span> to jump directly to that post content. Click <span style="color:var(--purple);font-family:var(--mono);font-size:11px;">→ thumbnail refs</span> to jump to the thumbnail gallery.</div>

  <!-- PHASE 0 -->
  <div class="roadmap-phase">
    <div class="phase-header">
      <div class="phase-badge phase-prep">Phase 0</div>
      <div>
        <div class="phase-title">Store &amp; Asset Setup</div>
        <div class="phase-meta">Do this first — before any public posting</div>
      </div>
    </div>

    <div class="step-list">
      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">1</div>
          <div class="step-timing">Right now</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Complete your Google Play Store listing</div>
          <div class="step-desc">The Play Store listing is your conversion funnel. A bad listing kills downloads even with a great app. Get it right before you drive any traffic.</div>
          <div class="step-actions">
            <div class="step-action">Upload <strong>feature_graphic_1024x500.png</strong> as the Feature Graphic (required for search visibility)</div>
            <div class="step-action">Upload all <strong>5 screenshots</strong> in order: Onboarding → Dashboard → Stats → Transactions → Categories</div>
            <div class="step-action">Short description (80 chars max): use <strong>Product Hunt → Tagline</strong> content</div>
            <div class="step-action">Long description: use <strong>Product Hunt → Description</strong> content — it's already Play Store optimised</div>
            <div class="step-action">App icon: 512×512 PNG, no transparency border</div>
            <div class="step-action">Category: Finance · Content Rating: Everyone · Privacy Policy URL: your domain/privacy</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('producthunt')">PH Tagline + Description</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">Play Store Assets</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">2</div>
          <div class="step-timing">Right now</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Verify your landing page is live and correct</div>
          <div class="step-desc">Every post you make will link here. A broken or slow landing page destroys trust. Check every page and every link.</div>
          <div class="step-actions">
            <div class="step-action">Load <strong>luno.nafish.lo</strong> — verify hero, features, analytics sections all render</div>
            <div class="step-action">Test <strong>/privacy</strong> and <strong>/terms</strong> pages — Play Store and Product Hunt require these</div>
            <div class="step-action">Click the <strong>Get it on Google Play</strong> button — verify it opens the correct Play Store page</div>
            <div class="step-action">Open on mobile — verify responsive layout works</div>
            <div class="step-action">Check page load speed — images should load fast (compress if over 200KB each)</div>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">3</div>
          <div class="step-timing">Right now</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Set up your Twitter/X account</div>
          <div class="step-desc">You need at least a few tweets before launch so you don't look like a bot. Create the account now even if you don't start posting yet.</div>
          <div class="step-actions">
            <div class="step-action">Handle: <strong>@lunofin</strong> or <strong>@lunoapp</strong> — check availability at x.com</div>
            <div class="step-action">Bio: <em>"Built Luno — local-first Android finance tracker. No cloud. No tracking. #buildinpublic"</em></div>
            <div class="step-action">Website: link to your Play Store listing or landing page</div>
            <div class="step-action">Profile image: your app icon (square, 400×400px)</div>
            <div class="step-action">Banner: use <strong>tw_1_launch.png</strong> scaled to 1500×500px</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">Twitter Assets</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">4</div>
          <div class="step-timing">Right now</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Submit to AlternativeTo</div>
          <div class="step-desc">AlternativeTo drives long-tail installs for months after launch. Takes 10 minutes. Do it now so it's indexed before your launch.</div>
          <div class="step-actions">
            <div class="step-action">Go to <strong>alternativeto.net</strong> → Add App</div>
            <div class="step-action">Copy the description from <strong>Directories → AlternativeTo Description</strong></div>
            <div class="step-action">List as alternative to: <strong>Mint, YNAB, Money Manager, Spendee</strong></div>
            <div class="step-action">Platform: Android · Category: Personal Finance · License: Freemium</div>
            <div class="step-action">Icon: use your Play Store app icon</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('alternativeto')">AlternativeTo Description</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHASE 1 -->
  <div class="roadmap-phase">
    <div class="phase-header">
      <div class="phase-badge phase-warmup">Phase 1</div>
      <div>
        <div class="phase-title">Build-in-Public Warm-Up</div>
        <div class="phase-meta">Week −2 to −1 before launch — post 4–5 times to warm up the account</div>
      </div>
    </div>

    <div class="alert alert-warn"><strong>Why this matters:</strong> An account with zero tweets looks like spam. 4–5 dev logs before launch day gives you credibility, builds a tiny audience, and means your launch thread won't be your first tweet.</div>

    <div class="step-list">
      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">5</div>
          <div class="step-timing">Day 1 (Monday) — Week −2</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post: Financial Runway Dev Log</div>
          <div class="step-desc">Lead with the most interesting metric. This tweet teaches something useful and introduces your product naturally.</div>
          <div class="step-actions">
            <div class="step-action">Copy from <strong>Twitter/X → Dev Log — Analytics</strong></div>
            <div class="step-action">Attach image: <strong>tw_3_analytics.png</strong></div>
            <div class="step-action">Add hashtags: <strong>#buildinpublic #indiedev</strong></div>
            <div class="step-action">Post between <strong>9–11 AM your local time</strong></div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('twitter')">Dev Log — Analytics</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">tw_3_analytics.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">6</div>
          <div class="step-timing">Day 3 (Wednesday) — Week −2</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post: Privacy Architecture Dev Log</div>
          <div class="step-desc">The privacy angle resonates with a wide technical audience. The list format makes it highly shareable.</div>
          <div class="step-actions">
            <div class="step-action">Copy from <strong>Twitter/X → Dev Log — Privacy</strong></div>
            <div class="step-action">Attach image: <strong>tw_2_privacy.png</strong></div>
            <div class="step-action">Add hashtags: <strong>#buildinpublic #privacy</strong></div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('twitter')">Dev Log — Privacy</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">tw_2_privacy.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">7</div>
          <div class="step-timing">Day 5 (Friday) — Week −2</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post: Freemium Model Dev Log</div>
          <div class="step-desc">Explaining your monetisation model openly builds trust and gets feedback before launch.</div>
          <div class="step-actions">
            <div class="step-action">Copy from <strong>Twitter/X → Dev Log — Freemium</strong></div>
            <div class="step-action">No image needed for this one — keep it text-only for variety</div>
            <div class="step-action">Add hashtags: <strong>#buildinpublic</strong></div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('twitter')">Dev Log — Freemium</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">8</div>
          <div class="step-timing">Day 8 (Thursday) — Week −1</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Set up Product Hunt "Coming Soon" page</div>
          <div class="step-desc">PH lets you collect followers before launch. Those followers get notified on launch day, which boosts early upvotes.</div>
          <div class="step-actions">
            <div class="step-action">Go to <strong>producthunt.com/ship</strong> → Create Ship page</div>
            <div class="step-action">Product name: <strong>Luno</strong></div>
            <div class="step-action">Tagline: copy from <strong>Product Hunt → Tagline Alt (shorter)</strong></div>
            <div class="step-action">Upload <strong>ph_1_dashboard.png</strong> as the preview image</div>
            <div class="step-action">Share the coming soon link in your bio and in your next tweet</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('producthunt')">PH Tagline Alt</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">ph_1_dashboard.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">9</div>
          <div class="step-timing">Day 10 (Saturday) — Week −1</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post: Milestone / "Going Live Soon" Tweet</div>
          <div class="step-desc">Build anticipation. Mention you're launching soon to prime your followers for the launch day ask.</div>
          <div class="step-actions">
            <div class="step-action">Copy from <strong>Twitter/X → Dev Log — Milestone</strong></div>
            <div class="step-action">Attach image: <strong>tw_1_launch.png</strong></div>
            <div class="step-action">Add hashtags from <strong>Twitter/X → Launch Day Tags</strong></div>
            <div class="step-action">Include your Product Hunt coming soon link</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('twitter')">Dev Log — Milestone</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">tw_1_launch.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">10</div>
          <div class="step-timing">Day 12 — Week −1</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Set up support email and pre-write responses</div>
          <div class="step-desc">On launch day you'll be too busy to write replies from scratch. Set up your email and draft 3–4 canned responses now.</div>
          <div class="step-actions">
            <div class="step-action">Create <strong>support@[yourdomain]</strong> or use your personal email — pick one and commit</div>
            <div class="step-action">Draft response for: <em>"How do I backup my data?"</em></div>
            <div class="step-action">Draft response for: <em>"Is there an iOS version?"</em></div>
            <div class="step-action">Draft response for: <em>"What does premium include?"</em></div>
            <div class="step-action">Add support email to your Play Store listing, landing page, and Twitter bio</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHASE 2 -->
  <div class="roadmap-phase">
    <div class="phase-header">
      <div class="phase-badge phase-launch">Phase 2</div>
      <div>
        <div class="phase-title">Launch Day</div>
        <div class="phase-meta">Execute in this exact order — timing matters</div>
      </div>
    </div>

    <div class="alert alert-red"><strong>Critical:</strong> Launch day is a single day. PH resets at midnight PST. All your posts should go live within the same 12-hour window to cross-amplify each other. Have everything pre-written and ready to paste.</div>

    <div class="step-list">
      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">11</div>
          <div class="step-timing">12:01 AM PST — First thing</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Submit Product Hunt listing</div>
          <div class="step-desc">PH day runs midnight–midnight PST. Submit right at 12:01 AM to maximise the full 24-hour window. The earlier in the day you launch, the more upvotes you can accumulate.</div>
          <div class="step-actions">
            <div class="step-action">Submit with: <strong>Product Name, Tagline, Description, Topics/Tags</strong> — all from Product Hunt section</div>
            <div class="step-action">Upload gallery images in order: <strong>ph_1_dashboard → ph_2_analytics → ph_3_transactions → ph_4_categories</strong></div>
            <div class="step-action"><strong>Immediately</strong> post your Maker Comment — this is your personal story, not a feature list</div>
            <div class="step-action">Do NOT ask for upvotes yet — post the link to Twitter first so sharing feels natural</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('producthunt')">All PH Copy</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">Product Hunt Assets</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">12</div>
          <div class="step-timing">9:00 AM EST — Twitter/X</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post the full 7-tweet launch thread</div>
          <div class="step-desc">Post all 7 tweets back-to-back as a thread. Reply to your own first tweet to chain them. The thread format maximises reach because each tweet can be shared independently.</div>
          <div class="step-actions">
            <div class="step-action">Tweet 1 (Hook): attach <strong>tw_1_launch.png</strong> + hashtags from Launch Day Tags</div>
            <div class="step-action">Tweet 2 (Problem): text only</div>
            <div class="step-action">Tweet 3 (Product): text only</div>
            <div class="step-action">Tweet 4 (Stack): text only</div>
            <div class="step-action">Tweet 5 (Model): text only</div>
            <div class="step-action">Tweet 6 (Privacy): attach <strong>tw_2_privacy.png</strong></div>
            <div class="step-action">Tweet 7 (CTA): include your PH link + Play Store link</div>
            <div class="step-action">Pin the first tweet to your profile immediately after posting</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('twitter')">Launch Thread (7 tweets)</button>
            <button class="step-ref" onclick="showPage('twitter')">Hashtag Sets</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">tw_1_launch.png</button>
            <button class="thumb-ref" onclick="showPage('thumbs')">tw_2_privacy.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">13</div>
          <div class="step-timing">10:00 AM EST — Reddit</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post on r/androidapps</div>
          <div class="step-desc">r/androidapps is the highest-intent community for install volume. This post will drive the most direct downloads. Use an image gallery — posts with images get more clicks.</div>
          <div class="step-actions">
            <div class="step-action">Copy <strong>r/androidapps Title</strong> exactly as written — don't edit it</div>
            <div class="step-action">Copy <strong>r/androidapps Body</strong> and paste as post text</div>
            <div class="step-action">Add image gallery: <strong>feature_graphic_1024x500.png + screenshot_2_dashboard.png + screenshot_3_stats.png</strong></div>
            <div class="step-action">Use "Link + Image" post type, not just text</div>
            <div class="step-action">Stay online for 2 hours to respond to every comment — early engagement boosts ranking</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('reddit')">r/androidapps Post</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">Play Store Assets</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">14</div>
          <div class="step-timing">11:00 AM EST — Reddit</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post on r/privacy</div>
          <div class="step-desc">High-intent privacy-focused audience. These users actually care about local-first design — they're not casual readers. The post angle is already right for this community.</div>
          <div class="step-actions">
            <div class="step-action">Copy <strong>r/privacy Title + Body</strong> exactly as written</div>
            <div class="step-action">Attach image: <strong>reddit_privacy.png</strong> as the single post image</div>
            <div class="step-action">Do NOT cross-post the r/androidapps text here — different angle required</div>
            <div class="step-action">Read the top 3 pinned posts in r/privacy first so you understand tone expectations</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('reddit')">r/privacy Post</button>
            <span class="step-ref-label">Thumbnails →</span>
            <button class="thumb-ref" onclick="showPage('thumbs')">reddit_privacy.png</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">15</div>
          <div class="step-timing">2:00 PM EST — Reddit</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post on r/SideProject</div>
          <div class="step-desc">Community of builders. The builder-story angle works perfectly here — they care about the process, not just the product. No promotional images needed.</div>
          <div class="step-actions">
            <div class="step-action">Copy <strong>r/SideProject Title + Body</strong> exactly as written</div>
            <div class="step-action">No image needed for this post — text-only works better in this community</div>
            <div class="step-action">At the end, add 1–2 sentences about what you'd do differently — r/SideProject loves retrospectives</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('reddit')">r/SideProject Post</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">16</div>
          <div class="step-timing">All day — Monitor</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Respond to every comment within 2 hours</div>
          <div class="step-desc">Early response rate is a ranking signal on both Reddit and Product Hunt. Being active in your own threads dramatically increases visibility.</div>
          <div class="step-actions">
            <div class="step-action">Check all three Reddit posts every 30 minutes for the first 6 hours</div>
            <div class="step-action">On Product Hunt: reply to every comment, especially critical ones — show you read feedback</div>
            <div class="step-action">On Twitter: retweet any shares, reply to quote tweets</div>
            <div class="step-action">DM 5–10 friends who use Android — ask for an honest Play Store review (not a fake 5-star)</div>
            <div class="step-action">Do NOT reply to criticism defensively — thank them and ask what would make it better</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHASE 3 -->
  <div class="roadmap-phase">
    <div class="phase-header">
      <div class="phase-badge phase-post">Phase 3</div>
      <div>
        <div class="phase-title">Finance Community Push</div>
        <div class="phase-meta">Days 3–7 after launch — don't post too soon</div>
      </div>
    </div>

    <div class="alert alert-blue"><strong>Timing note:</strong> Wait at least 3 days after your r/androidapps post before hitting finance communities. Spacing prevents karma suspension and looks less spammy. These communities care about value, not virality.</div>

    <div class="step-list">
      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">17</div>
          <div class="step-timing">Day 3 post-launch — Reddit</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post on r/personalfinance</div>
          <div class="step-desc">Largest relevant Reddit audience (18M+ members). The financial runway angle is genuinely useful and educational — not promotional. Lead with the concept, not the app.</div>
          <div class="step-actions">
            <div class="step-action">Copy <strong>r/personalfinance Title + Body</strong> — this title asks a question, which performs well here</div>
            <div class="step-action">No images — r/personalfinance prefers clean text posts</div>
            <div class="step-action">The post naturally mentions Luno at the end — don't add more promotional language</div>
            <div class="step-action">Post Tuesday or Wednesday, 9–11 AM EST</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('reddit')">r/personalfinance Post</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">18</div>
          <div class="step-timing">Day 5 post-launch — Reddit</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post on r/financialindependence</div>
          <div class="step-desc">The FIRE community deeply resonates with the "financial runway" concept — it maps directly to their "FI number" thinking. Adapt the r/personalfinance body slightly.</div>
          <div class="step-actions">
            <div class="step-action">Use <strong>r/personalfinance Body</strong> as the starting point</div>
            <div class="step-action">Change the opener to: <em>"The metric at the core of FIRE thinking is financial runway..."</em></div>
            <div class="step-action">Add a line connecting runway to FI number / FIRE date</div>
            <div class="step-action">Title: <em>"I built a free app that calculates your financial runway — how many days you could survive without income"</em></div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('reddit')">r/personalfinance (adapt this)</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">19</div>
          <div class="step-timing">Day 7 post-launch — Outreach</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Send outreach to 5 privacy-focused creators</div>
          <div class="step-desc">A single mention from Techlore, The Hated One, or a similar channel can drive thousands of installs. Use the outreach template — personalise the opener for each creator.</div>
          <div class="step-actions">
            <div class="step-action">Copy <strong>Creator Outreach Email</strong> template from Directories section</div>
            <div class="step-action">For each email: change the opening line to reference their specific recent video</div>
            <div class="step-action">Targets: Techlore, The Hated One, Rob Braxman, Side of Burritos, PrivacyGuides</div>
            <div class="step-action">Find their contact via YouTube "About" tab or their personal site</div>
            <div class="step-action">Do not send bulk — personalise each one, send over 2–3 days</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('alternativeto')">Outreach Email Template</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHASE 4 -->
  <div class="roadmap-phase">
    <div class="phase-header">
      <div class="phase-badge phase-sustain">Phase 4</div>
      <div>
        <div class="phase-title">Sustain &amp; Second Wave</div>
        <div class="phase-meta">Week 2–Month 2 — keep momentum, then re-launch with Phase 3 update</div>
      </div>
    </div>

    <div class="step-list">
      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">20</div>
          <div class="step-timing">Week 2 — Twitter</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Post first-week numbers tweet</div>
          <div class="step-desc">Share real metrics. Even if the numbers aren't huge, the transparency and #buildinpublic angle will perform well. Authenticity builds followers.</div>
          <div class="step-actions">
            <div class="step-action">Template: <em>"Luno — 1 week since launch. [X] installs. [X] Play Store reviews. Here's what I learned. 🧵"</em></div>
            <div class="step-action">Thread: breakdown of what worked (Reddit? PH? Twitter?), what surprised you, what you're fixing next</div>
            <div class="step-action">Attach a screenshot of your Play Store stats (crop out sensitive info)</div>
            <div class="step-action">Add hashtags: <strong>#buildinpublic #indiedev</strong></div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Hashtags →</span>
            <button class="step-ref" onclick="showPage('twitter')">Dev Log Tags</button>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">21</div>
          <div class="step-timing">Week 2–4 — Ongoing</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Respond to every Play Store review</div>
          <div class="step-desc">Play Store algorithm rewards response rate. A thoughtful reply to a 1-star review is more valuable than a generic 5-star response. Every reply is also public — other users read them.</div>
          <div class="step-actions">
            <div class="step-action">1-star reviews: thank them, ask what broke, offer to help via email</div>
            <div class="step-action">2–3-star reviews: acknowledge the feedback, mention if you're working on the issue</div>
            <div class="step-action">4–5-star reviews: thank them and mention a specific feature you're building next</div>
            <div class="step-action">Check Play Store Console daily for the first month</div>
          </div>
        </div>
      </div>

      <div class="step-card">
        <div class="step-card-head">
          <div class="step-number">22</div>
          <div class="step-timing">Month 2 — Phase 3 Update</div>
        </div>
        <div class="step-card-body">
          <div class="step-title">Re-launch with Phase 3 Insights Layer update</div>
          <div class="step-desc">A major update gives you a second launch. Ship weekly summaries + spending alerts, then repeat the launch sequence with "Luno v2.0 — Insights Layer" framing.</div>
          <div class="step-actions">
            <div class="step-action">Post update Twitter thread: <em>"Luno just got a big update. Weekly summaries. Spending alerts. Runway insights. Here's what shipped. 🧵"</em></div>
            <div class="step-action">Post update on r/androidapps: <em>"[Update] Luno v2 — Added weekly summaries and spending alerts. Still local-first."</em></div>
            <div class="step-action">Post a Product Hunt "Post an Update" on your existing listing</div>
            <div class="step-action">Submit to AppBrain — use <strong>Short Directory Description</strong> from Directories section</div>
            <div class="step-action">Consider a small price increase on premium after this update</div>
          </div>
          <div class="step-refs">
            <span class="step-ref-label">Post content →</span>
            <button class="step-ref" onclick="showPage('alternativeto')">Short Directory Description</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ─── REDDIT ─────────────────────────────────────────────────────── -->
<div id="page-reddit" class="page">
  <div class="page-title">Reddit Posts</div>
  <p class="page-sub">Post in r/androidapps, r/privacy, r/personalfinance, r/financialindependence, r/SideProject. Use separate posts for each subreddit — never cross-post the same text.</p>

  <div class="notice"><strong>Timing:</strong> Post Tuesday–Thursday between 9–11 AM EST. Avoid weekends. Title is the most important element on Reddit — nail it before anything else.</div>

  <!-- POST 1 -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">r/androidapps — Launch Post</div>
      <div class="platform-meta">Best for initial install volume · Use with: feature_graphic_1024x500 + screenshot_2 + screenshot_3</div>
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
      <div class="platform-meta">High intent, privacy-first audience · Use with: reddit_privacy.png</div>
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
      <div class="platform-meta">Largest relevant audience. Be helpful, not salesy. No promotional images.</div>
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
      <div class="platform-meta">Community of makers. Be authentic about the journey. No images needed.</div>
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
      <div class="platform-meta">Pin this. Post all tweets back-to-back as a thread. Tweet 1 → attach tw_1_launch.png · Tweet 6 → attach tw_2_privacy.png</div>
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
      <div class="platform-meta">Post 3–4x/week before and after launch · Use these to warm up your account</div>
    </div>
  </div>

  <div class="post-card">
    <div class="post-card-head"><span class="post-label">Dev Log — Analytics · Attach: tw_3_analytics.png</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-1')">Copy</button></div>
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
    <div class="post-card-head"><span class="post-label">Dev Log — Privacy · Attach: tw_2_privacy.png</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-2')">Copy</button></div>
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
    <div class="post-card-head"><span class="post-label">Dev Log — Freemium · No image needed</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-3')">Copy</button></div>
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
    <div class="post-card-head"><span class="post-label">Dev Log — Milestone · Attach: tw_1_launch.png</span><button class="copy-btn" onclick="copyText(this, 'tw-dev-4')">Copy</button></div>
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
      <div class="platform-meta">All fields for your Product Hunt submission · Upload: ph_1 → ph_2 → ph_3 → ph_4 in gallery order</div>
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
      <div class="platform-meta">For Techlore, The Hated One, Rob Braxman, privacy-focused creators</div>
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
  <div class="page-title">Thumbnails &amp; Visual Assets</div>
  <p class="page-sub">All 16 production assets across 4 platforms. Click any image to open full-size. Specs below each gallery.</p>

  <!-- PLAY STORE -->
  <div class="platform-header" style="margin-top:0;">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">▶</div>
    <div>
      <div class="platform-title">Google Play Store</div>
      <div class="platform-meta">6 assets · Feature graphic + 5 screenshots</div>
    </div>
  </div>

  <div class="thumb-gallery">
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/feature_graphic_1024x500.png" target="_blank">
          <img src="thumbnails/playstore/feature_graphic_1024x500.png" alt="Feature Graphic" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">feature_graphic_1024x500.png</div>
        <div class="thumb-item-desc">Store header banner — required for Play Store search placement</div>
        <div class="thumb-item-dim">1024 × 500 px · PNG</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/screenshot_1_onboarding.png" target="_blank">
          <img src="thumbnails/playstore/screenshot_1_onboarding.png" alt="Onboarding" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">screenshot_1_onboarding.png</div>
        <div class="thumb-item-desc">Caption: "Build your finance cockpit"</div>
        <div class="thumb-item-dim">Screenshot 1 of 5</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/screenshot_2_dashboard.png" target="_blank">
          <img src="thumbnails/playstore/screenshot_2_dashboard.png" alt="Dashboard" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">screenshot_2_dashboard.png</div>
        <div class="thumb-item-desc">Caption: "Everything at a glance"</div>
        <div class="thumb-item-dim">Screenshot 2 of 5 · Use in Reddit r/androidapps</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/screenshot_3_stats.png" target="_blank">
          <img src="thumbnails/playstore/screenshot_3_stats.png" alt="Stats" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">screenshot_3_stats.png</div>
        <div class="thumb-item-desc">Caption: "Know your runway"</div>
        <div class="thumb-item-dim">Screenshot 3 of 5 · Use in Reddit r/androidapps</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/screenshot_4_transactions.png" target="_blank">
          <img src="thumbnails/playstore/screenshot_4_transactions.png" alt="Transactions" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">screenshot_4_transactions.png</div>
        <div class="thumb-item-desc">Caption: "Every transaction, tracked"</div>
        <div class="thumb-item-dim">Screenshot 4 of 5</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/playstore/screenshot_5_categories.png" target="_blank">
          <img src="thumbnails/playstore/screenshot_5_categories.png" alt="Categories" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">screenshot_5_categories.png</div>
        <div class="thumb-item-desc">Caption: "Your data. Your device."</div>
        <div class="thumb-item-dim">Screenshot 5 of 5</div>
      </div>
    </div>
  </div>

  <div class="thumb-card" style="margin-top:16px;">
    <div class="thumb-sub" style="margin-bottom:10px;">Play Store specs</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Feature Graphic</div><div class="spec-val">1024 × 500 px</div></div>
      <div class="spec-row"><div class="spec-key">Screenshots</div><div class="spec-val">Min 320px, Max 3840px</div></div>
      <div class="spec-row"><div class="spec-key">App Icon</div><div class="spec-val">512 × 512 px PNG</div></div>
      <div class="spec-row"><div class="spec-key">Promo Video</div><div class="spec-val">YouTube link, 30–120s</div></div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- PRODUCT HUNT -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(218,85,47,0.15);">🏹</div>
    <div>
      <div class="platform-title">Product Hunt</div>
      <div class="platform-meta">4 assets · Gallery images for PH listing</div>
    </div>
  </div>

  <div class="thumb-gallery">
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/producthunt/ph_1_dashboard.png" target="_blank">
          <img src="thumbnails/producthunt/ph_1_dashboard.png" alt="PH Dashboard" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">ph_1_dashboard.png</div>
        <div class="thumb-item-desc">Gallery #1 — "Your net position, always visible"</div>
        <div class="thumb-item-dim">Use as Coming Soon preview image</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/producthunt/ph_2_analytics.png" target="_blank">
          <img src="thumbnails/producthunt/ph_2_analytics.png" alt="PH Analytics" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">ph_2_analytics.png</div>
        <div class="thumb-item-desc">Gallery #2 — "Burn rate. Savings rate. Runway."</div>
        <div class="thumb-item-dim">1270 × 760 px recommended</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/producthunt/ph_3_transactions.png" target="_blank">
          <img src="thumbnails/producthunt/ph_3_transactions.png" alt="PH Transactions" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">ph_3_transactions.png</div>
        <div class="thumb-item-desc">Gallery #3 — "Every transaction, every account"</div>
        <div class="thumb-item-dim">1270 × 760 px recommended</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/producthunt/ph_4_categories.png" target="_blank">
          <img src="thumbnails/producthunt/ph_4_categories.png" alt="PH Categories" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">ph_4_categories.png</div>
        <div class="thumb-item-desc">Gallery #4 — "50+ categories, fully customisable"</div>
        <div class="thumb-item-dim">1270 × 760 px recommended</div>
      </div>
    </div>
  </div>

  <div class="thumb-card" style="margin-top:16px;">
    <div class="thumb-sub" style="margin-bottom:10px;">Product Hunt specs</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Thumbnail</div><div class="spec-val">240 × 240 px</div></div>
      <div class="spec-row"><div class="spec-key">Gallery Images</div><div class="spec-val">1270 × 760 px</div></div>
      <div class="spec-row"><div class="spec-key">Format</div><div class="spec-val">PNG or JPG</div></div>
      <div class="spec-row"><div class="spec-key">Max per listing</div><div class="spec-val">8 images</div></div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- TWITTER -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(29,161,242,0.15);">𝕏</div>
    <div>
      <div class="platform-title">Twitter / X</div>
      <div class="platform-meta">4 assets · Attach to launch thread and dev logs</div>
    </div>
  </div>

  <div class="thumb-gallery">
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/twitter/tw_1_launch.png" target="_blank">
          <img src="thumbnails/twitter/tw_1_launch.png" alt="Twitter Launch" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">tw_1_launch.png</div>
        <div class="thumb-item-desc">Tweet 1 of launch thread + Milestone dev log</div>
        <div class="thumb-item-dim">1600 × 900 px · Also use as Twitter banner</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/twitter/tw_2_privacy.png" target="_blank">
          <img src="thumbnails/twitter/tw_2_privacy.png" alt="Twitter Privacy" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">tw_2_privacy.png</div>
        <div class="thumb-item-desc">Tweet 6 of launch thread + Privacy dev log</div>
        <div class="thumb-item-dim">1600 × 900 px</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/twitter/tw_3_analytics.png" target="_blank">
          <img src="thumbnails/twitter/tw_3_analytics.png" alt="Twitter Analytics" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">tw_3_analytics.png</div>
        <div class="thumb-item-desc">Analytics dev log (first warm-up tweet)</div>
        <div class="thumb-item-dim">1600 × 900 px</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/twitter/tw_4_buildinpublic.png" target="_blank">
          <img src="thumbnails/twitter/tw_4_buildinpublic.png" alt="Build in Public" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">tw_4_buildinpublic.png</div>
        <div class="thumb-item-desc">General #buildinpublic dev log posts</div>
        <div class="thumb-item-dim">1600 × 900 px</div>
      </div>
    </div>
  </div>

  <div class="thumb-card" style="margin-top:16px;">
    <div class="thumb-sub" style="margin-bottom:10px;">Twitter / X specs</div>
    <div class="spec-grid">
      <div class="spec-row"><div class="spec-key">Single image</div><div class="spec-val">1600 × 900 px</div></div>
      <div class="spec-row"><div class="spec-key">2-image grid</div><div class="spec-val">700 × 800 px each</div></div>
      <div class="spec-row"><div class="spec-key">Profile banner</div><div class="spec-val">1500 × 500 px</div></div>
      <div class="spec-row"><div class="spec-key">Format</div><div class="spec-val">PNG, max 5MB</div></div>
    </div>
  </div>

  <hr class="divider"/>

  <!-- REDDIT -->
  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(255,69,0,0.15);">🟠</div>
    <div>
      <div class="platform-title">Reddit</div>
      <div class="platform-meta">2 assets · r/androidapps and r/privacy posts</div>
    </div>
  </div>

  <div class="thumb-gallery">
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/reddit/reddit_androidapps.png" target="_blank">
          <img src="thumbnails/reddit/reddit_androidapps.png" alt="Reddit androidapps" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">reddit_androidapps.png</div>
        <div class="thumb-item-desc">r/androidapps launch post header image</div>
        <div class="thumb-item-dim">Max 20MB · 1:1 or 4:3 ratio recommended</div>
      </div>
    </div>
    <div class="thumb-item">
      <div class="thumb-img-wrap">
        <a href="thumbnails/reddit/reddit_privacy.png" target="_blank">
          <img src="thumbnails/reddit/reddit_privacy.png" alt="Reddit privacy" loading="lazy"/>
        </a>
      </div>
      <div class="thumb-item-body">
        <div class="thumb-item-name">reddit_privacy.png</div>
        <div class="thumb-item-desc">r/privacy post — attach as single image</div>
        <div class="thumb-item-dim">Max 20MB · PNG or JPG</div>
      </div>
    </div>
  </div>

  <div class="thumb-card" style="margin-top:16px;">
    <div class="thumb-sub" style="margin-bottom:10px;">Reddit image usage guide</div>
    <div class="copy-block" onclick="copyBlock(this, 'spec-reddit')">
      <div class="copy-block-label">r/androidapps image gallery order <span>click to copy</span></div>
      <pre id="spec-reddit">Reddit image gallery (attach to r/androidapps post):
1. feature_graphic_1024x500.png — establishes the brand
2. screenshot_2_dashboard.png — shows core UI
3. screenshot_3_stats.png — shows premium analytics value
4. screenshot_4_transactions.png — shows daily usage
5. screenshot_1_onboarding.png — shows ease of setup

Keep images clean — no heavy marketing text overlays.</pre>
    </div>
  </div>
</div>

<!-- ─── CHECKLIST ─────────────────────────────────────────────────── -->
<div id="page-checklist" class="page">
  <div class="page-title">Launch Checklist</div>
  <p class="page-sub">Sequenced in execution order. Check items off as you go. For the full "what to do" instructions on each step, see the <button onclick="showPage('roadmap')" style="background:none;border:none;color:var(--accent);cursor:pointer;font-family:var(--sans);font-size:15px;padding:0;text-decoration:underline;">Roadmap</button>.</p>

  <div class="platform-header">
    <div class="platform-icon" style="background:rgba(155,110,255,0.15);">⚙</div>
    <div>
      <div class="platform-title">Phase 0 — Setup (Do First)</div>
      <div class="platform-meta">Before any public posting</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Play Store listing complete</strong> — feature graphic, 5 screenshots, short desc, long desc, privacy policy URL</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Landing page live and verified</strong> — all pages load, Play Store button works, mobile responsive</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Twitter/X account created</strong> — handle, bio with Play Store link, profile image, banner set</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>AlternativeTo listing submitted</strong> — listed vs Mint, YNAB, Money Manager, Spendee</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(255,140,74,0.15);">📢</div>
    <div>
      <div class="platform-title">Phase 1 — Warm-Up (Week −2 to −1)</div>
      <div class="platform-meta">Build credibility before launch day</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Tweet 1 posted</strong> — Dev Log Analytics (attach tw_3_analytics.png)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Tweet 2 posted</strong> — Dev Log Privacy (attach tw_2_privacy.png)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Tweet 3 posted</strong> — Dev Log Freemium (text only)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Product Hunt "Coming Soon" page live</strong> — followers collecting</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Tweet 4 posted</strong> — Milestone / "Going Live Soon" (attach tw_1_launch.png, include PH link)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Support email set up</strong> — canned responses drafted for top 3 questions</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>All post content pre-written</strong> — open this kit, copy-paste ready for launch day</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(255,92,74,0.15);">🚀</div>
    <div>
      <div class="platform-title">Phase 2 — Launch Day</div>
      <div class="platform-meta">Execute in this exact order</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>12:01 AM PST — Product Hunt live</strong> — listing submitted with all 4 gallery images (ph_1 → ph_4)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Maker comment posted immediately</strong> — personal story, not feature list</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>9 AM EST — Twitter launch thread</strong> — all 7 tweets, tw_1 on tweet 1, tw_2 on tweet 6, pinned</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>10 AM EST — r/androidapps post</strong> — with image gallery (feature_graphic + screenshot_2 + screenshot_3)</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>11 AM EST — r/privacy post</strong> — attach reddit_privacy.png</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>2 PM EST — r/SideProject post</strong> — text only, builder story</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Notify personal network</strong> — DM friends for honest Play Store reviews</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Monitor and respond all day</strong> — reply to every comment within 2 hours</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(74,158,255,0.15);">📈</div>
    <div>
      <div class="platform-title">Phase 3 — Finance Push (Days 3–7)</div>
      <div class="platform-meta">Don't post too soon after launch day</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Day 3 — r/personalfinance post</strong> — financial runway angle, no images, Tuesday–Thursday 9 AM EST</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Day 5 — r/financialindependence post</strong> — adapt r/personalfinance body with FIRE angle</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Day 7 — YouTuber outreach sent</strong> — 5 personalised emails using outreach template</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">🌐</div>
    <div>
      <div class="platform-title">Phase 4 — Sustain (Week 2–Month 2)</div>
      <div class="platform-meta">Keep momentum, then re-launch with Phase 3 update</div>
    </div>
  </div>

  <div class="checklist">
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Week 2 — first-week numbers tweet posted</strong> — installs, reviews, what worked</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Responding to every Play Store review</strong> — 1-star, 5-star, every review gets a reply</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>AppBrain listing submitted</strong> — use Short Directory Description</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Phase 3 Insights Layer shipped</strong> — weekly summaries + spending alerts</div></div>
    <div class="check-item"><div class="check-box" onclick="this.classList.toggle('done')"></div><div class="check-text"><strong>Second-wave launch executed</strong> — update thread on Twitter + r/androidapps + PH update post</div></div>
  </div>

  <div class="platform-header" style="margin-top:36px;">
    <div class="platform-icon" style="background:rgba(134,197,60,0.15);">🗓</div>
    <div>
      <div class="platform-title">Timeline at a Glance</div>
      <div class="platform-meta">Week-by-week summary</div>
    </div>
  </div>

  <div class="timeline">
    <div class="tl-item">
      <div class="tl-dot done"></div>
      <div class="tl-week">Now</div>
      <div class="tl-title">Phase 0 — Store &amp; asset setup</div>
      <div class="tl-desc">Play Store listing complete. Landing page live. Twitter account created. AlternativeTo submitted.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Week −2 to −1</div>
      <div class="tl-title">Phase 1 — Build-in-public warm-up</div>
      <div class="tl-desc">4–5 dev log tweets posted. PH coming soon page live. Support email ready. All post content pre-written.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Launch Day</div>
      <div class="tl-title">Phase 2 — Full launch</div>
      <div class="tl-desc">Product Hunt 12:01 AM PST. Twitter thread 9 AM EST. Reddit r/androidapps + r/privacy + r/SideProject same day.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Days 3–7</div>
      <div class="tl-title">Phase 3 — Finance community push</div>
      <div class="tl-desc">r/personalfinance + r/financialindependence + YouTuber outreach emails sent.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Week 2–4</div>
      <div class="tl-title">Phase 4 — Sustain</div>
      <div class="tl-desc">First-week numbers tweet. Play Store review responses. AppBrain listing.</div>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <div class="tl-week">Month 2</div>
      <div class="tl-title">Phase 5 — Second wave</div>
      <div class="tl-desc">Ship Phase 3 Insights Layer. Full re-launch on all platforms. Consider premium price increase.</div>
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
  const page = document.getElementById('page-' + id);
  if (page) {
    page.classList.add('active');
    window.scrollTo(0, 0);
  }
  document.querySelectorAll('.nav-tab').forEach(t => {
    if (t.getAttribute('onclick') && t.getAttribute('onclick').includes("'" + id + "'")) t.classList.add('active');
  });
  document.querySelectorAll('.sidebar-link').forEach(l => {
    if (l.getAttribute('onclick') && l.getAttribute('onclick').includes("'" + id + "'")) l.classList.add('active');
  });
}

function copyText(btn, id) {
  const el = document.getElementById(id);
  if (!el) return;
  const text = el.innerText;
  navigator.clipboard.writeText(text).then(() => {
    const orig = btn.textContent;
    btn.textContent = 'Copied!';
    btn.classList.add('copied');
    setTimeout(() => { btn.textContent = orig; btn.classList.remove('copied'); }, 2000);
  });
}

function copyBlock(el, id) {
  const text = document.getElementById(id).innerText;
  navigator.clipboard.writeText(text).then(() => {
    const label = el.querySelector('.copy-block-label span');
    const orig = label.textContent;
    label.textContent = 'Copied!';
    setTimeout(() => { label.textContent = orig; }, 2000);
  });
}
</script>
</body>
</html>
