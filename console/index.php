<?php
  session_start();

  if(isset($_SESSION["AdmEnv"])){
  // echo "Session is set"; // for testing purposes
  header("Location: home.php");
  }

  if(isset($_POST["login"])){

  if(!empty($_POST['user']) && !empty($_POST['password'])) {

      require_once 'connection.php';
      $username=$_POST['user'];
      $password=$_POST['password'];
      // $tip = 1;
      $query = mysqli_query($connect,"SELECT * FROM usuarios WHERE usuario='".$username."'");
      $numrows = mysqli_num_rows($query);
      if($numrows!=0 ){

      $row=mysqli_fetch_array($query);
      $dbpassword=$row['password'];
      
        if ($password == $dbpassword) {
          $arreglo[]=array('role'=>$row['role'],'id'=>$row['id']);
          
          $_SESSION['AdmEnv']=$arreglo;

          /* Redirect browser */
          header("Location: home.php");
        }else{
          $message =3;
        }
      } else {   
        $message = 2;
      }

  } else {
      $message = 1;
  }
  }
  ?>
<!DOCTYPE html>
  <html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Envi-Express &#8211; Consola</title>
        <meta name='robots' content='noindex, nofollow' />
        <link rel="shortcut icon" href="https://www.envi-express.mx/wp-content/uploads/2020/10/Favicom.jpg" type="image/x-icon" />
        <meta property="og:title" content="Cotizador"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="https://www.envi-express.mx/"/>
        <meta property="og:site_name" content="Envi-Express"/>
        <meta property="og:description" content="Somos una empresa joven 100% mexicana dedicada a dar soluciones integrales para la distribución de mercancía con alcance local, nacional e internacional fusionando nuestra infraestructura junto con la de nuestros aliados"/>
        <meta property="og:image" content="https://www.envi-express.mx/wp-content/uploads/2020/06/avatar2.png"/>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="../css/console.css" media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

        <main>
             
            <div class="hpan">
                <div class="barra vpan">
                <div class="card">
                    <img src="../img/logo.png" class="logo">
                    <br>
                    <div class="row">
                        <form class="col s12" onsubmit="return valida();" method="post">
                        <div class="row container">
                            <div class="input-field col s12">
                            <input id="user" name="user" type="text" class="validate">
                            <label for="user">Usuario</label>
                            </div>
                            <div class="input-field col s12">
                            <input id="password" type="password" name="password" class="validate">
                            <label for="password">Contraseña</label>
                            </div>

                            <button class="btn waves-effect boton" type="submit" name="login">Ingresar</button>
                        </div>
                        </form>
                    </div>  
                </div>
            </div>

        </main>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/main.js"></script>
      <script type="text/javascript" src="../dist/sweetalert-dev.js"></script>
      <script type="text/javascript">
      function valida() {
        valor = document.getElementById("user").value;
        valorc = document.getElementById("password").value;
        if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
          console.log('usuario');
         sweetAlert('Error','Todos los campos son requeridos!','error');
          return false;
        }
        if (valorc == null || valor.length == 0) {
          console.log('pass');
          sweetAlert('Error','Todos los campos son requeridos!','error');
          return false;
        }
        return true;
      }
    </script>

    <?php if (isset($message)) {

      if ($message==1) {
        ?>
        <script type="text/javascript">
          sweetAlert('Error','Todos los campos son requeridos!','error');
        </script>
        <?php 
        header("Location: login.php");
      }

      if ($message==2) {
        ?>
        <script type="text/javascript">
          sweetAlert('Error','Usuario incorrecto!','error');
        </script>
        <?php  
         
      }

      if ($message==3) {
        ?>
        <script type="text/javascript">
          sweetAlert('Error','Contraseña incorrecta!','error');
        </script>
        <?php 
      }

    } ?>
    </body>
  </html>
