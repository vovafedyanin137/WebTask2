<?php
    session_start();
    require_once 'D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php';
    $name = $_POST['name'];
    $text = $_POST['text'];
    $headline = $_POST['headline'];
    $trailer = $_POST['trailer_link'];
    $idUser = $_SESSION['user']['id'];
    $namePoster = basename( $_FILES['poster']['name'] );
    $tmpNamePoster = $_FILES['poster']['tmp_name'];
    $patternName = '/[a-zа-я]+/iu';
    $patternText = '/[a-zа-я]+/iu';
    $patternTrailer = '/\?v=/i';
    $messageFields = "Заполнены не все поля.\n Обязательные поля: название, текст и постер!";
    $messageName = "Не верно введено поле name!\n Поле должно иметь хотя бы одну букву!";
    $messageText = "Не верно введено поле text!\n Поле должно иметь хотя бы одну букву!";
    $messageTrailer = "Не верно введено поле trailer!\n Ссылка на трейлер должна быть корректна";
    if (in_array('', [$name, $text, $namePoster])) {
        echo("Заполнены не все поля.\n Обязательные поля: название, текст и постер!");
        exit();
    }
    if (preg_match($patternName, $name) == false) {
        echo("Не верно введено поле name!\n Поле должно иметь хотя бы одну букву!");
        exit();
    }
    if (preg_match($patternText, $text) == false) {
        header('HTTP/1.0 403 Error!');
        die (json_encode($message));
        echo("Не верно введено поле text!\n Поле должно иметь хотя бы одну букву!");
        exit();
    }
    if (!empty($trailer)) {
        if (preg_match($patternTrailer, $trailer) == false) {
            echo("Не верно введено поле trailer!\n Ссылка на трейлер должна быть корректна");
            exit();
        }
    }
    $regexp = "/.+\?v=/";
    $trailer = preg_replace($regexp, '', $trailer);
    if (strpos($trailer, "&")) {
        $regexp = "/\&.+$/";
        $trailer = preg_replace($regexp, '', $trailer);
    }
    if (exif_imagetype($_FILES['poster']['tmp_name']) == false) {
        echo("Постер должен быть картинкой!");
        exit();
    }
    if ( $_FILES['user_file']['error'] == UPLOAD_ERR_OK ) {
        do {
            $rndName = substr(md5(microtime() . rand(0, 1000)), 0, 15);
            $path = 'D:/OpenserverFolder/OSPanel/domains/NNFilms/assets/uploads/'.$rndName.$namePoster;
        } while (file_exists($path));

        move_uploaded_file( $tmpNamePoster, $path);
    }
    $path = 'assets/uploads/'.$rndName.$namePoster;
    $sql = "INSERT INTO reviews (id_user, film_title, film_poster, film_trailer, name_review, text_review, date_review) 
    VALUES(:id_user, :film_title, :poster, :trailer, :headline, :text_review, date_trunc('seconds', now()) )";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id_user' => $idUser, 'film_title' => $name, 'poster' => $path, 'trailer' => $trailer, 'headline' => $headline, 'text_review' =>$text]);
    header('Location: /');
?>