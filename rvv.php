<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<title>Villa Conin</title>
<head>
<?php
require 'funciones2.php';
	conectar();
	$numero = count($_POST);
	$tags = array_keys($_POST);
	$valores = array_values($_POST);
	$todo="";
	for($i=0;$i<$numero;$i++){ 
		$con="select * from TInventarios where id=".$tags[$i];
		$r=mysql_query($con);
		$m=mysql_fetch_array($r);
		$total=$m['cantidad']-$valores[$i];
		$up="UPDATE TInventarios set cantidad=".$total." where id=".$tags[$i];
		$todo=$todo.$tags[$i].",".$valores[$i].",";
		$rup=mysql_query($up);
	}
?>

<script type="text/javascript">
	function pdf(){
	window.open("venta_vino_pdf.php?t="+"<?php echo $todo; ?>");
	}
	</script>
</head>

<body>

	<div align="center" >
	<?php
	
		echo '<script>pdf();</script>';
		echo '<meta http-equiv="Refresh" content="2;url=Inventario.php">';
	?>
	</div>	
	
</body>
</html>