<?php
error_reporting(0);
require("funciones2.php");
conectar();
$se=mysql_query("SELECT * FROM contrato WHERE Meseros!=''");
echo "<table border='6'>
	<tr>
		<td>Contrato</td>
		<td>Meseros</td>
	</tr>";
while($Ses=mysql_fetch_array($se))
{
	echo"
			<tr>
				<td>".$Ses['Numero']."</td>
				<td>".$Ses['Meseros']."</td>				
			</tr>
		";
}
echo "</table>";
?>