<?php
class Conectar 
{
	public static function con()
	{
		$con=mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
		mysql_query("SET NAMES 'utf8' ");
		mysql_select_db("qroodigo_VillaConin");
		return $con;
	} 
}
class Trabajo
{
	private $pro;
	
	public function __construct()
	{
		$this->pro=array();
	}
	
	public function get_productos()
	{
		$sql="SELECT * FROM `productos_tiendita`";
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->pro[]=$reg;
		}
			return $this->pro;
	}
}
?>