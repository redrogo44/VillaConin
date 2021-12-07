<!DOCTYPE html>
<html class="no-js" lang="es">
    <head>
    <meta charset='utf-8'> 
    <meta http-equiv='Content-Type'>
       <title> Impresion Ticket</title>
       <style>
	   body{
	   font-size: 16px;
  		font-size-adjust: 0.8; 
		font: bold 70% monospace;
	   }
         </style>
    </head>
    <body id="page"  onLoad="javascript:imprimir()">
    <div align="center">
    <br>
       <?php
	   require('../../funciones2.php');
	   conectar();
//  print_r($_GET);
//////////////////////////    VALIDACION TIPO DE TICKET O TICKETS A IMPRIMIR /////////////////
	   if ($_GET['ticket']=='alimentos_vinos') 
	   {
	   		$id_alimento=mysql_query("SELECT max( id ) as id, folio FROM tickets WHERE referencia='".$_GET['contrato']."' ");
	   		$id_a=mysql_fetch_array($id_alimento);
	   		$id=$id_a['id'];
	   		$id_vino=mysql_query("SELECT max( id ) as idv, folio FROM tickets_vinos WHERE referencia='".$_GET['contrato']."' ");
	   		$id_v=mysql_fetch_array($id_vino);
	   		$idv=$id_v['idv'];	   	
	   			$bandera=1;$bandera2=1;
	   }
	   if ($_GET['ticket']=='alimentos')  
	   {
	   
	  $ial="SELECT max( id ) as id FROM tickets WHERE referencia='".$_GET['contrato']."' ";
			$id_alimento=mysql_query($ial);
	   		$id_a=mysql_fetch_array($id_alimento);
	   		$id=$id_a['id'];	   	
	   			$bandera=1;$bandera2=0;

	  } 
	   if ($_GET['ticket']=='vinos') 	  
	   {
			$id_vino=mysql_query("SELECT max( id ) as idv  FROM tickets_vinos WHERE referencia='".$_GET['contrato']."'");
	   		$id_v=mysql_fetch_array($id_vino);
	   		$idv=$id_v['idv'];	  
	   			$bandera=0;$bandera2=1;	   		
	  } 
	   //////////////////////////////////////////////////////////////////////
//     SI EL TICKET ES DE ALIMENTOS
	
	  if($bandera==1)
	  {
	  	echo "
	 	<div align='center'>";
	  $al="SELECT * FROM tickets WHERE id=".$id;
	 	$a=mysql_query($al);
	 	 $ti=mysql_fetch_array($a);
			  /// DATOS DE PROSUCTO
			   $producto=explode(",",$ti['productos']);
			   $descripcion=explode(",",$ti['descripciones']);
			   $cantidad=explode(",",$ti['cantidades']);
			   $total=explode(",",$ti['totales']);
			   $pago=$ti['paga'];
	   		$folio_alimentos=$ti['folio'];			   	   		
	   		$folio_vinos=mysql_fetch_array(mysql_query("SELECT folio FROM tickets_vinos WHERE id_ticket='".$ti['id']."' "));
			    count($producto);

			    ////////////////////////////////////////////////77
			  //   echo "EVENTOS SOCIALES VILLA CONIN S.A. de C.V <br> " ;	                                                                                																						            
				echo "Ticket de Compra Alimentos <br>                          													 
				 Fecha: ".date('Y-m-d')." Folio: a".$folio_alimentos;
				 echo"<br>Contrato: ".$ti['referencia'];

		   echo '</div>
		    <div align="left">
		    <br>';
			$tota=0;
				for($i=1;$i<count($producto);$i++)
				{
					echo $producto[$i]." ".$descripcion[$i]."<br>";
					echo "Cantidad: <b>".$cantidad[$i]."</b>   Total:    $ ".money_format("%i",$total[$i])."<br></br>";
					$tota=$tota+$total[$i];
					
				}
				
		    echo '</div>
		    <div align="left"> 
		    <br>';
		    
		    if($bandera2==1)
		    {
		    	$tvinos=total_vinos($idv);
		    $cambio=$pago-$tota-$tvinos;	
				echo "Sub Total:".money_format("%i",$tota)."<br>Ticket Bebidas b".$folio_vinos['folio'].": $ ".money_format("%i",$tvinos)."<br>Total: ".money_format("%i",($tota+$tvinos))."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);		
		    }else
		    {$cambio=$pago-$tota;
				echo "Sub Total:".money_format("%i",$tota)."<br>Total: ".money_format("%i",$tota)."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);				    	
		    }
			
		   
		   echo' </div>
		    <div align="center">
		    <br></br>------------------------------------------------------------------
		 	<br></br>------------------------------------------------------------------
				<br></br>
			</div>';
			    /////////////////////////////////////////////////
	 }
	  if($bandera2==1)
	  {
	  	echo "
	 	<div align='center'>";
	 $al="SELECT * FROM tickets_vinos WHERE id=".$idv;
	 	$a=mysql_query($al);
	 	 $ti=mysql_fetch_array($a);
			  /// DATOS DE PROSUCTO
			   $producto=explode(",",$ti['productos']);
			   $descripcion=explode(",",$ti['descripciones']);
			   $cantidad=explode(",",$ti['cantidades']);
			   $total=explode(",",$ti['totales']);
			   $pago=$ti['paga'];
			    count($producto);
	   		$folio_alimentos=mysql_fetch_array(mysql_query("SELECT folio FROM tickets WHERE id=".$ti['id_ticket']));


			    ////////////////////////////////////////////////77
			    // echo "EVENTOS SOCIALES VILLA CONIN S.A. de C.V <br> " ;	                                                                                																						            
				echo "Ticket de Compra Bebidas<br>                          													 
				 Fecha: ".date('Y-m-d')." Folio: b".$ti['folio'];
				 echo"<br>Contrato: ".$ti['referencia'];

		   echo '</div>
		    <div align="left">
		    <br>';
			$tot=0;
				for($i=1;$i<count($producto);$i++)
				{
					echo $producto[$i]." ".$descripcion[$i]."<br>";
					echo "Cantidad: <b>".$cantidad[$i]."</b>   Total:    $ ".money_format("%i",$total[$i])."<br></br>";
					$tot=$tot+$total[$i];
					
				}
				
		    echo '</div>
		    <div align="left"> 
		    <br>';
		    if($bandera==1)
		    {
				$cambio=$pago-$tot-$tota;
				echo "Sub Total:".money_format("%i",$tot)."<br>Ticket Alimentos a".$folio_alimentos['folio'].": $ ".money_format("%i",$tota)."<br>Total: ".money_format("%i",($tota+$tot))."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);						
		    }
		    else
		    {
			$cambio=$pago-$tot;
				echo "Sub Total:".money_format("%i",$tot)."<br>Total: ".money_format("%i",$tot)."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);		
		   }
		   echo' </div>
		    <div align="center">
		    <br></br>------------------------------------------------------------------
		 	<br></br>------------------------------------------------------------------
		 	</div>
				<br></br>';
			    /////////////////////////////////////////////////
	 }
	  
	  	 

function total_vinos($id)
{
	  $all="SELECT * FROM tickets_vinos WHERE id=".$id;
	 	$aa=mysql_query($all);
	 	 $tii=mysql_fetch_array($aa);
			  /// DATOS DE PROSUCTO
			   $total=explode(",",$tii['totales']);			  
			    $tot=0;
	for($i=1;$i<count($total);$i++)
				{
					$tot=$tot+$total[$i];				
				}
				return $tot;
}
?>	
 </body>
}


<SCRIPT LANGUAGE="JavaScript">
<!--
function imprimir() 
{
		if (window.print)
		{
			window.print();
			setTimeout('cerrar()',4000);
		}
		else
		{
			alert("Disculpe, su navegador no soporta esta opción.");
		}
}
function cerrar()
{
	window.close();
}
//setTimeout(window.close(),40000);
// -->
</SCRIPT>

</html>