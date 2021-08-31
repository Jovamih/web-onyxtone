<?php
	//conexion a la Base de datos
	$conn = mysqli_connect("boutiquedkar.cuxsffuy95k9.us-east-1.rds.amazonaws.com","admin", "admin12345678", "boutique");
	if (!$conn) {
        echo "Error de conexion: " . mysqli_connect_error();
        echo "NO TE PREOCUPES,INTENTA VOLVER A CARGAR LA PAGINA.EL SERVIDOR DE BASE DE DATOS PUEDE ESTAR OCUPADO";
        die();		
	}	
	
	//capturando datos
	$v1 = $_REQUEST['Categoria'];
	$v2 = $_REQUEST['Subcategoria']; 
	$v3 = $_REQUEST['Talla']; /*Aqui ya te dan el codigo*/
	$v4 = $_REQUEST['Color'];
	$v5 = $_REQUEST['Cantidad'];
	
	//Obtenemos el codigo de subcategoria
	$consultaSC="SELECT idSubcategoria FROM Subcategoria where nombre='$v2'";
	$resultadoSC=mysqli_query($conn,$consultaSC);
	$array=mysqli_fetch_array($resultadoSC);
	$codSubcat = $array[0];	

	//Obtenemos el codigo del color
	$consultaC="SELECT idColor FROM Color where nombre='$v4'";
	$resultadoC=mysqli_query($conn,$consultaC);
	$array=mysqli_fetch_array($resultadoC);
	$codColor = $array[0];

	//consulta SQL
	$consulta="SELECT COUNT(*) as contar FROM Producto where idSubcategoria='$codSubcat' AND idTalla='$v3' AND idColor='$codColor'";
	$resultado=mysqli_query($conn,$consulta);
	$array=mysqli_fetch_array($resultado);

	//si registra campos vacios
	if($v1=="" or  $v2=="" or $v5==""){
		echo 	"<script>
	                alert('Error: Es necesario completar todos los campos!');
	                window.location= 'RegistrarIngreso.php'
	   			 </script>";
	}else{
		if($array['contar']==0){	//Si no hay un producto con esas caracteristicas					   
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
						<div>
							<h1>Ingreso de Prendas</h1>
						</div>
						<!--AQUI COMIENZA EL FORM-->
						<form action="registrarDBN.php" method="POST" enctype="multipart/form-data">							
							<!--REPASO DE INPUTS-->
							<p>Estás a punto de registrar por primera vez un producto de estas características:</p>
							<div id="linea-tipo"><p>Categoría: </p><span class="badge badge-light"><?php echo $v1;?></span> <br></div>
							<div id="linea-tipo"><p>Subcategoría: </p><span class="badge badge-light"><?php echo $v2;?></span> <br></div>
							<div id="linea-tipo"><p>Talla: </p><span class="badge badge-light"><?php echo $v3;?></span> <br></div>
							<div id="linea-tipo"><p>Color: </p><span class="badge badge-light"><?php echo $v4;?></span> <br></div>
							<div id="linea-tipo"><p>Cantidad: </p><span class="badge badge-light"><?php echo $v5;?></span> <br></div><br>
							<!--AYUDA BUTTON-->
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#AyudaImg">
								<i class="fas fa-info-circle"></i>Ayuda
							</button><br><br>
							<!--PRECIO MENOR INPUT-->
							<label for="pMenor">Precio unitario (S/.)</label>
                			<input id="pMenor" name="pMenor" type="number" step=any placeholder="Ingrese el precio unitario" min="1">
							<!--PRECIO MAYOR INPUT-->
							<label for="pMayor">Precio por mayor (S/.)</label>
                			<input id="pMayor" name="pMayor" type="number" step=any placeholder="Ingrese el precio por mayor" min="1">
							<!--FOTOS INPUT-->
							<br><p>Agregue 2 fotos de referencia</p>
							<input name="Codigo_Subcat" type="hidden" value="<?php echo $codSubcat;?>">
							<input name="Codigo_Talla" type="hidden" value="<?php echo $v3;?>">
							<input name="Codigo_Color" type="hidden" value="<?php echo $codColor;?>">
							<input name="Unidades" type="hidden" value="<?php echo $v5;?>">

							<input name="FotoA" id="FotoA" type="file">  
							<img id="img_a" style="height: 200px; width: 200px;">					
							<input name="FotoB" id="FotoB" type="file">
							<img id="img_b" style="height: 200px; width: 200px;">
							<br><br>    
							<script src="js/GuardarImagen.js"></script> 
							<!--BOTON TERMINAR-->           
							<button class="btn btn-primary btn-lg">
								<i class="fad fa-file-plus"></i>TERMINAR INGRESO
							</button>				   								   
						</form>    

						<!--  MODALES    -->				   
						<div class="modal fade" id="AyudaImg" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id= "TituloModal" class="modal-title">¿Por qué debo ingresar imágenes?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<!-- Modal body -->
										<div class="modal-body">
											<p>Al ser esta la primera vez que se intenta ingresar un producto de estas características
												es necesario ingresar dos (2) fotos para futuras referencias o mostrarlas en el catálogo
											</p>
											<p><b>1° </b>Se recomienda que la primera foto sea de la parte frontal de la prenda</p>
											<p><b>2° </b>Y la segunda de la parte trasera de la misma.</p>
											<p>También debe ingresar los precios al por menor y mayor. Solo así, podrá registrar registrar el ingreso de estas prendas.</p>                            
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
<?php								
		}else{
			//Si ya hay productos así, pues solo se agrega la cantidad
			//OBTENIENDO CANTIDAD ACTUAL
			$consultaAct = "SELECT unidadesDisp FROM Producto where idSubcategoria='$codSubcat' AND idTalla='$v3' AND idColor='$codColor'";
			$resultado2=mysqli_query($conn,$consultaAct);
			$array=mysqli_fetch_array($resultado2);
			$actual = $array[0];
			//SUMANDO
			$suma = $actual + $v5;
			$sql = "UPDATE Producto SET unidadesDisp = $suma where idSubcategoria='$codSubcat' AND idTalla='$v3' AND idColor='$codColor'";		
			
			if (mysqli_query($conn, $sql)) {	
				echo 	"<script>
					alert('Registro exitoso!');
					window.location= 'RegistrarIngreso.php'
					   </script>";
			} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}		
		}	
	}
	mysqli_close($conn);	
?>
