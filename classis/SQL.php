<?php
class DB {

    private static $instance = null;
    private $mysqli;

    public static function getInstance() {

        if(self::$instance == null ) self::$instance = new self;
        return self::$instance;
    }

    private function __construct() {
        $this->mysqli = new mysqli("localhost","root","","blog");
        if($this->mysqli->connect_errno)
            echo "<p class='error'>Ошибка подключения к БД ".$this->mysqli->connect_error."<p>";
    }

    private function __clone() {

    }

    public function getQuery($query) {
        return $this->mysqli->query($query);
    }

}
?>
