<?php
include_once "Modelo/MPregunta.php";
include_once "Modelo/MOption.php";
include_once "Modelo/MRespuesta.php";
class MEncuesta
{
    public static $table = "encuesta";


    function __construct()
    {
        $this->id_usuario;
        $this->nombre_enc;
        $this->id_un;
        $this->estado;
        $this->creado;
        $this->modificado;
    }

    public function setValues($id_usuario,$nombre_enc,$id_un,$estado){

        $this->id_usuario=$id_usuario;
        $this->nombre_enc=$nombre_enc;
        $this->id_un=$id_un;
        $this->estado=$estado;
    }

    public function save(){

    }



    //busca encuesta, solo devuelve una encuesta, que es la que este activa
    public static function getEncuestaActivaFromIdUn($idun,$option=null){
        
        //with preguntas
        $encuestas=ModeloGenerico::selectWhereAndWhere(self::$table,'idun',$idun,'estado',1);
        $encuesta=null;
        if(count($encuestas)==0)return null;
        else $encuesta=$encuestas[0];
        switch($option){
            case null: return $encuesta;break;
            case 1: //devuelve la encuesta con sus preguntas
                MPregunta::insertPreguntasIntoEncuesta($encuesta);
                return $encuesta;break;
            case 2://devuelve encuesta con preguntas y dentro sus opciones
                MPregunta::insertPreguntasIntoEncuesta($encuesta);
                foreach($encuesta->preguntas as $p){
                    MOpcion::insertOpcionesIntoPregunta($p);
                }
                return $encuesta;break;
        }
    }

    //busca encuesta, solo devuelve una encuesta, que es la que este activa
    public static function getEncuestaFromId($idencuesta,$option=null){
        
        //with preguntas
        $encuestas=ModeloGenerico::selectWhere(self::$table,'idencuesta',$idencuesta);
        $encuesta=null;
        if(count($encuestas)==0)return null;
        else $encuesta=$encuestas[0];
        switch($option){
            case null: return $encuesta;break;
            case 1: //devuelve la encuesta con sus preguntas
                MPregunta::insertPreguntasIntoEncuesta($encuesta);
                return $encuesta;break;
            case 2://devuelve encuesta con preguntas y dentro sus opciones
                MPregunta::insertPreguntasIntoEncuesta($encuesta);
                foreach($encuesta->preguntas as $p){
                    MOpcion::insertOpcionesIntoPregunta($p);
                }
                return $encuesta;break;
        }
    }

    public static function getEncuestaWithResult($idencuesta,$fecha_inicio='01-01-1000',$fecha_fin='01-01-5000'){
        $encuesta=ModeloGenerico::selectWhere(self::$table,'idencuesta',$idencuesta)[0];
        MPregunta::insertPreguntasIntoEncuesta($encuesta);
        foreach($encuesta->preguntas as $p){
            MOpcion::insertOpcionesIntoPregunta($p);  
        }
        foreach($encuesta->preguntas as $p){
            foreach($p->opciones as $opt){
                $resp=MRespuesta::getRespuestasFrom($encuesta->idencuesta,$p->idpregunta,$opt->idopcion,$fecha_inicio,$fecha_fin);
                $opt->respuestas=$resp;
            }
        }

        return $encuesta;
    }


    public static function getEncuestasFromIdun($idun){
        return ModeloGenerico::selectWhere(self::$table,'idun',$idun,"order by nombre_enc,creado");
    }

    //activar encuesta, desactiva todas y deja activa una
    public static function activarEncuesta($idencuesta,$idun){
        ModeloGenerico::modificar(self::$table,["estado"=>0],"estado",1,"idun",$idun);//desactivo todos los que esten en estado 1 de ese negocio

        //activo solo esa encuesta de ese negocio
        ModeloGenerico::modificar(self::$table,["estado"=>1],"idencuesta",$idencuesta,"idun",$idun);
    }
    public static function desactivarEncuesta($idencuesta,$idun){
        //activo solo esa encuesta de ese negocio
        ModeloGenerico::modificar(self::$table,["estado"=>0],"idencuesta",$idencuesta,"idun",$idun);
    }

    public static function getEncuestasFromIdAssign($idencuesta_asign){
        //TRAER TODAS LAS ENCUESTAS SEGUN UN ID ASIGN
        return ModeloGenerico::selectRaw(self::$table,"where idencuesta_asign= $idencuesta_asign");

    }
}

