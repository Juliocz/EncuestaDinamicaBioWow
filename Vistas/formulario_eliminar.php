
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
        .form label{font-weight: bolder;}
        .formuconten{

            display: grid;
            grid-template-columns: 1fr auto;
            width: 100%;
            justify-content: center;
            align-content: center;
            grid-gap: 5px;
        }
        form input:invalid{
            background-color: red;
        }
        button{font-weight: bolder; border-style: none;border-radius: 5px;background-color: var(--colorbuton);color: var(--colortext);width: 100%;}
        button:hover{background-color: var(--colorbutonhober);}

       

      </style>
</head>
<body>
<?php  if(!$persona)$persona=new MPersona();?>

    <form action="" method="post">
        <h2>Eliminar:</h2>
        <div class="formuconten">
        <label for="fname">Cedula:</label>
        <input type="text" id="fname" name="cedulamod" value="<?php  echo $persona->cedula??''?>" required>
        </div>
        <div class="formuconten">
        <label for="fname">Nombre: </label>
        <label for="fname"><?php  echo $persona->nombre??''?></label>
        <label for="lname">Apellido: </label>
        <label for="fname"><?php  echo $persona->apellido??''?></label>
        <label for="lname">Direccion: </label>
        <label for="fname"><?php  echo $persona->direccion??''?></label>
        <label for="lname">Edad: </label>
        <label for="fname"><?php  echo $persona->edad??''?></label>
        <label for="lname">Telefono: </label>
        <label for="fname"><?php  echo $persona->telefono??''?></label>
        </div>
        <button type="submit"  >Eliminar persona?</button>
    </form>
</body>
</html>