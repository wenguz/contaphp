<?php
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");

}
$_SESSION["usuario"];
require('conexion.php');
error_reporting(E_ALL ^ E_NOTICE);
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
                  <li><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
                  <li ><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Egreso</a></li>
                  <li  class="active"><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Inversion</a></li>
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
      <h3><i class="fa fa-angle-right"></i>Ficha Inversion</h3>

            <div class="col-md-12">
              <div class="content-panel">

                    <h4><i class="fa fa-angle-right"></i> Registrar Inversión</h4>
                    <table class="">
                      <form action="" method="post">
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Fecha:&emsp; </label>
                            <div class="col-sm-10">
                              <?php
                              $hoy = date('Y-m-d');?>
                                <input required type="date" name ="fecha" class="form-control" value=<?php echo $hoy;?>>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Hora:&emsp; </label>
                            <div class="col-sm-10">
                              <?php
                              $time = time();?>
                                <input required type="time" disabled="true" name ="hora" class="form-control" value=<?php echo date("H:i:s", $time);?>>
                            </div>
                          </div>

                        </td>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <div class="form-group">
                              <label class="col-sm-4 col-sm-4 control-label">Nro. de comprobante:&emsp; </label>
                              <div class="col-sm-10">
                                  <?php
                                  $ficha=mysqli_query($con,"SELECT MAX(id_ficha) AS id FROM ficha");
                                  if ($row_f = mysqli_fetch_row($ficha))
                                  {
                                    $id = ($row_f[0]);
                                  }
                                  $id=$id+1;
                                  ?>
                                  <input required type="number" name ="numero_partida_ficha" class="form-control" value=<?php echo "$id";?>>
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
                                           $cod_cambio=mysqli_query($con,"SELECT   monto FROM tipo_cambio ORDER BY id_tipo_cambio DESC LIMIT 1 " );

                                          if ($row_cambio = mysqli_fetch_row($cod_cambio))
                                            {
                                              $iden_cambio = trim($row_cambio[0]);
                                            }
                                          echo '<input type="number"  step="any" class="form-control" name="cambio" value="'.$iden_cambio.'"> </input> ';
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
                                  <select class="form-control" name="moneda">
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
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_pago WHERE descripcion_tipo_pago='Egreso' or descripcion_tipo_pago='Retiro' ");

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
                            <label class="col-sm-10">Tipo de Transaccion:&emsp; </label>
                            <div class="col-sm-10">
                                      <?php
                                           $cod=mysqli_query($con,"SELECT * FROM tipo_transaccion WHERE id_tipo_transaccion='3'");

                                        while ($valores = mysqli_fetch_array($cod)) {
                                          ?>
                                              <input required type="" disabled="true" name ="name_trans" class="form-control" value="<?php echo $valores['nombre_transaccion'];?>"></input>

                                          <?php
                                       }
                                      ?>
                              </div>
                          </div>
                        </td>
                      </tr>

                    </table>
                    <table width="100%">
                    <tr>
                      <td> <div class="form-group">
                      <p class="col-sm-3 col-sm-3 control-label" >Tipo de Documento</p>
                       <div class="col-sm-10"> <input required type="text" name="ri_tipo" placeholder=" "  class="form-control placeholder-no-fix">
                        </div></div> </td><td>
                         <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >Num. Documento</p>
                        <div class="col-sm-10"> <input required type="number" name="ri_doc" placeholder=" "  class="form-control placeholder-no-fix">
                      </div>   </div></td>
                 </tr>
                    <tr>  <td colspan="2"> <div class="form-group">
                        <p class="col-sm-3 col-sm-3 control-label" >Descripcion del Documento</p>
                         <div class="col-sm-11"> <input required type="text" name="ri_doc_des" placeholder=" "  class="form-control placeholder-no-fix">
                    </div></div></td></tr>
                  </table>
                    <table class="table table-bordered table-striped table-condensed">
                      <hr>
                      <h4><i class="fa fa-angle-right"></i> Registrar Personal </h4>
                      <tr>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Pagado a...</label></center>

                                  <label class="col-sm-3 col-sm-3 control-label">Nombre:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input type="text" name="pag_nom"  class="form-control">
                                  </div>
                                  <label class="col-sm-3 col-sm-3 control-label">Ci:&emsp; </label>
                                  <div class="col-sm-9">
                                      <input required type="number" name="pag_ci" class="form-control">
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <center>
                                  <label style="font-size: 15px;">Autorizado por...</label></center>


                                  <div class="col-sm-9">

                                    <?php
                                    $datos=mysqli_query($con,"SELECT a.* FROM usuario a where id_usuario = '1' LIMIT 1");
                                    $row=mysqli_fetch_assoc($datos);
                                       ?>
                                          <p class="col-sm-3 col-sm-3 control-label">Nombre:&emsp; </p>
                                           <div class="col-sm-9">
                                           <input type="text" class="form-control" disabled="true" name="aut_nom" value="<?php echo $row['nombre_usuario']." ".$row['ap_paterno_usuario']; ?>"> </input> </div>
                                            <p class="col-sm-3 col-sm-3 control-label">CI:&emsp; </p>
                                           <div class="col-sm-9">
                                           <input type=""  class="form-control" disabled="true" name="aut_ci"  value="<?php echo $row['ci_usuario']; ?>"> </input> </div>
                                           <?php
                                       ?>

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
                                    $datos=mysqli_query($con,"SELECT a.* FROM usuario a, empleado_usuario b where b.user = '$user' and b.id_usuario = a.id_usuario LIMIT 1");
                                    $row=mysqli_fetch_assoc($datos);
                                       ?>
                                          <p class="col-sm-3 col-sm-3 control-label">Nombre:&emsp; </p>
                                           <div class="col-sm-9">
                                           <input type="text" class="form-control" disabled="true" name="p_nom" value="<?php echo $row['nombre_usuario']." ".$row['ap_paterno_usuario']; ?>"> </input> </div>
                                            <p class="col-sm-3 col-sm-3 control-label">CI:&emsp; </p>
                                           <div class="col-sm-9">
                                           <input type=""  class="form-control" disabled="true" name="p_ci"  value="<?php echo $row['ci_usuario']; ?>"> </input> </div>
                                           <?php
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
                         <input type="submit"  class="btn btn-theme" name="registrar_datos"  value="AGREGAR ">

                               </center></td>
                        </tr>

    <?php

/*********************************************************/
/*********************************************************/
if(isset($_POST['registrar_datos']))
{
  if($_POST['fecha'] == '' or  $_POST['pago'] == ''or  $_POST['cambio']== ''  or $_POST['numero_partida_ficha']=='' or $_POST['pag_nom']=='' )
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
    $trans =3 ;
    $cambio =$_POST["cambio"] ;
    $moneda =$_POST["moneda"] ;
    $partida=$_POST["numero_partida_ficha"];
    //modena
    if ($moneda==0)
    {
      $tot=$cambio;
    }
    else
    {
      $tot=1;
    }
    $user= $_SESSION["usuario"];
    $pag_nom=$_POST["pag_nom"];
    $pag_ci=$_POST["pag_ci"];

    //persona pagado por
    $cod_p=mysqli_query($con,"SELECT   id_persona FROM persona WHERE nombre_persona='$pag_nom' LIMIT 1");
    if ($row_p = mysqli_fetch_row($cod_p))
    {
      $id_persona = trim($row_p[0]);
    }
    else
    {
      $cod_p=mysqli_query($con,"SELECT   MAX(id_persona) FROM persona");
      if ($row_p = mysqli_fetch_row($cod_p))
      {
        $id = trim($row_p[0]);
      }
      $id_persona = $id+1;
      $sq_p= "INSERT INTO persona(id_persona,nombre_persona,ci_persona,descripcion_persona)
      VALUES ('$id_persona','$pag_nom','$pag_ci','Pagado');";
      mysqli_query($con,$sq_p)  ;
    }

    //tipo de cambio
    $cod_c=mysqli_query($con,"SELECT   id_tipo_cambio FROM tipo_cambio WHERE monto='$cambio' LIMIT 1");

    if ($row_c = mysqli_fetch_row($cod_c))
    {
      $id_cambio = trim($row_c[0]);
    }
    else
    {
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
    $id_cef2=0; $id_cef=0;


    //Elaborado
    //empleado Elaborado
    $user= $_SESSION["usuario"];
    {
       $cod_pp=mysqli_query($con,"SELECT MAX(id_empleado_ficha) as id FROM empleado_ficha") or die(mysqli_error($con));
       if ($row_pp = mysqli_fetch_row($cod_pp))
         {
           $idy = ($row_pp[0]);
         }
         $id_empleado = $idy+1;
         $datos=mysqli_query($con,"SELECT id_empleado_usuario FROM empleado_usuario where user = '$user'") or die(mysqli_error($con));
         $row_eusu=mysqli_fetch_assoc($datos);
         $abc=$row_eusu['id_empleado_usuario'];

       $sq_p= "INSERT INTO empleado_ficha(id_empleado_ficha,descripcion_empleado,id_ficha,id_empleado_usuario)
       VALUES('$id_empleado','Elaborado','$id_entidad','$abc')";
       mysqli_query($con,$sq_p) or die(mysqli_error($con));
    }
    //empleado autorizado
    {
       $cod_pp=mysqli_query($con,"SELECT MAX(id_empleado_ficha) as id FROM empleado_ficha") or die(mysqli_error($con));
       if ($row_pp = mysqli_fetch_row($cod_pp))
         {
           $idy = ($row_pp[0]);
         }
         $id_empleado = $idy+1;

       $sq_p= "INSERT INTO empleado_ficha(id_empleado_ficha,descripcion_empleado,id_ficha,id_empleado_usuario)
       VALUES('$id_empleado','Autorizado','$id_entidad','1')";
       mysqli_query($con,$sq_p) or die(mysqli_error($con));
    }

    // realiza el ingreso a la tabla documento_extra
    $ri_tipo=$_POST["ri_tipo"] ;
    $ri_doc=$_POST["ri_doc"] ;
    $ri_doc_des=$_POST["ri_doc_des"] ;
    $rsd=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
    if ($rowd = mysqli_fetch_row($rsd))
      {
        $iden = trim($rowd[0]);
      }
       $iden2 =0;
      $rsd2=mysqli_query($con,"SELECT MAX(id_documento_extra)  FROM documento_extra");
    if ($rowd2 = mysqli_fetch_row($rsd2))
      {
        $iden2 = $rowd2[0];
      }
      $id_doc_new= $iden2 +1;
    $sq3= "INSERT INTO documento_extra (  id_documento_extra,codigo_documento,tipo,descripcion, id_ficha   )
                            VALUES ( '$id_doc_new','$ri_doc','$ri_tipo','$ri_doc_des','$iden');";
                      mysqli_query($con,$sq3)  or die(mysqli_error($con));



    $msg = 'Inversion agregada correctamente';
    print "<script>alert('$msg'); window.location='emergente_inversion.php';</script>";
  }
}

?>

                            </form>
                          </table>
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
