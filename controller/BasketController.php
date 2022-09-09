<?php
/**
 * ETML
 * Date: 29.08.2022
 * Shop
 */
include_once 'classes/ShopRepository.php';

 class BasketController extends Controller{
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
    private function listAction() {
        
        $view = file_get_contents('view/page/basket/list.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display Add Action
     *
     * @return string
     */
    private function addAction() {
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = array();
        }
        $already = false;
        for ($i=0; $i < count($_SESSION['basket']); $i++) { 
        //foreach ($_SESSION['basket'] as $products) {
            if($_SESSION['basket'][$i][0]['idProduct'] == $_GET['id']){
                $already = true;
                if($_SESSION['basket'][$i]['quantity'] < $_SESSION['basket'][$i][0]['proQuantity']){
                    $_SESSION['basket'][$i]['quantity'] += 1;
                }
            }
        }
        if($already == false)
        {
            $shopRepository = new ShopRepository();
            $product = $shopRepository->findOne($_GET['id']);
            $product['quantity'] = 1;
            array_push($_SESSION['basket'], $product);
        }

        $text = "ajouté au panier";

        $view = file_get_contents('view/page/basket/confirm.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    
    /**
     * Remove one product
     *
     * @return string
     */
    private function removeAction() {

        $array = array();
        for ($i=0; $i < count($_SESSION['basket']); $i++) { 
            if($_SESSION['basket'][$i][0]['idProduct'] != $_GET['id']){
                array_push($array, $_SESSION['basket'][$i]);
            }
        }

        $_SESSION['basket'] = $array;
        $text = "supprimé";

        $view = file_get_contents('view/page/basket/confirm.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display for to update one product
     *
     * @return string
     */
    private function formUpdateAction(){

        for ($i=0; $i < count($_SESSION['basket']); $i++) { 
            if($_SESSION['basket'][$i][0]['idProduct'] == $_GET['id']){
                $id = $i;
            }
        }


        $view = file_get_contents('view/page/basket/formUpdate.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Update one product
     * 
     * @return string
     */
    private function updateAction() {

        if($_POST['basketQuantity'] > $_SESSION['basket'][$_GET['id']][0]['proQuantity']){
            $_SESSION['basket'][$_GET['id']]['quantity'] = $_SESSION['basket'][$_GET['id']][0]['proQuantity'];
        }elseif($_POST['basketQuantity'] < 1){
            $_SESSION['basket'][$_GET['id']]['quantity'] = 1;
        }else{
            $_SESSION['basket'][$_GET['id']]['quantity'] = $_POST['basketQuantity'];
        }

        $text = "modifié";

        $view = file_get_contents('view/page/basket/confirm.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display for to update one product
     *
     * @return string
     */
    private function formDeliveryAction(){

        $shopRepository = new ShopRepository();
        $product = $shopRepository->findOne($_GET['id']);

        $catRepository = new CategoryRepository();
        $categories = $catRepository->findAll();

        $id = $_GET['id'];

        $view = file_get_contents('view/page/admin/formUpdate.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
 }
?>