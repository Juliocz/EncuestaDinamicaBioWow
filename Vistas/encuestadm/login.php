<?php V::$viewData->v_box_content=function() { ?>



<form action="<?php echo V::$ruta_base.'adm/login'?>" method="post">
    <div style="display: flex;justify-content: center;">
        <h1>INGRESAR</h1>
    <img src="<?php echo V::$ruta_base.'res/logo.png'?>" alt="" class="hoverscale" style="width: 50px;height: 50px;border-radius: 50%;">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">USUARIO :</label>
        <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Julio Cesar Ll." required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">PASSWORD:</label>
        <input type="password" class="form-control" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="******" required>
    </div>
    <button type="submit" class="btn btn-success" style="width: 100%;">INGRESAR</button>
</form>



<?php } ?>

<?php
include_once 'Vistas/simplecenter.php';//VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>