<?php

/**
 * php -S localhost:8000 -t ./public_html
 */

const PUBLIC_DIR = __DIR__ . DIRECTORY_SEPARATOR;

define('BASE_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);

const APP_DIR = BASE_DIR . "application" . DIRECTORY_SEPARATOR;

const SYS_DIR = BASE_DIR . "system" . DIRECTORY_SEPARATOR;

const STORAGE_DIR = BASE_DIR . "storage" . DIRECTORY_SEPARATOR;

require_once BASE_DIR . "vendor/autoload.php";

$app = new \InitPHP\Framework\Application();
$app->httpServer()
    ->boot()
    ->run();