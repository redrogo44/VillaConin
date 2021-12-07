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
<html xmlns="http://www.w3.org/1999/xhtml">
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
				top:0px;}			 
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
<body>

 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->

<script src="includes/prototype.js" type="text/javascript"></script>
<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <br />
	<p><b><h2>Crear Cargo</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		  
			<td><b>Numero de conriatrato:</b></td>
            <input type="text" name="campo" size="15" maxlength="35" required="required" placeholder="	Contrato">
            <select name="categoria" size="1" id="categoria">
				<option>Seleccione Una Opcion</option>
				<option>Cargo de Servicio</option>
				<option>Cargo de Comensales</option>
			<input type="submit" name="submit" value="Buscar">
		</form>
        <br />
		</div>
		<div class="wrapper">
			<?php
			
					if(isset($_POST['submit'])) 
					{	
					
							echo " <b>Seleccione los Servicios que Requiera para Realizar el Cargo</b>
							
							<br/>
							<form action='cargarabono.php' method='post'>
							<table border='6'bordercolor='#990000'>
							
									<tr>
										<td>
										
											<select id='select' size=15 style='color:#009'>
											</select>
										</td><td>
											<input type='button' onClick='add1();' value ='>>'/><br/>
											<input type='button' onClick='add2();' value ='<<'/>
										</td><td>
										
										<select multiple  size='15' id='select2' name='select2[]' ></select>
		</select>
										</td>
									</tr>
								</table>
								<br/>
								 <input type='submit' onClick='seleccionar()' value='Enviar' />
								 <input type='hidden' 
						</form>";
				



					}
						if($_POST['categoria']=="Cargo de Comensales")
						{
						buscarcontraCarogo();
						}
						else
						{
								
						}
				    

			?>
            
     
<script type="text/javascript">
function imprime()
{
<?php	
	for ($i=0;$i<count($cervezas);$i++)    
	{     
		echo "<br> Cerveza " . $i . ": " . $cervezas[$i];    
	}
?>
}
function add1()
{
	if (getSelectText($('select'))!=null)
	{
		var option=new Element('option',{"value":$F('select')}).update(getSelectText($('select')));
		$('select2').appendChild(option);
		removeOption ($('select'), $F('select'))
	}
}
function add2()
{
	if (getSelectText($('select2'))!=null)
	{
		var option=new Element('option',{"value":$F('select2')}).update(getSelectText($('select2')));
		$('select').appendChild(option);
		removeOption ($('select2'), $F('select2'));
	}
}

function removeOption (element, id)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==id)
		{
			element.down(n).remove();
		}
		n++;
	}
}

// funcion que devuelve el texto
function getSelectText(element)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==element.getValue())
		{
			return(element.down(n).innerHTML)
		}
		n++;
	}
	return null;
}
function seleccionar(){
	select = document.getElementById("select2");
	for (var i = 0; i < select.options.length; i++) {
		select.options[i].selected = true;
	}
}
<?PHP 
$q="Select * from Servicios";
$consulta=mysql_query($q);
$var =1;
while($con=mysql_fetch_array($consulta))
{
	$option=$con['Servicio'];
	echo "var option = new Element('option',{'value':".$var."}).update('".$option."');
	$('select').appendChild(option);";
	$var=$var+1;
}
?>
// agrego valores al select


</script>
</body>

<?php
	
?>
</html>

