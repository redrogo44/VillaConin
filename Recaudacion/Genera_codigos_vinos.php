<?php
require("../funciones2.php");
conectar();
/*
$pt=mysql_query("SELECT * FROM productos_tiendita");
$inc=0;
while($pr=mysql_fetch_array($pt))
{$inc++;
	echo '   <script type="text/javascript">
    window.open("Codigos2/Modulos/principal/generador.php?codigo='.$pr['codigo'].' ");       
    		</script>';

  
  echo $pr['codigo']."<br>";
}
*/
$prr=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=1");			
				while($pro=mysql_fetch_array($prr))				
				{						
					$spr=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$pro['id_subcategoria']);		
					while($sub=mysql_fetch_array($spr))
					{	
						echo $sub['codigo']."<br>";
						echo '   <script type="text/javascript">
    								window.open("Codigos2/Modulos/principal/generador.php?codigo='.$sub['codigo'].' ");       
    							</script>';
					}
				}

?>