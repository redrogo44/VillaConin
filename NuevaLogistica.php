<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head>
<?php
session_start();
require 'funciones2.php';
validarsesion();
conectar();
//console.log('Conexion Exitosa');
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

	$servicios='';
	$indice=0;
	$mis_servicios=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['numero']."'"));
	///////////obtener los comensales
    $adultos=$mis_servicios['c_adultos'];
    $jovenes=$mis_servicios['c_jovenes'];
	$ninos=$mis_servicios['c_ninos'];
    $comensales_cargo=total_comensales($_GET['numero'],$mis_servicios['facturado']);
    $adultos=$adultos+$comensales_cargo[0];
    $jovenes=$jovenes+$comensales_cargo[1];
	$ninos=$ninos+$comensales_cargo[2];
    $t_comensales=$adultos+$jovenes+$ninos;

//////////////////////////////////////////

	
	/////////servicios incluidos en el contrato
	$default=explode('%',$mis_servicios['servicios']);
	for($k=0;$k<count($default);$k++){
        
        ////verificamos los servicios que son opcionales
        $opcionales=explode(",",$default[$k]);
        if(count($opcionales)<=1){
            $s1=explode("-",$default[$k]);
            if(isset($servicios[$s1[0]])){
                $servicios[$s1[0]]=$servicios[$s1[0]]+$s1[1];
            }else{
                $servicios[$s1[0]]=$s1[1];
            }
        }else{
             $s1=explode("-",$opcionales[0]);
            if(isset($servicios[$s1[0]])){
                $servicios[$s1[0]]=$servicios[$s1[0]]+$s1[1];
            }else{
                $servicios[$s1[0]]=$s1[1];
            }
        }
		
	}
	
	//////////servicios adicionales
//	echo $mis_servicios['Se¿rviciosAdicionales']."<br><br>";
	$info=explode("#",$mis_servicios['ServiciosAdicionales']);
	for($i=0;$i<count($info);$i++){
		$id=explode("_",$info[$i]);
		$service=explode(";",$id[1]);
		for($i2=0;$i2<count($service);$i2++){
			//echo $service[$i2]."<br>";
			$s=explode(',',$service[$i2]);
            ////validamos si es uno del tipo hora piezas
            $hps=explode("/",$s[1]);
            if(count($hps)>1){
                if(isset($servicios[$s[0]])){/////////validamos la existencia en nuestro arreglo 
                    $sum_hps=explode("/",$servicios[$s[0]]);
                    $numerador=$hps[0]+$sum_hps[0];
                    $divisor=$hps[1]+$sum_hps[1];
				    $servicios[$s[0]]=$numerador."/".$divisor;
                }else{
                    $servicios[$s[0]]=$s[1];
                }
            }else{
                ///servicio simple
                if(isset($servicios[$s[0]])){
				$servicios[$s[0]]=$servicios[$s[0]]+$s[1];
                }else{
                    $servicios[$s[0]]=$s[1];
                }
            }
			
		}
		
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

    .menu select,p{
        min-width:120px;    
        }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['timeline']}]}"></script>
	
<script type="text/javascript">
	google.setOnLoadCallback(drawChart);
	function drawChart() {

	  var container = document.getElementById('example5.2');
	  var chart = new google.visualization.Timeline(container);
	  var dataTable = new google.visualization.DataTable();

	  dataTable.addColumn({ type: 'string', id: 'Room' });
	  dataTable.addColumn({ type: 'string', id: 'Name' });
	  dataTable.addColumn({ type: 'date', id: 'Start' });
	  dataTable.addColumn({ type: 'date', id: 'End' });
	  dataTable.addRows([
	<?php


////////////cargamos el horario de la renta de las instalaciones
$renta_=mysql_query("select * from Servicios where Servicio='RENTA'");
$recep_=mysql_query("select * from Servicios where Servicio='RECEPCION'");
$s_comida=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='COMIDA'"));
$lcomida=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$s_comida['id']." order by fecha_i ASC,hora_i ASC"));
$renta_2=mysql_fetch_array($renta_);

$log=mysql_query("select * from logistica where numero='".$_GET['numero']."' order by fecha_i ASC,hora_i ASC");
    $aux_f="2015-01-01";$aux_h="00:00:00";
    while($m=mysql_fetch_array($log)){
        
         /////actividades
        $act=mysql_query("select * from Actividades where numero='".$_GET['numero']."'");
        while($m2=mysql_fetch_array($act)){
            $dt1 = strtotime($m['fecha_i']." ".$m['hora_i']);
	        $dt2 = strtotime($aux_f." ".$aux_h);
	        $dt3 = strtotime($m2['fecha_i']." ".$m2['hora_i']);
            if($dt3>=$dt2 && $dt3<$dt1){
                    $fi=explode("-",$m2['fecha_i']);	
                    $hi=explode(":",$m2['hora_i']);
                    $ff=explode("-",$m2['fecha_f']);
                    $hf=explode(":",$m2['hora_f']);
                    echo "[ '".$m2['actividad']."',  '".$m2['actividad']."',    new Date(".$fi[0].",".$fi[1].",".$fi[2].",".$hi[0].",".$hi[1].",".$hi[2]."),  new Date(".$ff[0].",".$ff[1].",".$ff[2].",".$hf[0].",".$hf[1].",".$hf[2].") ],";
            }
        }
        
        $service=mysql_fetch_array(mysql_query("select * from Servicios where id=".$m['servicio']));
        if($service['Servicio']=='RENTA'){
            $service['Servicio']="RENTA DE INSTALACIONES";
        }
        
        $fi=explode("-",$m['fecha_i']);	
        $hi=explode(":",$m['hora_i']);
        $ff=explode("-",$m['fecha_f']);
        $hf=explode(":",$m['hora_f']);
        echo "[ '".$service['Servicio']."',  '".$service['Servicio']."',    new Date(".$fi[0].",".$fi[1].",".$fi[2].",".$hi[0].",".$hi[1].",".$hi[2]."),  new Date(".$ff[0].",".$ff[1].",".$ff[2].",".$hf[0].",".$hf[1].",".$hf[2].") ],";
        $aux_f=$m["fecha_i"];
        $aux_h=$m["hora_i"];
    }
    
/////////////actividades restantes
/////actividades
        $act2=mysql_query("select * from Actividades where numero='".$_GET['numero']."' order by fecha_i ASC,hora_i ASC");
        while($m3=mysql_fetch_array($act2)){
              $dt1 = strtotime($m3['fecha_i']." ".$m3['hora_i']);
	      $dt2 = strtotime($aux_f." ".$aux_h);
            if($dt1>=$dt2){
                    $fi=explode("-",$m3['fecha_i']);	
                    $hi=explode(":",$m3['hora_i']);
                    $ff=explode("-",$m3['fecha_f']);
                    $hf=explode(":",$m3['hora_f']);
                    echo "[ '".$m3['actividad']."',  '".$m3['actividad']."',    new Date(".$fi[0].",".$fi[1].",".$fi[2].",".$hi[0].",".$hi[1].",".$hi[2]."),  new Date(".$ff[0].",".$ff[1].",".$ff[2].",".$hf[0].",".$hf[1].",".$hf[2].") ],";
            }
        }
/*
    $act2=mysql_query("select * from Actividades where numero='".$_GET['numero']."' and fecha_i>='".$aux_f."' and hora_i>='".$aux_h."'");
    while($m3=mysql_fetch_array($act2)){
                    $fi=explode("-",$m3['fecha_i']);	
                    $hi=explode(":",$m3['hora_i']);
                    $ff=explode("-",$m3['fecha_f']);
                    $hf=explode(":",$m3['hora_f']);
                    echo "[ '".$m3['actividad']."',  '".$m3['actividad']."',    new Date(".$fi[0].",".$fi[1].",".$fi[2].",".$hi[0].",".$hi[1].",".$hi[2]."),  new Date(".$ff[0].",".$ff[1].",".$ff[2].",".$hf[0].",".$hf[1].",".$hf[2].") ],";
    }
     */
    //////dato de la logistica
    $irl=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
    $irl2=mysql_fetch_array($recep_);
    $ilimitada_f=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$irl['id']));
    $ilimitada_i=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$irl2['id']));
$xyz=0;  
foreach ($servicios as $i => $value) {
                $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));	
               if($q['unidad']=='ILIMITADA'){
                    $fi=explode("-",$ilimitada_i['fecha_i']);	
                    $hi=explode(":",$ilimitada_i['hora_i']);
                    $ff=explode("-",$ilimitada_f['fecha_f']);
                    $hf=explode(":",$ilimitada_f['hora_f']);
                    echo "[ '".$q['Servicio']."',  '".$q['Servicio']."',    new Date(".$fi[0].",".$fi[1].",".$fi[2].",".$hi[0].",".$hi[1].",".$hi[2]."),  new Date(".$ff[0].",".$ff[1].",".$ff[2].",".$hf[0].",".$hf[1].",".$hf[2].") ],";
                   $xyz++;
                }
            }

	?>
		]);

	  var options = {
		backgroundColor: '#ffd',avoidOverlappingGridLines:false,
	  };

	  chart.draw(dataTable, options);
}





</script>
     
<script>
    <?php
$ad=mysql_fetch_array(mysql_query("select sum(cantidad) as t from logistica_menu where tipo_comensal='adultos' and contrato='".$_GET['numero']."'"));
if($ad['t']==''){$ad['t']=0;}
    echo "var adultos_asignados=".$ad['t'].";";
    $jo=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='jovenes' and contrato='".$_GET['numero']."'"));
if($jo['t']==''){$jo['t']=0;}
    echo "var jovenes_asignados=".$jo['t'].";";
$ni=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='ninos' and contrato='".$_GET['numero']."'"));
if($ni['t']==''){$ni['t']=0;}
    echo "var ninos_asignados=".$ni['t'].";";
    ?> 
     
     </script>
<!-- CUERPO DEL WEB-->

</head>
<body  style="background-repeat:no-repeat;"  onload='mostrar_menu()' bgcolor="#fff">

 
    
    

<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario."<br><br>";
?> 
<!--ESTILO CUERPO-->


<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >INFORMACION DEL CONTRATO</h1>
	  
    </div>
</div><!-- /.row -->

    
<div class="row">
     <div class="col-md-3 col-sm-12" align='center'>
         <h2><?php echo $_GET['numero'];?></h2>
         <label>Nombre del contrato</label>
         <label><?php echo $mis_servicios['nombre'];?></label>
         <label>Nombre del Festejado </label><br>
        <input id='festejado' type="text" value="<?php echo $mis_servicios['festejado'];?>" onchange="nombre_festejado();"><br><br>
        <a href="PDF_logistica.php?n=<?php  echo $_GET['numero'];?>" target="_blank">
        <button class='myButton'>IMPRIMIR LOGISTICA</button></a>
         <br><br><table border="2">
		 <tr><td>TIPO</td><td>Cantidad</td><td>PRECIO</td></tr>
		 <tr><td>ADULTOS</td><td align="right"><?php echo $adultos;?></td><td>$<?php echo number_format($mis_servicios["p_adultos"],2,".",",");?></td></tr>
             <tr><td>JOVENES</td><td align="right"><?php echo $jovenes;?></td><td>$<?php echo number_format($mis_servicios["p_jovenes"],2,".",",");?></td></tr>
             <tr><td>NIÑOS</td><td align="right"><?php echo $ninos;?></td><td>$<?php echo number_format($mis_servicios["p_ninos"],2,".",",");?></td></tr>
             <tr><td>TOTAL</td><td align="right"><?php echo $t_comensales; ?></td><td></td></tr>
         </table>
    </div>
    <div class="col-md-3 col-sm-12" align='left'>
        <b><?php  
			$cha=explode(',',$mis_servicios['comentario_H_A']);
			for($chai=0;$chai<count($cha);$chai++){
				echo "º ".$cha[$chai].".<br>";
			}
			?></b>
    </div>
    <div class="col-md-3 col-sm-12" >
        <h2>Observaciones</h2>
        <textarea id="observaciones_logistica" rows="15" cols="25" onchange="observaciones_logistica()" style=" text-indent: 0px;"><?php echo $mis_servicios['observaciones_logistica'];?>
        </textarea>
    </div>
    <div class="col-md-3 col-sm-12" >
    </div>
</div><!-- /.row -->
    
    
    
<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >SERVICIOS</h1>
    </div>
</div><!-- /.row -->
     
    
    <div class="row" align='center'>
        <div class="col-md-1 col-sm-12" >
            <button id="H_A" type="button" class="btn btn-default btn-lg">
              <span id='1' class="glyphicon glyphicon glyphicon-menu-down" aria-hidden="true"></span>
              <span id='2' class="glyphicon glyphicon glyphicon-menu-up" style="display:none;" aria-hidden="true"></span>
            </button>
        </div>
        <div class="col-md-3 col-sm-12" id="hoja_anexa" style="display:none;">
          <h1>HOJA ANEXA</h1><br>
            <?php
                for($k=0;$k<count($default);$k++){
                    $opcionales=explode(",",$default[$k]);
                    if(count($opcionales)>1 &&  $opcionales[1]!=''){ 
                        echo "<select onchange='cambio_servicio(this.value)'>";
                        for($f=0;$f<count($opcionales);$f++){
                            $s1=explode("-",$opcionales[$f]);
                            $serv=mysql_fetch_array(mysql_query("select * from Servicios where id=".$s1[0]));
                            echo "<option value='".$k."_".$f."'>".$serv["Servicio"]."</option>";
                        }
                        echo "</select>.<br>"; 
                    }else{
                        $s1=explode("-",$default[$k]);
                        $serv=mysql_fetch_array(mysql_query("select * from Servicios where id=".$s1[0]));
                        /////validamos la categoria hora y piezas
                        $ext10=explode("/",$s1[1]);
                        $ext11="";
                        if(count($ext10)>1){
                            $ext11=$ext10[0]."pzas/".$ext10[1]."hrs";
                        }
                        echo "<b>".$serv["Servicio"].$ext11."</b>.<br>";
                    }
                }
            ?>
        </div>
         <div class="col-md-3 col-sm-12" id="regalados" style="display:none;">
          <h1>INCLUIDOS</h1>
            <?php
                ////creamos el arreglo de regalados 
                for($i=0;$i<count($info);$i++){
                    ////////eliminamos el id
                    $z1=explode("_",$info[$i]);
                    $z2=explode(";",$z1[1]); 
                     
                    for($a=0;$a<count($z2);$a++){
                        $z3=explode(",",$z2[$a]);
                        ///validacion para saber si el servicio fue gratis
                        if($z3[2]==0){
                            ////validamos si es uno del tipo hora piezas
                            $hps=explode("/",$z3[1]);
                            if(count($hps)>1){
                                if(isset($REG[$z3[0]])){
                                    $sum_hps=explode("/",$REG[$z3[0]]);
                                    $numerador=$hps[0]+$sum_hps[0];
                                    $divisor=$hps[1]+$sum_hps[1];
                                    $REG[$z3[0]]=$numerador."/".$divisor;
                                }else{
                                    $REG[$z3[0]]=$z3[1];
                                }
                            }else{
                                if(isset($REG[$z3[0]])){
                                    $REG[$z3[0]]=$REG[$z3[0]]+$z3[1];
                                }else{
                                    $REG[$z3[0]]=$z3[1];
                                }
                            }
                        }
                    } 
                   // echo $info[$i]."<br>"; 
                }
                //print_r($REG) ;

                foreach ($REG as $servicio=>$horas){
                    if($servicio!=''){
                        $is=mysql_fetch_array(mysql_query("select * from Servicios where id=".$servicio));
                        if($is['unidad']=="HORA Y PIEZAS"){
                            $ext20=explode("/",$horas);
                            echo $is['Servicio'].$ext20[0]."pzas/".$ext20[1]."hrs<br>";
                        }elseif($horas>0){
                            
                            echo $is['Servicio']." por ".$horas." ".$is['unidad']."<br>";
                        }else{
                             echo $is['Servicio']."<br>";
                        }
                    }
                }
             ?>
        </div>
         <div class="col-md-3 col-sm-12" id="adicionales" style="display:none;" > 
          <h1>ADICIONALES</h1>
            <?php
                ////creamos el arreglo de regalados
                for($i=0;$i<count($info);$i++){
                    ////////eliminamos el id
                    $z1=explode("_",$info[$i]);
                    $z2=explode(";",$z1[1]); 
                     
                    for($a=0;$a<count($z2);$a++){
                        $z3=explode(",",$z2[$a]);
                        ///validacion para saber si el servicio fue gratis 
                        if($z3[2]>0){
                            /////validacion de la categoria hora y piezas
                             $hps=explode("/",$z3[1]);
                            if(count($hps)>1){
                                if(isset($PAG[$z3[0]])){
                                    $sum_hps=explode("/",$PAG[$z3[0]]);
                                    $numerador=$hps[0]+$sum_hps[0]; 
                                    $divisor=$hps[1]+$sum_hps[1];
                                    $PAG[$z3[0]]=$numerador."/".$divisor;
                                }else{
                                    $PAG[$z3[0]]=$z3[1];
                                }
                            }else{
                                if(isset($PAG[$z3[0]])){
                                    $PAG[$z3[0]]=$PAG[$z3[0]]+$z3[1];
                                }else{
                                    $PAG[$z3[0]]=$z3[1];
                                }
                            }
                        }///fin if z3>0
                    } 
                   // echo $info[$i]."<br>"; 
                }
                //print_r($REG);

                foreach ($PAG as $servicio=>$horas){
                    if($servicio!=''){
                        $is=mysql_fetch_array(mysql_query("select * from Servicios where id=".$servicio));
                        if($is['unidad']=="HORA Y PIEZAS"){
                            $ext30=explode("/",$horas);
                            echo $is['Servicio'].$ext30[0]." pzas y ".$ext30[1]."hrs<br>";
                        }elseif($horas>0){
                            echo $is['Servicio']." para ".$horas." ".$is["unidad"]."<br>";
                        }else{
                             echo $is['Servicio']."<br>";
                        }
                    }
                }
             ?>
        </div>
    </div>
    
    
<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >ASIGNACION</h1>
    </div>
</div><!-- /.row -->  
    
<div class="row">
    <div class="col-md-1 col-sm-12" >
    </div>
    <div class="col-md-5 col-sm-12" align='center' >
        <form action='Cargos.php' method='POST'>
        <input type='hidden' name='campo' value='<?php echo $_GET['numero']; ?>'>
        <input type='hidden' name='categoria' value='Servicios'>
        <input type='hidden' name='logistica' value='logistica'>
        <input type='hidden' name='submit' value='Enviar'>
        <button class='myButton'>
        Agregar Servicio
        </button>
        </form> 
        <br>
        <form action='Cargos.php' method='POST'>
        <input type='hidden' name='campo' value='<?php echo $_GET['numero']; ?>'>
        <input type='hidden' name='categoria' value='Cargo de Comensales'>
        <input type='hidden' name='logistica' value='logistica'>
        <input type='hidden' name='submit' value='Enviar'>
        <button class='myButton'>
        Agregar Comensales
        </button>
        </form> 
        <?php
                 
            /////validar los servicios de recepcion y comida asignados
            
            $renta=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
            $r_renta=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$renta['id']));

            
            $s_com=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RECEPCION'"));
            $r_com=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$s_com['id']));


            $s_food=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='COMIDA'"));
            $r_food=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['numero']."' and servicio=".$s_food['id']));

            $style_t="";
            if(isset($r_renta['id'])){
                if(isset($r_com["id"])){
                    if(isset($r_food["id"])){
                             $style_t="block";
                     }else{
                        $aux2="'".$s_food["id"]."'";
                        echo ' <button type="button" class="btn btn-warning" onclick="mod_hora_comida('.$aux2.')">Se debe de registrar primero la hora de entrega de platillos</button>';
                        $style_t="none";
                     }
            }else{
                $aux1="'".$s_com["id"]."','9'"; 
                echo ' <button type="button" class="btn btn-warning" onclick="insertar('.$aux1.')">Se debe de registrar primero la hora de recepcion</button>';
                $style_t="none";
             }
            }else{ 
                echo ' <div style="background:orange;color:#000;">
                Ingrese la  hora de finalizacion
                <form method="POST" action="logistica_form.php">
                FECHA<input type="date" name="fecha" min="'.$mis_servicios['Fecha'].'"required><br>
                HORA<input type="time" name="hora" required>
                <input type="hidden" name="contrato" value="'.$_GET['numero'].'">
                <input type="hidden" name="code" value="fin">
                <br>
                <input style="background:#848484;"type="submit" name="enviar" value="Guardar">
                </form>
                </div>';
                $style_t="none";
            }
            
                 
            //print_r($servicios);
            ///////////////servicios
            $part=explode("-",$r_com['fecha_i']);
            $fecha_inicio=$part[2]."/".$part[1]."/".$part[0];
             echo "<br><br><table border='6'  bordercolor='#990000' style='display:".$style_t.";'>";
            echo "<tr><th>Tipo</th><th>Servicio</th><th>Total de Horas</th><th>Restantes</th><th>Asignadas</th><th>Insertar o<br> Modificar</th></tr>";
            ///obtenemos los datos de la recepcion
            echo "<tr><td rowspan='2'></td><td rowspan='2'><small>Renta de instalaciones</small></td><td>De</td>
            <td>".$fecha_inicio."</td>
            <td>".$r_com['hora_i']."</td> 
            <td><button class='myButton' onclick='insertar(".$s_com["id"].",9)'><small>Modificar</small></button></td></tr>";
            $datos_fecha=explode('-',$r_renta['fecha_f']);
			echo "<tr><td>Hasta</td>
            <td>".$datos_fecha[2]."/".$datos_fecha[1]."/".$datos_fecha[0]."</td>
            <td>".$r_renta['hora_f']."</td>
            <td><button class='myButton' onclick='mod_hora_final()'><small>Modificar</small></button></td></tr>";
			
			//////bloque de informacion de comida
			$servicios[$s_food['id']]=5;
			$t_comida=mysql_fetch_array(mysql_query("select sum(tiempo) as t from logistica where numero='".$_GET["numero"]."' and servicio=".$s_food['id']));
            
			echo "<tr><td>HORA INICIO Y TERMINO</td><td>COMIDA</td><td align='center'>".$t_comida["t"]."</td><td></td><td align='center'>".$t_comida["t"]."</td>";
			echo "<td><button class='myButton' onclick='mod_hora_comida(".$s_food["id"].")'><small>Modificar</small></button></td></tr>";
            foreach ($servicios as $i => $value) {
                $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));	
                $ts=mysql_fetch_array(mysql_query("select * from Servicios_categorias where id=".$q['tipo']));	
                
               if($q['tipo']!=$renta_2['tipo'] && $q['tipo']!=3){
                if($servicios[$i]!=''){
                    if($q['unidad']=='PIEZA' ){
                        echo "<tr><td><small>COMENSAL O PIEZAS</small></td><td><small>".$q['Servicio']."</small></td><td align='center' colspan='4'> cantidad de piezas ".$servicios[$i]."</td></tr>";
                    }elseif($q['unidad']=='ILIMITADA'){
                         echo "<tr><td><small>".$ts['nombre']."</small></td><td><small>".$q['Servicio']."</small></td><td align='center' colspan='4'>SERVICIO ILIMITADO</td></tr>";
                    }elseif($q['unidad']=='HORA Y PIEZAS'){
                        
                        $log=mysql_fetch_array(mysql_query("select sum(tiempo) as t from logistica where numero='".$_GET['numero']."' and servicio=".$i));
                        $sub=explode("/",$servicios[$i]);
                        $sob=$sub[1]-$log['t'];
                       $aux='"'.$i.'","'.$sub[1].'"';
                         echo "<tr><td><small>".$ts['nombre']."</small></td><td><small>".$q['Servicio']."</small></td>
                         <td>".$sub[0]."pzas X ".$sub[1]." horas</td>
                         <td align='center'>".$sob."</td>
                         <td align='center'>".$log['t']."</td> 
                         <td><button class='myButton' onclick='insertar2(".$aux.")'><small>Modificar</small></button></td> 
                         </tr>";
                    }else{
                        $aux='"'.$i.'","'.$servicios[$i].'"';
                    $log=mysql_fetch_array(mysql_query("select sum(tiempo) as t from logistica where numero='".$_GET['numero']."' and servicio=".$i));
                    $sob=$servicios[$i]-$log['t'];
                    echo "<tr><td>".$ts['nombre']."</td><td><small>".$q['Servicio']."</small></td><td align='center'>".$servicios[$i]."</td><td align='center'>".$sob."</td><td align='center'>".$log['t']."</td><td><button class='myButton' onclick='insertar2(".$aux.")'><small>Modificar</small></button></td></tr>";
                    }
                    
                }else{
                
                    if($q['unidad']=="NO APLICA"){
                         echo "<tr><td>".$ts['nombre']."</td><td>".$q['Servicio']."</td><td align='center' colspan='4' ONCLICK='alert()'><button class='myButton'>Generar logistica</button</td></tr>";
                    
                    }
                }
            }
            }
            echo "</table>";
        echo "</div>";

        /////////////actividades
        echo "<div class='col-md-4 col-sm-12' align='center'>";
        echo "<button class='myButton' onclick='crear_actividad()'>Agregar Actividad</button>";
            echo "<table border='6' bordercolor='#990000' >";
                echo "<tr><th>Actividad</th><th>Asignadas</th><th>Modificar</th><th>Eliminar</th></tr>";
                $actividades_q=mysql_query("select * from Actividades where numero='".$_GET['numero']."'");
                while($actividades=mysql_fetch_array($actividades_q)) {
                        echo "<tr><td>".$actividades['actividad']."</td><td align='center'>".$actividades['tiempo']."</td><td align='center'><button class='myButton' onclick='update_activity(".$actividades['id'].")'>Modificar</button></td><td align='center'><button class='myButton' onclick='delete_activity(".$actividades['id'].")'>Borrar</button></td></tr>";

                }
                echo "</table>";
        echo "</div>";	
        ?>
</div><!-- /.row  --> 

    
    
    
<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >Manteleria y Equipo</h1>
    </div>
</div><!-- /.row -->  
    
    
 <div class="row">
     <!-- Manteleria -->
     <div class="col-sm-3" align='center' >
	  <?php

                  ////VALIDAMOS LA EXISTENCIA DE MANTELERIA
                if(isset($servicios[215])){
                    ?>
      <h1 >Manteleria</h1>
         <table align="center" border="2"> 
             <tr><th>Cantidad</th><th>Mantel</th><th></th></tr>
         <?php
            foreach ($servicios as $i => $value) {
                $iq=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));
                if($iq['tipo']==3){
                    echo "<tr><td>".$value."</td><td>".$iq['Servicio']."</td>
                    <td><button onclick='borrar_equipo(".$i.")' type='button' class='btn btn-danger'><small>x</small></button></td></tr>";
                }
            }
         ?>
         </table> 
         <br><br>
         <input style="width:50px;" type="number" id="cantidad_manteleria">
         <select style="width:200px;" id="opcion_manteleria" onchange="valida_cantidad(this.value,'manteleria')">
            <option></option>
             <?php
                $manteles=mysql_query("select * from Servicios where tipo=3 order  by Servicio");
                while($mantel=mysql_fetch_array($manteles)){
                    echo "<option value='".$mantel['id']."'><small>".$mantel['Servicio']."</small></option>";
                }
             ?>
         </select><br>
         <button class="btn btn-success" onclick="guardar_equipo('manteleria')">Guardar</button><br>
         <p id="inv_manteleria"></p>
		 <?php
				}
		 ?>
    </div>
     
     <!--Equipo-->
     <div class="col-sm-3" align='center' >
          <?php
                  ////VALIDAMOS LA EXISTENCIA DE TEMATICA
                if(isset($servicios[212])){
                    ?>
      <h1 >Mobiliario</h1>
         <table align="center" border="2"> 
             <tr><th>Cantidad</th><th>Mobiliario</th><th></th></tr>
         <?php
            foreach ($servicios as $i => $value) {
                $iq=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));
                if($iq['tipo']==32){
                    echo "<tr><td>".$value."</td><td>".$iq['Servicio']."</td>
                    <td><button onclick='borrar_equipo(".$i.")' type='button' class='btn btn-danger'><small>x</small></button></td></tr>";
                }
            }
         ?>
         </table>
         <br><br>
         <input style="width:50px;" type="number" id="cantidad_mobiliario">
         <select style="width:200px;" id="opcion_mobiliario" onchange="valida_cantidad(this.value,'mobiliario')">
            <option></option>
             <?php
                $manteles=mysql_query("select * from Servicios where tipo=32  order  by Servicio");
                while($mantel=mysql_fetch_array($manteles)){
                    echo "<option value='".$mantel['id']."'><small>".$mantel['Servicio']."</small></option>";
                }
             ?>
         </select><br>
         <button class="btn btn-success" onclick="guardar_equipo('mobiliario')">Guardar</button><br>
         <p id="inv_mobiliario"></p>
         <?php } ?>
    </div>
     
     <!--Pewter-->
     <div class="col-sm-3" align='center' >
       <?php
                  ////VALIDAMOS LA EXISTENCIA DE PEWTER
                if(isset($servicios[213])){
                    ?>
         <h1 >Pewter</h1>
         <table align="center" border="2"> 
             <tr><th>Cantidad</th><th>Pewter</th><th></th></tr>
         <?php
            foreach ($servicios as $i => $value) {
                $iq=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));
                if($iq['tipo']==33){
                    echo "<tr><td>".$value."</td><td>".$iq['Servicio']."</td>
                    <td><button onclick='borrar_equipo(".$i.")' type='button' class='btn btn-danger'><small>x</small></button></td></tr>";
                }
            }
         ?>
         </table>
         <br><br>
         <input style="width:50px;" type="number" id="cantidad_pewter">
         <select style="width:200px;" id="opcion_pewter" onchange="valida_cantidad(this.value,'pewter')">
            <option></option>
             <?php
                $manteles=mysql_query("select * from Servicios where tipo=33  order  by Servicio");
                while($mantel=mysql_fetch_array($manteles)){
                    echo "<option value='".$mantel['id']."'><small>".$mantel['Servicio']."</small></option>";
                }
             ?>
         </select><br>
         <button class="btn btn-success" onclick="guardar_equipo('pewter')">Guardar</button><br>
         <p id="inv_pewter"></p>
         <?php } ?>
    </div>
     
     <!--Tematica-->
     <div class="col-sm-3" align='center' >
         <?php
                  ////VALIDAMOS LA EXISTENCIA DE TEMATICA
                if(isset($servicios[214])){
                    ?>
      <h1 >Tematica</h1>
         <table align="center" border="2"> 
             <tr><th>Cantidad</th><th>Tematica</th><th></th></tr>
         <?php

            foreach ($servicios as $i => $value) {
                $iq=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));
                if($iq['tipo']==34){
                    echo "<tr><td>".$value."</td><td>".$iq['Servicio']."</td>
                    <td><button onclick='borrar_equipo(".$i.")' type='button' class='btn btn-danger'><small>x</small></button></td></tr>";
                }
            }
         ?>
         </table>
         <br><br>
         
         <input style="width:50px;" type="number" id="cantidad_tematica">
         <select style="width:200px;" id="opcion_tematica" onchange="valida_cantidad(this.value,'tematica')">
            <option></option>
             <?php
                  ////VALIDAMOS LA EXISTENCIA DE TEMATICA
                if(isset($servicios[214])){
                    $manteles=mysql_query("select * from Servicios where tipo=34  order  by Servicio");
                    while($mantel=mysql_fetch_array($manteles)){
                        echo "<option value='".$mantel['id']."'><small>".$mantel['Servicio']."</small></option>";
                    }
                }            
             ?>
         </select><br>
         <button class="btn btn-success" onclick="guardar_equipo('tematica')">Guardar</button><br>
         <p id="inv_tematica"></p>
         <?php }?>
    </div>
     
</div><!-- /.row  -->     
   
    
    
    
    
    
<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >CRONOGRAMA</h1>
    </div>
</div><!-- /.row -->  

<div class="row">
   <div class="col-sm-12" align='center'>
       <button class='myButton' onclick='imp()'>
        Imprimir Cronograma
        </button>
        <br><br>
       <?php
       $c1=mysql_fetch_array(mysql_query("select count(*) as t from logistica where numero='".$_GET['numero']."'"));
       $c2=mysql_fetch_array(mysql_query("select count(*) as t from Actividades where numero='".$_GET['numero']."'"));
        $c3=$c1['t']+$c2['t']+$xyz;       ?>
       <div id="example5.2" style="height:<?php echo $c3*55;?>px;"></div>
    </div>
</div><!-- /.row -->  
    
    
<div class="row">
    <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
      <h1 >ASIGNACION</h1>
    </div>
</div><!-- /.row --> 
    
    
<div class="row">
    <div class="col-sm-12" align='center'>
    
    </div>
    <div class="col-sm-12 col-md-5" align='center'>
            <div id="comesalales">     
            <table border='6' bordercolor='#990000' >
                <tr><th colspan='2' style='text-align:center;'>COMENSALES</th></tr>
                <tr><td>TOTAL DE COMENSALES</td><td><?php echo $t_comensales;?></td></tr>
                <tr><td>ADULTOS</td><td><input type='number' id='adultos' name='adultos'  value="<?php echo $adultos;?>"  onchange='valida_comensales()'/></td></tr>
                <tr><td>JOVENES</td><td><input type='number' id='jovenes' name='jovenes'  value="<?php echo $jovenes;?>"  onchange='valida_comensales()'/></td></tr>
                <tr><td>NIÑOS</td><td><input type='number' id='ninos' name='ninos'  value="<?php echo $ninos;?>" onchange='valida_comensales()'/></td></tr>
                <tr><td>TOTAL ASIGNADOS</td><td><p id="tc"></p></td></tr>
            </table>
        </div>
    </div>
    <div class="col-sm-12 col-md-5" align='center'>
        <div id='alerta_comensales' class="alert alert-danger" role="alert">No se han asignado todos los comensales</div>
        <br>
        <label>ASIGNAR </label>
    <select id='tipo_comensal' id='tipo_comensal' onchange='valida_comensales2()'>
        <option value='adultos'>Adultos</option>
        <option value="jovenes">Jovenes</option>
        <option value="ninos">Niños</option>
    </select> 
       <input type='number' id='cc' name='cantidad'  onkeyup='valida_comensales2()' onchange='valida_comensales2()' placeholder='CANTIDAD'/>
      <input type="text" id="nombre_menu" placeholder="NOMBRE DE MENU">
        <br><br> 
    <button id='generar_menu' disabled='true' onclick="menus()" type="button" class="btn btn-primary">Elegir Menu</button>
    </div>
</div><!-- /.row --> 
 
    

<div class="row" style="margin-bottom:">
  <div class="page-header" style="text-align:center;background:#585858;color:#fff;">
  <h1>MENU</h1>
</div>
</div><!-- /.row -->
    
    
    <div id="MENU">
     
  </div>
    
    


    
    
<script type="text/javascript">
    var ha=0;
    $('#H_A').click(function(){
        if(ha==0){
            $("#1").hide();
            $("#2").show();
             $('#hoja_anexa').slideDown();
             $('#regalados').slideDown();
             $('#adicionales').slideDown();
            ha=1;
        }else{
            $("#2").hide();
            $("#1").show();
            $('#hoja_anexa').slideUp();
            $('#regalados').slideUp();
            $('#adicionales').slideUp();
            ha=0;
        }
    }
    );

    
    
    
    /////////////obtenemos la cantidad de comensales por asignar
    
        
    
    
    
    
    
    
    var total_c=<?php echo $t_comensales;?>;
    var adultos=<?php echo $adultos;?>;
    var jovenes=<?php echo $jovenes;?>;
    var ninos=<?php echo $ninos;?>;
    
    
    function valida_comensales2(){
        op=document.getElementById("tipo_comensal").value;
        cant=parseInt(document.getElementById(op).value);
        asig=parseInt(document.getElementById("cc").value);
        if(op=='adultos'){
            cant=cant-adultos_asignados;
        }
        if(op=='jovenes'){
            cant=cant-jovenes_asignados;
        }
        if(op=='ninos'){
            cant=cant-ninos_asignados;
        }
        
        
        if(asig>0){
            if(asig<=cant){
                document.getElementById("generar_menu").disabled=false;
            }else{
                 document.getElementById("generar_menu").disabled=true;
                document.getElementById("cc").value='';
                alert("ERROR Los comensales restantes por asignar son "+cant);
            }
        }
    }
    
    
    function valida_comensales(){
        a1=document.getElementById("adultos").value;
        a2=document.getElementById("jovenes").value;
        a3=document.getElementById("ninos").value;
        all=(a1*1)+(a2*1)+(a3*1);
        
        /////////////validamos que los numeros sean mayores a 0
        if(a1>=0 && a2>=0 && a3>=0){
            /////validamos que el total de comesales asignados no sea mayor al total de comensales 
            if(all>total_c){
                alert("Error no se pueden asignar más de <?php echo $t_comensales;?>  comensales");
                document.getElementById("adultos").value=adultos_asignados;
                document.getElementById("jovenes").value=jovenes_asignados;
                document.getElementById("ninos").value=ninos_asignados;
                xyz=parseInt(adultos_asignados)+parseInt(jovenes_asignados)+parseInt(ninos_asignados);
                document.getElementById("tc").innerHTML = xyz;
            }else if(all==total_c){
               // alert("Se han asignado todos los comensales");
                /////validamos los asignados
                if(a1<adultos_asignados){
                   alert("Error la cantidad asignada minima debe de ser "+adultos_asignados);
                    document.getElementById("adultos").value=parseInt(adultos_asignados);
                }
                if(a2<jovenes_asignados){
                   alert("Error la cantidad asignada minima debe de ser "+jovenes_asignados);
                    document.getElementById("jovenes").value=jovenes_asignados;
                }
                if(a3<ninos_asignados){
                    alert("Error la cantidad asignada minima debe de ser "+ninos_asignados);
                    document.getElementById("ninos").value=ninos_asignados;
                }
                a1=document.getElementById("adultos").value;
                a2=document.getElementById("jovenes").value;
                a3=document.getElementById("ninos").value;
                all=(a1*1)+(a2*1)+(a3*1);
                document.getElementById("tc").innerHTML = all;
            }else{
                /////validamos los asignados
                if(a1<adultos_asignados){
                   alert("Error la cantidad asignada minima debe de ser "+adultos_asignados);
                    document.getElementById("adultos").value=parseInt(adultos_asignados);
                }
                if(a2<jovenes_asignados){
                   alert("Error la cantidad asignada minima debe de ser "+jovenes_asignados);
                    document.getElementById("jovenes").value=jovenes_asignados;
                }
                if(a3<ninos_asignados){
                    alert("Error la cantidad asignada minima debe de ser "+ninos_asignados);
                    document.getElementById("ninos").value=ninos_asignados; 
                }
                a1=document.getElementById("adultos").value;
                a2=document.getElementById("jovenes").value;
                a3=document.getElementById("ninos").value;
                all=(a1*1)+(a2*1)+(a3*1);
                document.getElementById("tc").innerHTML = all;
            }
        }else{
            alert("Error la cantidad asignada de comensales debe de ser mayor a 0");
        }
    }
    
    
    
    
function imp()
{
	var ficha=document.getElementById("example5.2");
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}
    function crear_actividad(){
       // alert(total_c);
        window.open("popupLogisticaA.php?contrato=<?php echo $_GET['numero']?>&op=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
    }
    function delete_activity(i){
		if(confirm("¿Esta seguro de eliminar la actividad?")){
			window.open("popupLogisticaA.php?contrato=<?php echo $_GET['numero']?>&op=borrar&id="+i, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
		}
         
    }
    function update_activity(i){
         window.open("popupLogisticaA.php?contrato=<?php echo $_GET['numero']?>&op=modificar&id="+i, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
    }
    function info(tiempo,val){
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById(tiempo).innerHTML = xmlhttp.responseText;
			}
		}
	xmlhttp.open("POST","info_platillo.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+val);
    }
    
    function menus(){
    tipo=document.getElementById("tipo_comensal").value;
    cantidad=parseInt(document.getElementById("cc").value);
    menu_name=document.getElementById("nombre_menu").value;
        if(menu_name!=''){
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                /////validamos que no exista el error del nombre
                if(xmlhttp.responseText=='Error en el nombre'){
                    alert("Error no se pueden poner el mismo nombre a dos menus");
                }else{
                     if(tipo=='adultos'){
                        adultos_asignados=adultos_asignados+cantidad;
                    }
                    if(tipo=='jovenes'){
                        jovenes_asignados=jovenes_asignados+cantidad;
                    }
                    if(tipo=='ninos'){
                        ninos_asignados=ninos_asignados+cantidad;
                    }
                    document.getElementById("cc").value='';
                    document.getElementById("MENU").innerHTML = xmlhttp.responseText;
                }
			}
		}
	xmlhttp.open("POST","mi_menu.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("contrato=<?php echo $_GET['numero'];?>&op=agregar&tipo="+tipo+"&cantidad="+cantidad+"&name="+menu_name);
        }else{
            alert("Error debe de agregar un nombre al menu");
        }
    }
     function mostrar_menu(){
         ///validamos los comensales para ver si es que ya se asignron todos 
         
         if(total_c==(adultos_asignados+jovenes_asignados+ninos_asignados)){
             document.getElementById("alerta_comensales").style.display = "none";
         }else{
            document.getElementById("alerta_comensales").style.display = "block";
         }
         
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("adultos").value=parseInt(adultos_asignados);
                document.getElementById("jovenes").value=parseInt(jovenes_asignados);
                document.getElementById("ninos").value=parseInt(ninos_asignados);
                all=parseInt(adultos_asignados)+parseInt(jovenes_asignados)+parseInt(ninos_asignados);
                document.getElementById("tc").innerHTML = all;
                document.getElementById("MENU").innerHTML = xmlhttp.responseText;
			}    
		}
	xmlhttp.open("POST","mi_menu.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("contrato=<?php echo $_GET['numero'];?>");
    }
    
     function buscar(val,id){
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("subcategoria-"+id).innerHTML = xmlhttp.responseText;
			}
		}
	xmlhttp.open("POST","logistica_buscar.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("type=categoria&val="+val+"&menu="+id);
    }
    
     function buscar2(val,id){
       var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("platillo-"+id).innerHTML = xmlhttp.responseText;
                document.getElementById("ag_pl-"+id).style.display = 'block';
			}
		}
	xmlhttp.open("POST","logistica_buscar.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("type=subcategoria&val="+val+"&menu="+id);
    }
    
    function eliminar_menu(id){
        if(confirm("Esta seguro de eliminar el menu")){
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        var str = xmlhttp.responseText;
                        var res = str.split(";");
                        adultos_asignados=res[0]*1;
                        jovenes_asignados=res[1]*1;
                        ninos_asignados=res[2]*1;
                        mostrar_menu();

                    }
                }
            xmlhttp.open("POST","logistica_buscar.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("type=borrar&id="+id);
        }
    }
    
    function agregar_platillo(id){
        // alert("<?php echo $_GET['numero']?> "+id);
        cat=document.getElementById("category-"+id).value;
        subcat=document.getElementById("subcategory-"+id).value;
        platillo=document.getElementById("platillos-"+id).value;
         var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
         }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    if(xmlhttp.responseText!=''){
                        alert("Error no se puede reasignar este platillo en el mismo menu");
                    }else{
                        mostrar_menu();
                    }
                }
            }
        xmlhttp.open("POST","logistica_buscar.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("type=agregar_platillo&id="+id+"&platillo="+platillo);
    }
    
    function borrar_platillo(indice,id_menu){
        //alert(indice+" "+id_menu);
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
         }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    
                     mostrar_menu();
                }
            }
        xmlhttp.open("POST","logistica_buscar.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("type=borrar_platillo&id="+id_menu+"&platillo="+indice);
    }
    
    function add_one(id,tipo_comensal){ 
        cantidad=prompt("Cuantos comensales desea agregar");
        if(cantidad==null || cantidad<=0 || isNaN(cantidad)){
            alert("La cantidad de comensales debe de ser mayor a 0");
            return;
        }
       
       var marcador=0;
        if(tipo_comensal==1){////////////validamos si es adulto
            x=parseInt(document.getElementById("adultos").value);
            if((parseInt(adultos_asignados)+parseInt(cantidad))<=x){
                marcador=1;
            }
        }else if(tipo_comensal==2){////////////validamos si es joven
            x=parseInt(document.getElementById("jovenes").value);
            if((parseInt(jovenes_asignados)+parseInt(cantidad))<=x){
                marcador=1;
            }
        }else{//////////si no es de los tipos anteriores es un niño
            x=parseInt(document.getElementById("ninos").value);
            if((parseInt(ninos_asignados)+parseInt(cantidad))<=x){
                marcador=1;
            }
        }
       
        if(marcador==1){
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                         if(tipo_comensal==1){
                            adultos_asignados=parseInt(adultos_asignados)+parseInt(cantidad);
                         }else if(tipo_comensal==2){
                            jovenes_asignados=parseInt(jovenes_asignados)+parseInt(cantidad);
                         }else{
                            ninos_asignados=parseInt(ninos_asignados)+parseInt(cantidad);
                         }
                         mostrar_menu();
                    }
                }
            xmlhttp.open("POST","logistica_buscar.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("type=add_one&id="+id+"&cant="+cantidad);
        }else{
            alert("No se pueden agregar comensales si no son asignados anteriormente");
        }
    }
    
    function remove_one(id,tipo_comensal){
        cantidad=prompt("Cuantos comensales desea eliminar");
        if(cantidad==null || cantidad<=0 || isNaN(cantidad)){
            alert("La cantidad de comensales debe de ser mayor a 0");
            return;
        }

            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                        if(xmlhttp.responseText=='Error'){
                            alert("Error no se puede eliminar la cantidad especificada");
                        }else{
                            if(tipo_comensal==1){
                                adultos_asignados=parseInt(adultos_asignados)-parseInt(cantidad);
                             }else if(tipo_comensal==2){
                                jovenes_asignados=parseInt(jovenes_asignados)-parseInt(cantidad);
                             }else{
                                ninos_asignados=parseInt(ninos_asignados)-parseInt(cantidad);
                             }
                             mostrar_menu();
                        }
                    }
                }
            xmlhttp.open("POST","logistica_buscar.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("type=remove_one&id="+id+"&cant="+cantidad);
       
    }
    
    function nombre_festejado(){
        var f=document.getElementById("festejado").value;
     var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                        if(xmlhttp.responseText=='Error'){
                            alert(xmlhttp.responseText);
                        }else{
                            document.getElementById("festejado").value=f;
                        }
                    }
                }
            xmlhttp.open("POST","logistica_buscar.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("type=festejado&nombre="+f+"&contrato=<?php echo $_GET['numero'];?>");
    
    } 
    function cambio_servicio(id){
        //alert(id);
         var xmlhttp; 
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                        if(xmlhttp.responseText=="Error"){
                            alert("Error al cambiar el servicio de la hoja anexa");
                        }else{
                            location.reload();
                        }
                    }
                }
            xmlhttp.open("POST","logistica_buscar.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("type=cambio-servicio&ids="+id+"&contrato=<?php echo $_GET['numero'];?>");
    }
    
  function insertar(id,hrs){
    window.open("logistica_form.php?id="+id+"&code=modificar_recepcion&contrato=<?php echo $_GET['numero']?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
}
  function insertar2(id,hrs){
    window.open("popupLogistica.php?id="+id+"&hrs="+hrs+"&contrato=<?php echo $_GET['numero']?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
}
function mod_hora_final(){
	<?php
		$rentaxcx=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
	?>
	window.open("logistica_form.php?id=<?php echo $rentaxcx['id'];?>&code=modificar&contrato=<?php echo $_GET['numero']?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
}

    function valida_cantidad(x,tipo){
        //num=document.getElementById("cantidad").value;
         // alert(num+" "+x);
         var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                //////dividimos la cadena recibida para substraer el tipo de metrica y su precio
                recibido=xmlhttp.responseText;
                recibido2=recibido.split(",");
				document.getElementById("inv_"+tipo).innerHTML =recibido2[2];
                
			}
		}
	xmlhttp.open("POST","aux_servicios.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+x+"&code=11&contrato=<?php echo $_GET['numero'];?>");  
      }
    
    function guardar_equipo(tipo){
         num=document.getElementById("cantidad_"+tipo).value;
        
        if(num>0 && num!=''){
            op=document.getElementById("opcion_"+tipo).value;
            agregar_equipo(op,num);
        }else{
            alert("Error la cantidad debe de ser mayor a 0");
        }
        
    }
    function agregar_equipo(op,num){
        var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                //////dividimos la cadena recibida para substraer el tipo de metrica y su precio
                //alert(xmlhttp.responseText);
                location.reload();
                
			}
		}
	xmlhttp.open("POST","logistica_equipo.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+op+"&op=agregar&cantidad="+num+"&contrato=<?php echo $_GET['numero'];?>");  
        
    }
    
    
    
    
    function observaciones_logistica(){
    obs=document.getElementById("observaciones_logistica").value;
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                
			}
		}
	xmlhttp.open("POST","logistica_equipo.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("op=observaciones&str="+obs+"&contrato=<?php echo $_GET['numero'];?>");  
    }
    
    function modificar_menu(id){
    name=prompt("Esccriba el nuevo nombre del menu");
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                mostrar_menu();
			}
		}
	xmlhttp.open("POST","logistica_equipo.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("op=menu&str="+name+"&id="+id); 
        
    }
    function borrar_equipo(id){
        if(confirm("Esta seguro de eliminarlo")){
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        location.reload();
                    }
                }
            xmlhttp.open("POST","logistica_equipo.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("op=borrar_equipo&id="+id+"&contrato=<?php echo $_GET['numero']?>");
        } 
    }
	 function mod_hora_comida(id){
		window.open("logistica_form.php?contrato=<?php echo $_GET['numero']?>&code=modificar_comida&id="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=600, height=400");
    }
</script>
</body>

</html>
