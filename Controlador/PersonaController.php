<?php

class PersonaController{
public static function registrarPersona(){
 //Creo persona de los datos del post
 $persona=new MPersona($_POST["nombre"],$_POST["apellido"],$_POST["edad"],$_POST["cedula"],$_POST["direccion"],$_POST["telefono"]);
 $persona->save(Conexion::$conn);    //Guardo en la base de datos
 Conexion::close();  
}
}