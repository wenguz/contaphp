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

    <title>Administrador</title>

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
        <li class="mt" >
            <a href="principal_administrador.php" class="active">
                <i class="fa fa-home">    </i>
                <span>Inicio  </span>
            </a>
        </li>

        <li class="sub-menu">
            <a  href="javascript:;" >
                  <i class="fa fa-users"></i>
                  <span>Usuarios</span>
              </a>
              <ul class="sub">
                  <li class=""><a  href="nuevo_usuario.php"><i class="fa fa-user"></i>Nuevo Usuario</a></li>
                  <li ><a  href="lista_usuario.php"><i class="fa fa-list-ol"></i>Lista de USuarios</a></li>
              </ul>
          </li>

          <li class="sub-menu">
              <a href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Cuentas</span>
              </a>
              <ul class="sub">
                  <li><a  href="nueva_cuenta.php">Nueva Cuenta</a></li>
                  <li><a  href="lista_cuenta.php">Lista de Cuentas</a></li>
              </ul>
          </li>
          <li class="sub-menu">
              <a href="datos_entidad.php" >
                  <i class="fa fa-th"></i>
                  <span>Datos Entidad</span>
              </a>
          </li>
          <li class="sub-menu">
              <a href="anadir_gestion.php" >
                  <i class="fa fa-th"></i>
                  <span>Añadir Gestion</span>
              </a>
          </li>
    </ul>
</div>
      </aside>


</section>
<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Usuario</h3>
                  <div class="col-md-12">
                      <div class="content-panel">
                        <form action="" method="post">
                          <table class="table table-bordered table-striped table-condensed">
                            <h4><i class="fa fa-angle-right"></i> Lista de Usuarios</h4>
                            &emsp;&emsp;
                             <form action="" method="post">
                               <tr>
                                 <label>   Mostrar Usuarios </label>&emsp;&emsp;
                                 <input type="submit" class="btn btn-theme" name="buscar1" value="Mostrar todos">
                               </tr>
                            </form>

                            <hr>
                              <thead style="background:#bcf5a9;">
                              <tr>
                                  <td><strong> Codigo</th>
                                  <td class="hidden-phone"><strong> Nombre</th>
                                  <td><strong> Ap. Paterno</th>
                                  <td><strong> Ap. Materno</th>
                                  <td><strong> CI</th>
                                  <td><strong> Cargo</th>
                                  <td style="background:#b8dbb5;"><strong> Estado</th>
                                  <td><strong> Usuario</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <?php
                                      if(isset($_POST['buscar1']))
                                  { $cod=mysqli_query($con,"Select eu.id_empleado_usuario,u.nombre_usuario,u.ap_paterno_usuario,u.ap_materno_usuario,u.ci_usuario,e.cargo,eu.estado, eu.user From empleado_usuario eu,usuario u,empleado e Where eu.id_empleado=e.id_empleado And eu.id_usuario=u.id_usuario");
                                     while ($valores = mysqli_fetch_array($cod)) { ?>
                                        <tr>
                                            <td><?php echo $valores['id_empleado_usuario'] ?></td>
                                            <td><?php echo $valores['nombre_usuario'] ?></td>
                                            <td><?php echo $valores['ap_paterno_usuario'] ?></td>
                                            <td><?php echo $valores['ap_materno_usuario'] ?></td>
                                            <td><?php echo $valores['ci_usuario'] ?></td>
                                            <td><?php echo $valores['cargo'] ?></td>
                                            <td style="background:#b8dbb5;"><?php echo $valores['estado'] ?></td>
                                            <td><?php echo $valores['user'] ?></td>
                                    </tr>
                                   <?php
                                 }
                               }   ?>
                              </tbody>
                          </table>
                          </form>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
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
