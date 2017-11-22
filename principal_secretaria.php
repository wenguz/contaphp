<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");

}
$_SESSION["usuario"];
require('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Secretaria</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>SISTEMA CONTABLE</b></a>

            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="index.php">Cerrar Sesion</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
    <ul class="sidebar-menu" id="nav-accordion"><br>
        <h5 class="centered">Usuario: <?php echo $_SESSION["usuario"]; ?></h5>
        <li class="mt">
            <a href="principal_secretaria.php">
                <i class="fa fa-home">    </i>
                <span>Inicio  </span>
            </a>
        </li>

        <li class="sub-menu">
            <a  href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Registrar Fichas</span>
              </a>
              <ul class="sub">
                  <li ><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
                  <li ><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Egreso</a></li>
                  <li ><a  href="registrar_inversion.php"><i class="fa fa-list-alt"></i>Registrar Inversion</a></li>
              </ul>
          </li>


          <li class="sub-menu">
              <a class="active"  href="lista_ficha.php" >
                  <i class="fa fa-th"></i>
                  <span>Lista de Fichas</span>
              </a>
          </li>

    </ul>
</div>
</aside>


</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Lista de fichas</h3>
          <div class="col-md-12">
              <div class="content-panel">
                  <table class="table table-bordered table-striped table-condensed">
                    <h4><i class="fa fa-angle-right"></i> Busqueda de fichas</h4>
                    &emsp;


                   <form action="" method="post">
                     <tr>&emsp;
                       <label>Ingrese codigo de ficha:  </label> &emsp;
                      <input style="padding: 5px" type="number" name ="b_id" value="Buscar..." onfocus="if (this.value == 'Buscar...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Buscar...';}" />&emsp;
                      <input type="submit"  class="btn btn-theme" name="buscar_id" value="Buscar">    <br>

                    </tr>
                    <br>
                    <tr>
                      &emsp;&emsp;  <label>Ingrese Fecha:  </label> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                      <input style="padding: 5px" type="date" name="b_fecha" placeholder="YYYY-MM-DD" class="form-input"/>&emsp;
                      <input type="submit"  class="btn btn-theme" name="buscar_fecha" value="Buscar">    <br>
                    </tr>
                    <br>
                    <tr>
                      <input type="submit"  class="btn btn-theme" name="buscar1" value="Mostrar todos">
                    </tr>
                    </form>
                    <hr>
                      <thead >
                      <tr>
                          <td>Nro</th>
                          <td> Tipo de Ingreso</th>
                          <td> Tipo de Trans.</th>
                          <td> Monto Total</th>
                          <td>Fecha</th>
                          <td> Autorizado por...</th>
                          <td> Elaborado por...</th>
                          <td> Recibido por...</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
<?php
if(isset($_POST['buscar1']))
{
  $cod=mysqli_query($con,"SELECT * FROM ficha");
  while ($valores = mysqli_fetch_assoc($cod)) { ?>
  <tr>
    <td>
      <?php echo $valores['id_ficha'] ?>
    </td>
    <td>
      <?php
      $id_tp=$valores['id_tipo_pago'];
      $cod_1=mysqli_query($con, "SELECT * FROM tipo_pago WHERE id_tipo_pago='$id_tp'") or die(mysql_error());
      $row_1 = mysqli_fetch_assoc($cod_1);
      echo $row_1['tipo'].' , '.$row_1['descripcion_tipo_pago'];
      ?>
    </td>
    <td>
      <?php
      $id_tt=$valores['id_tipo_transaccion'];
      $cod_11=mysqli_query($con,"SELECT nombre_transaccion FROM tipo_transaccion WHERE id_tipo_transaccion='$id_tt' LIMIT 1");
      $row_11=mysqli_fetch_assoc($cod_11);
      echo $row_11['nombre_transaccion'] ;
      ?>
    </td>
    <td>
      <?php echo $valores['total_ficha'] ?>
    </td>
    <td>
      <?php echo $valores['fecha_ficha'] ?>
    </td>
    <td>
      <?php
      $id_nu=$valores['id_ficha'];
      $cod_111=mysqli_query($con,"SELECT u.nombre_usuario as nu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_nu' AND em.descripcion_empleado='Autorizado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_111=mysqli_fetch_assoc($cod_111);
      echo $row_111['nu'];
      ?>
    </td>
    <td>
      <?php
      $id_el=$valores['id_ficha'];
      $cod_1111=mysqli_query($con,"SELECT u.nombre_usuario as eu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_el' AND em.descripcion_empleado='Elaborado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_1111 = mysqli_fetch_assoc($cod_1111);
      echo $row_1111['eu'];
      ?>
    </td>
    <td>
      <?php
      $id_per=$valores['id_persona'];
      $cod_11111=mysqli_query($con,"SELECT nombre_persona FROM persona WHERE id_persona='$id_per' LIMIT 1");
      $row_11111 = mysqli_fetch_assoc($cod_11111);
      echo $row_11111['nombre_persona'];
      ?>
    </td>
  </tr>
  <?php
  }
}
?>


<?php
if(isset($_POST['buscar_id']))
{
  $a =$_POST["b_id"] ;

  $cod=mysqli_query($con,"SELECT * FROM ficha WHERE id_ficha=$a");
  while ($valores = mysqli_fetch_array($cod)) { ?>
  <tr>
    <td>
      <?php echo $valores['id_ficha'] ?></td>
    <td>
      <?php
      $id_tp=$valores['id_tipo_pago'];
      $cod_1=mysqli_query($con, "SELECT * FROM tipo_pago WHERE id_tipo_pago='$id_tp'") or die(mysql_error());
      $row_1 = mysqli_fetch_assoc($cod_1);
      echo $row_1['tipo'].' , '.$row_1['descripcion_tipo_pago'];
      ?>
    </td>
    <td>
      <?php
      $id_tt=$valores['id_tipo_transaccion'];
      $cod_11=mysqli_query($con,"SELECT nombre_transaccion FROM tipo_transaccion WHERE id_tipo_transaccion='$id_tt' LIMIT 1");
      $row_11=mysqli_fetch_assoc($cod_11);
      echo $row_11['nombre_transaccion'] ;
      ?>
    </td>
    <td>
      <?php echo $valores['total_ficha'] ?>
    </td>
    <td>
      <?php echo $valores['fecha_ficha'] ?>
    </td>
    <td>
      <?php
      $id_nu=$valores['id_ficha'];
      $cod_111=mysqli_query($con,"SELECT u.nombre_usuario as nu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_nu' AND em.descripcion_empleado='Autorizado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_111=mysqli_fetch_assoc($cod_111);
      echo $row_111['nu'];
      ?>
    </td>
    <td>
      <?php
      $id_el=$valores['id_ficha'];
      $cod_1111=mysqli_query($con,"SELECT u.nombre_usuario as eu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_el' AND em.descripcion_empleado='Elaborado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_1111 = mysqli_fetch_assoc($cod_1111);
      echo $row_1111['eu'];
      ?>
    </td>
    <td>
      <?php
      $id_per=$valores['id_persona'];
      $cod_11111=mysqli_query($con,"SELECT nombre_persona FROM persona WHERE id_persona='$id_per' LIMIT 1");
      $row_11111 = mysqli_fetch_assoc($cod_11111);
      echo $row_11111['nombre_persona'];
      ?>
    </td>
  </tr>
  <?php
  }
}

if(isset($_POST['buscar_fecha']))
{
  $a =$_POST["b_fecha"] ;
  $cod=mysqli_query($con,"SELECT * FROM ficha WHERE fecha_ficha='$a'");
  while ($valores = mysqli_fetch_array($cod)) { ?>
  <tr>
    <td>
      <?php echo $valores['id_ficha'] ?></td>
    <td>
      <?php
      $id_tp=$valores['id_tipo_pago'];
      $cod_1=mysqli_query($con, "SELECT * FROM tipo_pago WHERE id_tipo_pago='$id_tp'") or die(mysql_error());
      $row_1 = mysqli_fetch_assoc($cod_1);
      echo $row_1['tipo'].' , '.$row_1['descripcion_tipo_pago'];
      ?>
    </td>
    <td>
      <?php
      $id_tt=$valores['id_tipo_transaccion'];
      $cod_11=mysqli_query($con,"SELECT nombre_transaccion FROM tipo_transaccion WHERE id_tipo_transaccion='$id_tt' LIMIT 1");
      $row_11=mysqli_fetch_assoc($cod_11);
      echo $row_11['nombre_transaccion'] ;
      ?>
    </td>
    <td>
      <?php echo $valores['total_ficha'] ?>
    </td>
    <td>
      <?php echo $valores['fecha_ficha'] ?>
    </td>
    <td>
      <?php
      $id_nu=$valores['id_ficha'];
      $cod_111=mysqli_query($con,"SELECT u.nombre_usuario as nu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_nu' AND em.descripcion_empleado='Autorizado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_111=mysqli_fetch_assoc($cod_111);
      echo $row_111['nu'];
      ?>
    </td>
    <td>
      <?php
      $id_el=$valores['id_ficha'];
      $cod_1111=mysqli_query($con,"SELECT u.nombre_usuario as eu FROM usuario u, empleado_ficha em,empleado_usuario eu  WHERE em.id_ficha='$id_el' AND em.descripcion_empleado='Elaborado' AND em.id_empleado_usuario=eu.id_empleado_usuario AND eu.id_usuario=u.id_usuario LIMIT 1");
      $row_1111 = mysqli_fetch_assoc($cod_1111);
      echo $row_1111['eu'];
      ?>
    </td>
    <td>
      <?php
      $id_per=$valores['id_persona'];
      $cod_11111=mysqli_query($con,"SELECT nombre_persona FROM persona WHERE id_persona='$id_per' LIMIT 1");
      $row_11111 = mysqli_fetch_assoc($cod_11111);
      echo $row_11111['nombre_persona'];
      ?>
    </td>
  </tr>
  <?php
  }
}
?>
                      </tbody>
                  </table>
              </div><!-- /content-panel -->
          </div><!-- /col-md-12 -->
    </section><!--/wrapper -->
</section><!-- /MAIN CONTENT -->

      <!--main content end-->



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
  <script src="assets/js/zabuto_calendar.js"></script>


  <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>


  </body>
</html>
