<?php
class Util{

    //se le pasa una clase y el nombre de una funcion
    //el metodo instancia la clase por defecto y ejecuta la funcion que lleva ese nombre
    //retorna lo que haya hecho esa funcion
    public static function callF($class,$nameFunction){
        $class=EncuestaController::class;
        $o=new $class();
        return $o->{$nameFunction}();
    }
    //obtiene JSON del POST
    public static function getPostObj(){
        return json_decode(json_encode($_POST));
    }

    public static function getCurrentUrl(){
        $url='';
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
            else  
            $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    return $url; 
    }
    public static function getRequestObj(){
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        return json_decode(json_encode($_POST));
        else return json_decode(json_encode($_GET));
    }

    public static function cloneObj($obj){
        return json_decode(json_encode($obj));
    }
    //responde un objeto como si fuera un json y tipo json
    public static function responseJson($obj){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($obj);
    }

    public static function redirect($url){
        header("Location: $url");
        die();
    }

    public static function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
     
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
     
        return $ip;
    }
}