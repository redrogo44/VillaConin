<?php
error_reporting(0);
require("configuraciones.php");
conectar();
session_start();
//print_r($_SESSION);
date_default_timezone_set('America/Mexico_City');

if($_POST['tipo']=="Confirmar LLamada")
{
	$Ultima_fecha_confimada=mysql_query("SELECT * FROM Configuraciones WHERE nombre='Fecha de LLamadas de MEseros' ");
        $ultima=mysql_fetch_Array($Ultima_fecha_confimada);
         if ($ultima['descripcion']!=date("Y-m-d"))
          {   
                for($i=0;$i<count($_POST);$i++)
                {
					if(isset($_POST[$i]))
					{

						echo $Mee="SELECT * FROM Meseros Where id=".$_POST[$i];
						 $lamadas=mysql_query($Mee);
						 $NLlamadas=mysql_fetch_array($lamadas);

						$Llamadas=$NLlamadas['porcentaje']+1;
			          echo $up="UPDATE `Meseros` SET `nivel`='0', `disponibilidad`='si',`disponibilidad2`='si',porcentaje=".$Llamadas."  WHERE id=".$_POST[$i];
					mysql_query($up);                
					}                                            
				/*if(isset($_PO	ST['comentario'.$i]))
					{
						
						echo $upa="UPDATE `Meseros` SET `comentarios`='".$_POST['comentario'.$i]."' WHERE id=".$_POST[$i];
						mysql_query($upa);
					}*/
			     }
			         echo    $Fecha="UPDATE Configuraciones Set descripcion='".date("Y-m-d")."' WHERE nombre='Fecha de LLamadas de MEseros'";
			                mysql_query($Fecha);
			                echo'<script language="javascript">window.location="Eventos_Rango_Fechas.php"</script>;';
          }

         else {	
             echo'<script language="javascript">window.location="Insert_Meseros.php"</script>;';
                }
					mysql_query("INSERT INTO `Movimientos_Meseros`(`usuario`, `fecha`, `movimiento`) VALUES ('".$_SESSION['usu']."','".date('m/d/Y h:i:s a', time())."','Confirmo')");			                
	
	pie();
}

if($_POST['tipo']=="Guardar")
{
		echo mysql_query("UPDATE `Meseros` SET nivel='0' WHERE 1");
			
		$Ultima_fecha_confimada=mysql_query("SELECT * FROM Configuraciones WHERE nombre='Fecha de LLamadas de MEseros' ");
        $ultima=mysql_fetch_Array($Ultima_fecha_confimada);
         if ($ultima['descripcion']!=date("Y-m-d"))
          {   
		 	for($i=0;$i<count($_POST);$i++)
			{
				if(isset($_POST[$i]))
				{
			 		echo $up="UPDATE `Meseros` SET `nivel`='1' WHERE id=".$_POST[$i];
					mysql_query($up);
				}								
			}
		  }
	pie();// date('m/d/Y h:i:s a', time());
	echo $use="INSERT INTO `Movimientos_Meseros`(`usuario`, `fecha`, `movimiento`) VALUES ('".$_SESSION['usu']."','".date('m/d/Y h:i:s a', time())."','Guardo')";
	mysql_query($use);
	echo'<script language="javascript">window.location="Insert_Meseros.php"</script>;';	
}
?>