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
    <meta name="theme-color" content="#0A0F07"/>

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
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300;12..96,400;12..96,500;12..96,700;12..96,800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css"/>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/styles.css"/>
</head>
<body>

<nav>
    <div class="nav-logo">LUNO<span>.</span></div>
    <div class="nav-links">
        <a href="<?php echo BASE_URL; ?>/">Home</a>
        <a href="<?php echo BASE_URL; ?>/#features">Features</a>
        <a href="<?php echo BASE_URL; ?>/#analytics">Analytics</a>
        <a href="<?php echo BASE_URL; ?>/privacy">Privacy Policy</a>
        <a href="<?php echo BASE_URL; ?>/terms">Terms</a>
    </div>
    <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="nav-btn">Get the App</a>
</nav>
