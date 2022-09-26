<?php
/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';

class OrderProductRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_orderProduct';
        $columns = '*';
        $where =  'p.fkCategory = c.idCategory';

        $request =  new DataBaseQuery();

        return $request->select($table, $columns);

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
    public function insert($idOrder, $idProduct, $quantity) {

        $request = new DataBaseQuery();
        $table = 't_orderProduct';
        $columns = '(fkOrder, fkProduct, ordProQuantity)';
        $values = "($idOrder, $idProduct, $quantity)";

        return $request->insert($table, $columns, $values);
    }
}