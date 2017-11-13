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
      
    <!--Ventana Emergente-->
                      
      
<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Ficha Ingreso</h3>
                                <hr>
                    <form action="" name="ASIENTOS" method="post">  
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Registrar Ingreso</h4>
                          </div>
                          <div class="modal-body">
                             
                               <label class="col-sm-1 col-sm-1 control-label">Cuenta:&emsp; </label>
                             <div class="col-sm-10">
                                <p>
                                  <select class="form-control" name="ri_cuenta" >
                            <?php
                                       $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                             $cod_cuenta=mysqli_query($con,"SELECT * FROM cuenta");
                                               
                                        while ($valores_cuenta = mysqli_fetch_array($cod_cuenta)) {
                                                    
                                          echo '<option value="'.$valores_cuenta[id_cuenta].'">'.$valores_cuenta[nombre_cuenta].'</option>';                
                                           
                                       }
                                      ?>
                                       </select>
                                </p>
                              </div>
                              <p>Concepto</p>
                              <input type="text" name="ri_concepto" placeholder=" " autocomplete="off" class="form-control placeholder-no-fix">
                              <p>Monto (Bs)</p>
                              <input type="number" name="ri_monto" placeholder=" "  class="form-control placeholder-no-fix">
                          </div>
                          <div class="modal-footer">
                              <input type="submit" name="" class="btn btn-theme" value="CANCELAR">
                              <input type="submit"  class="btn btn-theme" href="registrar_egreso.php" name="registrar_asientos" value="AGREGAR">
         <p><a href="registrar_ingreso.php">Cerrar </a></p>
                                     </div>
                      </div>
                  </div>
                  <?php
                           if(isset($_POST['registrar_asientos'])) 
                           {
                            include('conexion.php');
                          if($_POST['ri_cuenta'] == '' or  $_POST['ri_monto'] == ''or $_POST['ri_concepto'] == ''  )
                            { 
                                echo 'Por favor llene todos los campos.'; 
                            } 
                            else {
                                       $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                    $id_entidad0=1;
                              $rs0=mysqli_query($con,"SELECT count(id_as) AS iden FROM temp_as");
                                    if ($row0 = mysqli_fetch_row($rs0)) 
                                      {
                                        $iden0 = trim($row0[0]);
                                      }
                              $id_entidad0=$iden0+1;
                              $ri_cuenta =$_POST["ri_cuenta"] ;
                             $ri_monto =$_POST["ri_monto"] ;
                             $ri_concepto=$_POST["ri_concepto"] ;
                              $sq2= "INSERT INTO temp_as (id_as,glosa_asiento,monto_asiento,id_subcuenta   ) 
                                                    VALUES ( '$id_entidad0','$ri_concepto','$ri_monto','$ri_cuenta');";
                                              mysqli_query($con,$sq2)  ;  
                            }}
                          ?>
                  </form>
              </div>

                    <!--Fin de ventana emergente-->
                      
</section>

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
