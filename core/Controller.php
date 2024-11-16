<?php

class Controller {
    public function view($view, $data = []) {
        $viewPath = '../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View file '$viewPath' not found.");
        }
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}
?>
