<?php 
    session_start();
    require_once 'D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php';
    $id_review = $_GET['id_review'];
    $sql = "SELECT r.film_title, r.film_poster, r.film_trailer, r.name_review, r.text_review, r.date_review, u.user_name FROM reviews r LEFT JOIN users u ON r.id_user = u.id_user WHERE r.id_rev = ?";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $id_review, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $sqlComments = "SELECT c.comment_date, c.comment_text, u.user_name FROM comments c LEFT JOIN users u ON c.id_user = u.id_user WHERE c.id_rev = ? ORDER BY c.id_com DESC";
    $statementComment = $pdo->prepare($sqlComments);
    $statementComment->bindValue(1, $id_review, PDO::PARAM_INT);
    $statementComment->execute();
    $resultComments = $statementComment->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$result['film_title']?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
        <div class="navbar navbar-dark bg-dark">
            <div class="container justify-content-between">
                <a href="/index.php" class="navbar-brand">
                    <strong>NNFilms</strong>
                </a>
                
        
                <?php if (!isset($_SESSION['user'])):?>
                    <div class="btn-toolbar">
                        <a href="../validation/signin-form.php" class="btn btn-outline-primary mr-2" type="submit">Войти</a>
                        <a href="../validation/signup-form.php" class="btn btn-primary" type="submit">Зарегистрироваться</a>
                    </div>
                <?php endif;?>
                
                <?php if (isset($_SESSION['user'])):?>
                    
                    <div class="btn-toolbar">
                        <span class="lead text-white mr-2">Привет, <?=$_SESSION['user']['name']?>!</span>
                        <?php if ($_SESSION['user']['access'] == 1):?>
                            <a href="createReview-form.php" class="btn btn-primary mr-3" type="submit">Добавить обзор</a>
                        <?php endif;?>
                        <a href="../validation/signout.php" class="btn btn-outline-primary" type="submit">Выйти</a>
                    </div>
                <?php endif;?>
                </div>        
            </div>
        </div>
</header>
<div class="container">
    <div class="row justify-content-center">
        <div class="col test">
            <div class="card mt-2">
                <div class="row no-gutters justify-content-center">
                    <div class="col-3">
                        <img src="/<?=htmlspecialchars($result['film_poster'])?>" class="card-img-top" alt="img" >

                        <div>
                            <button type="button" style="width: 100%;" class="btn btn-primary mt-2" data-toggle="modal" data-target="#videoModal" data-video="https://www.youtube.com/embed/<?=nl2br(htmlspecialchars($result['film_trailer']))?>">
                            Трейлер
                            </button>
                        </div>
                        
                        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark border-dark">
                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body bg-dark p-0">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <?php if (empty($result['film_trailer'])):?>
                                            <div class="noTrailer">Трейлер отсутствует</div>
                                        <?php else:?>
                                            <iframe  class="embed-responsive-item" width="720px" height="480px" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <?php endif;?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h2 class="card-title"><?=htmlspecialchars($result['film_title'])?></h2>
                            <h4 class="card-text"><?=htmlspecialchars($result['name_review'])?></h4>
                            <h6 class="card-text">Автор: <?=nl2br(htmlspecialchars($result['user_name']))?></h6>
                            <p class="card-text"><?=nl2br(htmlspecialchars($result['text_review']))?></p>
                            <p class="card-text"><small class="text-muted"><?=htmlspecialchars($result['date_review'])?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 ml-auto mr-auto">
            <div class="comments">
                <?php foreach ($resultComments as $comment):?>
                    <div class="card mt-2">
                        <div class="row no-gutters">
                            <div class="col">
                                <div class="card-header">
                                    <h6 class="card-text"><?=htmlspecialchars($comment['user_name'])?></h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?=nl2br(htmlspecialchars($comment['comment_text']))?></p>
                                    <p class="card-text"><small class="text-muted"><?=htmlspecialchars($comment['comment_date'])?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>                
        <div class="col-4">
            <?php if (isset($_SESSION['user'])):?>
                <form action="../comment/sendComment.php" method="post">
                        <div class="form-group">
                            <label for="text">Написать комментарий</label>
                            <textarea type="text" rows="2" class="form-control" name="text" id="text"></textarea>
                            <input type="hidden" name="id_review" value="<?=$_GET['id_review']?>" class="createComment_id_review">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Отправить</button>
                </form>   
            <?php endif;?>                              
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#videoModal").on("show.bs.modal", function(event) {
        let button = $(event.relatedTarget);
        let url = button.data("video");     
        $(this).find("iframe").attr({
            src : url,
            allow : "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
        });
    });
    $("#videoModal").on("hidden.bs.modal", function() {
        $("#videoModal iframe").removeAttr("src allow");
    });
});
</script>
</body>
</html>