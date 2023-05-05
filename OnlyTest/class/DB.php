<?php


class DB
{

    ## Подключение к БД
    private const HOST_NAME = 'localhost';
    private const USER = 'root';
    private const PASSWORD = 'root';
    private const NAME_DB = 'only';
    private $error = '';

    public static function connectDB()
    {
        return mysqli_connect(self::HOST_NAME, self::USER, self::PASSWORD, self::NAME_DB);
    }


    //Проверка на уникальность данных
    private function isCorrectData($login, $phone, $email)
    {
        $query = "SELECT login, phone,email FROM `users` WHERE login ='$login' OR phone= '$phone'or email = '$email'";

        $users = mysqli_fetch_assoc(mysqli_query($this->connectDB(), $query));


        if (!$users) {
            return true;
        } else {
            $this->error = "Такая почта, логин или телефон уже зарегестрированы";
            return false;
        }
    }

    // Добавление пользователя в БД
    public function addUser($name, $login, $phone, $email, $password)
    {
        if ($this->isCorrectData($login, $phone, $email)) {

            $query = "INSERT INTO `users`(`id`, `name`, `login`, `phone`, `email`, `password`) VALUES (null,'$name','$login','$phone','$email','$password')";
            mysqli_query($this->connectDB(), $query);
        }
    }

    //Аутентификация пользователя
    public function auth($phone, $email, $password)
    {
        $query = "SELECT * FROM `users` WHERE (phone = '$phone' or email='$email') and password='$password'";
        $user = mysqli_fetch_assoc(mysqli_query($this->connectDB(), $query));
        if (!empty($user)) {
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['auth'] = true;
            header("Location: user.php");
        } else {
            return false;
        }
    }
    // ОБновление пользователя
    public function upadateUser($id, $name, $phone, $email, $password)
    {
        if (empty($password)) {
            $query = "UPDATE `users` SET `name`='$name',`phone`='$phone',`email`='$email' WHERE id='$id'";
        } else {
            $query = "UPDATE `users` SET `name`='$name',`phone`='$phone',`email`='$email', `password`='$password' WHERE id='$id'";
        }
        mysqli_query($this->connectDB(), $query);
        header("Location: user.php");
    }
}

// echo mysqli_get_server_info(DB::connectDB());
