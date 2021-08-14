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
  <link rel="stylesheet" type="text/css" href="../css/sweetalert2.css">
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
            Covertura
          </h4>
        </div>

        <div class="col s12 m6 l6">

        </div>

        <div class="col s12 m6 l3 center">
        <form action="#" method="post" enctype="multipart/form-data" id="myform">
          <div class="file-field input-field">
            <div class="btn-floating waves-effect boton">
              <i class="material-icons">add</i>
              <input type="file" id="file" name="file">
            </div>
          </div>
        </form>
        </div>
                  <div class="col s12 m6 l12">
                    <br>
                  </div>
        <div class="col s8 m6 l9">
          <br>
        </div>

        <div class="col s4 m6 l3 center">
        <a href="colonias.php" class="black-text" style="text-decoration:underline;">Colonias</a>
        </div>
      </div>
      <br>
      <div style="margin-left: 8%;">
        <table class="striped z-depth-3" style="background-color: #fff;">
          <thead>
            <tr>
              <th><b style="margin-left: 5%;">C.P</b></th>
              <th><b>Estado</b></th>
              <th><b>Municipio/Delegación</b></th>
              <!-- <th class="center"><b>Editar</b></th> -->
              <th class="center"><b>Paqueterias</b></th>
            </tr>
          </thead>

          <tbody id="resultadoBusqueda">

          </tbody>

          <tbody id="tb">

            <?php 

               $obtPaq = mysqli_query($connect, "SELECT * FROM zona");

               while ($paq = mysqli_fetch_array($obtPaq)) {
                 ?>
            <tr>
              <td><span style="margin-left: 5%">
                  <?php echo $paq['cp'] ?>
                </span></td>
              <td>
                <?php echo $paq['estado']; ?>
              </td>
              <td><?php echo $paq['municipio']; ?></td>
              <td class="center"><a class="waves-effect black-text" href="zona.php?id=<?php echo$paq['cp'];?>" style="font-size: 18px"><i class="material-icons">visibility</i></a></td>
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

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../dist/sweetalert2.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
      $('.modal').modal();
      $('select').material_select();

      $('#file').on('change', function(){
        
        var fd = new FormData();
        var file = $('#file')[0].files;

        console.log(file[0].name)

        if(file[0].name.endsWith('.xlsx')){

          swal({
            title: 'Cargando',
            text: 'El proceso puede tardar unos minutos',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
              swal.showLoading();
            }
          });

          fd.append('file', file[0]);

          $.ajax({
              url: 'excel.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                console.log(response);
                 if(response != 0){
                  swal({ 
                    title: 'Bien',
                    text: '! Se han cargado los datos !',
                    type: 'success',
                    showConfirmButton: true
                  });

                  // window.location.href='disponibilidad.php';
                 }else{
                  swal({ 
                    title: 'Error',
                    text: '! No  se pudo cargar el archivo !',
                    type: 'error',
                    showConfirmButton: true
                  });
                 }
              },
           });
        }else{
          swal({ 
          title: 'Error!',
          text: '! Selecciona un archivo .xlsx !',
          type: 'error',
          showConfirmButton: true
        });
        }
      });
    });


// document.getElementById("fire")
//   .addEventListener('click', (event) => {
//     showLoading();
//     setTimeout(function() {
// 			console.log('closed by time!!!!');
//         swal({ 
//           title: 'Finished!',
//           type: 'success',
//           showConfirmButton: true
//         })
// 		}, 7000);
//   });
//     });

//     const showLoading = function() {
//   swal({
//     title: 'Now loading',
//     allowEscapeKey: false,
//     allowOutsideClick: false,
//     onOpen: () => {
//       swal.showLoading();
//     }
//   })

// };
//showLoading();
  </script>

</body>

</html>