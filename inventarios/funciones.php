<?php
function conectar(){
	$con = mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
	if(!$con){
		die('no hay conexion al servidor');
	}
	$base = mysql_select_db('qroodigo_VillaConin');
	if(!$base){
		die('no se pudo conectar a la bd');
	}else{
	mysql_set_charset('utf8');
	 //echo "conexion exitosa";
	}

}
function menu(){
	///valimos el nivel de acceso que tiene el usuario
	conectar();
	$info=mysql_fetch_array(mysql_query("select * from usuarios where usuario='".$_SESSION['usuario']."'"));
	if($info["nivel"]==6){
		echo '<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li><a class="gn-icon gn-icon-illustrator" href="setinventario.php">Generar Inventario</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="index.php"><img src="../Imagenes/inventarios.PNG" height="100%" width="40%" style="position:absolute;top:0px;left:30%;"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Salir</span></a></li>
			</ul>';
	}else{
		echo '<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<!--li class="gn-search-item">
									<form action="buscar.php" method="get">
									<input type="hidden" name="op" value="compra">
									<input placeholder="# Compra" id="buscar" name="buscar" type="search" class="gn-search">
									</form>
									<a class="gn-icon gn-icon-search"><span>Buscar</span></a>
								</li-->
								<li><a class="gn-icon gn-icon-download" href="entrada.php">Entradas</a></li>
								<li><a class="gn-icon gn-icon-download" href="compras.php">Compras</a></li>
								<li><a class="gn-icon gn-icon-article" href="salida.php">Salidas</a></li>
								<li><a class="gn-icon gn-icon-article" href="venta.php">Ventas</a></li>
								<!--li><a class="gn-icon gn-icon-archive" href="reporte.php">Reportes</a></li-->
								<li><a class="gn-icon gn-icon-archive" href="inventario.php">Ver Inventario</a></li>
								<li><a class="gn-icon gn-icon-illustrator" href="setinventario.php">Generar Inventario</a></li>
								<li><a class="gn-icon gn-icon-videos" href="cancelar.php">Reportes</a></li>
								<li><a class="gn-icon gn-icon-cog" href="submenu.php">Configuraciones</a>
									<!--ul class="gn-submenu">
										<li><a class="gn-icon gn-icon-illustrator" href="configuraciones.php?op=categoria">Categorias</a></li>
										<li><a class="gn-icon gn-icon-illustrator" href="configuraciones.php?op=producto">Producto</a></li>
										<li><a class="gn-icon gn-icon-illustrator" href="configuraciones.php?op=proveedor">Proveedor</a></li>
										<li><a class="gn-icon gn-icon-illustrator" href="configuraciones.php?op=subcategoria">Subcategoria</a></li>
										<li><a class="gn-icon gn-icon-illustrator" href="configuraciones.php?op=unidad">Unidad</a></li>
									</ul-->
								</li>
								<li><a class="gn-icon gn-icon-article" href="impresion.php">Impresiones</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="index.php"><img src="../Imagenes/inventarios.PNG" height="100%" width="40%" style="position:absolute;top:0px;left:30%;"></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Salir</span></a></li>
			</ul>';	
	}
}

function FORM($tabla,$str){
session_start();
if($tabla!='compra'){////////////se cambia el boton e agregar por si es una compra
	echo "<button onclick='popup();'>AGREGAR</button>";
	if($tabla=='categoria'){
		echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		echo "<button onclick='asignar_tipo();'>ASIGNAR TIPO</button>";
	}
}else{
	echo "<button onclick='abrir_compras()'>AGREGAR</button>";
}

echo "<br><div class='sc'><br><br>";
	$arre='';$index=0;
	$id=0;////////////encabezados de las tablas
	$buscar = mysql_query("SELECT * FROM ".$tabla); 
	if($_SESSION['niv']<2){
		echo "<table class='style1'><tr><td>EDITAR</td><td>SUSPENDER</td>";
	}else{
		echo "<table class='style1'><tr><td>EDITAR</td>";
	}
	
		while($campos = mysql_fetch_field($buscar)){ 
			$datos=explode('_',strtoupper($campos->name));
			if(count($datos)>1){
				if($id==0){
					$arre[$index]=$datos[0];
					$index++;
					echo "<td>".$datos[0]."</td>";
					$id=1;
				}else{
					$arre[$index]=$datos[1];
					$index++;
					echo "<td>".$datos[1]."</td>";
				}
			}else{
				if($datos[0]!="CODIGO"){
					$arre[$index]=$datos[0];
					$index++;
					echo "<td>".$datos[0]."</td>";
				}
			}
		}
		////////////compra encabezado
		if($tabla=='compra'){
			echo "<td>Total</td>";
			}
		///////encabezado de producto anexos
		if($tabla=='producto'){
			echo "<td>Costo</td><td>Precio</td>";
			}
	echo "</tr>";
	//////////////////////////////contenido de las tablas
	if($str!=''){
		if($tabla!='compra'){////////////se cambia el boton e agregar por si es una compra
			$contenido=mysql_query('select * from '.$tabla." where nombre like '%".$str."%'");
			//echo 'select * from '.$tabla." where nombre like '%".$str."%'";
		}else{
			$contenido=mysql_query('select * from '.$tabla." where id_compra=".$str);
			//echo 'select * from '.$tabla." where id_compra=".$str."";
		}
	}else{
		if ($tabla=='subcategoria'){
			$contenido=mysql_query("SELECT id_subcategoria as id, sc.nombre as nombre, c.nombre as nombre2,sc.descripcion as descripcion FROM subcategoria as sc,categoria as c where sc.id_categoria=c.id_categoria order by c.nombre");
			//$contenido=mysql_query('select * from '.$tabla." order by nombre");
		}else{
			$contenido=mysql_query('select * from '.$tabla." order by nombre");
		}
		
	}
	if ($tabla=='subcategoria'){
		while($m=mysql_fetch_array($contenido)){
			echo "<tr><td width='60px' align='center'><img src='imagenes/editar.jpg' width='20px' height='20px' onclick='popup2(1,".$m['id'].")'></td>";
				if($_SESSION['niv']<2){
					echo"<td width='60px' align='center'><img src='imagenes/borrar.png' width='20px' height='20px' onclick='popup2(2,".$m['id'].")'></td>";
				}				  
			echo "<td>".$m['id']."</td><td>".$m['nombre']."</td><td>".$m['nombre2']."</td><td>".$m['descripcion']."</td></tr>";
		}
	}else{
		while($m=mysql_fetch_array($contenido,MYSQL_NUM)){
			if($tabla!='compra'){////////////por si estamos en compras 
				echo "<tr><td width='60px' align='center'><button onclick='popup2(1,".$m[0].")'><img src='imagenes/editar.jpg' width='15px' height='15px'></button></td>";
			}else{
				echo "<tr><td width='60px' align='center'><button onclick='editar_compra(".$m[0].")'><img src='imagenes/editar.jpg' width='15px' height='15px'></button></td>";
			}
			if($_SESSION['niv']<2){
				echo "<td width='60px' align='center'><button onclick='popup2(2,".$m[0].")'><img src='imagenes/borrar.png' width='15px' height='15px'></button></td>";
			}
			for($i=0;$i<count($m);$i++){
				$result= mysql_query("SHOW TABLES LIKE '".strtolower($arre[$i])."'");
				if(mysql_num_rows($result)>0){
					$q=mysql_query("select * from ".strtolower($arre[$i])." where id_".strtolower($arre[$i])."=".$m[$i]);
					while($m2=mysql_fetch_array($q)){
						echo "<td style='text-align:center;'>".$m2['nombre']."</td>";
					}
				}else{
					echo "<td style='text-align:center;'>".$m[$i]."</td>";
				}
			}
			
			if($tabla=='compra'){
				$pagado=mysql_query("select sum(importe)as t from detalle_compra where id_compra=".$m[0]);
				$pagado2=mysql_fetch_array($pagado);
				$total=$pagado2['t']+$m[5]-$m[2];
				echo "<td style='text-align:center;'>".$total."</td>";
			}
			if($tabla=='producto'){
			
			$item=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$m[0]));
			echo "<td>".$item['precio']."</td>";
			echo "<td>".$item['precio_venta']."</td>";
			}
			echo "</tr>";
		}
	}
	echo"</table>";
echo "<br><br></div>";
}

function name_column($tabla){
	$columnas='';$i=0;
	$id=0;////////////encabezados de las tablas
	$buscar = mysql_query("SELECT * FROM ".$tabla);
	while($campos = mysql_fetch_field($buscar)){ 
			$datos=explode('_',strtoupper($campos->name));
			if(count($datos)>1){
				if($id==0){
					$id=1;
				}else{
					$columnas[$i]=$datos[1];
					$i++;
				}
			}else{
				$columnas[$i]=$datos[0];
				$i++;
			}
		}
	return $columnas;
}
function lista($x){
	
	if($x=='proveedor'){
	$z=mysql_query("select * from proveedor order by nombre");
	$fun='agregar(this.value,"proveedor")';
	$s="<select name='proveedor' onchange='".$fun."'>";
	$s=$s."<option></option>";
	$s=$s."<option value='***'>Agregar</option>";
	while($m=mysql_fetch_array($z)){
		$s=$s."<option value='".$m['id_proveedor']."'>".$m['nombre']."</option>";
	}
	}elseif($x=='tipo'){
		$s="<select name='tipo'>";
		$s=$s."<option value='facturado'>Facturado</option>";
		$s=$s."<option value='nota'>Nota de Remision</option>";
	}elseif($x=='producto'){
		$z=mysql_query("select * from producto order by nombre");
		$fun='agregar(this.value,"producto")';
		$s="<select name='producto' onchange='".$fun."'>";
		$s=$s."<option></option>";
		$s=$s."<option value='***'>Agregar</option>";
		while($m=mysql_fetch_array($z)){
		$s=$s."<option value='".$m['id_producto']."'>".$m['nombre']."</option>";
		}
	}
	$s=$s."</select>";
	return $s;
}

function formapago(){
	$cmb='';
	$cmb=$cmb."<select name='formapago' id='formadepago'  required>";
	$cmb=$cmb."<option value=''>Seleccione una Opcion</option>";
	$cmb=$cmb."<option value='Pago con Cheque'>Pago con Cheque</option>";
	$cmb=$cmb."<option value='Pago en Efectivo'>Pago en Efectivo</option>";
	$cmb=$cmb."<option value='Pago con Tarjeta'>Pago con Tarjeta</option>";
	$cmb=$cmb."<option value='Deposito'>Deposito</option>";
	$cmb=$cmb."<option value='Transferencia'>Transferencia</option>";
	$cmb=$cmb."</select>";	
	return $cmb;
}

/*function cuentas(){
$cmb='<div id="cuentas" style="display:none;">';
$cmb=$cmb."<select name='cuenta' id='cuenta' onchange='validafp()'>";
$cmb=$cmb."<option value=''></option>";
$cmb=$cmb."<option value='ixe fis'>IXE FIS</option>";
$cmb=$cmb."<option value='banamex villa'>BANAMEX VILLA</option>";
$cmb=$cmb."<option value='banamex tarjeta city'>BANAMEX TARJETA CITY</option>";
$cmb=$cmb."<option value='banamex puente'>BANAMEX PUENTE</option>";
$cmb=$cmb."<option value='ninguna'>NINGUNA</option>";
$cmb=$cmb."</select>";
$cmb=$cmb."</div>";
return $cmb;
}*/

function tabla_venta($id){
	echo "<center><table border='1'>";
	echo "<tr><td>Folio</td><td rowspan='2'><h1>Villa Conin</h1></td><td>Fecha</td></tr>";
	echo "<tr><td>".$id."</td><td>".date('Y-m-d')."</td></tr>";
	echo "</table>";
	
	echo "<table class='style2'>";
	echo "<tr><td>Cantidad</td><td>Producto</td><td>Descripcion</td><td>Costo</td><td>Precio</td><td>Importe</td><td>Borrar</td></tr>";
	$query=mysql_query("select * from detalle where id=".$id." and tipo='venta'");//////////obtenemos los detalles  de la venta
	$total=0;$mostrar_cantidad=0;
	while($mostrar=mysql_fetch_array($query)){
		$p=mysql_query("select * from producto where id_producto=".$mostrar['id_producto']);
		$producto=mysql_fetch_array($p);///////////se obtiene las caracteristicas de cada producto
		///////////se obtiene el ultimo costo del producto de la tabla inventario
		$inv=mysql_query("select * from inventario where id_producto=".$producto['id_producto']);
		$inventario=mysql_fetch_array($inv);
		$importe=$mostrar['cantidad']*$inventario['precio_venta'];
		$mostrar_cantidad=$mostrar_cantidad+$mostrar['cantidad'];
		$total=$total+$importe;
		$link='window.location="venta2.php?opcion=Borrar&id='.$mostrar['id_detalle'].'&folio='.$id.'"';
		echo "<tr><td align='center'>".$mostrar['cantidad']."</td><td>".$producto['nombre']."</td><td>".$producto['descripcion']."</td><td>$".$inventario['precio']."</td><td>$".$inventario['precio_venta']."</td><td>$".$importe."</td><td  align='center'><img src='imagenes/borrar.png' width='15px' height='15px' onclick='".$link."'></td></tr>";
	}
	////total de la venta
	
	echo "<tr><td align='center'>Total:".$mostrar_cantidad."</td><td colspan='4' align='right'>Total</td><td>$".$total."</td></tr>";
	
	///////agregar nuevo registro
	echo "<form action='venta2.php' method='POST'>";
	echo "<tr><td><input  style='width:100px;' type='number' id='cantidad' name='cantidad' min='0'  onkeyup='calcular_importe()' ></td><td><input type='text'  id='product' name='producto' style='width:150px;display:inline;'><img src='imagenes/editar.jpg'  width='15px' height='15px' onclick='modificar()'></td><td></td><td id='costo'></td><td><p  id='precio_venta'></td><td><p id='importe'></td></tr>";
	echo "<tr><td colspan='4' align='center'><br><input type='submit' value='Guardar' name='opcion'></td><td colspan='2' align='center'><br><input type='submit' value='Siguiente' name='opcion'></td></tr>";
	echo "<input type='hidden' id='pv' value=''>";
	echo "<input type='hidden' name='etapa' value='2'>";
	echo "<input type='hidden' name='folio' value='".$id."'>";
	echo "</form>";
	echo "</table>";
	
}

function finaliza_venta($id){
echo "<h2>Esta por finalizar la venta indique la forma de pago</h2><br>";
echo "<form action='venta2.php' method='POST'>";
echo "<table>";
echo "<tr><td>Forma de Pago</td><td>".formapago()."</td></tr>";
echo "<tr><td><div id='cc2' style='display:none;'>Cuenta</div></td><td>
<select id='cuenta' name='cuenta' >
</select</td></tr>";
echo "<input type='hidden' name='folio' value='".$id."'>";
echo "<input type='hidden' name='etapa' value='3'>";
echo "<tr><td colspan='2' align='center'><br><input id='enviar' type='submit' name='opcion' value='Finalizar' disabled='disabled'></td></tr>";
echo "</table>";
echo "</form >";
}

function reporte_compras($fi,$fl){
	///////obtenemos los proveedores a los que les compramos en el rango de fechas
				$id_prov=mysql_query('select id_proveedor from compra where fecha>="'.$fi.'" and fecha<="'.$fl.'" group by id_proveedor');
				while($proveedor=mysql_fetch_array($id_prov)){
					$IdCompras='';
					$index=0;
					/////////////////obtenemos los id de compras de dichos proveedores entre el rango de fechas 
					$id_compra=mysql_query('select id_compra from compra where fecha>="'.$fi.'" and fecha<="'.$fl.'" and id_proveedor='.$proveedor['id_proveedor']);
					while($compra=mysql_fetch_array($id_compra)){
						$IdCompras[$index]=$compra['id_compra'];
						$index++;
					}
					////////////////obtenemos los productos adquiridos
					$addq='';
					$addq="select sum(cantidad) as t,id_producto from detalle where tipo='compra' and id=";
					$idc='';
					for($i=0;$i<count($IdCompras);$i++){
						if($i==count($IdCompras)-1){
							$idc=$idc.$IdCompras[$i]."";
						}else{
							$idc=$idc.$IdCompras[$i]." OR id=";
						}
					}
					$showp=mysql_query("select * from proveedor where id_proveedor=".$proveedor['id_proveedor']);
					$showp2=mysql_fetch_array($showp);
					echo "<h2>".$showp2['nombre']."</h2><table class='style2'>";
					echo "<tr><td>Cantidad</td><td>Producto</td><td>Descripcion</td></tr>";
					$addq2=mysql_query($addq.$idc.' group by id_producto');
					//echo $addq.$idc.' group by id_producto';
					while($datos=mysql_fetch_array($addq2)){
						$mp=mysql_query("select * from producto where id_producto=".$datos['id_producto']);
						$mp2=mysql_fetch_array($mp);
						echo "<tr><td align='center' width='100px'>".$datos['t']."</td><td width='200px'>".$mp2['nombre'].'</td><td>'.$mp2['descripcion'].'</td></tr>';
					}
					echo "</table>";
				}
		echo "<div id='compras' style='display:none;'>";
		echo "<h2>Compras facturadas</h2>";
		reporte_comprasfac($fi,$fl);
		echo "</div>";
}
function reporte_comprasfac($fi,$fl){
	///////obtenemos los proveedores a los que les compramos en el rango de fechas
				$id_prov=mysql_query('select id_proveedor from comprafac where fecha>="'.$fi.'" and fecha<="'.$fl.'" group by id_proveedor');
				while($proveedor=mysql_fetch_array($id_prov)){
					$IdCompras='';
					$index=0;
					/////////////////obtenemos los id de compras de dichos proveedores entre el rango de fechas 
					$id_compra=mysql_query('select id_compra from comprafac where fecha>="'.$fi.'" and fecha<="'.$fl.'" and id_proveedor='.$proveedor['id_proveedor']);
					while($compra=mysql_fetch_array($id_compra)){
						$IdCompras[$index]=$compra['id_compra'];
						$index++;
					}
					////////////////obtenemos los productos adquiridos
					$addq='';
					$addq="select sum(cantidad) as t,id_producto from detalle where tipo='comprafac' and id=";
					$idc='';
					for($i=0;$i<count($IdCompras);$i++){
						if($i==count($IdCompras)-1){
							$idc=$idc.$IdCompras[$i]."";
						}else{
							$idc=$idc.$IdCompras[$i]." OR id=";
						}
					}
					$showp=mysql_query("select * from proveedor where id_proveedor=".$proveedor['id_proveedor']);
					$showp2=mysql_fetch_array($showp);
					echo "<h2>".$showp2['nombre']."</h2><table class='style2'>";
					echo "<tr><td>Cantidad</td><td>Producto</td><td>Descripcion</td></tr>";
					$addq2=mysql_query($addq.$idc.' group by id_producto');
					//echo $addq.$idc.' group by id_producto';
					while($datos=mysql_fetch_array($addq2)){
						$mp=mysql_query("select * from producto where id_producto=".$datos['id_producto']);
						$mp2=mysql_fetch_array($mp);
						echo "<tr><td align='center' width='100px'>".$datos['t']."</td><td width='200px'>".$mp2['nombre'].'</td><td>'.$mp2['descripcion'].'</td></tr>';
					}
					echo "</table>";
				}
}
function reporte_entradas($fi,$fl){
	$q="select * from entrada where fecha>='".$fi."' and fecha<='".$fl."'";
	$r=mysql_query($q);
	$index=0;$Id='';
	while($m=mysql_fetch_array($r)){
		$Id[$index]=$m['id_entrada'];
		$index++;
	}
	$idc='';
	for($i=0;$i<count($Id);$i++){
		if($i==count($Id)-1){
			$idc=$idc.$Id[$i]."";
		}else{
			$idc=$idc.$Id[$i]." OR id=";
		}
	}
	$consulta='select sum(cantidad) as c,id_producto from detalle where  tipo="entrada" and id='.$idc.' group by id_producto';
	//echo $consulta;
	$r2=mysql_query($consulta);
	echo "<table class='style2'>";
	echo "<tr><td>Cantidad</td><td>Producto</td></tr>";
	while($m2=mysql_fetch_array($r2)){
		$mp=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
		$mp2=mysql_fetch_array($mp);
		echo "<tr><td align='center'>".$m2['c']."</td><td>".$mp2['nombre']."</td></tr>";
	}
	echo "</table>";
}
function reporte_salidas($fi,$fl){
	echo "<br>";
	$q="select * from salida where fecha>='".$fi."' and fecha<='".$fl."'";
	$r=mysql_query($q);
	$index=0;$Id='';
	while($m=mysql_fetch_array($r)){
		$Id[$index]=$m['id_salida'];
		$index++;
	}
	$idc='';
	for($i=0;$i<count($Id);$i++){
		if($i==count($Id)-1){
			$idc=$idc.$Id[$i]."";
		}else{
			$idc=$idc.$Id[$i]." OR id=";
		}
	}
	$consulta='select sum(cantidad) as c,id_producto from detalle where  tipo="salida" and id='.$idc.' group by id_producto';
	//echo $consulta;
	$r2=mysql_query($consulta);
	echo "<table class='style2'>";
	echo "<tr><td>Cantidad</td><td>Producto</td></tr>";
	while($m2=mysql_fetch_array($r2)){
		$mp=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
		$mp2=mysql_fetch_array($mp);
		echo "<tr><td align='center'>".$m2['c']."</td><td>".$mp2['nombre']."</td></tr>";
	}
	echo "</table>";
}
function repòrte_ventas($fi,$fl){
	echo "<br>";
	$q="select * from venta where fecha>='".$fi."' and fecha<='".$fl."'";
	$r=mysql_query($q);
	$index=0;$Id='';
	while($m=mysql_fetch_array($r)){
		$Id[$index]=$m['id_venta'];
		$index++;
	}
	$idc='';
	for($i=0;$i<count($Id);$i++){
		if($i==count($Id)-1){
			$idc=$idc.$Id[$i]."";
		}else{
			$idc=$idc.$Id[$i]." OR id=";
		}
	}
	$consulta='select sum(cantidad) as c,id_producto from detalle where  tipo="venta" and id='.$idc.' group by id_producto';
//	echo $consulta;
	$r2=mysql_query($consulta);
	echo "<table class='style2'>";
	echo "<tr><td>Cantidad</td><td>Producto</td></tr>";
	while($m2=mysql_fetch_array($r2)){
		$mp=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
		$mp2=mysql_fetch_array($mp);
		echo "<tr><td align='center'>".$m2['c']."</td><td>".$mp2['nombre']."</td></tr>";
	}
	echo "</table>";
}

function inventario(){
	
	$cat=mysql_query("select * from categoria");
	echo "<form name='inventario' action='a_inventario.php' method='POST'>";
	while($categoria=mysql_fetch_array($cat)){
		echo "<h2>".$categoria['nombre']."</h2>";
		$sub=mysql_query("select * from subcategoria where id_categoria=".$categoria['id_categoria']);
		while($subcategoria=mysql_fetch_array($sub)){
		echo '------'.$subcategoria['nombre']."------<br>";
		echo "<table class='style1'>";
		echo "<tr><td>ID</td><td>NOMBRE</td><td>DESCRIPCION</td><td>ULTIMO COSTO</td><td>INVENTARIO<BR>INICIAL</td><td colspan='2'>COMPRA</td><td>ENTRADA</td><td>SALIDA</td><td colspan='2'>VENTA</td><td colspan='2'>INVENTARIO<BR>ACTUAL</td></tr>";
		$p=mysql_query("select * from producto where id_categoria=".$categoria['id_categoria']." and id_subcategoria=".$subcategoria['id_subcategoria']);
		while($producto=mysql_fetch_array($p)){
			$i=mysql_query("select * from inventario where id_producto=".$producto['id_producto']);
			$inventario=mysql_fetch_array($i);
			echo "<tr><td>".$producto['id_producto']."</td><td>".$producto['nombre']."</td><td>".$producto['descripcion']."</td><td align='center'>".$inventario['precio']."</td><td align='center'>".$inventario['cantidad']."</td>";
			$can='totalc("'.$producto['id_producto'].'")';
			///////compras
			echo "<td><input type='text' style='width:50px;' id='compra_".$producto['id_producto']."' onkeyup='".$can."'></td><td><input type='text' style='width:50px;' id='nuevocosto_".$producto['id_producto']."' onkeyup='".$can."'></td>";
			///entradas
			echo "<td><input type='text' style='width:50px;' id='entrada_".$producto['id_producto']."' onkeyup='".$can."'></td>";
			///salidas
			echo "<td><input type='text' style='width:50px;' id='salida_".$producto['id_producto']."' onkeyup='".$can."'></td>";
			///venta			
			echo "<td><input type='text' style='width:50px;' id='venta_".$producto['id_producto']."' onkeyup='".$can."'></td><td><input type='text' style='width:50px;'></td>";
			echo "<td id='c_".$producto['id_producto']."'>".$inventario['cantidad']."</td><td id='p_".$producto['id_producto']."'>".($inventario['cantidad']*$inventario['precio'])."</td>";
			echo "<input type='hidden' id='pf_".$producto['id_producto']."' name='p_".$producto['id_producto']."' value='".$inventario['precio']."'>";
			echo "<input type='hidden' id='cf_".$producto['id_producto']."' name='c_".$producto['id_producto']."' value='".$inventario['cantidad']."'>";
			echo "<input type='hidden' id='inicial_".$producto['id_producto']."' value='".$inventario['cantidad']."'>";
			echo "<input type='hidden' id='costo_".$producto['id_producto']."' value='".$inventario['precio']."'>";
			echo "</tr>";
		}
		echo "</table>";
		}
	}
	echo "</form>";
}

function ultima_modificacion_inventario(){
	$max=mysql_query("select max(fecha)as fecha from inventario");
	$maxf=mysql_fetch_array($max);
	echo "<font color='white'>".$maxf['fecha']."</font><br>";
}
?>