<?php

class MPregunta
{
    public static $table = "pregunta";

    public static function getPreguntasFromIdEncuesta($idencuesta){
        return ModeloGenerico::selectWhere(self::$table,'idencuesta',$idencuesta);
    }
    //inserta preguntaws en el objeto encuesta, atributo preguntas
    public static function insertPreguntasIntoEncuesta($encuesta_obj){
        $preguntas=self::getPreguntasFromIdEncuesta($encuesta_obj->idencuesta);
        $encuesta_obj->preguntas=$preguntas;
        return $encuesta_obj;
    }
}
