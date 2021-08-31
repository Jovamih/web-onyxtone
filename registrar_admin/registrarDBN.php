<?php
	//conexion a la Base de datos
	$conn = mysqli_connect("boutiquedkar.cuxsffuy95k9.us-east-1.rds.amazonaws.com","admin", "admin12345678", "boutique");
	if (!$conn) {
        echo "Error de conexion: " . mysqli_connect_error();
        echo "NO TE PREOCUPES,INTENTA VOLVER A CARGAR LA PAGINA.EL SERVIDOR DE BASE DE DATOS PUEDE ESTAR OCUPADO";
        die();		
	}	
	
	//capturando datos
	$v1 = $_REQUEST['Codigo_Subcat'];	
	$v2 = $_REQUEST['Codigo_Talla']; //L
	$v3 = $_REQUEST['Codigo_Color'];
	$v4 = $_REQUEST['Unidades'];	
	$v5 = addslashes(file_get_contents($_FILES['FotoA']['tmp_name'])); //$_REQUEST['FotoA']; 
	$v6 = addslashes(file_get_contents($_FILES['FotoB']['tmp_name'])); //$_REQUEST['FotoB'];
	$v7 = $_REQUEST['pMenor'];
	$v8 = $_REQUEST['pMayor'];	

	//si registra campos vacios
	if($v5=="" or  $v6=="" or  $v7=="" or  $v8==""){
		echo 	"<script>
	                alert('Error: Es necesario completar todos los campos!');
	                window.location= 'RegistrarIngreso.php'
	   			 </script>";
	}else{
		//SI ESTA AQUÍ ES PORQUE ES PORQUE RECIEN SE REGISTRARÁ UN PRODUCTO DE ESTAS CARACTERISTICAS
		//consulta SQL INSERT INTO nombre_tabla (columna1, columna2, columna3,.)VALUES (valor1, valor2, valor3, .)
		$sql="INSERT INTO Producto (idSubcategoria, idTalla, idColor, precioUni, precioMay, unidadesDisp) VALUES ($v1,'$v2',$v3,$v7,$v8,$v4)";		
		if (mysqli_query($conn, $sql)) {	
			$consulta="SELECT idProducto FROM Producto where idSubcategoria='$v1' AND idTalla='$v2' AND idColor='$v3'";
			$resultado=mysqli_query($conn,$consulta);
			$array=mysqli_fetch_array($resultado);
			$codigo = $array[0];
			$sqlImg="INSERT INTO Imagen VALUES ($codigo,'$v5','a')";		
			$sqlImg2="INSERT INTO Imagen VALUES ($codigo,'$v6','b')";
			if (mysqli_query($conn, $sqlImg) and mysqli_query($conn, $sqlImg2)) {	
				echo 	"<script>
				alert('Registro exitoso!');
				window.location= 'RegistrarIngreso.php'
				   </script>";
			}else{
				echo "Error: " . $sqlImg . "<br>" . mysqli_error($conn);								
			}			
		} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}		
	}
	mysqli_close($conn);
?>
