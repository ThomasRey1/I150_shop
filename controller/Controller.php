<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

class Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        $page = $_GET['action'] . "Display";

        $this->$page();
    }
}