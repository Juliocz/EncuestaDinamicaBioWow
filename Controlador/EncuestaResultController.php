<?php

class EncuestaResultController{

    function __construct()
    {

    }

    public static function resultEncuestaToRows($resultados_encuesta_obj,$negocio,$header_preguntas=false,$header_encuesta_info=false,$fecha_inicio="",$fecha_fin=""){
        //$resultados_obj=MEncuesta::getEncuestaWithResult($request->idencuesta,$request->fecha_inicio,$request->fecha_fin);
        //$negocio=ModeloGenerico::selectWhere('un_negocio','idun',$resultados_obj->idun)[0];
    
        $rows=array();

        if($header_encuesta_info){
        array_push($rows,
        ['<style bgcolor="#FFFF00" color="#0000FF">Nombre Encuesta: </style>', $resultados_encuesta_obj->nombre_enc],
        ['<style bgcolor="#FFFF00" color="#0000FF">Fecha de creacion : </style>', $resultados_encuesta_obj->creado],
        ['<style bgcolor="#FFFF00" color="#0000FF">Resultado desde: </style>', $fecha_inicio,$fecha_fin],
        ['<style bgcolor="#FFFF00" color="#0000FF">Numero de preguntas: </style>', count($resultados_encuesta_obj->preguntas)]
        );
        }


        if($header_preguntas){
        //AGREGO CABEZERA FIN
        $row_preguntas=array();
        array_push($row_preguntas,"Nombre Sucursal");
        array_push($row_preguntas,"Codigo Sucursal");
        //genero row donde estaran el nombre de las pregutnas
        foreach($resultados_encuesta_obj->preguntas as $p){
            array_push($row_preguntas,$p->pregunta);
        }
        array_push($rows,$row_preguntas);
        //genero row donde estaran el nombre de las pregutnas----fin
        }


        //----CADA PREGUNTA LE ASIGNO SUS RESPUESTAS TOTALES en un array de string, las respuestas son su descripcion de la opcion
        foreach($resultados_encuesta_obj->preguntas as $p){
                $p->respuestas=array();
                foreach($p->opciones as $opt){
                    foreach($opt->respuestas as $r){
                    array_push($p->respuestas,$opt->descripcion);
                    }
                }
        }
        //---- fin

        //De todas las preguntas, obtengo el numero mayor de respuestas 
        $array_nums_maxrespuestastotales=array();
            foreach($resultados_encuesta_obj->preguntas as $p){
            array_push($array_nums_maxrespuestastotales,count($p->respuestas));
        }
        $max_respuestatotalnumrow=max($array_nums_maxrespuestastotales);
        //-----fin


        for($a=0;$a<$max_respuestatotalnumrow;$a++){
            $row=array();
            //array_push($row,$a+1);
            array_push($row,$negocio->nombre);
            array_push($row,$negocio->codigo);
            foreach($resultados_encuesta_obj->preguntas as $p){
                try{
                array_push($row,$p->respuestas[$a]?$p->respuestas[$a]:"NA");
                }catch(Throwable $ex){
                    array_push($row,"NAex"); 
                }
            }
            array_push($rows,$row);
        }

        return $rows;
    }

}