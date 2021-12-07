<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'funciones2.php';
validarsesion();
conectar();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}
?>
 
 <title>Villa Conin</title>
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
				.myButton { 
	-moz-box-shadow:inset 0px 1px 0px 0px #cf866c;
	-webkit-box-shadow:inset 0px 1px 0px 0px #cf866c;
	box-shadow:inset 0px 1px 0px 0px #cf866c;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #990000), color-stop(1, #990000));
	background:-moz-linear-gradient(top, #990000 5%,#990000 100%);
	background:-webkit-linear-gradient(top, #990000 5%, #990000 100%);
	background:-o-linear-gradient(top,#9900005%, #990000 100%);
	background:-ms-linear-gradient(top,#990000 5%, #990000 100%);
	background:linear-gradient(to bottom, #990000 5%, #990000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#990000', endColorstr='#990000',GradientType=0);
	background-color:##990000;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #942911;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #854629;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bc3315), color-stop(1, #d0451b));
	background:-moz-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-webkit-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-o-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-ms-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bc3315', endColorstr='#d0451b',GradientType=0);
	background-color:#bc3315;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>

<body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">


<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario."<br><br><br><br><br><br><br>";
?> 
<!--ESTILO CUERPO-->
<div align="center">	
<form action='ReporteServicios.php' method='POST' onsubmit="return validafecha()">
	<table border='6' bordercolor='#990000'>
		<tr><td  colspan="2" align='center'>
			<select name='servicio' style='font-size:18px;'>
				<?php
					$s=mysql_query("Select id,Servicio from Servicios order by Servicio");
					while($ms=mysql_fetch_array($s)){
						echo "<option value='".$ms['id']."'>".$ms['Servicio']."</option>";
					}
				?>
			</select>
			</td></tr>
		<tr><td><input type='date' name='i' id="inicio" ></td><td><input type='date' name='f' id="final"></td></tr>
		<tr><td  colspan="2" align='center'><input type='submit' name='submit' value='Consultar' class='myButton'></td></tr>
	</table>
</form>
<br><br>

<!--button class='myButton' onclick='imp()'>
Imprimir Reporte
</button><br-->

<div id='resultados'>  
    <div id="all" align='center'>
        <h2><?php
        $service=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['servicio']));
        echo $service['Servicio'];
        ?></h2>
        <h2><?php 
			if($_POST['i']==$_POST['f']){
				echo "De ".fecha_larga($_POST['i']);
			}else{
				echo "De ". fecha_larga($_POST['i'])." a ". fecha_larga($_POST['f']);	
			}
			?></h2>
    </div>
    
    
    <table  border='6' bordercolor='#990000' align='center'> 
        <tr>
        	<th>CONTRATO</th>
        	<th>CANTIDAD</th>
        	<th>SALON</th>
        	<th>HORARIO</th>
        </tr>
        <?php
        $c=mysql_query("select * from contrato where Fecha>='".$_POST['i']."' and fecha<='".$_POST['f']."' and Numero not like '%-%' and estatus=1 ORDER BY Fecha"); 
        while($contrato=mysql_fetch_array($c)){
			$existe=false;$opcional=false;
            //$aux_horas=0;
            ////////servicios del contrato inicial
            $s1=explode("%",$contrato['servicios']);
            for($i=0;$i<count($s1);$i++){
				$cop=explode(",",$s1[$i]); 
				if(count($cop)>1){///estamos recorriendo un servicio opcional
					for($h=0;$h<count($cop);$h++){
						$opc2=explode("-",$cop[$h]);
						if($opc2[0]==$service['id']){
							$existe=true;$opcional=true;
						}	
					}
				}else{
					$s11=explode("-",$s1[$i]); 
					if($s11[0]==$service['id']){
						//$aux_horas=$aux_horas+$s11[1];
						$existe=true;
					}  
				} 
            }
			///validamos si es que la bandera ya esta en verdadero es decir que si cuenta con el servicio
			if(!$existe){
				////como no existe en los servicios de un inicio lo buscamos en los adicionales que son los cargos
				//echo $contrato["Numero"]."<br>";
				////////servicios adicionales
				/////separamos por notas de cargos
				$sa=explode("#",$contrato['ServiciosAdicionales']);
				for($x=0;$x<count($sa);$x++){
					/////////separamos los cargo de su id  de cargo
					$sa1=explode("_",$sa[$x]);
					$sa2=explode(";",$sa1[1]);
					for($y=0;$y<count($sa2);$y++){
						////////separamos cada unos de los servicios y comparamos por si es el que estamos buscando
						$sa3=explode(",",$sa2[$y]);
						////obtenemos id_cargo en posicio 0, horas en posicion 1 y precio unitario en posicion 2
						if($sa3[0]==$service['id']){
							//$aux_horas=$aux_horas+$sa3[1];
						}
					}
				}
			}
            
			
			
			if($existe){
				echo "<tr><td>".$contrato['Numero']."</td>";
				///validamos que tenga un horario asignado
				$logi=mysql_query("select * from logistica where numero='".$contrato['Numero']."' and  servicio=".$service['id']);
				if(mysql_num_rows($logi)>0){

					while($logistica=mysql_fetch_array($logi)){
						echo "<td align='center'>".$logistica['tiempo']."</td>";
						echo "<td>";
						$li=explode(":",$logistica["hora_i"]);
						$lf=explode(":",$logistica["hora_f"]);
						echo date("h;i A",mktime($li[0],$li[1],0,0,0,0))." - ".date("h;i A",mktime($lf[0],$lf[1],0,0,0,0));
						echo "</td>";
					}

					echo "<td>".$contrato['salon']."</td>";
				}else{
					///validamos que sea un servicio opcional
					if($opcional){
						echo "<td>Servicio Opcional</td>";
					}else{
						echo "<td>Falta horario por definir</td>";
					}
				}
				echo "</tr>";
			}
			
            
            /*////validamos si las horas son mayores a 0 para imprimirlas
            if($aux_horas>0){
                echo "<tr><td>".$contrato['Numero']."</td><td>".$contrato['nombre']."</td><td>".$contrato['tipo']."</td><td align='center'>".$aux_horas."</td><td>";
                $logi=mysql_query("select * from logistica where numero='".$contrato['Numero']."' and  servicio=".$service['id']." order by fecha_i,hora_i");
                while($logistica=mysql_fetch_array($logi)){
                    echo $logistica['fecha_i']." ".$logistica["hora_i"]." a ". $logistica['fecha_f']." ".$logistica["hora_f"]."<br>";
                }
                echo"</td></tr>";
            
            }*/
            
        }

        ?>
     </table>
 </div>
<script>
    function imp(){
	var ficha=document.getElementById("resultados");
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}

function validafecha(){
	r=false;
	var i=document.getElementById("inicio").value;
	var f=document.getElementById("final").value;
	var res1 = i.split("-");
	var res2 = f.split("-");
	var d = new Date(res1[0],res1[1],res1[2],0,0,0,0);
	var d2 = new Date(res2[0],res2[1],res2[2],0,0,0,0);
	v1=d.getTime();
	v2=d2.getTime();
	if(v2>=v1){
		r=true;
	}else{
		alert("Error la fecha de culminacion debe ser mayor a la de inicio");
	}
	
	return r;
}
</script>
</body>

</html>
<?php
	function fecha_larga($fecha){
		$week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
$months = array ("---", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre","Noviembre","Diciembre");
		$datos=explode("-",$fecha);
		$year_now = $datos[0]*1;
		$month_now = $datos[1]*1;
		$day_now = $datos[2]*1;
		$week_day_now = date('w', strtotime($fecha));
		$date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;
		return $date;
	}
	?>