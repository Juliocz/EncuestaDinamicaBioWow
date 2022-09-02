<div>
<?php include_once "Vistas/encuesta/create_encuesta_modal.php"; ?>

    <?php include_once "Vistas/encuesta/asignar_encuesta_modal.php"; ?>
  <script>

    var idun='';
    idun="<?php echo isset(V::$data->negocio)?V::$data->negocio->idun:'';?>";
    

     //function se le pasa el id de la encuesta que se copiaral, yse copia como encuesta del negocio autenticado
     function copyEncuesta(id_encuesta_copy){
        var setting_copy_encuesta={
            "url":"<?php echo V::$ruta_base.'selectnegocio/encuestas/admin/copy_encuestas_asign?id_encuesta='; ?>"+id_encuesta_copy+"&idun="+idun,
            crossDomain:true,
            "method":"GET",
            "timeout":0,
            "headers":{
                "Content-Type":"application/json"
            },
            "data":'',
        };

        $.ajax(setting_copy_encuesta).done(function(response){
            console.log(response);
            //chargueItemsToTableEnc(response,call_asignClickItem_objj);//cargo encuesta del administrador general al modal
            alert("Se asigno correctamente encuesta");
            window.location.reload(true)
        }).fail(function(jqXHR,textStatus){
            alert("Ocurrio un error al asignar encuesta")
            console.log(jqXHR.responseText);
        });
    }

    
  </script>
  <h1 style="text-align: center; font-weight: bold;">SUCURSAL <?php echo V::$data->negocio->nombre;?></h1>
    <h1 style="text-align: center;">ENCUESTAS</h1>
    
    <button type="button" class="btn btn-success" onclick="showCreateEncModal();" >CREAR ENCUESTA
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
    </svg>
    </button>

    <!-- <script>
        alert("<?php echo V::$data->negocio->nombre; ?>")
    </script> -->
    <?php if(!(isset(V::$data->negocio) && V::$data->negocio->nombre=='admin')) { ?>

    <button type="button" class="btn btn-warning" onclick="showAndLoadAsignEncuesta(function(objj){console.log(objj);copyEncuesta(objj.idencuesta);})" >ASIGNAR ENCUESTA

    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-square-fill" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 4a.5.5 0 0 0-.374.832l4 4.5a.5.5 0 0 0 .748 0l4-4.5A.5.5 0 0 0 12 6H4z"/>
    </svg>
    </button>

    <?php  
    } else {  ?>

    <?php  
    }   ?>
    
    <!-- <button type="button" class="btn btn-warning" onclick="showAndLoadAsignEncuesta(function(objj){console.log(objj);copyEncuesta(objj.idencuesta);})" >ASIGNAR ENCUESTA

    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-square-fill" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 4a.5.5 0 0 0-.374.832l4 4.5a.5.5 0 0 0 .748 0l4-4.5A.5.5 0 0 0 12 6H4z"/>
    </svg>
    </button> -->
    
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre:</th>
      <th scope="col">Creado</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>

  <?php $i=1; foreach(V::$data->encuestas as $e) { ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $e->nombre_enc; ?></td>
      <td><?php echo $e->creado; ?></td>
      <td>

        <?php if($e->estado=="1") { ?>
        <div value="play">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
        </div>
        <?php } ?>

        <?php if($e->estado=="0") { ?>
        <div value="play">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-stop-fill" viewBox="0 0 16 16">
        <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
        </svg>
        </div>
        <?php } ?>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Editar
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <?php if($e->estado=="1") { ?>
                <li><a class="dropdown-item" href="<?php  echo V::$ruta_base."encuestapuro/encuesta_activa?n=0&idun=".$e->idun;?>">Ir a</a></li>
                <?php } ?>
                <?php if($e->estado=="0") { ?>
                <li><a class="dropdown-item" href="<?php  echo V::$ruta_base."selectnegocio/encuesta/admin/active?active=1&idencuesta=".$e->idencuesta;?>">Activar</a></li>
                <?php } ?>
                <?php if($e->estado=="1") { ?>
                <li><a class="dropdown-item" href="<?php  echo V::$ruta_base."selectnegocio/encuesta/admin/active?active=0&idencuesta=".$e->idencuesta;?>">Desactivar</a></li>
                <?php } ?>

                <li><a class="dropdown-item" url="<?php  echo V::$ruta_base."selectnegocio/encuesta/admin/delete?idencuesta=".$e->idencuesta;?>"
                
                onclick="
                if(confirm('¿Desea eliminar la encuesta?'))
                window.location.href=this.getAttribute('url');
                "
                
                >Eliminar</a></li>

                <li><a class="dropdown-item" href="<?php  echo V::$ruta_base."selectnegocio/encuesta/result_view?idencuesta=".$e->idencuesta;?>">Ver resultados</a></li>
            </ul>
        </div>


      </td>
    </tr>
    <?php $i++;} ?>


  </tbody>
</table>
</div>