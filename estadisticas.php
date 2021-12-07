<html>
  <head>
  <?php
require 'funciones2.php';
validarsesion();
$grafica=0;
$descripcion='';
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
if($nivel==5)
{
menunivel5();
}
?>

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
    </style>
	<?php
	function valores(){
	global $grafica;
	global $descripcion;
		$colores=array("#85CCFC","#55DE6C","#FFC041","#DC4646","#E19A3D","#E1DB3D","#84E13D","#3DE1CB","#743DE1","#E13DAA","#3DE18F","#B6F59B","#491C76","#21AB58","#E2E65C","#FCB53C","#FA0D0D","#BD9BD4","#0FF517");
		$i=0;
		$values='';
		if($_POST['tipo']=='medio'){
		$descripcion="Grafica que representa el medio por el cual el cliente fue canalizado a nosotros";
		echo "['Medio', 'Preregistros','Concretados','Eliminados'],";
			if($_POST['op']=='Todo'){
			$grafica='Medio de Contacto';
			$r=mysql_query('select medio from preregistro group by medio');
			while($m=mysql_fetch_array($r)){
				$r2=mysql_query('select count(*) as t from preregistro where medio="'.$m['medio'].'"');
				while($m2=mysql_fetch_array($r2)){
				if($m['medio']!=''){
					$c=mysql_query('select count(*) as t from eliminados where medio_contacto="'.$m['medio'].'" and estatus="cliente"');
					$c2=mysql_fetch_array($c);
					$e=mysql_query('select count(*) as t from eliminados where medio_contacto="'.$m['medio'].'" and estatus="eliminado"');
					$e2=mysql_fetch_array($e);
					$values=$values."['".$m['medio']."',".$m2['t'].",".$c2['t'].",".$e2['t']."],";
				
				}
				}
			}
			}else{
			$grafica='Medio de Contacto de '.$_POST['fi'].' a '.$_POST['fl'];
				$r=mysql_query('select medio from preregistro group by medio');
				while($m=mysql_fetch_array($r)){
					$r2=mysql_query('select count(*) as t from preregistro where medio="'.$m['medio'].'" and fdr<="'.$_POST['fl'].'" and fdr>="'.$_POST['fi'].'"');
					while($m2=mysql_fetch_array($r2)){
					if($m['medio']!=''){
					$c=mysql_query('select count(*) as t from eliminados where medio_contacto="'.$m['medio'].'" and estatus="cliente" and fecha_registro<="'.$_POST['fl'].'" and fecha_registro>="'.$_POST['fi'].'"');
						$c2=mysql_fetch_array($c);
						$e=mysql_query('select count(*) as t from eliminados where medio_contacto="'.$m['medio'].'" and estatus="eliminado" and fecha_registro<="'.$_POST['fl'].'" and fecha_registro>="'.$_POST['fi'].'"');
						$e2=mysql_fetch_array($e);
						$values=$values."['".$m['medio']."',".$m2['t'].",".$c2['t'].",".$e2['t']."],";
					}
				}
				}
			}

		}elseif($_POST['tipo']=='vendedores'){
		
			$descripcion='Grafica que muestra la cantidad de  eventos vendidos por cada vendedor';
				if($_POST['op']=='Todo'){
				echo "['Vendedor', 'Total','Concretados','Precontratos'],";
				$grafica='Vendedores';
				$r=mysql_query('select vendedor from contrato  WHERE vendedor != "MOSTRADOR"  group by vendedor');
				while($m=mysql_fetch_array($r)){
					$r2=mysql_query('select count(*) as t from contrato where vendedor="'.$m['vendedor'].'"');
					while($m2=mysql_fetch_array($r2)){
					if($m['vendedor']!=''){
						$si=mysql_query('select count(*) as t from contrato where vendedor="'.$m['vendedor'].'" and estatus=1');
						$si2=mysql_fetch_array($si);
						$si3=mysql_query('select count(*) as t from contrato where vendedor="'.$m['vendedor'].'" and estatus=2');
						$si4=mysql_fetch_array($si3);
						$sit=$si2['t']+$si4['t'];
						$no=mysql_query('select count(*) as t from contrato where vendedor="'.$m['vendedor'].'" and estatus=0');
						$no2=mysql_fetch_array($no);
						$values=$values."['".$m['vendedor']."',".$m2['t'].",".$sit.",".$no2['t']."],";
						
					}
					}
				}
				}else{
				echo "['Vendedor', 'Total','Concretados','Precontratos'],";
				$grafica='Vendedores '.$_POST['fi'].' a '.$_POST['fl'];
					$r=mysql_query('select vendedor from contrato  WHERE vendedor != "MOSTRADOR"  group by vendedor');
					while($m=mysql_fetch_array($r)){
						$r2=mysql_query('select count(*) as t from contrato where vendedor="'.$m['vendedor'].'" and fechacontrato<="'.$_POST['fl'].'" and fechacontrato>="'.$_POST['fi'].'"');
						while($m2=mysql_fetch_array($r2)){
						if($m['vendedor']!=''){
							$contrato=mysql_query('select count(*) as t2 from contrato where vendedor="'.$m['vendedor'].'" and fechacontrato<="'.$_POST['fl'].'" and fechacontrato>="'.$_POST['fi'].'" and estatus=1');
							$contrato2=mysql_fetch_array($contrato);
							$c=mysql_query('select count(*) as t2 from contrato where vendedor="'.$m['vendedor'].'" and fechacontrato<="'.$_POST['fl'].'" and fechacontrato>="'.$_POST['fi'].'" and estatus=2');
							$c2=mysql_fetch_array($c);
							$si=$contrato2['t2']+$c2['t2'];
							$contrat=mysql_query('select count(*) as t2 from contrato where vendedor="'.$m['vendedor'].'" and fechacontrato<="'.$_POST['fl'].'" and fechacontrato>="'.$_POST['fi'].'" and estatus=0');
							$contrat2=mysql_fetch_array($contrat);
							$values=$values."['".$m['vendedor']."',".$m2['t'].",".$si.",".$contrat2['t2']."],";
							$i++;
						}
					}
					}
				}
		
		}else{
			$descripcion="Grafica que muestra la cantidad de los tipos de eventos contratados ";
			echo "['Tipo de Evento', 'cantidad',{ role: 'style' }],";
			if($_POST['op']=='Todo'){
			$grafica='Tipo de Evento';
			$r=mysql_query('select tipo from contrato WHERE tipo != "MOSTRADOR" group by tipo');
			while($m=mysql_fetch_array($r)){
				$r2=mysql_query('select count(*) as t from contrato where tipo="'.$m['tipo'].'"');
				while($m2=mysql_fetch_array($r2)){
				if($m['tipo']!=''){
					$values=$values."['".$m['tipo']."',".$m2['t'].",'".$colores[$i]."'],";
					$i++;
				}
				}
			}
			}else{
			$grafica='Tipo de Evento de '.$_POST['fi'].' a '.$_POST['fl'];
				$r=mysql_query('select tipo from contrato  WHERE tipo != "MOSTRADOR"  group by tipo');
				while($m=mysql_fetch_array($r)){
					$r2=mysql_query('select count(*) as t from contrato where tipo="'.$m['tipo'].'" and Fecha<="'.$_POST['fl'].'" and Fecha>="'.$_POST['fi'].'"');
					while($m2=mysql_fetch_array($r2)){
					if($m['tipo']!=''){
						$values=$values."['".$m['tipo']."',".$m2['t'].",'".$colores[$i]."'],";
						$i++;
					}
				}
				}
			}
		}
		
		return $values;
	}
	?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php  echo valores();?>
        ]);

        var options = {
          title: ' <?php echo $grafica;?>',
          hAxis: {title: '', titleTextStyle: {color: 'blue'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
  <center>
  <br><br><br><br><br><br><br><br>
  <form action="estadisticas.php" method="POST">
  <table>
	<tr><td><label>Estadistica<label></td>
	<td><select name='tipo' required>
	<option></option>
	<option value='medio'>Medio de Contacto</option>
	<option value='vendedores'>Vendedores</option>
	<option value='evento'>Tipo de Evento</option>
	</select>
	</td></tr>
	<tr><td><label>Fecha inicio<label></td><td><input type="date" name="fi"></td></tr>
	<tr><td><label>Fecha Limite<label></td><td><input type="date" name="fl"></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' name='op' value="Todo"><input type='submit'  name='op' value="Consultar"></td></tr>
	<div id='descripcion' style='position:absolute; right:250px;top:325px;overflow: hidden; z-index: 2' width='400' height='200px'>
		<?php echo $descripcion;?>
	</div>
  <table>
  </form>
  <br><br>
  <?php
		
	if(isset($_POST['op'])){		
		echo '<div id="chart_div" style="width: 900px; height: 500px; z-index: 1" ></div>';
	}
  ?>
    
  </center>
  </body>
</html>