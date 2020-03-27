<?php
    $dsn = 'mysql:host=localhost;dbname=bdblitz;charset=utf8';
    $user = 'root';
    $pass = '';

    try{
        $pdo = new PDO($dsn, $user, $pass);
        return $pdo;
    }catch(PDOException $ex){
        echo 'Erro: '.$ex->getMessage();
    }
?>