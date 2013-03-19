<?php

Class Database {

    //
    public $_conn;
    
    public function db_connection($config) {

        $con = mysql_connect($config['servername'], $config['username'], $config['password']);
        //
        $this->_conn = $con;
        mysql_select_db($config['dbname'], $con);
    }

    public function db_query($query) {


        return mysql_query($query);
    }
    
    ////
    public function lastInsertId(){
        return mysql_insert_id($this->_conn);
    }

}

?>
