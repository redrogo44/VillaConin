<?php
session_start();
class Sub
{
    public function  __construct() {
        $dbhost = 'localhost';
        $dbuser = 'qroodigo_usuarios';
        $dbpass = 'qroodigo_usuarios';
        $dbname = 'qroodigo_VillaConin';

        mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);
    }

    public function buscarSub($nombreSub){
        $datos = array();
		$cat=mysql_query("select * from categoria where nombre='".$_SESSION['category']."'");
		$m=mysql_fetch_array($cat);
		
        $sql = "SELECT * FROM subcategoria
                WHERE nombre LIKE '%$nombreSub%' and id_categoria=".$m['id_categoria'];

        $resultado = mysql_query($sql);
		
        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['nombre']);
        }

        return $datos;
    }
}
?>