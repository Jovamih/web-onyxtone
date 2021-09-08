<?php
    session_start();
    //include_once("../database/conexion.php");
    if(!isset($_SESSION['user'])){
      //die("Error de conexion. Talvez se deba a su conexion a internet o al acceder a un sitio con privilegios insuficientes");
      header("Location:../login_admin/");
    }else{
      //en caso de que si este definida obtenemos algun valor
    }
?>

<?php
    //conexion a la Base de datos (Servidor,usuario,password)
    $conn = mysqli_connect("boutiquedkar.cuxsffuy95k9.us-east-1.rds.amazonaws.com","admin", "admin12345678", "boutique");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>BOUTIQUE ONYX STONE</title>
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
                <a href="../inicio_admin/"><i class="fal fa-home-lg" ></i>INICIO</a>
                <a href="RegistrarIngreso.php">                
                    <i class="fas fa-plus"></i>AGREGAR PRENDAS 
                </a>
                <a href="../salida_admin/SalidaProducto.php">
                    <i class="fas fa-minus"></i>SALIDA DE PRENDAS
                </a>
                <a href="../consultar_admin/">
                    <i class="fal fa-eye"></i> VER PRENDAS
                </a>                
                <a href="../cerrar_sesion/cerrar_sesion.php">CERRAR SESIÓN
                    <i class="fal fa-sign-out"></i>
                </a>
            </nav>
        </div>
    </header>

    <main>
        <section class="registroProductos">
            <div class="logo">
                <h3><a href="https://onyxstoneportal.herokuapp.com/" target="_blank">BOUTIQUE ONYX STONE</a></h3>
                <p>Lo mejor de moda para <span>ellos!</span></p>
            </div>
            <div><h1>Ingreso de Prendas</h1></div>
            <!--AQUI COMIENZA EL FORM-->
            <form action="registrarDB.php" method="POST">
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
                <!--VALIDAR BUTTON-->
                <button type="button" class="btn btn-success" onclick="Desbloquear()" >
                    <i class="fas fa-check-circle"></i>Validar
                </button>
                <script src="js/Desbloqueo.js"></script>
                <!--AYUDA BUTTON-->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#AyudaValidar">
                    <i class="fas fa-info-circle"></i>Ayuda
                </button><br><br>
                <!--CANTIDAD INPUT-->
                <label for="cantidad">Cantidad a ingresar</label>
                <input id="Cantidad" name="Cantidad" type="number" placeholder="Cantidad a ingresar" disabled="disabled" min="1">
                <br><br>     
                <!--INGRESAR BUTTON-->
                <button class="btn btn-primary btn-lg">
                    <i class="fad fa-file-plus"></i>INGRESAR PRODUCTOS
                </button>
            </form>

            <!--  MODALES    -->
            <div class="modal fade" id="AyudaValidar" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h4 id= "TituloModal" class="modal-title">¿Por qué no puedo ingresar una cantidad?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Para poder registrar el número de prendas a ingresar, es necesario:</p>
                            <p><b>1° </b>Llenar los cuatro primeros campos (Categoría, Subcategoría, Talla, Color)</p>
                            <p><b>2° </b>Dar clic en el botón validar</p>
                            <p>Solo así, podrá registrar una cantidad, cabe recordar, que si se intenta agregar un producto que no haya sido 
                                registrado previamente, se le pedirá que ingrese dos imágenes, la primera del lado delantero del producto y la
                                segunda del lado trasero.
                            </p>                            
                            <p>  Muchas gracias por su atención.</p>                                                            
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i>Cerrar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-check-square"></i>Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>

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