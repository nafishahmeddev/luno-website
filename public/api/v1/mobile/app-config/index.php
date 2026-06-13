<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-App-Name, X-App-Platform, X-App-Build-Number, X-App-Version, X-App-Country, X-App-Timezone, X-App-Locale, X-App-Current-Time");
header("Content-Type: application/json");

// Handle preflight requests
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}


// Function to fetch request headers case-insensitively
function getRequestHeader($headerName) {
    $normalized = str_replace('-', '_', strtoupper($headerName));
    if (isset($_SERVER['HTTP_' . $normalized])) {
        return $_SERVER['HTTP_' . $normalized];
    }
    if (function_exists('getallheaders')) {
        $headers = getallheaders();
        foreach ($headers as $key => $value) {
            if (strcasecmp($key, $headerName) === 0) {
                return $value;
            }
        }
    }
    return null;
}

// Load configurations
$configFile = __DIR__ . '/config-rules';
if (!file_exists($configFile)) {
    echo json_encode([
        "success" => false,
        "message" => "Configuration rules file not found",
        "data" => null,
        "error" => "config_file_missing"
    ]);
    exit;
}

$configData = json_decode(file_get_contents($configFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "success" => false,
        "message" => "Failed to parse configuration rules",
        "data" => null,
        "error" => "config_parse_error"
    ]);
    exit;
}

// Retrieve custom headers
$platform = strtolower(trim(getRequestHeader('X-App-Platform') ?? ''));
$buildNumber = getRequestHeader('X-App-Build-Number');
$version = trim(getRequestHeader('X-App-Version') ?? '');

// If platform is invalid or not in config, default to 'android' or handle error
if (empty($platform) || !isset($configData[$platform])) {
    $platform = 'android';
}

$rules = $configData[$platform];

$action = 'none';
$message = '';

// Check version logic
if ($buildNumber !== null && is_numeric($buildNumber)) {
    $clientBuild = (int)$buildNumber;
    $minBuild = (int)($rules['min_build'] ?? 0);
    $latestBuild = (int)($rules['latest_build'] ?? 0);

    if ($clientBuild < $minBuild) {
        $action = 'force-update';
        $message = $rules['force_update_message'] ?? '';
    } elseif ($clientBuild < $latestBuild) {
        $action = 'suggest-update';
        $message = $rules['suggest_update_message'] ?? '';
    }
} elseif (!empty($version)) {
    $minVersion = $rules['min_version'] ?? '0.0.0';
    $latestVersion = $rules['latest_version'] ?? '0.0.0';

    if (version_compare($version, $minVersion, '<')) {
        $action = 'force-update';
        $message = $rules['force_update_message'] ?? '';
    } elseif (version_compare($version, $latestVersion, '<')) {
        $action = 'suggest-update';
        $message = $rules['suggest_update_message'] ?? '';
    }
}

// Build store redirect URLs
$androidStore = $configData['android']['store_url'] ?? '';
$iosStore = $configData['ios']['store_url'] ?? '';

echo json_encode([
    "success" => true,
    "message" => "App status resolved",
    "data" => [
        "action" => $action,
        "message" => $message,
        "links" => [
            "androidStore" => $androidStore,
            "iosStore" => $iosStore
        ]
    ],
    "error" => null
], JSON_UNESCAPED_SLASHES);
