<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 9:46 AM
 * To change this template use File | Settings | File Templates.
 */
class App{
    protected static $_instance;
    private $db;

    public function db(){
        if(!isset($this->db)){
            $this->db = new Db();
        }
        return $this->db;
    }

    private function __construct() {
    }

    private function __clone(){
    }

    static function getInst(){
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function route(){
        $route = isset($_GET['route']) ? $_GET['route'] : 'post/index';
        try {
            $parsed = explode('/',$route);
            $controllerClass = ucfirst(strtolower($parsed[0]));
            $action = ucfirst(strtolower($parsed[1]));
            $controller = new $controllerClass();
            $controller->$action();
        } catch (Exception $e) {
            echo 'Error: ',  $e->getMessage(), "\n";
        }
    }
}