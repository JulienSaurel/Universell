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

    public function get($nom_attribut)
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur)
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }


    public function __construct($data = NULL)
    {
        if($data) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }


    static public function selectAll() {
        try{
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            var_dump($class_name);
            $sql = 'SELECT * FROM uni_'.ucfirst($table_name);


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);


            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return $tab;
    }

    static public function select($primary_value)
    {
        try{
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $sql = "SELECT * from uni_" . ucfirst($table_name) .  " WHERE " . $primary_key . " = '" . $primary_value. "'";
            //var_dump($sql);
            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }

        if (empty($tab))
        {
            return false;
        }
        return $tab[0];
    }



    static public function delete($primary_value) {
        try{
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;
            $sql = "DELETE from uni_" . ucfirst($table_name) .  " WHERE " . $primary_key . " = '" . $primary_value. "'";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function update($data)
    {
        try
        {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $sql = "UPDATE uni_" . ucfirst($table_name) . " SET ";
            foreach ($data as $key => $value)
            {
                $sql .= $key . " = :" . $key . ', ';
            }
            $sql = rtrim($sql, ', ') . " WHERE " . $primary_key . " = :" . $primary_key;
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function save($data)
    {
        try
        {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $sql = "INSERT INTO uni_" . ucfirst($table_name) . " (";
            foreach ($data as $key => $value)
            {
                $sql .= $key . ', ';
            }

            $sql = rtrim($sql, ', ') . ") VALUES (";
            foreach ($data as $key => $value)
            {
                $sql .= ":" . $key . ', ';
            }
            $sql = rtrim($sql, ', ') . ")";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

}
Model::Init();
?>