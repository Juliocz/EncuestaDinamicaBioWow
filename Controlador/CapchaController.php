<?php

class CatpchaController{

    public static $catcha_url="http://biopetrol.com.bo/mispuntos/button.php?texto=";
    public static $session_var="EncuestaCatpcha_array";
    function __construct()
    {

    }
    public static function initt(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }

        if(!isset($_SESSION[self::$session_var]))$_SESSION[self::$session_var]=array();
    }

    public static function generateCatpcha(){
        self::initt();

        $n_rand=rand(1,1000); 
        $key=md5(time().$n_rand);
        $img_url=self::$catcha_url.$n_rand;

        $catpcha=(object)[
            "n_rand"=>$n_rand,
            "key"=>$key,
            "img_url"=>$img_url
        ];

        array_push($_SESSION[self::$session_var],$catpcha);
        return $catpcha;
    }

    public static function isCorrectCaptcha($n_rand,$key){
        self::initt();

        $i=0;
        foreach($_SESSION[self::$session_var] as $obj){
            if($obj->n_rand==$n_rand && $obj->key==$key){
                unset($_SESSION[self::$session_var][$i]);
                return true;
            }

            $i++;
        }

        return false;
    }

}