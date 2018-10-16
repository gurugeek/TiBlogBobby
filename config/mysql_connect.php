<?php

try {

    $pdo = new PDO("mysql:host=localhost;dbname=login", "root", "Lolilol6969@");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){

    echo "Impossible de se connecter à la base de données " . $e->getMessage();

}