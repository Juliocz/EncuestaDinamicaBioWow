<div class="modal fade modal-lg" id="animAsignarEncuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">ASIGNAR ENCUESTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 style="text-align: center;">ENCUESTAS DISPONIBLES</h1>


                <table class="table table-hover" id="table_asign_enc">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Encuesta</th>
                            <th scope="col">Creado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row_example">
                            <th scope="row" id="index">1</th>
                            <td id="nombre_enc">Mark</td>
                            <td id="creado">Otto</td>
                            <td>
                                <div id="asign_click" class="hoverscale">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-capslock-fill" viewBox="0 0 16 16">
                                        <path d="M7.27 1.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1H1.654C.78 9.5.326 8.455.924 7.816L7.27 1.047zM4.5 13.5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1z"/>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div style="display:none">

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    var modal_asign_enc=document.querySelector('#animAsignarEncuesta');
    var table_asign_enc=modal_asign_enc.querySelector('#table_asign_enc');
    var row_asign=table_asign_enc.querySelector('#row_example');
    table_asign_enc.querySelector('tbody').innerHTML='';


    function chargueItemsToTableEnc(items,f_click=function(objj){}){
        var body=table_asign_enc.querySelector('tbody');
        body.innerHTML='';
        var index=1;
        for(var enc of items){
            var r=row_asign.cloneNode(true);
            r.querySelector('#index').innerHTML=index;
            r.querySelector('#nombre_enc').innerHTML=enc.nombre_enc;
            r.querySelector('#creado').innerHTML=enc.creado;
            r.objj=enc;

            r.querySelector('#asign_click').onclick=function(){
                f_click(r.objj);
            }

            body.appendChild(r);
            index++;
        }
    }


    var setting_get_encuesta={
            "url":"<?php echo V::$ruta_base.'selectnegocio/encuestas/admin/get_encuestas_asign'; ?>",
            crossDomain:true,
            "method":"GET",
            "timeout":0,
            "headers":{
                "Content-Type":"application/json"
            },
            "data":"",
        };


    function showAndLoadAsignEncuesta(call_asignClickItem_objj){
        var body=table_asign_enc.querySelector('tbody');
        body.innerHTML='';

        showModalAsignEnc();

        $.ajax(setting_get_encuesta).done(function(response){
            console.log(response);
            chargueItemsToTableEnc(response,call_asignClickItem_objj);//cargo encuesta del administrador general al modal
            
        }).fail(function(jqXHR,textStatus){
            alert("Ocurrio un error al obtener Encuestas")
            console.log(jqXHR.responseText);
        });
    }

    function showModalAsignEnc(){
        $(modal_asign_enc).modal("show");
    }
    function closeModalAsignEnc(){
        $(modal_asign_enc).modal("hide");
    }
</script>