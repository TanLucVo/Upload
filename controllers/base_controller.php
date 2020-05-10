<?php
    require_once('models/Manufacture.php');
    require_once('models/AccessoryType.php');
    require_once('models/Supporter.php');
    require_once('models/Phone.php');
    require_once('models/Account.php');
    require_once('models/Bill.php');
    require_once('models/OS.php');
    class BaseController {

        protected $name;

        public function render($view, $data = array(), $template = 'main_template') {

            if (!isset($manufacture)) {
                $manufacture = Manufacture::getAll();
            }
            $osList = OS::getAll();
            $accessoryType = AccessoryType::getAll();
            $mostViewed = Phone::getMostViewed(10);
            $supporter = Supporter::getAll();

            ob_start();
            extract($data);
            require_once('views/' .$this->name . '/' . $view . '.php');
            $content = ob_get_clean();
            require_once('views/layout/' . $template .'.php');
        }
    }
?>