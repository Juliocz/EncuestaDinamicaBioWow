<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/root.css">
    <style type="text/css">
        body {
            font-family: 'Trebuchet MS', sans-serif;
            margin: 0;


            /*background-image: url("https://cdn.pixabay.com/photo/2016/10/22/01/54/wood-1759566_960_720.jpg");
           */
            background-color: #333355;
        }

        form {

            font-weight: bold;
            color: var(--colortexttheme1);
            background-color: var(--color_backgroundtheme1);
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 750px;
            grid-gap: 10px;
            box-shadow: 10px 5px 5px var(--boxshadowcolor);
        }

        form input:invalid {
            background-color: red;
        }

        button {
            border-style: none;
            border-radius: 5px;
            color: var(--colortext);
            background-color: var(--colorbuton);
            width: 100%;
        }

        button:hover {
            background-color: var(--colorbutonhober);

        }

        tr {
            color: var(--colortext);
            background-color: var(--colorbuton);
            transition: all ease-out 1s;
            border-radius: 5px;
        }

        tr:hover {
            background-color: var(--tableitemover);
            transform: scale(1.05);
            transition: all ease-out 0.2s;
            box-shadow: 10px 5px 5px var(--boxshadowcolor);
        }

        @media (max-width: 600px) {
            form {
                grid-template-columns: 1fr;
            }
        }

        .icon {
            padding: 5px;

        }

        .icon :hover {
            /*fill: #148F77;*/
            /*transform: scale(1.5);*/
            background-color: #148F77;
            border-radius: 5px;
            cursor: pointer;
            transition: all ease-out 0.2s;
        }
    </style>
</head>

<body>
    <div id="modal" style="background-color: #00000080; position: absolute; width: 100%;height: 100%;
     display: none;flex-wrap: wrap;justify-content: center;align-items: center;
     ">

        <div onclick="this.parentElement.style.display = 'none';" style="width: 100%;height: 100%;position: absolute;z-index: 1;"></div>
        <div style="width: 500px;height: auto;z-index:2;">

            <svg class="icon" onclick="this.parentElement.parentElement.style.display = 'none';" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
            </svg>
            <!-- contenido  -->
            <iframe id="modificar2" src="modificar" style="border-style: none;   width:100%;height:100%;min-height:500px;"></iframe>
        </div>
    </div>

    <div id="modalEliminar" style="background-color: #00000080; position: absolute; width: 100%;height: 100%;
     display: none;flex-wrap: wrap;justify-content: center;align-items: center;
     ">

        <div onclick="this.parentElement.style.display = 'none';" style="width: 100%;height: 100%;position: absolute;z-index: 1;"></div>
        <div style="width: 500px;background-color: #ffffff00;height: auto;z-index:2;">

            <svg class="icon" onclick="this.parentElement.parentElement.style.display = 'none';" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
            </svg>
            <!-- contenido  -->

            <iframe id="eliminar" src="eliminar" style="border-style: none;   width:100%;height:100%;min-height:500px;"></iframe>
        </div>
    </div>

    <form action="" method="post">
        <div>
            <h1>OPCIONES</h1>
            <a>
                <button type="button" onclick="recargarRegistrar()">Registrar Persona</button>
            </a>
            <a href="modificar">
                <button type="button">Modificar Persona</button>
            </a>

            <div class="form-group">
                <label for="">Buscar: </label><input type="text" class="form-control pull-right" style="width:100%" id="search" placeholder="Buscar en tabla.">
            </div>
            <table id="mitablapersona" style="margin-left: auto;margin-right:auto;">
                <thead>
                    <tr style="background-color: var(--tableheader)">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Telefono</th>
                        <th>Cedula</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personas as $persona) {
                        echo "<tr onclick='recargarModificar(this)'>
              <td>$persona->nombre</td>
              <td>$persona->apellido</td>
              <td>$persona->edad</td>
              <td>$persona->telefono</td>
              <td>$persona->cedula</td>
              <td style='display:grid; grid-template-columns: 1fr 1fr;'>
              <div class='icon' onclick='recargarModificarModal(this.parentElement.parentElement)'>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'>
                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                </svg>
               </div>
               <div class='icon' onclick=\"recargarEliminarModal(this.parentElement.parentElement)\">
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='red' viewBox='0 0 16 16'>
                <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
                </svg>
               </div>
                </td>
            </tr>";
                    }
                    ?>

                </tbody>
            </table>


        </div>
        <iframe id="modificar" src="modificar" style="border-style: none;  width:100%;height:100%;min-height:500px;"></iframe>
    </form>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        //funcion redirige a modificar
        function irmodificar(tr) {
            // document.getElementsByTagName
            var cedula = tr.getElementsByTagName("td")[4].innerHTML;
            // alert(cedula);
            //  alert(window.location.href);
            location.href = 'modificar?cedula=' + cedula;
        }

        function recargarModificar(tr) {
            var cedula = tr.getElementsByTagName("td")[4].innerHTML;
            document.getElementById('modificar').setAttribute("src", 'modificar?cedula=' + cedula);
        }

        function recargarModificarModal(tr) {
            var cedula = tr.getElementsByTagName("td")[4].innerHTML;
            document.getElementById('modificar2').setAttribute("src", 'modificar?cedula=' + cedula);
            //muestro modal
            document.getElementById('modal').style.display = 'flex';
        }

        function recargarEliminarModal(tr) {
            var cedula = tr.getElementsByTagName("td")[4].innerHTML;
            document.getElementById('eliminar').setAttribute("src", 'eliminar?cedula=' + cedula); //iframe
            //muestro modal
            document.getElementById('modalEliminar').style.display = 'flex'; //muestro modal
        }

        function recargarRegistrar() {
            document.getElementById('modificar').setAttribute("src", 'registrar');
        }



        $(document).ready(function() {
            $("#search").keyup(function() {
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#mitablapersona tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
    </script>
</body>

</html>