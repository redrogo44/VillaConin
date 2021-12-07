<?php
class Unidad
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'qroodigo_usuarios';
        $dbpass = 'qroodigo_usuarios';
        $dbname = 'qroodigo_VillaConin';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarUnidad($nombreUnidad){
        $datos = array();
        $sql = "SELECT * FROM unidad
                WHERE nombre LIKE '%$nombreUnidad%'";

        $resultado = mysql_query($sql);
		
        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['nombre']);
        }
        return $datos;
    }
}
?>