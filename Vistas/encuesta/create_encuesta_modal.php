


<div class="modal fade modal-lg" id="animCreateEncuesta" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 style="text-align: center;">CREAR ENCUESTA</h1>
                <?php if(isset(V::$data->isAuthService)) {  ?>
                    <!-- crear encuesta login service -->
                    <form action="<?php  echo V::$ruta_base."adm/create_encuesta" ?>" method="post">
                    <input type="text" style="display:none;" name="idun" value="<?php  echo V::$data->negocio->idun; ?>">
                <?php }else {  ?>
                    <!-- antiguo login sucursal crear encuesta -->
                    <form action="<?php  echo V::$ruta_base."selectnegocio/encuesta/admin/create" ?>" method="post">
                <?php } ?>
                



                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="nombre_enc">
                    </div>
                    <div class="mb-3">
                        <div style="display:flex;flex-wrap: wrap;">
                            <label for="exampleFormControlInput1" class="form-label">PREGUNTAS: </label>
                            <div class="hoverscale" onclick="addPregunta();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg>
                            </div>
                            <div class="hoverscale" onclick="removePregunta();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-file-minus-fill" viewBox="0 0 16 16">
                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                </svg>
                            </div>
                        </div>

                        <div id="preguntas_cont" style="display:grid;border-color: #888888; min-height: 100px;border-style: solid;">



                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">ENVIAR</button>
                </form>

                <div style="display:none">






                    <!-- elemento base pregunta inicio -->
                    <div id="pregunta_ex">

                    <h5 id="preg_title"></h5>
                        <div style="display: grid;grid-template-columns: 1fr auto auto;">
                            <input type="text" id="pregunta" placeholder="¿Como te fue...?" required>
                            <select name="" id="select_tipo" required>
                                <option value="">Elegir:</option>
                                <option value="click">click imagen</option>
                                <option value="click_t">click imagen texto</option>
                                <option value="check">check</option>
                                
                            </select>
                            <div class="hoverscale" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="btn_showopt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                                    <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z" />
                                </svg>
                            </div>
                        </div>


                        <div class="collapse show" id="collapseExample">
                            <div class="card card-body">
                                <div style="display:flex;flex-wrap: wrap;">
                                    Opciones:

                                    <div class="hoverscale" onclick="addOption(this.parentNode.parentNode.parentNode.parentNode)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>
                                    </div>
                                    <div class="hoverscale" onclick="popOption(this.parentNode.parentNode.parentNode.parentNode)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-file-minus-fill" viewBox="0 0 16 16">
                                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="cont_opciones" style="display:grid;border-color: #888888; min-height: 100px;border-style: solid;">

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- elemento base pregunta fin -->


                    <!-- elemento base opcion inicio -->

                    <div id="opcion_ex">
                            <h5 for="" id="option_title"></h5>
                            <div style="display: grid;grid-template-columns: 2fr 1fr 1fr;">
                                    <div style="display:grid">
                                    <label for="">Descripcion: </label>
                                    <button class="btn btn-warning" style="visibility: hidden;">.......</button>
                                    <input type="text" name="" id="descripcion" style="border-style: solid; border-color: black;" required>
                                    <div style="height: 32px;"></div>
                                    </div>

                                    <div style="display:grid">
                                        <label for="">ICONO AL CLICKEAR</label>
                                        <div class="btn btn-warning" onclick="showSelectImagenesRes(
                                        this.parentNode.querySelector('#url_iconr'),
                                        this.parentNode.querySelector('#preview_img'),
                                        this.parentNode.querySelector('#preview_animation')
                                        )">Elejir Image: </div>
                                    <input type="text" name="" id="url_iconr" style="border-style: solid; border-color: black;">
                                    <div style="display:flex;flex-wrap: wrap; justify-content: center;">
                                        <img src="" alt="" id="preview_img" style="width: 32px; height: 32px;">
                                        <lottie-player src="" alt="" id="preview_animation" style="width: 32px; height: 32px;"  background="transparent"  speed="1" loop autoplay>
                                    </div>
                                    </div>

                                    <div style="display:grid">
                                    <label for="">ICONO ANIMADO</label>
                                    <div class="btn btn-warning" onclick="showSelectImagenesRes(this.parentNode.querySelector('#url_iconanimr'),
                                        this.parentNode.querySelector('#preview_img'),
                                        this.parentNode.querySelector('#preview_animation'))">Elejir Image: </div>    
                                    <input type="text" name="" id="url_iconanimr" style="border-style: solid; border-color: black;">
                                    <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                                        <img src="" alt="" id="preview_img" style="width: 32px; height: 32px;">
                                        <lottie-player src="" id="preview_animation" style="width: 32px; height: 32px;" background="transparent"  speed="1" loop autoplay></lottie-player>
                                    </div>
                                    </div>
                                    
                            </div>
                    </div>
                    <!-- elemento base opcion fin -->

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<?php include_once "Vistas/encuesta/selecto_res_image.php"; ?>
<script>

    var preg_ex=document.querySelector("#pregunta_ex");
    var opt_ex=document.querySelector("#opcion_ex");
    function showCreateEncModal() {
        $("#animCreateEncuesta").modal("show");
    }


    function removePregunta() {
        var preg_cont = document.querySelector("#preguntas_cont");
        preg_cont.removeChild(preg_cont.lastChild);
    }

    function addPregunta() {
        var preg_elm = preg_ex.cloneNode(true);



        var preg_cont = document.querySelector("#preguntas_cont");
        //console.log(preg_cont.children[preg_cont.children.length-1]);

        var i = 0;
        var ultimo = preg_cont.children[preg_cont.children.length - 1];
        if (ultimo == undefined) {
            // alert(ultimo);
        } else {
            i = Number(ultimo.getAttribute('index')) + 1;
        }

        preg_elm.setAttribute('index', i);
        preg_elm.querySelector('#preg_title').innerHTML='Pregunta # '+(i+1);
        preg_elm.querySelector("#btn_showopt").setAttribute('data-bs-target', "#prcollapse" + i);
        preg_elm.querySelector("#pregunta").setAttribute('name', "preguntas[" + i + "][pregunta]");
        preg_elm.querySelector("#select_tipo").setAttribute('name', "preguntas[" + i + "][tipo]");


        preg_elm.querySelector(".collapse").setAttribute('id', "prcollapse" + i);

        preg_cont.appendChild(preg_elm);

    }

    function addOption(elm_preg) {
        var cont_opciones=elm_preg.querySelector('.cont_opciones');
        var opt_elm = opt_ex.cloneNode(true);


        var i = 0;
        var ultimo = cont_opciones.children[cont_opciones.children.length - 1];
        if (ultimo == undefined) {
            // alert(ultimo);
        } else {
            i = Number(ultimo.getAttribute('index')) + 1;
        }
        var index_preg=elm_preg.getAttribute('index');
        opt_elm.setAttribute('index', i);
        opt_elm.querySelector('#option_title').innerHTML="Opcion # "+(i+1);
        //preg_elm.querySelector("#btn_showopt").setAttribute('data-bs-target', "#prcollapse" + i);
        opt_elm.querySelector("#descripcion").setAttribute('name', "preguntas[" + index_preg + "][opciones]["+i+"][descripcion]");

        opt_elm.querySelector("#url_iconr").setAttribute('name', "preguntas[" + index_preg + "][opciones]["+i+"][url_iconr]");

        opt_elm.querySelector("#url_iconanimr").setAttribute('name', "preguntas[" + index_preg + "][opciones]["+i+"][url_iconanimr]");
        //preg_elm.querySelector("#select_tipo").setAttribute('name', "preguntas[" + i + "][tipo]");

       // preg_elm.querySelector(".collapse").setAttribute('id', "prcollapse" + i);

       cont_opciones.appendChild(opt_elm);
    }


    function popOption(elm_preg){
        var cont_opciones=elm_preg.querySelector('.cont_opciones');
        cont_opciones.removeChild(cont_opciones.lastChild);
    }


   
</script>