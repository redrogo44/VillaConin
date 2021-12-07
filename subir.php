<?php

//conexion a la base de datos
require 'funciones.php';
conectar();
 
//comprobamos si ha ocurrido un error.
if ( ! isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0){
    echo "ha ocurrido un error";
} else {
    //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
    //y que el tamano del archivo no exceda los 16mb
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384; //16mb es el limite de medium blob
     
    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
     
        //este es el archivo temporal
        $imagen_temporal  = $_FILES['imagen']['tmp_name'];  
        //este es el tipo de archivo
        $tipo = $_FILES['imagen']['type'];
        //leer el archivo temporal en binario
        $fp     = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
        //escapar los caracteres
        $data = mysql_escape_string($data);

        $resultado = mysql_query("INSERT INTO IMAGENES (nombre, imagen) VALUES ('$tipo','$data')");
        if ($resultado){
            echo "el archivo ha sido copiado exitosamente";
        } else {
            echo "ocurrio un error al copiar el archivo.";
        }
    } else {
        echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
    }
}
?>