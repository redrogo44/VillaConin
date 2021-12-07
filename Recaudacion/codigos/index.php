<!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body onload="genera()">
 	<?php
//require_once('barcode.inc.php'); 
print_r($_GET);
$code_number = $_GET['codigo'];
#new barCodeGenrator($code_number,0,'hello.gif'); 
//PARAMETROS codigo SI ES 0 MUESTRA LA IMAGEN SI ES 1 LAGUARDA EN EL SERVER NOMBRE DE IMAGEN A GUARDAR
//new barCodeGenrator($code_number,1,$code_number.'.gif', 190, 130, true);
echo '<script languaje="JavaScript">
            
      var varjs="'.$_GET['codigo'].'";
            
      alert(varjs);
            
</script>';
?>
 </body>
 <script>	
	 function genera()
	 {
	 	//alert(varjs);
	 	var xmlhttp2;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp2=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp2.onreadystatechange=function()
		  {
		  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
			{
				var xx3=xmlhttp2.responseText;				
				//alert(xx3);
			}
		  }
			xmlhttp2.open("POST","../Codigos2/Modulos/principal/generador.php",true);
			xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp2.send("generar=i&&codigo="+varjs);	
			window.close(); 
	 }
		
	</script>
 </html> 