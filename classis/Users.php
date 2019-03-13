<?php

class user {

    protected $name;
    protected $login;
    protected $email;
    protected $status;
    protected $password;

    public function __construct($name, $login, $email, $password) {
        $this->name = $name;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

}

//class user_comment extends read_only {
//
//    public function getStatus() {
//        return $this->status = 'user_comment';
//    }
//
//}
?>