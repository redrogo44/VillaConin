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

?>
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
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
<head>
<script type="text/javascript" src="js/shortcut.js"></script>
</head>

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<script>
<?php
conectar();
 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
  $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
?>
shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
document.getElementById('no_facturados').style.display='none';
});

shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
document.getElementById('no_facturados').style.display='block';
});
</script>

<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Contratos Finalizados</h2></b></p>

		<div class="wrapper">
		<table border='4'>
		<tr><th>Numero</th><th>Nombre</th><th>Fecha</th><th><Salon/th><th>Tipo de Evento</th><th>Ver Logistica</th></tr>
			<?php
					conectar();
					finalizados();
			?>
			
		</table><br><br>
			<div id="no_facturados" style="display:none;">
			 <p><b><h2 style="color:#FC0316">Contratos Finalizados no Facturados</h2></b></p>
			<table border='1'>
			<tr><th>Numero</th><th>Nombre</th><th>Fecha</th><th><Salon/th><th>Tipo de Evento</th><th>Ver Logistica</th></tr>
			<?php 
			finalizados2();
			?>
			</table><br><br>
			</div>
			</div>
			<?php pie();?>
			</div>
</body>
<script type="text/javascript">
	function verlog(a){
		 window.open('PDF_logistica.php?n='+a, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
	}
</script>
</html>
<?php

	function finalizados(){
		$q="select * from contrato where facturado='si' and estatus=2 and tipo!='MOSTRADOR' Order by Fecha";
		$r=mysql_query($q);
		while($m=mysql_fetch_array($r)){
		$log= mysql_num_rows(mysql_query("SELECT * FROM logistica WHERE numero='".$m['Numero']."'"));	
			if ($log>0) 
			{
			echo "<tr>";
				echo "<td>".$m['Numero']."</td>"."<td>".$m['nombre']."</td>"."<td>".$m['Fecha']."</td>"."<td>".$m['Salon']."</td>"."<td>".$m['tipo']."</td><td align='center'><input type='button' name='".$m['Numero']."' value='Ver Logistica' Onclick='verlog(this.name);''></td>";
				echo "</tr>";
			}
			else {
			echo "<tr>";
			echo "<td>".$m['Numero']."</td>"."<td>".$m['nombre']."</td>"."<td>".$m['Fecha']."</td>"."<td>".$m['Salon']."</td>"."<td>".$m['tipo']."</td><td align='center'>Sin Logistica</td>";
			echo "</tr>";
			}
			
		}
	}
	function finalizados2(){
		$q="select * from contrato where facturado='no' and estatus=2 and tipo!='MOSTRADOR' Order by Fecha";
		$r=mysql_query($q);
		while($m=mysql_fetch_array($r)){
			$log= mysql_num_rows(mysql_query("SELECT * FROM logistica WHERE numero='".$m['Numero']."'"));	
			if ($log>0) 
			{
				echo "<tr>";
				echo "<td>".$m['Numero']."</td>"."<td>".$m['nombre']."</td>"."<td>".$m['Fecha']."</td>"."<td>".$m['Salon']."</td>"."<td>".$m['tipo']."</td><td align='center'><input type='button' name='".$m['Numero']."' value='Ver Logistica' Onclick='verlog(this.name);''></td>";
				echo "</tr>";
			}
			else{
				echo "<tr>";
				echo "<td>".$m['Numero']."</td>"."<td>".$m['nombre']."</td>"."<td>".$m['Fecha']."</td>"."<td>".$m['Salon']."</td>"."<td>".$m['tipo']."</td><td align='center'>Sin Logistica</td>";
				echo "</tr>";
			}
		}
	}


?>