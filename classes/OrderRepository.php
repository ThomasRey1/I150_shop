<?php
/**
 * ETML
 * Date: 12.09.2022
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
     * @param $total
     * @param $date
     * @param $name
     * @param $firstname
     * @param $street
     * @param $number
     * @param $locality
     * @param $npa
     * @param $idDelivery
     * @param $idPaid
     *
     * @return bool|string
     */
    public function insert($total, $date, $name, $firstname, $street, $number, $locality, $npa, $idDelivery, $idPaid) {

        $request = new DataBaseQuery();
        $table = 't_order';
        $columns = '(idOrder, ordTotal, ordDate, ordName, ordFirstname, ordStreet, ordStreetNb, ordLocality, ordNpa, fkDelivery, fkPaid)';
        $values = "(NULL, $total, '$date', '$name', '$firstname', '$street', '$number', '$locality', $npa, $idDelivery, $idPaid)";

        return $request->insert($table, $columns, $values);
    }
}