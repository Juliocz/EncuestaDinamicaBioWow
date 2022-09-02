
<?php V::$viewData->v_box_content=function() { ?>

<form action="" method="post" >
    <div style="display: flex;justify-content: center;">
        <h1>ENCUESTAS</h1>
    <img src="<?php echo V::$ruta_base.'res/logo.png'?>" alt="" class="hoverscale" style="width: 50px;height: 50px;border-radius: 50%;">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">INGRESE ID DEL NEGOCIO:</label>

        <!-- <input type="text" class="form-control" name="idnegocio" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ID NEGOCIO" required> -->
    </div>
    <div class="form-group">
        <select id="" class="form-select" name="idun" required>
            <option value="">Elejir Negocio</option>
            <?php foreach(V::$data->negocios as $n){?>
            <option value="<?php echo $n->idun; ?>"><?php echo $n->nombre; ?></option>
            <?php }?>
        </select>
    </div>





        <div class="form-group">
            <!-- <div style="display: grid; justify-content: center;"> -->
            <img src="<?php  echo V::$data->catpcha->img_url?>" style="width:75px; heigth:50px;" alt="">
            <label for="exampleInputEmail1" style="text-align: center;">Ingrese el numero:</label>
            <!-- </div> -->
            <input type="text" class="form-control" name="n_rand" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
            <input type="text" class="form-control" name="key" value="<?php  echo V::$data->catpcha->key?>" aria-describedby="emailHelp" placeholder="" style="display:none" required>
        </div>
   
    <button type="submit" class="btn btn-success" style="width: 100%;">VER ENCUESTA</button>
</form>
<?php } ?>

<?php
include_once 'Vistas/simplecenter.php';//VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>