<?PHP
	$hostname_localhost ="68.70.164.26";
	$database_localhost ="polizona_XX";
	$username_localhost ="polizona_XX";
	$password_localhost ="Tu_contraseña";
	$json=array();
        include("index.php"); 
//realiza conexion
    $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
   if ($conexion) {
    if ($Cprod= $_POST ['Cprod']!==""){
                 $Cprod= $_POST ['Cprod'];
                 $idempresa = $_POST ['IDempresa'];
   
                 // Buscar valor cuembarque
                    $conexionA = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
                    $cuembarquea = "select cuembarque from cuembarques where idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                    $cuembarqueb = "select cuembarque from cuembarques where idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                    $unida = "select coeficiente from coeficiente where idempresa ='$idempresa' AND idvendedora = '2'"; //da el valor de unidades por produccion
                    $unidb = "select coeficiente  from coeficiente where idempresa ='$idempresa' AND idvendedora = '3'";
                    $CTUnia="SELECT C.coeficiente*CU.cuembarque AS CTU  FROM coeficiente C, cuembarques CU where C.idempresa ='$idempresa' AND C.idvendedora = '2' and CU.idempresa = '$idempresa' and CU.idalmacen = '1' LIMIT 1;";
                    $CTUniB="SELECT C.coeficiente*CU.cuembarque AS CTU  FROM coeficiente C, cuembarques CU where C.idempresa ='$idempresa' AND C.idvendedora = '3' and CU.idempresa = '$idempresa' and CU.idalmacen = '2' LIMIT 1;";
                    $consultaA= "select cantidad from embarque where idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                    $consultaB= "select cantidad from embarque where idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                    $rest1 = mysqli_query($conexionA,$cuembarquea);
                    $rest2 = mysqli_query($conexionA,$cuembarqueb);
                    $rest3 = mysqli_query($conexionA,$unida);
                    $rest4 = mysqli_query($conexionA,$unidb);
                    $rest5 = mysqli_query($conexionA,$CTUnia);
                    $rest6 = mysqli_query($conexionA,$CTUniB);
                    $rest7 = mysqli_query($conexionA,$consultaA);
                    $rest8 = mysqli_query($conexionA,$consultaB);
                    if($conexionA){              
                      while($registroA=mysqli_fetch_array($rest1)){
                        $result["CUembarque"]=$registroA['CUembarque'];
                        $json['Clasificador'][]=$result;
                             foreach ($registroA as $clave=>$cua) {
                                } 
                        }
                           echo "El costo unitario del insumo A es: $cua <br/>"; 
                       while($registroB=mysqli_fetch_array($rest2)){
                        $result["CUembarque"]=$registroB['CUembarque'];
                        $json['Clasificador'][]=$result;
                                foreach ($registroB as $clave=>$cub) {
                                } 
                        }
                           echo "El costo unitario del insumo B es: $cub <br/>"; 
                       while($registroC=mysqli_fetch_array($rest3)){
                        $result["coeficiente"]=$registroC['coeficiente'];
                        $json['Clasificador'][]=$result;
                                foreach ($registroC as $clave=>$cap) {
                                } 
                        }
                           echo "La cantidad del insumo A para producir es: $cap <br/>";
                       while($registroD=mysqli_fetch_array($rest4)){
                            $result["coeficiente"]=$registroD['coeficiente'];
                            $json['Clasificador'][]=$result;
                           foreach ($registroD as $clave=>$cbp) {
                                } 
                        }
                            echo "La cantidad del insumo B para producir es: $cbp <br/>";         
                            
                       while($registroE=mysqli_fetch_array($rest5)){
                        $result["CTU"]=$registroE['CTU'];
                        $json['Clasificador'][]=$result;
                           foreach ($registroE as $clave=>$ctua) {
                                } 
                        }
                           echo "El costo total unitario insumo A para producir una pieza es: $ctua <br/>"; 
                       while($registroF=mysqli_fetch_array($rest6)){
                        $result["CTU"]=$registroF['CTU'];
                        $json['Clasificador'][]=$result;
                           foreach ($registroF as $clave=>$ctub) {
                                } 
                        }
                           echo "El costo total unitario insumo B para producir una pieza es: $ctub <br/>"; 
                        while($registroG=mysqli_fetch_array($rest7)){
                        $result["cantidad"]=$registroG['cantidad'];
                        $json['Clasificador'][]=$result;
                           foreach ($registroG as $clave=>$alma) {
                                } 
                        }
                        while($registroH=mysqli_fetch_array($rest8)){
                        $result["cantidad"]=$registroH['cantidad'];
                        $json['Clasificador'][]=$result;
                           foreach ($registroH as $clave=>$almb) {
                                } 
                        }
                           //oprecion costos totales por insumo a y b y suma total
                           $ctia = $ctua*$Cprod;
                           $ctib = $ctub*$Cprod;
                           $canttotpa=$cap*$Cprod;
                           $canttotpb=$cbp*$Cprod;
                           $ctp=$ctia+$ctib;
                           echo "El costo total insumo A  para producir $Cprod piezas es: $ctia <br/>"; 
                           echo "El costo total insumo B  para producir $Cprod piezas es: $ctib <br/>"; 
                           echo "El costo total para producir $Cprod piezas es: $ctp <br/>";
                           $conexionB = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
                           //Condicionales para modificar tabla de embarques
                            if ($alma > $canttotpa ) {
	                         //total de piezas que quedan
                             $Nval = $alma -$canttotpa; 
                             $Ntot = $Nval * $cua ;
                             //actualiza en valor de unidades en embarques
                             $update= "UPDATE embarque 
                             SET cantidad = $Nval, 
                             precioTotal= $Ntot  WHERE idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                             $registro=mysqli_query($conexionB,$update);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN UPDATE. <br>";	
                                    }
                             }else if ($alma == $canttotpa){
                                //delete eliminar registro completo cambiar num almacen
                                $delete="delete from embarque where idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                                $registro=mysqli_query($conexionB,$delete);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN DELETE. <br>";	
                                    }
                             }else if ($alma < $canttotpa){
                                //delete eliminar registro completo cambiar num almacen
                                $faltante = $alma - $canttotpa;
                                echo "falta. $faltante  <br>";
                                $delete="delete from embarque where idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                                $registro=mysqli_query($conexionB,$delete);
                                 if ($registro) {
                                     }else {
                                     echo "ERROR: EN DELETE 2. <br>";	
                                    }
                                    $consultaA= "select cantidad from embarque where idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                                    $rest7 = mysqli_query($conexionA,$consultaA);
                                    while($registroH=mysqli_fetch_array($rest7)){
                                     $result["cantidad"]=$registroH['cantidad'];
                                     $json['Clasificador'][]=$result;
                                     foreach ($registroH as $clave=>$n1alma) {
                                            } 
                                       } 

                                $n = $n1alma + $faltante;
                                $Ntot = $n * $cua ;
                                echo "queda. $n  <br>";
	                           //update modificar lo que falta para cumplir orden
                               $update= "UPDATE embarque SET cantidad = $n, precioTotal= $Ntot  WHERE idempresa = $idempresa and idalmacen = 1 LIMIT 1";
                               $registro=mysqli_query($conexionB,$update);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN UPDATE 2. <br>";	
                                    }
                               }else {
	                            echo "ERROR: No funciona prueba de almacen  <br>";
                                 }
                                 //Almacen b
                                  $conexionB = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
                                 //Condicionales para modificar tabla de embarques
                            if ($almb > $canttotpb ) {
	                         //total de piezas que quedan
                             $Nval1 = $almb -$canttotpb; 
                             $Ntot1 = $Nval1 * $cub ;
                             //actualiza en valor de unidades en embarques
                             $update= "UPDATE embarque SET cantidad = $Nval1,  precioTotal= $Ntot1  WHERE idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                             $registro=mysqli_query($conexionB,$update);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN UPDATE B. <br>";	
                                    }
                             }else if ($almb == $canttotpb){
                                //delete eliminar registro completo cambiar num almacen
                                $delete="delete from embarque where idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                                $registro=mysqli_query($conexionB,$delete);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN DELETE B. <br>";	
                                    }
                             }else if ($almb < $canttotpb){
                                //delete eliminar registro completo cambiar num almacen
                                $faltante = $almb - $canttotpb;
                                echo "falta. $faltante  <br>";
                                $delete="delete from embarque where idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                                $registro=mysqli_query($conexionB,$delete);
                                 if ($registro) {
                                     }else {
                                     echo "ERROR: EN DELETE 2 B. <br>";	
                                    }
                                    $consultaB= "select cantidad from embarque where idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                                    $rest8 = mysqli_query($conexionB,$consultaB);
                                    while($registroH=mysqli_fetch_array($rest8)){
                                     $result["cantidad"]=$registroH['cantidad'];
                                     $json['Clasificador'][]=$result;
                                     foreach ($registroH as $clave=>$n1almb) {
                                            } 
                                       } 
                                $n = $n1almb + $faltante;
                                $Ntot = $n * $cub ;
                                echo "queda. $n  <br>";
	                           //update modificar lo que falta para cumplir orden
                               $update= "UPDATE embarque SET cantidad = $n, precioTotal= $Ntot  WHERE idempresa = $idempresa and idalmacen = 2 LIMIT 1";
                               $registro=mysqli_query($conexionB,$update);
                                    if ($registro) {
	                	            mysqli_close($conexionB);
                                     }else {
                                     echo "ERROR: EN UPDATE 2 B. <br>";	
                                    }
                               }else {
	                            echo "ERROR: No funciona prueba de almacen  <br>";
                                 }


                      json_encode($json);
                      mysqli_close($conexionA);
                        $consulta="call ordTrabajo (/*total producido*/'$ctp',/*valor total insumo A*/'$ctia',/*valor total insumo B*/'$ctib');";
                        $registro=mysqli_query($conexion,$consulta);
                        if ($registro) {
	                	    mysqli_close($conexion);
                           }else {
                             echo "ERROR: inserta valores. <br>";	
                            }
                      }
                    else{
                      echo "error";
                    }	
                  } else {
                    echo "ERORR: No ingreso cantidad de orden";
                    }
       }
 $conexionAc = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
  $consultaAc="select idempresa, idembarque, idalmacen, cantidad, ROUND(precioTotal,2) as precioTotal  from cuembarques where idempresa=$idempresa order by idembarque;";
    $resultadoAc=mysqli_query($conexionAc,$consultaAc);
    if($conexionAc){
      echo "<style> table, td { border:1px solid black; } table { width:100%; } td { padding:5px;  } </style>";
      echo "<table>";
      echo "<caption>CU Embarques</caption>";
      echo "<tr>";
      echo "<th> idempresa</th>";
      echo "<th> idembarque</th>";
      echo "<th> idalmacen</th>";
      echo "<th> cantidad</th>";
      echo "<th> precioTotal</th>";
      echo "</tr>";
      
      while($registroAc=mysqli_fetch_array($resultadoAc)){
        $result["idempresa"]=$registroAc['idempresa'];
        $result["idembarque"]=$registroAc['idembarque'];
        $result["idalmacen"]=$registroAc['idalmacen'];
        $result["cantidad"]=$registroAc['cantidad'];
        $result["precioTotal"]=$registroAc['precioTotal'];
        $json['Clasificador'][]=$result;
        
        echo "<tr>";
          echo "<td>".$registroAc['idempresa']." </td>";
          echo "<td>".$registroAc['idembarque']." </td>";
          echo "<td>".$registroAc['idalmacen']." </td>";
          echo "<td>".$registroAc['cantidad']." </td>";
          echo "<td>".$registroAc['precioTotal']." </td>";
        echo "</tr>";
      }
      
      echo "</table> <br>";
      
      json_encode($json);
      mysqli_close($conexionAc);
    }
    else{
      echo "error";
    }

$conexionA = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

  $consultaA="select * from asiento order by idasiento asc;";
    $resultadoA=mysqli_query($conexionA,$consultaA);
    if($conexionA){
      echo "<style> table, td { border:1px solid black; } table { width:100%; } td { padding:5px;  } </style>";
      echo "<table>";
      echo "<caption>Asiento</caption>";
      echo "<tr>";
      echo "<th> idempresa</th>";
      echo "<th> idasiento</th>";
      echo "<th> fecasiento</th>";
      echo "<th> idoperacion</th>";
      echo "<th> monto</th>";
      echo "</tr>";
      while($registroA=mysqli_fetch_array($resultadoA)){
        $result["idempresa"]=$registroA['idempresa'];
        $result["idasiento"]=$registroA['idasiento'];
        $result["fecasiento"]=$registroA['fecasiento'];
        $result["idoperacion"]=$registroA['idoperacion'];
         $result["monto"]=$registroA['monto'];
        $json['Clasificador'][]=$result;
        
        echo "<tr>";
          echo "<td>".$registroA['idempresa']." </td>";
          echo "<td>".$registroA['idasiento']." </td>";
          echo "<td>".$registroA['fecasiento']." </td>";
          echo "<td>".$registroA['idoperacion']." </td>";
          echo "<td>".$registroA['monto']." </td>";
        echo "</tr>";
      }
      
      echo "</table><br>";
      
      json_encode($json);
      mysqli_close($conexionA);
    }
    else{
      echo "error";
    }
    
$conexionAb = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

  $consultaAb="select * from abono order by idasiento, idabono asc;";
    $resultadoAb=mysqli_query($conexionAb,$consultaAb);
    if($conexionAb){
      echo "<style> table, td { border:1px solid black; } table { width:100%; } td { padding:5px;  } </style>";
      echo "<table>";
      echo "<caption>Abono</caption>";
      echo "<tr>";
      echo "<th> idempresa</th>";
      echo "<th> idasiento</th>";
      echo "<th> idabono</th>";
      echo "<th> idcuenta</th>";
      echo "<th> monto</th>";
      
      while($registroAb=mysqli_fetch_array($resultadoAb)){
        $result["idempresa"]=$registroAb['idempresa'];
        $result["idasiento"]=$registroAb['idasiento'];
        $result["idabono"]=$registroAb['idabono'];
        $result["idcuenta"]=$registroAb['idcuenta'];
        $result["monto"]=$registroAb['monto'];
        $json['Clasificador'][]=$result;
        
        echo "<tr>";
          echo "<td>".$registroAb['idempresa']." </td>";
          echo "<td>".$registroAb['idasiento']." </td>";
          echo "<td>".$registroAb['idabono']." </td>";
          echo "<td>".$registroAb['idcuenta']." </td>";
          echo "<td>".$registroAb['monto']." </td>";
        echo "</tr>";
      }
      
      echo "</table><br>";
      
      json_encode($json);
      mysqli_close($conexionAb);
    }
    else{
      echo "error";
    }
    
    
$conexionC = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

  $consultaC="  select * from cargo order by idasiento, idcargo asc;";
    $resultadoC=mysqli_query($conexionC,$consultaC);
    if($conexionC){
      echo "<style> table, td { border:1px solid black; } table { width:100%; } td { padding:5px;  } </style>";
      echo "<table>";
      echo "<caption>Cargo</caption>";
      echo "<tr>";
      echo "<th> idempresa</th>";
      echo "<th> idasiento</th>";
      echo "<th> idcargo</th>";
      echo "<th> idcuenta</th>";
      echo "<th> monto</th>";
      
      while($registroC=mysqli_fetch_array($resultadoC)){
        $result["idempresa"]=$registroC['idempresa'];
        $result["idasiento"]=$registroC['idasiento'];
        $result["idcargo"]=$registroC['idcargo'];
        $result["idcuenta"]=$registroC['idcuenta'];
        $result["monto"]=$registroC['monto'];
        $json['Clasificador'][]=$result;
        
        echo "<tr>";
          echo "<td>".$registroC['idempresa']." </td>";
          echo "<td>".$registroC['idasiento']." </td>";
          echo "<td>".$registroC['idcargo']." </td>";
          echo "<td>".$registroC['idcuenta']." </td>";
          echo "<td>".$registroC['monto']." </td>";
        echo "</tr>";
      }
      
      echo "</table>";
      
      json_encode($json);
      mysqli_close($conexionC);
    }
    else{
      echo "error";
    }

	?>
