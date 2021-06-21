<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<header>
        <div class="navbar navbar-dark bg-dark">
            <div class="container justify-content-between">
                <a href="/index.php" class="navbar-brand">
                    <strong>NNFilms</strong>
                </a> 
                <div class="btn-toolbar">
                        <a href="signup-form.php" class="btn btn-outline-primary" type="submit">Зарегистрироваться</a>
                    </div>
            </div>
        </div>
    </header>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Вход</h5>
                    <form action="signin.php" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Эл. адрес</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>