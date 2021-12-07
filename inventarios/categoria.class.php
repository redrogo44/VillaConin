<?php
class Categoria
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'qroodigo_usuarios';
        $dbpass = 'qroodigo_usuarios';
        $dbname = 'qroodigo_VillaConin';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarCategoria($nombreCategoria){
        $datos = array();
        $sql = "SELECT * FROM categoria
                WHERE nombre LIKE '%$nombreCategoria%'";

        $resultado = mysql_query($sql);
		
        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['nombre']);
        }

        return $datos;
    }
}
?>