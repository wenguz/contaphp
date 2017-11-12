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
            <a href="principal_secretaria.php">
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
                  <li ><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
                  <li ><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Egreso</a></li>
                  <li ><a  href="registrar_inversion.php"><i class="fa fa-list-alt"></i>Registrar Inversion</a></li>
              </ul>
          </li>

          
          <li class="sub-menu">
              <a class="active"  href="lista_ficha.php" >
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
       
    </ul>
</div>  
      </aside>
     

</section>

<section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i>Lista de fichas</h3>
          <div class="col-md-12">
              <div class="content-panel">
                  <table class="table table-bordered table-striped table-condensed">
                    <h4><i class="fa fa-angle-right"></i> Busqueda de fichas</h4>
                    &emsp;
                   

                    <form>
<tr>
                       <p>Ingrese codigo de ficha:  </p> &emsp;
                      <input style="padding: 5px" type="number" value="Buscar..." onfocus="if (this.value == 'Buscar...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Buscar...';}" />
                      <input class="btn btn-primary"  type="button" value="Buscar" />
                      <br>
                    </tr>
                    <tr>
                      <p>    Ingrese Fecha:  </p> &emsp;
                      <input type="date" name="fecha" placeholder="YYYY-MM-DD" class="form-input"/>
                      <input class="btn btn-primary"  type="button" value="Buscar" />
                    </tr>
                    </form>
                    <hr>
                      <thead >
                      <tr>
                          <td>Nro</th>
                          <td class="hidden-phone"> Cuenta</th>
                          <td> Concepto</th>
                          <td> Tipo de Pago</th>
                          <td> Monto</th>
                             <td>Fecha</th>
                          <td> Autorizado por...</th>
                          <td> Entregado por...</th>
                          <td> Recibido por...</th>
                          <td> Opciones</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td><a href="">1</a></td>
                          <td class="hidden-phone">b</td>
                          <td>b</td>
                          <td>b</td>
                          <td>b</td>
                          <td>b</td>
                          <td>b</td>
                          <td>b</td>
                          <td>
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"> Editar</i>
                            </button>
                            
                          </td>
                      </tr>
                      <tr>
                        <?php
                            if(isset($_POST['registrar_datos'])) 
                        { 
                         $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                          $cod=mysqli_query($con,"SELECT * FROM ficha");
                          while ($valores = mysqli_fetch_array($cod)) {
                                echo '<td >'.$valores[id_ficha].'</td>';
                                echo '<td >'.'Concepto '.'</td>';
                                echo '<td >'.$valores[id_tipo_pago].'</td>';
                                echo '<td >'.$valores[total_ficha].'</td>';
                                echo '<td >'.$valores[fecha_ficha].'</td>';
                                echo '<td >'.'aut'.'</td>';
                                echo '<td >'.'entre'.'</td>'; 
                                echo '<td >'.'rec'.'</td>'; 
                                echo '<td >'.$valores[id_persona].'</td>'; 
                              }
                            }
                        ?>
                       </tr>
                      </tbody>
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
