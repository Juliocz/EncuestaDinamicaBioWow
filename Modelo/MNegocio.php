<?php

class MNegocio
{
    public static $table = "un_negocio";
    var $nombre;
    var $apellido;
    var $direccion;
    var $edad;
    public $cedula;
    var $telefono;

    //VERIFICA si esxiste el negocio por su idun y codigo, devuelve null lo sino el negocio
    public static function isExistNegocio($idun,$codigo){
        $array_n=json_decode(json_encode(ModeloGenerico::selectWhereAndWhere(
            self::$table,
            'idun',$idun,
            'codigo',$codigo
        )));
        if(count($array_n)>0)
            return $array_n[0];
        else return null;
    }

    public static function get(){
        return ModeloGenerico::selectWhere(self::$table,'estado',1);
    }
}
