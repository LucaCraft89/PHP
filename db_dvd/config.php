<?php
// Get the base path dynamically
$scriptName = $_SERVER['SCRIPT_NAME'];
$baseDir = dirname($scriptName);

// Remove /auth if we're in the auth folder
if (basename($baseDir) === 'auth') {
    $baseDir = dirname($baseDir);
}

// Define base URL
define('BASE_URL', $baseDir);
define('BASE_PATH', rtrim($baseDir, '/'));
?>