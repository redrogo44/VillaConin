 <?php
require 'funciones2.php';
conectar();
$sql = "SELECT * from contrato where Numero='W021021L'";
 $info=mysql_fetch_array(mysql_query($sql));
//////////servicios adicionales
    //	echo $mis_servicios['ServiciosAdicionales']."<br><br>";
	$info=explode("#",$info['ServiciosAdicionales']);
	echo "<pre>".$info."</pre>";
	for($i=0;$i<count($info);$i++){
		$id=explode("_",$info[$i]);
		$service=explode(";",$id[1]);
		for($i2=0;$i2<count($service);$i2++){
			echo $service[$i2]."<br>";
		/*	$s=explode(',',$service[$i2]);
			if(isset($servicios[$s[0]])){
				$servicios[$s[0]]=$servicios[$s[0]]+$s[1];
			}else{
				$servicios[$s[0]]=$s[1];
			}
		*/
		}
		
	}

?>