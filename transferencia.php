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
            <a  href="javascript:;" >
                  <i class="fa fa-list-alt"></i>
                  <span>Registrar Fichas</span>
              </a>
              <ul class="sub">
                  <li><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
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
              <a   class="active"href="transferencia.php" >
                  <i class="fa fa-th"></i>
                  <span>Transferencia</span>
              </a>
          </li>
           
    </ul>
</div>  
      </aside>
     

</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Transferencia</h3>
          <div class="col-md-12">
              <div class="content-panel">

                    <h4><i class="fa fa-angle-right"></i> Registrar Transferencia</h4>
                    <table>
                      <tr>
                        <td width="75%"></td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Fecha:&emsp; </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control">
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table width="80%">
                      <hr>
                      <form class="form-horizontal style-form" method="get">
                          <table width="80%" class="table table-bordered table-striped table-condensed" >
                            <tr>
                              <td>
                                <div class="form-group">
                                  <center><br>
                                  <label style="font-size: 15px;">CAJA</label></center>
                                  <div class="radio">
                                    &emsp;<label>
                                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                      Ingreso
                                    </label>
                                  </div>
                                  <div class="radio">
                                    &emsp;<label>
                                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                      Egreso
                                    </label>
                                  </div>

                                  <label class="col-sm-2 col-sm-2 control-label">Monto:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                  
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <center><br>
                                  <label style="font-size: 15px;">BANCO</label></center>
                                  <div class="radio">
                                    <label>
                                      &emsp;<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                      Deposito
                                    </label>
                                  </div>
                                  <div class="radio">
                                    &emsp;<label>
                                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                      Retiro
                                    </label>
                                  </div>
                                  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Número de cuenta: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Banco: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control">
                              </div>
                            </div> <hr>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Monto: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control">
                              </div>
                            </div>
                              </td>
                              
                            </tr>

                            <tr>
                              <td colspan="4">
                                <hr></td>
                        </tr>



                             <tr>
                              
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Autorizado por...</label></center>
                                  
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
                                  </div>
                                  <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control">
                                  </div>
                                </div>
                              </td>
                              <td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <hr>
                                <center>
                            &emsp;<button type="button" class="btn btn-success">Transferir</button>
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
