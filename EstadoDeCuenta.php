<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
validarsesion();
conectar();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}
//print_r($_POST);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:800px;
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
				 display:block;}
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:-140px;
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
				right:-90px;
				top:0px;
			}			
			.cajon1{
			 width:870px;
            height:150px;
/*            border: 1px solid #000000;*/
				}
			.cajon2{
				  position: relative;
  top:  130px; 
  left: 0px;
			width:-30px;
            height:50px;
			
			
          /*  border: 1px solid #FF0000;*/
				
} .cajon3{
		position: relative;
			width:880px;
            height:50px;
		/*	border: 1px solid #FF0000;*/
			}
			.BOTON 
			{
				border: 3px solid #333333;
  border-radius: 3px;
  color: #000;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;
  padding: 8px 11px;
  text-decoration: none;
			}
    </style>
</head>
<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
 }else{
 document.getElementById('prg1').disabled = true;
 }
}
</script> 

 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>

<!--ESTILO CUERPO-->


<div align="center">
	<br /><br /><br /><br  style="background-position:center"/>
	<p><b><h2>Estado de Cuenta</h2></b></p><br>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<td><b>Numero de contrato:</b></td>
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="		Ingresa aqui tu texto" value="<?PHP echo $_GET['numero']; $_POST['contrato']?>">
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
    <br>
		<div class="cajon1"  align="rigth">
        
			<?php
			//print_r($_POST);
					if(isset($_POST['submit'])) {
					conectar();
					EstadoCuenta();
				}
				else if(isset($_POST['campo']))
				{
					echo "<br><br><br><div id='style2' class='style2' align='right'><a href='reajuste_saldos.php?num=".$_POST['campo']."'><button><strong>Calendario de Pagos</strong></button></a></div>";
					
					EstadoCuenta();
				}
				
			?>
            <br><br><br><br><br><br>
           </div>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
           <div class="cajon2" align="center"  >
           <?		  
		  // echo cantidad_subcontratos($_POST['campo']);
		  $NSub=cantidad_subcontratos($_POST['campo']);		
		   if(($NSub>=2)&&(strlen($_POST['campo'])<10))
		   	{
		   		echo "ES O NO ES";
				$q="select * from contrato where Numero='".$_POST['campo']."'";
				$r=mysql_query($q);
					while($m=mysql_fetch_array($r))
					{
						if(validasubcontrato($_GET['numero'])){// valida si tiene subcontratos -> mostramos  listas de subcontratos
							$query="select * from contrato where Numero like ('".$_POST['campo']."%')";
							$result=mysql_query($query);
							echo '<table border="4px" bordercolor="#0033CC" bgcolor="#FFF">';
							echo '<tr>
									<td align="center"><h6>Sub Contrato</h6></td>
									<td align="center">Nombre</td>
									<td align="center"><h6><b>Abono</b>	</h6></td>
									<td align="center"><h6><b>Ver</b>	</h6></td>
								</tr>';
							while($subcontrato=mysql_fetch_array($result))
								{									
									echo "<tr>
									<td align='center'><h6><b>".$subcontrato['Numero']."</b></h6></td>
									<td align='center'><h6>".$subcontrato['nombre']."</h6></td>
									<td align='center'><h6>$".round(abono($subcontrato['Numero']),2)."</h6></td>
									<td>
									<form action='' method='POST'>
										<input type='hidden' value=".$subcontrato['Numero']."  name='campo'/>
										<input type='submit' value='Ver'/>
										<imput type='hidden' name='sub' value='1'>
									</form></td>
									</tr>"; 
								}
							echo '</table></div>';
					}
			}           
			}
			
			$cant=mysql_query('select count(*) as t from contrato where Numero like "'.$_POST['campo'].'-%"');
			$mcant=mysql_fetch_array($cant);
			if($mcant['t']>1){
				echo "<div class='cajon3' align='right'> <a href='MSaldo.php?numero=".$_POST['campo']."'><button class='BOTON'>SUB-CONTRATOS</button></a></div>";
			}
		   ?>
           </div>

 </div>
    <?php  pie();?>
</body>
</html>

<?php
	function abono($numero){
			$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
			$m=mysql_fetch_array($q);
			
			$q2=mysql_query('Select * from subcontratos where numero="'.$numero.'"');
			$m2=mysql_fetch_array($q2);
			$fechas=explode('%',$m2['fechas']);
			$i=0;$c=0;
			while($i<count($fechas)){
				if($fechas[$i]<date('Y-m-d')){
					$c++;
				}
			$i++;
			}
			$pagos=($m['si']-total_abonos($numero,$m['facturado']))/(count($fechas)-$c);
			return $pagos;
	}
	
	function total_abonos($numero,$facturado){
		if($facturado=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
				$y1="select sum(cantidad) as t from cargofac where numcontrato='".$numero."' ;";
				$y2=mysql_query($y1);
				$y3=mysql_fetch_array($y2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
				$y1="select sum(cantidad) as t from cargo where numcontrato='".$numero."' ;";
				$y2=mysql_query($y1);
				$y3=mysql_fetch_array($y2);
			}
			return $total_abonos['t']-$y3['t'];
	}
?>

