<?php
	//conexion a la Base de datos
	$conn = mysqli_connect("boutiquedkar.cuxsffuy95k9.us-east-1.rds.amazonaws.com","admin", "admin12345678", "boutique");
	if (!$conn) {
        echo "Error de conexion: " . mysqli_connect_error();
        echo "NO TE PREOCUPES,INTENTA VOLVER A CARGAR LA PAGINA.EL SERVIDOR DE BASE DE DATOS PUEDE ESTAR OCUPADO";
        die();		
	}
	
	//capturando datos
	$v1 = $_REQUEST['Codigo'];
	$v2 = $_REQUEST['Cantidad'];
	
    $c_sub = substr($v1, 0, 3); //Las 3 primeras letras del código
    $c_tal = substr($v1,3, -3);
    $c_col = substr($v1, -3);    

	//conuslta SQL
	$consulta="SELECT COUNT(*) as contar FROM Producto where idSubcategoria='$c_sub' AND idTalla='$c_tal' AND idColor='$c_col'";
	$resultado=mysqli_query($conn,$consulta);
	$array=mysqli_fetch_array($resultado);

	//si registra campos vacios
	if($v1=="" or  $v2==""){
		echo 	"<script>
	                alert('Error: Es necesario completar todos los campos!');
	                window.location= 'SalidaProducto.php'
	   			 </script>";
	}else{
		//si el producto existe en la base de datos
		if($array['contar']!=0){
            //OBTENIENDO EL ACTUAL
            $consultaAct = "SELECT unidadesDisp FROM Producto where idSubcategoria='$c_sub' AND idTalla='$c_tal' AND idColor='$c_col'";
            $resultado2=mysqli_query($conn,$consultaAct);
	        $array=mysqli_fetch_array($resultado2);
            $actual = $array[0];
            //RESTANDO
            $diferencia = $actual - $v2;
            $sql = "UPDATE Producto SET unidadesDisp = $diferencia where idSubcategoria='$c_sub' AND idTalla='$c_tal' AND idColor='$c_col'";
			if (mysqli_query($conn, $sql)) {
				echo 	"<script>
	                alert('Registro exitoso');
	                window.location= 'SalidaProducto.php'
	   			 </script>";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}else{
            echo 	"<script>
	                alert('Error: No es encuentra producto con este código');
	                window.location= 'SalidaProducto.php'
	   			 </script>";
		}
	}	
	mysqli_close($conn);	
?>
