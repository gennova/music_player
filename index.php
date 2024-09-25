<?php
// Start the session (if needed)
session_start();

// Define a simple routing function
function route($uri) {
    // Define the routes
    $routes = [
        '/login'=>'LoginController@index',       // Login page
        '/login/check'=>'LoginController@CheckLogin',
        '/logout'=>'LoginController@Logout',// Logout
        '/' => 'HomeController@index', // Home page
        '/search' => 'FileController@search', // Search functionality
        '/upload' => 'UploadController@index',
        '/upload/proces' => 'FileController@upload',
    
    
    ];

    // Check if the route exists
    if (array_key_exists($uri, $routes)) {
        // Get the controller and method
        list($controller, $method) = explode('@', $routes[$uri]);

        // Include the controller file
        require_once "controllers/{$controller}.php";

        // Instantiate the controller
        $controllerInstance = new $controller();

        // Call the method
        return $controllerInstance->$method();
    }

    // Return a 404 response if the route is not found
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}

// Get the requested URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Call the routing function
route($uri);
