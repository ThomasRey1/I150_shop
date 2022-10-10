<?php
/**
 * ETML
 * Date: 12.09.2022
 * Shop
 */

include_once 'database/DataBaseQuery.php';
include_once 'Entity.php';


class LoginRepository implements Entity {

    /**
     * Find all entries
     *
     * @return array|resource
     */
    public function findAll() {

        $table = 't_user';
        $columns = 'useLogin';

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
    public function findOne($login) {

        $table = 't_user';
        $columns = '*';
        $where = "useLogin = '$login'";

        $request =  new DataBaseQuery();

        return $request->select($table, $columns, $where);

    }

    /**
     * Login
     *
     * @param $login
     * @param $password
     *
     * @return bool
     */
    public function login($login, $password) {

        $result = $this->findOne($login);

        if(isset($result) && count($result)>0){

        	if(password_verify($password, $result[0]['usePassword'])){
		        $_SESSION['right'] = $result[0]['useRight'];
		        $connect = true;
	        } else {
		        $_SESSION['right'] = null;
		        $connect = false;
	        }

        } else {
            $_SESSION['right'] = null;
            $connect = false;
        }

        return $connect;
    }
}