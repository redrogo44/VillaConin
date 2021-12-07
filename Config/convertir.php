<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menuconfiguracion();
}

?>
 
 <title>Villa Conin</title>
<head> 

</head> 
 <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  height:auto;
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
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
	
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>CONVERTIR CONTRATO NO FACTURADO A FACTURADO</h2></b></p>
	<br><br><br>
    <div class="wrapper wrapper-style4">
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="categoria" size="1" id="categoria">
				<option>Numero</option>
                <option>Todos</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35"  placeholder="		Ingresa aqui tu texto">
		<input type="submit" name="submit" value="Buscar">
		</form>
       </div>
	   <br><br>
		<div class="wrapper">
			<?php
			
					if(isset($_POST['submit'])) {
					echo '<table border="1">';
					conectar();
					$q="select * from contrato where facturado='no' and estatus=1";
					$r=mysql_query($q);
					
					if($_POST['categoria']=="Todos"){
						echo '<tr><th>Numero</th><th>Nombre</th><th>Fecha</th><th>Salon</th><th>Tipo</th><th>Convertir</th></tr>';
						while($m=mysql_fetch_array($r)){
							echo '<tr><td>'.$m['Numero'].'</td><td>'.$m['nombre'].'</td><td>'.$m['Fecha'].'</td><td>'.$m['salon'].'</td><td>'.$m['tipo'].'</td><td align="center"><a href="convertir2.php?numero='.$m['Numero'].'">Convertir</a></td></tr>';
						}
					}else{
						if(isset($_GET['numero'])){
						$_POST['campo']=$_GET['numero'];
						}
						$q2="select * from contrato where Numero='".$_POST['campo']."'";
						$r2=mysql_query($q2);
						echo '<tr><th>Numero</th><th>Nombre</th><th>Fecha</th><th>Salon</th><th>Tipo</th><th>Convertir</th></tr>';
						while($m2=mysql_fetch_array($r2)){
							echo '<tr><td>'.$m2['Numero'].'</td><td>'.$m2['nombre'].'</td><td>'.$m2['Fecha'].'</td><td>'.$m2['salon'].'</td><td>'.$m2['tipo'].'</td>';
							if($m2['facturado']=='si'){
								echo '<td><strong>Contrato ya facturado</strong></td></tr>';
							}else{
								echo '<td align="center"><a href="convertir2.php?numero='.$m2['Numero'].'">Convertir</a></td></tr>';
							}
							
						}
					}
					echo '</table>';
				}
				pie();
			?>
	</div>
</div>
</body>
</html>
