<?php
    session_start();
    class auth{
        protected $user=[
            'admin' => '00000',
            'tai' => '0024268'
        ];
        public function login() {
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                    $_SESSION['username'] = $username;
                    header('Location: /home/index');
                    exit();
                } else {
                    header('Location: /home/login');
                    exit();
                }
            }
        }

        public function logout() {
            $_SESSION = [];
            session_unset();
            session_destroy();
            header('Location: /home/login');
            exit();
        }
    }