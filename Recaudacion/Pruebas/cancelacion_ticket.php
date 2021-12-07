<!DOCTYPE html>
<html class="no-js" lang="es">
    <head>
    <meta charset='utf-8'> 
    <meta http-equiv='Content-Type'>
       <title> Impresion Ticket</title>
       <style>
	   body{
	   font-size: 9px;
  		font-size-adjust: 0.5; 
		font: bold 65% monospace;
	   }
         </style>
    </head>
    <body id="page"  onLoad="javascript:imprimir()">
    <?php
     require('../../funciones2.php');
	   conectar();
    if($_GET['tipo']=='alimento')
    {
		echo "
	 	<div align='center'>";
	  $al="SELECT * FROM tickets WHERE id=".$_GET['id'];
	 	$a=mysql_query($al);
	 	 $ti=mysql_fetch_array($a);
			  /// DATOS DE PROSUCTO
			   $producto=explode(",",$ti['productos']);
			   $descripcion=explode(",",$ti['descripciones']);
			   $cantidad=explode(",",$ti['cantidades']);
			   $total=explode(",",$ti['totales']);
			   $pago=$ti['paga'];
			    count($producto);

			    ////////////////////////////////////////////////77
			     echo "EVENTOS SOCIALES VILLA CONIN S.A. de C.V <br> " ;	                                                                                																						            
				echo "Ticket de Compra Alimentos <br>                          													 
				 Fecha: ".date('Y-m-d')." Folio: a".$_GET['id'];
				 echo"<br>Contrato: ".$ti['referencia'];

		   echo '</div>
		   <img src="cancelado.jpg" style="width:300px;" />
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
				echo "Sub Total:".money_format("%i",$tota)."<br>Ticket Bebidas b".$idv.": ".$tvinos."<br>Total: ".money_format("%i",($tota+$tvinos))."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);		
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
   if ($_GET['tipo']=='vino')
   {
   echo "
	 	<div align='center'>";
	 $al="SELECT * FROM tickets_vinos WHERE id=".$_GET['id'];
	 	$a=mysql_query($al);
	 	 $ti=mysql_fetch_array($a);
			  /// DATOS DE PROSUCTO
			   $producto=explode(",",$ti['productos']);
			   $descripcion=explode(",",$ti['descripciones']);
			   $cantidad=explode(",",$ti['cantidades']);
			   $total=explode(",",$ti['totales']);
			   $pago=$ti['paga'];
			    count($producto);

			    ////////////////////////////////////////////////77
			     echo "EVENTOS SOCIALES VILLA CONIN S.A. de C.V <br> " ;	                                                                                																						            
				echo "Ticket de Compra Bebidas<br>                          													 
				 Fecha: ".date('Y-m-d')." Folio: b".$_GET['id'];
				 echo"<br>Contrato: ".$ti['referencia'];

		   echo '</div>
		   <img src="cancelado.jpg" style="width:300px;" />
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
				echo "Sub Total:".money_format("%i",$tot)."<br>Ticket Alimentos a".$id.": ".$tota."<br>Total: ".money_format("%i",($tota+$tot))."<br>EFVO: $ ".money_format("%i",$pago)."<br>Cambio: $ ".money_format("%i",$cambio);						
		    }
		    else
		    {
			$cambio=$pago-$tot;
				echo "Sub Total:".money_format("%i",$tot)."<br>Total: ".money_format("%i",$tot);		
		   }
		   echo' </div>
		    <div align="center">
		    <br></br>------------------------------------------------------------------
		 	<br></br>------------------------------------------------------------------
		 	</div>
				<br></br>';
			    /////////////////////////////////////////////////
   }
    ?>
 </body>



<SCRIPT LANGUAGE="JavaScript">
<!--
function imprimir() 
{
		if (window.print)
		{
			window.print();
			//setTimeout('cerrar()',5000);
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