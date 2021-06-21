<?php
    session_start();
    require_once 'D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php';
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $confirm_password = filter_var(trim($_POST['confirm_password']), FILTER_SANITIZE_STRING);
    $password = md5($pass."jfh85f2cxz");
    $confirm_password = md5($pass."jfh85f2cxz");
    $patternName = '/^[а-я\-\s]+$/iu';
    $patternEmail = '/^.+@.+\..+$/i';
    $patternPassword = '/^(?=\w{6})\d*[a-z][a-z\d]*$/i';
    $messageName = "Не верно введено поле name!\n Должны быть использованы только русские буквы, пробелы и дефисы.";
    $messageEmail = "Не верно введено поле email!\n Поле должно содержать только корректный email.";
    $messagePassword = "Не верно введено поле password!\n Поле должно содержать минимум 6 символов";
    if (in_array('', [$name, $email, $password, $confirm_password])) {
        echo("Заполнены не все поля");
        exit();
    }
    if (preg_match($patternName, $name) == false) {
        echo("Не верно введено поле name!\n Должны быть использованы только русские буквы, пробелы и дефисы.");
        exit();
    }
    if (preg_match($patternEmail, $email) == false) {
        echo("Не верно введено поле email!\n Поле должно содержать только корректный email.");
        exit();
    }
    if (preg_match($patternPassword, $password) == false) {
        echo("Не верно введено поле password!\n Поле должно содержать минимум 6 символов");
        exit();
    }
    if (!($password === $confirm_password)) {
        echo("Пароли не совпадают!");
        exit();
    }
    $sql = 'SELECT user_email FROM users WHERE user_email = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);
    $count = $query->rowCount();
    if ($count == 1) {
        echo("Аккаунт с таким email уже существует!");
        exit();
    }
    $sql = 'INSERT INTO users (user_name, user_email, user_password, user_access) VALUES(:user_name, :user_email, :user_password, 0)';
    $query = $pdo->prepare($sql);
    $query->execute(['user_name' => $name, 'user_email' => $email, 'user_password' => $password]);
    $sql = 'SELECT id_user, user_access FROM users WHERE user_email=:email';
    $query = $pdo->prepare($sql);
    $query ->execute(['email' => $email]);
    $user = $query->fetch();
    $_SESSION['user'] = [
        'id' => $user['id_user'],
        'name' => $name,
        'access' => $user['user_access']
    ];
    header('Location: /');
?>