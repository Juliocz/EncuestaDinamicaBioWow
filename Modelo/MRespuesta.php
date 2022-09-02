<?php

class MRespuesta
{
    public static $table = "respuesta";


    public static function insert($idencuesta,$idpregunta,$idopcion){
        return ModeloGenerico::insert(self::$table,[
            "idencuesta"=>$idencuesta,
            "idpregunta"=>$idpregunta,
            "idopcion"=>$idopcion
        ]);
    }

    public static function getRespuestasFrom($idencuesta,$idpregunta,$idopcion,$fecha_inicio='01-01-1000',$fecha_fin='01-01-5000'){
        //mediante una opcion , obtengo todas sus respuestas en un bucle for
        //lo ideal seria obtener las respuestas de una pregunta, y de ahi manualmente meterlo en cada opcion

        return ModeloGenerico::selectWhereAndWhereAndWhere(self::$table,
        'idencuesta',$idencuesta,
        'idpregunta',$idpregunta,
        'idopcion',$idopcion,
        "and creado BETWEEN '$fecha_inicio' AND '$fecha_fin'"
    );
    }
}
