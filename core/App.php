
<?php

class App {
    public $controller = 'HomeController'; // Default controller
    public $method = 'index'; // Default method
    public $params = []; // URL parameters

    public function __construct() {
        $url = $this->parseUrl();

        // Handle empty or root URL
        if ($url === null || empty($url[0])) {
            $url = ['HomeController', 'index']; // Explicitly set default controller and method
        }

        // Check if controller file exists
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        } elseif ($url[0] === 'login') {
            // Special case: map /login to AuthController::login
            $this->controller = 'AuthController';
            $this->method = 'login';
            unset($url[0]);
        } else {
            // Unknown route, fallback to a 404 handler
            $this->controller = 'ErrorController';
            $this->method = 'notFound';
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check if method exists in the resolved controller
        if (isset($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0]; // Set the method
            unset($url[0]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return null;
    }
}
?>
