<?php
     //recoger sesiones activas
     session_start();
     if(isset($_SESSION['user'])){
         header("Location:../inicio_admin/");
     }else{
            //SI NO EXISTE. VERIFICAR SI SE HIZO UN POST
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
                      alert("Inicie sesión primero");
                      window.location = "./";
                  </script>
                ';
                die();
                }
            }
  }
?>
<!doctype html>
<html lang="es">

<head>
    <title>Login Boutique</title>
    <!--Developers 
        @Castillo Cornejo, Jeffrey Bryan		
        @Collantes Tito, Miguel Angel 		
        @Mitma Huaccha, Johan Valerio  	-->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../resources/faviconv2.png"/>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/31127b7562.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body class="body">
<nav class="navbar navbar-dark bg-dark">
  <!-- Navbar content -->
  
</nav>
<div class="logo">
            <h2 >BOUTIQUE ONYX STONE</h2>
			<p>Lo mejor de moda para <span>ellos!</span></p>
</div>

    <div class="container justify-content-center d-flex">
        
        <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-6 d-none border-right d-flex justify-content-center align-items-center">
                  <img class="logo-login-minsa rounded" src="./img/streetwear.png" style="width:80%;border: radius 10px;">
                </div>
                <div class="col-lg-6">
                <div class="container-fluid">
                  <form action="index.php" method="post" class="text-center justify-content-center" style="margin-top:5%;">
            <h1 style="color:black;text-align:center;">Iniciar Sesión</h1>
            <div class="container" style="margin-left: 25%;">
                <div class="form-group col-6 ">
                    <label for="user" style="color:white;">Usuario</label>
                    <input type="text" class="form-control" name="user" aria-describedby="emailHelpId" placeholder="" required>
                    <small id="emailHelpId" class="form-text text-muted" style="color:white;">Coloque su correo o su nombre de usuario</small>
                </div>
                <div class="form-group col-6">
                    <label for="password" style="color:white;">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="" minlength="8" required>
                </div>
               

                <div class="form-group col-6">
                    <button type="submit" class="btn btn-primary"><i class="fal fa-sign-in-alt"></i>Ingresar</button>
                   
                </div>
                <div class="form-group col-6">
            
            <label for="password" style="color:white"><a href="mailto:boutique.onyx@hotmail.com">No recuerdas tu contraseña? Click Aqui</a></label>
        </div>
            </div>

        </form>
        </div>
                  </div>
                </div>
              </div>
            </div>
    </div>

    <br>
    <footer>
		<div class="pie fixed-bottom">
			<a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
			<a href="#"><i class="fab fa-instagram fa-2x"></i></a>
			<a href="#"><i class="fas fa-map-marked-alt fa-2x"></i></a>
			<p>Copyright © 2021, Todos los derechos reservados.</p>
		</div>
		
	</footer>
    
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>