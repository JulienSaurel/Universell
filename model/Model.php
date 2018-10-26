<?php
require_once File::build_path(array('config','Conf.php'));
class Model {
    public static $pdo;
    
    public static function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
    try {
      self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        if (Conf::getDebug()) {
  echo $e->getMessage(); // affiche un message d'erreur
  die();
}else {
    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
  }
    }
}
}
Model::Init();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

