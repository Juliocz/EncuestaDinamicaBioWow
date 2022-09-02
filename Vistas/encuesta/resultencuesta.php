<?php V::$viewData->v_box_content = function () { ?>


    <style>
        .elm_graph {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    </style>
    <script src='https://cdn.plot.ly/plotly-2.14.0.min.js'></script>

    <div>

        <h2 style="text-align: center;">SUCURSAL : <?php echo V::$data->sucursal->nombre; ?> CODIGO: <?php echo V::$data->sucursal->codigo; ?></h2>
        <h2 style="text-align: center;" id="nombre_enc"></h2>
        <div>
            <div style="display:grid;grid-template-columns: 1fr 1fr 1fr;">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Fecha inicio:</span>
                    <input type="date" class="form-control" id="fecha_inicio" name="trip-start" value="2018-07-22" min="2001-01-01" max="2100-12-31">
                </div>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Fecha Fin:</span>
                    <input type="date" class="form-control" id="fecha_fin" name="trip-start" value="2023-07-22" min="2001-01-01" max="2100-12-31">
                </div>
                <div></div>
            


            <script>
                var ruta_excel_encuesta = "<?php echo V::$ruta_base . 'selectnegocio/encuesta/result_excel'; ?>";
                var idencuesta = "<?php echo V::$data->idencuesta; ?>";

                function downloadExcel(isallencuestasasign=false) {
                    var fecha_inicio = document.querySelector('#fecha_inicio').value;
                    var fecha_fin = document.querySelector('#fecha_fin').value;
                    if(!isallencuestasasign)
                    window.open(`${ruta_excel_encuesta}?idencuesta=${idencuesta}&fecha_inicio=${fecha_inicio}&fecha_fin=${fecha_fin}`, '_blank');
                    else
                    window.open(`${ruta_excel_encuesta}?idencuesta=${idencuesta}&fecha_inicio=${fecha_inicio}&fecha_fin=${fecha_fin}&isallnegociosresult=1`, '_blank');
                }
            </script>
            <button type="button" class="btn btn-warning" onclick="loadGraphicEncuesta()">FILTRAR RESULTADOS POR FECHA</button>
            <!-- <a href="http://localhost/encuestapuro/selectnegocio/encuesta/result_excel?idencuesta=1&fecha_inicio=01-01-2000&fecha_fin=01-01-5000"> -->
            <button type="button" class="btn btn-success" style="display:flex;flex-wrap: wrap; justify-content: center;grid-gap: 5px; align-items: center;" onclick="downloadExcel()">DESCARGAR EXCEL
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                </svg>
            </button>
            <button type="button" class="btn btn-success" style="display:flex;flex-wrap: wrap; justify-content: center;grid-gap: 5px; align-items: center;" onclick="downloadExcel(true)">DESCARGAR EXCEL TODOS LOS NEGOCIOS
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                </svg>
            </button>
            </div>
            <!-- </a> -->
        </div>
        <h4>Preguntas resultados:</h4>
    </div>
    <div id='myDiv' style="display:grid; grid-template-columns: auto auto; justify-content: center; grid-gap: 10px; padding:5px;">
        <!-- Plotly chart will be drawn inside this DIV -->
    </div>





    <script>
        function loadGraphicEncuesta(fecha_inicio = document.querySelector('#fecha_inicio').value, fecha_fin = document.querySelector('#fecha_fin').value) {
            var setting = {
                "url": "<?php echo V::$ruta_base . 'selectnegocio/encuesta/result?idencuesta=' . V::$data->idencuesta; ?>" + "&fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin,
                crossDomain: true,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json"
                },
                "data": "",
            };

            $.ajax(setting).done(function(response) {

                document.querySelector('#nombre_enc').innerHTML = response.nombre_enc;
                var contenedor = document.querySelector('#myDiv');
                contenedor.innerHTML = "";


                for (var p of response.preguntas) {
                    var r_pcont = document.createElement('div');
                    var h = document.createElement('h2');
                    h.innerHTML = p.pregunta;
                    var labelresult = document.createElement('label');
                    r_pcont.appendChild(labelresult);
                    r_pcont.appendChild(h);
                    r_pcont.classList.add("elm_graph");

                    var ar_values = [];
                    var ar_names = [];

                    var total_votos = 0;
                    for (var opt of p.opciones) {
                        ar_values.push(opt.respuestas.length);
                        ar_names.push(opt.descripcion);
                        total_votos += opt.respuestas.length;
                    }

                    labelresult.innerHTML = "Total votos: " + total_votos;


                    var data = [{

                        y: ar_values,
                        x: ar_names,
                        type: 'bar',
                        /*labels: ar_names,
                        values: ar_values,
                        type: 'pie',*/
                        marker: {
                            color: ['#F51014', '#F54B10', '#F5D010', '#76F510', '#10F524', '#10F5A7']
                        },

                    }];

                    var layout = {
                        height: 400,
                        width: 500
                    };

                    Plotly.newPlot(r_pcont, data, layout);

                    contenedor.appendChild(r_pcont);

                }
                console.log(response);
            }).fail(function(jqXHR, textStatus) {
                alert("Ocurrio un error al cargar resultados encuesta");
            });
        }

        loadGraphicEncuesta("01-01-2000", "01-01-5000");
    </script>

<?php } ?>

<?php
include_once 'Vistas/simplecenter.php'; //VISTA DE LA QUE HEREDA y muestra esta vista, la funcion se ejecuta
?>