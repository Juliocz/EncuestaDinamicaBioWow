<?php

class ModeloGenerico
{
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
            
            try {
            Conexion::$conn->prepare($sql)->execute();
            return Conexion::$conn->lastInsertId(); //retorna el ultimo id
            } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
          }
    }


    public static function select($table)
    {   $sql = "Select * from " .$table. "";
        ////

        try {
            //$stmt = Conexion::$conn->prepare($sql);
            //$stmt->execute();
          
            $data = Conexion::$conn->query($sql)->fetchAll();
            // set the resulting array to associative
           // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
           // foreach($stmt->fetchAll() as $k=>$v) {
            //  echo $v;
           // }
            return json_decode(json_encode($data));
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
          }
          
    }

    public static function selectRaw($table,$sqlraw){
      $sql="Select * from $table $sqlraw";
      try {     
        $data = Conexion::$conn->query($sql)->fetchAll();
        return json_decode(json_encode($data));
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
      }
    }

    public static function selectWhere($table,$column,$value,$rawsql=''){
        $sql = "Select * from " .$table. " where $column = '$value' $rawsql";
        try {
            //$stmt = Conexion::$conn->prepare($sql);
            //$stmt->execute();
          
            $data = Conexion::$conn->query($sql)->fetchAll();
            // set the resulting array to associative
           // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
           // foreach($stmt->fetchAll() as $k=>$v) {
            //  echo $v;
           // }
            return json_decode(json_encode($data));
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
          }
    }
    public static function selectWhereAndWhere($table,$column,$value,$column2,$value2){
        $sql = "Select * from " .$table. " where $column = '$value'
         and $column2='$value2'
        ";
        ////

        try {
            //$stmt = Conexion::$conn->prepare($sql);
            //$stmt->execute();
          
            $data = Conexion::$conn->query($sql)->fetchAll();
            // set the resulting array to associative
           // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
           // foreach($stmt->fetchAll() as $k=>$v) {
            //  echo $v;
           // }
            return json_decode(json_encode($data));
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
          }
    }

    public static function selectWhereAndWhereAndWhere($table,$column,$value,$column2,$value2,$column3,$value3,$sqlraw=""){
      $sql = "Select * from " .$table. " where $column = '$value'
       and $column2='$value2' and $column3='$value3' $sqlraw
      ";
      ////

      try {
          //$stmt = Conexion::$conn->prepare($sql);
          //$stmt->execute();
        
          $data = Conexion::$conn->query($sql)->fetchAll();
          // set the resulting array to associative
         // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
         // foreach($stmt->fetchAll() as $k=>$v) {
          //  echo $v;
         // }
          return json_decode(json_encode($data));
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
          return null;
        }
  }

    //falta adaptar para pdo
    public static function modificar($table,$array_values,$where_column,$where_value,$where_column2=null,$where_value2=null){
       

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
        //echo json_encode(implode(',',$array_consulta));

        $update_sql_part=implode(',',$array_consulta);
        $sql="update " . $table . " set $update_sql_part where $where_column='$where_value'";

        if($where_column2!=null){
          $sql="update " . $table . " set $update_sql_part where $where_column='$where_value'
           and $where_column2='$where_value2'
          ";
        }


        Conexion::$conn->beginTransaction();
         $resultado = Conexion::$conn->prepare($sql)->execute();

         Conexion::$conn->commit();
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
