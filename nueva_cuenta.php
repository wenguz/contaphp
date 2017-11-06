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
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Nueva Cuenta </h4>
                    
                      <table class="table table-bordered table-striped table-condensed">
                        <tr>
                          <td width="50%">
                            <form class="form-horizontal style-form" method="post">
                              <div class="form-group">
                                <center>
                                <label style="font-size: 20px;"> CLASES</label></center>
                                
                                <label class="col-sm-4 col-sm-4 control-label">Codigos disponibles: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="codigo_clase">
                                        <?php
                                          $cod=mysql_query("SELECT max(id_clase) as id FROM clase");
                                          if ($row = mysql_fetch_row($cod)) 
                                          {
                                            $id = trim($row[0]);
                                          }
                                          $id_clase=$id+1;

                                              while ($id_clase<=9) 
                                              {
                                                  ?>
                                                      <option><?php echo $id_clase; ?></option>
                                          <?php 
                                              $id_clase+=1;
                                              } 
                                          ?>
                                      </select>
                                    </p>
                                </div>
                                <label class="col-sm-4 col-sm-4 control-label">Nombre de la clase: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_clase">
                                </div>
                              </div> 
                              <br><br>
                              <center>
                                <input type="submit" class="btn btn-success" name="registrar_clase" value="Registrar Clase">
                                &emsp;&emsp;
                                <input type="submit" class="btn btn-danger"  name="cancelar" value="Cancelar">
                              </center>
                              <br>
                              <?php 
                                if(isset($_POST['registrar_clase'])) 
                                {
                            
                                  //$mensaje = "Usted se ha registrado correctamente la CLASE.-------------ENTRO A";
                                  //print "<script>alert('$mensaje');</script>";
                                    
                                    $id_clase = $_POST['codigo_clase'];
                                    $nombre_clase = $_POST['nombre_clase'];
                                    $hoy = date('Y-m-d');

                                    $sql = "INSERT INTO clase(id_clase, nombre_clase, estado_clase, fecha_registro_clase) VALUES ('$id_clase','$nombre_clase' , 'ACTIVO', '$hoy');";
                                    mysql_query($sql); 

                                    $mensaje = "Usted se ha registrado correctamente la CLASE.";
                                    print "<script>alert('$mensaje'); window.location='lista_cuenta.php';</script>"; 
                                }
                                else
                                {
                                  if(isset($_POST['cancelar'])) 
                                  {
                                    print "<script>window.location='lista_cuenta.php';</script>";
                                  }
                                }
                              ?>
                            </form>
                          </td>
                          <td width="50%">
                            <form class="form-horizontal style-form" method="post">
                              <div class="form-group">
                                <center>
                                <label style="font-size: 20px;"> GRUPOS</label></center>
                                
                                <label class="col-sm-4 col-sm-4 control-label">Seleccione Clase: </label>
                                    <div class="col-sm-8">
                                      <p>
                                        <form method="post"> 
                                          <table>
                                            <tr>
                                              <td>
                                                <select class="form-control" name="grupo_clase">
                                                  <?php
                                                  $sqlclase=mysql_query("SELECT * FROM clase");
                                                  while ($rowclase = mysql_fetch_assoc($sqlclase)) 
                                                  {
                                                  ?>
                                                    <option><?php echo $rowclase['id_clase']." .- ".$rowclase['nombre_clase']; ?></option>
                                                  <?php 
                                                  }
                                                  $nn=$rowclase['id_clase'];
                                                  ?>
                                                </select>
                                              </td>
                                              <td width="18%">
                                                <input class="btn btn-success btn-xs" type="submit"  name="check_grupo_clase" value="Añadir">
                                              </td>
                                            </tr>
                                          </table>
                                          
                                        </form>
                                      </p>
                                    </div>
                                  
                                    <label class="col-sm-4 col-sm-4 control-label">Codigos disponibles: </label>
                                    <div class="col-sm-7">
                                        <p>
                                          <select class="form-control" name="codigo_grupo">
                                            <?php
                                            if(isset($_POST['check_grupo_clase'])) 
                                            {
                                              $grupo_clase=$_POST['grupo_clase'];
                                              $grupo_cod_disp=("SELECT * FROM grupo WHERE id_clase='$grupo_clase'");
                                              $rrr=mysql_query($grupo_cod_disp);
                                              if(mysql_num_rows($rrr)==0)
                                              {
                                                $cod_grupo=0;
                                                while ($cod_grupo<=9) 
                                                {
                                                  ?>
                                                    <option><?php echo $grupo_clase." ".$cod_grupo; ?></option>
                                                  <?php 
                                                    $cod_grupo+=1;
                                                } 

                                              }
                                              else
                                              {
                                                $cod_grupo=0;
                                                while ($cod_grupo<=9) 
                                                {
                                                  $existe=mysql_query("SELECT * FROM grupo WHERE id_grupo='$cod_grupo'");
                                                  if(mysql_num_rows($existe)!=0)
                                                  {
                                                    $cod_grupo+=1;
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <option><?php echo $cod_grupo; ?></option>
                                                  <?php 
                                                    $cod_grupo+=1;
                                                  }
                                                }
                                              }}
                                              ?>
                                          </select>
                                        </p>
                                    </div>

                                <label class="col-sm-4 col-sm-4 control-label">Nombre del grupo: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nombre_grupo">
                                </div>
                              </div> 
                              
                              <center>
                                <input type="submit" class="btn btn-success" name="registrar_grupo" value="Registrar Grupo">
                                &emsp;&emsp;
                                <input type="submit" class="btn btn-danger"  name="cancelar" value="Cancelar">
                              </center>
                              <br>

                              <?php 
                                if(isset($_POST['registrar_grupo'])) 
                                {
                            
                                  $mensaje = "Usted se ha registrado correctamente EL GRUPPO.-------------ENTRO A";
                                  print "<script>alert('$mensaje');</script>";
                                    
                                    $id_clase = $_POST['grupo_clase'];
                                    $id_grupo = $_POST['codigo_grupo'];
                                    $nombre_grupo = $_POST['nombre_grupo'];
                                    $hoy = date('Y-m-d');

                                    $sql = "INSERT INTO grupo(id_grupo, nombre_grupo, estado_grupo, fecha_registro_grupo, id_clase) VALUES ('$id_grupo','$nombre_grupo' , 'ACTIVO', '$hoy', '$id_clase');";
                                    mysql_query($sql); 

                                    $mensaje = "Usted se ha registrado correctamente el GRUPO.";
                                    print "<script>alert('$mensaje'); window.location='lista_cuenta.php';</script>"; 
                                }
                                else
                                {
                                  if(isset($_POST['cancelar'])) 
                                  {
                                    print "<script>window.location='lista_cuenta.php';</script>";
                                  }
                                }
                              ?>

                            </form>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <form class="form-horizontal style-form" method="post">
                              <div class="form-group">
                                <center>
                                <label style="font-size: 20px;"> CUENTAS </label></center>
                                
                                <label class="col-sm-4 col-sm-4 control-label">Clase: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="clase">
                                          <?php
                                            $resultado1=mysql_query("SELECT * FROM clase");
                                                while ($row1 = mysql_fetch_assoc($resultado1)) 
                                                {
                                                    ?>
                                                        <option ><?php echo $row1['id_clase']." .- ".$row1['nombre_clase'];?></option>    
                                                <?php }
                                          ?>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Grupo: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="grupo">

                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Codigo disponible: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="codigo_cuenta">
                                            <?php
                                            $consul="SELECT * FROM grupo";
                                            $rrr=mysql_query($consul);
                                            if(mysql_num_rows($rrr)==0)
                                            {
                                              $id_grupo=0;
                                                while ($id_grupo<=9) 
                                                  {
                                                      ?>
                                                          <option><?php echo $id_grupo; ?></option>
                                              <?php 
                                                  $id_grupo+=1;
                                                  }
                                            }
                                            else
                                            {
                                              $cod=mysql_query("SELECT max(id_grupo) as idg FROM grupo");
                                              if ($row = mysql_fetch_row($cod)) 
                                              {
                                                $idg = trim($row[0]);
                                              }
                                              $id_grupo=$idg+1;
                                                  while ($id_grupo<=9) 
                                                  {
                                                      ?>
                                                          <option><?php echo $id_grupo; ?></option>
                                              <?php 
                                                  $id_grupo+=1;
                                                  } 
                                              
                                            }
                                          ?>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Nombre de la cuenta: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                              </div> 
                              <br><br><br>
                              <center>
                                <input type="submit" class="btn btn-success" name="registrar_cuenta" value="Registrar Cuenta">
                                &emsp;&emsp;
                                <input type="submit" class="btn btn-danger"  name="cancelar" value="Cancelar">
                              </center>
                              <br>
                            </form>
                          </td>
                          <td>
                            <form class="form-horizontal style-form" method="post">
                              <div class="form-group">
                                <center>
                                <label style="font-size: 20px;"> SUBCUENTA </label></center>
                                
                                <label class="col-sm-4 col-sm-4 control-label">Clase: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="cargo">
                                            <option>1</option>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Grupo: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="cargo">
                                            <option>1</option>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Cuenta: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="cargo">
                                            <option>1</option>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Codigo disponible: </label>
                                <div class="col-sm-7">
                                    <p>
                                      <select class="form-control" name="cargo">
                                            <option>1</option>
                                      </select>
                                    </p>
                                </div>

                                <label class="col-sm-4 col-sm-4 control-label">Nombre de la Subcuenta: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                              </div> 

                              <center>
                                <input type="submit" class="btn btn-success" name="registrar_subcuenta" value="Registrar Subcuenta">
                                &emsp;&emsp;
                                <input type="submit" class="btn btn-danger"  name="cancelar" value="Cancelar">
                              </center>
                              <br>
                            </form>
                          </td>
                        </tr>
                      </table>
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
