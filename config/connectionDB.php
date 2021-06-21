<?php 
    $driver = 'pgsql';
    $host = 'localhost';
    $db_name = 'reviewsFilm';
    $db_user = 'postgres';
    $db_password = '2644';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    
    $dsn = "$driver:host=$host;dbname=$db_name";
    
    $pdo = new PDO($dsn, $db_user, $db_password, $options);
?>