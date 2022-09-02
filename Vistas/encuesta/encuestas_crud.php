

<?php V::$viewData->v_box_content=function() { ?>

    
    
    <?php include_once "Vistas/encuesta/encuesta_crud_table.php"; ?>

<?php } ?>

<?php
include_once 'Vistas/simplecenter.php';//VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>