


<?php V::$viewData->v_box_content=function() { ?>
  
    <style>
    .imgopt {
        width: 100px;
        height: 100px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        transition: all ease-out 0.3s;
        border-radius: 50%;
    }
    .imgopt:hover {
        transform: scale(1.1);
        cursor: pointer;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="animModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">-</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        
      <div id="cont_anim" style="display:flex;justify-content: center;">
      <lottie-player id="lotieimg" src=""  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay
        style="display:none";
        ></lottie-player>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="animModalFinal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">GRACIAS POR RESPONDER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        
      <div id="cont_anim" style="display:flex;justify-content: center;">
      <lottie-player id="lotieimg" src="<?php echo V::$ruta_base.'res/IMG/gracias.json';?>"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay
        style="display:none";
        ></lottie-player>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


    <form id="form_enc" method="post" action="">
        <div style="display:none; justify-content: center;" id="floader">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <input style="display:none;" type="text" name="idencuesta" value="<?php echo V::$data->idencuesta?>">
        <input style="display:none;" type="text" name="idpregunta" value="<?php echo V::$data->pregunta->idpregunta?>">


        <input style="display:none;" type="text" name="url_next_pregunta" value="<?php echo V::$data->url_next_pregunta;?>">


        
        <h6 style="font-size: 4rem;">
            <?php  echo V::$data->pregunta->pregunta;?>
        </h6>

        <?php  switch(V::$data->pregunta->tipo){
        case 'check':
            ?>

        <div style="display:grid;justify-content: center;grid-gap: 5%;">

        <?php foreach(V::$data->pregunta->opciones as $opt) {  ?>
            <div class="form-check cursorr">
                <input class="" type="radio" url_iconanima="<?php echo V::$ruta_base.$opt->url_iconanimr; ?>"
                url_iconanimr="<?php echo $opt->url_iconanimr; ?>"
                value="<?php echo $opt->idopcion;?>" name="idopcion" id="flexRadioDefault<?php echo $opt->idopcion;?>" 
                
                onchange="
                if(isUlt=='1'){showAnimationFinal();sendTemp(5000);}
                else if(showAnimation(this))sendTemp(2000);
                 else sendTemp();
                ">
                <label class="form-check-label cursorr" for="flexRadioDefault<?php echo $opt->idopcion;?>" style="font-size: 1.5rem;">
                    <?php echo $opt->descripcion; ?>
                </label>
            </div>
        <?php } ?>

            <!-- <button type="submit" class="btn btn-primary">ENVIAR</button> -->
        </div>

        <?php
        break;
        case 'click':
            ?>

        <div style="display:flex;flex-wrap: wrap;justify-content: center;grid-gap: 5%;">
            <!-- si es tipo click -->
            <input style="display:none;" type="text" name="idopcion" id="option_valueid">
            <?php foreach(V::$data->pregunta->opciones as $opt) {  ?>
            <img value="<?php echo $opt->idopcion;?>" url_iconanima="<?php echo V::$ruta_base.$opt->url_iconanimr; ?>"
                url_iconanimr="<?php echo $opt->url_iconanimr; ?>" src="<?php echo V::$ruta_base.$opt->url_iconr; ?>" alt="<?php echo $opt->descripcion; ?>" class="imgopt" onclick="
                document.querySelector('#option_valueid').value=this.getAttribute('value');
                if(isUlt=='1'){showAnimationFinal();sendTemp(5000);}
                else if(showAnimation(this))sendTemp(2000);
                 else sendTemp();
                ">
            <?php } ?>

        </div>


        <?php
        break;
        case 'click_t':
            ?>

        <div style="display:flex;flex-wrap: wrap;justify-content: center;grid-gap: 5%;">
            <!-- si es tipo click -->
            <input style="display:none;" type="text" name="idopcion" id="option_valueid">
            <?php foreach(V::$data->pregunta->opciones as $opt) {  ?>

              <div style="display:grid;">
            <img value="<?php echo $opt->idopcion;?>" url_iconanima="<?php echo V::$ruta_base.$opt->url_iconanimr; ?>"
                url_iconanimr="<?php echo $opt->url_iconanimr; ?>" src="<?php echo V::$ruta_base.$opt->url_iconr; ?>" alt="<?php echo $opt->descripcion; ?>" class="imgopt" onclick="
                document.querySelector('#option_valueid').value=this.getAttribute('value');
                if(isUlt=='1'){showAnimationFinal();sendTemp(5000);}
                else if(showAnimation(this))sendTemp(2000);
                 else sendTemp();
                ">
          <label for="" style="text-align:center"><?php echo $opt->descripcion;?></label>
          </div>
            <?php } ?>

        </div>


        <?php
        break; 
        } ?>
        
    </form>

    <script>
        document.addEventListener('keypress', (event) => {
  var name = event.key;
  var code = event.code;
  if(name=='c')//cierra sesion
  window.location.href = "<?php echo V::$ruta_base.'close_negocio_auth'?>";

  if(name=='r')//ver resultados
  window.location.href = "<?php echo V::$ruta_base.'/selectnegocio/encuesta/result_view?idencuesta='.V::$data->idencuesta;?>";

  if(name=='a')//va a adminencuestas
  window.location.href = "<?php echo V::$ruta_base.'/selectnegocio/encuesta/admin';?>";
  // Alert the key name and key code on keydown
  /*alert(`Key pressed ${name} \r\n Key code value: ${code}`);
}, false);*/
        },false);
    </script>


<script>

    var isUlt="<?php  echo V::$data->isUltimaPregunta;?>"

    function getForm() {
        return document.querySelector('#form_enc');
    }


    function showAnimationFinal(){

        $('#animModalFinal').modal('show');
    }

    function showAnimation(elm){

        var urla=elm.getAttribute('url_iconanima');//ruta absoluta
        var urlr=elm.getAttribute('url_iconanimr');//ruta relativa
        if(urlr=='')return false;
        else {
            //alert(urla);
            var cont_anim= document.querySelector('#animModal').querySelector('#cont_anim');
            var lotieplayer=document.querySelector('#animModal').querySelector('#lotieimg');
            lotieplayer.setAttribute('src',urla);

            cont_anim.removeChild(lotieplayer);
            cont_anim.appendChild(lotieplayer.cloneNode(true));
            $('#animModal').modal('show');
            return true;
        }
    }
    function sendTemp(time=1000) {
        document.querySelector('#floader').style.display="grid";
        setTimeout(function() {
            getForm().submit();
        }, time);
    }
</script>

<?php } ?>

<?php
include_once 'Vistas/simplecenter.php';//VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>