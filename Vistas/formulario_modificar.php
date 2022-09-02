
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
}



        form input:invalid {
            background-color: red;
        }




        form{
            font-weight: bold;
            color: var(--colortexttheme1);
            background-color: var(--color_backgroundtheme1);
            border-radius: 10px;
            margin-left: auto;margin-right: auto;
            padding: 10px;
            display: grid;
            max-width: 600px;
            box-shadow: 10px 5px 5px var(--boxshadowcolor);
            grid-gap: 10px;
            
        }
        .formuconten{

            display: grid;
            grid-template-columns: 1fr auto 0fr;
            width: 100%;
            justify-content: center;
            align-content: center;
            grid-gap: 5px;
        }
        form input:invalid{
            background-color: red;
        }
        button{border-style: none;border-radius: 5px;
            color: var(--colortext);
            background-color: var(--colorbuton);}
        button:hover{background-color: var(--colorbutonhober);}

       

      </style>
</head>
<body>
<?php  if(!$persona)$persona=new MPersona();?>

    <form action="" method="post">
        <h2>Modificar persona:</h2>
        <div class="formuconten">
        <label for="fname">Cedula:</label>
        <input type="text" id="fname" name="cedulamod" value="<?php  echo $persona->cedula??''?>" required><br><br>
        </div>
        <button>BUSCAR</button>
        <div class="formuconten">
        <label for="fname">Nombre:</label>
        <input type="text" id="fname" name="nombre" value="<?php  echo $persona->nombre??''?>" required><br><br>
        <label for="lname">Apellido</label>
        <input type="text" id="lname" name="apellido" value="<?php  echo $persona->apellido??''?>" required><br><br>
        <label for="lname">Direccion</label>
        <input type="text" id="lname" name="direccion" value="<?php  echo $persona->direccion??''?>" required><br><br>
        <label for="lname">Edad</label>
        <input type="number" id="lname" name="edad" value="<?php  echo $persona->edad??''?>" required><br><br>
        <label for="lname">Telefono</label>
        <input type="number" id="lname" name="telefono" value="<?php  echo $persona->telefono??''?>" required><br><br>
        <!-- <label for="lname">Cedula</label> -->
        <!-- <input type="number" id="lname" name="cedula" value="<?php /* echo $persona->cedula??''*/?>"><br><br> -->
        </div>
        <button type="submit"  >Modificar persona</button>
    </form>
</body>
</html>