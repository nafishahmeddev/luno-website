<?php
/**
 * Header Component
 * ================
 * Shared header for all pages
 */

require_once __DIR__ . '/config.php';

// Page title (can be overridden before including this file)
$page_title = isset($page_title) ? $page_title . ' — Luno' : $site_title;
$page_meta = isset($page_meta) ? $page_meta : $site_description;
$page_keywords = isset($page_keywords)
    ? $page_keywords
    : 'personal finance app, expense tracker, budget tracker, money manager, local-first finance, privacy finance app';

$raw_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$raw_path = $raw_path ?: '/';

if ($raw_path === '/index.php') {
    $raw_path = '/';
}

$canonical_url = BASE_URL . ($raw_path === '/' ? '/' : $raw_path);
$favicon_url = BASE_URL . '/favicon.png';
$og_image_url = $favicon_url;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?php echo htmlspecialchars($page_meta); ?>"/>
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>"/>
    <meta name="author" content="Nafish Ahmed"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="theme-color" content="#000100"/>

    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>"/>
    <link rel="icon" type="image/png" href="<?php echo htmlspecialchars($favicon_url); ?>"/>
    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($favicon_url); ?>"/>

    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Luno"/>
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>"/>
    <meta property="og:description" content="<?php echo htmlspecialchars($page_meta); ?>"/>
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>"/>
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image_url); ?>"/>

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>"/>
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_meta); ?>"/>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image_url); ?>"/>

    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2/src/regular/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2/src/regular/style.css"/>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/styles.css"/>
    <!-- Prevent flash of unstyled theme -->
    <script>
        (function() {
            var saved = localStorage.getItem('luno-theme') || 'system';
            var root = document.documentElement;
            root.classList.remove('dark', 'light');
            if (saved === 'dark') {
                root.classList.add('dark');
            } else if (saved === 'light') {
                root.classList.add('light');
            } else {
                root.classList.add(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            }
        })();
    </script>
</head>
<body>

<nav class="sticky top-0 z-40 bg-nav-bg backdrop-blur-[18px] backdrop-saturate-[1.5] border-b border-surface transition-colors duration-350">
    <div class="max-w-[1100px] mx-auto px-6 h-[60px] flex items-center justify-between gap-6">
        <a href="<?php echo BASE_URL; ?>/" class="font-mono font-bold text-[17px] tracking-[0.22em] uppercase text-fg leading-none">LUNO<span class="text-primary tracking-normal">.</span></a>
        <ul class="hidden md:flex gap-7 list-none">
            <li><a href="<?php echo BASE_URL; ?>/#features"  class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Features</a></li>
            <li><a href="<?php echo BASE_URL; ?>/#analytics" class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Analytics</a></li>
            <li><a href="<?php echo BASE_URL; ?>/#insights"  class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Insights</a></li>
            <li><a href="<?php echo BASE_URL; ?>/#privacy"   class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Privacy</a></li>
        </ul>
        <div class="flex items-center gap-2">
            <button id="themeToggle" aria-label="Toggle theme" class="w-[34px] h-[34px] rounded-[9px] bg-surface text-muted border-none cursor-pointer text-[15px] flex items-center justify-center transition-colors duration-150 hover:bg-surf2 hover:text-fg">&#9728;</button>
            <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="inline-flex items-center gap-[8px] font-sans font-bold tracking-[-0.01em] no-underline border-none cursor-pointer transition-all duration-180 whitespace-nowrap text-[13px] py-[9px] px-[18px] rounded-[10px] bg-primary text-bg hover:brightness-[1.08]">Get the App</a>
        </div>
    </div>
</nav>
