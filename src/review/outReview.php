<?php
    require_once "D:\OpenserverFolder\OSPanel\domains\NNFilms\config\connectionDB.php";

    $sql = "SELECT r.id_rev, r.film_title, r.film_poster, r.date_review, r.name_review, u.user_name FROM reviews r LEFT JOIN users u ON r.id_user = u.id_user ORDER BY r.date_review DESC";
    $statement = $pdo->query($sql);
    $reviews = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
    <?php foreach ($reviews as $review):?>
        <div class="card mt-2">
			<div class="row no-gutters">
				<div class="col-1">
					<img src="<?=htmlspecialchars($review['film_poster'])?>" class="card-img-top" alt="img" >
				</div>
				<div class="col">
					<div class="card-body">
						<a href="src/review/review-form.php?id_review=<?=$review['id_rev']?>" ><h5 class="card-title"><?=htmlspecialchars($review['film_title'])?></h5></a>
						<p class="card-text"><?=htmlspecialchars($review['name_review'])?></p>
						<p class="card-text"><small class="text-muted"><?=htmlspecialchars($review['date_review'])?></small></p>
					</div>
				</div>
			</div>
		</div>
<?php endforeach;?>