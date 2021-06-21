<?php 
    session_start();
    require_once 'D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php';
    if (empty($_POST) && !isset($_SESSION['user']['id'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $id_user = $_SESSION['user']['id'];
    $id_review = $_POST['id_review'];
    $comment_text = $_POST['text'];
    $patternCommentText = '/[a-zа-я]+/iu';
    if (preg_match($patternCommentText, $comment_text) == false) {
        echo("Пустой комментарий!");
        exit();
    }
    $sql = "INSERT INTO comments(id_user, id_rev, comment_text, comment_date) VALUES(:id_user, :id_rev, :comment_text, date_trunc('seconds', now()))";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id_user' => $id_user, 'id_rev' => $id_review, 'comment_text' => $comment_text]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>