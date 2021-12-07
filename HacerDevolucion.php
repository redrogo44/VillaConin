<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

?>
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
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
	
    <p><b><h2 style="color:#FC0316">Buscar Contrato</h2></b></p>
<div class="wrapper wrapper-style4">		
<script>alert("Tenga en Cuenta que al realizar una devolucion de dinero sobre el contrato, este se da por terminado y pasa a estar INACTIVO, Si no esta convencido de realizarlo por favor regrese al inicio")</script>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>Numero</option>
				<option>Fecha</option>
                <option>Todos</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35"  placeholder="		Ingresa aqui tu texto">
			<input type="submit" name="submit" value="Buscar">
			   <input type="hidden" name='contrato' value="<?php echo $_GET['numero'];?>">
		</form>
        
		</div>
		<div class="wrapper">
			<?php
			//print_r($_POST);
					if(isset($_POST['submit'])) 
					{
						conectar();
						 $AaAA='SELECT * FROM TDevoluciones WHERE Numero="'.$_POST['campo'].'"';					
						$bus=mysql_query($AaAA);					
						if (mysql_num_rows($bus)>0) 
						{
							echo "
									<script>
										alert('ESTE CONTRATO YA TIENE UNA PRE-DEVOLUCION O YA SE LE REALIZO LA DEVOLUCION.  FAVOR DE REVISAR SUS DATOS');
									</script>
								 ";
						}
						else
						{
						Devoluciones();										
						}
					}
			?>


</body>
</html>
