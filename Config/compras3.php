
<select id="descripcion" name="descripcion">
<option>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </option>
<?php 
require 'configuraciones.php';
conectar();
$q=$_POST['q'];
$res=mysql_query("select descripcion from TManteleria where tipo='".$q."'");
while($m=mysql_fetch_array($res)){
	echo "<option value='".$m['descripcion']."'>".$m['descripcion']."</option>";
  }
  
?>
</select>
