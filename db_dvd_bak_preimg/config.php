<?php
$scriptName = $_SERVER['SCRIPT_NAME'];
$baseDir = dirname($scriptName);

if (basename($baseDir) === 'auth') {
    $baseDir = dirname($baseDir);
}

define('BASE_URL', $baseDir);
define('BASE_PATH', rtrim($baseDir, '/'));
?>