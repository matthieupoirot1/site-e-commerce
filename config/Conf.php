<?php

class Conf {

    static private $databases = array(
        'hostname' => 'infolimon.iutmontp.univ-montp2.fr',
        'database' => 'bretone',
        'login' => 'bretone',
        'password' => 'bretone'
    );

    static public function getLogin() {
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

    static private $debug = True;

    static public function getDebug() {
        return self::$debug;
    }

}
?>

