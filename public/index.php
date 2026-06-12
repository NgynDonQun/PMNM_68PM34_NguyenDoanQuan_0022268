<?php
    require_once '../app/middleware.php';
    $middleware = new middleware();
    $middleware->checklogin();
    $app = new App();
?>
