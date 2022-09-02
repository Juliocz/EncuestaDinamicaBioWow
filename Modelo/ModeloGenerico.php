<?php

class ModeloGenerico
{
    public static $table = "persona";
    function __construct(){
               
    }

    public static function deleteWhere($table,$column,$value){

        $sql = "DELETE FROM " .$table." where $column='$value' ";
        $resultado = Conexion::$conn->query($sql);
        if ($resultado === true) {
            echo $sql . "  ";
            return true;
        } else {
            echo $sql . "  ";
            echo "error" . Conexion::$conn->error;
            return false;
        }
    }
    public static function insert($table,$array_values)
    {   
        $sql = "INSERT INTO " . $table .
            "(".implode(',',array_keys($array_values)).")
            VALUES ('".
            implode("','",array_values($array_values))
            ."')";
       // echo $sql;
        if (Conexion::$conn->query($sql) === TRUE) {
            //echo "NUEVA AGREGADO CORRECTAMENTE.";
        } else {
            echo "Error: " . $sql . "<br>" . Conexion::$conn->error;
        }
    }


    public static function select($table)
    {   $sql = "Select * from " .$table. "";
        $resultado = Conexion::$conn->query($sql);
        
        if ($resultado === false) {
            /* echo "error".$conn->error;*/ //oculto error ya que da igual cuando no hay ningun resultado
            return false;
        } else {
            /* echo $sql."  ".json_encode($resultado);*/
            /* echo json_encode($resultado->fetch_assoc());*/
            $array = [];
            $row = null;
            while ($row = $resultado->fetch_assoc())
                array_push($array, $row);
            return json_decode(json_encode($array));
        }
    }

    public static function selectWhere($table,$column,$value,$rawsql=''){
        $sql = "Select * from " .$table. " where $column = '$value' $rawsql";
        $resultado = Conexion::$conn->query($sql);

        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
        if ($resultado === false) {
            /* echo "error".$conn->error;*/ //oculto error ya que da igual cuando no hay ningun ////////resultado
            return false;
        } else {
            /* echo $sql."  ".json_encode($resultado);*/
            /* echo json_encode($resultado->fetch_assoc());*/
            $array = [];
            $row = null;
            while ($row = $resultado->fetch_assoc())
                array_push($array, $row);
            return json_decode(json_encode($array));
        }
    }
    public static function selectWhereAndWhere($table,$column,$value,$column2,$value2){
        $sql = "Select * from " .$table. " where $column = '$value'
         and $column2='$value2'
        ";
        
        $resultado = Conexion::$conn->query($sql);

        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
        if ($resultado === false) {
            echo $sql;
            /* echo "error".$conn->error;*/ //oculto error ya que da igual cuando no hay ningun resultado
            return false;
        } else {
            /* echo $sql."  ".json_encode($resultado);*/
            /* echo json_encode($resultado->fetch_assoc());*/
            $array = [];
            $row = null;
            while ($row = $resultado->fetch_assoc())
                array_push($array, $row);
            return json_decode(json_encode($array));
        }
    }


    public static function modificar($table,$array_values,$where_column,$where_value){
       

         /*$sql = "update " . $table . " set 
        //     nombre='$persona->nombre',
        //     apellido='$persona->apellido',
        //     telefono='$persona->telefono ',
        //     direccion='$persona->direccion ',
        //     edad='$persona->edad' 
        //     where $where_column='$where_value' ";*/


        $array_consulta=array();
        $columna_nombres=array_keys($array_values);
        $columna_values=array_values($array_values);

        for($i=0;$i<count($columna_nombres);$i++){
            $columna="$columna_nombres[$i]='$columna_values[$i]'";
            array_push($array_consulta,$columna);
        }

        $update_sql_part=implode(',',array_keys($array_consulta));
        $sql="update " . $table . " set $update_sql_part where $where_column='$where_value'";



         $resultado = Conexion::$conn->query($sql);
         if ($resultado === false){
            echo "Ocurrio un error al modificar";
            echo $sql;
            echo "error" . Conexion::$conn->error;
            return false;
         }else
         {
            return true;
         }
    }
}
