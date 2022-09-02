<?php

class Route{
    static $ruta_ejecutada=false;//para que solo se ejecute una ruta a la vez, aun falta arreglar la verificacion de la ruta, por ej login puede pillar tambien solo log y se ejecuta el primero que llame
    static $num=1;
    public static function post($ruta,$function){
        if(self::$ruta_ejecutada)return;//si ya se ejecuto una ruta, retorno nomas
        //if (!self::$ruta_ejecutada and $_SERVER['REQUEST_METHOD'] === 'POST' and strpos($_SERVER["REQUEST_URI"],$ruta)!== false) {
            if (!self::$ruta_ejecutada and $_SERVER['REQUEST_METHOD'] === 'POST' and self::isExistinEnd(explode("?",$_SERVER["REQUEST_URI"])[0],$ruta)) {
            self::$ruta_ejecutada=true;
            $function();
        }
        /*else echo $ruta.",NO ENCONTRADO - POST en ".$_SERVER["REQUEST_URI"];*/
    }
    
    public static function get($ruta,$function){

      //  $ruta=explode("?",$ruta)[0];//obtengo solo la ruta get, en caso que tenga querys

        if(self::$ruta_ejecutada)return;    
        //if (!self::$ruta_ejecutada and $_SERVER['REQUEST_METHOD'] === 'GET' and strpos($_SERVER["REQUEST_URI"],$ruta)!== false) {
            if (!self::$ruta_ejecutada and $_SERVER['REQUEST_METHOD'] === 'GET' and self::isExistinEnd(explode("?",$_SERVER["REQUEST_URI"])[0],$ruta)) {
            self::$ruta_ejecutada=true;
            $function();
        }
        /*else echo $ruta.",NO ENCONTRADO - GET en ".$_SERVER["REQUEST_URI"];*/
    }

    //verifica si la ruta existe al final
    public static function isExistinEnd($palabra,$find){
        //$pos=strpos($palabra,$find);//primera 
        $pos=strrpos($palabra,$find);//ultima aparicion
        if($pos!==false and $pos+strlen($find)==strlen($palabra))
        return true;
        else return false;
    }

    public static function eventNotFound(){
        if(!self::$ruta_ejecutada)//si ninguna ruta se ejecuto
        {
            http_response_code(404);
            echo "<h1>Ruta no encontrada</h1></br>";
           // $function();
        }
    }
    


    public static function test(){}

    public static function vista($variable){
        
    }

    //solo falta agrupar todas las rutas y verificar si alguna se encuentra en la ruta dada, esto para poder dar un mensaje not found solo una vez
    //ya que por ahora todos los post y get se ejecutan uno por uno
}