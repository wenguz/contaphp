<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");
    
}
$_SESSION["usuario"];
?>
<!DOCTYPE html>
<html lang="en"   >
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
                        <h6>  * Llenar todos los espacios vacios obligatoriamente</h6>
                    <table class="">
                      <form action="" method="post">
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-3 col-sm-3 control-label"  >Fecha:&emsp; 
                                <input required type="date" name="fecha" placeholder="YYYY-MM-DD" min="2017-01-01" class="form-input"/>
                            </label>
                            
                          </div>
                        </td>
                        <td colspan="2">
                          <div class="col-sm-3 col-sm-3 control-label">
                              Hora:
                                <p  readonly="readonly" type="time" class="form-control"   ><a><?php  
                                  $time = time();
                                  echo date("H:i:s", $time); 
                                    ?></a></p>
                                
                            </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Nro. de comprobante:&emsp; </label>
                            <div class="col-sm-10">
                                <input required type="number" name ="numero_partida_ficha" class="form-control">
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-10">Tipo de Cambio:&emsp; </label>
                            <div class="col-sm-10">
                                <p>
                                  
                                      <?php
                                           $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                           $cod=mysqli_query($con,"SELECT   monto FROM tipo_cambio ORDER BY id_tipo_cambio DESC LIMIT 1 " );

                                          if ($row = mysqli_fetch_row($cod)) 
                                            {
                                              $iden = trim($row[0]);
                                            } 
                                          echo '<input required type="number" step="any" class="form-control" name="cambio" value="'.$iden.'"> </input> ';
                                      ?>
                                  
                                </p>
                              </div>
                            </div> 
                        </td>
                        <td>
                          <div class="form-group">
                              <label class="col-sm-10">Moneda:   &emsp; </label>
                              <div class="col-sm-10">
                                <p> 
                                  <select required class="form-control" name="moneda">
                                        <option value="1">Bs.</option>
                                       <option value="0">$us.</option>
                                  </select>
                                </p>
                              </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                              <label class="col-sm-10" >Destino de Pago :&emsp; </label>

                              <div class="col-sm-10">
                                <p>
                                  <select  required class="form-control" name="pago">
                                      <?php
                                           $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_pago WHERE descripcion_tipo_pago='Ingreso' or descripcion_tipo_pago='Deposito' ");
                                            
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
                            <label class="col-sm-10">Tipo de ingreso:&emsp; </label>
                            <div class="col-sm-10">
                                <p>
                                  <select  readonly="readonly" class="form-control" name="trans" >
                                      <?php
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_transaccion WHERE id_tipo_transaccion='121'");
                                               
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
                      
                    </table>
                    <table class="table table-bordered table-striped table-condensed">
                      <hr>
                      <table class="table table-bordered table-striped table-condensed">
                            <tr>
                                <h4><i class="fa fa-angle-right"></i> Registrar Personal </h4>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Recibido por...</label></center>
                                  
                                  <label class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input  required type="text" name="p_nom" class="form-control">
                                  </div>
                                  <label class="col-sm-2 col-sm-2 c
                                  ontrol-label">CI:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input  required type="text" name="p_ci" class="form-control">
                                  </div>
                                </div>
                              </td>
                              
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Elaborado por...</label></center>
                                  
                                  
                                  <div class="col-sm-9">
                                      
                                       <?php
                                       $user= $_SESSION["usuario"];
                                        $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                           $cod_user=mysqli_query($con,"SELECT   ci_usuario FROM usuario WHERE nombre_usuario='$user' LIMIT 1");

                                          if ($row_user = mysqli_fetch_row($cod_user)) 
                                            {
                                              $iden = trim($row_user[0]);
                                            }  
                                             
                                             echo '<p class="col-sm-2 col-sm-2 control-label">Nombre:&emsp; </p>
                                              <div class="col-sm-9">
                                              <input type="text" step="any" class="form-control"  readonly="readonly" name="p_nom" value="'.$user.'"> </input> </div>';
                                               echo '<p class="col-sm-2 col-sm-2 control-label">CI:&emsp; </p>
                                              <div class="col-sm-9">
                                              <input type="number" step="any" class="form-control" name="p_ci"   readonly="readonly" value="'.$iden.'"> </input> </div>';
                                              
                                          ?>
                                  </div>
                                   
                                </div>
                              </td>
                            </tr>
                    </table>
                     
                          
                            <tr>
                              <td colspan="4">
                                <hr>
                                <center>
                             <input type="submit"  class="btn btn-danger"  onClick="document.location.reload();"  name="cancelar" value="CANCELAR"> 
                         <input type="submit"  class="btn btn-theme" name="registrar_datos"  value="AGREGAR CUENTAS">

                          </center></td>
                        </tr>

  <?php
                           if(isset($_POST['registrar_datos'])) 
                        { 
                          
                         include('conexion.php');
                          
                            if($_POST['fecha'] == '' or  $_POST['pago'] == ''or $_POST['trans'] == '' or $_POST['cambio']== ''  or $_POST['numero_partida_ficha']=='' )
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
                          $trans =$_POST["trans"] ;
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
                           $cod_p=mysqli_query($con,"SELECT   id_persona FROM persona WHERE ci_persona='$p_ci' LIMIT 1");

                                          if ($row_p = mysqli_fetch_row($cod_p)) 
                                            {
                                              $id_persona = trim($row_p[0]);
                                            }
                                            else {
                                              $cod_p=mysqli_query($con,"SELECT   MAX(id_persona) FROM persona");
                                              if ($row_p = mysqli_fetch_row($cod_p)) 
                                                {
                                                  $id = trim($row_p[0]);
                                                }
                                                $id_persona = $id+1;
                                              $sq_p= "INSERT INTO persona(id_persona,nombre_persona,ci_persona,descripcion_persona) 
                                                    VALUES ('$id_persona','$p_nom','$p_ci','Recibio');";
                                              mysqli_query($con,$sq_p)  ;   
                                            }
            //tipo de cambio 
                           $cod_c=mysqli_query($con,"SELECT   id_tipo_cambio FROM tipo_cambio WHERE monto='$cambio' LIMIT 1");

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

                              VALUES ('$id_entidad','$partida','$fechai','$hora','$tot','0','0','$trans','$id_cambio','$pago','$id_persona');";
                         
                            mysqli_query($con,$sq)  ;       
                             
                            $msg = 'Cargo agregado correctamente';
                            print "<script>alert('$msg'); window.location='emergente_ingreso.php';</script>";
                             } 
                        }else{  
                        if(isset($_POST['cancelar'])) 
                        { 

                          print "<script> window.location='registrar_ingreso.php';</script>";
                        }
                        }

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
