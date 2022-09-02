<?php

class MOpcion
{
    public static $table = "opcion";


    public static function getOpcionesFromIdPregunta($idpregunta){
        return ModeloGenerico::selectWhere(self::$table,'idpregunta',$idpregunta,"ORDER BY orden ASC ");
    }

    //inserta preguntaws en el objeto encuesta, atributo preguntas
    public static function insertOpcionesIntoPregunta($pregunta){
        $opciones=self::getOpcionesFromIdPregunta($pregunta->idpregunta);
        $pregunta->opciones=$opciones;
        return $pregunta;
    }
}
