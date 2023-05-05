<?php

require_once "class/AuthorizationForm.php";
require_once "class/DB.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['g-recaptcha-response'])) {
    $db = new DB;

    $auth = new AuthorizationForm($_POST['phone_or_email'], $_POST['password'], $db);
}



?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div>
        <h1>Авторизация</h1>
    </div>
    <div style="color: red;">
        <?php
        // var_dump($auth);
        if (!empty($auth) && !empty($auth->errorShow())) {
            echo $auth->errorShow();
        }

        ?></div>
    <div>
        <form action="" method="post">
            <input type="text" name="phone_or_email" id="" placeholder="Введите телефон или почту"><br>
            <input type="password" name="password" id="" placeholder="Введите пароль"><br>
            <div class="g-recaptcha" data-sitekey="6LfxiuIlAAAAAK08Rzpxh6Q9V0NAxiG35qOM2pkm

"></div>

            <button type="submit">Войти</button>
        </form>
    </div>
</body>

</html>