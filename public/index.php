<?php
session_start();

// Define base path constants
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Improved autoloader
spl_autoload_register(function ($class) {
    // Define mapping of namespaces to directories
    $namespaces = [
        'App\\Controllers\\' => APP_PATH . '/controllers/',
        'App\\Models\\' => APP_PATH . '/models/',
        'App\\Core\\' => APP_PATH . '/core/'
    ];

    // Check each namespace
    foreach ($namespaces as $prefix => $base_dir) {
        // Check if class uses this namespace
        if (strpos($class, $prefix) === 0) {
            // Get the relative class name
            $relative_class = substr($class, strlen($prefix));
            
            // Convert namespace separators to directory separators
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            
            // If the file exists, require it
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});

// Load helpers
require_once APP_PATH . '/core/helpers.php';

// Load configuration
$config = require_once APP_PATH . '/config/database.php';

// Include the router file
require_once APP_PATH . '/routes.php';

// Default to movies page if no route is matched
if (!isset($_GET['page'])) {
    require_once APP_PATH . '/views/movies.php';
} 