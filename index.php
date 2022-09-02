<?php

use Shuchkin\SimpleXLSXGen;

include_once "Modelo/Config.php";
include_once "Modelo/Conexion.php";
include_once "Controlador/Route.php";
//include_once "Modelo/ConexionMysql.php";//Incluyo conexion mysql, esto me abre conexion automatico
include_once "Modelo/ModeloGenericoPDO.php";//Incluyo conexion mysql, esto me abre conexion automatico
//include_once "../Modelo/MPersona.php";//Incluso clase persona
include_once "Modelo/MNegocio.php";
//include_once "../Controlador/PersonaController.php";

include_once "Controlador/Util.php";

/*
Route::get("/",function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'getSelectNegocioV');
});*/
Route::get('/sesion',function(){
    session_start();
    Util::responseJson($_SESSION);
});

Route::get('/close_negocio_auth',function(){
    include_once 'Controlador/EncuestaAuten.php';
    $en=new EncuestaAuth();
    if($en->closeSesion(Util::getIp())){
        V::$data->typemsg="info";
        V::$data->titlemsg="ENCUESTA NEGOCIO CERRADO";
    }else{
        
        V::$data->typemsg="error";
        V::$data->titlemsg="NINGUNA ENCUESTA AUTENTICADA";
    }
    include "Vistas/msg.php"; 
});
//ENTRA EL NEGOCIO
/*
Route::get('/',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'getSelectNegocioV');
});

Route::post('/',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::redirect(V::$ruta_base.'/encuesta_activa?idun='.Util::getRequestObj()->idun.'&n=0');//redirecciono a primera
    //Util::callF(EncuestaController::class,'authNegocio');

});
*/

Route::get('/',function(){
    include_once 'Controlador/EncuestaController.php';
    V::$data->noauth=true;
    Util::callF(EncuestaController::class,'getSelectNegocioV');
});

Route::post('/',function(){
    include_once 'Controlador/EncuestaController.php';
    include_once 'Controlador/CapchaController.php';
    $request=Util::getRequestObj();
    if(CatpchaController::isCorrectCaptcha($request->n_rand,$request->key)){

    Util::redirect(V::$ruta_base.'/encuesta_activa?idun='.Util::getRequestObj()->idun.'&n=0');//redirecciono a primera
    
    }else{
        V::$data->titlemsg="Captcha incorrecto";
        V::$data->typemsg="error";
        include_once 'Vistas/msg.php';
    }
    //Util::callF(EncuestaController::class,'authNegocio');

});
//http://localhost/encuestapuro/encuesta_activa?idun=315&n=1
Route::get('/encuesta_activa',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'getEncuestaActivaV');
});

Route::post('/encuesta_activa',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'saveRespuestaOption');
});

//idencuesta
Route::get('/selectnegocio/encuesta/result_view',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'getEncuestaResultV');
});

//idencuesta
Route::get('/selectnegocio/encuesta/result',function(){
    include_once 'Controlador/EncuestaController.php';
    Util::callF(EncuestaController::class,'getEncuestaResult');
});
//idencuesta,fecha_inicio,fecha_fin,isallnegociosresult=1
Route::get('/selectnegocio/encuesta/result_excel',function(){
    include_once 'Controlador/EncuestaController.php';
    include_once 'Controlador/EncuestaResultController.php';
    include_once 'Modelo/MEncuesta.php';
    include_once 'Controlador/SimpleXLSXGen.php';
    $request=Util::getRequestObj();
    $resultados_obj=MEncuesta::getEncuestaWithResult($request->idencuesta,$request->fecha_inicio,$request->fecha_fin);
    $negocio=ModeloGenerico::selectWhere('un_negocio','idun',$resultados_obj->idun)[0];
    
    //generar rows
    $rows=array();

    $rows=array_merge($rows,EncuestaResultController::resultEncuestaToRows($resultados_obj,
    $negocio,
    true,
    true,
    $request->fecha_inicio,
    $request->fecha_fin
    ));


    //EN CASO PIDA EL RESULTADO DE TODOS LOS NEGOCIOS, BUSCO RESULTADOS DE LOS DEMAS NEGOCIOS
    //SI PIDE RESULTADO DE ESA ENCUESTA Y TAMBIEN DE LOS NEGOCIOS QUE COMPARTEN
    if(isset($request->isallnegociosresult) && $request->isallnegociosresult==1){
            
         $encuestas=MEncuesta::getEncuestasFromIdAssign($resultados_obj->idencuesta_asign);
        
        // echo "Numero de encuestas".
         foreach($encuestas as $e){
            if($e->idencuesta!=$request->idencuesta){
                //FILTRO QUE NO ENTRE LA ANTERIOR ENCUESTA DEL NEGOCIO ACTUAL
                $result=MEncuesta::getEncuestaWithResult($e->idencuesta,$request->fecha_inicio,$request->fecha_fin);
                $negocio_current=ModeloGenerico::selectWhere('un_negocio','idun',$result->idun)[0];
                $rows_current=EncuestaResultController::resultEncuestaToRows($result,
                $negocio_current,
                false,
                false,
                $request->fecha_inicio,
                $request->fecha_fin
                );
                $rows=array_merge($rows,$rows_current);
            }
         }
    }


    SimpleXLSXGen::fromArray($rows)
        ->setDefaultFont('Courier New')
        ->setDefaultFontSize(14)
        //->setColWidth(1, 2) // 1 - num column, 35 - size in chars
        ->mergeCells('A20:B20')
        ->downloadAs('Encuesta '.$resultados_obj->nombre_enc.'_fecha_inicio_'.$request->fecha_inicio.'fecha_fin_'.$request->fecha_fin.'.xlsx');
        //->saveAs('styles_and_tags.xlsx');
        //Util::callF(EncuestaController::class,'getEncuestaResult');
});

//ADMINISTRAR ENCUESTAS
Route::get('/selectnegocio/encuesta/admin',function(){
    include_once 'Modelo/MEncuesta.php';
    include_once 'Controlador/EncuestaAuten.php';
    include_once 'Controlador/EncuestaController.php';
    $e_auth=new EncuestaAuth();
    $s=$e_auth->isAuthNegocio(Util::getIp());//obtengo objeto sesion, negocio y ip
    if($s){
    V::$data->encuestas=MEncuesta::getEncuestasFromIdun($s->negocio->idun);
    V::$data->imagenes_res=EncuestaController::getFilesRes();
    //return Util::responseJson(V::$data->encuestas);
    include_once "Vistas/encuesta/encuestas_crud.php";
    } else{
        V::$data->titlemsg="NO AUTENTICADO";
        include_once "Vistas/msg.php";
    }
});


Route::post('/selectnegocio/encuesta/admin',function(){
   return Util::responseJson(Util::getRequestObj());
});
//ACTIVAR O DESACTIVAR ENCUESTA

Route::get('selectnegocio/encuesta/admin/active',function(){
    $request=Util::getRequestObj();
    include_once "Modelo/MEncuesta.php";
    include_once "Controlador/EncuestaAuten.php";
    include_once "Controlador/AdmAuth.php";

    if(AdmAuth::User()){
        $encuesta_total=MEncuesta::getEncuestaFromId($request->idencuesta);
        if($request->active=="1"){
            MEncuesta::activarEncuesta($request->idencuesta,$encuesta_total->idun);
        }
        if($request->active=="0"){
            MEncuesta::desactivarEncuesta($request->idencuesta,$encuesta_total->idun);
        }
        Util::redirect(V::$ruta_base.'adm/panel?idun='.$encuesta_total->idun);
        return;

    }
    $e=new EncuestaAuth();
    $auth=$e->isAuthNegocio(Util::getIp());
    if($request->active=="1"){
        MEncuesta::activarEncuesta($request->idencuesta,$auth->negocio->idun);
    }
    if($request->active=="0"){
        MEncuesta::desactivarEncuesta($request->idencuesta,$auth->negocio->idun);
    }

    Util::redirect(V::$ruta_base."selectnegocio/encuesta/admin");
});
//save encuesta
Route::post('selectnegocio/encuesta/admin/create',function(){
    $request=Util::getRequestObj();
    //return Util::responseJson($request);

    include_once "Modelo/ModeloGenericoPDO.php";
    include_once "Controlador/EncuestaAuten.php";
    $e=new EncuestaAuth();
    $auth=$e->isAuthNegocio(Util::getIp());

    //si preguntas esta vacio
    if(!isset($request->preguntas) || count($request->preguntas)==0){
        $r=new stdClass();
        $r->msg="ERROR, no tiene preguntas";
        http_response_code(500);
        return Util::responseJson($r);
    }
    //valido que las preguntas tengan almenos una opcion
    foreach($request->preguntas as $p){
        //si preguntas esta vacio
        if(!isset($p->opciones) || count($p->opciones)<=1){
            $r=new stdClass();
            $r->msg=$p->pregunta.":ERROR, no tiene opciones o solo tiene una opcion";
            http_response_code(500);
            return Util::responseJson($r);
        }
    }
    EncuestaController::create_encuesta($request,$auth->negocio->idun,0);

    //devuelvo el mismo objeto, pero ya con sus id de que se inserto
    return Util::responseJson($request);
});


Route::get('selectnegocio/encuesta/admin/delete',function(){
    $request=Util::getRequestObj();

    include_once "Modelo/ModeloGenericoPDO.php";
    include_once "Controlador/EncuestaAuten.php";
    include_once "Modelo/MEncuesta.php";
    include_once "Controlador/AdmAuth.php";
    $encuesta_total=MEncuesta::getEncuestaFromId($request->idencuesta,2);

    
    //VERIFICO QUE LA ENCUESTA PERTENESCA AL NEGOCIO AUTENTICADO, ASI UN NEGOCIO NO PUEDE ELIMINAR OTRAS ENCUESTAS DE OTROS NEGOCIOS INCLUSO CON LA MISMA URL, SOLO PUEDE ELIMINAR LAS QUE HAYA CREADO EL MISMO NEGOCIO
    /*$eauth=new EncuestaAuth();
    if($encuesta_total->idun!=$eauth->isAuthNegocio(Util::getIp())->negocio->idun){
        //SI LA ENCUESTA NO PERTENECE AL NEGOCIO AUTENTICADO
        $r=new stdClass();
        $r->msg=$p->pregunta.":ERROR,ENCUESTA NO PERTENECE URL VIOLATION";
        http_response_code(500);
        return Util::responseJson($r);
    }*/

    //echo json_encode($encuesta_total);
    ModeloGenerico::deleteWhere("encuesta","idencuesta",$encuesta_total->idencuesta);

    foreach($encuesta_total->preguntas as $p){
        ModeloGenerico::deleteWhere("pregunta","idpregunta",$p->idpregunta);
        foreach($p->opciones as $opt){
            ModeloGenerico::deleteWhere("opcion","idopcion",$opt->idopcion);
        }
    }

    //si esta logueado con el servicio, redirigo al panel a donde estan las encuestas de ese negocio
    if(AdmAuth::User()){
        Util::redirect(V::$ruta_base.'adm/panel?idun='.$encuesta_total->idun);
    }else{

    Util::redirect(V::$ruta_base.'selectnegocio/encuesta/admin');
    }
});



//OBTENER ARRAY ENCUESTAS DEL ADMINISTRADOR
Route::get('selectnegocio/encuestas/admin/get_encuestas_asign',function(){
    include_once "Modelo/ModeloGenericoPDO.php";
    
    $admin_enc=ModeloGenerico::selectWhere('un_negocio','nombre','admin')[0];//BUSCO NEGOCIO ADMINISTRADOR por su nombre
    $encuestas_admin=ModeloGenerico::selectWhere('encuesta','idun',$admin_enc->idun);//obtengo todas las encuestas de ese negocio admin
    Util::responseJson($encuestas_admin);//retorno las encuestas en un array
});
//COPiar encuesta del administradpor
Route::get('selectnegocio/encuestas/admin/copy_encuestas_asign',function(){
    include_once 'Controlador/EncuestaController.php';
    include_once 'Controlador/EncuestaAuten.php';
    include_once 'Modelo/MEncuesta.php';
    $request=Util::getRequestObj();

    include_once "Controlador/AdmAuth.php";
    if(AdmAuth::User()){
        $encuesta_total=MEncuesta::getEncuestaFromId($request->id_encuesta);
        $enc_control=new EncuestaController();
        $enc_control->clonarEncuesta($request->id_encuesta,$request->idun);
        return true;
    }
    $auth=new EncuestaAuth();
    $eauth=$auth->isAuthNegocio(Util::getIp());
    //return Util::responseJson($request);
    $enc_control=new EncuestaController();
    $enc_control->clonarEncuesta($request->id_encuesta,$eauth->negocio->idun);
    
    //echo true;
});



//ENCUESTA ADM

Route::get('adm/login',function(){
    include_once 'Controlador/AdmAuth.php';
    if(AdmAuth::User())
    Util::redirect(V::$ruta_base.'adm/panel');
    include_once 'Vistas/encuestadm/login.php';
});
//Login post
Route::post('adm/login',function(){
    include_once 'Modelo/UsuarioBio.php';
    //include_once 'Controlador/AdmAuth.php';
    $request=Util::getRequestObj();
    $biouser=new UsuarioBio();
    if($biouser->login($request->login,$request->password)){
        Util::redirect(V::$ruta_base.'adm/panel');
        return;
    }else{
        V::$data->typemsg='error';
        V::$data->titlemsg='No existe el usuario';
        include_once 'Vistas/msg.php';
        return;
    }
});

//SALE LOGOUT del usuario del SERVICIO BIO
Route::get('adm/logout',function(){
    include_once 'Controlador/AdmAuth.php';
    AdmAuth::logoutt();
    Util::redirect(V::$ruta_base.'adm/login');
});
Route::post('adm/create_encuesta',function(){
    $request=Util::getRequestObj();
    //return Util::responseJson($request);

    include_once "Modelo/ModeloGenericoPDO.php";
    include_once "Controlador/EncuestaAuten.php";
    include_once "Controlador/EncuestaController.php";
    include_once "Controlador/AdmAuth.php";

    //si preguntas esta vacio
    if(!isset($request->preguntas) || count($request->preguntas)==0){
        $r=new stdClass();
        $r->msg="ERROR, no tiene preguntas";
        http_response_code(500);
        return Util::responseJson($r);
    }
    //valido que las preguntas tengan almenos una opcion
    foreach($request->preguntas as $p){
        //si preguntas esta vacio
        if(!isset($p->opciones) || count($p->opciones)<=1){
            $r=new stdClass();
            $r->msg=$p->pregunta.":ERROR, no tiene opciones o solo tiene una opcion";
            http_response_code(500);
            return Util::responseJson($r);
        }
    }

    EncuestaController::create_encuesta($request,$request->idun,AdmAuth::User()->id);

    V::$data->negocios=MNegocio::get();//OBTENGO TODAS LAS SUCURSALES
    //BUSCO NEGOCIo ADMIN Y LO DESETEO
    $negocio_admin=null;
    $i=0;
    foreach(V::$data->negocios as $neg){
        if($neg->nombre=='admin'){
            $negocio_admin=Util::cloneObj($neg);
            unset(V::$data->negocios[$i]);
            break;
        }
        $i++;
    }
    Util::redirect(V::$ruta_base.'adm/panel?idun='.$negocio_admin->idun);
    //devuelvo el mismo objeto, pero ya con sus id de que se inserto
   // return Util::responseJson($request);
});
//MUESTRA EL PANEL DEL ADMINISTRADOR, con LOGIN AL SERVICIO BIO
Route::get('adm/panel',function(){
    include_once 'Modelo/MNegocio.php';
    include_once 'Modelo/MEncuesta.php';
    
    include_once 'Controlador/AdmAuth.php';
    include_once 'Controlador/EncuestaController.php';
    if(!AdmAuth::User()){//si no esta logueado, lo redirigo al login
        Util::redirect(V::$ruta_base.'adm/login');
    }

    

    V::$data->negocios=MNegocio::get();//OBTENGO TODAS LAS SUCURSALES
    

    $request=Util::getRequestObj();
    $idun=isset($request->idun)?$request->idun:null;
    $negocio=null;
    foreach(V::$data->negocios as $neg){
        if($neg->idun==$idun)$negocio=$neg;
    }
    if($negocio==null)$negocio=V::$data->negocios[0];

    //BUSCO NEGOCIo ADMIN Y LO DESETEO
    $negocio_admin=null;
    $i=0;
    foreach(V::$data->negocios as $neg){
        if($neg->nombre=='admin'){
            $negocio_admin=Util::cloneObj($neg);
            unset(V::$data->negocios[$i]);
            break;
        }
        $i++;
    }
    V::$data->negocio_admin=$negocio_admin;
    



    V::$data->nombre_usuario=AdmAuth::User()->nombre;//OBTENGO EL USUARIO ADMin

    V::$data->encuestas=MEncuesta::getEncuestasFromIdun($negocio->idun);
    V::$data->negocio=$negocio;
    V::$data->isAuthService=true;
    V::$data->imagenes_res=EncuestaController::getFilesRes();
    //return Util::responseJson(V::$data->encuestas);
    //include_once "Vistas/encuesta/encuestas_crud.php";
    include_once 'Vistas/encuestadm/adminpanel.php';
});

//AQUI VENDRA EL CRUD DE LA LAS ENCUESTAS DE LAS SUCURSALES, crear encuesta,agregar encuesta del admin, buscador de encuesta
Route::get('adm/sucursal',function(){

});

Route::get('json',function(){
    include_once "Modelo/ModeloGenericoPDO.php";
    include_once "Modelo/MEncuesta.php";
    Util::responseJson(ModeloGenerico::select("encuesta"));
});

Route::eventNotFound();




















/*function POST(){
    PersonaController::registrarPersona();//llamo controlador para registrar persona
}
function GET(){
    include "formulario.html";    //Muestro vista formulario
}*/






/*

//Creo persona de los datos del post
$persona=new MPersona($_POST["nombre"],$_POST["apellido"],$_POST["edad"],$_POST["cedula"],$_POST["direccion"],$_POST["telefono"]);
$persona->save(Conexion::$conn);    //Guardo en la base de datos
Conexion::close();                  //Cierro conexion

*/
/*
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        POST();
        // Boom baby we a POST method
}
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
       GET();
}*/