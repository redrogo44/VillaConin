<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
menuconfiguracion();			
 header('Content-Type: text/html; charset=UTF-8'); 
?>


<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 

<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  right:1000px;
				  height:20px;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
				.nav li:hover> ul li{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-146px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
       
</head>
<?php
conectar();
$r=mysql_query('select * from clausulas2');

if(isset($_GET['id'])){
	$r2=mysql_query('select * from clausulas2 where id='.$_GET['id']);
}else{
	$r2=mysql_query('select * from clausulas2 where id=1');
}

?>
<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br><br><br><br><br><br><center>
<form action="MClausulas2.php" name="f" method="POST">
<label>Clausulas</label>
<select name='num' onchange="location.href='Clausulas2.php?id='+f.num.value">
<option></option>
<?php
while($m=mysql_fetch_array($r)){
	echo '<option value="'.$m['id'].'">'.$m['id'].'</option></a>';
}
 ?>
 </select>
 <input type="submit" value="Modificar" name="op">
 <input type="submit" value="Borrar" name="op">
 <input type="submit" value="Agregar" name="op">
 <br>
 <input type='hidden' value='<?php echo $_GET['id'];  ?>' name='id'>
<label> Clausula <?php echo $_GET['id']; ?></label><br>
 <textarea rows="10" cols="60" name='contenido'>
 <?php
 $m2=mysql_fetch_array($r2);
 echo $m2['descripcion'];?>
 </textarea>
</select>
</form>
<?php pie();?>
</body>
</html>
