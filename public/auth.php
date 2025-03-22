<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base path constants if not already defined
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
    define('APP_PATH', BASE_PATH . '/app');
}

// Include the AuthController
require_once APP_PATH . '/controllers/AuthController.php';

// Set JSON header
header('Content-Type: application/json');

try {
    // Handle POST requests only
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST requests are allowed');
    }

    // Create AuthController instance
    $auth = new App\Controllers\AuthController();

    // Check if action is set
    if (!isset($_POST['action'])) {
        throw new Exception('No action specified');
    }

    // Handle the request
    switch ($_POST['action']) {
        case 'login':
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                throw new Exception('Missing required login fields');
            }
            $response = $auth->login($_POST['email'], $_POST['password']);
            break;

        case 'signup':
            if (!isset($_POST['name']) || !isset($_POST['email']) || 
                !isset($_POST['password']) || !isset($_POST['re_pass'])) {
                throw new Exception('Missing required signup fields');
            }
            $response = $auth->signup(
                $_POST['name'],
                $_POST['email'],
                $_POST['password'],
                $_POST['re_pass']
            );
            break;

        case 'logout':
            $response = $auth->logout();
            break;

        default:
            throw new Exception('Invalid action specified');
    }

    // Output the response
    echo json_encode($response);

} catch (Exception $e) {
    // Handle any errors
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 