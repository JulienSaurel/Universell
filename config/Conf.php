<?php

class Conf {

    static private $debug = True;
    static private $databases = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        'hostname' => 'webinfo',
        // A l'IUT -> login
        // Chez vous -> vous le coisissez en creant la base

        'database' => 'saurelj',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'saurelj',
        // A l'IUT, c'est votre mdp (INE par defaut)
        // Pas de mdp en local par defaut
        'password' => 'gandalf'

    );

    static public function getDebug() {
        return self::$debug;
    }

    static public function getLogin() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['login'];
    }

    static public function getHostname() {
        return self::$databases['hostname'];
    }

    static public function getDatabase() {
        return self::$databases['database'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }

}

?>