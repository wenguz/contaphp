<?php
session_start();
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

    <title>Index</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

    <div id="login-page">
      <div class="container">

          <form class="form-horizontal style-form" action="" method="post">
            <div>
                    <br><br>
                    <div>
                        <div class="modal-content">
                            <div class="modal-header">
                               <center> <h4 style="font-size: 20px;" class="modal-title"> REGISTRO DE ENTIDAD </h4></center>
                            </div>
                            <div class="modal-body">
                                <table width="90%" >
                                <tr>
                                    <td width="10%"></td>
                                      <td>
                                        <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de la entidad</h4>
                                        <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Nombre: </label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" name="nombre_entidad" required="true">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Direccion: </label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" name="direccion_entidad" required="true">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Telefono: </label>
                                          <table>
                                            <tr>
                                              <td>
                                                <div class="col-sm-10">
                                                  <input type="tel" placeholder="fono1" class="form-control" name="fono1" required="true" onkeypress="return valida(event)">
                                                </div>
                                              </td>
                                              <td>
                                                <div class="col-sm-10">
                                                  <input type="text" placeholder="fono2" class="form-control" name="fono2" onkeypress="return valida(event)">
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Ciudad: </label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" name="ciudad_entidad" required="">
                                          </div>
                                        </div>
                                        <h4 class="mb"><i class="fa fa-angle-right"></i> Datos del responsable</h4>
                                        <table >
                                            <tr>
                                              <td></td>
                                              <td width="50%">

                                              <div class="form-group">
                                                  <label class="col-sm-2 col-sm-2 control-label">Codigo:&emsp; </label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control" name="codigo_usuario" disabled="true" value=
                                                      <?php

                                                      $rs=mysqli_query($con,"SELECT MAX(id_usuario) AS id FROM usuario");
                                                      if ($row = mysqli_fetch_row($rs))
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

                                              </td>
                                              <td>
                                              </td>
                                              <td width="40%">
                                                &emsp;
                                                <div class="form-group">
                                                  <label class="col-sm-2 col-sm-2 control-label">CI:&emsp; </label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control" name="ci_usuario" onkeypress="return valida(event)">
                                                  </div>
                                              </div>
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
                                              </td>
                                            </tr>
                                          </table>
                                        <h4 class="mb"><i class="fa fa-angle-right"></i> Año y Periodo</h4>
                                        <table>
                                          <tr>
                                            <td>
                                              <div class="form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Año: </label>
                                                <div class="col-sm-10">
                                                 <input type="text" class="form-control" name="año" onkeypress="return valida(event)">
                                                </div>
                                              </div>
                                            </td>
                                            <td width="5%"></td>
                                            <td>
                                              <div class="form-group">
                                                <label class="col-sm-3 col-sm-3 control-label">Fecha_Inicio: </label>
                                                <div class="col-sm-8">
                                                 <input type="date" class="form-control" name="fecha_inicio">
                                                </div>
                                              </div>
                                            </td>
                                            <td width="5%">  </td>
                                            <td>
                                              <div class="form-group">
                                                <label class="col-sm-3 col-sm-3 control-label">Fecha_fin: </label>
                                                <div class="col-sm-8">
                                                 <input type="date" class="form-control" name="fecha_final">
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                              </table>

                            </div>
                            <div class="modal-footer">
                                <input type="submit"  class="btn btn-default" name="cancelar" value="CANCELAR">
                                <input type="submit"  class="btn btn-theme" name="registrar_datos" value="REGISTRAR DATOS">
                            </div>
                        </div>
                    </div>
                </div>






                <?php
                        //include('conexion.php');
                        if(isset($_POST['registrar_datos']))
                        {
                            if($_POST['nombre_entidad'] == '' or $_POST['nombre_usuario'] == '' or $_POST['año'] == '')
                            {
                                echo 'Por favor llene todos los campos.';
                            }
                            else
                            {



                                    $rs=mysqli_query($con,"SELECT MAX(id_entidad) AS iden FROM entidad");
                                    if ($row = mysqli_fetch_row($rs))
                                      {
                                        $iden = trim($row[0]);
                                      }
                                    $id_entidad=$iden+1;

                                    $nombre_entidad=$_POST['nombre_entidad'];
                                    $direccion_entidad=$_POST['direccion_entidad'];
                                    $fono1=$_POST['fono1'];
                                    $fono2=$_POST['fono2'];
                                    $ciudad_entidad=$_POST['ciudad_entidad'];

                                    //$mensaje = "ENTRO DATOS-----". $id_entidad." ------ ".$nombre_entidad."---------".$direccion_entidad."---------".$fono1."---------".$fono2."---------".$ciudad_entidad."---------";
                                    //print "<script>alert('$mensaje');</script>";

                                    $sqenti = "INSERT INTO entidad(id_entidad, nombre_entidad, direccion_entidad, fono1_entidad, fono2_entidad, ciudad_entidad) VALUES ('$id_entidad','$nombre_entidad' , '$direccion_entidad', '$fono1', '$fono2', '$ciudad_entidad');";
                                    mysqli_query($con,$sqenti);

                                    $mensaje = "ENTRO ENTIDAD".$sqenti."-------";
                                    print "<script>alert('$mensaje');</script>";

                                    $emp1="INSERT INTO empleado (id_empleado, cargo, id_entidad) VALUES ('1', 'ADMINISTRADOR', '$id_entidad')";
                                    mysqli_query($con,$emp1);
                                    $emp2="INSERT INTO empleado (id_empleado, cargo, id_entidad) VALUES ('2', 'CONTADOR', '$id_entidad')";
                                    mysqli_query($con,$emp2);
                                    $emp3="INSERT INTO empleado (id_empleado, cargo, id_entidad) VALUES ('3', 'SECRETARIA', '$id_entidad')";
                                    mysqli_query($con,$emp3);


                                   // $mensaje = "ENTRO EMPLEADO";
                                    //print "<script>alert('$mensaje');</script>";


                                    $rspp=mysqli_query($con,"SELECT MAX(id_periodo) AS idpa FROM periodo");
                                    if ($rowpp = mysqli_fetch_row($rspp))
                                      {
                                        $idpa = trim($rowpp[0]);
                                      }
                                    $id_periodo=$idpa+1;
                                    $año_periodo=$_POST['año'];
                                    $fecha_inicio_periodo=$_POST['fecha_inicio'];
                                    $fecha_cierre_periodo=$_POST['fecha_final'];

                                    $sper = "INSERT INTO periodo (id_periodo, anio_periodo, fecha_inicio_periodo, fecha_cierre_periodo, entidad_id_entidad) VALUES ('$id_periodo','$año_periodo','$fecha_inicio_periodo','$fecha_cierre_periodo','$id_entidad')";
                                    mysqli_query($con,$sper)or die(mysql_error());


                                    //$mensaje = "ENTRO PERIODO AÑO  ".$id_empleado."----------".$año_periodo."----------".$fecha_inicio_periodo."---------".$fecha_cierre_periodo."-------".$id_entidad."--------";
                                    //print "<script>alert('$mensaje');</script>";


                                  $sql = 'SELECT * FROM usuario';
                                  $rec = mysqli_query($con,$sql);
                                  $verificar_usuario = 0;

                                  while($result = mysqli_fetch_object($rec))
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


                                    $rs=mysqli_query($con,"SELECT MAX(id_usuario) AS id FROM usuario");
                                    if ($row = mysqli_fetch_row($rs))
                                      {
                                        $id = trim($row[0]);
                                      }
                                    $id_usuario=$id+1;



                                    $sql = "INSERT INTO usuario(id_usuario, nombre_usuario, ap_paterno_usuario, ap_materno_usuario, ci_usuario) VALUES ('$id_usuario','$nombre_usuario' , '$ap_paterno_usuario', '$ap_materno_usuario', '$ci_usuario');";
                                    mysqli_query($con,$sql);

                                    $rs=mysqli_query($con,"SELECT MAX(id_empleado_usuario) AS id FROM empleado_usuario");
                                    if ($row = mysqli_fetch_row($rs))
                                      {
                                        $id_empleado_usuario = trim($row[0]);
                                      }
                                    $id_empleado_usuario=$id_empleado_usuario+1;
                                    $r=mysqli_query($con,"SELECT id_empleado FROM empleado where cargo='$cargo'");
                                    if ($row = mysqli_fetch_row($r))
                                      {
                                        $id_empleado = trim($row[0]);
                                      }

                                    $sq="INSERT INTO empleado_usuario (id_empleado_usuario, id_empleado, id_usuario, estado, user, password) VALUES ('$id_empleado_usuario', '$id_empleado','$id_usuario','ACTIVO' , '$user', '$password')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_transaccion (id_tipo_transaccion,nombre_transaccion)values(1,'Ingreso')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_transaccion (id_tipo_transaccion,nombre_transaccion)values(2,'Egreso')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_transaccion (id_tipo_transaccion,nombre_transaccion)values(3,'Inversion');";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_transaccion (id_tipo_transaccion,nombre_transaccion)values(4,'Transferencia')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_pago (id_tipo_pago,tipo,descripcion_tipo_pago)values(1,'Caja', 'Ingreso')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_pago (id_tipo_pago,tipo,descripcion_tipo_pago)values(2,'Caja','Egreso')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_pago (id_tipo_pago,tipo,descripcion_tipo_pago)values(3,'Banco','Deposito')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO tipo_pago (id_tipo_pago,tipo,descripcion_tipo_pago)values(4, 'Banco','Retiro')";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Terrenos',40)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Edificaciones',40)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Muebles y enseres de oficina',10)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Maquinaria en General',8)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Equipos e  Instalaciones',8)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Vehículos',5)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Maquinaria para construccion',5)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Herramientas en general',4)";
                                    mysqli_query($con,$sq);
                                    $sq="INSERT INTO depreciacion (bien,vida_util)values('Equipos de Computacion',4)";
                                    mysqli_query($con,$sq);


                                    $mensaje = "Usted se ha registrado correctamente.";
                                    print "<script>alert('$mensaje'); window.location='lista_usuario.php';</script>";
                                  }


                                  else
                                  {
                                      $mensaje = "Este usuario se ha registrado anteriormente.";
                                      print "<script>alert('$mensaje'); window.location='index.php';</script>";
                                  }
                            }
                        }
                      ?>







          </form>

      </div>
    </div>
<br><br>
    <script>
    function valida(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }

        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
    </script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/fon.jpg", {speed: 500});
    </script>


  </body>
</html>
