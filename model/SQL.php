<?php


namespace Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 17:22
 */
// класс для работы с бд, примеры можно посмотреть в интернете.

//у класса все методы должны быть абстрактные

//в конструкторе происходит подключение к бд\

//методы: query($sql) - т.е. выполнить запрос

//getRow($sql) - получить одну строку из таблицы бд в виде ассоциативного массива

//getByArray($sql) - получить результат запроса в виде ассоциативного массива

//getCount($sql) - получить количество результатов запроса, результат типа int

class SQL
{

    protected $connection;

    require("constants.php");
    public function __construct($host, $user, $password, $db_name) {
        $this->connection = new mysqli($host, $user, $password, $db_name);

        $this->query("SET NAMES UTF8");

        if( !$this->connection ) {
            throw new Exception('Could not connect to DB ');
        }
    }




    public function query($sql){
        if ( !$this->connection ){
            return false;
        }

        $result = $this->connection->query($sql);

        if ( mysqli_error($this->connection) ){
            throw new Exception(mysqli_error($this->connection));
        }

        if ( is_bool($result) ){
            return $result;
        }

        $data = array();
        while( $row = mysqli_fetch_assoc($result) ){
            $data[] = $row;
        }

        mysqli_free_result($result);

        return $data;
    }

    public static function getRow($sql){
        $arResult = [];
        $connect = new self();
        $sqlResult = $connect->query($sql);

        return $arResult;
    }
    public static function getByArray($sql){
        $arResult = [];
        $connect = new self();
        $sqlResult = $connect->query($sql);

        return $arResult;
    }
}