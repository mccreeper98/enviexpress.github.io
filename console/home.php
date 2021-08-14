<?php
session_start();

if(!isset($_SESSION['AdmEnv'])){
    header("location: index.php");
}else{
    $userSesion = $_SESSION['AdmEnv'];
    $idUser = $userSesion[0]['id'];
    $role = $userSesion[0]['role'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Envi-Express &#8211; Consola</title>
  <meta name='robots' content='noindex, nofollow' />
  <link rel="shortcut icon" href="https://www.envi-express.mx/wp-content/uploads/2020/10/Favicom.jpg"
    type="image/x-icon" />
  <meta property="og:title" content="Cotizador" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://www.envi-express.mx/" />
  <meta property="og:site_name" content="Envi-Express" />
  <meta property="og:description"
    content="Somos una empresa joven 100% mexicana dedicada a dar soluciones integrales para la distribución de mercancía con alcance local, nacional e internacional fusionando nuestra infraestructura junto con la de nuestros aliados" />
  <meta property="og:image" content="https://www.envi-express.mx/wp-content/uploads/2020/06/avatar2.png" />
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="../css/console.css" media="screen,projection" />
  <link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

  <header>
    <div class="cabecera row">
      <div class="col s12 m6 l2 center" style="padding-top: 25px;">
        <a href="#" data-activates="slide-out" id="menu" class=" button-collapse"><i class="material-icons">menu</i></a>
      </div>

    </div>

    <ul id="slide-out" class="side-nav menu fixed">
      <li>
        <div class="user-view"><img class="logo" src="../img/logo.png" style="width: 100%;"></div>
      </li>
      <li class="row center">
        <div id="per" style="margin-top: -20px;">
          Consola de administración
        </div>
      </li>
      <?php
                if($role == 1){
              ?>
      <li><a href="administradores.php" class="waves-effect black-text" style="font-size: 18px"><i
            class="material-icons">group</i>
          &nbsp;Administradores</a></li>
      <?php
                  }
              ?>
      <li><a href="paqueterias.php" class="waves-effect black-text" style="font-size: 18px"><i
            class="material-icons">local_shipping</i>
          &nbsp;Paqueterias</a></li>
      <li><a href="disponibilidad.php" class="waves-effect black-text" style="font-size: 18px"><i
            class="material-icons">map</i>
          &nbsp;Covertura</a></li>
      <li><a href="logout.php" class="waves-effect black-text" style="font-size: 18px"><i
            class="material-icons">exit_to_app</i>
          &nbsp;Cerrar Sesión</a></li>
    </ul>
  </header>
  <main>

    <div style="margin-left: 235px; margin-right: 5%;">

      <div class="vertical">

        <div class="center" style="text-align: center;">
          <h3 style="color: #3f445f;">
            Administración Envi-express
          </h3>
        </div>
        <br><br><br>
        <div class="row">
          <div class="col s12 m6 l3">

          </div>
          <a href="paqueterias.php">
            <div class="col s12 m6 l3 z-depth-2 hoverable"
              style="background-color: #fff; padding-top: 30px; padding-right: 15px; padding-left: 15px; border-radius: 18px; margin-right: 10px;">
              <div class="center">
                <i class="material-icons"
                  style="font-size: 60px; padding-left: 5px; margin-right: 8px; color: #2d81ba;">local_shipping</i>
                <h2
                  style="font-size: 28px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 1.04; letter-spacing: normal; text-align: center; color: #2d81ba;">
                  Paqueterias</h2>
              </div>
            </div>
          </a>
          <a href="disponibilidad.php">
            <div class="col s12 m6 l3 z-depth-2 hoverable"
              style="background-color: #fff; padding-top: 30px; padding-right: 15px; padding-left: 15px; border-radius: 18px; margin-right: 10px;">
              <div class="center">
                <i class="material-icons"
                  style="font-size: 60px; padding-left: 5px; margin-right: 8px; color: #2d81ba;">map</i>
                <h2
                  style="font-size: 28px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 1.04; letter-spacing: normal; text-align: center; color: #2d81ba;">
                  Covertura</h2>
              </div>
            </div>
          </a>
          <?php
                if($role == 1){
            ?>
            <div class="col s12">
              <br>

            </div>
            <div class="col s12 m6 l4"></div>
          <a href="administradores.php">
            <div class="col s12 m6 l3 z-depth-2 hoverable"
              style="background-color: #fff; padding-top: 30px; border-radius: 18px; margin-left: 5rem; padding-right: 15px; padding-left: 15px;">
              <div class="center">
                <i class="material-icons"
                  style="font-size: 60px; padding-left: 5px; margin-right: 8px; color: #2d81ba;">group</i>
                <h2
                  style="font-size: 28px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 1.04; letter-spacing: normal; text-align: center; color: #2d81ba;">
                  Administradores</h2>
              </div>
            </div>
          </a>
          <?php
                }
            ?>

        </div>

      </div>

    </div>

  </main>

  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container center">
        <p class="black-text">Envi-express &reg; 2021 powered by <span style="color: #8C8D8D;">bananageek</span></p>
      </div>
    </div>
  </footer>

</body>

</html>