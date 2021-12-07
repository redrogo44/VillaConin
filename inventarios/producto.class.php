<?php
class Producto2
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'qroodigo_usuarios';
        $dbpass = 'qroodigo_usuarios';
        $dbname = 'qroodigo_VillaConin';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarProducto($nombreProducto){
        $datos = array();

        $sql = "SELECT * FROM producto
                WHERE nombre LIKE '%$nombreProducto%'";

        $resultado = mysql_query($sql);
		
        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
			$unidad=mysql_query("select * from unidad where id_unidad=".$row['id_unidad']);
			$unidad2=mysql_fetch_array($unidad);
			$cat=mysql_query("select * from categoria where id_categoria=".$row['id_categoria']);
			$categoria=mysql_fetch_array($cat);
			$subcat=mysql_query("select * from subcategoria where id_subcategoria=".$row['id_subcategoria']);
			$subcategoria=mysql_fetch_array($subcat);
			$costo=mysql_query("select * from inventario where id_producto=".$row['id_producto']);
			$costom=mysql_fetch_array($costo);
           // $ultimo_c=mysql_fetch_array(mysql_query("select * from (select * from detalle where tipo='compra' or tipo='comprafac') t where t.id_producto=".$row['id_producto']." order by t.id_detalle desc limit 1"));
             $ultimo_c=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$row['id_producto']));
            
            $datos[] = array("value" => utf8_encode($row['nombre']),
                             "descripcion" => $row['descripcion'],
							 "unidad" => $unidad2['nombre'],
							 "categoria" => $categoria['nombre'],
							 "subcategoria" => $subcategoria['nombre'],
							 "costo" => $costom['precio'],
							 "impuesto" => $row['impuesto'],
							 "venta" => $costom['precio_venta'],
							 "uc" => $ultimo_c['precio'],);
        }
		///////////////////productos suspendidos
		$sql2 = "SELECT * FROM borrados
                WHERE nombre LIKE '%$nombreProducto%'";

        $resultado2 = mysql_query($sql2);
		
        while ($row2 = mysql_fetch_array($resultado2, MYSQL_ASSOC)){
			
            $datos[] = array("value" => utf8_encode($row2['nombre']),
                             "descripcion" => "---SUSPENDIDO---",
							 "unidad" => "---",
							 "categoria" => "---",
							 "subcategoria" => "---",
							 "costo" => "---",
							 "impuesto" => "---",
							 "id" => $row2['id_borrados'],
							 "venta" => "---",);
        }
        return $datos;
    }
}
?>