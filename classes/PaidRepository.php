<?php
/**
 * ETML
 * Date: 12.09.2022
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';

class PaidRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_paid';
        $columns = '*';

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
    public function findOne($method) {

        $table = 't_paid';
        $columns = '*';
        $where = "paiMethod = '$method'";

        $request =  new DataBaseQuery();

        return $request->select($table, $columns, $where);

    }
}