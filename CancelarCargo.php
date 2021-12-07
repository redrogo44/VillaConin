<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
validarsesion();
conectar();
$nivel=$_SESSION['niv'];
//print_r($_POST);
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
	<p><b><h2>Buscar Contrato</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>Numero</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="		Ingresa aqui tu texto">
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<br><br>
		<div class="wrapper">
			<?php
			
					if(isset($_POST['submit'])) 
					{
						$q=mysql_query('Select * from contrato where Numero="'.$_POST['campo'].'"');
						$m=mysql_fetch_array($q);
						if($m['estatus']==2 and $m['facturado']=='no')
						{
							echo "<script>";
							echo "alert('Error no se puede abonar a contratos ya finalizados')";
							echo "</script>";
							echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=https://villaconin.mx/'>";
						}
					}
						$NSub=cantidad_subcontratos($_POST['campo']);

			//echo "la cantidad de subcontratos es ".$NSub." DEL CONTRATO ".$_POST['campo'];
					if($NSub>=2&&$_POST['click']<1)
					{					
								echo "<br><br>";
							 	$q="select * from contrato where Numero='".$_POST['campo']."'";
								$r=mysql_query($q);
								while($m=mysql_fetch_array($r))
								{
									if(validasubcontrato($_GET['numero']))
									{// valida si tiene subcontratos -> mostramos  listas de subcontratos
										$query="select * from contrato where Numero like ('".$_POST['campo']."%')";
										$result=mysql_query($query);
										echo '<table border="4px" bordercolor="#0033CC">';
										echo '<tr>													
												<td align="center"><h6>Sub Contrato</h6></td>
												<td align="center">Nombre</td>
												<td align="center"><h6><b>Ver</b>	</h6></td>
											</tr>';
											while($subcontrato=mysql_fetch_array($result))
											{									
												echo "<tr>
												<td align='center'><h6><b>".$subcontrato['Numero']."</b></h6></td>
												<td align='center'><h6>".$subcontrato['nombre']."</h6></td>
												<td>
												<form action='' method='POST'>
													<input type='hidden' value=".$subcontrato['Numero']."  name='campo'/>
													<input type='hidden' value=".$clic++."  name='click'/>
													<input type='submit'  class='BOTON' value='CANCELAR CARGOS'/>
												</form></td>
												</tr>"; 
											}
											echo '</table>';
								    }
					       		 }
					}

				else if(strlen($_POST['campo'])==8)
				{
						busquedaCargo();		
				}
			
			else
			{
			
					if(isset($_POST['campo'])) 
					{
						busquedaCargo();			
					}
					
					else
					{
						busquedaCargo();				
					}										
				pie();			
			}
			?>	
		</div>
<script type="text/javascript">
	function preguntar2(){
		if(confirm("Esta Seguro de Cancelar el Cargo")){
			return true;
		}else{
			return false;
		}

	}
</script>
</body>
</html>