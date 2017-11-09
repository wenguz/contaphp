<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");
    
}
$_SESSION["usuario"];
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
    <style type="text/css">
      
      tfoot {
        text-align: right;
        background: #4b5c4e;
        font-size: 15px;
        color:white;
      }

    </style>
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
            <a  href="principal_secretaria.php">
                <i class="fa fa-home">    </i>
                <span>Inicio  </span>
            </a>
        </li>
        
        <li class="sub-menu">
            <a  class="active" href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Registrar Fichas</span>
              </a>
              <ul class="sub">
                  <li class="active"><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
                  <li ><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Egreso</a></li>
                  <li ><a  href="registrar_inversion.php"><i class="fa fa-list-alt"></i>Registrar Inversion</a></li>
              </ul>
          </li>

          
          <li class="sub-menu">
              <a href="lista_ficha.php" >
                  <i class="fa fa-th"></i>
                  <span>Lista de Fichas</span>
              </a>
          </li>
          <li class="sub-menu">
              <a href="transferencia.php" >
                  <i class="fa fa-th"></i>
                  <span>Transferencia</span>
              </a>
          </li>
          <li class="sub-menu">
              <a href="transaccion.php" >
                  <i class="fa fa-th"></i>
                  <span>Transacciones</span>
              </a>
          </li>
    </ul>
</div>  
      </aside>
     

</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Ficha Ingreso</h3>
          <div class="col-md-12">
              <div class="content-panel">

                    <h4><i class="fa fa-angle-right"></i> Registrar Ingreso</h4>

                    <table class="">
                      <form action="" method="post">
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-3 col-sm-3 control-label"  >Fecha:&emsp; 
                                <input type="date" name="fecha" placeholder="YYYY-MM-DD" class="form-input"/>
                            </label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control"   ><a><?php  
                                  $time = time();
                                  echo date("H:i:s", $time); 
                                    ?></a></input>
                                
                            </div>
                          </div>
                        </td>
                        <td colspan="2">
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Nro._de_comprobante:&emsp; </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-3 col-sm-3 control-label">Tipo de Cambio:&emsp; </label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="cambio">
                                      <?php
                                           $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_cambio");
                                            
                                        while ($valores = mysqli_fetch_array($cod)) {
                                                    
                                          echo '<option value="'.$valores[id_tipo_cambio].'">'.$valores[monto].'</option>';                
                                           
                                       }
                                      ?>
                                  </select>
                                </p>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Moneda:   &emsp; </label>
                              <div class="col-sm-10">
                                <p><br>
                                  <select class="form-control" name="cargo">
                                        <option>Bs.</option>
                                       <option>$us.</option>
                                  </select>
                                </p>
                              </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                              <label class="col-sm-4 col-sm-4 control-label" >Forma de Pago :&emsp; </label>

                              <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="pago">
                                      <?php
                                           $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_pago");
                                            
                                        while ($valores = mysqli_fetch_array($cod)) {
                                                    
                                          echo '<option value="'.$valores[id_tipo_pago].'">'.$valores[tipo].'</option>';                
                                           
                                       }
                                      ?>
                                  </select>
                                </p>
                              </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Tipo de ingreso:&emsp; </label>
                            <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="trans">
                                      <?php
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_transaccion");
                                               
                                        while ($valores = mysqli_fetch_array($cod)) {
                                                    
                                          echo '<option value="'.$valores[id_tipo_transaccion].'">'.$valores[nombre_transaccion].'</option>';                
                                           
                                       }
                                      ?>
                                  </select>
                                </p>
                              </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                          <div class="form-group">
                            <label class="col-sm-1 col-sm-1 control-label">Cuenta:&emsp; </label>
                             <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="cuenta" >
                            <?php
                                             $cod=mysqli_query($con,"SELECT * FROM cuenta");
                                               
                                        while ($valores = mysqli_fetch_array($cod)) {
                                                    
                                          echo '<option value="'.$valores[id_cuenta].'">'.$valores[nombre_cuenta].'</option>';                
                                           
                                       }
                                      ?>
                                       </select>
                                </p>
                              </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-bordered table-striped table-condensed">
                      <hr>
                    </table>
                    <table class="table table-bordered table-striped table-condensed">
                            <h4><i class="fa fa-angle-right"></i> Detalle</h4>
                            
                              <thead >
                              <tr>
                                  <td>Codigo</th>
                                  <td class="hidden-phone"> Cuenta</th>
                                  <td> Concepto</th>
                                  <td> Monto</th>
                              </tr>
                              </thead>
                              <tfoot >
                                <tr>
                                  <td colspan="3">Total</th>
                                  <td> 200</th>
                                </tr>

                              </tfoot>

                              <tbody>
                              <tr>
                                  <td><a href="">1</a></td>
                                  <td class="hidden-phone">b</td>
                                  <td>b</td>
                                  <td>200</td>
                              </tr>
                              </tbody>
                          </table>
                          <!--Ventana Emergente-->
                          <!-- inicio Boton de Ventana Emergente-->
                          <td colspan="4">
                                <hr>
                                <center>
                            &emsp;<button type="button"  data-toggle="modal"class="btn btn-success" href="login.html#myModal">Agregar Cuenta</button>
                           
                           </center></td>
                           <!--fin Boton de Ventana Emergente-->
                            


                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Registrar Ingreso</h4>
                          </div>
                          <div class="modal-body">
                              <p>Cuenta</p>
                              <input type="text" name="ri_cuenta" placeholder="" autocomplete="off" class="form-control placeholder-no-fix">
                              <p>Concepto</p>
                              <input type="text" name="ri_concepto" placeholder=" " autocomplete="off" class="form-control placeholder-no-fix">
                              <p>Monto (Bs)</p>
                              <input type="number" name="ri_monto" placeholder=" " autocomplete="off" class="form-control placeholder-no-fix">
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                              <button class="btn btn-theme" type="button">Agregar</button>
                          </div>
                      </div>
                  </div>
              </div>

                    <!--Fin de ventana emergente-->
                        </tr>
                          <table class="table table-bordered table-striped table-condensed">
                            <hr>
                          </table>
                          <table class="table table-bordered table-striped table-condensed">
                            <tr>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Recibido por...</label></center>
                                  
                                  <label class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                  <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Pagado a...</label></center>
                                  
                                  <label class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                  <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Elaborado por...</label></center>
                                  
                                  <label class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                       <?php
                                      $user= $_SESSION["usuario"];
                                       
                                            echo $user;   
                                              
                                          ?>
                                  </div>
                                  <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <hr>
                                <center>
                            <input type="submit"  class="btn btn-theme" name="registrar_datos" value="REGISTRAR DATOS"> 
                          <button type="button" class="btn btn-danger">Cancelar

                          </button></center></td>
                         
                        </tr>
                         <?php
                           if(isset($_POST['registrar_datos'])) 
                        { 
                         
                         $fechai ="";
                         $id_entidad="";
                         $pago="";
                         include('conexion.php');
                         
                            if($_POST['fecha'] == '' or  $_POST['pago'] == ''or $_POST['trans'] == '' or $_POST['cambio']== '' or$_POST['cuenta']== '')
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
                          $id_entidad=$iden+1;
                          $fechai =$_POST["fecha"] ;
                          $pago =$_POST["pago"] ;
                          $trans =$_POST["trans"] ;
                          $cambio =$_POST["cambio"] ;
                          $cuenta =$_POST["cuenta"] ;
                           $time = time();
                           $hora= date("H:i:s", $time);
                          // echo date("d-m-Y (H:i:s)", $time); 
                             echo 'entro'; 
                          $sqenti = "INSERT INTO ficha(id_ficha, numero_partida_ficha, fecha_ficha, tiempo_ficha, total_ficha, total_debe_ficha, total_haber_ficha, id_tipo_transaccion, id_tipo_cambio, id_tipo_pago, id_persona) 
                          VALUES ($id_entidad,'$id_entidad','$fechai','$hora',2,1,1,'$trans','$cambio','$pago',100);";
                           
                                    mysqli_query($con,$sqenti); 
                           
                                    $mensaje = "ENTRO ENTIDAD".$sqenti."-------";
                                    print "<script>alert('$mensaje');</script>";
                        
                             }  }
                         ?>
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
