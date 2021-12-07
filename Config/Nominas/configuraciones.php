<?php
error_reporting(0);
function conectar(){
error_reporting(0);

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
	}
}function validarsesion(){
	/*$uu="Select * from usuarios";
	$us=mysql_query($uu);$uuus=mysql_fetch_array($uu);
		
	if(empty($_SESSION['niv']))
	{
		?>
		<script type="text/javascript">
			window.location="http:../login.php";
		</script>
        <?php
		
	}
	else if(isset($_SESSION['nombre'])==$uuus['nombre']&&isset($_SESSION['niv'])==$uuus['niv']) {
		print_r($_SESSION);echo "nivel ".$uuus['niv'];
	echo '<script language="javascript">href.location="index.php";</script>';
	}
	else{
	header("location:login.php");
	}
*/
}

function pie(){

echo '<br><br><br>
<div style="position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:17;font-family:Arial, Helvetica, sans-serif;" align="center">
<MARQUEE WIDTH=50% HEIGHT=30 align="top" bgcolor=""><b> Configuraciones Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones 
<div id="reloj" style="color: #FFF;
background: #900;
position:absolute;
 bottom:0;
 right:0;
height:39px; /*alto del div*/
Width:150px;
z-index:99999;
" >
<a style=" color: #fff;	text-decoration:none;" href="../calendario.php" target="_self">
<span id="liveclock" style="position:relative;left:0;top:0;"></span></a><script language="JavaScript" type="text/javascript">

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
	
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
//change font size here to your desire
myclock="<font size=5 ><b><font size=2>'.date("d-m-Y").'</font></br>"+hours+":"+minutes+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }
window.onload=show5
 
 </script>   
</div>
</div>';
}
function menunivel3()
{
	echo"<div id='header'  align='center'>";
echo"<ul class='nav'>
	   	<li><a href='../../index.php'>Inicio</a></li>
    	<li>
   	<a href=''>Meseros</a>
   		<ul>
   				<li><a>Plantilla de Meseros</a>
   					<ul>
   						<li><a href='Insert_Meseros.php'>Ver Plantilla</a></li>
   						<li><a href='InsertM.php'>Nuevo Registro</a></li>
   					</ul>
   				</li>
   				<li><a href='Lista_de_Semanas.php'>Confirmar Asistencia</a></li>   			
   		</ul>
   	</li>
   		
	</ul>
   		</div>";	
}
function menunomina()
{
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
echo"<ul class='nav'>
	   	<li><a href='../../index.php'>Inicio</a></li>
    	<li><a href=''>Meseros</a>
  			<ul>
     			<li><a href='ModificaMesero.php'>Mesero</a></li>
				<li><a href='Nomina_Acumulada.php'>Nomina Acumulada</a></li>
    		</ul> 		
   		</li>
   		<li><a href=''>Premio de Lealtad</a>
   			<ul>
     			<li><a href='Acumulado_Puntos.php'>Meseros</a></li>   				
   			</ul>
   		</li>
	</ul>
   		</div>
   		";
}
function menuconfiguracion()
{
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
    echo"<li><a href='../index.php'>Inicio</a></li>";
  echo" <li><a href=''>Contratos</a>";
     echo"<ul>";
       		echo"
	   			<li><a>Cancelaciones</a>
	   			<ul> 
					 <li><a href='CancelarContrato.php'>Contrato</a></li>
					
	   			</ul>
	  		    </li>";
				echo "<li><a href='DepositoInicial.php'>Deposito Inicial</a></li>";
				echo "<li><a href='#'>Clausulas</a>";
					echo "<ul>
					<li><a href='Clausulas.php'>Clausulas contratos</a></li>";
					echo "<li><a href='Clausulas2.php'>Clausulas Subcontratos</a></li></ul></li>";
				echo "<li><a href='convertir.php'>Convertir</a></li>";
	  
      
	   
     echo"</ul>";
	 		
   echo"</li>
		   
			<li><a href=''>Meseros</a>
			<ul>
			<li><a href=''>Plantilla de Meseros</a>
				<ul>
					<li><a href='Insert_Meseros.php'>Ver Plantilla</a></li>
					<li><a href='InsertM.php'>Nuevo Registro</a></li>
			
				</ul>
			</li>
			<li><a href=''>Asignar Eventos</a>
				<ul>					
					<li><a href='ReconfirmaM.php'>Proyecciones</a></li>
					<li><a href='Lista_de_Semanas.php'>Confirmar Asistencia</a></li>
				</ul>
				
			</li>
			<li>
				<a>Configuracion</a>
				<ul>
					<li><a href='prueba_arrastra.php'>Ordenamiento Meseros</a></li>
					<li><a href='Modificaciones_Generales.php?reinicia=reiniciar' 	  Title='Se Reiniciaran todos los atributos de los Meseros'>Reiniciar Meseros </a></li>					
				</ul>
			</li>
			
			
			
			</ul>
			</li>";
        
	echo" <li><a>Inventario y Servicios</a>
			<ul>
				<li><a href='Conf_Inventario.php'>Crear Nuevo tipo de Invnetario</a></li>
				<li><a href='Conf_Servicios.php'>Administrar Servicios</a></li>
				<li><a href='NuevoTipoMesero.php'>Nueva Categoria de Meseros</a></li>
				<li><a href='Gastos.php'>Gastos</a></li>
			</ul>
	</li>";  
	echo" <li><a href='compras.php'>Compras</a></li>";
	echo" <li><a href='Usuarios.php'>Usuarios</a></li>";
	echo" <li><a href='Nominas/Nominas.php'>Nominas</a></li>";
   echo"<li><a href='cerrar.php'>Cerrar sesion</a></li>";
   echo"</ul>";
   echo "</div>";
}

function BUSCARCONTRATO()
{$categoria = $_POST['categoria'];
	
	if($categoria=="Numero")
	{
		     	$campo = $_POST['campo'];
				$query="select * from contrato where Numero='".$campo."';";
	}
	if($categoria=="Todos")
	{
		$query="select * from contrato where facturado='si';";
	}

		
		$resultado=mysql_query($query);
		echo "<table   border=6 bordercolor='#990000' bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha de Evento</th>";
					echo "<th>Tipo</th>";
					echo "<th>Salon</th>";													
					echo "<th>Saldo Inicial</th>";
					echo "<th>Saldo Actual</th>";
					echo "<th>Estatus</th>";
					echo "<th>Eliminar</th>";
			echo "</tr>";
			echo "</head>";
			echo "<body>";
						
				while($muestra=mysql_fetch_array($resultado)) 
				{
					echo "<tr>";						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td align='center'>".$muestra['Fecha']."</td>";
						echo "<td align='center'>".$muestra['tipo']."</td>";
						echo "<td align='center'>".$muestra['salon']."</td>";
						echo "<td>".$muestra['si']."</td>";
						echo "<td>".$muestra['sa']."</td>";
						if($muestra['estatus']==0)
						{
							echo "<td align='center'>Pre-Contrato</td>";
						}
						if($muestra['estatus']==1)
						{
							echo "<td align='center'>Contrato</td>";
						}
						if($muestra['estatus']==2)
						{
							echo "<td align='center'>Contrato Finalizado</td>";
						}
						echo '<td><a href="EliminarContrato.php?numero='.$muestra['Numero'].'">Eliminar</a></td>';
					echo "</tr>";					
				}	
				
			echo "</body>";
		echo "</table>";
}

function cnf(){
echo "<br>CONTRATOS NO FACTURADOS<br>";
$query="select * from contrato where facturado='no';";
$resultado=mysql_query($query);
		echo "<table   border=6 bordercolor='#990000' bgcolor='#fff'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Numero</th>";
					echo "<th>Nombre</th>";
					echo "<th>Fecha de Evento</th>";
					echo "<th>Tipo</th>";
					echo "<th>Salon</th>";													
					echo "<th>Saldo Inicial</th>";
					echo "<th>Saldo Actual</th>";
					echo "<th>Estatus</th>";
					echo "<th>Eliminar</th>";
			echo "</tr>";
			echo "</head>";
			echo "<body>";
						
				while($muestra=mysql_fetch_array($resultado)) 
				{
					echo "<tr>";						
						echo "<td>".$muestra['Numero']."</td>";
						echo "<td>".$muestra['nombre']."</td>";
						echo "<td align='center'>".$muestra['Fecha']."</td>";
						echo "<td align='center'>".$muestra['tipo']."</td>";
						echo "<td align='center'>".$muestra['salon']."</td>";
						echo "<td>".$muestra['si']."</td>";
						echo "<td>".$muestra['sa']."</td>";
						if($muestra['estatus']==0)
						{
							echo "<td align='center'>Pre-Contrato</td>";
						}
						if($muestra['estatus']==1)
						{
							echo "<td align='center'>Contrato</td>";
						}
						if($muestra['estatus']==2)
						{
							echo "<td align='center'>Contrato Finalizado</td>";
						}
						echo '<td><a href="EliminarContrato.php?numero='.$muestra['Numero'].'">Eliminar</a></td>';
					echo "</tr>";					
				}	
				
			echo "</body>";
		echo "</table>";

}

function DepositoInicial()
{
	echo "alert('RECUERDE QUE AL MODIFICAR ESTE CAMPO, TODOS LOS CONTRATOS POSTERIORES A ESTA CONFIGURACION, SERAN AFECTADOS EN CUANTO AL DEPOSITO INICIAL POR CONTRATO, ES DECIR, EL CONTRATO NO PODRA SER IMPRESO HASTA CUBRIR CON ESTE MONTO MEDIANTE UN ABONO.');";
 echo"
 <b>Ingrese un Saldo Inicial</b>
		<table align='center' border='6px' bordercolor='#990000'>
		<tr>
		<td>
		SALDO<input type='text'/>
		</td>
		</tr>
		</table>
 ";	
}
	function ModificarDep()
{
	conectar();
	 $q="UPDATE Configuraciones SET valor=".$_POST['campo']." WHERE id=1";
			$consulta=mysql_query($q);
			mysql_fetch_array($consulta);
			
			echo "<script>alert('SE SE AH MODIFICADO SU VALOR EN EL DEPOSITO INICIAL,  POR TANTO SE MODIFICARAN LAS ALERTAS APARTIR DE ESTA MODIFICACION');</script>";
}


function cambioFecha($fecha){  

$tieneCeroDiaMes = substr($fecha,6,1); 

if ($tieneCeroDiaMes == 0) { 
    $diaMes = substr($fecha,7,1); 
} else { 
    $diaMes = substr($fecha,6,2); 

} 


$Mes = substr($fecha,4,2); 
$Mes = str_replace("01","ENERO",$Mes); 
$Mes = str_replace("02","FEBRERO",$Mes); 
$Mes = str_replace("03","MARZO",$Mes); 
$Mes = str_replace("04","ABRIL",$Mes); 
$Mes = str_replace("05","MAYO",$Mes); 
$Mes = str_replace("06","JUNIO",$Mes); 
$Mes = str_replace("07","JULIO",$Mes); 
$Mes = str_replace("08","AGOSTO",$Mes); 
$Mes = str_replace("09","SEPTIEMBRE",$Mes); 
$Mes = str_replace("10","OCTUBRE",$Mes); 
$Mes = str_replace("11","NOVIEMBRE",$Mes); 
$Mes = str_replace("12","DICIEMBRE",$Mes); 

$Anio = substr($fecha,0,4); 

return $diaMes." de ".$Mes." de ".$Anio.""; 
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
function OrdenaMeseros()
{
	$ORD="SELECT descripcion from Configuraciones Where nombre='ORDEN MESEROS'";
            	$ORDE=mysql_query($ORD);
            	$ORDEN=mysql_fetch_array($ORDE);

            	 $ffff=explode(",",$ORDEN['descripcion']);
			$sente;
            	 for ($i=0; $i <count($ffff); $i++) 
            	 { 
            	 	# code...
            	 	if(empty($sente)||$sente=="")
            	 	{
            	 		$sente="tipo='".$ffff[$i]."'";
            	 	}
            	 	else
            	 	{
            	  		$sente= $sente.",tipo='".$ffff[$i]."'";
            	  	}
            	 }

            	return $sente;

}
function Dias_entre_Fechas($fecha1, $fecha2) {
// fechas en formato AAAA/MM/DD
//defino fecha 1
$f1 = explode("-",$fecha1);
$ano1 = $f1[0];
$mes1 = $f1[1];
$dia1 = $f1[2];

//defino fecha 2
$f2 = explode("-",$fecha2);
$ano2 = $f2[0];
$mes2 = $f2[1];
$dia2 = $f2[2];

//calculo timestam de las dos fechas
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);

//resto a una fecha la otra
$segundos_diferencia = $timestamp1 - $timestamp2;
//echo $segundos_diferencia;

//convierto segundos en días
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

//obtengo el valor absoulto de los días (quito el posible signo negativo)
//$dias_diferencia = abs($dias_diferencia);

//quito los decimales a los días de diferencia
$dias_diferencia = floor($dias_diferencia);

return $dias_diferencia;
}

?>