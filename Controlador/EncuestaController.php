<?php

class EncuestaController{

    function __construct()
    {

    }

 

    //http://localhost/encuestapuro/encuesta_activa?idun=315&n=1
    //parametros idun=idnegocio,n=indice de pregunta
    //requiere que se haya autenticado en el select negocio,minisesion
    public function getEncuestaActivaV(){
    //aqui faltaria validar si el usuario ingreso idnegocio y codigo,
    //eso solo deberia ejecutarse si el lleno el formulario
    //al llener el formulario, se debe guardar la ip del dispositivo, y el negocioid
    //si el dispoitivo tiene el idun negocio del query entonces continuar.
    //DIcha encuesta se cierra en la computadora, un boton cerrar encuesta, y se borra la ip del session
    //ESTO CON EL FIN DE QUE EL FORMULARIO DE ENTRARA FUNCIONE COMO UN PEQUEÑO LOGIN O AUTENTICACION
    //Y NO CUALQUIER MAQUINA PUEDA VER LA ENCUESTA DE UN NEGOCIO QUE NO INGRESO ID Y CODIGO


    include_once 'Modelo/MEncuesta.php';
    include_once 'Controlador/EncuestaAuten.php';
    
    $n=Util::getRequestObj()->n;//numero pregunta, desde 0

    /*
    //VERIFICO SI ESTA AUTENTICADO
    $en_auth=new EncuestaAuth();
    //$idun=Util::getRequestObj()->idun;

    if(!$en_auth->isAuthNegocio(Util::getIp()))
    {   V::$data->typemsg="error";
        V::$data->titlemsg="El negocio no esta autenticado";
        include_once 'Vistas/msg.php';
        return;
    }

    $idun=$en_auth->isAuthNegocio(Util::getIp())->negocio->idun;//idnegocio
    */
    $idun=Util::getRequestObj()->idun;//idnegocio

    $isUltimaPregunta=0;//si es ultima pregunta false
    $n_next=$n+1;//indice de la siguiente pregunta es igual a la actual+1
    $url_next_pregunta=$n+1;
    $encuesta=MEncuesta::getEncuestaActivaFromIdUn($idun,2);//Obtengo encuesta activa del negocio, estado=1, la encuesta con sus preguntas y opciones dentro
    
    if($encuesta==null){//NO TIENE ENCUESTA ACTIVA
        V::$data->typemsg="error";
        V::$data->titlemsg="La sucursal no tiene encuesta activa";
        include_once 'Vistas/msg.php';
        return;  
    }

    if($n_next>=count($encuesta->preguntas)){//Si el indice siguiente pregunta supera , se resetea a 0
        $isUltimaPregunta=1;    //Se indica que es la ultima pregunta
        $n_next=0;              //si el indice n siguiente url, supera, pone a 0
    }
    
    //armo la url de la siguiente pregunta, con el indice siguiente calculado
    $url_next_pregunta=V::$ruta_base."encuesta_activa?idun=$idun&n=$n_next";
    //le paso la pregunta actual segun su indice


    //SI PREGUNTAS ESTA VACIO
    if(count($encuesta->preguntas)==0){
        V::$data->typemsg="error";
        V::$data->titlemsg="La encuesta '".$encuesta->nombre_enc."' no tiene preguntas. Esta vacio";
        include_once 'Vistas/msg.php';
        return;
    }
    $pregunta=$encuesta->preguntas[$n];

    //PASO VARIABLES A LA VISTA,
    V::$data->isUltimaPregunta=$isUltimaPregunta;
    V::$data->idencuesta=$encuesta->idencuesta;
    V::$data->pregunta=$pregunta;
    V::$data->url_next_pregunta=$url_next_pregunta;
    
    //return Util::responseJson($encuesta);
    include_once 'Vistas/encuesta/encuesta.php';
    //return Util::responseJson(Util::getRequestObj());
    }


    //parametros idencuesta,idpregunta,idopcion,url_next_pregunta
    public function saveRespuestaOption(){
        include_once 'Modelo/MRespuesta.php';
        $r=Util::getRequestObj();//obtengo obj de request
        MRespuesta::insert($r->idencuesta,$r->idpregunta,$r->idopcion);//guardo la respuesta
        Util::redirect($r->url_next_pregunta);//redirecciono a la siguiente pregunta
    }


    //parametros idun=idnegocio,codigo=codigo de negocio
    //crea autenticacion mediante ip, inicia sesion
    public function authNegocio(){
        include_once 'Controlador/EncuestaAuten.php';
        $obj=Util::getRequestObj();
    if($o=MNegocio::isExistNegocio($obj->idun,$obj->codigo)){
        V::$data->titlemsg="NEGOCIO ENCONTRADO"; 
        $en=new EncuestaAuth();

        //cho $en->closeSesion(Util::getIp());
        if($en->isAuthNegocio(Util::getIp())){
            $en->closeSesion(Util::getIp());
            V::$data->typemsg="info";
            V::$data->titlemsg="SE CERRO LA SESION ANTERIOR, ingrese de nuevo.";
            include "Vistas/msg.php"; 
            //Util::redirect(V::$ruta_base.'/sesion');//redirecciono a primera 
            //$en->authNegocio($o,Util::getIp());//autentico mediante ip
           // Util::redirect(V::$ruta_base.'/close_negocio_auth');//redirecciono a primera 
        }else {
        $en->authNegocio($o,Util::getIp());//autentico mediante ip
        Util::redirect(V::$ruta_base.'/encuesta_activa?idun='.$o->idun.'&n=0');//redirecciono a primera
        } 
    }else {
        V::$data->typemsg="error";
        V::$data->titlemsg="NEGOCIO NO ENCONTRADO";   
        include_once "Vistas/msg.php";
    }
    }
    public function getSelectNegocioV0(){
        include_once "Controlador/CapchaController.php";
        $negocios=ModeloGenerico::select('un_negocio');
        V::$data->negocios=$negocios;
        include "Vistas/encuesta/enternegocio.php";
    }
    public function getSelectNegocioV(){
        include_once "Controlador/CapchaController.php";
        $negocios=ModeloGenerico::select('un_negocio');
        V::$data->negocios=$negocios;
        V::$data->catpcha=CatpchaController::generateCatpcha();
        include "Vistas/encuesta/enternegocionoauth.php";
    }



    //parametros idencuesta
    public function getEncuestaResultV(){
        V::$data->idencuesta=Util::getRequestObj()->idencuesta;
        V::$data->sucursal=
        ModeloGenerico::selectWhere("un_negocio","idun",
        ModeloGenerico::selectWhere("encuesta","idencuesta",V::$data->idencuesta)[0]->idun
        )[0];
        include_once 'Vistas/encuesta/resultencuesta.php';
    }
    //parametros idencuesta
    //obtiene encuesta, con sus preguntas,opciones , cada opcion con sus resultados
    public function getEncuestaResult(){
        include_once 'Modelo/MEncuesta.php';
        $request=Util::getRequestObj();
        $fecha_inicio="01-01-2000";
        $fecha_fin="01-01-5000";
        if(isset($request->fecha_inicio) && isset($request->fecha_fin)){
            $fecha_inicio=$request->fecha_inicio;
            $fecha_fin=$request->fecha_fin;
        }
        Util::responseJson(MEncuesta::getEncuestaWithResult($request->idencuesta,$fecha_inicio,$fecha_fin));
    }



    //CLONE ENCUESTA
    public function clonarEncuesta($idencuesta_copy,$idun_paste){
        include_once 'Modelo/ModeloGenericoPDO.php';
        include_once 'Modelo/MEncuesta.php';
        $encuestacopy=MEncuesta::getEncuestaFromId($idencuesta_copy,2);

        $t=new stdClass();
        $t->id_encuesta_copy=$idencuesta_copy;
        $t->encuesta=$encuestacopy;
        

        //INSERTO ENCUESTA Y OBTENGO SU ID
        $idencuesta=ModeloGenerico::insert("encuesta",[
        "nombre_enc"=>$encuestacopy->nombre_enc,
        "idun"=>$idun_paste,
        "idencuesta_asign"=>$encuestacopy->idencuesta
    ]);


    foreach($encuestacopy->preguntas as $p){

                $p->idencuesta=$idencuesta;
                $idpregunta=ModeloGenerico::insert("pregunta",[
                    "idencuesta"=>$p->idencuesta,
                    "pregunta"=>$p->pregunta,
                    "tipo"=>$p->tipo,
                ]);
                //INSERTO LAS OPCIONES DE CADA PREGUNTa
                $orden=1;
                foreach($p->opciones as $opt){
                    $opt->orden=$orden;
                    $opt->idpregunta=$idpregunta;
                    ModeloGenerico::insert("opcion",[
                        "idpregunta"=>$idpregunta,
                        "descripcion"=>$opt->descripcion,
                        "orden"=>$orden,
                        "url_iconr"=>$opt->url_iconr,
                        "url_iconanimr"=>$opt->url_iconanimr,
                    ]);
                    $orden++;
                }
            }

            return Util::responseJson($t);
            //return true;

    }


    //obtiene array de archivos de img res, url_absolute,url_relative,extension
    public static function getFilesRes(){
        $directory="res/IMG/";
        $filesnames=scandir($directory);

        $array_f=array();

        foreach($filesnames as $fn){

            if($fn=='.' || $fn=='..')continue;
            $f=new stdClass();
            $f->url_relative=$directory.$fn;
            $f->url_absolute=V::$ruta_base.$f->url_relative;
            $f->file_name=$fn;
            $f->extension=pathinfo($f->file_name, PATHINFO_EXTENSION);
            array_push($array_f,$f);
        }

        return $array_f;
    }



    public static function create_encuesta($request,$idun,$id_usuario=null){
        //INSERTO ENCUESTA Y OBTENGO SU ID
    $idencuesta=ModeloGenerico::insert("encuesta",[
        "nombre_enc"=>$request->nombre_enc,
        "idun"=>$idun,
        "id_usuario"=>$id_usuario
    ]);
    //INSERTO PREGUNTAS


    foreach($request->preguntas as $p){

/*
        if(count($request->preguntas)==0){
            $r=new stdClass();
            $r->msg="ERROR, no tiene preguntas";
            http_response_code(500);
            return Util::responseJson($r);
        }*/

        $p->idencuesta=$idencuesta;
        $idpregunta=ModeloGenerico::insert("pregunta",[
            "idencuesta"=>$p->idencuesta,
            "pregunta"=>$p->pregunta,
            "tipo"=>$p->tipo,
        ]);
        //INSERTO LAS OPCIONES DE CADA PREGUNTa
        $orden=1;
        foreach($p->opciones as $opt){
            $opt->orden=$orden;
            $opt->idpregunta=$idpregunta;
            ModeloGenerico::insert("opcion",[
                "idpregunta"=>$idpregunta,
                "descripcion"=>$opt->descripcion,
                "orden"=>$orden,
                "url_iconr"=>$opt->url_iconr,
                "url_iconanimr"=>$opt->url_iconanimr,
            ]);
            $orden++;
        }
    }
    }
}