<?php
$routes = [
    'home' => 'HomeController@index',
    'movies' => 'MovieController@index',
    'movie' => 'MovieController@show',
    'booking' => 'BookingController@index',
    'login' => 'AuthController@login',
    'signup' => 'AuthController@signup',
    'logout' => 'AuthController@logout'
];

$page = $_GET['page'] ?? 'home';

if (isset($routes[$page])) {
    list($controller, $action) = explode('@', $routes[$page]);
    $controller = 'App\\Controllers\\' . $controller;
    
    if (class_exists($controller)) {
        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $action)) {
            call_user_func([$controllerInstance, $action]);
            exit;
        }
    }
}

// If no route matches, show 404 page
require_once APP_PATH . '/views/404.php'; 