<?php
require 'configuraciones.php';
conectar();


function ModificarDep()
{
	echo $q="UPDATE `Configuraciones` SET `valor`=".$_POST['submit']." WHERE id=1";
			
}



?>