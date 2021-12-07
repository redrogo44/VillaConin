<?php
session_start();
//print_r($_SESSION);
//print_r($_GET);
?>
<html>
<head>
<title>Villa Conin</title>

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
<script type="text/javascript" src='js/jquery-ui.min.js'></script>
<script type="text/javascript" src='js/auxiliar.js'></script>

<link rel="shortcut icon" href="../Imagenes/icono.png">
<script>
$(function(){
	$('#categoria').autocomplete({
		source : 'categoria.php'
	});
});
$(function(){
	$('#subcategoria').autocomplete({
		source : 'subcategoria.php'
	});
});
$(function(){
	$('#unidad').autocomplete({
		source : 'unidad.php'
	});
});
</script>
<script>
function agregar(op,tabla){
	//alert(op);
	if(op=='***'){
		window.open("popup.php?op="+tabla+"&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
	}
}
function nuevo(tabla){
	window.open("popup.php?op="+tabla+"&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
}
</script>
</head>
<body align='center'>
<p id='resultado'>
	<?php
	require 'funciones.php';
	conectar();
	/////////////////////////////////////sentencias de insercion o modificacion
	if($_POST['act']=='agregar'){
		 $columnas=name_column($_POST['tabla']);
		$col="";$valores='';
		for($i=0;$i<count($columnas);$i++){
		$result= mysql_query("SHOW TABLES LIKE '".strtolower($columnas[$i])."'");
			if(mysql_num_rows($result)>0){
				////////////obtenemos el id
				$id='select * from '.strtolower($columnas[$i]).' where nombre="'.$_POST[$columnas[$i]].'"';
				$id2=mysql_query($id);
				$id3=mysql_fetch_array($id2);
				$aux=$id3['id_'.strtolower($columnas[$i])];
				$columnas[$i]="id_".strtolower($columnas[$i]);
				$_POST[$columnas[$i]]=$aux;
			}
			if($col==''){
				if($columnas[$i]!='codigo'){
					$col=strtolower($columnas[$i]);
				}
				
			}else{
				if($columnas[$i]!='codigo'){
					$col=$col.','.strtolower($columnas[$i]);
				}
			}
			
		}
		
		$query="insert into ".$_POST['tabla']."(".$col.")values (";
		for($i=0;$i<count($columnas);$i++){
			if($valores==''){
				if(is_numeric($_POST[$columnas[$i]])){
					$valores=$_POST[$columnas[$i]];
				}else{
					$valores='"'.$_POST[$columnas[$i]].'"';
				}
			}else{
				if(is_numeric($_POST[$columnas[$i]])){
					$valores=$valores.','.$_POST[$columnas[$i]];
				}else{
					$valores=$valores.',"'.$_POST[$columnas[$i]].'"';
				}
			}
		}
		
		$query=$query.utf8_encode($valores).")";
		if(mysql_query($query)){
			if($_POST['tabla']=='producto'){/////////////////agregamos el producto a la tabla de inventario
			$max=mysql_query('select max(id_producto) as m from producto');
			$max2=mysql_fetch_array($max);
			$in=mysql_query("insert into inventario(id_producto,cantidad,precio,fecha,hora,precio_venta)values(".$max2['m'].",0,0,'0000-00-00','00:00:00',".$_POST['precio_venta'].")");
			//////////////////////
			$qqqq=mysql_query("SELECT * FROM producto WHERE id_producto=".$max2['m']);
			$evi=mysql_fetch_array($qqqq);
			if($evi['id_categoria']==1)
			{
				$nom="100".$max2['m'];
				mysql_query("UPDATE `producto` SET `codigo`='".$nom."' WHERE `id_producto`=".$max2['m']);
				echo "<script>	
					window.open('../Recaudacion/Codigos2/Modulos/principal/generador.php?codigo=".$nom."', '_blank', 'width=200, height=100');								
				</script>";
			}
			

			///////////////////////
			}
			echo "<script>";
			echo "window.opener.location.reload(); window.close();"; 
			echo "window.close();"; 
			echo "</script>";
		}else{
			echo "<center><img src='imagenes/borrar.png'></center><br>";
			echo "ERROR NO SE PUEDE AGRAGAR VERIDIQUE SUS DATOS<br>NO DEBE DE EXISTIR NOMBRE REPETIDOS";
		}
		
		
		
		
	}elseif($_POST['act']=='modificar'){
		////BLOQUE DE MODIFICACION DE Servicio
		if($_POST['tabla']=="producto"){
			$inf=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$_POST["id"]));
			mysql_query("update Servicios set Servicio='".$_POST["NOMBRE"]."' where Servicio='".$inf["nombre"]."'");
		}
		
		////
		$columnas=name_column($_POST['tabla']);
		$valores="";
		
		for($i=0;$i<count($columnas);$i++){
			$result= mysql_query("SHOW TABLES LIKE '".strtolower($columnas[$i])."'");
			if(mysql_num_rows($result)>0){
				///////////obtenemos el id de la tabla que se hace referencia
				$conten=mysql_fetch_array(mysql_query("select * from ".strtolower($columnas[$i])." where nombre='".$_POST[$columnas[$i]]."'"));
				$columnas[$i]="id_".strtolower($columnas[$i]);
				$_POST[$columnas[$i]]=$conten[strtolower($columnas[$i])];
			}
		}
		/*
		if($_POST['tabla']=='producto'){
			if(validar_cambio_categoria()){
					echo "<script>";
					echo "window.opener.location.reload(); window.close();"; 
					echo "</script>";
					exit();					
			}
		}
		*/
		
		$query="UPDATE ".$_POST['tabla']." set ";
		for($i=0;$i<count($columnas);$i++){
			if($columnas[$i]!='CODIGO'){
				if($i==count($columnas)-1){
					if(is_numeric($_POST[$columnas[$i]])){
						$query=$query.strtolower($columnas[$i]).'='.$_POST[$columnas[$i]];
					}else{
						$query=$query.strtolower($columnas[$i])."='".$_POST[$columnas[$i]]."'";
					}
				}else{
					if(is_numeric($_POST[$columnas[$i]])){
						if($columnas[$i+1]!='CODIGO'){
							$query=$query.strtolower($columnas[$i]).'='.$_POST[$columnas[$i]].",";
						}else{
							$query=$query.strtolower($columnas[$i]).'='.$_POST[$columnas[$i]];
						}
					}else{
						if($columnas[$i+1]!='CODIGO'){
							$query=$query.strtolower($columnas[$i])."='".$_POST[$columnas[$i]]."',";
						}else{
							$query=$query.strtolower($columnas[$i])."='".$_POST[$columnas[$i]];
						}
					}
				}
			}
		}
		
		$query=utf8_encode($query)." where id_".$_POST['tabla']."=".$_POST['id'];
		mysql_query($query);
		///////////////si es la modificacion de un producto modificamos el precio de venta
		if($_POST['tabla']=='producto'){
			$qinv=mysql_query("update inventario set precio_venta=".$_POST['precio_venta']." where id_producto=".$_POST['id']);
			//ECHO "update inventario set precio_venta=".$_POST['precio_venta']." where id_producto=".$_POST['id'].'<BR>';
		}
		
		//echo $query."<BR>";
		echo "<script>";
		echo "window.opener.location.reload(); window.close();"; 
		echo "</script>";
	
	}elseif($_POST['act']=='mod_precio_venta'){
	$qinv=mysql_query("update inventario set precio_venta=".$_POST['precio_venta']." where id_producto=".$_POST['id']);
		echo "<script>";
		echo "window.opener.location.reload(); window.close();"; 
		echo "</script>";
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	////////////////////////////////////formularios
	if($_GET['act']=='agregar'){
		echo "<center>AGREGAR ".strtoupper($_GET['op'])." </center><br>";
		echo "<table>";
		echo "<form method='post' action='popup.php'>";
			$columnas=name_column($_GET['op']);
			for($i=0;$i<count($columnas);$i++){
				$result= mysql_query("SHOW TABLES LIKE '".strtolower($columnas[$i])."' ");
				if(mysql_num_rows($result)>0){
					/*$selec=mysql_query('select * from '.strtolower($columnas[$i]));
					$fun='agregar(this.value,"'.strtolower($columnas[$i]).'")';
					echo "<tr><td><label>".$columnas[$i]."</label></td><td><select name='id_".strtolower($columnas[$i])."' onchange='".$fun."' required>";
					echo "<option></option>";
					echo "<option value='***'>Agregar</option>";
					while($m=mysql_fetch_array($selec)){
						echo "<option value='".$m['id_'.strtolower($columnas[$i])]."'>".$m['nombre']."</option>";
					}
					echo "</select></td><tr>";*/
					$link='nuevo("'.strtolower($columnas[$i]).'")';
					if($columnas[$i]=="CATEGORIA"){
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' onblur='auxiliar(this.value)' required><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
					}else{
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' required><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
				
					}
				}else{
					if($columnas[$i]=='TELEFONO'|| $columnas[$i]=='TELEFONO2'){
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input  name='".$columnas[$i]."'></td><tr>";
					}elseif($columnas[$i]=='CORREO'){
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='email' name='".$columnas[$i]."'></td><tr>";
					}elseif($columnas[$i]=='RFC'){
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' name='".$columnas[$i]."'></td><tr>";
					}elseif($columnas[$i]=='TIPO'){
						echo "<tr><td><label>".$columnas[$i]."</label></td>
						<td><select name='".$columnas[$i]."'>
							<option value='ACTIVO'>ACTIVO</option>
							<option value='INSUMO'>INSUMO</option>
							<option value='INVERSION'>INVERSION</option>
							<option value='OPERATIVO'>OPERATIVO</option>
							<option value='PERSONAL'>PERSONAL</option>
						</td><tr>";
					}else{
						if($columnas[$i]!='CODIGO'){
								echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' name='".$columnas[$i]."' required></td><tr>";
						}
					}
				}
			}
			if($_GET['op']=='producto'){
					echo "<tr>";
					echo "<td><label>PRECIO DE VENTA</label></td>";
					echo "<td><input type='text' name='precio_venta' value='".$inventario['precio_venta']."' required></td>";
					echo "</tr>";
			}
		echo "<input type='hidden' name='tabla' value='".$_GET['op']."'>";
		echo "<tr><td colspan='2' align='center'><input type='submit' name='act' value='agregar'></td></tr>";
		echo "</table>";	
	}elseif($_GET['act']=='modificar'){
		if(isset($_GET['producto'])){
			$idd=mysql_fetch_array(mysql_query("select id_producto from producto where nombre='".$_GET['producto']."'"));
			$_GET['num']=$idd['id_producto'];
		}
		$q=mysql_query("select * from ".$_GET['op']." where id_".$_GET['op']."=".$_GET['num']);
		$m=mysql_fetch_array($q);
		echo "<table>";
			echo "<form method='post' action='popup.php'>";
			$columnas=name_column($_GET['op']);
			for($i=0;$i<count($columnas);$i++){
				$result= mysql_query("SHOW TABLES LIKE '".strtolower($columnas[$i])."' ");
				if(mysql_num_rows($result)>0){
					/*$selec=mysql_query('select * from '.strtolower($columnas[$i]));
					echo "<tr><td><label>".$columnas[$i]."</label></td><td><select name='id_".strtolower($columnas[$i])."' required>";
					while($m=mysql_fetch_array($selec)){
						echo "<option value='".$m['id_'.strtolower($columnas[$i])]."'>".$m['nombre']."<option>";
					}
					echo "</select></td><tr>";*/
					$link='nuevo("'.strtolower($columnas[$i]).'")';
					if($columnas[$i]=="CATEGORIA"){
						$obtener_cat=mysql_fetch_array(mysql_query("select * from categoria where id_categoria=".$m['id_categoria']));
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' value='".$obtener_cat['nombre']."' onblur='auxiliar(this.value)'><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
					}elseif($columnas[$i]=="UNIDAD"){
						$obtener_uni=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$m['id_unidad']));
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' value='".$obtener_uni['nombre']."'><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
					}elseif($columnas[$i]=="SUBCATEGORIA"){
						$obtener_sub=mysql_fetch_array(mysql_query("select * from subcategoria where id_subcategoria=".$m['id_subcategoria']));
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' value='".$obtener_sub['nombre']."'><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
					}else{
						echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' id='".strtolower($columnas[$i])."' name='".$columnas[$i]."' ><img src='imagenes/agregar.png'  width='15px' height='15px' onclick='".$link."'></td></tr>";
					}
				}else{
					if($columnas[$i]=='TIPO'){
						echo "<tr><td><label>".$columnas[$i]."</label></td>
						<td><select name='".$columnas[$i]."'>";
							if($m[strtolower($columnas[$i])]=='ACTIVO'){
								echo "<option value='ACTIVO' selected>ACTIVO</option>
									  <option value='INSUMO'>INSUMO</option>
								   	  <option value='INVERSION'>INVERSION</option>
									  <option value='OPERATIVO'>OPERATIVO</option>
									  <option value='PERSONAL'>PERSONAL</option>";
							}elseif($m[strtolower($columnas[$i])]=='INSUMO'){
								echo "<option value='ACTIVO'>ACTIVO</option>
									  <option value='INSUMO' selected>INSUMO</option>
								   	  <option value='INVERSION'>INVERSION</option>
									  <option value='OPERATIVO'>OPERATIVO</option>
									  <option value='PERSONAL'>PERSONAL</option>";
								
							}elseif($m[strtolower($columnas[$i])]=='INVERSION'){
								echo "<option value='ACTIVO'>ACTIVO</option>
									  <option value='INSUMO'>INSUMO</option>
								   	  <option value='INVERSION' selected>INVERSION</option>
									  <option value='OPERATIVO'>OPERATIVO</option>
									  <option value='PERSONAL'>PERSONAL</option>";
								
							}elseif($m[strtolower($columnas[$i])]=='OPERATIVO'){
								echo "<option value='ACTIVO'>ACTIVO</option>
									  <option value='INSUMO'>INSUMO</option>
								   	  <option value='INVERSION'>INVERSION</option>
									  <option value='OPERATIVO' selected>OPERATIVO</option>
									  <option value='PERSONAL'>PERSONAL</option>";
								
							}else{
								echo "<option value='ACTIVO'>ACTIVO</option>
									  <option value='INSUMO'>INSUMO</option>
								   	  <option value='INVERSION'>INVERSION</option>
									  <option value='OPERATIVO'>OPERATIVO</option>
									  <option value='PERSONAL' selected>PERSONAL</option>";
								
							}
							
						echo "</td><tr>";
					}else{
						if($columnas[$i]=='CORREO'){
							echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='email' name='".$columnas[$i]."' value='".utf8_decode($m[strtolower($columnas[$i])])."'></td><tr>";
						}elseif($columnas[$i]!='CODIGO'){
							echo "<tr><td><label>".$columnas[$i]."</label></td><td><input type='text' name='".$columnas[$i]."' value='".utf8_decode($m[strtolower($columnas[$i])])."' required></td><tr>";
						}
					}
				}
			}
			if($_GET['op']=='producto'){
				$inv=mysql_query('select * from inventario where id_producto='.$_GET['num']);
				if(mysql_num_rows($inv)>0){
					$inventario=mysql_fetch_array($inv);
					echo "<tr>";
					echo "<td><label>Precio de venta</label></td>";
					echo "<td><input type='text' name='precio_venta' value='".$inventario['precio_venta']."' required></td>";
					echo "</tr>";
				}
			}
		echo "<input type='hidden' name='tabla' value='".$_GET['op']."'>";
		echo "<input type='hidden' name='id' value='".$_GET['num']."'>";
		echo "<tr><td colspan='2' align='center'><input type='submit' name='act' value='modificar'></td></tr>";
		echo "</table>";
		
	}elseif($_GET['act']=='borrar'){
		if($_GET['op']=='compra'){//////////por si son compras primero se eliminan los detalles de compra
			$r=mysql_query('delete from detalle_compra where id_compra='.$_GET['num']);
			if (!$r) {
			//die('Error no se puede borrar existen elemnetos que utilizan esta informacion: ' . mysql_error());
			echo 'Error no se puede borrar existen elemnetos que utilizan esta informacion <br> ';
			echo '<center><button onclick="window.close();">Cerrar</button></center>';
			}else{
				echo "<script>";
				echo "window.opener.location.reload(); window.close();"; 
				echo "</script>";
			}
		}else{		
			$q="delete from ".$_GET['op']." where id_".$_GET['op']."=".$_GET['num'];
			$descripcion=mysql_fetch_array(mysql_query("select * from ".$_GET['op']." where id_".$_GET['op']."=".$_GET['num']));
			
			/////movimientos de productos en la tabla detalle si es producto
			if($_GET['op']=='producto'){
				///actualizamos la tabla de los servicios
				$infp=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$_GET["num"]));

				///////////validamos en invetario
				
				if(valida_existencias($_GET['num'])){
					exit();
				}
				
				////////descripcion del producto
				$dsc_p=mysql_fetch_array(mysql_query("select * from ".$_GET['op']." where id_".$_GET['op']."=".$_GET['num']));
				$aux_inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$_GET['num']));
				$datos=$dsc_p['descripcion']."%".$dsc_p['id_unidad']."%".$dsc_p['id_categoria']."%".$dsc_p['id_subcategoria']."%".$dsc_p['impuesto']."%";
				$descripcion['descripcion']=$datos.$aux_inv['id_aux'];
				$guardar_id='';
				$obtener_id=mysql_query("select * from detalle where id_producto=".$_GET['num']);
				while($id_d=mysql_fetch_array($obtener_id)){
					$guardar_id=$guardar_id.$id_d['id_detalle']."%";
				}
			}
			
			///echo $q;
			$resultado=mysql_query($q);
			if (!$resultado) {
				die('Error no se puede borrar existen elemnetos que utilizan esta informacion: ' . mysql_error());
				echo 'Error no se puede borrar existen elemnetos que utilizan esta informacion <br> ';
				echo '<center><button onclick="window.close();">Cerrar</button></center>';
			}else{
				if($_GET['op']=='producto'){
					mysql_query("delete from Servicios where Servicio='".$infp["nombre"]."'");
				}
			
				$insert="insert into borrados(id_anterior,nombre,tabla,descripcion,otros,fecha) 
				value(".$descripcion['id_'.$_GET['op']].",'".$descripcion['nombre']."','".$_GET['op']."','".$descripcion['descripcion']."','".$guardar_id."','".date('Y-m-d')."')";
				mysql_query($insert);
				echo "<script>";
				echo "window.opener.location.reload(); window.close();"; 
				echo "</script>";
			}
		}
	
	}elseif($_GET['act']=='modificarprecio'){
		$obtener=mysql_query("select * from producto where nombre='".$_GET['producto']."'");
		if(mysql_num_rows($obtener)>0){
		echo "<form method='post' action='popup.php'>";
			$obn=mysql_fetch_array($obtener);
			$_GET['num']=$obn['id_producto'];
			$inv=mysql_query('select * from inventario where id_producto='.$_GET['num']);
			$inventario=mysql_fetch_array($inv);
			echo "<table>";
			echo "<tr><td><label>Producto</label></td><td>".$obn['nombre']."</td></tr>";
			echo "<tr><td><label>Descripcion</label></td><td>".$obn['descripcion']."</td></tr>";
			echo "<tr><td><label>Precio de venta</label></td><td><input type='text' name='precio_venta' placeholder='".$inventario['precio_venta']."' required></td></tr>";
			echo "<input type='hidden' name='id' value='".$obn['id_producto']."'>";
			echo "<input type='hidden' name='act' value='mod_precio_venta'>";
			echo "<tr><td colspan='2' align='center'><input type='submit' name='enviar' value='actualizar'></td></tr>";
			echo "</table>";
		echo "</form>";
		}else{
			echo "Error no se encontro el producto a modificar";
			exit();
		}
	}else{
		//echo "EXISTE UN ERROR FAVOR DE REINTENTAR MAS TARDE";
	}
	
	
	
	
	
	
	function validar_cambio_categoria(){
		$bandera=false;
		///////se hizo modificaciones en la categoria???
			$producto=mysql_fetch_array(mysql_query("select * from producto where nombre='".$_POST['NOMBRE']."'"));///origen
			$_POST['id']=$producto['id_producto'];
			$categoria=mysql_fetch_array(mysql_query("select * from categoria where nombre='".$_POST['CATEGORIA']."'"));//destino
			$subcategoria=mysql_fetch_array(mysql_query("select * from subcategoria where nombre='".$_POST['SUBCATEGORIA']."'"));//destino
			$fecha_inicial='0000-00-00';
			$fecha_limite='';
			$inv_actual=0;
			$sobrantes=0;
			$cp=0;
			if($producto['id_categoria']!=$categoria['id_categoria']){
				$bandera=true;
					////////cortes de la categoria destino
					/////////obtenemos un producto de la categoria destino para obtener los cortes hechos
					$pd=mysql_fetch_array(mysql_query("select * from producto where id_categoria=".$categoria['id_categoria']." LIMIT 1"));
					////obtenemos los cortes
					$cortes=mysql_query("select * from detalle where id_producto=".$pd['id_producto']." and tipo='faltante'");
					
					///////////no se han hecho cortes entonces a la categoria destino asi que se borran los de la categoria de origen y se actualiza el inventario
					if(mysql_num_rows($cortes)==0){
						//mysql_query("delete from detalle where id_producto=".$_POST['id']." and tipo='faltante'");
						//mysql_query("Update inventario set cantidad=0,precio=0,fecha='0000-00-00',hora='00:00:00' where id_producto=".$_POST['id']);
					}else{
						///////si existieron cortes de la categoria destino
						while($m=mysql_fetch_array($cortes)){
							
								//////////////obtenemos las fechas de los cortes y actualizamos
								$fecha=mysql_fetch_array(mysql_query("select * from corte_inventario where id_corte_inventario=".$m['id']));
								///////////sumamos los movimientos
								$fecha_limite=$fecha['fecha'];
								//echo "fecha inicial:".$fecha_inicial."___fecha limite:".$fecha_limite."<br>";
								///////////id de compras hechas en el periodo
									$compras=mysql_query("select id_compra from compra where fecha>'".$fecha_inicial."'  and fecha<='".$fecha_limite."'");
									$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
									$cantidad_compra=0;
									$importe_compras=0;
									while($compras2=mysql_fetch_array($compras)){
										$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$_POST['id']." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
										$cant=mysql_fetch_array($c);
										$cantidad_compra=$cantidad_compra+$cant['t'];
										$importe_compras=$importe_compras+$cant['imp'];
									}
									
									while($comprasfac2=mysql_fetch_array($comprasfac)){
										$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$_POST['id']." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
										$cant=mysql_fetch_array($c);
										$cantidad_compra=$cantidad_compra+$cant['t'];
										$importe_compras=$importe_compras+$cant['imp'];
									}
									
									//echo $cantidad_compra."__".$importe_compras."<br>";
									/////////entradas
									$entradas=mysql_query("select * from entrada where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
									$cantidad_entrada=0;
									while($entradas2=mysql_fetch_array($entradas)){
										$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='entrada' and id=".$entradas2['id_entrada']);
										$cante=mysql_fetch_array($ce);
										$cantidad_entrada=$cantidad_entrada+$cante['t'];
									}
									//echo $cantidad_entrada."<br>";
									/////////salidas
									$salidas=mysql_query("select * from salida where fecha>'".$$fecha_inicial."' and fecha<='".$fecha_limite."'");
									$cantidad_salida=0;
									while($salidas2=mysql_fetch_array($salidas)){
										$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='salida' and id=".$salidas2['id_salida']);
										$cants=mysql_fetch_array($cs);
										$cantidad_salida=$cantidad_salida+$cants['t'];
									}
									
									//echo $cantidad_salida."<br>";
									/////////ventas
									$ventas=mysql_query("select * from venta where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
									$cantidad_venta=0;
									while($ventas2=mysql_fetch_array($ventas)){
										$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='venta' and id=".$ventas2['id_venta']);
										$cantv=mysql_fetch_array($cv);
										$cantidad_venta=$cantidad_venta+$cantv['t'];
									}
									//echo $cantidad_venta."<br>";
									////////cortes de la categoria de origen
									$p_origen=mysql_query("select * from detalle where id_producto=".$_POST['id']." and tipo='faltante'");
									//////////sumamos los consumidos en el rango de fechas segun los corte hechos en la categoria de origen
									$consumidos=0;
									while($faltante_aux=mysql_fetch_array($p_origen)){
										$cortes_origen=mysql_fetch_array(mysql_query("select * from corte_inventario where id_corte_inventario=".$faltante_aux['id']));
										//////comparamos que sea menor  igual a la fecha del corte osea la fecha limite
										if($cortes_origen['fecha']>$fecha_inicial&&$cortes_origen['fecha']<=$fecha_limite){
											$consumidos=$consumidos+$faltante_aux['cantidad'];
											////////borramos el registro de detalle ya que ya no se utilizar
											mysql_query("delete from detalle where id_detalle=".$faltante_aux['id_detalle']);
										}
									}
									//echo $consumidos."<br>";
									//////////////inventario actual
									$inv_inicial=$sobrantes+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
									//echo $inv_inicial."<br>";
									//////costo ponderado
									if($inv_inicial<=0){////validacion entre cero
										$cp=(round((($sobrantes*$cp)+$importe_compras),5))/1;
									}else{
										$cp=(round((($sobrantes*$cp)+$importe_compras),5))/$inv_inicial;
									}
									$sobrantes=$inv_inicial+$consumidos;
									//echo $sobrantes."<br>";
									//////// se hace la insercion del nuevo corte de inventario es decir el correspondiente a la categoria destino
									mysql_query("insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo,gasto)
									values(".$m['id'].",".$consumidos.",".$_POST['id'].",".$cp.",0,".($consumidos*$cp).",'faltante','no')");
									
									/////cambiamos la fecha de inico por la del limite
									$fecha_inicial=$fecha_limite;
									
									
						}
					}
				/////////actualizamos a la nueva categoria
				mysql_query("update producto set id_categoria=".$categoria['id_categoria'].",id_subcategoria=".$subcategoria['id_subcategoria']." where id_producto=".$_POST['id']);
				///////actualizamos la tabla de inventario con los datos obtenidos
				mysql_query("update inventario set cantidad=".$sobrantes.",precio=".$cp.",fecha='".$fecha_limite."' where id_producto=".$_POST['id']);
			}
		return true;
	}
	
	
	
	function valida_existencias($id){
		$bandera=false;
		$p1=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$id));
		$corte=mysql_fetch_array(mysql_query("select max(id) as d from detalle where id_producto=".$id." and tipo='faltante'"));
		$fi=mysql_fetch_array(mysql_query("select * from corte_inventario where id_corte_inventario=".$corte['d']));
		$inventario=mysql_fetch_array(mysql_query("select cantidad from inventario where id_producto=".$id));
		$hoy=date('Y-m-d');
		///////////id de compras hechas en el periodo
			$compras=mysql_query("select id_compra from compra where fecha>'".$fi['fecha']."'  and fecha<='".$hoy."'");
			$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fi['fecha']."' and fecha<='".$hoy."'");
			$cantidad_compra=0;
			$importe_compras=0;
			while($compras2=mysql_fetch_array($compras)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$id." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
			while($comprasfac2=mysql_fetch_array($comprasfac)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$id." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
		//////////entradas
		$entradas=mysql_query("select * from entrada where fecha>'".$fi['fecha']."' and fecha<='".$hoy."'");
			$cantidad_entrada=0;
			while($entradas2=mysql_fetch_array($entradas)){
				$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$id." and tipo='entrada' and id=".$entradas2['id_entrada']);
				$cante=mysql_fetch_array($ce);
				$cantidad_entrada=$cantidad_entrada+$cante['t'];
			}
		
		
		//////inventario actual
		if($inventario['cantidad']>0){
			echo "No se puede borrar el inventario hasta el ultimo corte fue de: ".$inventario['cantidad'];
			$bandera=true;
		}elseif($cantidad_compra>0){
			echo "No se puede borrar se han realizado compras por la cantidad de: ".$cantidad_compra;
			$bandera=true;
		}elseif($cantidad_entrada>0){
			echo "No se puede borrar se han realizado entradas por la cantidad de: ".$cantidad_entrada;
			$bandera=true;
		}
		
		return $bandera;
	}
	
	?>

</body>
</html>