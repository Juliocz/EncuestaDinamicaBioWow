<?php

class EncuestaAuth{


    public static $arrName="EncuestaNegocio";//nombre del array en sesion

    function __construct()
    {   
        
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if(!isset($_SESSION[self::$arrName]))$_SESSION[self::$arrName]=array();
        return $this;
    }

public function closeAllSesion(){
    $_SESSION[self::$arrName]=array();
}
public function closeSesion($ip){
    //retorna true si se cerro una sesion mediante la ip, falso sino
    $c=false;
    $i=0;
    foreach($_SESSION[self::$arrName] as $n){
        if($n->ip==$ip)
            {
                unset($_SESSION[self::$arrName][$i]);
                $c=true;
            }
        $i++;
    }
    return $c;
}

public function authNegocio($idun_obj,$ip){

    if($this->isAuthNegocio($ip))return false;

    $n=new stdClass();
    $n->negocio=$idun_obj;
    $n->ip=$ip;
    array_push($_SESSION[self::$arrName],$n);
}

public function isAuthNegocio($ip){
    

    foreach($_SESSION[self::$arrName] as $n){
        if($n->ip==$ip)return $n;
    }
    return false;
}

public static function isAuthN(){
    include_once "Controlador/Util.php";
    $a=new EncuestaAuth();
    return $a->isAuthNegocio(Util::getIp());
}

}