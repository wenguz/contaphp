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

    <title>Contador</title>

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
  <style type="text/css">

      tfoot {
        text-align: right;
        background: #4b5c4e;
        font-size: 15px;
        color:white;
      }

    </style>

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
            <a  href="principal_contador.php">
                <i class="fa fa-home">    </i>
                <span>Inicio  </span>
            </a>
        </li>

        <li class="sub-menu">
            <a class="active" href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Reportes Diarios</span>
              </a>
              <ul class="sub">
                  <li class="active"><a  href="informe_ingresos.php"><i class="fa fa-list-alt"></i>Informe Ingresos</a></li>
                  <li ><a  href="informe_egresos.php"><i class="fa fa-list-alt"></i>Informe Egresos</a></li>
                  <li ><a  href="guardar_diario.php"><i class="fa fa-list-alt"></i>Libro Diario</a></li>
              </ul>
          </li>
          <li class="sub-menu">
            <a  href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Reportes Mensuales</span>
              </a>
              <ul class="sub">
                  <li ><a  href="guardar_mayor.php"><i class="fa fa-list-alt"></i>Libro Mayor</a></li>
              </ul>
          </li>
          <li class="sub-menu">
            <a  href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Reportes Anuales</span>
              </a>
              <ul class="sub">
                  <li ><a  href="reporte_sumas_y_resultados.php"><i class="fa fa-list-alt"></i>Reporte Sumas y resultados</a></li>
                  <li ><a  href="balance_general.php"><i class="fa fa-list-alt"></i>Balance General</a></li>
                  <li ><a  href="estado_de_resultados.php"><i class="fa fa-list-alt"></i>Estado de resultados</a></li>
              </ul>
          </li>

    </ul>
</div>
      </aside>


</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Lista de fichas</h3>
          <div class="col-md-12">
              <div class="content-panel" >
                  <table class="table table-bordered table-striped table-condensed">
                    <h4><i class="fa fa-angle-right"></i> Informe de Ingresos</h4>
                      <label>&emsp;&emsp;    Ingrese Fecha:  </label> &emsp;
                    <form action="" method="post">
                        <input type="date" name="b_fecha" placeholder="YYYY-MM-DD" class="form-input"/>
                        <input type="submit"  class="btn btn-theme" name="fecha" value="Buscar">
                    </form><!-- style="display: block; overflow-y: auto; height: 100px;"-->
                    <hr>
                      <thead >
                      <tr>
                          <td>Nro</th>
                          <td> Fecha</th>
                          <td> Cuenta</th>
                          <td>Concepto</th>
                          <td> Tipo Pago</th>
                          <td> Recibido de...</th>
                          <td> Monto</th>
                      </tr>
                      </thead>
                      <tfoot>
                         <tr>
                          <td colspan="6">Total Ingresos del Dìa</td>
                          <td></td>
                        </tr>
                      </tfoot>
                    <tbody  >
                      <tr>
                        <?php
                        if(isset($_POST['fecha']))
                          {

                            $a =$_POST["b_fecha"] ;

                              $cod=mysqli_query($con,"SELECT b.id_ficha, b.fecha_ficha, e.nombre_cuenta, x.glosa_asiento, tp.tipo, p.nombre_persona, x.monto_asiento
                                FROM tipo_transaccion a, ficha b, asiento x, subcuenta d, cuenta e, tipo_pago tp, persona p
                                WHERE p.id_persona=b.id_persona
                                AND a.id_tipo_transaccion=b.id_tipo_transaccion
                                AND tp.id_tipo_pago=b.id_tipo_pago
                                AND b.id_ficha=x.ficha_id_ficha
                                AND x.id_subcuenta=d.id_subcuenta
                                and x.haber_asiento = '0'
                                AND d.id_cuenta=e.id_cuenta
                                AND b.fecha_ficha='$a'
                                AND a.nombre_transaccion='Ingreso'");
                               while ($valores = mysqli_fetch_array($cod)) { ?>
                                  <tr>
                                      <td><?php echo $valores['id_ficha'] ?></td>
                                      <td><?php echo $valores['fecha_ficha'] ?></td>
                                      <td><?php echo $valores['nombre_cuenta'] ?></td>
                                      <td><?php echo $valores['glosa_asiento'] ?></td>
                                      <td><?php echo $valores['tipo'] ?></td>
                                      <td><?php echo $valores['nombre_persona'] ?></td>
                                      <td><?php echo $valores['monto_asiento'] ?></td>
                                  </tr>
                                <?php }
                          }?>
                      </tr>

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
