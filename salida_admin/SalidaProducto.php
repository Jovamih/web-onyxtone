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
    <script>
          $(document).ready(function(){
            $("#nombre").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myQuery tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });
      
    </script>
</head>

<body>
    <header>
        <div class="contenedor">
            <input type="checkbox" id="menuprincipal">
            <label class="fas fa-bars" for="menuprincipal"></label>
            <nav class="menu">
                <a href="../inicio_admin/"><i class="fal fa-home-lg" ></i>INICIO</a>
                <a href="../registrar_admin/RegistrarIngreso.php">
                    <i class="fas fa-plus"></i>AGREGAR PRENDAS
                </a>
                <a href="SalidaProducto.php">
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

    <main class="justify-content-center formato-fuente-boostrap">
    <section class="salidaProductos">
            <div class="logo"> 
                <h3><a href="https://onyxstoneportal.herokuapp.com/" target="_blank">BOUTIQUE ONYX STONE</a></h3>
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
                <input name="Cantidad" type="number" placeholder="Cantidad de salida" min="1">
                <!--ENVIAR
                <div class="boton">  data-toggle="modal" data-target="#ConfirmacionIngreso"
                    <Input name="Registrar" type="submit" value="REGISTRAR SALIDA">
                </div>-->
                <button class="btn btn-primary btn-lg">
                    <i class="fad fa-file-minus"></i>QUITAR PRODUCTOS
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

            <div class="row justify-content-center align-items-center" id="input-nombre" style="display:block;">                 
                  <div class=" d-flex flex-column justify-content-center text-center" >
                        <div class="ui-widget">
                            <label for="nombre"></label>
                            <input  class="form-control row" name="nombre" id="nombre" value="" style="margin-left:40%; width:20%;">
                            <small id="helpId" class="text">Ingrese el nombre de la prenda a buscar</small>
                        </div>
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

                            <?php
                                $sql = "select * from Producto ORDER BY idSubcategoria";
                                $result = mysqli_query($conn, $sql);
                                $num_resultados = mysqli_num_rows($result);
                                    for ($i=0; $i <$num_resultados; $i++){
                                        $row = mysqli_fetch_array($result);
                            ?>
                            <tr>
                                <!--CODIGO-->
                                <td><?php  echo $row['idSubcategoria'];echo $row['idTalla'];echo $row['idColor']?></td>
                                <!--NOMBRE-->
                                <td><?php  
                                        $subcat = $row['idSubcategoria'];
                                        $consultaSC="SELECT nombre FROM Subcategoria where idSubcategoria=$subcat";
	                                    $resultadoSC=mysqli_query($conn,$consultaSC);
	                                    $arraySC=mysqli_fetch_array($resultadoSC);
	                                    $nombre = $arraySC[0];	
                                        echo $nombre;
                                    ?></td>
                                <!--TALLA-->
                                <td><?php  echo $row['idTalla']?></td>
                                <!--COLOR-->                                
                                <td><?php  
                                        $col = $row['idColor'];
                                        $consultaC="SELECT nombre FROM Color where idColor=$col";
	                                    $resultadoC=mysqli_query($conn,$consultaC);
	                                    $arrayC=mysqli_fetch_array($resultadoC);
	                                    $color = $arrayC[0];	
                                        echo $color;
                                    ?></td>
                                <!--UNIDADES-->
                                <td><?php  echo $row['unidadesDisp']?></td>
                            </tr>
                            <?php 
                                }
                            ?>
                            <?php echo "Total de productos registrados : ".$num_resultados  ?>
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