<?php
    require_once('base_controller.php');
    require_once('models/Phone.php');
    require_once('models/Accessory.php');

    class HomeController extends BaseController {

        function __construct()
        {
            $this->name = 'home';
        }

        function index() {
            $manufacture = Manufacture::getAll();
            $accessory = Accessory::getAll(6);

            $this->render('index',
                array('manufacture' => $manufacture ,
                    'accessory' => $accessory));
        }

        function login() {
            $this->render('login',array(),'template_2');
        }

        function error() {
            $this->render('error',array(),'template_2');
        }
    }
?>