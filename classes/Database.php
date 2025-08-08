<?php

require_once(__DIR__ . '/../config/environment.php');
require_once($_SERVER['DOCUMENT_ROOT'] . DIR_ROOT . '/config/config.php');

class Database {
    public static function conn() {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
        
        return $pdo;
    }
}