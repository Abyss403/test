<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 9:38 AM
 * To change this template use File | Settings | File Templates.
 */
class Db{
    private $host = 'localhost';
    private $usr = 'root';
    private $pwd = '';
    private $db = 'test';

    private $link;

    function __construct() {
        $this->link = mysql_connect($this->host, $this->host, $this->pwd);
        if (!$this->link) {
            die('Error: ' . mysql_error());
        }else{
            mysql_select_db($this->db);
        }
    }

    function __destruct() {
        mysql_close($this->link);
    }

    public function query($sql){
        return mysql_query($sql, $this->link);
    }

    public function escape($str){
        return "'" . addslashes ( $str ). "'";
    }

    public function getError(){
        return mysql_error($this->link);
    }
}