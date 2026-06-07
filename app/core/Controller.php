<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewName, $data = []) {
        extract($data);
        require_once '../app/views/' . $viewName . '.php';
    }
}