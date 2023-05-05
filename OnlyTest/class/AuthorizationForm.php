<?php

require_once "DB.php";
class AuthorizationForm
{
    private array  $errors = [];
    private $phone = null;
    private $email = null;
    private $db;

    public function __construct($phoneOrEmail, $password, DB $db)
    {
        $this->db = $db;

        if ($this->validation($phoneOrEmail, $password)) {
            if ($this->isTypeEmail($phoneOrEmail)) {
                $this->email = $phoneOrEmail;
            }
            if ($this->isTypePhone($phoneOrEmail)) {
                $this->phone = $phoneOrEmail;
            }
            if ($this->getDB()->auth($this->phone, $this->email, $password)) {
                session_start();
            } else {
                $this->errors[] = "Неверный логин или пароль";
            }
        }
    }




    //Проверка полей
    private function validation($phoneOrEmail, string $password)
    {
        $flag = true;
        if (empty($phoneOrEmail) || empty($password)) {
            $this->errors[] = 'Заполните поля';
            $flag = false;
        }


        return $flag;
    }

    public function getDB()
    {
        return $this->db;
    }

    //Определение емейла
    private function isTypeEmail($email)
    {
        $pattern = '#^([a-zA-Z0-9_.])+@([a-z])+(\.([a-z]){2,}){1,}$#';

        preg_match($pattern, $email, $match);
        if (!empty($match)) {
            return true;
        } else {
            return false;
        }
    }
    //Определение телефона
    private function isTypePhone($phone)
    {   // В формате +7 или 8 999 999 99 99 \ +7-999-999-99-99 \ +79999999999
        $pattern = '#^(\+7|8){1}[ -]{0,1}[0-9]{3}[ -]{0,1}[0-9]{3}[ -]{0,1}[0-9]{2}[ -]{0,1}[0-9]{2}$#';
        $match = [];
        preg_match($pattern, $phone, $match);
        if (!empty($match)) {
            return true;
        } else {
            return false;
        }
    }


    //Вывод ошибок
    public function errorShow()
    {
        return ($this->errors[0]);
    }
}


// $auth = new AuthorizationForm('89513283608', '1');
