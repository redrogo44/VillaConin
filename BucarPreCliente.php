<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
conectar();
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
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
					table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    	font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; }

			th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
	    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

				td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

		tr:hover td { background: #d0dafd; color: #339; }
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
</head>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Buscar Pre-Cliente</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria" onchange="valida(this.value,1);">
				<option value="0">Selecciona una opción</option>
                <option value="nombre">Nombre</option>
				<option value="ap">Apellido Paterno</option>
                <option value="tipo">Tipo de Evento</option>
                <option value="registro">Vendedor </option>
                <option value="todos">Todos </option>
			</select>
			<select name="vendedor1" id="vendedor1" style="display: none;">
			<?php 
			$vv=mysql_query("SELECT * FROM usuarios WHERE nivel=4");
			while ($v=mysql_fetch_array($vv)) 
			{
				$ven=explode(" ",$v['usuario']);
				echo "<option value='".$v['usuario']."'>".$ven[1]."</option>";
			}

			?>						
			</select>
			<input type="text" name="campo1" size="35"  id='campo1' placeholder="	Ingresa aqui tu texto"><br><br>
			<select name="categoria2" size="1" id="categoria2"onchange='valida(this.value,2)'>
				<option value="0">Selecciona una opción</option>
                <option value="nombre">Nombre</option>
				<option value="ap">Apellido Paterno</oinlinen>
                <option value="tipo">Tipo de Evento</option>
                <option value="registro">Vendedor </option>
                <option value="todos">Todos </option>
		</select>
		<select name="vendedor2" id="vendedor2" style="display: none;">
			<?php 
			$vv=mysql_query("SELECT * FROM usuarios WHERE nivel=4");
			while ($v=mysql_fetch_array($vv)) 
			{
				$ven=explode(" ",$v['usuario']);
				echo "<option value='".$v['usuario']."'>".$ven[1]."</option>";
			}

			?>						
			</select>
			<input type="text" name="campo2" id="campo2" size="35"   placeholder="	Ingresa aqui tu texto">
            <br><br>
            Fechas &nbsp;&nbsp;<font color="green"><b>DE</b></font>&nbsp;&nbsp;<input type="date" name="fecha1">&nbsp;&nbsp;<font color="#F00"><b>HASTA</b></font>&nbsp;&nbsp;<input type="date" name="fecha2">
            <br><br>

		<input type="submit" name="submit" value="Buscar">
		</form>       
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					//conectar();
					BUSCARPREREGISTRO();					
				}
				pie();
			?>
</body>
<script>
function preguntar(n){
 if(confirm("Desea eliminar al Precliente")){
	razon=prompt("¿Cuál es la razon de cancelacion de contrato?");
	location.href="Eliminar_PreCliente.php?numero="+n+"&&razon="+razon;
 }
}
function valida(a,b)
{
	//alert(a+" " +b);
	if (a=='registro') 
		{
			document.getElementById('vendedor'+b).style.display = 'inline';
			document.getElementById('campo'+b).style.display = 'none';
		}
		else
		{
			document.getElementById('vendedor'+b).style.display = 'none';			
		}
}
function presupuesto(id)
{
	location.href='presupuesto.php?numero='+id;
}
function modificar_presupuesto(id)
{
	location.href='presupuesto.php?numero='+id;
}
function ver_presupuesto(id)
{
	location.href='PDF_Presupuesto.php?numero='+id;
}
function guardarComen(i)
{
	//alert(document.getElementById(i).value);
	var xmlhttp;
	if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			document.getElementById("dialog").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","guarda_coment.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+i+"&comen="+document.getElementById(i).value);

}

function validar_presupuesto(numero){
	var xmlhttp;
	if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			if(xmlhttp.responseText=="OK"){
					location.href="Cliente-nuevo.php?numero="+numero;
				}else{
					alert("Error al precliente le falta el presupuesto");
				}
    		}
  	}
		xmlhttp.open("POST","validar_presupuesto.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+numero);
}

</script>
</html>	
