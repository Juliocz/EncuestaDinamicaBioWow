<?php
// Create connection
$conn = mysqli_connect(V::$servername, V::$username, V::$password, V::$database);
// Check connection
Conexion::$conn=$conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);

class Conexion{
    public static $conn;
    public static function close(){
        self::$conn->close();
    }
}
?>