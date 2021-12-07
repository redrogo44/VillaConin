<?php  
	@$mysqli = new mysqli("localhost", "qroodigo_usuarios", "qroodigo_usuarios", "qroodigo_VillaConin"); 
	 
	if (mysqli_connect_errno()) { 
	    echo("Fallo conexion " . mysqli_connect_error());exit; 
	} else { 
	    //echo 'Conexion establecida'; 
	} 
?>