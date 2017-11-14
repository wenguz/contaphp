<?php $cuota_a=0;
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
        <h5 class="centered">Usuario: <?php  echo $_SESSION["usuario"]; ?></h5>
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
                  <li ><a  href="registrar_ingreso.php"><i class="fa fa-list-alt"></i>Registrar Ingreso</a></li>
                  <li ><a  href="registrar_egreso.php"><i class="fa fa-list-alt"></i>Registrar Egreso</a></li>
                  <li class="active" ><a  href="registrar_inversion.php"><i class="fa fa-list-alt"></i>Registrar Inversion</a></li>
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
      <h3><i class="fa fa-angle-right"></i>Ficha Inversion <i class="fa fa-angle-right"></i> Detalle </h3>
          <div class="col-md-12">
              <div class="content-panel"> 
      <h3><i class="fa fa-angle-right"></i>Agregar Detalle </h3>
                                
                    <form action="" name="ASIENTOS" method="post">  
                      <div class="form-group"> 
                              <table class="col-md-12">
                                      <tr>  <td> <div  >
                                     <p class="col-sm-3 col-sm-3 control-label">Cuenta:  </p>
                                     <div class="col-sm-10"> <p>
                                        <select class="form-control placeholder-no-fix" name="ri_cuenta" >
                                       <?php
                                            $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                            $cod_cuenta=mysqli_query($con,"SELECT * FROM subcuenta");
                                            while ($valores_cuenta = mysqli_fetch_array($cod_cuenta)) {
                                            echo '<option value="'.$valores_cuenta[id_subcuenta].'">'.$valores_cuenta[nombre_subcuenta].'</option>'; }
                                            echo "<br>"; 
                                       ?>
                                             </select>
                                      </p></div>
                                     </div> </td> </tr>
                                   <tr>  <td  colspan="2"  >
                                    <div class="form-group">
                                    <p class="col-sm-3 col-sm-3 control-label">Concepto</p>
                                    <div class="col-sm-11"><input  required type="text" name="ri_concepto" placeholder=" " autocomplete="off" class="form-control placeholder-no-fix">
                                    </div></div></td> </tr>
                                    <tr  > 
                                           <td>
                                           <div class="form-group"> 
                                            <p class="col-sm-4 col-sm-4 control-label">Cantidad: </p>
                                            <div class="col-sm-10">
                                          <input required type="number" name="ri_cantidad" placeholder=" " autocomplete="off" class="form-control placeholder-no-fix"></div> </div>
                                          </td><td   > 
                                            <div class="form-group">
                                          <p class="col-sm-4 col-sm-4 control-label" >Precio 
                                           <?php  
                                              $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                                              //obtener id de la ultima ficha
                         $rs=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
                                    if ($row = mysqli_fetch_row($rs)) 
                                      {
                                        $iden = trim($row[0]);
                                      }
                          
                          //obtener moneda 
                                              
                                        
                         $rs_m=mysqli_query($con,"SELECT total_ficha AS iden FROM ficha WHERE id_ficha=$iden");
                                    if ($row_m = mysqli_fetch_row($rs_m)) 
                                      {
                                        $moneda = trim($row_m[0]);
                                     
                                      if ($moneda==1){
                                        echo ' (Bs)';
                                      }
                                        else{echo ' ($us)';}  }
                                              ?></p>
                                          <div class="col-sm-10">
                                          <input  required type="number"  step="any"  name="ri_monto" placeholder=" "  class="form-control placeholder-no-fix"></div> </div>
                                          </td>  
                                    </tr>
                                    <tr><td colspan="2">
                                      <h3><i class="fa fa-angle-right"></i>Informacion General de Amortizacion </h3>
                                
                                    </td></tr>
                                <tr>  
                                  <td> <div class="form-group">
                                  <p class="col-sm-3 col-sm-3 control-label" >Monto de Amortizacion</p>
                                   <div class="col-sm-10"> <input required type="number" name="ri_mon" placeholder=" "  class="form-control placeholder-no-fix">
                                    </div></div> </td>
                                    <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >Interes  (Ej: 0.10 )</p>
                                    <div class="col-sm-10"> <input required type="number" name="ri_int" placeholder=" "  class="form-control placeholder-no-fix">
                                  </div>   </div></td>
                                  <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >Tiempo (en años)</p>
                                    <div class="col-sm-10"> <input required type="number" name="ri_t" placeholder=" "  class="form-control placeholder-no-fix">
                                  </div>   </div></td>
                             </tr>
                                <tr>  <td colspan="2"> <div class="form-group">
                                    <p class="col-sm-3 col-sm-3 control-label" >Descripcion del  Amortizacion (intangible o diferido )</p>
                                     <div class="col-sm-11"> <input required type="text" name="ri_det" placeholder=" "  class="form-control placeholder-no-fix">
                                </div></div></td></tr>
                          <tr><td colspan="3" ><center> <br> <hr><input type="submit"   class="btn btn-theme"   name="registrar_asientos" value="AGREGAR "></center>   <?php
                                  
                                   if(isset($_POST['registrar_asientos'])) 
                                   {
                                    include('conexion.php');
                                  if($_POST['ri_t'] == ''   )
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
                                     $ri_cantidad=$_POST["ri_cantidad"] ;
                                    
                                    //datos de tabla amort
                                     $ri_mon =$_POST["ri_mon"] ;
                                     $ri_int =$_POST["ri_int"] ;
                                     $ri_t =$_POST["ri_t"] ;
                                     $ri_det =$_POST["ri_det"] ;

                                      /*datos de tabla amort_asiento
                                     $aa_per =$_POST["aa_per"] ;
                                     $aa_cap =$_POST["aa_cap"] ;
                                     $aa_pago =$_POST["aa_pago"] ;
                                     $aa_amo=$_POST["aa_amo"] ;
                                      $aa_cuo =$_POST["aa_cuo"] ;
                                     $aa_saldo_final =$_POST["aa_saldo_final"] ;
                                     $fecha =$_POST["fecha"] ;
                                     */
                                     //a agregar asiento temporal 
                                      $sq2= "INSERT INTO temp_as (id_as,glosa_asiento,monto_asiento,id_subcuenta,cantidad   ) 
                                                            VALUES ( '$id_entidad0','$ri_concepto','$ri_monto','$ri_cuenta','$ri_cantidad');";
                                                      mysqli_query($con,$sq2)  ; 
                                    //agragar amort
                                    $rsd=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
                                    if ($rowd = mysqli_fetch_row($rsd)) 
                                      {
                                        $iden = trim($rowd[0]);
                                      } 
                                       $iden2 =0;
                                      $rsd2=mysqli_query($con,"SELECT MAX(id_amortizacion)  FROM amortizacion");
                                    if ($rowd2 = mysqli_fetch_row($rsd2)) 
                                      {
                                        $iden2 = trim($rowd2[0]);
                                        $id_doc_new= $iden2 +1;
                                      } 
                                      if ($iden2==null){ $iden2 =1;}
                                      
                                    $sq3= "INSERT INTO amortizacion (  id_amortizacion,detalle_amortizacion, monto_amortizacion, interes_amortizacion,tiempo_amortizacion) 
                                                            VALUES ( '$id_doc_new','$ri_det','$ri_mon','$ri_int','$ri_t');";
                                                      mysqli_query($con,$sq3)  ;  
                                    
                                   $cod=mysqli_query($con,"SELECT     interes_amortizacion FROM amortizacion WHERE id_amortizacion='$id_doc_new' LIMIT 1 " );

                                          if ($row = mysqli_fetch_row($cod))
                                            {
                                              $iden = trim($row[0]);
                                            }
                                            $cuota_a=$iden;
                                        //  echo '<input required type="number" step="any" class="form-control" name="cambio" value="'.$iden.'"> </input> ';                   
                                    }}
                                  ?>
<hr></td></tr></table>
                        </form>
                        <form action="" name="amor" method="post"> 
                        <table> 
                          <tr><td colspan="2">
                                      <h3><i class="fa fa-angle-right"></i>Informacion Detallada de Amortizacion </h3>
                            
                                    </td></tr>
                                <tr>  
                                  <td> <div class="form-group">
                                  <p class="col-sm-3 col-sm-3 control-label" >periodo</p>
                                   <div class="col-sm-10"> <input   type="number" name="aa_per" placeholder=" "  class="form-control placeholder-no-fix">
                                    </div></div> </td>
                                    <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >capital inicial</p>
                                    <div class="col-sm-10"> <input   type="number" step="any" name="aa_cap" placeholder=" "  class="form-control placeholder-no-fix">
                                  </div>   </div></td>
                                  <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >pago interes</p>
                                    <div class="col-sm-10"> <input   type="number" step="any" name="aa_pago" placeholder=" "  class="form-control placeholder-no-fix">
                                  </div>   </div></td>
                             </tr>
                                <tr>  
                                  <td> <div class="form-group">
                                  <p class="col-sm-3 col-sm-3 control-label" >amortizacion</p>
                                   <div class="col-sm-10"> <input   type="number" name="aa_amo" placeholder=" "  class="form-control placeholder-no-fix">
                                    </div></div> </td>
                                    <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >cuota</p>
                                    <div class="col-sm-10"> <input   type="number" step="any" name="aa_cuo" placeholder="<?PHP echo  $cuota_a; ?>"  class="form-control placeholder-no-fix">
                                  </div>   </div></td>
                                  
                                  <td>
                                     <div class="form-group"> <p lass="col-sm-4 col-sm-4 control-label" >Fecha</p>
                                    <div class="col-sm-10">  <input   type="date" name="fecha" placeholder="YYYY-MM-DD" min="2017-01-01" class="form-input"/>
                                  </div>   </div></td>
                             </tr>
                             <tr><td> <div class="form-group">
                                  <p class="col-sm-3 col-sm-3 control-label" >Saldo Final</p>
                                   <div class="col-sm-10"> <input required type="number" name="aa_saldo_final" placeholder=" "  class="form-control placeholder-no-fix">
                                    </div></div> </td></tr>

                              
                             <div class="form-group">
                              <tr><td colspan="3"> <center>
                                <hr>
                              <input type="submit"  class="btn btn-theme" href="registrar_egreso.php"  name="registrar_asientos_amor" value="AGREGAR">
                       
                       
                              </div>  
                                  </center> <hr></td></tr>
                                   <?php
                                  
                                   if(isset($_POST['registrar_asientos_amor'])) 
                                   {
                                    include('conexion.php');
                                  if($_POST['aa_per'] == ''   )
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
                                        //datos de tabla amort_asiento
                                     $aa_per =$_POST["aa_per"] ;
                                     $aa_cap =$_POST["aa_cap"] ;
                                     $aa_pago =$_POST["aa_pago"] ;
                                     $aa_amo=$_POST["aa_amo"] ;
                                      $aa_cuo =$_POST["aa_cuo"] ;
                                     $aa_saldo_final =$_POST["aa_saldo_final"] ;
                                     $fecha =$_POST["fecha"] ;
                                      
                                    
                                    //id asiento
                                    $rsd=mysqli_query($con,"SELECT MAX(id_asiento) AS asa FROM asiento");
                                    if ($rowd = mysqli_fetch_row($rsd)) 
                                      {
                                        $iden = trim($rowd[0]);
                                      } 
                                        
                                      $rsd2=mysqli_query($con,"SELECT MAX(id_amortizacion)  FROM amortizacion");
                                      //id amortizacion id
                                    if ($rowd2 = mysqli_fetch_row($rsd2)) 
                                      {
                                        $iden2 = trim($rowd2[0]);
                                        $id_doc_new= $iden2 +1;
                                      } 
                                      if ($iden2==null){ $iden2 =1;$id_doc_new=1;}
                                      
                                    $sq3= "INSERT INTO asiento_amortizacion (   id_asiento_amortizacion,periodo_amortizacion,capital_inicial, pago_interes,amortizacion,cuota,saldo_final,fecha_amortizacion,id_amortizacion, id_asiento) 
                                                            VALUES ( '$id_doc_new','$aa_per','$aa_cap','0','$aa_amo','$aa_cuo','$aa_saldo_final','$fecha','$iden','$iden2');";
                                                      mysqli_query($con,$sq3)  ;  
                                    
                                                   
                                    }}
                                  ?>
                         </table> 
                           </form>
                  
  
                    <!--Fin de ventana emergente-->
                     <form action="" name="tablas" method="post">  
                      
               <table class="table table-bordered table-striped table-condensed">
                            <h3><i class="fa fa-angle-right"></i> Detalle</h3>
                            <h5> Se muestra todos los asientos pertenecientes a la ficha </h5>
                              <thead >
                              <tr>
                                  <td>Codigo</td>
                                  <td class="hidden-phone"> Cuenta</td>
                                  <td width="350px"> Concepto</td>
                                  <td> Cantidad</th>
                                    <td> Monto</th>
                                      <td width="150px">Monto Periodico</td>
                                      <td width="150px"> Tiempo Amortizacion </td>
                                     
                                  <td width="150px"> Opciones</td>
                              </tr>
                              </thead>
                              <tfoot >
                                <tr>
                                  <td colspan="4" ><center>Total</center> </th>
                                  <td> <center><?php
                           $id_1='';  $id_or='';
                                           $totala=0;
                             $cod_fichaa=mysqli_query($con,"SELECT   cantidad AS c, monto_asiento AS mo FROM temp_as");
                                               while ($valores8a = mysqli_fetch_array($cod_fichaa)) 
                                                {
                                                  $xa = $valores8a['c'];
                                                  $x1a = $valores8a['mo'];
                                                  $totala= $totala +( $xa *$x1a);
                                                }
                                           
                                          echo  $totala;
                                      ?></th>
                                    <td colspan="5"> </center> </th>
                                </tr>  </tfoot> <tbody>  <tr>
                                       <?php
                                       $m=0;
                                           $rs8=mysqli_query($con,"SELECT  count(id_as) AS iden FROM temp_as");
                                    if ($row8 = mysqli_fetch_row($rs8)) 
                                      {
                                        $iden8 = trim($row8[0]);
                            $cod8=mysqli_query($con,"SELECT * FROM temp_as ");
                           while ($valores8 = mysqli_fetch_array($cod8)) { 
                           $m=$m+1;
                           $id_1=$valores8['id_as'];
                           ?>
                              <tr class="identificador" data-id="id" >
                                  <td><?php echo $valores8['id_as']; ?></td>
                                  <td><?php echo $valores8['id_subcuenta']; ?></td>
                                  <td><?php echo $valores8['glosa_asiento']; ?></td> 
                                  <td><?php echo $valores8['cantidad']; ?></td> 
                                  <td><?php echo $valores8['monto_asiento']; ?></td>
                                <td><?php $func3 = 'ver_doc_t';
                                            echo $func3($valores8['id_as']);?></td>
                              <td><?php echo $valores8['cantidad']; ?></td> 
                                  <td><?php echo $valores8['monto_asiento'];  ?></td>
                               

                          <?php }  ?>
                          <td>
                            <input type="submit"  class="btn btn-primary btn-xs"  class="btn btn-theme" name="eliminar_item"     value="Eliminar"> 
                                                                                                       
                          </td>
                              </tr>
                                     <?php 
                          if (isset($_POST['eliminar_item'])){              
                          $s='es '; 
                           $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
                            //borrar tabla temporal
                            $sq_delete= "DELETE FROM temp_as WHERE  id_as= '$id_1'";
                            mysqli_query($con,$sq_delete)  ;
                            echo '<meta http-equiv="refresh" content="0" />';       }
}
                                      else{ ?>
                                         <td><?php echo 'Vacio' ?></td>
                                  <td><?php echo 'Vacio' ?></td>
                                  <td><?php echo 'Vacio' ?></td>
                                  <?php
                                      }
                                      ?>
                              </tr>

                              </tbody>

                          </table> 
                          </form>   
                           <form action="" name="actualizar" method="post">
                           <hr>
                           <h3><i class="fa fa-angle-right"></i> Guardar</h3>
                           <h5> Click en Registrar Datos para almacenar la ficha, o Click en Cancelar para Borrar ficha </h5>  
                          <center><input type="submit"  class="btn btn-theme" name="registrar_datos1"  value="REGISTRAR DATOS"> 
                            <input type="submit" name="borrar_ficha" class="btn btn-danger" value="CANCELAR"> <br> <br> </center>
                         <?php
                          if(isset($_POST['registrar_datos1'])) 
                        { 
                           $moneda=1;
                          //obtener id de la ultima ficha
                         $rs=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
                                    if ($row = mysqli_fetch_row($rs)) 
                                      {
                                        $iden = trim($row[0]);
                                      }
                           //obtener moneda 
                         $rs_m=mysqli_query($con,"SELECT total_ficha AS iden FROM ficha WHERE id_ficha=$iden");
                                    if ($row_m = mysqli_fetch_row($rs_m)) 
                                      {
                                        $moneda = trim($row_m[0]);
                                      }
                         /*agregrar asienteos
                              
                            */
                             $codb=mysqli_query($con,"SELECT   MAX(id_asiento) FROM asiento");
                                              if ($rowb = mysqli_fetch_row($codb)) 
                                                {
                                                  $ida = trim($rowb[0]);
                                                }
                                                $id_asiento = $ida+1;
                          $result0 = mysqli_query($con,"SELECT * from temp_as");
                            $s=1;
                              while ($row0 = mysqli_fetch_array($result0)) {
                                  $id=$row0['id_as']+$ida;
                                  $campo1=$row0['glosa_asiento'];
                                  $campo2=$row0['cantidad'];
                                  $campo3=$row0['monto_asiento'];
                                  $campo3=$campo3*$moneda;
                                  $campo4=$row0['monto_asiento'];
                                  $campo4=$campo4*$moneda;
                                  $campo5=0;
                                  $campo6=$iden;
                                  $campo7=$row0['id_subcuenta'];
 
                                  $insercion="INSERT INTO asiento values ('$id', '$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$campo6', '$campo7');";
                                mysqli_query($con,$insercion)  ;
                            } 
                            //actualizar el monot total de ficha
                            $total=0;
                             $cod_ficha=mysqli_query($con,"SELECT   cantidad AS c, monto_asiento AS mo FROM temp_as");
                                               while ($v8g = mysqli_fetch_array($cod_ficha)) 
                                                {
                                                  $x = $v8g['c'];
                                                  $x1 = $v8g['mo'];
                                                  $total= $total +( $x *$x1);
                                                }
                                                $total= $total*$moneda;
                             $update_ficha="UPDATE ficha SET `total_ficha`='$total',`total_haber_ficha`='$total' WHERE id_ficha='$iden';";
                                mysqli_query($con,$update_ficha)  ;
                             //borrar tabla temporal
                            $sq_delete= "DELETE FROM temp_as";
                             mysqli_query($con,$sq_delete)  ;

                         $msg = 'Agregado correctamente ' ;
                            print "<script>alert('$msg'); window.location='lista_ficha.php';</script>";
                            }
                            if(isset($_POST['borrar_ficha'])) 
                        { 
                          //obtener id de la ultima ficha
                         $rs9=mysqli_query($con,"SELECT MAX(id_ficha) AS iden FROM ficha");
                                    if ($row9 = mysqli_fetch_row($rs9)) 
                                      {
                                        $iden = trim($row9[0]);
                                      }
                                      //borrar tabla temporal
                            $sq_delete= "DELETE FROM temp_as";
                             mysqli_query($con,$sq_delete)  ;
                             //borrar tabla docuemtno
                            $sq_delete_d= "DELETE FROM documento_extra WHERE id_ficha='$iden' ; ";
                             mysqli_query($con,$sq_delete_d)  ;
                             //borrar empleado_ficha
                            $sq_delete_d1= "DELETE FROM empleado_ficha WHERE id_ficha ='$iden'; ";
                              mysqli_query($con,$sq_delete_d1)  ;
                                        //borrar ficha
                            $sq_delete1= "DELETE   FROM ficha WHERE id_ficha='$iden'";
                             mysqli_query($con,$sq_delete1)  ;
                              $msg = 'Cancelar ingreso de ficha Exitoso ' ;
                            print "<script>alert('$msg'); window.location='lista_ficha.php';</script>";

                        }
                         ?>
                        </form>
                        
</section>

                      </section><!--    -->
<?php
  function item_elim($f) {
    $s='es ';
   $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
        //borrar tabla temporal
        $sq_delete= "DELETE FROM temp_as WHERE  id_as=$f ";
        mysqli_query($con,$sq_delete)  ;
    return $window.location.reload();
}

  function ver_doc_t($f) {
    $iden='es ';
   $con = mysqli_connect('localhost', 'root', '', 'contabilidad'); 
     $cod_1=mysqli_query($con,"SELECT  Tipo FROM documento_extra WHERE  id_ficha='$f' LIMIT 1 ");
   
    if ($row = mysqli_fetch_row($cod_1)) 
    {
        $iden = trim($row[0]);
    }   
    return $iden;
}
 ?>

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
