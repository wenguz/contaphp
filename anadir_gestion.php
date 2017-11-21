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
<html lang="es">
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
        <li class="mt">
            <a href="principal_administrador.php">
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
                  <li ><a  href="nuevo_usuario.php"><i class="fa fa-user"></i>Nuevo Usuario</a></li>
                  <li><a  href="lista_usuario.php"><i class="fa fa-list-ol"></i>Lista de USuarios</a></li>
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
              <a class="active" href="anadir_gestion.php" >
                  <i class="fa fa-th"></i>
                  <span>Saldo Anterior</span>
              </a>
          </li>
    </ul>
</div>
      </aside>


</section>


<!--main content start-->
<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Saldo Anterior</h3>
          <div class="col-md-12">
              <div class="content-panel">

                    <h4><i class="fa fa-angle-right"></i>Nueva Gestion</h4>

                    <table class="">
                      <form>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-3 col-sm-3 control-label">Año:&emsp; </label>
                            <div class="col-sm-10">
                              <?php
                              $rs=mysqli_query($con,"SELECT MAX(id_periodo) as id FROM periodo");
                              if ($row = mysqli_fetch_row($rs))
                                {
                                  $id = ($row[0]);
                                }
                              $periodo=mysqli_query($con, "SELECT * FROM periodo WHERE id_periodo='$id'");
                              $per=mysqli_fetch_assoc($periodo);
                              ?>
                                <input type="text" class="form-control" value="<?php echo $per['anio_periodo'];?>">
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-3 col-sm-3 control-label">Fecha_inicio:&emsp; </label>
                            <div class="col-sm-10">

                                <input type="date" class="form-control" value="<?php echo $per['fecha_inicio_periodo'];?>">
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Fecha_fin:&emsp; </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" value="<?php echo $per['fecha_cierre_periodo'];?>">
                            </div>
                          </div>
                        </td>
                      </tr>

                    </table>
<br><br>

<form action="" name="tablas" method="post">
<table class="table table-bordered table-striped table-condensed">
       <h3><i class="fa fa-angle-right"></i> Saldo anterior</h3>
       <tr>
         <p>&emsp;&emsp;&emsp;Saldos</p>
         <input type="submit"  class="btn btn-theme" name="buscar1" value="Mostrar todos">
       </tr>
       <thead >
         <tr>
             <td>Codigo</td>
               <td class="hidden-phone"> Cuenta</td>
             <td width="350px">Monto</td>
         </tr>
         </thead>
         <tfoot >

         </tfoot>
         <tbody>

              <center>   <?php
             $cod_fichaa=mysqli_query($con,"SELECT cod_cuenta,nom_cuenta,monto FROM balance_general where cod_cuenta like '1%'");
                          while ($valores8a = mysqli_fetch_array($cod_fichaa))
                           {?>
                             <tr>
                               <td><?php echo $valores8a['cod_cuenta'] ?></td>
                              <td><?php echo $valores8a['nom_cuenta'] ?></td>
                              <td><?php echo $valores8a['monto'] ?></td>
                            </tr>
                          <?php  }?>
                          <tr>
                            <td colspan="2" ><center>TOTAL</center> </td>
                            <td> <center><?php $totala=0;
                            $cod_fichaa=mysqli_query($con,"SELECT monto AS mo FROM balance_general where cod_cuenta like '1%'");
                                         while ($valores8a = mysqli_fetch_array($cod_fichaa))
                                          {
                                            $x1a = $valores8a['mo'];
                                            $totala=$totala+ ($x1a);
                                          }
                                    echo  $totala;
                           ?></td>
                          </tr>

                          <?php
            $cod_fichaa=mysqli_query($con,"SELECT cod_cuenta,nom_cuenta,monto FROM balance_general where cod_cuenta like '2%' OR cod_cuenta like '3%'");
                         while ($valores8a = mysqli_fetch_array($cod_fichaa))
                         {?>
                             <tr>
                             <td><?php echo $valores8a['cod_cuenta'] ?></td>
                            <td><?php echo $valores8a['nom_cuenta'] ?></td>
                            <td><?php echo $valores8a['monto'] ?></td>
                            </tr>
                        <?php  }?>
                        <tr>
                          <td colspan="2" ><center>TOTAL</center> </td>
                          <td> <center><?php $totala=0;
                          $cod_fichaa=mysqli_query($con,"SELECT monto AS mo FROM balance_general where cod_cuenta like '2%' OR cod_cuenta like '3%'");
                                       while ($valores8a = mysqli_fetch_array($cod_fichaa))
                                        {
                                          $x1a = $valores8a['mo'];
                                          $totala= $totala+($x1a);
                                        }
                                  echo  $totala;
                         ?></td>

                         </tr>
       </center></tbody>

     </table>
     </form>
                          <table>
                            <tr>
                              <td width="92%"></td>

                                  <td>
                                    <input type="submit"  class="btn btn-theme" name="registrar_saldos"  value="AGREGAR">
                                  </td>
                            </tr>
                              <?php
                            if(isset($_POST['registrar_saldos']))
                         {



                             if($_POST['fecha'] == '' or  $_POST['pago'] == '' or $_POST['cambio']== ''  or $_POST['numero_partida_ficha']=='' )
                             {
                                 echo 'Por favor llene todos los campos.';
                             }
                             else
                             {
                              $rs=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
                                     if ($row = mysqli_fetch_row($rs))
                                       {
                                         $iden = trim($row[0]);
                                       }
                                       $tot=0;
                           $id_entidad=$iden+1;
                           $fechai =$_POST["fecha"] ;
                           $pago =$_POST["pago"] ;
                           $trans ='1';
                           $cambio =$_POST["cambio"] ;
                           $moneda =$_POST["moneda"] ;
                           $partida=$_POST["numero_partida_ficha"];
                           $p_nom=$_POST["p_nom"];
                           $p_ci=$_POST["p_ci"];
                           //modena
                           if ($moneda==0)
                           {
                             $tot=$cambio;
                           }
                           else
                           {
                             $tot=1;
                           }
                           //persona recibido por
                           $cod_p=mysqli_query($con,"SELECT id_persona FROM persona WHERE ci_persona='$p_ci' LIMIT 1");
                                          if ($row_p = mysqli_fetch_row($cod_p))
                                            {
                                              $id_persona = trim($row_p[0]);
                                            }
                                            else {
                                              $cod_p=mysqli_query($con,"SELECT MAX(id_persona) as id FROM persona");
                                              if ($row_p = mysqli_fetch_row($cod_p))
                                                {
                                                  $id = trim($row_p[0]);
                                                }
                                                $id_persona = $id+1;
                                              $sq_p= "INSERT INTO persona(id_persona,nombre_persona,ci_persona,descripcion_persona) VALUES ('$id_persona','$p_nom','$p_ci','Recibio');";
                                              mysqli_query($con,$sq_p);
                                            }
             //tipo de cambio
                            $cod_c=mysqli_query($con,"SELECT id_tipo_cambio FROM tipo_cambio WHERE monto='$cambio' LIMIT 1");

                                           if ($row_c = mysqli_fetch_row($cod_c))
                                             {
                                               $id_cambio = trim($row_c[0]);
                                             }
                                           else {
                                               $cod_c=mysqli_query($con,"SELECT   MAX(id_tipo_cambio) FROM tipo_cambio");
                                               if ($row_c = mysqli_fetch_row($cod_c))
                                                 {
                                                   $id_c = trim($row_c[0]);
                                                 }
                                                 $id_cambio = $id_c+1;
                                               $sq_c= "INSERT INTO tipo_cambio( id_tipo_cambio,monto,fecha)
                                                     VALUES ('$id_cambio','$cambio','$fechai');";
                                               mysqli_query($con,$sq_c)  ;
                                             }
                            //tiempo  y hora
                            $time = time();
                            $hora= date("H:i:s", $time);
                            //insertar ficha
                            $sq= "INSERT INTO ficha(id_ficha, numero_partida_ficha, fecha_ficha, tiempo_ficha, total_ficha, total_debe_ficha, total_haber_ficha, id_tipo_transaccion, id_tipo_cambio, id_tipo_pago, id_persona)
                             VALUES ('$id_entidad',
                               '$partida',
                               '$fechai',
                               '$hora',
                               '$tot',
                               '0',
                               '0',
                               '$trans',
                               '$id_cambio',
                               '$pago',
                               '$id_persona')";

                             mysqli_query($con,$sq) or die(mysqli_error($con))  ;

                             $msg = 'Cargo agregado correctamente';
                             print "<script> window.location='emergente_ingreso.php';</script>";
                              }
                         }
                          ?>





                          </table>
                          <table class="table table-bordered table-striped table-condensed">
                            <hr>

                                <center>
                            &emsp;<button type="button" class="btn btn-success">Registrar Datos</button>
                          &emsp;&emsp;
                          <button type="button" class="btn btn-danger">Cancelar</button></center></td>
                        </tr>


                            </form>
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
