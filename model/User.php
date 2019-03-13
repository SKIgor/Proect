<?php

namespace Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 17:22
 */
//у класса должен быть конструктор - параметр в конструктор передается(id) если такой пользователь есть в бд то создаем объект с
//параметрами пользователя из бд, если такого пользователя нет в бд то создаем пустой объект

//у каждого свойства объекта должны быть методы гет и сет

//У класса должны быть методы сохранения в бд, обновления в бд, удаления из бд, create update delete соответственно

//Так же у класса должен быть абстактный метод, например: получить всех юзеров из бд

//+ абстактный метод проверки совпадения пароля;
// и абстактный метод смены пароля;
class User
{
    protected $id;
    protected $f_name;
    protected $l_Name;
    protected $image;
    protected $login;
    protected $password;
    protected $email;

    /**
     * User constructor.
     * @param $id
     */


    public function __construct($id = null)

    {
        if (!$id){
            $sql = "SELECT * FROM usertbl WHERE id=" . $id;
//            $result = SQL::getRow($sql);
            SQL::napisatxui();
//            var_dump($result);
            die();
            //Сначала формируем запрос к бд
            //пытаемся получить из бд строку
            //если в бд есть такой объект то
            if ($result) {
                $this->f_name   = $result["f_name"];
                $this->l_name   = $result["l_name"];
                $this->image    = $result["image"];
                $this->login    = $result["username"];
                $this->email    = $result["email"];
                $this->password = $result["password"];

                //etc.
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Сохранение пользователя
     */
    public function save(){
        //сделать скуэль запрос
        //выполнить его
        //если успешно вернуть тру
        return true;
    }

    /**
     * Обновление пользователя
     */
    public function update(){
        //сделать скуэль запрос
        //выполнить его
        //если успешно вернуть тру
        return true;
    }

    /**
     * Удаление пользователя
     */
    public function delete(){
        //сделать скуэль запрос
        //выполнить его
        //если успешно вернуть тру
        return true;
    }

    public function getAll(){
        $arRestult = [];
        $sql = "";
        $arRestult = SQL::getByArray($sql);
        //сделать скуэль запрос
        //выполнить его
        //если надо обработать результат выполнения запроса
        //вернуть результат функции (массив)
        return $arRestult;
    }


    function changePassword($oldPassword, $newPassword){

    }
}