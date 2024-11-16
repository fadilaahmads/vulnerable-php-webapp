<?php
  class AuthController extends Controller {
    public function login() {
      $this->view('login');
    }

    public function authenticate() {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($username == 'admin' && $password == 'password') {
        echo "Welcome, $username";
      } else {
        echo "Invalid credentials!";
      }
    }
  }
  
?>
