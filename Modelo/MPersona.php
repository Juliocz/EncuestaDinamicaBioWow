<?php
include_once "ConexionMysql.php";
$conn;

class MPersona
{
    public static $table = "persona";
    var $nombre;

    var $apellido;
    var $direccion;
    var $edad;
    public $cedula;
    var $telefono;

    /*public function MPersona(){
            $this->nombre="";
            $this->apellido="";
            $this->edad="";
            $this->direccion="";
            $this->cedula="";
            $this->telefono="";
        }*/
    function __construct($nombre = "", $apellido = "", $edad = "", $cedula = "", $direccion = "", $telefono = "")
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->direccion = $direccion;
        $this->cedula = $cedula;
        $this->telefono = $telefono;
    }
    /* function __construct(){
            $this->nombre="";
            $this->apellido="";
            $this->edad="";
            $this->direccion="";
            $this->cedula="";
            $this->telefono="";
        }*/
    /* public function __init(){
            $this->nombre="";
            $this->apellido="";
            $this->edad="";
            $this->direccion="";
            $this->cedula="";
            $this->telefono="";
        }*/

    public function save($conn)
    {
        $sql = "INSERT INTO " . self::$table .
            "(nombre,apellido,direccion,edad,cedula,telefono)
            VALUES (" .
            "'" . $this->nombre . "'," .
            "'" . $this->apellido . "'," .
            "'" . $this->direccion . "'," .
            "'" . $this->edad . "'," .
            "'" . $this->cedula . "'," .
            "'" . $this->telefono . "'" .
            ")";

        echo $sql . "<br>";
        if ($conn->query($sql) === TRUE) {
            echo "NUEVA PERSONA AGREGADO CORRECTAMENTE.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public static function getPersonaFromCedula($conn, $cedula)
    {
        $sql = "Select * from " . self::$table . " where cedula=$cedula";
        $resultado = $conn->query($sql);

        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
        if ($resultado === false) {
            /* echo "error".$conn->error;*/ //oculto error ya que da igual cuando no hay ningun resultado
            return false;
        } else {
            /* echo $sql."  ".json_encode($resultado);*/
            /* echo json_encode($resultado->fetch_assoc());*/
            return json_decode(json_encode($resultado->fetch_assoc()));
        }
    }

    public static function getPersonas($conn)
    {
        $sql = "Select * from " . self::$table . "";
        $resultado = $conn->query($sql);

        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
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

            return $array;
        }
    }

    public static function getPersonasFromCedula($conn, $cedula)
    {
        $sql = "Select * from " . self::$table . " where cedula='$cedula'";
        $resultado = $conn->query($sql);

        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
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

            return $array;
        }
    }


    public static function modificarFromCedula($conn, $persona, $cedulaMod = null)
    {

        //aqui me esta devolviendo >1 la consulta sale true aunque meta cedula con letras

        //echo $cedulaMod;
        if (!$cedulaMod) $cedulaMod = $persona->cedula;
        // echo $cedulaMod;
        // echo count(self::getPersonasFromCedula($conn,$cedulaMod));
        //if(count(self::getPersonasFromCedula($conn,$cedulaMod))==0)return false;//si no existe persona, no modifica nada



        /* $sql="update ".self::$table." set 
            nombre='$persona->nombre',
            apellido='$persona->apellido',
            telefono='$persona->telefono ',
            direccion='$persona->direccion ',
            edad='$persona->edad' ,
            cedula='$persona->cedula '
            where cedula='$cedulaMod' ";*/

        $sql = "update " . self::$table . " set 
            nombre='$persona->nombre',
            apellido='$persona->apellido',
            telefono='$persona->telefono ',
            direccion='$persona->direccion ',
            edad='$persona->edad' 
            where cedula='$cedulaMod' ";

        $resultado = $conn->query($sql);


        //echo $resultado->num_rows;
        /*echo $sql."  ".json_encode($resultado,false);*/
        if ($resultado === false) {
            /* echo "error".$conn->error;*/ //oculto error ya que da igual cuando no hay ningun resultado
            echo $sql . "  ";
            echo "error" . $conn->error;
            return false;
        } else {
            //echo "Consulta: ".$sql;
            //echo json_encode($resultado);
            /* echo $sql."  ".json_encode($resultado);*/
            /* echo json_encode($resultado->fetch_assoc());*/
            return true;
            /* return json_decode(json_encode($resultado->fetch_assoc()));*/
        }
    }


    public static function deleteFromCedula($conn, $cedula)
    {
        /* DELETE FROM table_name
        WHERE some_column = some_value*/

        $sql = "DELETE FROM " . self::$table . " where cedula='$cedula' ";
        $resultado = $conn->query($sql);

        if ($resultado === true) {
            echo $sql . "  ";
            return true;
        } else {
            echo $sql . "  ";
            echo "error" . $conn->error;
            return false;
        }
    }
}
