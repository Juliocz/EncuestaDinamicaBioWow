<?php

try {
  $conn = new PDO(V::$typedb.":host=".V::$servername.";dbname=".V::$database."", V::$username,V::$password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  Conexion::$conn=$conn;
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


class Conexion{
    public static $conn;
    public static function close(){
        self::$conn->close();
    }
}
?>