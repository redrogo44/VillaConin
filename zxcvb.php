<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
validarsesion();
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
conectar();
if(empty($_GET['numero'])){
	$n=$_POST['numero'];
}else{
	$n=$_GET['numero'];
}

$q="select * from contrato where Numero='".$n."'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
?>
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
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
			#fname{
				font-family: Arial; font-size: 15pt; 
				
				}
			#button {
			   border-top: 1px solid #96d1f8;
			   background: #65a9d7;
			   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
			   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
			   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
			   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
			   background: -o-linear-gradient(top, #3e779d, #65a9d7);
			   padding: 9.5px 19px;
			   -webkit-border-radius: 40px;
			   -moz-border-radius: 40px;
			   border-radius: 40px;
			   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   box-shadow: rgba(0,0,0,1) 0 1px 0;
			   text-shadow: rgba(0,0,0,.4) 0 1px 0;
			   color: white;
			   font-size: 15px;
			   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
			   text-decoration: none;
			   vertical-align: middle;
			   }
			#button:hover {
			   border-top-color: #28597a;
			   background: #28597a;
			   color: #ccc;
			   }
			#button:active {
			   border-top-color: #175c87;
			   background: #175c87;
			   }
   </style>
	
	

<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff" align='center' >
<br><br><br><br><br><br><center>
<?php
	if(isset($_POST['opcion'])){
	$actualiza="UPDATE contrato set deposito=".$_POST['depo']." where Numero='".$n."'";	
	$are=mysql_query($actualiza);
	$si=saldo_i($n,$m['facturado']);
	$us="UPDATE contrato set si=".$si." where Numero='".$n."'";
	$are2=mysql_query($us);
	echo "<script>";
	echo "alert('Registro exitoso');";
	echo "</script>";
	echo '<meta http-equiv="Refresh" content="0;url=depositos_faltantes.php">';
	die();
	}
function saldo_i($NumeroContrato,$fac){
$query="select * from contrato where Numero='".$NumeroContrato."'";
$resultado=mysql_query($query);
$m=mysql_fetch_array($resultado);
$t_adultos=$m['c_adultos'];
$t_jovenes=$m['c_jovenes'];
$t_ninos=$m['c_ninos'];
$p_adultos=$m['p_adultos'];
$p_jovenes=$m['p_jovenes'];
$p_ninos=$m['p_ninos'];
$deposito=$m['deposito'];
	if($fac=='si'){
		$S1=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos);
		$S2=$S1*1.16;
		$SI=$S2+$deposito;
	}else{
		$SI=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos)+($deposito);
	}
return $SI;
}
?>
<form action='zxcvb.php' method='POST' onsubmit='return error1()'>
<input type='hidden' name='numero' value='<?php echo $n; ?>'>
<input type='hidden' name='opcion' value='agregar'>
<div id="style1"class="style1">
	<table border='1'>
<tr><td>Deposito</td><td><input type='number' name='depo' min='0'></td></tr>
</table>
</div>
<br><br>
<input type='submit' value='Guardar'>
</form><br><br>

</body>
</html>