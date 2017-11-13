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
                    <table class="table table-bordered">
                      <hr>
                      <tr>
                        <td colspan="4">
                          <div class="form-group">
                            
                            <label class="col-sm-1 col-sm-1 control-label">Cuenta:&emsp; </label>
                            <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="cuenta">
                                        <?php
                                        $sqlclase=mysqli_query($con,"SELECT * FROM cuenta");
                                        while ($rowclase = mysqli_fetch_assoc($sqlclase)) 
                                        {
                                           $idc = substr($subcuenta_cuenta, 0, 1);
                                          if($idc<=4)
                                          {
                                        ?>
                                          <option>
                                          <?php echo $rowclase['id_cuenta']." .- ".$rowclase['nombre_cuenta']; ?>
                                          </option>
                                        <?php 
                                        }}
                                        $nn=$rowclase['id_cuenta'];
                                        ?>
                                  </select>
                                </p>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-bordered table-striped table-condensed">

                            

                              <thead >
                              <tr>
                                  <td width="40%">Codigo</th>
                                  <td width="10%"> Monto</th>
                                  <td width="40%"> Cuenta</th>
                                  <td width="10%"> Monto</th>
                              </tr>
                              </thead>
                              <tfoot >
                                <tr>
                                  <td>Total</th>
                                  <td> 200</th>
                                  <td>Total</th>
                                  <td> 200</th>
                                </tr>
                              </tfoot>
                              <tbody>
                              <tr>
                                  <td><a href="">1</a></td>
                                  <td>200</td>
                                  <td><a href="">1</a></td>
                                  <td>200</td>
                                  
                              </tr>
                              </tbody>
                          </table>
                          <table>
                            <tr>
                              <td width="92%"></td>

                                  <td>
                                    <button type="button" class="btn btn-success">Agregar</button>
                                  </td>
                            </tr>
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
