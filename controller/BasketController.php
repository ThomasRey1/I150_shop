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
     * Display for to delivery products
     *
     * @return string
     */
    private function formDeliveryAction(){
        
        $deliveryRepository = new DeliveryRepository();
        $deliveries = $deliveryRepository->findAll();

        $view = file_get_contents('view/page/basket/formDelivery.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display for to paid products
     *
     * @return string
     */
    private function formPaidAction(){
        if(isset($_POST['deliveryMethod'])){

            $deliveryRepository = new DeliveryRepository();
            $deliveries = $deliveryRepository->findAll();

            foreach($deliveries as $delivery){
                if($delivery['delMethod'] == $_POST['deliveryMethod'])
                {
                    $paidRepository = new PaidRepository();
                    $paids = $paidRepository->findAll();
    
                    $_SESSION['delivery'] = $_POST['deliveryMethod'];
                    $view = file_get_contents('view/page/basket/formPaid.php');
    
    
                    ob_start();
                    eval('?>' . $view);
                    $content = ob_get_clean();
    
                    return $content;
                }
            }
        }
        
        $deliveryRepository = new DeliveryRepository();
        $deliveries = $deliveryRepository->findAll();

        $view = file_get_contents('view/page/basket/formDelivery.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display for address
     *
     * @return string
     */
    private function formAddressAction(){
        
        $paidRepository = new PaidRepository();
        $paids = $paidRepository->findAll();
        if(isset($_POST['paidMethod'])){
            foreach ($paids as $paid) {
                if ($paid['paiMethod'] == $_POST['paidMethod']) {
                    $_SESSION['paid'] = $_POST['paidMethod'];
                    $view = file_get_contents('view/page/basket/formAddress.php');


                    ob_start();
                    eval('?>' . $view);
                    $content = ob_get_clean();

                    return $content;
                }
            }
        }

        $view = file_get_contents('view/page/basket/formPaid.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display for send order
     *
     * @return string
     */
    private function sendOrderAction(){
        $error = true;
        foreach ($_POST as $key => $value) {
            if ($key == 'number' && $value == "") {
            }
            else {
                if ($value == "") {
                    $error = false;
                }
            }
        };
        if($error){

            $deliveryRepository = new DeliveryRepository();
            $delivery = $deliveryRepository->findOne($_SESSION["delivery"]);
            $paidRepository = new PaidRepository();
            $paid = $paidRepository->findOne($_SESSION["paid"]);

            $_SESSION['address'] = $_POST;
            $view = file_get_contents('view/page/basket/sendOrder.php');
    
    
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
        } else{

            $view = file_get_contents('view/page/basket/formAddress.php');
    
    
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
        }
    }

    /**
     * Display for send order
     *
     * @return string
     */
    private function confirmOrderAction(){
        $shopRepository = new ShopRepository();
        $products = $shopRepository->findAll();
        if ($_SESSION != NULL) {
            $deliveryRepository = new DeliveryRepository();
            $delivery = $deliveryRepository->findOne($_SESSION["delivery"]);
            $paidRepository = new PaidRepository();
            $paid = $paidRepository->findOne($_SESSION["paid"]);

            $notError = true;
            foreach ($_SESSION['basket'] as $productsCustomer) {
                $product = $shopRepository->findOne($productsCustomer[0]['idProduct']);
                if ($product[0]['proQuantity'] < $productsCustomer['quantity']) {
                    $notError = false;
                }
            }
            
            //var_dump($notError);
            if($notError){
                $orderRepository = new OrderRepository();
                foreach ($_SESSION['basket'] as $productsCustomer) {
                    $shopRepository->subtractProductAction($productsCustomer[0]['idProduct'], $productsCustomer['quantity']);
                }
                $date = date("Y-m-d");
                $orderRepository->insert($_SESSION['total'],$date,$_SESSION['address']['name'],$_SESSION['address']['firstName'],$_SESSION['address']['street'],$_SESSION['address']['locality'],$delivery[0]['idDelivery'],$paid[0]['idPaid']);
                $order = $orderRepository->findOne();
                
                //session_destroy();
                
                
                $view = file_get_contents('view/page/basket/confirmOrder.php');
                
                
                ob_start();
                eval('?>' . $view);
                $content = ob_get_clean();
                
                return $content;
            }
        }
            $view = file_get_contents('view/page/shop/list.php');
            
            
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
            
            return $content;
    }
 }
?>