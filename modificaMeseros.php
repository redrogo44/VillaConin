<?php

require("funciones2.php");

conectar();


https://greatmeeting.me/
mysql_query("UPDATE `Meseros` SET `neventos`=".$_POST['eventos'].",`acumulado`=".$_POST['puntos'].",`modificado`='si' WHERE `id`=".$_POST['id']);

echo "

		<script>

			window.location.href = 'http://villaconin.mx/Actualiza-Meseros.php';

		</script>

	 ";

?>