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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?php echo htmlspecialchars($page_meta); ?>"/>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300;12..96,400;12..96,500;12..96,700;12..96,800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/styles.css"/>
</head>
<body>

<nav>
    <div class="nav-logo">LUNO<span>.</span></div>
    <div class="nav-links">
        <a href="<?php echo BASE_URL; ?>/index.php">Home</a>
        <a href="<?php echo BASE_URL; ?>/index.php#features">Features</a>
        <a href="<?php echo BASE_URL; ?>/index.php#analytics">Analytics</a>
        <a href="<?php echo BASE_URL; ?>/privacy.php">Privacy Policy</a>
        <a href="<?php echo BASE_URL; ?>/terms.php">Terms</a>
    </div>
    <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="nav-btn">Get the App</a>
</nav>
