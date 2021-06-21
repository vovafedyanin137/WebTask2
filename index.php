<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NNFilms</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
        <div class="navbar navbar-dark bg-dark">
            <div class="container justify-content-between">
                <a href="#" class="navbar-brand">
                    <strong>NNFilms</strong>
                </a>
                
                <?php if (!isset($_SESSION['user'])):?>
                    <div class="btn-toolbar">
                        <a href="src/validation/signin-form.php" class="btn btn-outline-primary mr-2" type="submit">Войти</a>
                        <a href="src/validation/signup-form.php" class="btn btn-primary" type="submit">Зарегистрироваться</a>
                    </div>
                <?php endif;?>
                
                <?php if (isset($_SESSION['user'])):?>
                    <div class="btn-toolbar">
                        <span class="lead text-white mr-2">Привет, <?=$_SESSION['user']['name']?>!</span>
                        <?php if ($_SESSION['user']['access'] == 1):?>
                            <a href="src/review/createReview-form.php" class="btn btn-primary mr-3" type="submit">Добавить обзор</a>
                        <?php endif;?>
                        <a href="src/validation/signout.php" class="btn btn-outline-primary" type="submit">Выйти</a>
                    </div>
                <?php endif;?>
                </div>        
            </div>
        </div>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col test">
            <?php require_once 'src/review/outReview.php'?>
        </div>
    </div>
</div>

</body>
</html>