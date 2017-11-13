<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");
    
}
$_SESSION["usuario"];

$id_subcuenta = htmlentities($_GET['sub']);

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
              <a class="active" href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Cuentas</span>
              </a>
              <ul class="sub">
                  <li class="active"><a  href="nueva_cuenta.php">Nueva Cuenta</a></li>
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


<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Cuenta</h3>
      <!-- page start-->
              <section class="panel">
                  <div class="panel-body">  
                    <h4 class="mb"><i class="fa fa-angle-right"></i><a href="lista_cuenta.php"> Lista de cuentas</a> &emsp;<i class="fa fa-angle-right"></i>  Subcuenta </h4>
                      <center><label style="font-size: 24px">SUBCUENTA</label></center><br>
                      <form class="form-horizontal style-form" method="POST">
                      <table width="100%">
                        <tr>
                          <?php 
                            $sql = "SELECT * FROM subcuenta WHERE id_subcuenta='".$id_subcuenta."' LIMIT 1";
                            $query = mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($query);
                          ?>
                          <td width="10%"></td>
                          <td width="80%">
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Codigo_de_Cuenta: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="cod_clase" value="<?=$row['id_subcuenta']?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre_de_Cuenta: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nom_clase" value="<?=$row['nombre_subcuenta']?>">
                              </div>
                            </div>
                          </td>
                          <td width="10%"></td>
                        </tr>
                      </table>
                      <center>
                        <br>
                          <?php 
                            $dato_estado_subcuenta=mysqli_query($con,"SELECT estado_subcuenta from subcuenta where id_subcuenta='$id_subcuenta'");
                            $rowsss = mysqli_fetch_assoc($dato_estado_subcuenta);
                            if($rowsss['estado_subcuenta']=='ACTIVO') 
                            { 
                                ?>
                                &emsp;<input type="submit" class="btn btn-success" name="desactivar_subcuenta" value="Deshabilitar subcuenta">
                                &emsp;
                                <?php
                            } 
                            else
                            {
                                ?>
                                &emsp;<input type="submit" class="btn btn-success" name="activar_subcuenta" value="Habilitar subcuenta">
                                &emsp;
                                <?php
                            }
                          ?>
                          &emsp;&emsp;<input type="submit"  class="btn btn-danger"  name="cancelar" value="Cancelar">
                      </center>
                       <?php
                        if(isset($_POST['desactivar_subcuenta'])) 
                        { 
                            $sql =("UPDATE subcuenta SET estado_subcuenta='NO ACTIVO' WHERE id_subcuenta='$id_subcuenta'");
                            mysqli_query($con,$sql) or die(mysqli_error());

                            $msg = "subcuenta Deshabilitada correctamente";
                            print "<script>alert('$msg'); window.location='lista_cuenta.php';</script>";

                        } 
                        else
                        {
                          if(isset($_POST['activar_subcuenta'])) 
                        { 
                          
                            $sql =("UPDATE subcuenta SET estado_subcuenta='ACTIVO' WHERE id_subcuenta='$id_subcuenta'");
                            mysqli_query($con,$sql) or die(mysqli_error());

                            $msg = "subcuenta Habilitada correctamente";
                            print "<script>alert('$msg'); window.location='lista_cuenta.php';</script>";

                        } 
                        }
                        if(isset($_POST['cancelar'])) 
                        { 
                          print "<script> window.location='lista_cuenta.php';</script>";
                        }
                      ?>
                      </center>
                    </form>
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
