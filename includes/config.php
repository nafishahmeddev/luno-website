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
$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_path = rtrim($request_path, '/');
$current_page = $request_path === '' ? 'home' : basename($request_path);

// Site metadata
$site_title = 'Luno — Personal Finance Manager';
$site_description = 'Local-first personal finance tracking application';
