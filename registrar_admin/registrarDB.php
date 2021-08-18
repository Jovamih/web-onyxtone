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
	$v3 = $_REQUEST['Talla']; 
	$v4 = $_REQUEST['Color']; 
	$v5 = $_REQUEST['Cantidad']; 
	$v6 = $_REQUEST['FotoA']; 
    $v7 = $_REQUEST['FotoB'];
    $v8 = $_REQUEST['FotoC'];
	
	//conuslta SQL
	$consulta="SELECT COUNT(*) as contar FROM Perro where Codigo='$v1'";

	$resultado=mysqli_query($conn,$consulta);

	$array=mysqli_fetch_array($resultado);

	//si registra campos vacios
	if($v1=="" or  $v2=="" or $v3=="" or $v4=="" or $v5==""){
		echo 	"<script>
	                alert('Error: Complete todos los campos!');
	                window.location= 'RegistrarPerro.php'
	   			 </script>";
	}else{
			//si perro ya existe(duplicidad Codigo)
		if($array['contar']!=0){ 
		echo 	"<script>
	                alert('Error: Ya se ha registrado un perro con este código');
	                window.location= 'RegistrarPerro.php'
	   			 </script>";
		}else{
			$sql = "INSERT INTO Perro VALUES ('$v1', '$v2', '$v3', '$v4', '$v5','$v6')";
			if (mysqli_query($conn, $sql)) {
				echo 	"<script>
		                alert('Registro exitoso!');
		                window.location= 'Principal.php'
		   			 	</script>";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	/****/
	mysqli_close($conn);	
?>
