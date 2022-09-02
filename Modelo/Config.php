<?php



class V{
    public static $viewData;//en este objeto se guarda todas las funciones de las vistas, esto para hedear cocmo el blade extend
    public static $vf;//variable auxiliar donde se setea la funcion para llamarla
    public static $data;//objeto donde se guardara las variables que se le pasen a la vista
    public static $ruta_base='http://localhost/encuestapuro/';//esta ruta la usare como base 
    //para poder colocar bien los redireccionamientos en las vistas
    //en caso se cambie de ubicaccion el proyecto esto se modifica
/*
    public static $servername = "localhost";
    public static $database = "encuestas";
    public static $username = "root";
    public static $password = "";
     public static $typedb="mysql";
    */

    public static $servername = "localhost";
    public static $database = "encuesta";
    public static $username = "postgres";
    public static $password = "postgre";
    public static $typedb="pgsql";

    public static $appkey='7550f94e9e92281e5fbb61718b9953da';//app key que usare para comparar en el login servicio
    public static $basic_auth_user='ubiopetroladmin';
    public static $basic_auth_password='f0d44bb728d4d26d16ceab6ff633d826';

}
V::$viewData=new stdClass();
V::$data=new stdClass();