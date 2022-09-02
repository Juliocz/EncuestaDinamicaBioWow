
<?php 

V::$viewData->v_body=function(){ ?>
  

<style>
    .caja {
        background-color: white;
        color: var(--theme2-tc);
        border-radius: 20px;
        padding: 40px;
    }

    
</style>
<script>
    var url_selectNegocio="<?php echo V::$ruta_base;?>"

    var url_adminencuesta="<?php echo V::$ruta_base.'selectnegocio/encuesta/admin'?>"
    var url_adminlogout="<?php echo V::$ruta_base.'close_negocio_auth'?>"

    var url_adminpanellogin="<?php echo V::$ruta_base.'adm/login'?>"
</script>
<div style="position: fixed; display: flex; grid-gap: 10px;flex-wrap: wrap;padding: 10px;">
    <img src="<?php echo V::$ruta_base.'res/logo.png'?>" alt="" class="hoverscale" style="width: 50px;height: 50px;border-radius: 50%;">

    
    <?php  if (!isset(V::$data->pregunta)){ ?>
    <div class="hoverscale" onclick="window.location.href=url_selectNegocio">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
        </svg>
    </div>

    <?php  include_once "Controlador/EncuestaAuten.php"; if (EncuestaAuth::isAuthN()){ ?>
    <div class="hoverscale" onclick="window.location.href=url_adminencuesta">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
        </svg>
    </div>

    <div class="hoverscale" onclick="window.location.href=url_adminlogout">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
    </div>

    <?php  } ?>
    <?php  } ?>

    <div class="hoverscale" onclick="window.location.href=url_adminpanellogin">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
    </div>
</div>
<div style="background-color: var(--theme1-bg); min-height: 100vh; display: flex; justify-content: center;align-items: center;  " >
    <div class="caja animateScale" style="min-width: 50%; min-height: 50%;">
        <?php 
        $vf=V::$viewData->v_box_content;
        $vf();
        ?>
    </div>
</div>

<?php } ?>

<?php 
//$v_body();
include_once 'Vistas/base.php';//VISTA DE LA QUE HEREDA 
?>
