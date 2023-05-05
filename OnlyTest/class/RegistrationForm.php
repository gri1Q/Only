<?php

require_once "class/DB.php";
class RegistrationForm
{
    private array  $errors = [];
    // private $name;
    // private $login;
    // private $phone;
    // private $email;
    // private $password;
    // private $repeatPassword;
    private $db;

    public function __construct($name, $login, $phone, $email, $password, $repeatPassword, DB $db)
    {
        $this->db = $db;
        if ($this->validation($name, $login, $phone, $email, $password, $repeatPassword)) {
            $this->getDB()->addUser($name, $login, $phone, $email, $password); //Создание пользователя
           header("Location: auth.php");
        }
    }




    //Проверка полей
    private function validation($name, string $login, string $phone, string $email, string $password, string $repeatPassword)
    {
        $flag = true;
        if (empty($name) || empty($login) || empty($phone) || empty($email) || empty($password) || empty($repeatPassword)) {
            $this->errors['input'] = 'Заполните поля';
            $flag = false;
        }
        if ($password !== $repeatPassword) {
            $this->errors['password'] = 'Пароли не совпадают';
            $flag = false;
        }
        return $flag;
    }

    public function getDB()
    {
        return $this->db;
    }


    //Вывод ошибок
    public function errorShow()
    {
        return array_shift($this->errors);
    }
}
