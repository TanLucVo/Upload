<?php
    require_once('base_controller.php');
    require_once('models/Phone.php');
    require_once('models/Account.php');
    require_once('models/Accessory.php');

    class AccountController extends BaseController {

        function __construct()
        {
            $this->name = 'account';
        }

        function profile() {
            if (isLoggedIn()) {
                $this->render('profile',array(),'template_2');
            }
            else {
                redirect('?controller=home&action=login','Please login first');
            }
        }

        function logout() {
            unset($_SESSION['user']);
            redirect('?controller=home&action=login');
        }

        function login() {

            if (isLoggedIn()) {
                redirect('?controller=account&action=profile');
            }
            else {
                $user = filter_input(INPUT_POST,'user', FILTER_SANITIZE_STRING);
                $pass = filter_input(INPUT_POST,'pass', FILTER_SANITIZE_STRING);

                if (empty($user) || empty($pass)) {
                    redirect('?controller=home&action=login');
                }else {
                    $account = Account::login($user, $pass);
                    if ($account) {
                        $_SESSION['user'] = serialize($account);
                        redirect('?controller=account&action=profile');
                    }else {
                        redirect('?controller=home&action=login','Username or password is not valid');
                    }
                }
            }

        }

    }
?>