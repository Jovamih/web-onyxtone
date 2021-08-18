<?php
    if(isset($_POST['user']) && isset($_POST['password'])){
      session_start();
        $user = $_POST['user'];
        $password = $_POST['password'];
        $query = "SELECT * FROM Usuario WHERE user = '$user' AND password = '$password'";
        //die($query);
        include_once("../database/conexion.php");
        $result = mysqli_query($conexion, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $_SESSION['user'] = $row['user'];
            //cerrar la conexion a la base de datos a la vez que se cierra el script
            mysqli_close($conexion);
            header("Location:../inicio_admin/");
        }else{
          echo '
          <script>
              alert("Es necesario que inicie sesión");
              window.location = "./";
          </script>
        ';
        die();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>BOUTIQUE D'KAR</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../resources/faviconv2.png"/>    
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/31127b7562.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!--Bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header>        
        <div class="contenedor">
            <input type="checkbox" id="menuprincipal">
            <label class="fas fa-bars" for="menuprincipal"></label>
            <nav class="menu">
                <a href="../inicio_admin/"><i class="fal fa-home-lg" ></i>INICIO</a></li>
                <a href="RegistrarIngreso.php">AGREGAR PRENDAS</a></li>
                <a href="../salida_admin/SalidaProducto.php">SALIDA DE PRENDAS</a></li>
                <a href="../consultar_admin/">
                <i class="fal fa-eye"></i> 
                VER PRENDAS</a></li>
                <a href="../cerrar_sesion/cerrar_sesion.php">CERRAR SESIÓN
                <i class="fal fa-sign-out"></i>
            </a>
                
            </li>
            </nav>
        </div>
    </header>

    <main>
        <section class="registroProductos">
            <div class="logo">
            <h3><a href="https://boutiquedkarportal.herokuapp.com/" target="_blank">BOUTIQUE D'KAR</a></h3>
                <p>Lo mejor de moda para <span>ellos!</span></p>
            </div>
            <div>
                <h1>Ingreso de Prendas</h1>
            </div>
            <!--AQUI COMIENZA EL FORM-->
            <form action="registrarDB.php" method="GET">
                <!--CATEGORIA INPUT-->
                <label for="categoria">Seleccione Categoría</label>
                <Select name="Categoria" id="Categoria" onchange="cargar_subcategorias()">
					<Option value = ""> Seleccione categoria ...		
				<p></Select>
                </p>
                <!--SUBCATEGORIA INPUT-->
                <label for="subcategoria">Seleccione Subcategoría</label>
                <Select name="Subcategoria" id="Subcategoria">
					<Option value = ""> Seleccione subcategoria ...		
				<p></Select></p>
                <script src="js/Opciones.js"></script>
                <!--TALLA INPUT-->
                <label for="talla">Seleccione Talla</label>
                <Select name="Talla">
					<Option value = "S"> Small
					<Option value = "M"> Medium
					<Option value = "L"> Large
					<Option value = "XL"> Extra Large
					<Option value = "XXL"> Extra Extra Large
				<p></Select></p>
                <!--COLOR INPUT-->
                <label for="color">Seleccione Color</label>
                <Select name="Color">
                    <Option value = "Mixto"> Mixto
                    <Option value = "Otros"> Otro
					<Option value = "Blanco"> Blanco
					<Option value = "Plomo"> Plomo
                    <Option value = "Negro"> Negro
					<Option value = "Azul"> Azul
					<Option value = "Celeste"> Celeste
					<Option value = "Rojo"> Rojo
					<Option value = "Naranja">Naranja
					<Option value = "Rosado"> Rosado
					<Option value = "Amarillo"> Amarillo
					<Option value = "Marron"> Marrón
					<Option value = "Verde"> Verde
					<Option value = "Morado"> Morado
				<p></Select></p>
                <!--CANTIDAD INPUT-->
                <label for="cantidad">Cantidad a ingresar</label>
                <input name="Cantidad" type="number" placeholder="Cantidad a ingresar">
                <br><br>
                <!--FOTOS INPUT-->
                <label for="fotos" >Agregue fotos de referencia</label>
                <input name="FotoA" type="file">                
                <input name="FotoB" type="file">                
                <input name="FotoC" type="file">
                <br><br>
                <!--ENVIAR
                <div class="boton">
                    <Input name="Registrar" type="submit" value="REGISTRAR INGRESO">
                </div>-->
            </form>

            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ConfirmacionIngreso">
                INGRESAR PRODUCTOS
            </button>

            <div class="modal fade" id="ConfirmacionIngreso" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id= "TituloModal" class="modal-title">Confirmación de Ingreso</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                              <div class="alert alert-success">
                                <h6>Datos registrados exitosamente </h6>
                              </div>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar  <i class="fas fa-save"></i></button>
                          </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="pie">
            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
            <a href="#"><i class="fas fa-map-marked-alt fa-2x"></i></a>
            <p>Copyright © 2021, Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>