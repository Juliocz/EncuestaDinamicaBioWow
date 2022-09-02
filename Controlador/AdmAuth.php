<?php

class AdmAuth{


    public static $arrName="EncuestaDinamica_AdmAuth";//nombre del array en sesion

    function __construct()
    {   
        include_once 'Modelo/UsuarioBio.php';
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        if(!isset($_SESSION[self::$arrName]) || $_SESSION[self::$arrName]==null){
            $_SESSION[self::$arrName]=new stdClass();

        }
        if(!isset($_SESSION[self::$arrName]->user))$_SESSION[self::$arrName]->user=null;
    }
public function closeSesion(){
    $_SESSION[self::$arrName]->user=null;
}

public function authUser($user){
    $_SESSION[self::$arrName]->user=$user;
}

public static function logoutt(){
    $u=new AdmAuth();
    return $u->logout();
}
public static function User(){
    $u=new AdmAuth();
    return $u->getUsuarioBio();
}
public function logout(){
    return !$_SESSION[self::$arrName]->user=null;
}
public function getUsuarioBio(){
    
    return $_SESSION[self::$arrName]->user;
}

public function isAuth(){
    return $_SESSION[self::$arrName]->user;
}

}