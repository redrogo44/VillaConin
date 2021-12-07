<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menuconfiguracion();
}

?>
 
 <title>Villa Conin</title>
<head> 

</head> 
 <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  height:auto;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
	
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
	   <br><br>
		<div class="wrapper">
			<?php
					conectar();
					$_SESSION['facturado']='si';
					$qa="select sum(cantidad) as total from abono where numcontrato='".$_GET['numero']."'";
					$ra=mysql_query($qa);
					$ma=mysql_fetch_array($ra);
					
					
					$qc="select sum(cantidad) as total from cargo where numcontrato='".$_GET['numero']."'";
					$rc=mysql_query($qc);
					$mc=mysql_fetch_array($rc);
					
					$qd="select * from contrato where Numero='".$_GET['numero']."'";
					$rd=mysql_query($qd);
					$md=mysql_fetch_array($rd);
					
					$total1=($md['c_ninos']*$md['p_ninos'])+($md['c_jovenes']*$md['p_jovenes'])+($md['c_adultos']*$md['p_adultos']);
					$total2=$total1*1.16;
				
					if($ma['total']==''){$ma['total']=0;}
					if($mc['total']==''){$mc['total']=0;}
					
					$sa=$total2+$mc['total']-$ma['total'];
					
					$uf="update contrato set facturado='si' where Numero='".$_GET['numero']."'";
					$rf=mysql_query($uf);
					
					$ui="update contrato set impreso='no' where Numero='".$_GET['numero']."'";
					$ri=mysql_query($ui);
					
					$borrar="delete from abono where numcontrato='".$_GET['numero']."'";
					$borrara=mysql_query($borrar);
					
					$borrarc="delete from cargo where numcontrato='".$_GET['numero']."'";
					$borrarca=mysql_query($borrarc);
					
					$usi="update contrato set si=".$total2." where Numero='".$_GET['numero']."'";
					$usi2=mysql_query($usi);
					
					
					$usa="update contrato set sa=".$sa." where Numero='".$_GET['numero']."'";
					$usa2=mysql_query($usa);
					
					
   				    $folio=$_GET['numero'];
				    $fechaactual= date("Y-m-d");
				    $recibide='';
				    $cantidadde=$ma['total'];
				    $concepto='Conversion de no facturado a facturado';
				    $fechaevento=$md['Fecha'];
				    $tipoeveto=$md['tipo'];
				    $salon=$md['salon'];
				    $ncontrato=$md['nombre'];
					
				    $insert="insert into abonofac(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."')";
				    $r=mysql_query($insert);
				    $cons_q="select * from contrato where Numero='".$folio."'";
					$consulta=mysql_query($cons_q);
					while($can=mysql_fetch_array($consulta))
						{
							$cantidad=$can['sa']-$cantidadde;
						}
					$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$folio."'");
					$x="select * from contrato where Numero='".$folio."'";
					$x2=mysql_query($x);
					$x3=mysql_fetch_array($x2);
					$nuevafecha = strtotime ( '+1 month' , strtotime ( $x3['proximo_abono'] )) ;
					$nue = date ( 'Y-m-d' , $nuevafecha );
					$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' where Numero='".$folio."'");		  
	   
					
						 $cargoss="INSERT INTO cargofac(numcontrato, cantidad, concepto, fecha) VALUES ('".$_GET['numero']."',".$mc['total'].",'".$concepto."','".$fechaactual."')";
						 $cargoss2=mysql_query($cargoss);
					 
			?>
				<script>
					window.open("../contratoPDF.php?numero=<?php echo $_GET['numero']?>");
					window.open("PDF_abonos.php");
					window.open("PDF_cargos.php");
					location.href='convertir.php';
				</script>
	</div>
</div>
</body>
</html>
