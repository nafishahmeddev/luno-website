<?php
/**
 * Application Configuration
 * ===========================
 * Central configuration for the Luno website
 */

// Get the base URL
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

// Trim trailing slash
if (substr($base_url, -1) === '/') {
    $base_url = substr($base_url, 0, -1);
}

// Define paths
define('BASE_URL', $base_url);
define('ASSETS_URL', BASE_URL . '/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('IMG_URL', ASSETS_URL . '/images');

// Current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Site metadata
$site_title = 'Luno — Personal Finance Manager';
$site_description = 'Local-first personal finance tracking application';
