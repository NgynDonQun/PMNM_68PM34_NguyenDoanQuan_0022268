<?php
class home {
    function index() {
        require_once '../app/views/home/index.php';
    }

    public function login() {
        require_once '../app/views/home/login.php';
    }
}
?>