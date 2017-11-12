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
        <li class="mt">
            <a  href="principal_administrador.php">
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
              <a class="active" href="datos_entidad.php" >
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


<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Entidad</h3>
      <!-- page start-->
              <section class="panel">
                  <div class="panel-body">
                            
                      <center>
                      <form class="form-horizontal style-form" method="get">
                      
                      <table width="80%" >
                        <tr>
                          <td>
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la entidad</h4>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre: </label>
                              <div class="col-sm-10">

                                <?php
                                $datos=mysqli_query($con,"SELECT * FROM entidad LIMIT 1");
                                $row=mysqli_fetch_assoc($datos);

                                ?>

                                  <input type="text" class="form-control" name="nombre_entidad" disabled="true" value="<?=$row['nombre_entidad']?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Direccion: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="direccion_entidad" disabled="true" value="<?=$row['direccion_entidad'];?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Telefono: </label>
                              <table>
                                <tr>
                                  <td>
                                    <div class="col-sm-10">
                                      <input type="text" placeholder="fono1" class="form-control" name="fono1" disabled="true" value="<?=$row['fono1_entidad'];?>">
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-sm-10">
                                      <input type="text" placeholder="fono2" class="form-control" name="fono2" disabled="true" value="<?=$row['fono2_entidad'];?>">
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Ciudad: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="ciudad_entidad" disabled="true" value="<?=$row['ciudad_entidad'];?>">
                              </div>
                            </div>
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Datos del responsable</h4>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre completo: </label>
                              <div class="col-sm-10">

                                <?php
                                $responsable=mysqli_query($con, "SELECT * FROM usuario where id_usuario='1'");
                                $res=mysqli_fetch_assoc($responsable);
                                ?>

                                  <input type="text" class="form-control" disabled="true" value="<?=$res['nombre_usuario']." ".$res['ap_paterno_usuario']." ".$res['ap_materno_usuario'];?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">CI: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" disabled="true" value="<?=$res['ci_usuario']?>">
                              </div>
                            </div>
                            <center>
                          <!--<button type="button" class="btn btn-success">Registrar Datos</button>
                          &emsp;&emsp;
                          <button type="button" class="btn btn-danger">Cancelar</button>-->
                          </center>
                            <h4 class="mb"><i class="fa fa-angle-right"></i> Año y Periodo</h4>
                            <?php
                            $rs=mysqli_query($con,"SELECT MAX(id_periodo) as id FROM periodo");
                            if ($row = mysqli_fetch_row($rs)) 
                              {
                                $id = ($row[0]);
                              }
                            $periodo=mysqli_query($con, "SELECT * FROM periodo WHERE id_periodo='$id'");
                            $per=mysqli_fetch_assoc($periodo);
                            ?>
                            <table>
                              <tr>
                                <td>
                                  <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Año: </label>
                                    <div class="col-sm-10">
                                     <input type="text" class="form-control" name="año" disabled="true" value="<?=$per['anio_periodo']?>">
                                    </div>
                                  </div>
                                </td>
                                <td width="5%"></td>
                                <td>
                                  <div class="form-group">
                                    <label class="col-sm-4 col-sm-4 control-label">Fecha_Inicio: </label>
                                    <div class="col-sm-8">
                                     <input type="date" class="form-control" name="fecha_inicio" disabled="true" value="<?=$per['fecha_inicio_periodo']?>">
                                    </div>
                                  </div>
                                </td>
                                <td width="5%">  </td>
                                <td>
                                  <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Fecha_fin: </label>
                                    <div class="col-sm-8">
                                     <input type="date" class="form-control" name="fecha_final" disabled="true" value="<?=$per['fecha_cierre_periodo']?>">
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      &emsp;
                      <input type="submit" class="btn btn-success" name="modificar_datos" value="Editar Datos de Entidad">
                      &emsp;&emsp;
                      <input type="submit"  class="btn btn-danger"  name="cancelar" value="Cancelar">
                      </form></center>
                  </div>
              </section>
          </aside>
      </div>
  </section>
</section>
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
