<?php
    session_start();
    require_once('config.php');
    $supported_controllers = array(
        'home' => array('index', 'error','login'),
    );

    if (isset($_GET['controller'])) {
        $controller = $_GET['controller'];
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }else {
            $action = 'index';
            echo $action;
        }
    }else {
        $controller = 'home';
        $action = 'index';
    }

    if (!array_key_exists($controller, $supported_controllers) ||
        !in_array($action, $supported_controllers[$controller])) {
        $controller = 'home';
        $action = 'error';
    }



