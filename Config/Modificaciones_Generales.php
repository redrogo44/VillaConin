<?php
require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	//menuconfiguracion();
	

if(isset($_GET['id']))
{
	?>
	<script type="text/javascript">	
				if (confirm("¿ ESTA SEGURO DE ELIMINAR AL MESERO. ?  TENGA EN CUENTA QUE AL ELIMINARLO DEL SISTEMA ESTE PERDERA TODA SU INFORMACION Y SERA IMPOSIBLE RECUPERARLA. ¿ ESTA COMPLETAENTE SEGURO ?, SI ASI ES ACEPTE, DE LO CONTRARIO CANCELE.") )
				{						
							borrarm(<?PHP echo $_GET['id'];?>);							
							alert('SE HA ELIMINADO CORRECTAMENTE AL MESERO');			
							window.location ="Insert_Meseros.php";
				}
				// si pulsamos en aceptar
				else 
				{											
					alert('SE CANCELO LA ACCION.');
					window.location ="Insert_Meseros.php";			
				}
					function borrarm(str)
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
					    			document.getElementById("dialog").innerHTML=xmlhttp.responseText;
					    		}
						  	}
							xmlhttp.open("POST","eliminar_mesero.php",true);
							xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp.send("q="+str);
						}
	</script>
<?php
} 
if($_GET['reinicia']=='reiniciar')
{
	//echo "<script type='text/javascript'>confirmarreiniciomeseros()</script>";
	?>
	<script type="text/javascript">
		if(confirm('  ESTA SEGURO DE REINICIAR LOS TRIBUTOS DE LOS MESEROS ? TENGA EN CUENTA QUE AL REALIZAR ESTE REINICIO NO SE PODRAN RECUPERAR ATRIBUTOS  TALES COMO PUNTOS, NUMERO DE EVENTOS Y COMENTARIOS...     DESEA REALIZAR EL REINCIO ?'))
		{
			<?php  mysql_query("UPDATE `Meseros` SET `nivel`='0',`fechaingreso`='".date('y-m-d')."',`comentarios`='',`estatus`='0',`disponibilidad`='no',`neventos`=0,`confirmacion`='no',`porcentaje`=0,`comentarios2`='',`reajuste`=0,`acumulado`=0,`ReConfirmar`=0,`disponibilidad2`='no' WHERE 1");?>
			alert(' SE HAN RE-ESTABLECIDO TODOS LOS ATRIBUTOS DE LOS MESEROS');		
		}
		
	
	</script>
	<?php
	echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	
}
if ($_POST['tipo']=='reajuste') 
{
	echo $rea="UPDATE Meseros SET reajuste=".$_POST['reajuste']." WHERE id=".$_POST['id'];
	mysql_query($rea);
	echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	

}

if ($_POST['accion']=='Modifica Contrasena') 
{
	mysql_query("UPDATE `Configuraciones` SET `valor`=".$_POST['pass']." WHERE id=23");?>
	<script type="text/javascript">
		alert('SE AH MODIFICADO LA CONTRASEÑA');
	</script>
	<?php
	echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	
}
?>
