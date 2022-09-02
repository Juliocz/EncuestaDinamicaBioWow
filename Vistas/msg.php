<?php V::$viewData->v_box_content=function() { ?>

    <?php  if(isset(V::$data->typemsg)){?>   
<div style="display:flex;justify-content: center;">
    <?php  if(V::$data->typemsg=='info'){?>
        <img src="<?php  echo V::$ruta_base.'res/IMG/information.png'; ?>" alt="" width="128" height="128">
    <?php  }?>

    <?php  if(V::$data->typemsg=='error'){?>
        <img src="<?php  echo V::$ruta_base.'res/IMG/delete.png'; ?>" alt="" width="128" height="128">
    <?php  }?>

    <?php  if(V::$data->typemsg=='good'){?>
        <img src="<?php  echo V::$ruta_base.'res/IMG/check.png'; ?>" alt="" width="128" height="128">
    <?php  }?>



</div>
<?php  }?>
<h3 style="text-align: center;">
<?php  echo V::$data->titlemsg;?>
</h3>

<?php } ?>

<?php
include_once 'Vistas/simplecenter.php';//VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>