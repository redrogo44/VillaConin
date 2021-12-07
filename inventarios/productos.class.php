<?php
session_start();
class Producto
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

        $sql = "SELECT * FROM ".$_SESSION['table']."
                WHERE nombre LIKE '%$nombreProducto%'";

        $resultado = mysql_query($sql);
		
        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['nombre']);
        }

        return $datos;
    }
}
?>