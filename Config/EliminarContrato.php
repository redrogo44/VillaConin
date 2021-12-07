<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menuconfiguracion();				
}
if($nivel==1)
{
menuconfiguracion();		
}
if($nivel==2)
{
menuconfiguracion2();
}
if($nivel==3)
{
menuconfiguracion3();
}
if($nivel==4)
{
menuconfiguracion4();
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->


<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Cancelacion de Contratos</h2></b></p>
    <script>alert("TENGA EN CUENTA QUE AL CANCELAR UN CONTRATO, ESTE SE ELIMINARA DEL SISTEMA Y NO PODRA RECUPERARSE HASTA QUE SE CREE DE NUEVO, POR TANTO LA FECHA, EL SALON, LOS ABONOS Y CARGOS SE PERDERAN PARA ESTE CONTRATO")</script>
    <div class="wrapper wrapper-style4">
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>Numero</option>
                <option>Todos</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35"  placeholder="		Ingresa aqui tu texto">
		<input type="submit" name="submit" value="Buscar">
		</form>
       </div>
	   	<?php
	   conectar();
		$c="select * from contrato where Numero='".$_GET['numero']."'";
		$r=mysql_query($c);
		$m=mysql_fetch_array($r);
		if($m['facturado']=='si'){
		$abonos="select sum(cantidad) as total from abonofac where numcontrato='".$_GET['numero']."'";
		$rabonos=mysql_query($abonos);
		$mabonos=mysql_fetch_array($rabonos);
		
		}else{
		$abonos="select sum(cantidad) as total from abono where numcontrato='".$_GET['numero']."'";
		$rabonos=mysql_query($abonos);
		$mabonos=mysql_fetch_array($rabonos);
		}

	   ?>
	   <script>
	   function calcular(){
		var cargo = document.getElementById('cargo').value;
	    var abonos=<?php echo $mabonos['total'];?>;
		var total=cargo-abonos;
		if(total<0){
			document.getElementById ('t2').style.color = "#FF0000"; 
			//document.getElementById ('env').disabled = false;
		}else{
			document.getElementById ('t2').style.color = "#000000";
			//document.getElementById ('env').disabled = true;
	   }
		   document.getElementById('t').value = total;
		   document.getElementById('t2').innerHTML = total;
	   } 
	   </script>
	   
		<div class="wrapper">
		<br><br><br>
		<form  action="CancelarC.php" method="POST">
		<table border='6' bordercolor="#990000">
		<tr><td COLSPAN="4" align="center"><strong>DATOS DEL CONTRATO</strong></td></tr>
		<tr><td><label>Nombre</label></td><td><?php echo $m['nombre'];?></td><td><label>Numero</label></td><td><?php echo $m['Numero'];?></td></tr>
		<tr><td><label>Tipo de Evento</label></td><td><?php echo $m['tipo'];?></td><td><label>Fecha</label></td><td><?php echo $m['Fecha'];?></td></tr>
		<tr><td><label>Salon</label></td><td><?php echo $m['salon'];?></td><td><label>Total de Abonos</label></td><td>$<?php echo $mabonos['total'];?></td></tr>
		<tr><td><label>Cargo por Cancelacion</label></td><td><input id="cargo" name="cargo" type="number" min='0' onchange="calcular();" required></td><td>Devolución </td><td><input type="hidden" name="devuelto" id='t'><strong><p id='t2'></p></strong></td></tr>
		<tr><td colspan="4" align="center"><input id="env" type="submit" value="Cancelar Contrato" ></td></tr>
		</table>
		<input type="hidden" name="numero" value="<?php echo $_GET['numero'] ?>">
		</form>
	
</body>
</html>
