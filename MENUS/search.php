<?php
require("../funciones2.php");
conectar();
// limpio la palabra que se busca
$search= trim($_GET['search']);
// la busco 
$result= search($search);
// seteo la cabecera como json
header('Content-type: application/json; charset=utf-8');
//imprimo el resultado como un json
echo json_encode($result);
/**
 *  Funcion que busca en los datos un resultado  que tenga que ver
 *  con la busqueda, si los datos vinieran de base no seria necesario esto
 *  ya que lo podriamos resolver directamente por sql
 */
function search($searchWord)
{
    $tmpArray=array();
    /**
     * Obtengo los datos almacenados en el array
     */
    $data=getData();
    
    /*
     * Recorro el array para ver si hay palabras que empiecen con lo que viene
     * por parametros
     */
    foreach($data as $word)
    {
        // obtengo el tamaño de la palabra que se busca.
        $searchWordSize=strlen($searchWord);
        // corto la palabra que viene del array y la dejo del mismo tamaño que 
        // la que se busca de manera de poder comparar.
        $tmpWord=substr($word, 0,$searchWordSize);
        // si son iguales la guardo para devolverla
        if (strtolower($tmpWord) == strtolower($searchWord))
        {
            // guardo la palabra original sin cortar.
            $tmpArray[]=$word;
        }
    }
    return $tmpArray;
}
/**
 * Retorna los datos, podria ser una base de datos
 * para simplificar solo hice esta funcion que devuelve
 * un array ordenado
 */
function getData()
{
	///////obtenemos las categrias de tipo INSUMO
		
		$c1=mysql_query("select * from categoria where tipo='INSUMO'");
		$id_cat=array();
		while($categoria=mysql_fetch_array($c1)){
			array_push($id_cat,$categoria["id_categoria"]);
		}
		
		$condicion="";
		for($i=0;$i<count($id_cat);$i++){
			if($i==0){
				$condicion=$condicion." id_categoria=".$id_cat[$i];
			}else{
				$condicion=$condicion." OR id_categoria=".$id_cat[$i];
			}
		}
		
		///obtenemos los productos de tipo insumo
		//echo "select * from producto where ".$condicion." ORDER BY nombre";
		$q=mysql_query("select * from producto where ".$condicion." ORDER BY nombre");
	
  	$result=array();
    while ($res= mysql_fetch_array($q)) 
    {	
		///validamos que los producto ya se encuentren con toda la informacion
		$inventario=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$res["id_producto"]));
		if($inventario["UnidadMenu"]!='' && $inventario["ProveedorMenu"]!='' && $inventario["Equivalencia"]!=''){
			$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$res["id_unidad"]));        //$result[]=$res['nombre']."-".$res['descripcion']."-".$unidad["nombre"]."-$".number_format($inventario["precio"],3);
			$result[]=$res["nombre"]."-".$res["descripcion"];
		}
		      
    }
    
    asort($result);
    return $result;
}