<?php
require("../funciones2.php");
conectar();

$pt=mysql_query("SELECT * FROM productos_tiendita");
$inc=0;
while($pr=mysql_fetch_array($pt))
{$inc++;
	echo '   <script type="text/javascript">
    window.open("Codigos2/Modulos/principal/generador.php?codigo='.$pr['codigo'].' ");       
    		</script>';

  
  echo $pr['codigo']."<br>";
}

?>