<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
validarsesion();
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
global $si;
?>
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
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

   </style>
	
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">


<script>
<?php
conectar(); 
$c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));  $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
?>

shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
c=document.getElementById("facturado");
//alert("fac");
c.value="si";
});

shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
c=document.getElementById("facturado");
//alert("no fac");
c.value="no";
});

function errorimp(){
	alert('ERROR YA SE HA IMPRESO EL CONTRATO')
}
function errorimp2(){
	alert('ERROR NO SE PUDE IMPRIMIR NO EXISTEN FECHAS')
}
</script>
<?php

function imprimir($n){
	$arreglo=explode('-',$n);
	$c_arreglo=count($arreglo);
	if($c_arreglo==1){
		$ef=mysql_query("select * from contrato where Numero='".$n."'");
		$mf=mysql_fetch_array($ef);
		if($mf['fechas']!=''){
			$var= "contratoPDF.php?numero=".$n;
		}else{
			$var='#';
		}
	}else{
		$ef=mysql_query("select * from subcontratos where numero like '%".$n."%'");
		$mf=mysql_fetch_array($ef);
		if($mf['fechas']!=''){
			$var= "subcontrato_PDF.php?numero=".$n;
			
		}else{
			$var='#';
		}
	}
	return $var;
}
function abrir($n){
	if(impreso($n)){
		$var='';
	}else{
		if(fechas($n)){
			$var= "target='_blank'";
		}else{
			$var='';
		}
	}
	return $var;
}

function sub_impreso($n){
	global $si;
	$si=false;
	$ef=mysql_query("select * from contrato where Numero like '".$n."-%'");
	while($mf=mysql_fetch_array($ef)){
		if($mf['impreso']=='si'){
			$var= "#";
			$si=true;
		}
	}
	if(!$si){
		$var='fechas_subcontrato.php?numero='.$n;
	}
	return $var;
}

function fechas($n){

	$arre=explode('-',$n);
	if(count($arre)==1){
		$ef=mysql_query("select * from contrato where Numero='".$n."'");
		$mf=mysql_fetch_array($ef);
		if($mf['fechas']==''){
			$var=false;
		}else{
			$var=true;
		}
	}else{
		$ef=mysql_query("select * from subcontratos where numero like '%".$n."%'");
		$mf=mysql_fetch_array($ef);
		if($mf['fechas']==''){
			$var=false;
		}else{
			$var=true;
		}

	}

	return $var;
}

function impreso($n){
		$ef=mysql_query("select * from contrato where Numero='".$n."'");
		$mf=mysql_fetch_array($ef);
		if($mf['impreso']=='si'){
			$var=true;
		}else{
			$var=false;
		}
		return $var;
}
function alerta(){
	global $si;
	$var='';
	if($si){
		$var="alert('Error ya se imprimio un subcontrato')";
	}
	return $var;
}

function tiene_sub($numero){
	$q=mysql_query("select count(*) as t from contrato where Numero like '".$numero."%'");
	$m=mysql_fetch_array($q);
	if($m['t']>1){
		$r=true;
	}else{
		$r=false;
	}
	return $r;
}



$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->


<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><br><h2><center>Modificar Contrato</center></h2></p>
<div class="wrapper wrapper-style4">	



<?php

$q="select * from contrato where Numero='".$_GET['numero']."'";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){
	if(validasubcontrato($_GET['numero']) && !isset($_GET['mcontrato'])){// valida si tiene subcontratos -> mostramos  listas de subcontratos
		$query="select * from contrato where Numero like ('".$_GET['numero']."%') ";
		$result=mysql_query($query);
		$comensales=0;
        ////validacion de impresion del contrato general
        if($m['impreso']=="si"){
            $msj98="'Error el contrato global ya fue impreso'";
            echo '<div id="style2"class="style2"><br><button onclick="alert('.$msj98.');">Agregar Sub-Contrato</button>';
        }else{
            if(date('Y-m-d')>$m['Fecha']){//////validacion de la fecha del contrato general
            $msj99="'Error el evento ya paso no se pueden agregar mⳠsubcontratos'";
            echo '<div id="style2"class="style2"><br><button onclick="alert('.$msj99.');">Agregar Sub-Contrato</button>';
            }else{
                echo '<div id="style2"class="style2"><br><a href="subcontratos.php?numero='.$_GET['numero'].'&op=agregar"><button>Agregar Sub-Contrato</button></a>';
            }
        }
        
		
        echo '<a href="'.sub_impreso($_GET['numero']).'"><button onclick="'.alerta().'">Generar Fechas</button></a>
		<input type="button" value="Ver informacion Gral" class="button" data-type="zoomin" /><br><br></div>';
		echo '<div id="style1"class="style1"><table>';
		echo '<tr><td>Sub Contrato</td><td>Nombre</td><td>Cancelar</td><td>Modificar</td><td>Imprimir</td></tr>';
		while($subcontrato=mysql_fetch_array($result)){
				$arreglo=explode('-',$subcontrato['Numero']);//obtenemos un arreglo apartir del numero de contrato y saber si mostramos el contrato general o no
				$c_arreglo=count($arreglo);
				if($c_arreglo==1){//validamos si vamos a modificar el contrato general y que no este impreso
					$delete="Config/EliminarContrato.php?numero=".$subcontrato['Numero'];
					$update="MSaldo.php?numero=".$subcontrato['Numero'].'&mcontrato=1';
					if(impreso($subcontrato['Numero'])){
						$print='error_impresio';
					}else{
						if(fechas($subcontrato['Numero'])){
							$print=imprimir($subcontrato['Numero']);
						}else{
							$print='No_hay_fechas';
						}
					}
					echo "<tr><td>".$subcontrato['Numero']."</td><td>".$subcontrato['nombre']."</td>";
					if($nivel==0 || $nivel==1){//validamos si es nivel 0 o 1}
						if(tiene_sub($subcontrato['Numero'])){
							echo "<td><button onclick='NOborrar()'>Cancelar</button></td>";
						}else{
							echo "<td><a href='".$delete."'><button>Cancelar</button></a></td>";
						}
					}else{
						echo "<td></td>";
					}
					echo "<td><a href='".$update."'><button>Modificar</button></a></td>";
					echo "<td>Se imprime desde fechas</td></tr>";
				}else{
					$delete="Config/EliminarContrato.php?numero=".$subcontrato['Numero'];
					$update="MSaldo.php?numero=".$subcontrato['Numero'].'&mcontrato=2';
					if(impreso($subcontrato['Numero'])){
						$print='error_impresio';
					}else{
						if(fechas($subcontrato['Numero'])){
							$print=imprimir($subcontrato['Numero']);
						}else{
							$print='No_hay_fechas';
						}
					}
					///////////////////////////define color de comite
					if($subcontrato['comite']=='si'){
						$color="bgcolor='#E8AFAF'";
					}else{
						$color="";
					}
					echo "<tr><td ".$color.">".$subcontrato['Numero']."</td><td ".$color.">".$subcontrato['nombre']."</td>";
					if($nivel==0 || $nivel==1){//validamos si es nivel 0 o 1}
						echo "<td ".$color."><a href='".$delete."'><button>Cancelar</button></a></td>";
					}else{
						echo "<td ".$color."></td>";
					}
					echo "<td ".$color."><a href='".$update."'><button>Modificar</button></a></td>";
				
					if($print=='error_impresio'){
						echo "<td ".$color."><button onclick='errorimp()'>Imprimir</button></td></tr>"; 
					}elseif($print=='No_hay_fechas'){
						echo "<td ".$color."><button onclick='errorimp2()'>Imprimir</button></td></tr>";
					}else{
						echo "<td ".$color."><a href='".$print."'  ".abrir($subcontrato['Numero'])."><button onclick='location.reload();'>Imprimir</button></a></td></tr>"; 
					}				
				}
			}
		echo '<table></div>';

	}else{//mostramos panel de modificacion
			if($m['impreso']=='si'){
				echo '<script>alert("Error no se puede modificar contrato ya ha sido impreso");</script>';
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=BuscarContrato.php">';

			}else{
				
				$consulta="select * from contrato where Numero='".$_GET['numero']."'";
				$resultado=mysql_query($consulta);
				$show=mysql_fetch_array($resultado);
				$t_adultos=$show['p_adultos']*$show['c_adultos'];
				$t_jovenes=$show['p_jovenes']*$show['c_jovenes'];
				$t_ninos=$show['p_ninos']*$show['c_ninos'];
				$tt=$t_adultos+$t_jovenes+$t_ninos;
                $festejado=$show['festejado'];
				if($show['facturado']=='si'){
				$impuesto=$tt*.16;
				}else{
				$impuesto=0;
				}
				$total=$tt+$impuesto+$show['deposito'];
				$modificastatus="UPDATE contrato SET estatus= 0 WHERE Numero='".$_GET['numero']."'";
				 mysql_query($modificastatus);
				echo '<form method="post" action="ActualizaS.php" name="formu">
				<table  border="9"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000">
				<tr><td><label>Nombre<label></td><td><input type="text" name="nombre" value="'.$show['nombre'].'"></td></tr>
				<tr><td><label>Fecha<label></td><td><input type="hidden" name="fechaevento" value="'.$show['Fecha'].'" >'.$show['Fecha'].'</td></tr>
				<tr><td><label>Tipo<label></td><td>
				<select name="tipo" id="tipo" >
						<option value="'.$show['tipo'].'">'.$show['tipo'].'</option>
						<option value="Bautizo">Bautizo</option>
						<option value="Boda">Boda</option>
						<option value="XV A񯳢>XV A񯳼/option>
						<option value="Empresarial">Empresarial</option>
						<option value="Graduacion">Graduacion</option>
						<option value="Primera Comunion">Primera Comunion</option>
						<option value="Cumplea񯳢>Cumplea񯳼/option>
						<option value="Presentacion">Presentacion</option>
						<option value="Otros">Otros</option>
					   
					</select>
				
				</td></tr>
				<tr><td><label>Salon<label></td><td>
				<select name="salon" id="salon" >
						<option value="'.$show['salon'].'">'.$show['salon'].'</option>
						<option value="Fundador de Conin">Fundador de Conin</option>
					   <option value="Real de Conin">Real de Conin</option>
						<option value="Alcazar de Conin">Alcazar Conin</option>
						<option value="Solar de Conin">Solar de Conin</option>
						<option value="Marques">Marqués</option>
					   
					</select>
				</td></tr>
				<!--tr><td><label>Saldo inicial<label></td><td><input type="text" name="si" placeholder="'.$show['si'].'"></td></tr-->
				';
                
                  
                ////////vendedores
                echo '<tr><td><label>Vendedor<label></td><td>
				     <select name="vendedor" id="vendedor" >';
                echo '<option value="'.$show['vendedor'].'">'.$show['vendedor'].'</option>';
                    $v="Select usuario from usuarios Where nivel=4";
                    $Vende=mysql_query($v);
                    while($Vendedor=mysql_fetch_array($Vende))
                    {
                        $VENDEDOR=explode(" ",$Vendedor['usuario']);
                        echo "<option value='".$VENDEDOR[1]."'>".$VENDEDOR[1]."</option>";					
                    }
                echo "</select>
				</td></tr>';";
				
                ///////fin de vendedores
                echo '<tr><td><label>Festejado<label></td><td><input type="text" name="festejado" value="'.$festejado.'" required></td></tr>';
                
				///datos telefono y correo y panel de modificacion de comensales
				$number=explode('-',$_GET['numero']);
				if(count($number)==1 && $_GET['mcontrato']!=1){
					echo '
					<tr><td><label>Deposito<label></td><td><input id="depos" type="text" name="deposito" value="'.$show['deposito'].'" onchange="todo()" required></td></tr>
					<tr><td></td><td><input type="radio" id="facturado" name="facturado" value="si" onchange="total();" CHECKED> Si</td></tr>
						 <tr><td colspan="4"><strong><center>Comensales<center></strong></td></tr> 
						 <tr><td>Descipci󮼯td><td>Cantidad										   </td><td>Precio Unitario</td><td>Precio total</td></tr> 
						 <tr><td>Adultos</td><td><input type="numeric" id="c_adultos" name="c_adultos" onchange="calcular1()" placeholder="'.$show['c_adultos'].'" required></td><td><input type="text" id="p_adultos" name="p_adultos" onchange="calcular1()" placeholder="'.$show['p_adultos'].'">	</td><td><b id="t_adultos" required>$'.$t_adultos.'</b></td></tr> 
						 <tr><td>Jovenes</td><td><input type="text" id="c_jovenes" name="c_jovenes" onchange="calcular2()" placeholder="'.$show['c_jovenes'].'" required></td><td><input type="text" id="p_jovenes" name="p_jovenes" onchange="calcular2()" placeholder="'.$show['p_jovenes'].'"></td><td><b id="t_jovenes" required>$'.$t_jovenes.'</b></td></tr> 
						 <tr><td>Ni񯳠 </td><td><input type="text" id="c_ninos" name="c_ninos" onchange="calcular3()" placeholder="'.$show['c_ninos'].'" required></td><td><input type="text" id="p_ninos" name="p_ninos" onchange="calcular3()" placeholder="'.$show['p_ninos'].'">	</td><td><b id="t_ninos" required>$'.$t_ninos.'</b></td></tr> 

						  <tr><td>	    </td><td></td><td>Subtotal </td><td><b id="st">$'.$tt.'</b></td></tr>   
						 <tr><td>	    </td><td></td><td>IVA </td><td><b id="i">$'.$impuesto.'</b></td></tr>   
						 <tr><td>	    </td><td></td><td>Deposito </td><td><b id="d">$'.$show['deposito'].'</b></td></tr>   
						
						 <tr><td>  		</td><td></td><td>Total</td><td><b id="t">$'.$total.'</b></td></tr> 
						  </b>
						</table>
						<br><br>
						<tr>
						<td align="center" colspan="4">
							 <center>
							 <input type="hidden" name="numero" value="'.$show['Numero'].'">
						   <p>';
				}elseif(count($number)==2 && $_GET['mcontrato']!=1){
					$subq="select * from subcontratos where numero='".$_GET['numero']."'";
					$subq=mysql_query($subq);
					$subm=mysql_fetch_array($subq);
					echo '<tr><td><label>Deposito<label></td><td><input id="depos" type="text" name="deposito" value="'.$show['deposito'].'" onchange="todo()" required></td></tr>';
					echo '<tr><td>Comite</td>
					<td><input type="radio"  name="comite" value="si"> Si &nbsp&nbsp&nbsp<input type="radio"  name="comite" value="no" CHECKED> No</td></tr>';
					echo "<tr><td>Correo</td><td><input type='email' name='correo' value='".$subm['correo']."' required></td></tr>";
					echo "<tr><td>Telefono</td><td><input type='text' name='telefono' value='".$subm['telefono']."' required></td></tr>";
					echo "<tr><td>Telefono</td><td><input type='text' name='telefono' value='".$subm['telefono']."' required></td></tr>";
					echo '<tr><td></td><td><input type="radio" id="facturado" name="facturado" value="si" onchange="total();" CHECKED> Si</td></tr>
						 <tr><td colspan="4"><strong><center>Comensales<center></strong></td></tr> 
						 <tr><td>Descipci󮼯td><td>Cantidad										   </td><td>Precio Unitario</td><td>Precio total</td></tr> 
						 <tr><td>Adultos</td><td><input type="numeric" id="c_adultos" name="c_adultos" onchange="calcular1()" placeholder="'.$show['c_adultos'].'" required></td><td><input type="text" id="p_adultos" name="p_adultos" onchange="calcular1()" placeholder="'.$show['p_adultos'].'">	</td><td><b id="t_adultos" required>$'.$t_adultos.'</b></td></tr> 
						 <tr><td>Jovenes</td><td><input type="text" id="c_jovenes" name="c_jovenes" onchange="calcular2()" placeholder="'.$show['c_jovenes'].'" required></td><td><input type="text" id="p_jovenes" name="p_jovenes" onchange="calcular2()" placeholder="'.$show['p_jovenes'].'"></td><td><b id="t_jovenes" required>$'.$t_jovenes.'</b></td></tr> 
						 <tr><td>Ni񯳠 </td><td><input type="text" id="c_ninos" name="c_ninos" onchange="calcular3()" placeholder="'.$show['c_ninos'].'" required></td><td><input type="text" id="p_ninos" name="p_ninos" onchange="calcular3()" placeholder="'.$show['p_ninos'].'">	</td><td><b id="t_ninos" required>$'.$t_ninos.'</b></td></tr> 

						  <tr><td>	    </td><td></td><td>Subtotal </td><td><b id="st">$'.$tt.'</b></td></tr>   
						 <tr><td>	    </td><td></td><td>IVA </td><td><b id="i">$'.$impuesto.'</b></td></tr>   
						 <tr><td>	    </td><td></td><td>Deposito </td><td><b id="d">$'.$show['deposito'].'</b></td></tr>   
						
						 <tr><td>  		</td><td></td><td>Total</td><td><b id="t">$'.$total.'</b></td></tr> 
						  </b>
						</table>
						<br><br>
						<tr>
						<td align="center" colspan="4">
							 <center>
							 <input type="hidden" name="numero" value="'.$show['Numero'].'">
						   <p>';
				}else{
				
							echo '
							<tr><td><label>Deposito<label></td><td>$'.$show['deposito'].'<input id="depos" type="hidden" name="deposito" value="'.$show['deposito'].'"></td></tr>
							<tr><td></td><td><input type="radio" id="facturado" name="facturado" value="si" onchange="total();" CHECKED> Si</td></tr>
						 <tr><td colspan="4"><strong><center>Comensales<center></strong></td></tr> 
						 <tr><td>Descipci󮼯td><td>Cantidad</td><td>Precio Unitario</td><td>Precio total</td></tr> 
						</table>
						<br><br>
						<tr>
						<td align="center" colspan="4">
							 <center>
							 <input type="hidden" name="numero" value="'.$show['Numero'].'">
							 <input type="hidden" name="contratogral" value="1">
						   <p>';
				}
				
				
					$fac="select facturado from contrato Where Numero='".$show['Numero']."'";
				   $facturado=mysql_fetch_array(mysql_query($fac));
				   if($facturado['facturado']=='si')
				   {
					   $qm="select sum(cantidad) as total from abonofac where numcontrato='".$show['Numero']."'";
					   $rm=mysql_query($qm);
					$mm=mysql_fetch_array($rm);
					$CantidadDeposito="select valor from Configuraciones where id=1";
					$CanDep=mysql_query($CantidadDeposito);
					$Re=mysql_fetch_array($CanDep);
					//echo $Re['valor'];
				   }
				   
				   else if($facturado['facturado']=='no')
				   {
					   $qm="select sum(cantidad) as total from abono where numcontrato='".$show['Numero']."'";
					   $rm=mysql_query($qm);
					   $mm=mysql_fetch_array($rm);
					   $CantidadDeposito="select valor from Configuraciones where id=1";
					   $CanDep=mysql_query($CantidadDeposito);
					   $Re=mysql_fetch_array($CanDep);
						$mm['total'];
				   }
				   /*if(isset($mm['total'])&&$mm['total']<=$Re['valor']){
				   echo "<small>No se puede imprimir contrato hasta tener el apartado de ".$Re['valor']." </small><br>";
				   }else{
						if(strlen($_GET['numero'])<=8){
						echo '<input id="btn" type="submit" name="opcion" value="imprimir"/>';
						}
				   
				   }*/
				   echo '<input id="btn" type="submit" name="opcion"/ value="Actualizar">
				   </center>
				   </form>
				   </td></tr>
				</form><br>
				';
				
				if(strlen($_GET['numero'])<=8){
					if($show['deposito']>0){
					echo '<button id="btn" onclick="crearfechas()" >Elegir Fechas</button></p>';
					}
					echo "<br><button onclick='crear()' id='btn'>Crear sub-Contratos</button>";
				}
			}
		}
}
?>
<script>
	function crear(){
		location.href="subcontratos.php?numero="+"<?php echo $_GET['numero']; ?>"+"&op=crear";
	}
	function crearfechas(){
		//location.href="fechas_subcontrato.php?numero="+"<?php echo $_GET['numero']; ?>";
		location.href="fechas_contrato.php?numero="+"<?php echo $_GET['numero']; ?>";
	}
	function NOborrar(){
		alert('No se puede borrar si se tienen subcontratos debe de cancelarlos');
	}
</script>

</div>	

<div class="overlay-container">
		<div class="window-container zoomin">
			<h3>Informacion contrato <?php echo $_GET['numero']; ?></h3> 
			<strong>
			<?php
				$q="select * from contrato where Numero='".$_GET['numero']."'";
				$r=mysql_query($q);
				$m=mysql_fetch_array($r);
				echo "Fecha..................................".$m['Fecha']."<br>";
				echo "Salon..................................".$m['salon']."<br>";
				echo "Total de comensales..........";echo $m['c_adultos']+$m['c_jovenes']+$m['c_ninos']; echo "<br>";
				echo "Cantidad de subcontratos..".cantidad_subcontratos($_GET['numero']);
			?>
			</strong>
			<span class="close" align='center'>Cerrar</span>
		</div>
		</div>
</body>
<script>!window.jQuery && document.write(unescape('%3Cscript src="Config/pop/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="Config/pop/demo.js"></script>
	
</html>
