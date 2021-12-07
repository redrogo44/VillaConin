<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menuconfiguracion();
}
conectar();
?>
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="../js/shortcut.js"></script>
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
<?php
function combo(){
		$r=mysql_query("select categoria from  Gastos_categoria  group by categoria");
		echo "<select id='categoria' name='categoria'  onchange='load(this.value)' required>
		<option></option>";
		while($m=mysql_fetch_array($r)){
			echo "<option value='".$m['categoria']."'>".$m['categoria']."</option>";
		}
		echo "</select>";
}
?>

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<script src="sub_categorias.js"></script>
<br><br><br><br>
<br><br>
<center>
<table>
<tr><td><button onclick="valida(1)">Agregar Categoria</button></td>
<td><button onclick="valida(2)">Modificar Categoria</button></td>
<td><button onclick="valida(3)">Eliminar Categoria</button></td></tr><tr>
<td><button onclick="valida(4)">Agregar Sub-Categoria</button></td>
<td><button onclick="valida(5)">Modificar Sub-Categoria</button></td>
<td><button onclick="valida(6)">Eliminar Sub-Categoria</button></td></tr>
</table>
<br><br>
<table>
<form action="popups.php" method="POST">
<tr><th colspan='2' align ='center'>Gastos</th></tr>
<tr><td><label>Fecha</label></td><td><input type="date" name="fecha" required></td></tr>
<tr><td><label>Tipo de Gasto</label></td><td><?php combo();?></td><td><div id="sub"> </div></td></tr>
<tr><td>Cuenta</td>
<td><select name='cuenta'>
<option></option>
<option value='ixe fis'>IXE FIS</option>
<option value='banamex villa'>BANAMEX VILLA</option>
<option value='banamex tarjeta city'>BANAMEX TARJETA CITY(NEGRA)</option>
<option value='banamex puente'>BANAMEX PUENTE</option>
</select></td></tr>
	     
<tr><td><label>Concepto</label></td><td><input type="text" name="concepto" required></td></tr>
<tr><td><label>Cantidad</label></td><td><input type="number" name="cantidad" min="0" required></td></tr>
<br><br>
<input type='hidden' id="subcat" name='subcat' value="___">
<input type='hidden' name='opcion' value='7'>
<tr><td colspan='2' align="center"><input type='submit'  value='Generar Gasto'  onclick="return mostrar(this.form)"></td></tr>
</form>
</table>
<table>
<tr><th colspan='2' align ='center'>Traspasos</th></tr>
<tr><td><label>Tipo de traspaso</label></td>
<td>
<select id='traspaso' onchange='traspaso()'>
<option></option>
<option value='a'>Entre Cuentas</option>
<option value='b'>Cuentas a Efectivo</option>
<option value='c'>Efectivo a Cuenta</option>
</select></td><tr>
</table>
<div id='tr1' style="display:none;">
<table>
<form action="popups.php" method="POST">
	<tr><td><label>Origen<label></td><td><select name='cuenta' required>
	<option></option>
	<option value='ixe fis'>IXE FIS</option>
	<option value='banamex villa'>BANAMEX VILLA</option>
	<option value='banamex tarjeta city'>BANAMEX TARJETA CITY(NEGRA)</option>
	<option value='banamex puente'>BANAMEX PUENTE</option>
	</select></td></tr>
	<tr><td><label>Destino<label></td><td>
	<select name='cuenta2' required>
	<option></option>
	<option value='ixe fis'>IXE FIS</option>
	<option value='banamex villa'>BANAMEX VILLA</option>
	<option value='banamex tarjeta city'>BANAMEX TARJETA CITY(NEGRA)</option>
	<option value='banamex puente'>BANAMEX PUENTE</option>
	</select></td></tr>
	<tr><td><label>Cantidad<label></td><td><input name='cantidad' type='number' min='0' required></td></tr>
	<input type='hidden' name='opt' value='1'>
	<tr><td colspan='2' align="center"><input type='submit' name='traspaso' value='Generar Traspaso'></td></tr>
	</table>
	</form>
</div>
<div id='tr2' style="display:none;">
<table>
<form action="popups.php" method="POST">
	<tr><td><label>Cuenta<label></td><td><select name='cuenta' required>
	<option></option>
	<option value='ixe fis'>IXE FIS</option>
	<option value='banamex villa'>BANAMEX VILLA</option>
	<option value='banamex tarjeta city'>BANAMEX TARJETA CITY(NEGRA)</option>
	<option value='banamex puente'>BANAMEX PUENTE</option>
	</select></td></tr>
	<tr><td><label>Cantidad<label></td><td><input name='cantidad' type='number' min='0' required></td></tr>
	<input type='hidden' name='opt' value='2'>
	<tr><td colspan='2' align="center"><input type='submit' name='traspaso' value='Generar Traspaso'></td></tr>
	</table></form>
</div>
<div id='tr3' style="display:none;">
<table>
<form action="popups.php" method="POST">
	<tr><td><label>Cantidad<label></td><td><input name='cantidad' type='number' min='0' required></td></tr>
	<tr><td><label>Cuenta<label></td><td><select name='cuenta' required>
	<option></option>
	<option value='ixe fis'>IXE FIS</option>
	<option value='banamex villa'>BANAMEX VILLA</option>
	<option value='banamex tarjeta city'>BANAMEX TARJETA CITY(NEGRA)</option>
	<option value='banamex puente'>BANAMEX PUENTE</option>
	</select></td></tr>
	<input type='hidden' name='opt' value='3'>
	<tr><td colspan='2' align="center"><input type='submit' name='traspaso' value='Generar Traspaso'></td></tr>
	</table></form>
</div>

</center>

</body>
<script>
	function traspaso(){
		t=document.getElementById("traspaso").value;
		
		if(t=='a'){
		d1=document.getElementById("tr1");d1.style.display = "block";
		d2=document.getElementById("tr2");d2.style.display = "none";
		d3=document.getElementById("tr3");d3.style.display = "none";

		
		}else if(t=='b'){
		d1=document.getElementById("tr1");d1.style.display = "none";
		d2=document.getElementById("tr2");d2.style.display = "block";
		d3=document.getElementById("tr3");d3.style.display = "none";

		
		}else if(t=='c'){
		d1=document.getElementById("tr1");d1.style.display = "none";
		d2=document.getElementById("tr2");d2.style.display = "none";
		d3=document.getElementById("tr3");d3.style.display = "block";

	
		}
	}
	
	function valida(s){
		if(s==1){
			window.open('popups.php?op=1','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}else if(s==2){
			window.open('popups.php?op=2','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}else if(s==3){
			window.open('popups.php?op=3','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}else if(s==4){
			window.open('popups.php?op=4','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}else if(s==5){
			window.open('popups.php?op=5','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}else if(s==6){
			window.open('popups.php?op=6','popup','width=300,height=400');
			location.href='ConfiguracionSistema.php';
		}
	}
	function s(v){
		document.getElementById("subcat").value = v;
	}
	function mostrar(){
		d = document.getElementById("boton");
		cat=document.getElementById("categoria").value;
		scat=document.getElementById("sub_categoria").value;
		
		if(cat!='0' && scat!='0'){
			 return true;
		}else{
			 return false;
		}
	}

</script>

</html>
