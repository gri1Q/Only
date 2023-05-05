<?php

require_once "class/RegistrationForm.php";
require_once "class/DB.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new DB;
    $registrationForm = new RegistrationForm($_POST['name'], $_POST['login'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['repeat_password'], $db);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Регистрация</h1>
    </div>
    <div style="color: red;">
        <?php
        if (!empty($registrationForm) && !empty($registrationForm->errorShow())) {
            echo $registrationForm->errorShow();
        }
        ?></div>
    <div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="name"><br>
            <input type="text" name="login" placeholder="login"><br>
            <input type="text" name="phone" placeholder="phone"><br>
            <input type="text" name="email" placeholder="email"><br>
            <input type="text" name="password" placeholder="password"><br>
            <input type="text" name="repeat_password" placeholder="repeat_password"><br>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</body>

</html>