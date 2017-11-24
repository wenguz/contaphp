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
            <a class="active" href="principal_contador.php">
                <i class="fa fa-home">    </i>
                <span>Inicio  </span>
            </a>
        </li>

        <li class="sub-menu">
            <a  href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Reportes Diarios</span>
              </a>
              <ul class="sub">
                  <li ><a  href="informe_ingresos.php"><i class="fa fa-list-alt"></i>Informe Ingresos</a></li>
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
                  <li ><a  href="guardar_sumas_saldos.php"><i class="fa fa-list-alt"></i>Reporte Sumas y resultados</a></li>
                  <li ><a  href="guardar_balance_general.php"><i class="fa fa-list-alt"></i>Balance General</a></li>
                  <li ><a  href="guardar_estado_resultados.php"><i class="fa fa-list-alt"></i>Estado de resultados</a></li>
              </ul>
          </li>

    </ul>
</div>
      </aside>


</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Cuentas</h3>
                  <div class="col-md-12">
                      <div class="content-panel">
                        <form action="eecuenta.php" method="post">
                          <table class="table table-bordered table-striped table-condensed">
                            <h4><i class="fa fa-angle-right"></i> Lista de Cuentas</h4>


                            &emsp;<label>Buscar cuentas por codigo:  </label> &emsp;

                            <form action="" method="post">
                              <input style="padding: 5px" type="text" name="buscar_id" value="Buscar..."  />
                              <input type="submit" class="btn btn-primary" type="button" value="Buscar" />
                            </form>
                            <hr>
                              <thead >
                              <tr>
                                  <td class="numeric"> Codigo</td>
                                  <td> Nombre de Cuenta</td>
                                  <td> Nivel</td>
                                  <td style="background:#b8dbb5;"> Estado</td>
                                  <td width="150px"> Opciones</td>
                              </tr>
                              </thead>
                              <tbody>
                              <?php


                              $consul="SELECT * FROM clase";
                              $rrr=mysqli_query($con,$consul);
                              if(mysqli_num_rows($rrr)==0)
                              {

                                  $resultado=mysqli_query($con,"SELECT * FROM clase");
                                  while ($row = mysqli_fetch_assoc($resultado))
                                    {
                                      $cl=$row['id_clase'];
                                      ?>
                                  <tr>
                                      <td><a href=""><?php echo $row['id_clase'];?></a></td>
                                      <td><?php echo $row['nombre_clase'];?></td>
                                      <td><?php echo 'CLASE'?></td>
                                      <td style="background:#b8dbb5;"> <?php echo $row['estado_clase'];?></td>
                                      <td>

                                          <?php
                                            if($row['estado_clase']=='ACTIVO')
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_clase" href="eliminar_clase.php?cl=<?=$cl?>"><i class="fa fa-ban"> Deshabilitar</i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_clase" href="eliminar_clase.php?cl=<?=$cl?>"><i class="fa fa-ban"> Habilitar</i></a>
                                                <?php
                                            }
                                          ?>
                                          ?>
                                      </td>
                                  </tr>
                                  <?php
                                    }

                                }
                                else
                                {
                                  $resultado=mysqli_query($con,"SELECT * FROM clase");
                                  while ($row = mysqli_fetch_assoc($resultado))
                                    {
                                      $cl=$row['id_clase'];
                                      ?>
                                  <tr>
                                      <td><a href=""><?php echo $row['id_clase'];?></a></td>

                                      <td><?php echo $row['nombre_clase'];?></td>
                                      <td><?php echo 'CLASE'?></td>
                                      <td style="background:#b8dbb5;"> <?php echo $row['estado_clase'];?></td>
                                      <td>

                                          <?php
                                            if($row['estado_clase']=='ACTIVO')
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_clase" href="eliminar_clase.php?cl=<?=$cl?>"><i class="fa fa-ban"> Deshabilitar</i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_clase" href="eliminar_clase.php?cl=<?=$cl?>"><i class="fa fa-ban"> Habilitar</i></a>
                                                <?php
                                            }
                                          ?>
                                      </td>
                                  </tr>
                                  <?php

                                      $resultados=mysqli_query($con,"SELECT * FROM grupo where id_clase='$cl'");
                                  while ($rows = mysqli_fetch_assoc($resultados))
                                    {
                                      $gr=$rows['id_grupo'];
                                      ?>
                                  <tr>
                                      <td><a href=""><?php echo $rows['id_grupo'];?></a></td>
                                      <td><?php echo $rows['nombre_grupo'];?></td>
                                      <td><?php echo 'GRUPO'?></td>
                                      <td style="background:#b8dbb5;"> <?php echo $rows['estado_grupo'];?></td>
                                      <td>

                                          <?php
                                            if($rows['estado_grupo']=='ACTIVO')
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_grupo" href="eliminar_grupo.php?gr=<?=$gr?>"><i class="fa fa-ban"> Deshabilitar</i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_grupo" href="eliminar_grupo.php?gr=<?=$gr?>"><i class="fa fa-ban"> Habilitar</i></a>
                                                <?php
                                            }
                                          ?>
                                      </td>
                                  </tr>
                                  <?php
                                  $resultadoss=mysqli_query($con,"SELECT * FROM cuenta where id_grupo='$gr'");
                                  while ($rowss = mysqli_fetch_assoc($resultadoss))
                                    {
                                      $cu=$rowss['id_cuenta'];
                                      ?>
                                  <tr>
                                      <td><a href=""><?php echo $rowss['id_cuenta'];?></a></td>
                                      <td><?php echo $rowss['nombre_cuenta'];?></td>
                                      <td><?php echo 'CUENTA'?></td>
                                      <td style="background:#b8dbb5;"> <?php echo $rowss['estado_cuenta'];?></td>
                                      <td>

                                          <?php
                                            if($rowss['estado_cuenta']=='ACTIVO')
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_cuenta" href="eliminar_cuenta.php?cu=<?=$cu?>"><i class="fa fa-ban"> Deshabilitar</i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_cuenta" href="eliminar_cuenta.php?cu=<?=$cu?>"><i class="fa fa-ban"> Habilitar</i></a>
                                                <?php
                                            }
                                          ?>
                                      </td>
                                  </tr>
                                  <?php
                                  $resultadosss=mysqli_query($con,"SELECT * FROM subcuenta where id_cuenta='$cu'");
                                  while ($rowsss = mysqli_fetch_assoc($resultadosss))
                                    { $sub=$rowsss['id_subcuenta'];
                                      ?>
                                  <tr>
                                      <td><a href=""><?php echo $rowsss['id_subcuenta'];?></a></td>
                                      <td><?php echo $rowsss['nombre_subcuenta'];?></td>
                                      <td><?php echo 'SUBCUENTA'?></td>
                                      <td style="background:#b8dbb5;"> <?php echo $rowsss['estado_subcuenta'];?></td>
                                      <td>
                                          <?php
                                            if($rowsss['estado_subcuenta']=='ACTIVO')
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_subcuenta" href="eliminar_subcuenta.php?sub=<?=$sub?>"><i class="fa fa-ban"> Deshabilitar</i></a>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <a class="btn btn-danger btn-xs" type="submit"  name="eliminar_subcuenta" href="eliminar_subcuenta.php?sub=<?=$sub?>"><i class="fa fa-ban"> Habilitar</i></a>
                                                <?php
                                            }
                                          ?>
                                      </td>
                                  </tr>
                                  <?php
                                }
                                }
                                }
                                }
                                }
                                ?>
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
