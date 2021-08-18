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
                <a href="../registrar_admin/RegistrarIngreso.php">AGREGAR PRENDAS</a></li>
                <a href="SalidaProducto.php">SALIDA DE PRENDAS</a></li>
                <a href="../consultar_admin/">
                <i class="fal fa-eye"></i> 
                
                VER PRENDAS</a></li>                
                <a href="../cerrar_sesion/cerrar_sesion.php">CERRAR SESIÓN
                <i class="fal fa-sign-out"></i>
            </a></li>
            </nav>
        </div>
    </header>

    <main class="justify-content-center formato-fuente-boostrap">
    <section class="salidaProductos">
            <div class="logo"> 
                <h3><a href="https://boutiquedkarportal.herokuapp.com/" target="_blank">BOUTIQUE D'KAR</a></h3>
                <p>Lo mejor de moda para <span>ellos!</span></p>
            </div>
            <div>
                <h1>Salida de Prendas</h1>
            </div>
            <!--AQUI COMIENZA EL FORM-->
            <form action="quitarDB.php" method="GET">
                <!--CÓDIGO INPUT-->
                <label for="cantidad">Código de producto</label>
                <input name="Codigo" type="text" placeholder="Código de producto">
                <!--CANTIDAD INPUT-->
                <label for="cantidad">Cantidad a retirar</label>
                <input name="Cantidad" type="number" placeholder="Cantidad de salida">
                <!--ENVIAR
                <div class="boton">
                    <Input name="Registrar" type="submit" value="REGISTRAR SALIDA">
                </div>-->
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ConfirmacionIngreso">
                    QUITAR PRODUCTOS
                </button>
            </form>

            <div class="modal fade" id="ConfirmacionIngreso" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id= "TituloModal" class="modal-title">Confirmación de Salida</h4>
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                Aceptar  <i class="fas fa-save"></i>
                            </button>
                          </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 style="text-align: center;">Buscar código</h2>
            </div>

            <div class=" d-flex flex-column justify-content-center text-center" >
                <div class="ui-widget">
                            <label for="nombre"></label>
                            <input  class="form-control row" name="nombre" id="nombre" value="" style="margin-left:40%; width:20%;">
                            <small id="helpId" class="text-muted">Ingrese el nombre de la prenda</small>
                </div>
            </div>
            

            <!--TABLA DE CONTENIDOS-->
            <section class="buscando">
                <div class="container-fluid" style="margin-top:1%;">
                    <div class="table-responsive-md">
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Codigo Producto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Talla</th>                            
                                <th scope="col">Color</th>                            
                                <th scope="col">Unidades disp.</th>
                            </tr>
                        </thead>
                        <tbody id="myQuery">
                            <tr>
                                <td scope="col">103XXL150</td>
                                <td scope="col">Polo cuello camisero ML</td>
                                <td scope="col">Extra Extra Large</td>                            
                                <td scope="col">Amarillo</td>                            
                                <td scope="col">200 unidades</td>
                            </tr>
                            <tr>
                                <td scope="col">201M130</td>
                                <td scope="col">Polera con capucha</td>
                                <td scope="col">Medium</td>                            
                                <td scope="col">Azul</td>                            
                                <td scope="col">120 unidades</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </section>
            

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