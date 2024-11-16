<?php

class HomeController extends Controller {
    public function index() {
        // You can pass data to the view if needed
        $data = ['title' => 'Welcome to the Vulnerable PHP App'];
        $this->view('home', $data);
    }
}
?>
