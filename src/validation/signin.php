<?php
    session_start();
    require_once 'D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php';
    if (empty($_POST) && !isset($_SESSION['user']['id'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $password = md5($pass."jfh85f2cxz");
    if (in_array('', [$email, $password])) {
        echo("Заполнены не все поля");
        exit();
    }
    $sql = 'SELECT id_user, user_name, user_password, user_access FROM users WHERE user_email=:email';
    $query = $pdo->prepare($sql);
    $query ->execute(['email' => $email]);
    $user = $query->fetch();
    if(count($user) == 0) {
        echo "Пользователь не найден";
        exit();
    }
    if ($password === $user['user_password']) {
        $_SESSION['user'] = [
            'id' => $user['id_user'],
            'name' => $user['user_name'],
            'access' => $user['user_access']
        ];
    } else {
        echo("Неправильный пароль!");
        exit();
    }
    header('Location: /');
?>
