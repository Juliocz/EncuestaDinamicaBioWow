<?php

class UsuarioBio
{   public $login=null;
    public $nombre=null;
    public $id=null;
    public $correo=null;

    public $rol=null;
    public $app=null;

    function __construct()
    {

    }


    public function login($login,$password){
        include_once 'Controlador/SimpleHTTPClient.php';
        include_once 'Controlador/AdmAuth.php';
        $client = new SimpleHTTPClient();

        $basic_auth=base64_encode(V::$basic_auth_user.':'.V::$basic_auth_password);
        $response = $client->makeRequest('http://161.97.102.170:8071/datasnap/rest/Tapiv1/Login',
         'POST', json_encode([
            "appkey"=> V::$appkey,
           "cmd"=> "47e3b803a5e3cf00e8b3e580761dd5c8", 
            "login"=>  $login,
            "password"=>  $password,
            "ip"=> Util::getIp(),
            "os"=>  "window",
           "browser"=>  'FIREFOX'
         ]), 
         [
            'Content-type: application/json',
            'Accept: application/json',
            "Authorization: Basic $basic_auth"
         ]);

         $response_obj=json_decode($response['body']);
        
         $admAuth=new AdmAuth();
         if($response_obj->ReturnCode=='0')//si app y rol sigue siendo nulo, isgnifica que el login fallo
         { 
            
            $this->setDataFromBioServiceResponseLogin($response_obj);
            $admAuth->authUser($this);
            return true;
        }
         return false;
        
    }

    //setea datos del servicio recibido, lo parse al objeto
    public function setDataFromBioServiceResponseLogin($response_bio_service){
        $this->login=$response_bio_service->User->Flogin;
        $this->nombre=$response_bio_service->User->Fnombre;
        $this->id=$response_bio_service->User->Fid;
        $this->correo=$response_bio_service->User->Fcorreo;
        $this->rol=$response_bio_service->Rol;
        $this->app=$response_bio_service->Rol->Fapp;

        return true;
    }
}
