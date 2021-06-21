<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление обзора</title>
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
            </div>
        </div>
    </header>
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Создание обзора</h5>
                    <form action="createReview.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="inputName">Название фильма</label>
                            <input type="name" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Постер</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="poster" class="custom-file-input">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword2">Трейлер</label>
                            <input type="text" class="form-control" name="trailer_link" id="trailer_link">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword2">Заголовок рецензии</label>
                            <input type="text" class="form-control" name="headline" id="headline">
                        </div>
                        <div class="form-group">
                            <label for="inputText">Ваша рецензия</label>
                            <textarea type="text" rows="5" class="form-control" name="text" id="text"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>