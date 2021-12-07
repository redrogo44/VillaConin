<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
conectar();
validarsesion();
$nivel=$_SESSION['niv'];
libera_manteles();
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


<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="Config/jquery-2.1.1.min.js"></script>

<title>Villa Conin</title>
    <style type="text/css">

             *{
				 padding:0px;
				 margin:0px;
			  }

			  #header{
				  margin:auto;
				  width:900px;
				  right:1000px;
				  height:20px;
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
				.nav li:hover> ul li{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-80%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
				.nav ul li ul li ul{
				right:-90%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
				.cajon1
				{
			 		width:870px;
            		height:150px;
            		/*border: 3px solid #FF0000;*/

				}
				.cajon2
				{
					width:-60px;
            		height:0px;
            		/*border: 3px solid #000000;*/
            		position: left;
				}
				.BOTON
			{
				border: 3px solid #333333;
  border-radius: 3px;
  color: #940707;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;

  padding: 8px 11px;
  text-decoration: none;
			}

				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;}
    </style>

<script type="text/javascript">
	var botonEnviar = document.getElementById('tipo');

function mostrar(id) {
	//alert(id);
	var idd=id.split("%");

	document.getElementById('TE').value=id;
	document.getElementById('TE2').value=id;
	if (idd[1] == 0)
	{
		$("#nodepende").show();
		$("#depende").hide();
		$("#Seleccione").hide();

	}

	if (idd[1] == 1) {
		$("#nodepende").hide();
		$("#depende").show();
		$("#Seleccione").hide();

	}
	if (idd[1] == 2) {
		$("#nodepende").hide();
		$("#depende").hide();
		$("#Seleccione").show();

	}


}
function redireccionar()
{
		window.location="http:index.php";
}
function valida_Fecha(fecha)
{
    //botonEnviar.disabled = false;

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
				    	var xx=xmlhttp.responseText;
				    	if (xx!='0')
				    		{
				    			alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo').attr("disabled", false);
				    		}

				    }
				  }
					xmlhttp.open("POST","ExiteFecha.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("fecha="+fecha+"&salon="+document.getElementById('salon').value);
}
function valida_Contrato()
{
    //botonEnviar.disabled = false;
contrato=document.getElementById('referencia').value;
//alert(contrato);
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
				    	var xx=xmlhttp.responseText;
				    	if (xx!='0')
				    		{
				    			$('#tipo').attr("disabled", false);
				    		}
				    		else
				    		{
				    			alert('NO EXISTE EL CONTRATO DE REFERENCIA.. POR FAVOR, VERIFIQUE SUS DATOS..');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo').attr("disabled", true);
				    		}

				    }
				  }
					xmlhttp.open("POST","ExiteContrato.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("contrato="+contrato);
}
function valida_Salon(sal)
{
		var xmlhttp2;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp2=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp2.onreadystatechange=function()
				  {
				  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
				    {
				    	var xxz=xmlhttp2.responseText;
				    	//alert(xxz);
				    	if (xxz!='0')
				    		{
				    			alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo').attr("disabled", false);
				    		}
				    }
				  }
					xmlhttp2.open("POST","ExiteFecha.php",true);
					xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp2.send("fecha="+document.getElementById('fecha').value+"&salon="+sal);
}
function valida_Salon2(sal)
{
	//alert('salon 2 '+ sal);
		var xmlhttp3;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp3=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp3.onreadystatechange=function()
				  {
				  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
				    {
				    	var xxzz=xmlhttp3.responseText;
				    	//alert(xxzz);
				    	if (xxzz!='0')
				    		{
				    			alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo2').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo2').attr("disabled", false);
				    		}
				    }
				  }
					xmlhttp3.open("POST","ExiteFecha.php",true);
					xmlhttp3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp3.send("fecha="+document.getElementById('fecha2').value+"&salon="+sal);
}
function valida_Fecha2(fecha2)
{
  //botonEnviar.disabled = false;
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
				    	var xx=xmlhttp.responseText;
				    	if (xx!='0')
				    		{
				    			alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo').attr("disabled", false);
				    		}

				    }
				  }
					xmlhttp.open("POST","ExiteFecha.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("fecha="+fecha2+"&salon="+document.getElementById('salon2').value);
}		
</script>
</head>


<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >


<div align="center">
<br><br>
<?php
$usuario=$_SESSION['usu'];
echo      "<b>&nbsp&nbsp&nbsp usuario:  ".$usuario."</b>";
$us=mysql_query("SELECT * FROM usuarios WHERE nivel=4");

?>
</div>

<br><br>

<div align="center">
	Seleccione el Tipo de Evento:
     <select id="status" name="status" onChange="mostrar(this.value);">
     <option value='2'  >Seleccione una Opcion</option>
    <?php
	$Se=mysql_query('SELECT * FROM Configuraciones Where nombre="Eventos Adicionales"');
	$eve=mysql_fetch_array($Se);
	$Evento	= explode(',',$eve['descripcion']);
	for($i=0;$i<count($Evento);$i++)
	{
		$EvT=explode('%',$Evento[$i]);
	    echo "Evento ".$Evt[$i];

		echo "
				<option value=".$Evento[$i].">".$EvT[0]."</option>

			 ";
	}


	?>
     </select>

<div id="depende" class="element" style="display: none;">
<br><br>

    <form action="GuardaEvento.php" method="post" target="_blank" name='form1'>
    <table>
	<tr>
    	<td><b>Ingresa el Contrato Referencia:</b></td>
    	<!--onmouseout='valida_Contrato(this.value	)'-->
	    <td><input type="text" name="referencia"  id='referencia'/></td>
    </tr>
    <tr><td colspan="2" align="center"><b>Comensales</b></td></tr>
    <tr>
    	<td><b>Numero de Adultos:</b></td>
    	<td><input type="number" name="c_adultos" onkeyup="valida_Contrato()" /></td>
     </tr>
     <tr>
    	<td><b>Numero de Jovenes:</b></td>
    	<td><input type="number" name="c_jovenes" onkeyup="valida_Contrato()"/></td>
     </tr>
     <tr>
    	<td><b>Numero de Niños:</b></td>
    	<td><input type="number" name="c_ninos" onkeyup="valida_Contrato()"/></td>
     </tr>
      <tr>
      <td><b>Selecciona el Salon:</b></td>
	   <td>
          <select name="salon" id='salon' onchange="valida_Salon(this.value)">
	      <option >SELECCIONE UNA OPCION</option>
          <option value='Fundador de Conin'>Fundador de Conin</option>
          <option value='Alcazar de Conin'>Alcazar de Conin</option>
          <option value='Real de Conin'>Real de Conin</option>
          <option value='Solar de Conin'>Solar de Conin</option>
		  <option value='Marques'>Marques</option>
          </select>
        </td>
  </tr>
     <tr>
     	<td><b>Ingresa la Fecha del Evento:</b></td>
    	<td><input type="date" name="fecha" id='fecha' onchange="valida_Fecha(this.value)"/></td>
	</tr>

  <tr> <td><b>Seleccione un  vendedor:</b></td>
    	<td><select name="vendedor" onchange="valida_Contrato()">
	               <option value='Se'>SELECCIONE UNA OPCION</option>
			<?php
            while($vendedor=mysql_fetch_array($us))
            {
                echo "Vendedro ".$vendedor['usuario'];
                $usua=explode(' ', $vendedor['usuario']);
	               echo " <option value='".$usua[1]."'>".$usua[1]."</option>";
            }
             ?>
        </select>
        </td>
      </tr>
      </table>
      <br /><br/>
   <input type="hidden" name="TE" value="" id='TE' />
   			<input type="hidden" name="Depender" value="si" />
        <input type="button" name="tipo" id='tipo' value="Registrar Evento Con Dependencia" onclick="valida_envia()" />
    </form>
</div>

<div id="nodepende" class="element" style="display: none;">
<br><br>
   <form action="GuardaEvento.php" method="post" target="_blank" name='form2'>
		<table>
		    <tr><td colspan="2" align="center"><b>Comensales</b></td></tr>
		    <tr>
		    	<td><b>Numero de Adultos:</b></td>
		    	<td><input type="number" name="c_adultos"/></td>
		     </tr>
		     <tr>
		    	<td><b>Numero de Jovenes:</b></td>
		    	<td><input type="number" name="c_jovenes" /></td>
		     </tr>
		     <tr>
		    	<td><b>Numero de Niños:</b></td>
		    	<td><input type="number" name="c_ninos" /></td>
		     </tr>
		      <tr>
		      <td><b>Selecciona el Salon:</b></td>
			   <td>
		          <select name="salon" id='salon2' onchange="valida_Salon2(this.value)">
			      <option >SELECCIONE UNA OPCION</option>
		          <option value='Fundador de Conin'>Fundador de Conin</option>
		          <option value='Alcazar de Conin'>Alcazar de Conin</option>
		          <option value='Real de Conin'>Real de Conin</option>
		          <option value='Solar de Conin'>Solar de Conin</option>
		          <option value='Marques'>Marqués</option>
		          </select>
		        </td>
		  </tr>
		     <tr>
		     	<td><b>Ingresa la Fecha del Evento:</b></td>
		    	<td><input type="date" name="fecha" id='fecha2' onchange="valida_Fecha2(this.value)"/></td>
			</tr>
			<tr>
			  	<td><b>Seleccione un  vendedor:</b></td>
			    	<td>
			    		<select name="vendedor" >
				            <option value='Se'>SELECCIONE UNA OPCION</option>
							<?php
							$us=mysql_query("SELECT * FROM usuarios WHERE nivel=4");
			            	while($vendedor=mysql_fetch_array($us))
			            	{
			                	$usua=explode(' ', $vendedor['usuario']);
				            	   echo " <option value='".$usua[1]."'>".$usua[1]."</option>";
			            	}
			             	?>
        				</select>
        			</td>
      		</tr>
      	</table>
      		<br /><br/>
   			<input type="hidden" name="TE2" value="" id='TE2' />
   			<input type="hidden" name="Depender" value="no" />
        	<input type="button" name="tipo2" id='tipo2' value="Registrar Evento Con Dependencia" onclick="valida_envia2()" />
    </form>
</div>
<div id="Seleccione" class="element" style="display: none;">
<br><br>

     <h1><font color="#003366"><b>Seleccione una Opcion</b></font></h1>
</div>


</div>
<?php
/////
pie();
?>
<script>

function validarEntero(valor){
      //intento convertir a entero.
     //si era un entero no le afecta, si no lo era lo intenta convertir
     valor = parseInt(valor)

      //Compruebo si es un valor numérico
      if (isNaN(valor)) {
            //entonces (no es numero) devuelvo el valor cadena vacia
            return ""
      }else{
            //En caso contrario (Si era un número) devuelvo el valor
            return valor
      }
}

function valida_envia(){
	//valido el nombre
	if (document.form1.referencia.value.length==0){
		alert("Ingrese un Contrato de Referencia para este Evento")
		document.form1.referencia.focus()
		return 0;
	}

	//valido la edad. tiene que ser entero mayor que 18
	adul = document.form1.c_adultos.value
	//adul = validarEntero(adul)
	document.form1.c_adultos.value=adul
	if (adul==""){
		alert("Ingrese una Cantidad de Adultos.")
		document.form1.adul.focus()
		return 0;
	}
	jov = document.form1.c_jovenes.value
	//jov = validarEntero(jov)
	document.form1.c_jovenes.value=jov
	if (jov==""){
		alert("Ingrese una Cantidad de Jovenes.")
		document.form1.jov.focus()
		return 0;
	}
	nin = document.form1.c_ninos.value
	//nin = validarEntero(nin)
	document.form1.c_ninos.value=nin
	if (nin==""){
		alert("Ingrese una Cantidad de Niños.")
		document.form1.nin.focus()
		return 0;
	}

	//valido el interés
	if (document.form1.vendedor.selectedIndex==0){
		alert("Debe seleccionar un Vendedor.")
		document.form1.vendedor.focus()
		return 0;
	}
	if (document.form1.salon.selectedIndex==0){
		alert("Debe seleccionar un Salon.")
		document.form1.salon.focus()
		return 0;
	}
	if (document.form1.fecha.value.length==0){
		alert("Ingrese una Fecha Valida")
		document.form1.fecha.focus()
		return 0;
	}

	//el formulario se envia
	alert("Registro Exitoso!!");
	document.form1.submit();
	setTimeout ("redireccionar()", 5000);
}
function valida_envia2()
{

	adul2 = document.form2.c_adultos.value
	//adul = validarEntero(adul)
	document.form2.c_adultos.value=adul2
	if (adul2==""){
		alert("Ingrese una Cantidad de Adultos.")
		document.form2.adul2.focus()
		return 0;
	}
	jov2 = document.form2.c_jovenes.value
	//jov = validarEntero(jov)
	document.form2.c_jovenes.value=jov2
	if (jov2==""){
		alert("Ingrese una Cantidad de Jovenes.")
		document.form2.jov2.focus()
		return 0;
	}
	nin2 = document.form2.c_ninos.value
	document.form2.c_ninos.value=nin2
	if (nin2==""){
		alert("Ingrese una Cantidad de Niños.")
		document.form2.nin2.focus()
		return 0;
	}

	//valido el interés
	if (document.form2.vendedor.selectedIndex==0){
		alert("Debe seleccionar un Vendedor.")
		document.form2.vendedor.focus()
		return 0;
	}
	if (document.form2.salon.selectedIndex==0){
		alert("Debe seleccionar un Salon.")
		document.form2.salon.focus()
		return 0;
	}
	if (document.form2.fecha.value.length==0){
		alert("Ingrese una Fecha Valida")
		document.form2.fecha.focus()
		return 0;
	}

	//el formulario se envia
	alert("Registro Exitoso!!");
	document.form2.submit();
	setTimeout ("redireccionar()", 5000);
}
</script>
</body>
</html>
