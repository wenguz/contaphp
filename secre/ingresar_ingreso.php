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