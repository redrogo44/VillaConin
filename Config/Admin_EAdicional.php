<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
menuconfiguracion();				

$_SESSION['usu']=$_GET['usuario'];

$Se=mysql_query("SELECT * FROM Configuraciones WHERE nombre='Eventos Adicionales'");
$ev=mysql_fetch_array($Se);
$Even=explode(',',$ev['descripcion']);

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script type="text/javascript" src="jquery-2.1.1.min.js"></script>

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
				right:-146px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				#tabla{	border: solid 1px #333;	width: 300px; }
				#tabla tbody tr{ background: #999; }
				.fila-base{ display: none; }
				.eliminar{ cursor: pointer; color: #000; }
				input[type="text"]{ width: 80px; } /* ancho a los elementos input="text" */

				
    </style>
       
</head>
<!-- CUERPO DEL WEB-->
<br>
<br>

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br>
<br>
<div align="center">
<form action = "guarda_evetos.php" method ="POST">
<h2><font color="blue"><b>Ingrese el nombre los Eventos Adicioales</b></font></h2>
<h4><font color="red"><b>El nombre no debe contener espacios en blanco, debera sustituir estos por ( ' - '  ó  ' _ ' )</b></font></h4>
<br>

	<table border="6">
    <tr>
    	<td align="center"><b>Nombre de Evento</b> </td>
        <td align="center"><b>Depende de Algún Contrato</b></td>
    </tr>
    
		<?php		
			for($i=0;$i<=count($Even);$i++)
			{
				$Evento=explode('%',$Even[$i]);
				
			  echo "
			  <tr>
			     	<td width='200px'><input type='text' style='width:200px;'  name='Evento".$i."' value='".$Evento[0]."' /></td>
					";
					//echo "Evento ".$Evento[1]."<br>";
					if($Evento[1]==1)
					 {
						 echo "<td align='center'><input type='radio' value='1' name='depende".$i."' checked='checked'/><b> SI</b>
							 <input type='radio' value='0' name='depende".$i."' /> <b>NO</b></td>
						 		";
					 }if($Evento[1]!=1)
					 {
						 echo "<td align='center'><input type='radio' value='1' name='depende".$i."' /> <b>SI</b>
							 <input type='radio' value='0' name='depende".$i."' checked='checked'/><b> NO</b></td>
						 		";
					 }
					 
					 
			  echo "</tr>
				  ";
				  
		}	   	
		?>
        
   </table>
   <br />   <br />
   <input type="hidden" name="numero" value="<?php echo count($Even);?>"  />
   <input type="submit" value="Guardar Cambios"/>
</form>
</div>
<footer >
<?php pie();?>
</footer>

</body>

</html>
