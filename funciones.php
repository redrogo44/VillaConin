<?php

	function conectar(){
	$con = mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
	if(!$con)
	{
		die('no hay conexion al servidor');
	}
	$base = mysql_select_db('qroodigo_VillaConin');
	if(!$base){
		die('no se pudo conectar a la bd');
	}
	else{
	mysql_set_charset('utf8');
	 //echo "conexion exitosa";
	
}}

function validarsesion(){
	session_start();
if(isset($_SESSION['nombre'])) {
echo '<script language="javascript">href.location="index.php";</script>';
}else{
header("location:login.php");
}

}
//-------------------------------------->>>>>>>>>>  BUSCAR ID DE CLIENTE-------------------------------------------------------------------------------
function busqueda () {
		$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
		
		$query="select * from contrato where Numero='$campo' or Fecha='$campo';";

		$resultado=mysql_query($query);
		echo "<table width=400px  border=1 bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha contrato</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Correo</th>";	
					echo "<th>RFC</th>";
					echo "<th>Domicilio</th>";									
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['fecha contrato']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['mail']."</td>";
						echo "<td>".$muestra['rfc']."</td>";						
						echo "<td>".$muestra['domicilio']."</td>";
					echo "</tr>";
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";
	}

//-------------------------------------->>>>>>>>>>  ESTADO DE CUENTA-------------------------------------------------------------------------------
function edocuenta () {
     	$campo = $_POST['campo'];
		
		$query="select * from clientes where id='$campo' ;";

		$resultado=mysql_query($query);
		echo "<table width=400px  border=1 >";
			echo "<thead>";
				echo "<tr>";
					echo "<th>ID</th>";									
					echo "<th>Nombre</th>";
					echo "<th>Apellido paterno</th>";
					echo "<th>Apellido materno</th>";
					echo "<th>curp</th>";					
					echo "<th>rfc</th>";	
					echo "<th>Direccion</th>";
					echo "<th>Saldo Actual</th>";
					
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						echo "<td>".$muestra['id']."</td>";						
						echo "<td>".$muestra['nom']."</td>";
						echo "<td>".$muestra['ap']."</td>";
						echo "<td>".$muestra['am']."</td>";
						echo "<td>".$muestra['curp']."</td>";
						echo "<td>".$muestra['rfc']."</td>";
						echo "<td>".$muestra['dom']."</td>";						
						echo "<td>".$muestra['si']."</td>";
					echo "</tr>";
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";
	}


function menu()
{
		echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

echo"<title>Villa Conin</title>";
echo"<style type='text/css'>";
	
             echo"*{";
				 echo"padding:0px;";
				 echo"margin:0px;";
			  
			  
  			  echo"#header{";
				  echo"margin:auto;";
 				  echo"width:600px;";
				  echo"height:auto;";
				  echo"font-family:Arial, Helvetica, sans-serif;";
				  echo"}";
			  echo"ul,ol{";
				 echo"list-style:none;}";
				 
			 echo".nav li a {";
				 echo"background-color:#000;";
				 echo"color:#fff;";
				 echo"text-decoration:none;";
				 echo"padding:10px 15px;";
				 echo"display:block;";
				 echo"}";
			echo".nav li a:hover ";
			echo"{";
			 echo"background-color:#434343;";
		    echo"}";
			 echo".nav > li{";
				 echo"float:left;}";
			echo".nav li ul {";
				echo"display:none;";
				echo"position:absolute;";
				echo"min-width:140px;";
				echo"border-color:#900;";
				echo"border-style:solid;";
				echo"border-radius:10px;";
				echo"}";
			echo".nav li:hover> ul{";
				echo"display:block;";
				echo"}";
			echo".nav li ul li{";
				echo"position:relative;}";
			echo".nav li ul li ul{";
				echo"right:180px;";
				echo"top:0px;";
				echo"animation:infinite;";
				echo"color:#F00;";
				echo"border-color:#900;";
				echo"border-style:solid;";
				echo"border-radius:10px;";
				echo"}";
				
				echo".pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;";
				echo"} ";
    echo"</style>";
echo"</head>";

echo"<body>";
 
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
   
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       echo"<li><a href='NuevoContrato.php'>Nuevo Contrato</a></li>";
       echo"<li><a href=''>Movimientos</a>";
		   echo"<ul>";
		     	 echo"<li><a href='Cargos.php'>Cargos</a>";
				echo"<li><a href='Abonos-cliente.php'>Abonos</a></li>";
				 
		   echo"</ul>";      
		   echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
	   echo"</li>";
     echo"</ul>";
   echo"</li>";
        
   echo"<li><a href=''>Clientes</a>";
       echo"<ul>";
       echo"<li><a href='Cliente-nuevo.php'>Nuevo Cliente</a></li>";
       echo"<li><a href='Preregistro.php'>Pre-Registro</a></li>";
	    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
      echo"</ul>";
   echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
         
		    echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
			echo"<li><a href=''>Ver Contratos</a></li>";
         
       echo"</ul>";
   echo"</li>";
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
  echo"</div>";
	

}
function insertarprere(){
	
	

	

$nombre = $_POST["nom"]; 
$ap = $_POST["ap"]; 
$am = $_POST["am"]; 
$fecha = $_POST["fecha"]; 
$invitados = $_POST["comenzales"];
$telefono = $_POST["tel"];
$mail = $_POST["mail"]; 
$tipo = $_POST["tipo"];
$medio = $_POST["medio"]; 
$conexion=mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
mysql_select_db("mbrsoluc_villaconin",$conexion);

$insertar=mysql_query("INSERT INTO preregistro (nombre,ap,am,fecha,invitados,telefono,mail,tipo,medio)  VALUES ('$nombre','$ap','$am','$mail','$fecha','$invitados','$telefono','$mail','$tipo','$medio')",$conexion);
if (!$insertar) { 
die("datos no insertados: " . mysql_error()); 
} 
	
	
	
}	

function menusuperusuario()
{
	echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

echo"<title>Villa Conin</title>";
echo"<style type='text/css'>";
	
             echo"*{";
				 echo"padding:0px;";
				 echo"margin:0px;";
			  
			  
  			  echo"#header{";
				  echo"margin:auto;";
 				  echo"width:600px;";
				  echo"height:auto;";
				  echo"font-family:Arial, Helvetica, sans-serif;";
				  echo"}";
			  echo"ul,ol{";
				 echo"list-style:none;}";
				 
			 echo".nav li a {";
				 echo"background-color:#000;";
				 echo"color:#fff;";
				 echo"text-decoration:none;";
				 echo"padding:10px 15px;";
				 echo"display:block;";
				 echo"}";
			echo".nav li a:hover ";
			echo"{";
			 echo"background-color:#434343;";
		    echo"}";
			 echo".nav > li{";
				 echo"float:left;}";
			echo".nav li ul {";
				echo"display:none;";
				echo"position:absolute;";
				echo"min-width:140px;";
				echo"border-color:#900;";
				echo"border-style:solid;";
				echo"border-radius:10px;";
				echo"}";
			echo".nav li:hover> ul{";
				echo"display:block;";
				echo"}";
			echo".nav li ul li{";
				echo"position:relative;}";
			echo".nav li ul li ul{";
				echo"right:180px;";
				echo"top:0px;";
				echo"animation:infinite;";
				echo"color:#F00;";
				echo"border-color:#900;";
				echo"border-style:solid;";
				echo"border-radius:10px;";
				echo"}";
				
				echo".pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;";
				echo"} ";
    echo"</style>";
echo"</head>";

echo"<body>";
 
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='indexsuper.php'>Inicio</a></li>";
   
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       echo"<li><a href='NuevoContrato.php'>Nuevo Contrato</a></li>";
       echo"<li><a href=''>Movimientos</a>";
		   echo"<ul>";
		     	 echo"<li><a href='Cargos.php'>Cargos</a>";
				echo"<li><a href='Abonos-cliente.php'>Abonos</a></li>";
				 
		   echo"</ul>";      
		   echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
	   echo"</li>";
     echo"</ul>";
   echo"</li>";
        
   echo"<li><a href=''>Clientes</a>";
       echo"<ul>";
       echo"<li><a href='Cliente-nuevo.php'>Nuevo Cliente</a></li>";
       echo"<li><a href='Preregistro.php'>Pre-Registro</a></li>";
	    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
      echo"</ul>";
   echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
           echo"<li><a href=''>Clientes</a></li>";
		   echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
           echo"<li><a href=''>Abonnos</a></li>";
           echo"<li><a href=''>Cargos</a></li>";
		   echo"<li><a href=''>Medios de Contacto</a></li>";
		   echo"<li><a href=''>Ver Contrato</a></li>";
       echo"</ul>";
   echo"</li>";
   echo"<li><a href=''>Usuarios</a>";
       echo"<ul>";
          
		   echo"<li><a href='BuscarUsuario.php'>Buscar Usuario</a></li>";
		   echo"<li><a href='CrearUsuario.php'>Crear Usuario</a></li>";
          

       echo"</ul>";
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
  echo"</div>";
	
}
function buscarcontrato()
{
	$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
	$query="select * from contrato where Numero='$campo' or Fecha='$campo';";

$resultado=mysql_query($query);
// secuencia Abonos y Cargos
 $campo = $_POST['campo'];
		$query="select * from abono where numcontrato='$campo' ;";
		$resultado1=mysql_query($query);
		$query2="select * from cargo where numcontrato='$campo' ;";
		$resultado2=mysql_query($query2);

if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						$Numero=$_POST[$muestra['Numero']."</td>"];
						$NumeroContrato=$muestra['Numero'];
						 $Num=$muestra['nombre']; 
						$fechaevento=$muestra['fechacontrato'];
						 $SaldoInicial=$muestra['si'];
						$SaldoActual=$muestra['sa'];
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";



	
	echo"<table border='2' align='center' title='Abonos' width='140px' bordercolor='#0000CC'>";
     echo"<tr><td align='center'><b>Estado de Cuenta</b></td></tr>";
	echo" <table border='2' align='center' title='Buscar Por:' width='540px' bordercolor='#0000CC'>";
       echo"<tr>";
       echo"<form action='busqueda.php' method='post'>";
          echo"<td width='180px'><b>Nombre de Contrato</b></td>";
          echo"<td  align='center'><b>";    echo $Num;       echo"</b></td>";
          echo"<tr>";
           echo"<td width='' ><b>Numero de Contrato</b></td>";
          echo" <td align='center'><b>";echo $NumeroContrato; echo"</b></td>";
          echo"</tr>";
          echo"<tr>";
           echo"<td width=''><b>Fecha del Evento</b></td>";
              echo"<td width='' align='center'><b>"; echo $fechaevento;echo"<b></td>";
          echo"</tr>";
           echo"<tr>";
              echo"<td width='150' align='center'><b>Saldo Inicial</b></td>";
              echo"<td align='center'><b>";echo $SaldoInicial;echo"</b></td>";
              echo"<td width='100px' align='center'><b>Saldo Actual</b></td>";
              echo"<td width='100px' align='center'><b>";echo $SaldoActual;            	 echo" </b></td>";

              echo"<tr>";
               echo"<td align='center'>     </td>";
          echo"</tr>       ";
    echo"</tr>";
     echo"</table>";
     
     echo"<table border='4px' bordercolordark='#000000'  width='600px' bgcolor='#FFFFFF' bordercolor='#0000CC'>";

	echo"<tr align='center'>";
     echo"<td >";
    	echo"<b>Fecha Movimiento</b>   ";
     echo"</td>";
     echo"<br>";
     echo"<td width='150px'>";
    	echo"<b>Folio</b>   ";
     echo"</td>";
     echo"<td>";
    	echo"<b>Concepto</b>   ";
     echo"</td>";
     
          echo"<td width=' 200px'>";
    	echo"<b>Total</b>  ";
     echo"</td>";
    while($muestra=mysql_fetch_array($resultado1))
	{
		echo "<tr bgcolor='#00FF00' align='center'><td>".$muestra["fechapago"]."</td><td>".$muestra["id"]."</td><td>".$muestra["concepto"]."</td><td>".$muestra["cantidad"]."</td></tr>";
		}     
		while($muestra=mysql_fetch_array($resultado2))
	{
		echo "<tr bgcolor='#FF0000' align='center'><td><font color='#FFFFFF'>".$muestra["fecha"]."</td><td><font color='#FFFFFF'>".$muestra["id"]."</td><td><font color='#FFFFFF'>".$muestra["concepto"]."</td><td><font color='#FFFFFF'>".$muestra["cantidad"]."</font></td></tr>";
		}     
     echo"</table>";

         
	
		  
     
echo"</form>";
			

	}


function busquedacliente () {
     	$campo = $_POST['campo'];
		
		$query="select * from cliente where ap='$campo' or rfc='$campo';";

		$resultado=mysql_query($query);
		echo "<table width=400px  border=1 bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Nombre</th>";
					echo "<th>A. paterno</th>";
					echo "<th>A. materno</th>";
					echo "<th>mail</th>";					
					echo "<th>RFC</th>";	
					echo "<th>Regimen</th>";
					echo "<th>D. comercial</th>";									
					echo "<th>Domicilio</th>";									
					echo "<th>C.P</th>";														
					echo "<th>Telefono</th>";
					echo "<th>Contrato</th>";																		
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['ap']."</td>";
						echo "<td>".$muestra['am']."</td>";
						echo "<td>".$muestra['mail']."</td>";
						echo "<td>".$muestra['rfc']."</td>";
						echo "<td>".$muestra['regimen']."</td>";						
						echo "<td>".$muestra['dcom']."</td>";
						echo "<td>".$muestra['dom']."</td>";
						echo "<td>".$muestra['cp']."</td>";
						echo "<td>".$muestra['tel']."</td>";
						echo '<td><a href="Contrato.php?idcliente='.$muestra['id'].'">Registrar</a></td>';
																		
					echo "</tr>";
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";
	}

function buscarcontraCarogo()
{
	$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
	$query="select * from contrato where Numero='$campo' or Fecha='$campo';";

$resultado=mysql_query($query);


if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						$Numero=$_POST[$muestra['Numero']."</td>"];
						$NumeroContrato=$muestra['Numero'];
						 $Num=$muestra['nombre']; 
						$fechaevento=$muestra['fechacontrato'];
						 $SaldoInicial=$muestra['si'];
						$SaldoActual=$muestra['sa'];
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";

	echo"<div align='center'>";
echo"<br /><br /><br  style='background-position:center'/>";
     echo"<table border='1' align='center' title='Abonos' >";
     echo"<tr><td align='center'><b>Realizar Cargos</b></td></tr>";
	 echo"<table border='1' align='center' title='Buscar Por' width='540px'>";
       echo"<tr>";
	   
       echo"<form action='altacargo.php' method='post'>";
          echo"<td width=''><b>Numero de Contrato</b></td>";
          echo"<td width=''>"; echo $NumeroContrato; echo"</td>";
          echo"</tr>";
		  echo"<tr>";
          echo"<td width=''><b>Nombre de Contrato</b></td>";
              echo"<td width=''>"; echo $Num; echo"</td>";
          echo"</tr>";
          echo"<td width='180px'><b>Fecha</b></td>";
          echo"<td>";
		  echo date("d-m-Y");
         echo"</td>";
          echo"<tr>";
           
          echo"<tr>";
           echo"<td width=''><b>Concepto</b></td>";
              echo"<td width=''>
			  <input name='numero' type='hidden' value=".$NumeroContrato.">
			  <input name='concepto' type='text' size='35' maxlength='35' placeholder='	Concepto de Cargo'>   </td>";
          echo"</tr>";
           echo"<tr>";
              echo"<td width='150'><b>Total</b></td>";
              echo"<td>	 <input name='total' type='text' size='35' maxlength='35' placeholder='	Monto Total'> </td>";
              
              echo"<tr>";
               echo"<td align='center'>  <td align='center'>
       <p><input type='submit' /></p>  </td>";
	   echo"</form>";
          echo"</tr>       ";
    echo"</tr>";
     echo"</table>";
  

 
echo"</div>";
	}



function abonos()
{$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
	$query="select * from contrato where Numero='$campo' or Fecha='$campo';";

$resultado=mysql_query($query);


if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						
						$NumeroContrato=$muestra['Numero'];
						 $Nombre=$muestra['nombre']; 
						$fechaevento=$muestra['Fecha'];
						 $TipoEvento=$muestra['tipo'];
						$Salon=$muestra['salon'];
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";


	
echo"<br /><br  /><BR  />	";
echo"<div align='center'>";
echo"<form id='form1' name='form1' method='post' action='FormularioPDF/php/CargaAbono.php' target='_blank'>";
  echo"<div id='apDiv1' align='center'>";
    echo"<table width='373' height='361' border='1' align='center' 	'>";
      echo"<tr>";
        echo"<td width='139'>Nombre de Contrato</td>";
        echo"<td width='198' id='nomcontrato' >";echo $Nombre; echo"</td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td width='139'>Numero Contrato</td>";
        echo"<td width='198'>";echo $NumeroContrato; echo"</td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Fecha</td>";
        echo"<td>";
         echo date("d-m-Y");
        echo"</td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Recibi de</td>";
        echo"<td>";
        echo"<input name='recibide' type='text'size='35' maxlength='35' value=''> </td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Cantidad de</td>";
        echo"<td><input name='cantidadde' type='text' size='35' maxlength='35' value=''> </td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Por Concepto de</td>";
        echo"<td><label for='oncepto'></label>";
          echo"<select name='concepto' id='concepto' >";
            echo"<option value='Pago del Cliente'>Seleccione una Opcion</option>";
            echo"<option value='Pago con Cheque'>Pago con Cheque</option>";
            echo"<option value='Pago en Efectivo'>Pago en Efectivo</option>";
            echo"<option value='Deposito'>Deposito</option>";
            echo"<option value='Transferencia'>Transferencia</option>";
           
       echo" </select></td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Fecha del Evento</td>";
        echo"<td>";
      echo $fechaevento;
      echo"</td>";
      echo"</tr>";
      echo"<tr>";
       echo" <td>Tipo de Evento</td>";
        echo"<td>"; echo $TipoEvento; echo"</td>";
      echo"</tr>";
      echo"<tr>";
        echo"<td>Salon</td>";
        echo"<td>";echo $Salon; echo"</td>";
      echo"</tr>";
   
	  echo "<tr><td></td><td><input type='submit' value='Enviar' Onclick='red()'></td></tr>";
	 
	  echo "<tr><td>";
	  echo "<input type='hidden' name='nombre' value='".$Nombre."'>";
		echo "<input type='hidden' name='numero' value='".$NumeroContrato."'>";
	  echo "<input type='hidden' name='fecha_e' value='".$fechaevento."'>";
		echo "<input type='hidden' name='tipo' value='".$TipoEvento."'>";
		echo "<input type='hidden' name='salon' value='".$Salon."'>";
		echo "</td><td></td></tr>";
	 echo" <tr>";
             echo"<td></td>";
	        echo"<td align='center'></td>";
     echo" </tr>";
    echo"</table>";
 echo" </div>";
  echo"</form>";


	}
function nombre_contrato($f,$s,$v){
	$nombre;
	//salon
	if($s=="Fundador de Conin"){
		$nombre='X';
		}
	else if($s=="Real de Conin"){
		$nombre='Y';
			}
	else if($s=="Alcazar Conin"){
		$nombre='Z';
		}
	else if($s=="Solar de Conin"){
		$nombre='W';
		}
	//fecha	
	$fecha=explode("-",$f);
	$nombre=$nombre . $fecha[2] . $fecha[1];
	$vi=(int)$fecha[0];
	$vi=$vi-2000;
	$nombre=$nombre . $vi;
	//vendedor
	if($v=="Luis"){
		$nombre=$nombre . "L";
		}
	else if($v=="Oscar"){
		$nombre=$nombre . "O";
		}
		
	return $nombre;
	
	}
	
	function ValidarNombreContrato($variable)
	{
		$q="select count(nombre)'cantidad' from contrato where nombre='".$variable."'";
		$resu=mysql_query($q);
		while($muestra=mysql_fetch_array($resu))
		{
			if($muestra['cantidad']>0)
			{
				
				return true;
			}
			else
			{
				
				return false;
			}
		}
	}
?>

