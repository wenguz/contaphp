<?php
session_start();
require('conexion.php');
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");
$_SESSION["usuario"];
require('conexion.php');
}
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
            <a class="active" href="javascript:;" >
                  <i class="fa fa-users"></i>
                  <span>Usuarios</span>
              </a>
              <ul class="sub">
                  <li class="active"><a  href="nuevo_usuario.php"><i class="fa fa-user"></i>Nuevo Usuario</a></li>
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
    <h3><i class="fa fa-angle-right"></i> Usuario</h3>
      <!-- page start-->
              <section class="panel">
                  <div class="panel-body">
                            
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Nuevo Usuario</h4>
                      <form class="form-horizontal style-form" method="post" action="">
                      <table >
                        <tr>
                          <td></td>
                          <td width="50%">
                      
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Codigo:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="codigo_usuario" disabled="true" value=
                                  <?php 
                                  
                                  $rs=mysql_query("SELECT MAX(id_usuario) AS id FROM usuario");
                                  if ($row = mysql_fetch_row($rs)) 
                                    {
                                      $id = trim($row[0]);
                                    }
                                  $id=$id+1;
                                  echo "$id"; ?>>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nombre_usuario">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Apellido Paterno:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="appaterno_usuario">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Apellido Materno:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="apmaterno_usuario">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="ci_usuario">
                              </div>
                          </div>
                          </td> 
                          <td>
                          </td>
                          <td width="40%"> 
                            &emsp;
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Usuario:&emsp; </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nuevo_usuario">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Contraseña:&emsp; </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nueva_contraseña">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Cargo:&emsp; </label>
                              <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="cargo">
                                        <option>ADMINISTRADOR</option>
                                       <option>CONTADOR</option>
                                       <option>SECRETARIA</option>
                                  </select>
                                </p>
                              </div>
                          </div><br>
                          &emsp;<input type="submit" class="btn btn-success" name="registrar_usuario" value="Registrar Usuario">
                          &emsp;
                          &emsp;<input type="submit" class="btn btn-danger"  name="cancelar" value="Cancelar">
                          </td>
                        </tr>
                      </table>
                      <?php
                        //include('conexion.php');
                        if(isset($_POST['registrar_usuario'])) 
                        { 
                            if($_POST['nombre_usuario'] == '' or $_POST['nuevo_usuario'] == '' or $_POST['nueva_contraseña'] == '')
                            { 
                                echo 'Por favor llene todos los campos.'; 
                            } 
                            else 
                            { /*
                                $consul="SELECT * FROM usuario";
                                $rrr=mysql_query($consul);
                                if(mysql_num_rows($rrr)==0)
                                {
                                  
                                    $nombre_usuario = $_POST['nombre_usuario'];
                                    $ap_paterno_usuario = $_POST['appaterno_usuario'];
                                    $ap_materno_usuario = $_POST['apmaterno_usuario'];
                                    $ci_usuario = $_POST['ci_usuario'];
                                    $user = $_POST['nuevo_usuario'];
                                    $password = $_POST['nueva_contraseña'];
                                    $cargo = $_POST['cargo']; 

                                    $sql = "INSERT INTO usuario(id_usuario, nombre_usuario, ap_paterno_usuario, ap_materno_usuario, ci_usuario, user, password) VALUES ('1','$nombre_usuario' , '$ap_paterno_usuario', '$ap_materno_usuario', '$ci_usuario', '$user', '$password');";
                                    mysql_query($sql); 

                                    $r=mysql_query("SELECT id_empleado FROM empleado where cargo='$cargo'");
                                    if ($row = mysql_fetch_row($r)) 
                                      {
                                        $id_empleado = trim($row[0]);
                                      }

                                    $sq="INSERT INTO empleado_usuario (id_empleado_usuario, id_empleado, id_usuario, estado) VALUES ('1', '$id_empleado','1','ACTIVO')"; 
                                    mysql_query($sq); 

                                    $mensaje = "no datos..........Usted se ha registrado correctamente.";
                                    print "<script>alert('$mensaje'); window.location='lista_usuario.php';</script>";
                                }
                                else*/
                                {
                                  $sql = 'SELECT * FROM usuario'; 
                                  $rec = mysql_query($sql); 
                                  $verificar_usuario = 0; 
                            
                                  while($result = mysql_fetch_object($rec)) 
                                  { 
                                      if($result->user == $_POST['ci_usuario']) 
                                      { 
                                          $verificar_usuario = 1; 
                                      } 
                                  } 
                            
                                  if($verificar_usuario == 0) 
                                  { 
                                    
                                    $nombre_usuario = $_POST['nombre_usuario'];
                                    $ap_paterno_usuario = $_POST['appaterno_usuario'];
                                    $ap_materno_usuario = $_POST['apmaterno_usuario'];
                                    $ci_usuario = $_POST['ci_usuario'];
                                    $user = $_POST['nuevo_usuario'];
                                    $password = $_POST['nueva_contraseña'];
                                    $cargo = $_POST['cargo']; 


                                    $rs=mysql_query("SELECT MAX(id_usuario) AS id FROM usuario");
                                    if ($row = mysql_fetch_row($rs)) 
                                      {
                                        $id = trim($row[0]);
                                      }
                                    $id_usuario=$id+1;


                                    $sql = "INSERT INTO usuario(id_usuario, nombre_usuario, ap_paterno_usuario, ap_materno_usuario, ci_usuario, user, password) VALUES ('$id_usuario','$nombre_usuario' , '$ap_paterno_usuario', '$ap_materno_usuario', '$ci_usuario', '$user', '$password');";
                                    mysql_query($sql); 

                                    $rs=mysql_query("SELECT MAX(id_empleado_usuario) AS id FROM empleado_usuario");
                                    if ($row = mysql_fetch_row($rs)) 
                                      {
                                        $id_empleado_usuario = trim($row[0]);
                                      }
                                    $id_empleado_usuario=$id_empleado_usuario+1;
                                    $r=mysql_query("SELECT id_empleado FROM empleado where cargo='$cargo'");
                                    if ($row = mysql_fetch_row($r)) 
                                      {
                                        $id_empleado = trim($row[0]);
                                      }



                                    $sq="INSERT INTO empleado_usuario (id_empleado_usuario, id_empleado, id_usuario, estado) VALUES ('$id_empleado_usuario', '$id_empleado','$id_usuario','ACTIVO')"; 
                                    mysql_query($sq); 

                      
                                    $mensaje = "Usted se ha registrado correctamente.";
                                    print "<script>alert('$mensaje'); window.location='lista_usuario.php';</script>";
                                  } 


                                  else 
                                  { 
                                      $mensaje = "Este usuario se ha registrado anteriormente.";
                                      print "<script>alert('$mensaje'); window.location='principal_administrador.php';</script>";
                                  } 
                                }
                            } 
                        } 
                      ?>
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
