<?php
function conectar(){
	$con = mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
	if(!$con){
	die('no hay conexion al servidor');
}
	$base = mysql_select_db('mbrsoluc_villaconin');
	if(!$base){
		die('no se pudo conectar a la bd');
	}
	else{
	 //echo "conexion exitosa";
	}
}function validarsesion(){
		session_start();
	if(isset($_SESSION['nombre'])) {
	echo '<script language="javascript">href.location="index.php";</script>';
	}else{
	header("location:login.php");
	}

}

function menunivel0(){
conectar();
$querry="select count(*) as 'c' from contrato where alerta=1 and estatus=1 and impreso='si'";
$rresult=mysql_query($querry);
$muestrra=mysql_fetch_array($rresult);

echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo"<title>Villa Conin</title>";
echo"<style>
.burbuja {
					width: 23px;
					height: 15px;
					background: none repeat scroll 0 0 #E02424;
					border-radius: 3px 3px 3px 3px;
					color: #FFFFFF;
					font: bold 0.6em Tahoma,Arial,Helvetica;
					
					position: absolute;
					right: 2px; top: 2px;
				}	
				.x{
				position:relative; 
				}

</style>";
echo"<body>";
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       echo"<li><a href='NuevoContrato.php'>Nuevo Pre-Contrato</a></li>";
       echo"<li><a href=''>Movimientos</a>";
		   echo"<ul>";
		     	 echo"<li><a href='Cargos.php'>Cargos</a>";
				echo"<li><a href='Abonos-cliente.php'>Abonos</a></li>";
				echo"<li><a href='CancelarCargo.php'>Cancelar Cargos</a></li>";
				echo"<li><a href='CancelarAbono.php'>Cancelar Abonos</a></li>";
				echo"<li><a href='HacerDevolucion.php'>Realizar Devolucion</a></li>";
				 
		   echo"</ul>";      
		   echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
		    echo"<ul>";
		     	 echo"<li><a href='BuscarPreContrato.php'>PRE-CONTRATO</a></li>";
   		    echo"</ul>";     
	   echo"</li>";
     echo"</ul>";
   echo"</li>";
        
   echo"<li><a href=''>Clientes</a>";
       echo"<ul>";
    		   echo"<li><a href='Cliente-nuevo.php'>Nuevo Cliente</a></li>";
   			    echo"<li><a href='Preregistro.php'>Pre-Registro</a>
				<ul>
				  <li><a href='BucarPreCliente.php'>Ver Pre-Clientes</a>
				</li>
				</ul>";
			    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
      echo"</ul>";
    echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
          
           echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
           
		   echo"<li><a href='reporcontraven.php'>Contratos por vendedor</a></li>";
		   echo"<li><a href='reporcontrafecha.php'>Contratos por fecha de evento</a></li>";
				
		   

           echo"<li><a href=''>Ver Contrato</a></li>";
       echo"</ul>";
echo'<li class="x"><a href="alertas.php">Alertas &nbsp&nbsp&nbsp';
if($muestrra['c']>0){
echo'<div class="burbuja">'.$muestrra['c'].'</div>';
}
echo '</a></li>';
   echo"<li><a>Inventario</a>
   <ul>
     <li><a href='Inventario.php'>Vinos</a></li>
	      <li><a href='verInventario.php'>Ver Inventario</a></li>
   </ul>
   </li>";
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
   echo "</div>";
}


function menunivel1(){

echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo"<title>Villa Conin</title>";
echo"<body>";
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       echo"<li><a href='NuevoContrato.php'>Nuevo Pre-Contrato</a></li>";
       echo"<li><a href=''>Movimientos</a>";
		   echo"<ul>";
		     	 echo"<li><a href='Cargos.php'>Cargos</a>";
				echo"<li><a href='Abonos-cliente.php'>Abonos</a></li>";
				echo"<li><a href='CancelarCargo.php'>Cancelar Cargos</a></li>";
				echo"<li><a href='CancelarAbono.php'>Cancelar Abonos</a></li>";
				echo"<li><a href='HacerDevolucion.php'>Realizar Devolucion</a></li>";
				 
		   echo"</ul>";      
		   echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
		    echo"<ul>";
		     	 echo"<li><a href='BuscarPreContrato.php'>PRE-CONTRATO</a></li>";
   		    echo"</ul>";     
	   echo"</li>";
     echo"</ul>";
   echo"</li>";
        
   echo"<li><a href=''>Clientes</a>";
       echo"<ul>";
       echo"<li><a href='Cliente-nuevo.php'>Nuevo Cliente</a></li>";
       echo"<li><a href='Preregistro.php'>Pre-Registro</a>
	   <ul>
		  <li><a href='BucarPreCliente.php'>Ver Pre-Clientes</a></li>
		</ul>
	   </li>";
	    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
		
      echo"</ul>";
   echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
          
           echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
           
		   echo"<li><a href='reporcontraven.php'>Contratos por vendedor</a></li>";
		   echo"<li><a href='reporcontrafecha.php'>Contratos por fecha de evento</a></li>";
				
		   

           echo"<li><a href=''>Ver Contrato</a></li>";
       echo"</ul>";
   echo"<li><a href='alertas.php'>Alertas</a></li>";
   echo"<li><a>Inventario</a>
   <ul>
     <li><a href='Inventario.php'>Vinos</a></li>
	      <li><a href='verInventario.php'>Ver Inventario</a></li>
   </ul>
   </li>";
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
  echo"</div>";
	
}

function menunivel2(){
echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo"<title>Villa Conin</title>";
echo"<body>";
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       
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
       	    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
      echo"</ul>";
   echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
  
		   echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
		   echo"<li><a href=''>Ver Contrato</a></li>";
       echo"</ul>";
   echo"</li>";
     echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
  echo"</div>";
	
}
function menunivel3(){
echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo"<title>Villa Conin</title>";
echo"<body>";
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
  echo" <li><a href=''>Contratos</a>";
      echo"<ul>";
       echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
	   echo"</li>";
     echo"</ul>";
   echo"</li>";
        
   echo"<li><a href=''>Clientes</a>";
       echo"<ul>";
      	    echo"<li><a href='BuscarCliente.php'>Buscar Cliente</a></li>";
      echo"</ul>";
   echo"</li>";
          
   
   echo"<li><a href=''>Reportes</a>";
       echo"<ul>";
         
		   echo"<li><a href='EstadoDeCuenta.php'>Edo de Cuenta</a></li>";
           echo"<li><a href=''>Ver Contrato</a></li>";
       echo"</ul>";
   echo"</li>";
 
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
  echo"</div>";
	
}

function menunivel4()
{
echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo"<title>Villa Conin</title>";
echo"<body>";
 
  echo"<div id='header'  align='center'>";
   echo"<ul class='nav'>";
    echo"<li><a href='index.php'>Inicio</a></li>";
   
    echo" <li><a href=''>Contratos</a>";
      echo"<ul>";
       echo"<li><a href='BuscarContrato.php'>Buscar Contrato</a>";
	   echo"<li><a href='NuevoContrato.php'>Nuevo Contrato</a></li>";
	   echo"<li><a href='Cargos.php'>Generar Cargo</a>";
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

///////////////////////////////////buscarcontrato//////////////////////////////////
function busqueda () {
	$categoria = $_POST['campo'];
     	if($categoria==null)
		{
    		$query="select * from contrato where estatus= 1";
		}
		else{
		
		$query="select * from contrato where Numero='".$categoria."' or Fecha='".$categoria."';";
		}
		$resultado=mysql_query($query);
		echo "<br/>";
		echo "<table   border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha contrato</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Tipo</th>";	
					echo "<th>Salon</th>";								
					echo "<th>Estatus del Evento</th>";
					echo "<th>Generar hoja Anexa</th>";
					echo "<th>Generar logistica del Evento</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
						
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['fechacontrato']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['salon']."</td>";		
						if($muestra['impreso']=='si'){
						echo '<td><b><center>Contrato ya impreso</center></b></td>';
						}
						else{
						echo '<td><a href="MSaldo.php?numero='.$muestra['Numero'].'">Modificar</a></td>';
						}
						echo '<td><a href="LogisticaEvento.php?numero='.$muestra['Numero'].'">Generar Hoja Anexa</a></td>';
						
						echo '<td align="center"><a href="NuevaLogistica.php?numero='.$muestra['Numero'].'">Realizar Logistica</a></td>';
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";
	
}
//   Cargos
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
       echo"<form name='ncon' action='altacargo.php' method='post' >";
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
			    <p><input type='submit' name='enviar' onclick='document.ncon.enviar.enable=!document.ncon.enviar.disable'/></p>  </td>";
				

	   echo"</form>";

          echo"</tr>       ";
    echo"</tr>";
     echo"</table>";
  echo"</div>";
  
	}
	
	// Abonos
	
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
echo"<form id='form1' name='form1' method='post' action='FormularioPDF/php/CargaAbono.php'>";
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
			 echo"<option value='Pago con Tarjeta'>Pago con Tarjeta</option>";
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
   
	  echo "<tr><td></td><td><a href='index.php'><input type='submit' value='Enviar'></a></td></tr>";
	 
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
	
	// Nuevo Contrato
	
	function busquedacliente () {
     	$campo = $_POST['campo'];
		
		$query="select * from cliente where ap='$campo' or rfc='$campo';";

		$resultado=mysql_query($query);
		echo "<table border=6 bordercolor='#990000' bgcolor='#FFF' align='center'>";
			echo "<thead align='center'>";
				echo "<tr align='center'>";
					echo "<th>Nombre</th>";
					echo "<th>A. paterno</th>";
					echo "<th>A. materno</th>";
					echo "<th>mail</th>";					
					echo "<th>RFC</th>";	
					echo "<th>Regimen</th>";
					echo "<th>D. comercial</th>";									
					echo "<th>Domicilio</th>";									
					echo "<th>C.P</th>";														
					echo "<th align='center'>Telefono</th>";
					echo "<th width='220px'>Pre-Contrato</th>";																		
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			if($resultado) {			
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr align='center'>";
						
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
						echo '<td><a href="Contrato.php?idcliente='.$muestra['id'].'"><h5>REALIZAR PRE-CONTRATO</h5></a></td>';
																		
					echo "</tr>";
				}
			}
			else {
				echo "error ".mysql_error();
			}
			echo "</tbody>";
		echo "</table>";
	}
	
	
	// Nombre de Contrato
	
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
		else if($v=="Eduardo"){
		$nombre=$nombre . "E";
		}
		
	return $nombre;
	
	}
	
	// Validacion de Contrato
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
	
	

function busquedaclienteXX () {
     	$campo = $_POST['campo'];
		
		$query="select * from cliente where ap='".$campo."' or rfc='".$campo."' or nombre='".$campo."';";

		$resultado=mysql_query($query);
		echo "<br/>";
		echo "<table  border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Nombre</th>";
					echo "<th>A. paterno</th>";
					echo "<th>A. materno</th>";
					echo "<th '>mail</th>";					
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
			echo "</tbody>";
		echo "</table>";
	}

function EstadoCuenta()
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
						$fechaevento=$muestra['Fecha'];
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
	///////////////////////////////////buscarcontrato LECTURA//////////////////////////////////
function busquedalectura () {
		$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
		
		$query="select * from contrato where Numero='".$campo."' or Fecha='".$campo."';";

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
						
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['fechacontrato']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['mail']."</td>";
						echo "<td>".$muestra['rfc']."</td>";						
						echo "<td>".$muestra['domicilio']."</td>";
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";
	}

	//  CANCELACION DE CARGO
	
	function busquedaCargo () {
		$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
		
		$query="select * from cargo where numcontrato='".$campo."';";

		$resultado=mysql_query($query);
		echo "<table width=400px  border=1 bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Folio</th>";
					echo "<th>Numero</th>";
					echo "<th>Cantidad</th>";
					echo "<th>Concepto</th>";
					echo "<th>Fecha</th>";													
					echo "<th>Eliminar</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			
			$id=$muestra['id']."</td>";
			$numero=$muestra['numcontrato']."</td>";
			$Total=$muestra['cantidad']."</td>";
			$concepto=$muestra['concepto']."</td>";
						
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";						
						echo "<td>".$muestra['id']."</td>";
						echo "<td>".$muestra['numcontrato']."</td>";
						echo "<td>".$muestra['cantidad']."</td>";
						echo "<td>".$muestra['concepto']."</td>";
						echo "<td>".$muestra['fecha']."</td>";
						echo '<td><a href="BajaCargo.php?numero='.$muestra['id'].'">Cancelar Cargo</a></td>';
					echo "</tr>";
				}			
			echo "</tbody>";
		echo "</table>";
	}
	
	// Cancelar Abonos
	
	function busquedaAbono () {
		$categoria = $_POST['categoria'];
     	$campo = $_POST['campo'];
		
		$query="select * from abono where numcontrato='".$campo."';";

		$resultado=mysql_query($query);
		echo "<table width=400px  border=1 bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Nombre de Contrato</th>";
					echo "<th>Numero de Contrato</th>";
					echo "<th>Cantidad</th>";
					echo "<th>Concepto</th>";
					echo "<th>Fecha de Pago</th>";
					echo "<th>Folio</th>";													
					echo "<th>Cancelar Abono</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			
			$id=$muestra['id']."</td>";
			$numero=$muestra['numcontrato']."</td>";
			$Total=$muestra['cantidad']."</td>";
			$concepto=$muestra['concepto']."</td>";

						
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";						
						echo"<td>".$muestra['nomcontrato']."</td>";
						echo "<td>".$muestra['numcontrato']."</td>";
						echo "<td>".$muestra['cantidad']."</td>";
						echo "<td>".$muestra['concepto']."</td>";
						echo "<td>".$muestra['fechapago']."</td>";
						echo "<td>".$muestra['id']."</td>";
						echo '<td><a href="BajaAbono.php?numero='.$muestra['id'].'">Cancelar Abono</a></td>';
					echo "</tr>";
				}			
			echo "</tbody>";
		echo "</table>";
	}

	function reporconv()
	{
		$categoria = $_POST['categoria'];
     	
		
		$query="select * from contrato where vendedor='".$categoria."'";
        echo "$categoria";
		$resultado=mysql_query($query);
		echo "<table width=1200px  border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Tipo de evento</th>";	
					echo "<th>Salon</th>";
					echo "<th>Saldo inicial</th>";
					echo "<th>Saldo actual</th>";
					echo "<th>registro</th>";									
					echo "<th>Fecha de registro</th>";	
					echo "<th>Costo del Evento</th>";									
				
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
						
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['salon']."</td>";
						echo "<td>".$muestra['si']."</td>";						
						echo "<td>".$muestra['sa']."</td>";
						echo "<td>".$muestra['registro']."</td>";
						echo "<td>".$muestra['fdr']."</td>";
						echo "<td align='center'>"."$ ".money_format('%.2n',$muestra['costoevento'])."</td>";
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";



	}


function reporconf()
	{
		echo "<br/>";
		echo "DEL ".$i = $_POST['inicio']."   AL  ".$f = $_POST['fin'];

		
		$query="select * from contrato where Fecha >=  '".$i."'  AND  Fecha <= '".$f."' ORDER BY Fecha ASC";
		$resultado=mysql_query($query);
		
		echo "<table width=1200px  border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Tipo de evento</th>";	
					echo "<th>Salon</th>";
					echo "<th>Saldo inicial</th>";
					echo "<th>Saldo actual</th>";
					echo "<th>registro</th>";									
					echo "<th>Fecha de registro</th>";
					echo "<th>Costo del Evento</th>";										
				
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
						
				while($muestra=mysql_fetch_array($resultado)) {					
					echo "<tr>";						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['salon']."</td>";
						echo "<td>".$muestra['si']."</td>";						
						echo "<td>".$muestra['sa']."</td>";
						echo "<td>".$muestra['registro']."</td>";
						echo "<td>".$muestra['fdr']."</td>";
						echo "<td align='center'>".$muestra['costoevento']."</td>";
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";



	}



	// Devoluciones 
function Devoluciones()
	{
		$categoria = $_POST['campo'];
     	if($categoria==null)
		{
    		$query="select * from contrato where estatus=1";
		}
		else{
		
		$query="select * from contrato where Numero='".$categoria."' or fechacontrato='".$categoria."' and estatus=1;";
		}
        echo "$categoria";
		$resultado=mysql_query($query);
		echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";
		echo "<table width=1200px  border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr align='center'>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Tipo de evento</th>";	
					echo "<th>Deposito</th>";
					echo "<th>Salon</th>";
					echo "<th>Realizar Devolucion</th>";																		
				
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
									
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr align='center'>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['deposito']."</td>";
						echo "<td>".$muestra['salon']."</td>";
						echo '<td><a href="DEV.php?numero='.$muestra['Numero'].'">Realizar Devolucion</a></td>';
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";


		
	}
	function BUSCARPRECONTRATO()
	{
		$categoria = $_POST['campo'];
     	if($categoria==null)
		{
    		$query="select * from contrato where estatus=0 and imphojaanexa='no' or imphojaanexa=' '";
		}
		else{
		
		$query="select * from contrato where Numero='".$categoria."' or Fecha='".$categoria."' and estatus=0 and imphojaanexa='no' or imphojaanexa=' ';";
		}
        echo "$categoria";
		$resultado=mysql_query($query);
		echo"<br/>";
		echo "<table width=1200px  border=6 bgcolor='#fff' bordercolor='#990000'> ";
			echo "<thead>";
				echo "<tr align='center'>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha evento</th>";					
					echo "<th>Tipo de evento</th>";	
					echo "<th>Deposito</th>";
					echo "<th>Salon</th>";
					echo "<th>Modificar</th>";																		
				
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
									
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr align='center'>";
						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['Fecha']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['deposito']."</td>";
						echo "<td>".$muestra['salon']."</td>";
						echo '<td><a href="MSaldo.php?numero='.$muestra['Numero'].'">Modificar</a></td>';
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";


		
	}
	
	function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }
 
    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }
 
            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                             
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                             
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                             
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO
 
        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}
 
// END FUNCTION
 
function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

function numero_de_meses($hoy,$fecha_evento)
{
$meses=0;
while($hoy<=$fecha_evento)
{
$meses++;
$hoy=date("Y-m-d", strtotime("$hoy +1 month"));
}
if($meses==0){
$meses=1;
}
if($meses<0){
$meses=$meses*(-1);
}
return $meses;
}


function cambioFecha($fecha){  

$tieneCeroDiaMes = substr($fecha,6,1); 

if ($tieneCeroDiaMes == 0) { 
    $diaMes = substr($fecha,7,1); 
} else { 
    $diaMes = substr($fecha,6,2); 

} 


$Mes = substr($fecha,4,2); 
$Mes = str_replace("01","Enero",$Mes); 
$Mes = str_replace("02","Febrero",$Mes); 
$Mes = str_replace("03","Marzo",$Mes); 
$Mes = str_replace("04","Abril",$Mes); 
$Mes = str_replace("05","Mayo",$Mes); 
$Mes = str_replace("06","Junio",$Mes); 
$Mes = str_replace("07","Julio",$Mes); 
$Mes = str_replace("08","Agosto",$Mes); 
$Mes = str_replace("09","Septiembre",$Mes); 
$Mes = str_replace("10","Octubre",$Mes); 
$Mes = str_replace("11","Noviembre",$Mes); 
$Mes = str_replace("12","Diciembre",$Mes); 

$Anio = substr($fecha,0,4); 

return $diaMes." de ".$Mes." de ".$Anio.""; 
}

	
// BBUSCAR PRE REGISTRO
function BUSCARPREREGISTRO()
	{
		$categoria = $_POST['campo'];
     	if($categoria==null)
		{
    		$query="select * from preregistro";
		}
		else{
		
		$query="select * from preregistro where nombre='".$categoria."' or ap='".$categoria."' or tipo='".$categoria."';";
		}	
		$resultado=mysql_query($query);
		echo "<br/>";echo "<br/>";echo "<br/>";
		echo "<table   border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr align='center'>";
					
					echo "<th>Nombre</th>";
					echo "<th>A. Paterno</th>";
					echo "<th>A. Materno</th>";					
					echo "<th>Telefono</th>";	
					echo "<th>Correo</th>";
					echo "<th>Medio</th>";
					echo "<th>Pasar a Cliente</th>";																		
					echo "<th>Eliminar</th>";																	
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
									
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr align='center'>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td>".$muestra['ap']."</td>";
						echo "<td>".$muestra['am']."</td>";
						echo "<td>".$muestra['telefono']."</td>";
						echo "<td>".$muestra['mail']."</td>";
						echo "<td>".$muestra['medio']."</td>";
						echo '<td><a href="Cliente-nuevo.php?numero='.$muestra['id'].'">Generar nuevo Cliente</a></td>';
						echo '<td><a href="?numero='.$muestra['Numero'].'">Eliminar</a></td>';
					
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";


		
	}
	
	
	///  INVENTARIOS
	
	function inventaario()
	{
		echo $categoria = $_POST['categoria'];
     	if($categoria=="")
		{
    		$query="select * from TInventarios";
		}
		else{
		
		$query="select * from TInventarios;";
		}	
		$resultado=mysql_query($query);
		echo "<br/>";echo "<br/>";echo "<br/>";
		echo "<table   border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr align='center'>";
					
					echo "<th>PRODUCTO</th>";
					echo "<th>DESCRIPCION</th>";
					echo "<th>CANTIDAD</th>";					
					echo "<th>PRECIO</th>";	
					echo "<th>COSTO</th>";																			
					echo "<th>VENDER</th>";																	
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			$registros=0;	
			echo '<form action="update_vinos.php" method="POST">';
				while($muestra=mysql_fetch_array($resultado)) {
						$registros=$registros+1;;
						echo "<tr align='center'>";
						echo "<td>".$muestra['producto']."</td>";
						echo "<td>".$muestra['descripcion']."</td>";
						echo "<td><input type='number' name='".$muestra['id']."' min='".$muestra['cantidad']."' placeholder='".$muestra['cantidad']."'></td>";
						echo "<td>"."$ ".money_format('%.2n',$muestra['precio'])."</td>";
						echo "<td>$".$muestra['costo']."</td>";
					echo '<td><input type="checkbox" id="'.$muestra['id'].'"></td>';
					echo "</tr>";
				}
				echo "<input type='submit' value='Actualizar Existencias' name='actualizar' class='button'></form>";
				echo '<button onclick="vender()" class="button">Vender</button>';
				
				echo '<form action="g_vinos.php" method="POST">';
				if($registros<=70 && $categoria=='VINOS'){
					for($i=$registros+1;$i<=70;$i++){
							echo '<tr><td><input type="text" name="'.$i.'p"></td><td><input type="text" name="'.$i.'d"></td><td><input type="text" name="'.$i.'c"></td>
							<td><input type="text" name="'.$i.'pr"></td><td><input type="text" name="'.$i.'costo"></td><td></td></tr>';
					}
					}
				echo "<input type='submit' value='Actualizar lista' name='actualizar' class='button'></form>";
			echo "</tbody>";
		echo "</table>";

	}
	function modificarinventario()
	{
		echo "modificaste inventario";
	}
	
function verinventario()
{
	$categoria = $_POST['campo'];
     	if($categoria==null)
		{
    		$query="select * from TManteleria";
		}
		else{
		
		$query="select * from TManteleria where tipo='".$categoria."';";
		}	
		$resultado=mysql_query($query);
		echo "<br/>";echo "<br/>";echo "<br/>";
		echo "<table   border=6 bgcolor='#fff' bordercolor='#990000'>";
			echo "<thead>";
				echo "<tr align='center'>";
					echo "<th>ID</th>";
					echo "<th>Nomenclatura</th>";
					echo "<th>Descripcion</th>";
					echo "<th>Tipo</th>";					
					echo "<th>Buen Estado</th>";	
					echo "<th>Mal Estado</th>";
					echo "<th>Total</th>";
					echo "<th>Comentarios</th>";																		
					echo "<th>Modificar</th>";																	
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
									
				while($muestra=mysql_fetch_array($resultado)) {
					echo "<tr align='center'>";
					echo "<td>".$muestra['id']."</td>";
						echo "<td>".$muestra['producto']."</td>";
						echo "<td>".$muestra['descripcion']."</td>";
						echo "<td>".$muestra['tipo']."</td>";
						echo "<td>".$muestra['buenestado']."</td>";
						echo "<td>".$muestra['malestado']."</td>";
						echo "<td>".$muestra['total']."</td>";
						echo "<td>".$muestra['comentarios']."</td>";
						echo '<td><a href=modificai.php?numero='.$muestra['id'].'>Modificar</a></td>';
					
					echo "</tr>";
				}
			
			echo "</tbody>";
		echo "</table>";


}	


////////VER ALERTAS
function veralerta () {
     			
		echo "<table width=1000px  border=1 bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>fecha de ultimo pago</th>";
					echo "<th>fecha de pago vencido</th>";
					echo "<th>monto de ultimo pago</th>";
					echo "<th>mensualidad</th>";
																					
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			$h="select * from contrato where alerta=1 and impreso='si' estatus=1";
			$h2=mysql_query($h);
			while($h3=mysql_fetch_array($h2)){
				$j="select MAX(fechapago) as fecha from abono where numcontrato='".$h3['Numero']."'";
				$j2=mysql_query($j);
				$j3=mysql_fetch_array($j2);
				$k="select cantidad from abono where numcontrato='".$h3['Numero']."' and fechapago='".$j3['fecha']."'";
				$k2=mysql_query($k);
				$k3=mysql_fetch_array($k2);
			echo '<tr><td>'.$h3['Numero'].'</td><td>'.$h3['nombre'].'</td><td>'.$j3['fecha'].'</td><td>'.$h3['proximo_abono'].'</td><td>'.$k3['cantidad'].'</td><td>'.$h3['mensualidad'].'</td></tr>';
			}
			
			
			
			echo "</tbody>";
		echo "</table>";
	}	
	
//////////////   Alertas funcion que modifica la bandera
	function mod_alertas(){
	
			conectar();
			$x="select * from contrato where estatus=1 and impreso='si'";
			$x2=mysql_query($x);
			$hoy=date('Y-m-d');
			while($x3=mysql_fetch_array($x2)){
				$fecha=$x3['proximo_abono'];
				$fe=$x3['Fecha'];
				$nuevafecha = strtotime ( '-15 day' , strtotime ( $fe ));
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				
				if($fecha<$hoy || $nuevafecha<$hoy){
					$d="UPDATE contrato set alerta=1 where Numero='".$x3['Numero']."'";
					$rr=mysql_query($d);
				}else{
					$d="UPDATE contrato set alerta=0 where Numero='".$x3['Numero']."'";
					$rr=mysql_query($d);
				}

			}
	
	
	
	
	
	
	
	}
	
	?>
