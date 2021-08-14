<?php
session_start();

if(!isset($_SESSION['AdmEnv'])){
    header("location: index.php");
}else{
    $userSesion = $_SESSION['AdmEnv'];
    $idUser = $userSesion[0]['id'];
    $role = $userSesion[0]['role'];

    if($role != 1){
      header("location: home.php");
    }
}

if (isset($_GET['id'])) {
	$idPaqueteria = $_GET['id'];
}else{
    header("location: paqueterias.php");
}

if (isset($_GET['paq'])) {
	$paqueteria = $_GET['paq'];
}

require_once 'connection.php';

if(isset($_POST["registrar"])){
    if(!empty($_POST['de']) && !empty($_POST['hasta']) && !empty($_POST['precio']) && !empty($_POST['zona']) && !empty($_POST['tipo'])) {
  
        $de = $_POST['de'];
        $hasta = $_POST['hasta'];
        $precio = $_POST['de'];
        $zona = $_POST['zona'];
        $tipo = $_POST['tipo'];

        $insertPaq = mysqli_query($connect, "INSERT INTO tarifas(de, hasta, precio, zona, tipó) VALUES('$de','$hasta','$precio','$zona','$tipo')");

        if(!$insertPaq){
          $message = 2;
        }else{
          $message = 3;
        }


    } else {
        $message = 1;
    }
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
              <li><div class="user-view"><img class="logo" src="../img/logo.png" style="width: 100%;"></div></li>
              <li class="row center">
                <div id="per" style="margin-top: -20px;">
                  Consola de administración
                </div>
              </li>
              <?php
                if($role == 1){
              ?>
                <li><a href="administradores.php" class="waves-effect black-text" style="font-size: 18px"><i class="material-icons">group</i>
                &nbsp;Administradores</a></li>
                <?php
                  }
              ?>
              <li><a href="paqueterias.php" class="waves-effect black-text" style="font-size: 18px"><i class="material-icons">local_shipping</i>
               &nbsp;Paqueterias</a></li>
               <li><a href="disponibilidad.php" class="waves-effect black-text" style="font-size: 18px"><i class="material-icons">map</i>
               &nbsp;Covertura</a></li>
              <li ><a href="logout.php" class="waves-effect black-text" style="font-size: 18px"><i class="material-icons">exit_to_app</i>
               &nbsp;Cerrar Sesión</a></li>
            </ul>
  </header>
  <main>

    <div style="margin-left: 235px; margin-right: 5%;">

      <div class="row" style="margin-left: 8%;">
        <div class="col s12 m6 l3">
          <h4>
            <?php echo $paqueteria;?>
          </h4>
        </div>

        <div class="col s12 m6 l6">

        </div>

        <div class="col s12 m6 l3 right-align">
          <a class="btn-floating waves-effect modal-trigger boton" href="#add"><i class="material-icons">add</i></a>
          <!-- <form class="col s12" accept-charset="utf-8" method="POST">
           <div class="row">
             <div class="input-field">
             <i class="material-icons prefix">search</i>
             <input type="text" name="busqueda" id="busqueda" maxlength="30" autocomplete="off" onkeyup="buscar();" />
             <label for="busqueda">Buscar Administrador</label>
           </div>
           </div>
         </form> -->
        </div>
      </div>
      <br>
     <p style="margin-left: 8%; font-size: 1.4rem">Servicio Terrestre</p>
      <div style="margin-left: 8%;">
        <table class="striped z-depth-3" style="background-color: #fff;">
          <thead>
            <tr>
              <th><b style="margin-left: 5%;">Peso</b></th>
              <th><b>Precio</b></th>
              <th><b>Zona</b></th>
              <!-- <th class="center"><b>Editar</b></th> -->
              <th class="center"><b>Eliminar</b></th>
            </tr>
          </thead>

          <tbody id="resultadoBusqueda">

          </tbody>

          <tbody id="tb">

            <?php 

               $obtPaq = mysqli_query($connect, "SELECT * FROM tarifas WHERE idPaqueteria = $idPaqueteria AND tipo = '1'");

               while ($paq = mysqli_fetch_array($obtPaq)) {
                 ?>
            <tr>
              <td><span style="margin-left: 5%">
                  <?php echo $paq['de'] ?> A <?php echo $paq['hasta'] ?> Kg
                </span></td>
              <td>
               $ <?php echo $paq['precio']; ?>
              </td>
              <td><?php echo $paq['zona']; ?></td>
              <!-- <td class="center"><a class="waves-effect blue-text modal-trigger" href="#modal<?php echo $paq['idPaqueteria'] ?>" style="font-size: 18px"><i class="material-icons">edit</i></a></td> -->
              <td class="center"><a class="waves-effect red-text" style="font-size: 18px"
                  onclick="del(<?php echo $paq['idTarifa']; ?>);"><i class="material-icons">delete</i></a></td>
            </tr>
            <?php
               }

              ?>
          </tbody>
        </table>
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

  <!-- Modal Structure -->
  <div id="add" class="modal modal-fixed-footer">
    <div class="modal-content center" style="padding-top: 12%;">
      <h4>Agregar Tarifa</h4>
      <div class="row">
        <form class="col s12" onsubmit="return valida();" method="post" enctype="multipart/form-data">
          <div class="row container">
            <div class="input-field col s6">
              <input id="de" name="de" type="number" class="validate">
              <label for="de">De</label>
            </div>

            <div class="input-field col s6">
              <input id="hasta" name="hasta" type="number" class="validate">
              <label for="hasta">Hasta</label>
            </div>
            </div>
            
            <div class="row container">
            <div class="input-field col s6">
              <input id="precio" name="precio" type="number" class="validate">
              <label for="precio">Precio</label>
            </div>

            <div class="input-field col s6">
              <input id="zona" name="zona" type="text" class="validate">
              <label for="zona">Zona</label>
            </div>

            <div class="input-field col s12">
              <select name="tipo">
                <option value="" disabled selected>Selecciona el tipo de tarifa</option>
                <option value="1">Servicio Terrestre</option>
                <option value="2">Servicio Día Siguiente</option>
              </select>
              <label>Tipo</label>
            </div>

            </div>

            

            <br><br>
            
            <button class="btn waves-effect boton" type="submit" name="registrar">Guardar</button>
        
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
    </div>
  </div>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../dist/sweetalert-dev.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
      $('.modal').modal();
      $('select').material_select();
    });
  </script>

  <script type="text/javascript">
    function valida() {
      valor = document.getElementById("de").value;
      valorn = document.getElementById("hasta").value;
      valorc = document.getElementById("precio").value;
      valord = document.getElementById("zona").value;
      valore = document.getElementById("tipo").value;
      if (valor == null || valor.length == 0) {
        console.log('de');
        sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
        return false;
      }
      if (valorc == null || valorc.length == 0) {
        console.log('precio');
        sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
        return false;
      }
      if (valorn == null || valorn.length == 0) {
        console.log('hasta');
        sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
        return false;
      }
      if (valord == null || valord.length == 0) {
        console.log('zona');
        sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
        return false;
      }
      if (valore == null || valore.length == 0) {
        console.log('tipo');
        sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
        return false;
      }

      return true;
    }
  </script>

  <?php if (isset($message)) {

      if ($message==1) {
        ?>
  <script type="text/javascript">
    sweetAlert('Error', 'Todos los campos son requeridos!', 'error');
  </script>
  <?php 
      }

      if ($message==2) {
        ?>
  <script type="text/javascript">
    sweetAlert('Error', 'No se pudieron guardar los datos, vuelva atras e intente de nuevo!', 'error');
  </script>
  <?php  
         
      }

      if ($message==3) {
        ?>
  <script type="text/javascript">
    sweetAlert('Bien', 'La paqueteria se guardo correctamente!', 'success');
  </script>
  <?php 
      }

    } 
 ?>

  <script>

    function del(ide) {
      var parametros = {
        "id": ide
      };
      $.ajax({
        data: parametros,
        url: 'deletetarifa.php',
        type: 'POST',
        success: function (response) {
          if (response == 1) {
            swal({
              title: "Bien",
              text: "La tarifa se elimino con exíto.",
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#164f9e",
              confirmButtonText: "OK",
              closeOnConfirm: false
            },
              function () {
                window.location.href = 'tarifas.php?id=<?php echo $idPaqueteria ?>&paq=<?php echo $paqueteria?>';
              });
          } else {
            swal({
              title: "Error",
              text: "La tarifa no se pudo eliminar!",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#164f9e",
              confirmButtonText: "OK",
              closeOnConfirm: false
            },
              function () {
                window.location.href = 'tarifas.php?id=<?php echo $idPaqueteria ?>&paq=<?php echo $paqueteria?>';
              });
          }
        }
      });
    }

  </script>

</body>

</html>