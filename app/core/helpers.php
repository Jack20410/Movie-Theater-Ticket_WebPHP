<?php

/**
 * Load a view file
 * @param string $view View file name
 * @param array $data Data to pass to the view
 */
function view($view, $data = []) {
    // Extract data to make variables available in view
    extract($data);
    
    $view_file = APP_PATH . '/views/' . $view . '.php';
    if (file_exists($view_file)) {
        require $view_file;
    } else {
        throw new Exception("View {$view} not found");
    }
}

/**
 * Redirect to another page
 * @param string $path Path to redirect to
 */
function redirect($path) {
    header("Location: " . $path);
    exit;
}

/**
 * Get current URL path
 * @return string
 */
function getCurrentPath() {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

/**
 * Escape HTML to prevent XSS
 * @param string $string String to escape
 * @return string
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Get session flash message
 * @param string $key Message key
 * @return string|null
 */
function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}

/**
 * Set session flash message
 * @param string $key Message key
 * @param string $message Message content
 */
function setFlashMessage($key, $message) {
    $_SESSION[$key] = $message;
}

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Get current user ID
 * @return int|null
 */
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Format price to currency
 * @param float $price
 * @return string
 */
function formatPrice($price) {
    return 'Rp ' . number_format($price, 0, ',', '.');
}

/**
 * Format date to readable format
 * @param string $date
 * @return string
 */
function formatDate($date) {
    return date('d F Y', strtotime($date));
} 