
<select id="tipo" name="tipo" onchange="load2(this.value)">
 <option>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </option>
<?php 
require 'configuraciones.php';
conectar();
$q=$_POST['q'];
$res=mysql_query("select tipo from TManteleria where Categoria='".$q."' group by tipo ");
while($m=mysql_fetch_array($res)){
	echo "<option value='".$m['tipo']."'>".$m['tipo']."</option>";
  }
?>
</select>
