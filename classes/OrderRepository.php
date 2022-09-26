<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';

class OrderRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_order';
        $columns = '*';
        $where =  'p.fkCategory = c.idCategory';

        $request =  new DataBaseQuery();

        return $request->select($table, $columns);

    }
    
    /**
     * Find One entry
     *
     * @param $login
     *
     * @return array
     */
    public function findOne() {

        $table = 't_order';
        $columns = '*';
        $where = "";
        $orderBy = 'idOrder DESC LIMIT 1';

        $request =  new DataBaseQuery();

        return $request->select($table, $columns, $where, $orderBy);

    }

    /**
     * Insert
     *
     * @param $name
     * @param $description
     * @param $price
     * @param $quantity
     * @param $file
     * @param $idCategory
     *
     * @return bool|string
     */
    public function insert($total, $date, $name, $firstname, $street, $locality, $idDelivery, $idPaid) {

        $request = new DataBaseQuery();
        $table = 't_order';
        $columns = '(idOrder, ordTotal, ordDate, ordName, ordFirstname, ordStreet, ordLocality, fkDelivery, fkPaid)';
        $values = "(NULL, $total, '$date', '$name', '$firstname', '$street', '$locality', $idDelivery, $idPaid)";

        return $request->insert($table, $columns, $values);
    }
}