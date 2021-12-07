<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
	require "configuraciones.php";
	conectar();
	validarsesion();
$nivel=$_SESSION['niv'];
	if ($nivel==2) 
	{	
		menunivel3();
	}
	else
	{
	menuconfiguracion();		
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
				right:-140px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.button 
						{
							   border-top: 1px solid #8f0d0d;
							   background: #9c132a;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #a12a2e, #9c132a);
							   background: -moz-linear-gradient(top, #a12a2e, #9c132a);
							   background: -ms-linear-gradient(top, #a12a2e, #9c132a);
							   background: -o-linear-gradient(top, #a12a2e, #9c132a);
							   padding: 8px 16px;
							   -webkit-border-radius: 10px;
							   -moz-border-radius: 10px;
							   border-radius: 10px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ffffff;
							   font-size: 14px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #b02128;
							   background: #b02128;
							   color: #ffffff;
							   }
							.button:active {
							   border-top-color: #0f2d40;
							   background: #0f2d40;
			   }
			 
			   
    </style>    
</head>
   <link rel="stylesheet" href="tablas2.css" type="text/css"/>	
   <link rel="stylesheet" href="demo.css">
	<link rel="stylesheet" href="pop/demo.css">

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

//print_r($_POST);

?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>MODIFICAR CATEGORIA</h1>
   <br><br>
	  <form method="post" name='formulario' action="<?php echo $_SERVER['PHP_SELF']; ?>">      		
			   <select name="categoria" onchange="verifica(this.value)">
			   	<option value="Seleccione">Seleccione una Opcion</option>
			   	<?php
			   		$c=mysql_query("SELECT * FROM Configuraciones WHERE tipo='Nomina'");
			   		while ($cat=mysql_fetch_array($c)) 
			   		{
			   			echo '<option value="'.$cat['descripcion'].'">'.$cat['descripcion'].'</option> ';
			   		}
			   	?>
			   </select>
			   <br>
			   <br>
					<input type="submit"  id='elimina' name="eliminar" value="ELIMINAR CATEGORIA">
		</form>

		<?php
			if (isset($_POST['eliminar'])) 
			{
				mysql_query("DELETE FROM  Configuraciones WHERE descripcion='".$_POST['categoria']."'");
				echo "	
						<script>		
							alert('SE AH ELIMINADO CORRECTAMENTEE LA CATEGORIA EXITOSAMENTE AHORA SERA REDIRECCIONADO');
						</script>

						<META HTTP-EQUIV='Refresh' CONTENT='0; URL=Insert_Meseros.php'>
					";
			}
		?>
<br></br>
	<script type="text/javascript">
		document.getElementById('formulario').hidden;

		function verifica(op)
		{
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
				    			formulario.eliminar.disabled=true;				    					    							    			
				    			alert('AUN EXISTE ALGUN MESERO CON ESTA CATEGORIA, ANTES DE ELIMINAR LA CATEGORIA DEBE MOVER AL PERSONAL EXISTENTE A CUALQUIER OTRA CATEGORIA');
				    		}
				    		else
				    		{
				    			alert('RECUERDE QUE AL ELIMINAR UNA CATEGORIA SE PERDERA SU INFORMACION Y SERA IMPOSIBLE RECUPERARLA');
				    			if(confirm(' ¿ ESTA COMPLETAMENTE SEGURO DE ELIMINAR LA CATEGORIA. ?')) 
				    				{
				    					formulario.eliminar.disabled=false;				    			 	
				    				}				    			
				    		}

				    }
				  }
					xmlhttp.open("POST","VerificarRegistros_Meseros.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("categoria="+op);
		}
	</script>

</body>
<?php
pie();
?>
</html>