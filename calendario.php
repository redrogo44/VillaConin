<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
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


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
				  right:1000px;
				  height:20px;
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
				.nav li:hover> ul li{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-146px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				#estatico{ 
					height: 50px; 
					width: 1200px; 
					float:right;					
					border: solid 0px silver; 
					position: fixed;     
						} 
						.button 
						{
							   border-top: 1px solid #ff0000;
							   background: #ff0000;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #ff0000, #ff0000);
							   background: -moz-linear-gradient(top, #ff0000, #ff0000);
							   background: -ms-linear-gradient(top,#ff0000, #ff0000);
							   background: -o-linear-gradient(top, #ff0000, #ff0000);
							   padding: 8px 10px;
							   -webkit-border-radius: 0px;
							   -moz-border-radius: 0px;
							   border-radius: 0px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ff0000;
							   font-size: 5px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #ff0000;
							   background: #ff0000;
							   color: #ff0000;
							   }
							.button:active {
							   border-top-color: #ff0000;
							   background: #ff0000;
			   }
			   .button2 
						{
							   border-top: 1px solid #CD66C6;
							   background: #CD66C6;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #CD66C6, #CD66C6);
							   background: -moz-linear-gradient(top, #CD66C6, #CD66C6);
							   background: -ms-linear-gradient(top,#CD66C6, #CD66C6);
							   background: -o-linear-gradient(top, #CD66C6, #CD66C6);
							   padding: 8px 10px;
							   -webkit-border-radius: 0px;
							   -moz-border-radius: 0px;
							   border-radius: 0px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ff0000;
							   font-size: 5px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #ff0000;
							   background: #ff0000;
							   color: #ff0000;
							   }
							.button:active {
							   border-top-color: #ff0000;
							   background: #ff0000;
			   }
			   .button3
						{
							   border-top: 1px solid #00F3FF;
							   background: #00F3FF;
							   background: -webkit-gradient(linear, left top, left bottom, from(#00F3FF), to(#00F3FF));
							   background: -webkit-linear-gradient(top, #00F3FF, #00F3FF);
							   background: -moz-linear-gradient(top, #00F3FF, #00F3FF);
							   background: -ms-linear-gradient(top,#00F3FF, #00F3FF);
							   background: -o-linear-gradient(top, #00F3FF, #00F3FF);
							   padding: 8px 10px;
							   -webkit-border-radius: 0px;
							   -moz-border-radius: 0px;
							   border-radius: 0px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ff0000;
							   font-size: 5px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #ff0000;
							   background: #ff0000;
							   color: #ff0000;
							   }
							.button:active {
							   border-top-color: #ff0000;
							   background: #ff0000;
			   }
    </style>
        <style type="text/css">
	a{
    color: #000;
	text-decoration:none;
    }
  </style>
</head>

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<BR />
<br />
<!--
<div  align="right" id="estatico">
<table>
<tr><td  bgcolor="#FF0000"><input type="button"  class="button" disabled="false"/></td><td> <b>&nbsp;&nbsp;Pre Contratos</b></td>
</table>
</div>-->

<div align="center">
<?php
if(isset($_GET['fecha'])){
$f=$_GET['fecha'];
}else{
$f=date('Y-m')."-01";
}
$datos=explode('-',$f);
$anio=$datos[0];
$mes=$datos[1];
$dia=$datos[2];
$inicio= date("w",mktime(0, 0, 0, $mes, $dia, $anio));
$max=getMonthDays($mes, $anio);
$i=1;


$next_mes=$mes+1;
$previous_mes=$mes-1;
if($next_mes>12){
	$a=$anio+1;
	$var1=$a."-01-01";
}else{
	$var1=$anio."-".$next_mes."-01";
}
if($previous_mes<1){
	$a2=$anio-1;
	$var2=$a2."-12-01";
}else{
	$var2=$anio."-".$previous_mes."-01";
}

	echo "<a href='calendario.php?fecha=".$var2."'><button><<</button></a>&nbsp&nbsp&nbsp";
	echo mess($mes)." DE ".$anio;
	echo "&nbsp&nbsp&nbsp<a href='calendario.php?fecha=".$var1."'><button>>></button></a>";
	echo"<br><br>
		<table>
<tr>
<td  bgcolor='#FF0000'><input type='button'  class='button' disabled='false'/></td><td> <b>&nbsp;&nbsp;Pre Contratos</b></td>
&nbsp;&nbsp
<td></td>
<td  bgcolor='#CD66C6'><input type='button'  class='button2' disabled='false'/></td><td> <b>&nbsp;&nbsp;Eventos Adicionales</b></td>
<td  bgcolor='#00F3FF'><input type='button'  class='button3' disabled='false'/></td><td> <b>&nbsp;&nbsp;Eventos Recaudacion</b></td>
</tr>
</table>
	";
	
 ?>
 
 
<table border='6' bordercolor="#990000">
<tr align="center" font="3"><th>Domingo</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th></tr>
<?php
for($y=0;$y<6;$y++){
echo "<tr>";
	for($x=0;$x<7;$x++){
		if($i<=$max){
			if($x==$inicio || $i>1){
				echo "<td WIDTH=90 HEIGHT=100 align='center' ><strong><font size='5'><a href='NuevoContrato.php' >".$i."</font></strong><br>";
				$query="select * from contrato where Fecha='".$anio."-".$mes."-".$i."'";
				$r=mysql_query($query);
				while($m=mysql_fetch_array($r)){
					if($m['estatus']==0 && strlen($m['Numero'])<=8)
					{
						echo "<div style='background:#FF0000;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >".$m['salon']."</a><br></font></div>";
					
					}elseif($m['salon']=="Real de Conin" && strlen($m['Numero'])<=8){
						echo "<div style='background:#99FF99;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >".$m['salon']."</a><br></font></div>";
					}
					elseif($m['salon']=="Fundador de Conin" && strlen($m['Numero'])<=8){
						echo "<div style='background:#FFCC99;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >".$m['salon']."</a><br></font></div>";
					}
					elseif($m['salon']=="Alcazar de Conin" && strlen($m['Numero'])<=8){
						echo "<div style='background:#99CCFF;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >Alcazar de Conin</a><br></font></div>";
					}
					elseif($m['salon']=="Solar de Conin" && strlen($m['Numero'])<=8){
						echo "<div style='background:#FFFF33;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >".$m['salon']."</a><br></font></div>";
					}elseif($m['salon']=="Marques" && strlen($m['Numero'])<=8){
						echo "<div style='background:#D8D8D8;'><font size='1'><a href='calendario2.php?numero=".$m['Numero']."' >".$m['salon']."</a><br></font></div>";
					}
				}
				///////////////////////7 EVETOS ADICIONALES /////////////
				$EveA=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Fecha='".$anio."-".$mes."-".$i."'");
				while($EA=mysql_fetch_array($EveA))
				{
					
						echo "<div style='background:#CD66C6;'><font size='1' color='yellow'><a href='calendario2.php?numero=".$EA['Numero']."' >".$EA['salon']."</a><br></font></div>";				
	
				}
				$err="SELECT * FROM Eventos_Recaudacion WHERE fecha='".$anio."-".$mes."-".$i."' and estatus='ACTIVO' ";
				$EvR=mysql_query($err);
				while($ER=mysql_fetch_array($EvR))
				{	//echo $ER['Numero'];
						echo "<div style='background:#00F3FF;'><font size='1' color='yellow'><a href='calendario2.php?numero=".$ER['Numero']."' >".$ER['salon']."</a><br></font></div>";	
				}



				/////////////////////////////////////////////////////////7
				echo "</td>";
				$i++;
			}else{
				echo "<td style='background: orange; '></td>";
			}
		}else{
			echo "<td style='background: orange;'></td>";
		}
	}
	
echo "</tr>";
}



function getMonthDays($Month, $Year)
{
   //Si la extensión que mencioné está instalada, usamos esa.
   if( is_callable("cal_days_in_month"))
   {
      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
   }
   else
   {
      //Lo hacemos a mi manera.
      return date("d",mktime(0,0,0,$Month+1,0,$Year));
   }
}

function mess($m){
$name="";
if($m==1){
	$name="ENERO";
}elseif($m==2){
	$name="FEBRERO";
}elseif($m==3){
	$name="MARZO";
}elseif($m==4){
	$name="ABRIL";
}elseif($m==5){
	$name="MAYO";
}elseif($m==6){
	$name="JUNIO";
}elseif($m==7){
	$name="JULIO";
}elseif($m==8){
	$name="AGOSTO";
}elseif($m==9){
	$name="SEPTIEMBRE";
}elseif($m==10){
	$name="OCTUBRE";
}elseif($m==11){
	$name="NOVIEMBRE";
}elseif($m==12){
	$name="DICIEMBRE";
}
return $name;
}
?>
</table>

</div>


<!--ESTILO CUERPO-->

<br><br><br><br>
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 2.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
<div id="reloj" style="color: #FFF;
background: #900;
position:fixed;
 bottom:0;
 right:0;
height:39px; /*alto del div*/
Width:150px;
z-index:99999;
" >
<span id="liveclock" style="position:absolute;left:0;top:0;" onclick="window.open='calendario.php';"></span><script language="JavaScript" type="text/javascript">

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
myclock="<font size='5' face='Arial' ><b><font size='2'><?php echo date('d-m-Y'); ?></font></br>"+hours+":"+minutes+" "+dn+"</b></font>"
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
</body>
</html>

