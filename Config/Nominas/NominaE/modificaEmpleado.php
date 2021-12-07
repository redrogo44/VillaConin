<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Modificar Empleado</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>	
</head>
<?php
require('../../configuraciones.php');
//require('funciones.php');
conectar();

$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$_GET['id']));
?>
<body>
	<div align="center">
		<form action="Acciones_Nomina.php" name="nuevoE"  id="nuevoE" method="post">
        <table border="5" >
           <th colspan="2"><font><b>Modificar Empleado</b></font></th>
           <tr><td><b>Nombre(s)</b></td><td><input type="text" id="nombre" name="nombre" value='<?php echo $e["nombre"]?>'/></td></tr>
           <tr><td><b>Apellidos </b></td><td><input type="text" id="apellidos" name="apellidos"  value='<?php echo $e["apellidos"]?>'/></td></tr>
           <tr><td><b>Domicilio</b></td><td><input type="text" name="domicilio"  value='<?php echo $e["Direccion"]?>' /></td></tr>
           <tr><td><b>Telefono Celular</b></td><td><input type="text" name="celular"  value='<?php echo $e["telefono"]?>'/></td></tr>
           <tr><td><b>Telefono Casa</b></td><td><input type="text" name="telefono"  value='<?php echo $e["celular"]?>'/></td></tr>
           <tr><td><b>Correo Electronico</b></td><td><input type="email" name="correo"  value='<?php echo $e["correo"]?>'/></td></tr>
           <tr><td><b>Fecha de Ingreso</b></td><td><input type="date" name="fecha" value='<?php echo $e["fecha"]?>'/></td></tr>
           <tr><td><b>Departamentos</b></td>
           		<td align="center">
           		<?php
	           		$d=mysql_query("SELECT * FROM Departamento");
	           		$inc=0; $ch='';
		           		while ($de=mysql_fetch_array($d)) 
		           		{$ch='';
		           			$inc++;
		           			$cat=explode(",", $e["categorias"]);
							for ($i=0; $i <count($cat) ; $i++) 
							{ 
								if($cat[$i]==$de['nombre'])
			           			{
			           				$ch='checked';		           			
			           			}
							}
		           			
		           			echo $de['nombre'].'&nbsp;&nbsp;<input type="checkbox" class="departamento" name="'.$inc.'" value="'.$de['nombre'].'" '.$ch.'/>&nbsp;&nbsp;';

		           		}
           		?>           			           			
           		</td>
           </tr>                                            
           <tr><td><b>Sueldo Diario</b></td><td><input type="number" id="sueldo" name="sueldo"  value='<?php echo $e["sueldo"]?>'/></td></tr>
        </table>
        <br><br>
        <input type="hidden" value="ModificarEmpleado" name="accion" />
        <input type="hidden" value="<?php echo $_GET['id'];?>" name="id" />
        <input type="button" value="Modificar" class="buttone" onclick="validaNuevoE();" />
        <br>
     </form>
	</div>
	<script type="text/javascript">
		function validaNuevoE()
		{

			var nombre=$('#nombre').val();
			var apellidos=$('#apellidos').val();
			var sueldo=$('#sueldo').val();
			var con=0;
			$('.departamento:checked').each(
				function (){
			  		con++;				
				}
			);
			if (con<=0) {alert('SELECCIONE AL MENOS UN DEPARTAMENTO DONDE LABORARA EL EMPLEADO.');}
			else if(sueldo==''){alert("INGRESE UN SUELDO PARA EL EMPLEADO");}
			//else if(apellidos==""){alert("INGRESE LOS APELLIDOS DEL EMPLEADO");}			
			else if(nombre==""){alert("INGRESE EL NOMBRE DEL EMPLEADO");}
			else{ 	
			nuevoE.submit();	}
		}
	</script>
</body>
</html>