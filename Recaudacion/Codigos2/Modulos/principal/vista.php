<?php 
	include('../php_conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vista</title>
</head>

<body>
<?php 
	$sql=mysql_query("SELECT usu FROM username WHERE tipo='cliente'");
	while($row=mysql_fetch_array($sql)){
		if(!empty($_POST[$row['usu']])){
			if($_POST[$row['usu']]=='s'){
				echo '<img src="'.$row['usu'].'.gif"> | - | ';
			}
		}
	}
?>
</body>
</html>