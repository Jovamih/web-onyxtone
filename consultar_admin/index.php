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
<!doctype html>
<html lang="es">
  <head>
    <title>Consultar catalogo disponible</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/31127b7562.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/png" href="../resources/faviconv2.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Optional JavaScript -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

       
        <div class="contenedor fixed-top">
            <input type="checkbox" id="menuprincipal">
            <label class="fas fa-bars" for="menuprincipal"></label>
            <nav class="menu">
                <a href="../inicio_admin/">
                <i class="fal fa-home-lg" ></i>INICIO
                </a></li>
                <a href="../registrar_admin/RegistrarIngreso.php">
                <i class="fas fa-plus"></i>INGRESO DE PRENDAS
              </a></li>
                <a href="../salida_admin/SalidaProducto.php"><i class="fas fa-minus"></i>SALIDA DE PRENDAS</a></li>
                <a href="../consultar_admin/"><i class="fal fa-eye"></i>
                  
                 VER PRENDAS</a></li>
                
                <a href="../cerrar_sesion/cerrar_sesion.php">CERRAR SESIÓN
                <i class="fal fa-sign-out"></i>
              </a></li>
            </nav>
        </div>
        <div class="logo" style="margin-top:4%;">
            <h3>BOUTIQUE ONYX STONE</h3>
            <p>Lo mejor de moda para <span>ellos!</span></p>
        </div>
       
    </header>
		
  <main class="justify-content-center formato-fuente-boostrap">
  <h2 style="text-align: center;color:white;"><i class="fas fa-book-reader" style="color:white;"></i>Consultar catalogo de productos</h2>
    <!-- FORMULARIO DE CONSULTA-->
    <div class="container justify-content-center">
            <form action="./" method="POST">

                <div class="row justify-content-center align-items-center">
                        <label for="" class="form-label" style="margin-right:1%;color:white;">Filtrar por </label>
                        <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="check_name" name="checkname" class="custom-control-input" onchange="javascript:showInputName();" checked>
                              <label class="custom-control-label" for="check_name"  style="color:white;">Nombre producto</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="check_category" name="checkcategory" class="custom-control-input" onchange="javascript:showInputCategory();">
                              <label class="custom-control-label" for="check_category"  style="color:white;">Categoria</label>
                        </div>
                </div>   
                <div class="row justify-content-center align-items-center" id="input-nombre" style="display:block;">
                 
                  <div class=" d-flex flex-column justify-content-center text-center" >
                        <div class="ui-widget">
                            <label for="nombre"></label>
                            <input  class="form-control row" name="nombre" id="nombre" value="" style="margin-left:40%; width:20%;">
                            <small id="helpId" class="text"  style="color:white;">Ingrese el nombre de la prenda a buscar</small>
                        </div>
                  </div>
                
                </div>  
                
              
                <div class="row justify-content-center align-items-center" id="categoria-div" style="display:none;">
                    <div class="col"  style="margin-left:40%; width:20%; margin-bottom:1%;">
                        <label for="categoria-selector"  style="color:white;">Seleccionar categoria: </label>
                        <select class="custom-select row" name="categoria" id="categoria" >
                        
                          <option value="chompa" selected>Chompa</option>
                          <option value="conjunto">Conjunto</option>
                          <option value="pantalon">Pantalones</option>
                          <option value="polo">Polos</option>
                          <option value="otros">Otros</option>
                        </select>
                    </div>    
                
                </div>
             
                <div class="row justify-content-center align-items-center" style="margin-top:1%;">
                   <div class="col-sm-2">
                       <button type="submit" class="btn btn-primary"><i class="fal fa-search"></i>Buscar</button>
                       
                   </div>
                   <div class="col-sm-2">
                     <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i>Limpiar</button>
                
                   </div>
                    
                </div>
        </form>
    </div>
    <!--TABLA DE CONTENIDOS-->

    <div class="container-fluid" style="margin-top:1%;">
    <div class="table-responsive-md" >
    <table class="table  my-table">
   <thead class="table-primary">
    <tr>
      <th scope="col">Codigo Producto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Categoria</th>
      <th scope="col">Talla</th>
      <th scope="col">Color</th>
      <th scope="col">Precio Unitario</th>
      <th scope="col">Precio Mayor</th>
      <th scope="col">Unidades</th>
      <th scope="col">Imagen</th>
      <th scope="col">View</th>

    </tr>
  </thead>
  <tbody id="myQuery">
        <?php
            include_once("../database/conexion.php");
            if(isset($_POST["nombre"])){
            
                  $nombre_producto = $_POST['nombre'];
                  $categoria_producto=$_POST['categoria'];
                  //conuslta SQL
                  $sql = "SELECT P.idProducto as ID,
                  ST.nombre as nombre, 
                      CL.nombre as color,
                      T.nombre as talla,
                      CT.nombre as categoria,
                      P.precioUni as precioUnit,
                      P.precioMay as precioMayor,
                      P.unidadesDisp as unidades,
                      I.imagen as imagen
                                FROM Producto as P 
                                LEFT JOIN Subcategoria as ST ON P.idSubcategoria=ST.idSubcategoria
                                LEFT JOIN Categoria as CT ON ST.idCategoria=CT.idCategoria
                                LEFT JOIN Talla as T ON P.idTalla=T.idTalla 
                                LEFT JOIN Color as CL ON P.idColor=CL.idColor
                                LEFT JOIN Imagen as I ON I.idProducto=P.idProducto AND I.tipoVista='a'
                                WHERE CT.nombre LIKE '%$categoria_producto%';";
                                  
                                  //ST.nombre LIKE  '%$nombre_producto%' OR
            //die($sql);
            }else{//Si no se ha hecho una consulta, se filtran todas las columnas por defectos
              $sql = "SELECT  P.idProducto as ID,
              ST.nombre as nombre, 
                  CL.nombre as color,
                  T.nombre as talla,
                  CT.nombre as categoria,
                  P.precioUni as precioUnit,
                  P.precioMay as precioMayor,
                  P.unidadesDisp as unidades,
                  I.imagen as imagen
                            FROM Producto as P 
                            LEFT JOIN Subcategoria as ST ON P.idSubcategoria=ST.idSubcategoria
                            LEFT JOIN Categoria as CT ON ST.idCategoria=CT.idCategoria
                            LEFT JOIN Talla as T ON P.idTalla=T.idTalla 
                            LEFT JOIN Color as CL ON P.idColor=CL.idColor
                            LEFT JOIN Imagen as I ON I.idProducto=P.idProducto AND I.tipoVista='a' LIMIT 25;";

            }
            $result = mysqli_query($conexion, $sql);
            //cuantos reultados hay en la busqueda
            $num_resultados = mysqli_num_rows($result);
            echo "<p  style='color:white;'>Número de prendas encontradas: ".$num_resultados."</p>";
            //mostrando informacion de los perros y detalle
            for ($i=0; $i <$num_resultados; $i++) {
            $row = mysqli_fetch_array($result); 
        ?>
            <tr>  
            <td><b><?php echo $row['ID']; ?></b></td>
            <td><b><?php echo $row['nombre']; ?></b></td>
            <td><b><?php echo $row['categoria']; ?></b></td>
              
            <td> <b><?php echo $row['talla']; ?></b></td>
            <td><b><?php echo $row['color']; ?></b></td>
            <td><b><?php echo 'S./'.round($row['precioUnit'],2); ?></b></td>
            <td><b><?php echo 'S./'.round($row['precioMayor'],2); ?></b></td>
            <td><b><?php echo $row['unidades']; ?></b></td>
            <td>
            <?php  echo '<img class="rounded" src=data:image/jpeg;base64,'.str_replace("'", '',base64_encode( $row['imagen'] )).' style="height:100px;width:100px";/>'; ?>
                      
            </td>
            <td>
              <div class="container">
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target=<?php echo "#myModal".$row['ID']; ?> style="color:black;">
                   Ver <i class="fas fa-eye" style="text-align:center;margin-left:5px;color:black;"></i>
                  </button>
                  <div class="modal fade" id=<?php echo "myModal".$row['ID']; ?>>
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h2 class="modal-title"><?php echo $row['nombre'];?></h2><br>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="container justify-content-center text-center">
                            <?php 
                            
                            echo '<img class="rounded" src=data:image/jpeg;base64,'.str_replace("'", '',base64_encode( $row['imagen'] )).' style="height:200px;width:200px";/>'; ?>
                                  
                            </div>
                            <h3>Unidades disponibles</h3>
                            <h5>Unidades <span class="badge badge-warning"><?php echo $row['unidades'].' unidades';?></span></h5>
                            <h3>Color</h3>
                            <h5>Actual <span class="badge badge-primary"><?php echo $row['color']; ?></span></h5>
                            <h3>Categoria</h3>
                            <h5>Actual <span class="badge badge-success"><?php echo $row['categoria']; ?></span></h5>
                          
                            <h3><span class="badge badge-dark">Precio por unidad S/<?php echo '  '.round($row['precioUnit'],2);?></span></h3>
                            <h3><span class="badge badge-dark">Precio por Mayor S/<?php echo '  '.round($row['precioMayor'],2);?></span></h3>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                           
                          </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </td>
            </tr>
         <?php 
          } //Cierra el for
          mysqli_close($conexion);//Cierra la conexion
        

         ?> 
                  
    </tbody>
    </table>
   </div>
    </div>
    
      </main>
    <footer>
		<div class="pie fixed-bottom">
			<a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
			<a href="#"><i class="fab fa-instagram fa-2x"></i></a>
			<a href="#"><i class="fas fa-map-marked-alt fa-2x"></i></a>
			<p>Copyright © 2021, Todos los derechos reservados.</p>
		</div>
		
	</footer>


    <!-- Optional JavaScript -->
    <script src="./script.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>