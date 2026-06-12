<?php
require_once '../app/core/App.php';
session_start();
    class middleware {
        function checklogin() {
            $publicPages = ['/home/login', '/auth/login'];
            if (!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)) {
                header('Location: /home/login');
                exit();
            }
        }
    }
?>