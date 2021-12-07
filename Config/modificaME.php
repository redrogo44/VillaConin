<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
require 'configuraciones.php';
conectar();
validarsesion();
menuconfiguracion();
?>
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  max-width:900px;
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
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">

<?php
conectar();
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

	$numero=$_GET['numero'];

 $q="Select * from Meseros where id=".$numero;
$co=mysql_query($q) or die(mysql_error());
		while($de=mysql_fetch_array($co))
		{
			$nombre=$de['nombre'];
			$ap=$de['ap'];
			$am=$de['am'];
			$tipo=$de['tipo'];
			$nivel=$de['nivel'];
			$coins=$de['comentarios'];
			$fecha=$de['fechaingreso'];
			$estatus=$de['estatus'];
			$tm=$de['celular'];
			$tc=$de['telefono'];
			$correo=$de['correo'];
			
	
		}


if ($_POST['REDIREC']=1)
    { echo 'son las variables iguales';
 
        ?>
        <script language="javascript">
             
                setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos
        </script>
 
        <?php
    } 
	
?>


<!--ESTILO CUERPO-->


<div align="center">		

	<br /><br /><br  style="background-position:center"/>
	
    <p><b><h2 style="color:#FC0316"><?PHP echo "MODIFICAR DATOS DE <font color='blue'>".$nombre." ".$ap." ".$am."</font>";?></h2></b></p><br /><br />
	<div class="wrapper wrapper-style4">		

    <form method="post"  name="ModificaMe" action="alta_mesero.php">
   <table border="6px" bordercolor="#990000" align="center">
  <tr> <td>Nombre</td><td align="center"><input name="nombre" value="<?php echo $nombre;?>"/></td></tr>
<tr> <td>Apellido Paterno</td><td align="center"><input name="ap" value="<?php echo $ap;?>"/></td></tr>
<tr> <td>Apellido Materno</td><td align="center"><input name="am" value="<?php echo $am;?>"/></td></tr>
<tr><td>Telefono Movil</td><td align="center" ><input name="tm" value="<?php echo $tm;?>"/></td></tr>
<tr><td>Telefono Casa</td><td align="center" ><input name="tc" value="<?php echo $tc;?>" /></td></tr>
<tr><td>Correo</td><td align="center" ><input name="email" value="<?php echo $correo;?>"  /></td></tr>
<tr> <td>Tipo</td>
			<td align="center">
			<select name='categoria' size='1' id='categoria' onchange="">
			<option value='<?php echo $tipo;?>'><?php echo $tipo;?></option>
			<?php
				$tipo=mysql_query("SELECT * FROM Configuraciones WHERE tipo='Nomina'");
				while ($mes=mysql_fetch_array($tipo))
				{
						echo "<option value='".$mes['descripcion']."'>".$mes['descripcion']."</option>";
				}
			?>
            </select>
			</td></tr>                       
          <tr>
          	<td>Fecha de Ingreso</td><td><input type="date"  name="fechaingreso" value="<?php echo $fecha;?>"/></td>
          </tr>
   </table>
    	<br />    <br />
        <input type="hidden" name="tipo" value="Modificar"/>
    	<input type="submit" name="boton"  class="button"/>
        <input type="hidden" name="numero" value="<?php echo $_GET['numero'];?>"/>
       
 
</div>
</div>
<script language="javascript"type="text/javascript">


function M(formulario)
{

		alert("SE ACTUALIZ EL REGISTRO");
setTimeout("location.href='Insert_Meseros.php'", 109);
}
 
</script>
</body>


</body>
</html>



	