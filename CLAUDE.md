# Luno Website — Claude Context

## What this project is
Marketing website for **Luno** — a privacy-first, local-first Android personal finance app.
Built by **Nafish Ahmed** (solo indie dev). App is on Google Play: `me.nafish.luno`.

The website has two purposes:
1. **Public marketing site** — `luno.nafish.lo` (index, privacy, terms pages)
2. **Private launch kit** — `/launch-kit/` (marketing dashboard with post content, thumbnails, roadmap, checklist)

## Stack
- **Pure PHP** — no framework, no composer, no npm, no build step
- **Vanilla CSS + JS** — single `assets/css/styles.css`, no preprocessor
- **No database** — fully static content
- **Phosphor Icons** (CDN), Google Fonts (CDN)
- Apache with `.htaccess` for routing

## File structure
```
luno.nafish.lo/
├── index.php                  # Homepage + router (handles /privacy and /terms routes)
├── privacy.php                # Privacy Policy page
├── terms.php                  # Terms of Service page
├── .htaccess                  # URL routing, security headers, caching, gzip
├── favicon.png                # Site icon + OG image
├── includes/
│   ├── config.php             # BASE_URL, ASSETS_URL, CSS_URL, IMG_URL constants
│   ├── header.php             # Shared <head>, nav (requires config.php)
│   └── footer.php             # Shared footer, closes </body></html>
├── assets/
│   ├── css/styles.css         # Global stylesheet (~2000 lines)
│   └── images/                # App screenshots (mint_fresh_1..5.png)
└── launch-kit/
    ├── index.php              # Standalone HTML — launch marketing dashboard
    └── thumbnails/
        ├── playstore/         # feature_graphic_1024x500.png + 5 screenshots
        ├── producthunt/       # ph_1..4.png (gallery images)
        ├── twitter/           # tw_1..4.png (tweet images)
        └── reddit/            # reddit_androidapps.png, reddit_privacy.png
```

## Routing
All routing is in `index.php`:
- `/` → homepage
- `/privacy` → includes privacy.php
- `/terms` → includes terms.php
- anything else → 404
- `/launch-kit/` → served directly by Apache (excluded from rewrite in .htaccess)

## URL helpers
Always use PHP constants for URLs — never hardcode paths:
```php
BASE_URL    // e.g. https://luno.nafish.lo
ASSETS_URL  // BASE_URL . '/assets'
CSS_URL     // BASE_URL . '/assets/css'
IMG_URL     // BASE_URL . '/assets/images'
```
These are defined in `includes/config.php` which `header.php` auto-includes.

## Page anatomy
Every public page follows this pattern:
```php
<?php include_once __DIR__ . '/includes/header.php'; ?>
<!-- page HTML -->
<?php include_once __DIR__ . '/includes/footer.php'; ?>
```
`header.php` outputs everything from `<!DOCTYPE html>` through the `<nav>`. `footer.php` closes `</body></html>`.

Per-page meta overrides go **before** including header.php:
```php
<?php
$page_title = 'Privacy Policy';
$page_meta  = 'How Luno handles your data...';
include_once __DIR__ . '/includes/header.php';
?>
```

## CSS conventions
- Design token CSS variables defined in `:root` — use them, don't hardcode colors
- Key tokens: `--bg`, `--card`, `--border`, `--accent` (#86C53C mint green), `--text`, `--muted`, `--dim`
- Typography: `--sans` (Bricolage Grotesque), `--mono` (JetBrains Mono)
- Mobile breakpoint: `@media (max-width: 768px)`
- Dark theme only — no light mode toggle

## Launch kit
`launch-kit/index.php` is a **self-contained single HTML file** — no PHP, no external dependencies beyond Google Fonts CDN. All CSS is inline `<style>`. All JS is inline `<script>` at the bottom.

Sections (tab-based SPA navigation via `showPage(id)`):
- `roadmap` — 22-step launch roadmap with cross-links to posts and thumbnails
- `reddit` — 4 Reddit posts (r/androidapps, r/privacy, r/personalfinance, r/SideProject)
- `twitter` — 7-tweet launch thread + 4 dev log tweets + hashtag sets
- `producthunt` — full PH listing copy (name, tagline, description, maker comment, tags)
- `alternativeto` — directory descriptions + creator outreach email template
- `thumbs` — visual gallery of all 16 thumbnail assets with specs
- `checklist` — phase-by-phase launch checklist with timeline

## App details (for writing copy)
- **Name:** Luno
- **Tagline:** "Your money. Your rules."
- **Privacy model:** 100% local — SQLite on-device, zero network requests to Luno servers, no account
- **Free tier:** full transaction tracking, multi-account, 50+ categories, themes
- **Premium:** analytics engine — daily burn rate, savings rate, financial runway, in/out ratio, period comparison
- **Premium model:** lifetime one-time purchase (no subscription)
- **Stack (app):** React Native + Expo + Expo Router + Drizzle ORM + Expo SQLite + Reanimated
- **Platforms:** Android only (Google Play). No iOS yet.
- **Developer:** Nafish Ahmed (solo, indie)
- **Phase:** Phase 2 — Premium Available

## Production deployment
- Local dev: `/Users/ahmed/Documents/Projects/Personal/php/luno.nafish.lo`
- Server root: `/var/www/luno.nafish.lo`
- Apache + PHP — standard shared hosting setup
- No build step — deploy by syncing files

## Key decisions already made
- No framework (intentional — simplicity, no dependencies, instant deploy)
- No database (intentional — aligns with Luno's privacy-first brand)
- Launch kit is a private tool, not linked from the public site
- `.htaccess` excludes `/launch-kit/` from the PHP router so it runs standalone
- All image paths use `IMG_URL` constant (never relative paths like `assets/images/...`)
