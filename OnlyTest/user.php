<?php
session_start();

if (empty($_SESSION['auth'])) {
    header('Location: index.php');
} else {
    require_once "class/DB.php";
    require_once "class/User.php";
    $db = new DB;
    $user = new User($_SESSION['user'],  $db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $validation =  $user->validation($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['repeat_password']);

        if ($validation) {
            $user->getDB()->upadateUser($_SESSION['user']['id'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password']);
        }
    }
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
        <h1>Личный кабинет</h1>
    </div>

    <nav>
        <ul>
            <li> Ваш id:<?= $_SESSION['user']['id'] ?></li>
            <li> Ваше имя:<?= $_SESSION['user']['name'] ?></li>
            <li> Ваш лоигн:<?= $_SESSION['user']['login'] ?></li>
            <li> Ваш телефон:<?= $_SESSION['user']['phone'] ?></li>
            <li> Ваш email:<?= $_SESSION['user']['email'] ?></li>
        </ul>
    </nav>

    <div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Имя" value="<?= $_SESSION["user"]["name"] ?>"><br>
            <input type="text" name="phone" placeholder="Телефон" value="<?= $_SESSION["user"]["phone"] ?>"><br>
            <input type="text" name="email" placeholder="email" value="<?= $_SESSION["user"]["email"] ?>"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="password" name="repeat_password" placeholder="repeat_password"><br>
            <button type="submit">Изменить данные</button>
        </form>
    </div>


</body>

</html>