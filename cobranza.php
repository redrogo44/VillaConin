<?php
require 'funciones2.php';
conectar();
//validarsesion();
$contratos_cobranza;
date_default_timezone_set('America/Mexico_City');
$nivel=$_SESSION['niv'];
if($nivel==0){
	menunivel0();				
}else if($nivel==1){
	menunivel1();				
}else if($nivel==3){
	menunivel3();
}else{
	exit();
}
?>
 
<title>Villa Conin</title>
<head> 
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="js/detalle.js"></script>
<script type="text/javascript" src="js/correo.js"></script>
<script type="text/javascript" src="js/comment.js"></script>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
 <script>
 function urgente(contrato){
	 if(confirm("Esta seguro de cambiar el estado del contrato "+contrato+"?")){
		 if(document.getElementById(contrato).checked){
			actualiza_estado("activar",contrato);
			document.getElementById("r-"+contrato).style.background='red';
		 }else{
			actualiza_estado("desactivar",contrato);
			  document.getElementById("r-"+contrato).style.background='white';
		 }
	 }else{
		 if(document.getElementById(contrato).checked){
			document.getElementById(contrato).checked=false;
		 }else{
			document.getElementById(contrato).checked=true;
		 }
	 }
 }
 
function actualiza_estado(opcion,contrato)
{
	var xmlhttp;

	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//document.getElementById("xyz").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("POST","actualiza_estado.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("opcion="+opcion+"&contrato="+contrato);
}
 </script>
 
</head> 

 <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  height:auto;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				#btn {
  background: #d93434;
  background-image: -webkit-linear-gradient(top, #d93434, #47000c);
  background-image: -moz-linear-gradient(top, #d93434, #47000c);
  background-image: -ms-linear-gradient(top, #d93434, #47000c);
  background-image: -o-linear-gradient(top, #d93434, #47000c);
  background-image: linear-gradient(to bottom, #d93434, #47000c);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

#btn:hover {
  background: #f59d9d;
  background-image: -webkit-linear-gradient(top, #f59d9d, #c77777);
  background-image: -moz-linear-gradient(top, #f59d9d, #c77777);
  background-image: -ms-linear-gradient(top, #f59d9d, #c77777);
  background-image: -o-linear-gradient(top, #f59d9d, #c77777);
  background-image: linear-gradient(to bottom, #f59d9d, #c77777);
  text-decoration: none;
}

table {
    border: 0;
    padding: 0;
    margin: 0 0 20px 0;
    border-collapse: collapse;
}
th {
    background-color:#074E95;
	color:#fff;
}


   </style>
	
</body>
<!-- CUERPO DEL WEB-->


<body  style="background-repeat:no-repeat"  bgcolor="#fff">
<img src="../Imagenes/Villa Conin.png" height='150px' width='150px' style='position:absolute;top:0px;left:0px;'>
<center><br><br><br><br><br><br>
<table><tr><!--codigo de colores-->
<td style='color:#000000;background-color:red;'>___</td><td>Contrato Urgente</td>
<td style='color:#000000;background-color:lightgreen;'>___</td><td>Cubierto Totalmente</td>
<td style='color:#000000;background-color:yellow;'>___</td><td>Cubierto Parcialmente</td>
<td style='color:#000000;background-color:orange;'>___</td><td>Subcontrato</td>
<td>___</td><td>Sin abonos</td>
</tr></table>

</center>
<br><br><br>
<!-- div que contien el panel de descripcion de contrato-->

<table><tr><td>
<div style="position:absolute;">
			<table id="table99" class="style1" style="max-width:800px;">
				<thead>
				<tr>
				<th>Numero</th>
				<th>Tipo de evento</th>
				<th>Fecha del<br> ultimo abono</th>
				<th>Atraso</th>
				<th>Total de abonos</th>
				<th>Total del Evento</th>
				<th>Com<br>ens<br>ales</th>
				<th>$$.</th>
				<th>Adeudo<br>Total</th>
				<th>Comentario</th>
				<th>Detalle</th>
				</tr>
				</thead>
				<tbody>
					<?php prox_abono_con();prox_abono_sub(); descripcion_contrato(); ?>
				</tbody>
			</table>
		</div>
</td><td align="left" valign="top" padding='10px'>
<div class="style1"class="style1" style=' width: 400px;position:absolute;left:1090px;'>
		<?php 
		$next=lista_pagos();
		lista_pagos2($next);
	?>
</div>

</td>
<td align="left" valign="top">
<div style="position:absolute;left:1500px;">
	<?php
	if($_SESSION['niv']==0 ||$_SESSION['niv']==1 ){
	?>
		<div class="style1" style=" width: 400px;">
		<table><tr>
		<td>Total de abonos</td><td>Restante</td></tr>
		<tr><td><?php $ttt=total_ab(); echo $ttt;  ?></td><td><?php echo restante($ttt); ?></td>
		</tr></table>
		<!-- Cantidad de Contratos-->
		<br><br>
		<table>
		<tr><td>Tipo de contratos a realizar</td><td>Cantidad</td></tr>
		<tr><td>Precontratos</td><td><?php echo c_precontratos();?></td></tr>
		<tr><td>Contratos Globales</td><td><?php echo c_globales();?></td></tr>
		<tr><td>Contratos Normales</td><td><?php echo c_normales();?></td></tr>
		<tr><td>Eventos adicionales</td><td><?php echo eventos_adicionales();?></td></tr>
		<tr><td>Eventos recaudacion</td><td><?php echo eventos_recaudacion();?></td></tr>
		</table>

		<!-- Cantidad de Comensales-->
		<br><br>
		<table>
		<tr><td>Tipo de comensales por recibir</td><td>Cantidad</td></tr>
		<tr><td>Adultos</td><td><?php echo adultos_cobranza();?></td></tr>
		<tr><td>Jovenes</td><td><?php echo jovenes_cobranza();?></td></tr>
		<tr><td>Niños</td><td><?php echo ninos_cobranza();?></td></tr>
		</table>
		</div>
	<?php 	
	}
	?>
	</div>
</td>
</tr></table>
<br><br>
</center>

<div class="overlay-container">
		<div class="window-container zoomin">
			<h3>Detalle de cuenta</h3> 
			<strong>
			informacion con opcion de envio de correo
			<div id="2">
			</div>
			</strong>
			<br>
			<span class="close" align='center'>Cerrar</span>
		</div>
		</div>
<script>
function cerrar_ventana(){
	alert('Mensaje enviado correctamente');
}
</script>
</body>
<script>!window.jQuery && document.write(unescape('%3Cscript src="Config/pop/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="Config/pop/demo.js"></script>
	<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.stickytableheaders.min.js"></script>
	<script>
		$("#table99").stickyTableHeaders();
	</script>
</html>

<?php
function descripcion_contrato(){
	global $contratos_cobranza;
	$indice=0;
	//$q="select * from contrato where fechas is not NULL and Fecha>'2014-10-27' order by Fecha";
	$q="select * from contrato where Fecha>'2017-12-01' order by Fecha";
	$r=mysql_query($q);
	
	while($m=mysql_fetch_array($r)){
		
		//////coloreamos el contrato si es que esta en urgente
		if($m['urgente']==1){
			echo "<tr  id='r-".$m['Numero']."' style='color:#000000;background-color:red;'>";
		}else{
			echo "<tr id='r-".$m['Numero']."'>";
		}
		
		
		
		////////////subcontratos
		if($m['fechas']=='' && $m['nombre']!='PUBLICO EN GENERAL'){////////quitamos de la lista a contrato mostrador y contratos que no tengan fechas
			$arre=explode('-',$m['Numero']);
			if(count($arre)>1){//////////////////quitamos a los contratos generales
				$abono=round(total_abonos($m['Numero'],$m['facturado']),2);
				//echo "<br>Abono: ".$abono." - ".$m['Numero'];

				$s='select * from subcontratos where numero="'.$m['Numero'].'"';
				$s2=mysql_query($s);
				$s3=mysql_fetch_array($s2);
				$f=explode('%',$s3['fechas']);
				$comentario='this.value,"'.$s3['numero'].'"';
				$ultimo_abono=ultimo_abono($m['Numero'],$m['facturado']);
				$c1=0;$c2=0;
				////////////verificamos las fechas que han pasado segun el ultimo abono y el dia actual
				for($i=0;$i<count($f);$i++){
					if($f[$i]<=$ultimo_abono){
						$c1++;
					}
				}
				for($i2=0;$i2<count($f);$i2++){
					if($f[$i2]<=date('Y-m-d')){
						$c2++;
					}
				}
				//echo "<br>C1:  ".$c1." - C2: ".$c2." Contrato ".$m['Numero'];
				//////////calculamos si el ultimo abono supera una fecha de atraso
				if($c2-$c1>1){
				$contratos_cobranza[$indice]=$m['Numero'];
				$indice++;
				$fal=saldoi($m['Numero'])-$abono;
					if($fal > 0){ // SI EL TOTAL DE ADEUDO ES MAYOR A CERO, APARECERA DENTRO DE COBRANZA DE LO CONTRARIO NO
						echo "<td style='color:#000000;background-color:orange;'>".$m['Numero']."</td><td style='color:#000000;background-color:orange;'>".$m['tipo']."</td>";
						echo "<td style='color:#000000;background-color:orange;'>".$ultimo_abono."</td><td style='color:#000000;background-color:orange;'>atraso</td>";
						echo "<td style='color:#000000;background-color:orange;'>$".number_format($abono,2,".",",")."</td><td style='color:#000000;background-color:orange;'>$".number_format(saldoi($m['Numero']),2,".",",")."</td>";
						$ctcr=ctc($m['Numero']);
						echo "<td style='color:#000000;background-color:orange;'>A ".$ctcr[0]."<br>J ".$ctcr[1]."<br>N ".$ctcr[2]."</td>";
						echo "<td style='color:#000000;background-color:orange;'>A$".number_format($ctcr[3],2,".",",")."<br>J$".number_format($ctcr[4],2,".",",")."<br>N$".number_format($ctcr[5],2,".",",")."</td>";				
						echo"<td style='color:#000000;background-color:orange;'>$".number_format($fal,2,".",",")."</td>";
						echo "<td style='color:#000000;background-color:orange;'><input id='comentario' type='text' name='comentario' placeholder='".$m['comentario']."' onchange='comment(".$comentario.")'></td>";
						echo "<td style='color:#000000;background-color:orange;'>
							<button value='".$m['Numero']."' onclick=load(this.value)><input type='button' value='Detalle' class='button' data-type='zoomin' /></button></div></td>";
					}
					
				}
			}
		}else{
			////////////contratos
			$abono=round(total_abonos($m['Numero'],$m['facturado']),2);
			$adeudo=round($m['si']-$abono,2);
			$ultimo_abono=ultimo_abono($m['Numero'],$m['facturado']);
			$atraso=round(atraso($m['Numero']),2);
			$comentario='this.value,"'.$m['Numero'].'"';
			if($atraso>0 && abono($m['Numero'])<saldoi($m['Numero'])){
				$contratos_cobranza[$indice]=$m['Numero'];
				$indice++;
				$fal=saldoi($m['Numero'])-abono($m['Numero']);
				
				
				////////////validacion para marcar de rojo solo nivel 0
				if($_SESSION['niv']==0 || $_SESSION['niv']==1){
					///insertamos check
					$var_in='"'.$m['Numero'].'"';
					////////si es que esta marcada en la base de datos  lo checked
					if($m['urgente']==1){
						echo "<td><input type='checkbox' id='".$m['Numero']."' onchange='urgente(".$var_in.")' checked='checked'>&nbsp&nbsp".$m['Numero']."</td>";
					}else{
						echo "<td><input type='checkbox' id='".$m['Numero']."' onchange='urgente(".$var_in.")'>&nbsp&nbsp".$m['Numero']."</td>";
					}
				}else{
					//imprimimos normal
					echo "<td>".$m['Numero']."</td>";
				}
                $precio_evento=saldoi($m['Numero']);
				$ctcr=ctc($m['Numero']);
				echo "<td>".$m['tipo']."</td><td >".$ultimo_abono."</td><td >$".number_format($atraso,2,".",",")."</td><td >$".number_format(abono($m['Numero']),2,".",",")."</td><td >$".number_format($precio_evento,2,".",",")."</td>
                <td >A ".$ctcr[0]."<br>J ".$ctcr[1]."<br>N ".$ctcr[2]."</td>
                <td >A$".number_format($ctcr[3],2,".",",")."<br>J$".number_format($ctcr[4],2,".",",")."<br>N$".number_format($ctcr[5],2,".",",")."</td>
				<td >$".number_format($fal,2,".",",")."</td>
				<td >
				<input style='width:340px;' id='comentario' type='text' name='comentario' value='".$m['comentario']."' onchange='comment(".$comentario.")'>
				</td><td >
				<button value='".$m['Numero']."' onclick=load(this.value)><input type='button' value='Detalle' class='button' data-type='zoomin' /></button></div></td>";
			}
		}
		echo "</tr>";
	}
}
function total_abonos($numero,$r){
	if($r=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
		return $total_abonos['t'];	
}
function ultimo_abono($n,$r){
	if($r=='si'){
				$preabonos="select max(fechapago) as t from abonofac where numcontrato='".$n."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select max(fechapago) as t from abono where numcontrato='".$n."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			return $total_abonos['t'];
}



function atraso($n){
	/////////////////bloque para obtener el primer dia de la semana
	$year=date('Y');
	$month=date('m');;
	$day=date('d');

	# Obtenemos el numero de la semana
	$semana=date("W",mktime(0,0,0,$month,$day,$year));

	# Obtenemos el día de la semana de la fecha dada
	$diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

	# el 0 equivale al domingo...
	if($diaSemana==0)
		$diaSemana=7;

	# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
	$primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

	# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
	$ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

	/////////////////////////fin del bloque de fecha



	$query="select * from contrato where Numero='".$n."'";
	$resultado=mysql_query($query);
	$m=mysql_fetch_array($resultado);
	$fechas=explode('%',$m['fechas']);
	$i=0;$x=0;
	$sub=explode('-',$m['Numero']);

	//////////cantidad de fechas pasadas
	while($x<count($fechas)-1){
		if(strtotime($fechas[$x])<strtotime($primerDia)){
			$i++;
		}
		$x++;
	}
	//////////total de abonos que debe de haber cubierto montos en tabla contrato
	$montos=explode('%',$m['monto']);
	for($o=0;$o<$i;$o++){
		$total_teorico=$total_teorico+$montos[$o];
	}
	////////se recalcula el total a cubrir si es que tiene cargos se suman al ultimo abono agregamos 
	if($fechas[(count($fechas)-2)]<=$ultimoDia){
		$total_teorico=$total_teorico+cargos($n,$m['facturado']);
	}
	
	$atraso=$total_teorico-abono($n);

	return $atraso;
}


function atraso2($n,$first_day){
	$query="select * from contrato where Numero='".$n."'";
	$resultado=mysql_query($query);
	$m=mysql_fetch_array($resultado);
	$fechas=explode('%',$m['fechas']);
	$i=0;$x=0;
	//////////cantidad de fechas pasadas
	while($x<count($fechas)-1){
		if(strtotime($fechas[$x])<strtotime($first_day)){
			$i++;
		}
		$x++;
	}
	//////////total de abonos que debe de haber cubierto montos en tabla contrato
	$montos=explode('%',$m['monto']);
	$total_teorico=0;
	for($o=0;$o<$i;$o++){
		$total_teorico=$total_teorico+$montos[$o];
	}
	////////se recalcula el total a cubrir si es que tiene cargos
	
	$nuevafecha = strtotime ( '-1 day' , strtotime ( $first_day ) ) ;
	$ultimaanterior=date ( 'Y-m-d' , $nuevafecha );
	$atraso=$total_teorico-abono_semanal($n,$m['facturado'],'2010-01-01',$ultimaanterior);
//	echo "[".$atraso.":".$n."]";
	if($i<=0){
		$atraso=0;
	}
	return $atraso;
}


function saldoi($numero){
		$query="select * from contrato where Numero='".$numero."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$t_adultos=$m['c_adultos'];
		$t_jovenes=$m['c_jovenes'];
		$t_ninos=$m['c_ninos'];
		$p_adultos=$m['p_adultos'];
		$p_jovenes=$m['p_jovenes'];
		$p_ninos=$m['p_ninos'];
		$deposito=$m['deposito'];
			if($m['facturado']=='si'){
				$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
				$S1=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos);
				$S2=$S1*1.16;
				$SI=$S2+$deposito;
			}else{
				$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
				$SI=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos)+($deposito);
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			$SI=$SI+$m2['t'];
		return $SI;
	}
	////////////////cargos
	function cargos($numero,$fac){
		if($fac=='si'){
				$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
			}else{
				$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			return $m2['t'];
	}
	
	//total de abonos correspondiente al contrato o subcontrato
	function abono($numero){
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		if($m['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			return $total_abonos['t'];
	}
	
function lista_pagos(){
	$year=date('Y');
	$month=date('m');;
	$day=date('d');

	# Obtenemos el numero de la semana
	$semana=date("W",mktime(0,0,0,$month,$day,$year));

	# Obtenemos el día de la semana de la fecha dada
	$diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

	# el 0 equivale al domingo...
	if($diaSemana==0)
		$diaSemana=7;

	# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
	$primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

	# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
	$ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

	echo "<center><br>Semana: ".$semana." - ".utf8_decode("año").": ".$year;
	echo "<br>". utf8_decode("Primer día ").$primerDia;
	echo "<br>".utf8_decode("Ultimo día ").$ultimoDia."<br></center>";
	
	echo "<table><tr><td>Fecha</td><td>Abonos</td></tr>";
	$fecha=$primerDia;
	for($i=0;$i<7;$i++){
		echo "<tr><td>".$fecha."</td>";
		$q="select * from contrato where estatus=1 and proximo_abono='".$fecha."'";
		$r=mysql_query($q);
		echo "<td>";
		while($m=mysql_fetch_array($r)){
			$atraso=round(atraso2($m['Numero'],$primerDia),2);//es negetivo si los abonos son mayores  a la suma de montos anteriores a la semana actual o 0 si son iguales
			if($atraso<=0){////////////////verificamos que halla contado con el total de los montos anteriores
				$rec=round(recalculo($m['Numero'],$primerDia,$ultimoDia));/////////lo se debe de pagar en la semana
				if(en_cobranza($m['Numero'])){
				////////se encuentra en cobranza
				}else{
					if($rec<0){$rec=0;}
					$abono_semanal=abono_semanal($m['Numero'],$m['facturado'],$primerDia,$ultimoDia);/////abonos dados en la semana actual
					if($abono_semanal>=$rec){////pintamos de verde si ya se cubrio el monto del abono actual
						echo $m['Numero']." <mark style='color:#000000;background-color:lightgreen;'> $".number_format($rec,2,".",",")."</mark> | ";
					}elseif($abono_semanal>0){////////pintamos de naranja si a dado un pago parcial
						echo $m['Numero']." <mark style='color:#000000;background-color:lightorange;'> $".number_format($rec,2,".",",")."</mark> | ";
					}else{//////////imprimimos el abono si fondo si no ha dado ningun abono en la semana
						echo $m['Numero']." $".number_format($rec,2,".",",")." | ";
					}
					////usamos variable para acumular los abonos que se persibiran en la semana
					$total_mensualidad=$total_mensualidad+$rec;
				}
			}
		}
		echo "</td>";
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-d' , $nuevafecha );
		echo "</tr>";
	}

	$ab_reales=mysql_query("select sum(cantidad) as t from abono where fechapago>='".$primerDia."' and fechapago<='".$ultimoDia."'");
	$m_ab=mysql_fetch_array($ab_reales);
	$ab_realesfac=mysql_query("select sum(cantidad) as t from abonofac where fechapago>='".$primerDia."' and fechapago<='".$ultimoDia."'");
	$m_abfac=mysql_fetch_array($ab_realesfac);
	$all=$m_ab['t']+$m_abfac['t'];
	$faltante=$total_mensualidad-$all;
	echo "<tr><td>Total</td><td>$".number_format($total_mensualidad,2,".",",")."</td></tr>";
	echo "<tr><td>Recibido</td><td>$".number_format($m_ab['t'],2,".",",")."</td></tr>";
	if($faltante<0){
		echo "<tr><td>Extra</td><td>$".number_format(($faltante*-1),2,".",",")."</td></tr>";
	}else{
		echo "<tr><td>Faltante</td><td>$".number_format($faltante,2,".",",")."</td></tr>";
	}
	
	
	echo "</table>";
	
	
	$nuevafecha = strtotime ( '+1 day' , strtotime ( $ultimoDia) ) ;
	$fecha=date ( 'Y-m-j' , $nuevafecha );
	return $fecha;
	}

	
	function abono_recalculado($numero,$fac,$mensualidad,$first_day){
			if($fac=='si'){
				$abonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."' and fechapago<'".$first_day."'";
			}else{
				$abonos="select sum(cantidad) as t from abono where numcontrato='".$numero."' and fechapago<'".$first_day."'";
			}
	}
	


function lista_pagos2($diauno){
	$du=explode('-',$diauno);
	$year=$du[0];
	$month=$du[1];
	$day=$du[2];
	
	# Obtenemos el numero de la semana
	$semana=date("W",mktime(0,0,0,$month,$day,$year));

	# Obtenemos el día de la semana de la fecha dada
	$diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

	# el 0 equivale al domingo...
	if($diaSemana==0)
		$diaSemana=7;

	# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
	$primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

	# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
	$ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

	echo "<center><br>Semana: ".$semana." - año: ".$year;
	echo "<br>Primer día ".$primerDia;
	echo "<br>Ultimo día ".$ultimoDia."<br></center>";

	echo "<table><tr><td >Fecha</td><td>Abonos</td></tr>";
	$fecha=$primerDia;
	for($i=0;$i<7;$i++){
		echo "<tr><td>".$fecha."</td>";
		$q="select * from contrato where estatus=1";
		$r=mysql_query($q);
		echo "<td>";
		$sl=1;
		while($m=mysql_fetch_array($r)){
			if(en_cobranza($m['Numero'])){
				////////se encuentra en cobranza
			}else{
				$subc=explode('-',$m['Numero']);
				if(count($subc)==1){////contratos
					$arr=explode('%',$m["fechas"]);
					$arr2=explode('%',$m["monto"]);
					for($i2=0;$i2<count($arr);$i2++){
						if($arr[$i2]==$fecha){
							$abonos=abono($m['Numero']);
							$teo=teorico($m['Numero'],$i2);
							if($abonos>=$teo){
								if($sl==5){
									$sl=1;
									echo $m['Numero']."|<br>";
								}else{
									$sl++;
									echo $m['Numero']."|";								
								}
							}
						}
					}
				}else{///subcontratos
					$msc2=mysql_fetch_array(mysql_query("select * from subcontratos where numero='".$m['Numero']."'"));
					$arr=explode('%',$msc2["fechas"]);
					for($i3=0;$i3<count($arr);$i3++){
						if($arr[$i3]==$fecha){
							$abonos=abono($m['Numero']);
							$teo=saldoi($m['Numero']);
							if($sl==5){
									$sl=1;
									echo $m['Numero']."|<br>";
								}else{
									$sl++;
									echo $m['Numero']."|";								
								}
							}
						}
				}
			}
			
		}
		echo "</td>";
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-d' , $nuevafecha );
		echo "</tr>";
	}
	echo "</table>";

}


function teorico($n,$index){
	$query="select * from contrato where Numero='".$n."'";
	$resultado=mysql_query($query);
	$m=mysql_fetch_array($resultado);
	$montos=explode('%',$m['monto']);
	$t=0;
	for($i=0;$i<$index;$i++){
		$t=$t+$montos[$i];
	}
	
	return $t;
}


function total_ab(){
	$hoy=date('Y-m-d');
	$qaf=mysql_query('select sum(a.cantidad) as t from abonofac a,(SELECT * FROM contrato WHERE  Fecha>="'.$hoy.'") c where a.numcontrato=c.Numero');
	$maf=mysql_fetch_array($qaf);
	$qa=mysql_query('select sum(a.cantidad) as t from abono a,(SELECT * FROM contrato WHERE Fecha>="'.$hoy.'") c where a.numcontrato=c.Numero');
	$ma=mysql_fetch_array($qa);
	$total=$maf['t']+$ma['t'];
	return round($total,2);
}

function restante($ta){
$hoy=date('Y-m-d');
$q=mysql_query("SELECT sum(si) as t FROM contrato WHERE Numero not like '%-%' and Fecha>='".$hoy."'");
$m=mysql_fetch_array($q);
echo round($m['t']-$ta,2);
}

function recalculo($n,$first_day,$last_day){

	//////////validamos que sea contrato
	$sub=explode('-',$n);
	if(count($sub)>1){
		$query="select * from subcontratos where numero='".$n."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$fechas=explode('%',$m['fechas']);
		$i=0;$x=0;
		//////////cantidad de fechas menores al ultimo dia de la semana
		while($x<count($fechas)-1){
			if(strtotime($fechas[$x])<strtotime($last_day)){
				$i++;
			}
			$x++;
		}
		/// $i=cantidad de fechas que se cumpliran en la semana
		///	total de fechas=count($fechas)-1;
		/////fechas restantes para sacar el abono y si no sobran mas fechas se agrega el cargo
		$rest=count($fechas)-1-$i;
		if($rest<=0){
		///////ponemos el total de adeudo en un solo abono  ya que no existen fechas posteriores al fin de la semana
		$queryx="select * from contrato where numero='".$n."'";
		$resultadox=mysql_query($queryx);
		$mx=mysql_fetch_array($resultadox);
		$monto_abono=saldoi($n)-total_abonos($n,$mx['facturado']);
		}else{
		//////calculamos el abono el monto del abono que son las fechas restantes mas uno que es el pago de la semana
		$nuevafecha = strtotime ( '-1 day' , strtotime ( $first_day ) ) ;
		$fin_semana_anterior=date ( 'Y-m-j' , $nuevafecha );
		$monto_abono=(saldoi($n)-abono_semanal($n,$mx['facturado'],'2010-01-01',$fin_semana_anterior))/($rest+1);
		}
	}else{
		
		$query="select * from contrato where Numero='".$n."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$fechas=explode('%',$m['fechas']);
		$i=0;$x=0;
		//////////cantidad de fechas pasadas
		while($x<count($fechas)-1){
			if(strtotime($fechas[$x])<strtotime($first_day)){
				$i++;
			}
			$x++;
		}
		//////////asignamos el monto del abono si + cargo 
		$montos=explode('%',$m['monto']);
		$monto_abono=$montos[$i];
		
		/////calculo hasta fin de la semana anterior
				//////////total de abonos que debe de haber cubierto montos en tabla contrato
				for($o=0;$o<$i;$o++){
					$total_teorico=$total_teorico+$montos[$o];
				}
				//////calculamos el excedente de pago anterior al primer dia de la semana
				//////usamos la funcion abono semanal para calcular el total de abonos desde 2010-01-01 hasta un dia antes del inicion de la semana 
				$nuevafecha = strtotime ( '-1 day' , strtotime ( $first_day ) ) ;
				$fin_semana_anterior=date ( 'Y-m-j' , $nuevafecha );
				$extra=$total_teorico-abono_semanal($m['Numero'],$m['facturado'],'2010-01-01',$fin_semana_anterior);
		//////descontamos el excedente pago 
		if($extra<0){
			$monto_abono=$monto_abono+$extra;
		}
		////verificacion de fechas iguales en la semana
		while(strtotime($fechas[$i+1])<=strtotime($last_day) && $fechas[$i]!='' ){
					$monto_abono=$monto_abono+$montos[$i+1];
					$i++;
				}
		
		//////se recalcula el total a cubrir si es que tiene cargos se suman al ultimo abono
		if($last_day>=$fechas[(count($fechas)-2)]){
			$monto_abono=$monto_abono+cargos($n,$m['facturado']);
		}
		
	}

	return $monto_abono;

}

function abono_semanal($numero,$fac,$first_day,$last_day){
	if($fac=='si'){
		$abonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."' and fechapago>='".$first_day."' and fechapago<='".$last_day."'";
	}else{
		$abonos="select sum(cantidad) as t from abono where numcontrato='".$numero."' and fechapago>='".$first_day."' and fechapago<='".$last_day."'";
	}
	$r=mysql_query($abonos);
	$m=mysql_fetch_array($r);
	return $m['t'];
}

function c_precontratos(){
	$hoy=date('Y-m-d');
	$q="select *  from contrato where Fecha>='".$hoy."' and estatus=0 and Numero not like '%-%'";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$q2="select count(*) as t from contrato where Numero like '".$m['Numero']."-%'";
		$r2=mysql_query($q2);
		$m2=mysql_fetch_array($r2);
		if($m2['t']==0){
			$contador++;
		}
	}
	return $contador;
}

function c_globales(){
	$hoy=date('Y-m-d');
	$contador=0;
	$q="select *  from contrato where Fecha>='".$hoy."' and Numero not like '%-%'";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$q2="select count(*) as t from contrato where Numero like '".$m['Numero']."-%'";
		$r2=mysql_query($q2);
		$m2=mysql_fetch_array($r2);
		if($m2['t']>0){
			$contador++;
		}
	}
	return $contador;
}

function c_normales(){
	$hoy=date('Y-m-d');
	$contador=0;
	$q="select *  from contrato where Fecha>='".$hoy."' and estatus=1 and Numero not like '%-%'";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$q2="select count(*) as t from contrato where Numero like '".$m['Numero']."-%'";
		$r2=mysql_query($q2);
		$m2=mysql_fetch_array($r2);
		if($m2['t']==0){
			$contador++;
		}
	}
	return $contador;
}

function eventos_adicionales(){
	$hoy=date('Y-m-d');
	$q=mysql_query("select count(*) as t from Eventos_Adicionales where fecha>='".$hoy."'");
	$mostrar=mysql_fetch_array($q);
	return $mostrar['t'];
}
function eventos_recaudacion(){
	$hoy=date('Y-m-d');
	$q=mysql_query("select count(*) as t from Eventos_Recaudacion where fecha>='".$hoy."'");
	$mostrar=mysql_fetch_array($q);
	return $mostrar['t'];
}
function adultos_cobranza(){
	$hoy=date('Y-m-d');
	$cantidad=0;
/////////////////cantidad de adultos en contratos globales y normales 	
	$q="select sum(c_adultos) as t from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$cantidad=$m['t'];
//////////cargos de comensales de tipo adulto
//////obtenemos lso numeros de los contratos que tomamos en cuenta
	$q2="select Numero from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r2=mysql_query($q2);
	while($m2=mysql_fetch_array($r2)){
		if($m2['facturado']=='si'){/////////cargos facturados
			$qc="select * from cargofac where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}else{//////////cargos no facturados
			$qc="select * from cargo where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}
		$rc=mysql_query($qc);
		while($mc=mysql_fetch_array($rc)){
			$arreglo=explode(' ',$mc['concepto']);
			$cantidad=$cantidad+$arreglo[4];
		}
	}

	return $cantidad;
}
function jovenes_cobranza(){
	$hoy=date('Y-m-d');
	$cantidad=0;
/////////////////cantidad de adultos en contratos globales y normales 	
	$q="select sum(c_jovenes) as t from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$cantidad=$m['t'];
//////////cargos de comensales de tipo adulto
//////obtenemos lso numeros de los contratos que tomamos en cuenta
	$q2="select Numero from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r2=mysql_query($q2);
	while($m2=mysql_fetch_array($r2)){
		if($m2['facturado']=='si'){/////////cargos facturados
			$qc="select * from cargofac where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}else{//////////cargos no facturados
			$qc="select * from cargo where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}
		$rc=mysql_query($qc);
		while($mc=mysql_fetch_array($rc)){
			$arreglo=explode(' ',$mc['concepto']);
			$cantidad=$cantidad+$arreglo[15];
		}
	}

	return $cantidad;
}
function ninos_cobranza(){
	$hoy=date('Y-m-d');
	$cantidad=0;
/////////////////cantidad de adultos en contratos globales y normales 	
	$q="select sum(c_ninos) as t from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$cantidad=$m['t'];
//////////cargos de comensales de tipo adulto
//////obtenemos lso numeros de los contratos que tomamos en cuenta
	$q2="select Numero from contrato where Numero not like '%-%' and Fecha>='".$hoy."'";
	$r2=mysql_query($q2);
	while($m2=mysql_fetch_array($r2)){
		if($m2['facturado']=='si'){/////////cargos facturados
			$qc="select * from cargofac where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}else{//////////cargos no facturados
			$qc="select * from cargo where numcontrato='".$m2['Numero']."' and tipo='Comensales'";
		}
		$rc=mysql_query($qc);
		while($mc=mysql_fetch_array($rc)){
			$arreglo=explode(' ',$mc['concepto']);
			$cantidad=$cantidad+$arreglo[26];
		}
	}

	return $m['t'];
}

function suma_de_abonos($numero,$fl,$fi){
	$datos="select * from contrato where Numero='".$numero."'";
		$datosr=mysql_query($datos);
		$datos_m=mysql_fetch_array($datosr);
				
		if($datos_m['facturado']=='si'){
			$q="select sum(cantidad) as c from abonofac where numcontrato='".$numero."' and fechapago<='".$fl."' and fechapago>'".$fi."'";
		}else{
			$q="select sum(cantidad) as c from abono where numcontrato='".$numero."' and fechapago<='".$fl."' and fechapago>'".$fi."'";
		}
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		return $m['c'];
	
	
	}
function en_cobranza($n){
global $contratos_cobranza;
$bandera=false;
	for($u=0;$u<count($contratos_cobranza);$u++){
		if($contratos_cobranza[$u]==$n){
			$bandera=true;
		}
	}
	return $bandera;
}

function prox_abono_sub(){
	$fff=domingo();
	$q="select * from contrato where Fecha>'2016-01-01' and Numero like '%-%'";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$n=mysql_query("select * from subcontratos where numero='".$m['Numero']."'");
		$m2=mysql_fetch_array($n);
		$fechas=explode('%',$m2['fechas']);
		$i=0;$x=0;
		while($x<count($fechas)-2){
			if(strtotime($fechas[$i])<=strtotime($fff)){
				$i++;
			}
			$x++;
		}
		//echo "sub contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]."<br>";
		mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i-1]."' where Numero='".$m2['numero']."'");
	}	
}

function prox_abono_con($ud){
	$fff=domingo();
	//echo">>>>".$fff;
	$q="select * from contrato where Fecha>'2016-01-01' and estatus=1 and Numero not like '%-%'";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$fechas=explode('%',$m['fechas']);
		$i=0;$x=0;
		while($x<count($fechas)-1){
			if(strtotime($fechas[$i])<=strtotime($fff)){
				$i++;
			}
			$x++;
		}
		//$monto=explode("%",$m2['monto']);
		//echo "contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]." monto ".$monto[$i]."<br>";
		mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i-1]."' where Numero='".$m['Numero']."'");
	}
}
function domingo(){
	$year=date('Y');
	$month=date('m');
	$day=date('d');

	# Obtenemos el numero de la semana
	$semana=date("W",mktime(0,0,0,$month,$day,$year));

	# Obtenemos el día de la semana de la fecha dada
	$diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

	# el 0 equivale al domingo...
	if($diaSemana==0)
		$diaSemana=7;

	# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
	$primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

	# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
	$ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));
	
	return $ultimoDia;
}

function ctc($contrato){
    $c=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$contrato."'"));
    
    if($c['facturado']=="no"){
        $q='select * from cargo where numcontrato="'.$contrato.'" and tipo="Comensales"';
    }else{
        $q='select * from cargofac where numcontrato="'.$contrato.'" and tipo="Comensales"';
    }
    
    $r=mysql_query($q);
	$cantidades[0]=$c['c_adultos'];
	$cantidades[1]=$c['c_jovenes'];
	$cantidades[2]=$c['c_ninos'];
	
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
    $cantidades[3]=$c['p_adultos'];
	$cantidades[4]=$c['p_jovenes'];
	$cantidades[5]=$c['p_ninos'];
    
    return $cantidades;
}
 ?>