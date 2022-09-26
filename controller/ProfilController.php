<?php
/**
 * ETML
 * Date: 29.08.2022
 * Shop
 */
include_once 'classes/ShopRepository.php';
include_once 'classes/DeliveryRepository.php';
include_once 'classes/PaidRepository.php';
include_once 'classes/OrderRepository.php';
include_once 'classes/OrderProductRepository.php';

 class ProfilController extends Controller{
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
     * Display List Action
     *
     * @return string
     */
    private function detailAction() {
        
        $view = file_get_contents('view/page/profil/detail.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}