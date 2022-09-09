<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'classes/AdminRepository.php';
include_once 'classes/CategoryRepository.php';

class AdminController extends Controller {

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

        $adminRepository = new AdminRepository();
        $products = $adminRepository->findAll();

        $view = file_get_contents('view/page/admin/index.php');


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

        $adminRepository = new AdminRepository();
        $result = $adminRepository->removeOne($_GET['id']);
        $text = "";

        if($result == 1){
            $text = "supprimé";
        }

        $view = file_get_contents('view/page/admin/confirm.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Display form to add product
     * @return string
     */
    private function formAddAction(){

        $catRepository = new CategoryRepository();
        $categories = $catRepository->findAll();

        $view = file_get_contents('view/page/admin/formAdd.php');


        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Action insert one product
     *
     * @return string
     */
    private function insertAction() {


        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];
        $idCategory = $_POST['productCategory'];
        $targetDirectory = 'resources/image/';


        if ($_FILES['productFile']["error"] == 0){

            if (is_uploaded_file($_FILES["productFile"]["tmp_name"])) {
                $productFile = $_FILES['productFile']["name"];

                // renommage et copie du fichier dans le dossier final definit plus haut
                if (move_uploaded_file($_FILES["productFile"]["tmp_name"], $targetDirectory . $productFile)) {
                } else {
                    $productFile = "default.jpg";
                }
            } else {
                $productFile = "default.jpg";
            }
        } else {
            $productFile = "default.jpg";
        }

        $adminRepository = new AdminRepository();
        $result = $adminRepository->insert($productName, $productDescription, $productPrice, $productQuantity, $productFile, $idCategory);

        $text = "";

        if($result == 1){
            $text = "ajouté";
        }

        $view = file_get_contents('view/page/admin/confirm.php');

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

    /**
     * Update one product
     * 
     * @return string
     */
    private function updateAction() {

        $idProduct = $_GET['id'];
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];
        $idCategory = $_POST['productCategory'];
        $targetDirectory = 'resources/image/';


        if ($_FILES['productFile']["error"] == 0){

            if (is_uploaded_file($_FILES["productFile"]["tmp_name"])) {
                $productFile = $_FILES['productFile']["name"];

                // renommage et copie du fichier dans le dossier final definit plus haut
                if (move_uploaded_file($_FILES["productFile"]["tmp_name"], $targetDirectory . $productFile)) {
                } else {
                    $productFile = "default.jpg";
                }
            } else {
                $productFile = "default.jpg";
            }
        } else {
            $productFile = "default.jpg";
        }

        $adminRepository = new AdminRepository();
        $result = $adminRepository->update($productName, $productDescription, $productPrice, $productQuantity, $productFile, $idCategory, $idProduct);

        $text = "";

        if($result == 1){
            $text = "modifié";
        }

        $view = file_get_contents('view/page/admin/confirm.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    public function listUsersAction(){

        $field = $_GET['field'];

        $adminRepository = new AdminRepository();
        $users=$adminRepository->rawQuery("select ".$field." FROM t_user",PDO::FETCH_NUM);

        $view = file_get_contents('view/page/admin/listUsers.php');

        ob_start();
        eval('?>' . $view);

        return ob_get_clean();


    }

}