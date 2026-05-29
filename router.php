<?php

$path = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path !== '/' && file_exists($path) && !is_dir($path)) {
    return false; // serve asset directly
}

// Your app routing
require 'index.php';