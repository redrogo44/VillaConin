
<select id="sub_categoria" name="sub_categoria" onchange="s(this.value)" >

<?php 
require 'configuraciones.php';
conectar();
$q=$_POST['q'];
$res=mysql_query("select sub_categoria from Gastos_categoria where categoria='".$q."' and sub_categoria!='' group by sub_categoria ");
echo "<option value='0'></option>";
while($m=mysql_fetch_array($res)){
	echo "<option value='".$m['sub_categoria']."'>".$m['sub_categoria']."</option>";
  }
?>
</select>