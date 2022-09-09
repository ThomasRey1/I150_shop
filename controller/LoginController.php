<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */
include_once 'classes/LoginRepository.php';

class LoginController extends Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Display Index Action
     *
     * @return string
     */
    private function indexAction() {

        $view = file_get_contents('view/page/login/index.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Login Action
     *
     * @return string
     */
    private function loginAction() {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $loginRepository = new LoginRepository();
        $result = $loginRepository->login($login, $password);


        $text = "Vous n'êtes pas connnecté ! ";

        if($result == true){
            $text = "Vous êtes connecté ! ";
        }

        $view = file_get_contents('view/page/login/confirm.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Diplay Logout Action
     * 
     * @return string
     */
    private function logoutAction() {
        $_SESSION['right'] = null;

        $view = file_get_contents('view/page/login/index.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;

    }

}