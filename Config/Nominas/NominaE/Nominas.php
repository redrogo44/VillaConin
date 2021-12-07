<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
require('../../configuraciones.php');
//require('funciones.php');
conectar();
?>
<title>Nominas Villa Conin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<!--<script type="text/javascript" src="js/muestra.js"></script>-->
	<style type="text/css" media="screen">	
	.btn {
	  background: #DC3535;
	  background-image: -webkit-linear-gradient(top, #DC3535, #FF0044);
	  background-image: -moz-linear-gradient(top, #DC3535, #FF0044);
	  background-image: -ms-linear-gradient(top, #FF0044, #FF0044);
	  background-image: -o-linear-gradient(top, #FF0044, #FF0044);
	  background-image: linear-gradient(to bottom, #FF0044, #FF0044);
	  -webkit-border-radius: 28;
	  -moz-border-radius: 28;
	  border-radius: 28px;
	  font-family: Arial;
	  color: #ffffff;
	  font-size: 15px;
	  padding: 10px 20px 10px 20px;
	  text-decoration: none;
	}

	.btn2 {
	  background: #FF5623;
	  background-image: -webkit-linear-gradient(top, #FF5623, #FF5623);
	  background-image: -moz-linear-gradient(top, #FF5623, #FF5623);
	  background-image: -ms-linear-gradient(top, #3498db, #FF5623);
	  background-image: -o-linear-gradient(top, #FF5623, #FF5623);
	  background-image: linear-gradient(to bottom, #FF5623, #FF5623);
	  -webkit-border-radius: 28;
	  -moz-border-radius: 28;
	  border-radius: 28px;
	  font-family: Arial;
	  color: #ffffff;
	  font-size: 15px;
	  padding: 10px 20px 10px 20px;
	  text-decoration: none;
	}
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}

.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    min-height:250px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}

.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}

.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}

.close {
    position: absolute;
    right: 15px;
}

	</style>
    <script type="text/javascript">
	function muestra(a)
	{					
		if (a=='nuevo_e')
		{
			$("#nuevo_e").show();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();

			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();				
		}

		if (a=='lista_e')
		{	$("#nuevo_e").hide();
			$("#lista_e").show();
		/*	$("#modifica_e").hide(); 
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();			
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();			
		}
		if (a=='modifica_e')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").show();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();			
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();			
		}
		if (a=='elimina_e')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").show();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();	
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}
		if (a=='genera_nomina')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").show();
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();	
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}		
		if (a=='confirma_nomina')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();
			$("#confirma_nomina").show();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();	
		
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}		
		if (a=='NConfirmadas')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();
			$("#confirma_nomina").hide();
			$("#NConfirmadas").show();			
			$("#TPagado").hide();			
			$("#Puntos").hide();	
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}		
		if (a=='TPagado')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").show();			
			$("#Puntos").hide();	
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}		
		if (a=='Puntos')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
		/*	$("#modifica_e").hide();	
			$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").show();

			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();		
		}		
	}	
	function muestra_nominas(no)
	{	
		if(no=='Comisiones')
		{		
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();
		
			$("#nuevo_e").hide();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();
			
			//$("#Comisiones").show();
			window.open("https://greatmeeting.me/Config/Nominas/NominaE/nominaComisiones.php", "Nomina Comisiones")
		}
		if(no=='Construccion')
		{
			$("#Comisiones").hide();
			$("#Construccion").show();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").hide();
					$("#nuevo_e").hide();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();

		}if(no=='Eventos')
		{
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").show();
			$("#Extras").hide();
			$("#Planta").hide();
					$("#nuevo_e").hide();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();

		}if(no=='Extras')
		{
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").show();
			$("#Planta").hide();
					$("#nuevo_e").hide();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();
		}
		if(no=='Planta')
		{
			$("#Comisiones").hide();
			$("#Construccion").hide();
			$("#Eventos").hide();
			$("#Extras").hide();
			$("#Planta").show();
					$("#nuevo_e").hide();
			$("#lista_e").hide();
			/*$("#modifica_e").hide();*/
		/*	$("#elimina_e").hide();	*/
			$("#genera_nomina").hide();	
			$("#confirma_nomina").hide();
			$("#NConfirmadas").hide();			
			$("#TPagado").hide();			
			$("#Puntos").hide();

		}
	}
	function pregunta(id)
	{
		alert(id);
		var r = confirm("Esta Completamente Seguro de Eliminar a este Empleado!");
			if (r == true) 
			{
			    window.location ="Acciones_Nomina.php?accion=elimina&&id="+id;				  						
			} 
	}	
    </script>
</head>

<body background="../../../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<div id="titulo"><h2><font><b>Nominas Eventos Sociales Villa Conin</b></font></h2></div>
<div id="main">
	  <ul class="container">
	      <li class="menu">    
	          <ul>
			    <li class="button"><a href="#" class="green"><b>Empleados</b><span></span></a></li>
	            <li class="dropdown">
	                <ul>
	                    <li><a href="#" onclick="muestra(this.name)" name="nuevo_e">Nuevo Empleado</a></li>
	                    <li><a href="#" onclick="muestra(this.name)" name="lista_e">Lista de Empleados</a></li>
	                   <!-- <li><a href="#" onclick="muestra(this.name)" name="modifica_e">Modificar Empleados</a></li>
	                    <li><a href="#" onclick="muestra(this.name)" name="elimina_e">Eliminar Empleado</a></li>-->
	                </ul>
				</li>
	          </ul>          
	      </li>    
	 <!--     <li class="menu">    
	          <ul>
			    <li class="button"><a href="#" class="orange"><b>Departamentos</b><span></span></a></li>          	
	            <li class="dropdown">
	                <ul>
	                    <li><a href="#" onclick="$('.button a:last').click();return false;">Crear Departamento</a></li>
	                    <li><a href="#">Modificar Departamento</a></li>
	                    <li><a href="#">Eliminar Departamento</a></li>
	                </ul>
				</li>
	          </ul>          
	      </li>     -->
	      <li class="menu">    
	          <ul>
			    <li class="button"><a href="#" class="blue"><b>Nominas</b><span></span></a></li>
	            <li class="dropdown">
	                <ul>
	                    <li><a href="#" onclick="muestra(this.name)" name="genera_nomina"  class="blue">Generar Nomina</a>
	                    </li>
	                    <li><a href="#" onclick="muestra(this.name)" name="confirma_nomina"  class="blue">Confimar Nominas</a></li>	                 
	                </ul>
				</li>
	          </ul>          
	      </li>    
	      <li class="menu">      
	          <ul>
			    <li class="button"><a href="#" class="red"><b>Reportes</b><span></span></a></li>
	            <li class="dropdown">
	                <ul>
	                    <li><a href="#" onclick="muestra(this.name)" name='NConfirmadas'>Nominas Confirmadas</a></li>
	                    <li><a href="#" onclick="muestra(this.name)" name='TPagado'>Total Pagado a el dia de Hoy</a></li>
	                    <li><a href="#" onclick="muestra(this.name)" name='Puntos'>Puntos Hasta Hoy</a></li>
	                </ul>
				</li>
	          </ul>          
	      </li>
	       <li class="menu">      
	          <ul>
			    <li class="button"><a  class="red"><b>Regresar</b><span></span></a></li>
	             <li class="dropdown">
	                <ul>
	                    <li><a href="../../../index.php" >INICIO</a></li>
	                    <li><a href="../../ConfiguracionSistema.php" >CONFIGURACIONES</a></li>	                  
	                </ul>
				</li>
	          </ul>          
	      </li>
	  </ul>
	<div class="clear"></div>    
</div>
<div id="contenidos">
	<div id="nuevo_e" style="display: none;" align="center">
	<form action="Acciones_Nomina.php" name="nuevoE"  id="nuevoE" method="post">
        <table border="5" >
           <th colspan="2"><font><b>Nuevo Empleado</b></font></th>
           <tr><td><b>Nombre(s)</b></td><td><input type="text" id="nombre" name="nombre"/></td></tr>
           <tr><td><b>Apellidos </b></td><td><input type="text" id="apellidos" name="apellidos"/></td></tr>
           <tr><td><b>Domicilio</b></td><td><input type="text" name="domicilio" /></td></tr>
           <tr><td><b>Telefono Celular</b></td><td><input type="text" name="celular"/></td></tr>
           <tr><td><b>Telefono Casa</b></td><td><input type="text" name="telefono"/></td></tr>
           <tr><td><b>Correo Electronico</b></td><td><input type="email" name="correo"/></td></tr>
           <tr><td><b>Fecha de Ingreso</b></td><td><input type="date" name="fecha"/></td></tr>
           <tr><td><b>Departamentos</b></td>
           		<td align="center">
           		<?php
	           		$d=mysql_query("SELECT * FROM Departamento");
	           		$inc=0;
		           		while ($de=mysql_fetch_array($d)) 
		           		{
		           			$inc++;
		           			echo $de['nombre'].'&nbsp;&nbsp;<input type="checkbox" class="departamento" name="'.$inc.'" value="'.$de['nombre'].'" />&nbsp;&nbsp;';
		           		}
           		?>           			           			
           		</td>
           </tr>                                            
           <tr><td><b>Sueldo Diario</b></td><td><input type="number" id="sueldo" name="sueldo"/></td></tr>
        </table>
        <br><br>
        <input type="hidden" value="Nuevo_Registro" name="accion" />
        <input type="button" value="Registrar" class="buttone" onclick="validaNuevoE();" />
     </form>
	</div>
    <div id="lista_e" style="display: none;" align="center">	
        <table border="5" >
           <th colspan="10"><font><b>Lista de Empleado</b></font></th>
           <tr>
	           <td align="center" bgcolor="E0F790"><b>Nombre</b></td>
               <td align="center" bgcolor="E0F790"><b>Celular</b></td>
               <td align="center" bgcolor="E0F790"><b>Telefono</b></td>
               <td align="center" bgcolor="E0F790"><b>Email</b></td>
               <td align="center" bgcolor="E0F790"><b>Ingreso</b></td>
               <td align="center" bgcolor="E0F790"><b>Departamento</b></td>
               <td align="center" bgcolor="E0F790"><b>Sueldo</b></td>
               <td align="center" bgcolor="E0F790"><b>Modificar</b></td>
               <td align="center" bgcolor="E0F790"><b>Eliminar</b></td>
               <td align="center" bgcolor="E0F790"><b>Detalle</b></td>
           </tr>          
           <?php
		   	$em=mysql_query("SELECT * FROM Empleados ORDER BY nombre");
			while($empl=mysql_fetch_array($em))
			{
					echo "<tr>
							<td align='center'><b>".$empl['nombre']." ".$empl['apellidos']."</b></td>
							<td align='center'><b>".$empl['celular']."</b></td>
							<td align='center'><b>".$empl['telefono']."</b></td>
							<td align='center'><b>".$empl['correo']."</b></td>
							<td align='center'><b>".$empl['fecha']."</b></td>
							<td align='center'><b>".$empl['categorias']."</b></td>
							<td align='center'><b>".$empl['sueldo']."</b></td>							
							<td><input type='submit' class='btn2' value='Modificar' onclick='modificaEmpleado(".$empl['id'].");'/></td>
							<td><input type='submit' class='btn' value='Eliminar' onclick='pregunta(".$empl['id'].");'/></td>
							<td><input type='button' class='btn' value='Detalle' onclick='detalleE(".$empl['id'].");'/></td>
						  </tr>";
			}
           ?>                 
        </table>
        <br><br>        
        <button class="btn" onclick="reiniciaN();">Reiniciar Nominas</button>
        <br>
	</div>	
    <div id="confirma_nomina" style="display: none;" align="center">
    	<h2><b>CONFIRMACION DE NOMINAS</b></h2>
    	<table border="10" bgcolor="#fff" bordercolor="#000">    		    	
	    	<?php
	    		$Nom_C=mysql_query("SELECT * FROM Cornfirmacion_Nomina_Comision WHERE confirmado='no'");
	    		if (mysql_num_rows($Nom_C)>0) 
	    		{	
	    			echo "
	    					<th colspan='2'><b>NOMINA DE COMISION</b></th>
	    				";
	    			while($nom_comi=mysql_fetch_array($Nom_C))
		    		{
		    			echo "
		    					<tr>
									<td><b>".$nom_comi['fecha']."</b></td>								
		    						<td style='width:100px;' align='center'><a href='https://greatmeeting.me/Config/Nominas/NominaE/confirmaNominaComisiones.php?i=".$nom_comi['id']."'>Ver Nomina</a></td>
								</tr>

		    				";
		    		}
	    		}
				$Nom_Ex=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE confirmado='no'");
	    		if (mysql_num_rows($Nom_Ex)>0) 
	    		{	
	    			echo "
	    					<th colspan='2'><b>NOMINA DE EXTRAS</b></th>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom_Ex))
		    		{
		    			echo "
		    					<tr>
									<td><b>".$nom_E['fecha']."</b></td>								
		    						<td style='width:100px;' align='center'><a href='Confirmacion_Nominas.php?tipo=extras&id=".$nom_E['id']."'>Ver Nomina </a></td>
								</tr>

		    				";
		    		}
	    		}
	    		$Nom_Ex=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE confirmado='no'");
	    		if (mysql_num_rows($Nom_Ex)>0) 
	    		{	
	    			echo "
	    					<th colspan='2'><b>NOMINA DE EVENTOS</b></th>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom_Ex))
		    		{
		    			echo "
		    					<tr>
									<td><b>".$nom_E['fecha']."</b></td>								
		    						<td style='width:100px;' align='center'><a href='Confirmacion_Nominas.php?tipo=eventos&id=".$nom_E['id']."'>Ver Nomina </a></td>
								</tr>

		    				";
		    		}
	    		}
				$Nom_Ex=mysql_query("SELECT * FROM Confirmacion_Nomina_Planta WHERE confirmado= 'no' ");
	    		if (mysql_num_rows($Nom_Ex)>0) 
	    		{	
	    			echo "
	    					<th colspan='2'><b>NOMINA DE PLANTA</b></th>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom_Ex))
		    		{
		    			echo "
		    					<tr>
									<td><b>".$nom_E['fecha']."</b></td>								
		    						<td style='width:100px;' align='center'><a href='Confirmacion_Nominas.php?tipo=planta&id=".$nom_E['id']."'>Ver Nomina </a></td>
								</tr>

		    				";
		    		}
	    		}
				$Nom_Ex=mysql_query("SELECT * FROM Confirmacion_Nomina_Construccion WHERE confirmado='no'");
	    		if (mysql_num_rows($Nom_Ex)>0) 
	    		{	
	    			echo "
	    					<th colspan='2'><b>NOMINA DE CONSTRUCCIÓN</b></th>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom_Ex))
		    		{
		    			echo "
		    					<tr>
									<td><b>".$nom_E['fecha']."</b></td>								
		    						<td style='width:100px;' align='center'><a href='Confirmacion_Nominas.php?tipo=construccion&id=".$nom_E['id']."'>Ver Nomina </a></td>
								</tr>

		    				";
		    		}
	    		}
	    		
	    	?>
    	</table>
    </div>
	<div id="genera_nomina" style="display: none;" align="center">	
		<label>Selecciona una Nomina</label>&nbsp;&nbsp;
		 <select id="status" name="status" onChange="muestra_nominas(this.value);">
     		<option value='2'>Seleccione una Opción</option>
			<?php
				$dep=mysql_query("SELECT * FROM Departamento");
				while ($depar=mysql_fetch_array($dep)) 
				{
					echo "<option value='".$depar['nombre']."'>".$depar['nombre']."</option>";
				}
			?>
		</select>
	</div>
		
		<!-- NOMINA DE TYPO COMISION -->
		<div id="Comisiones" style='display:none;' align="center" style="width:120%;">	 
        <form action="Acciones_Nomina.php" method="POST" name="comision" style="width: 109%;" >      
			<table id="comision" border="10" bordercolor="#000000" >
				<th colspan="10">NOMINA DE COMISIONES</th>
                <tr> <th colspan="10"> Del <?php echo fechas();?></th></tr>
                <tr>
					<td align="center">Contratos</td>
					<td align="center">Comensales</td>
					<?php
					$nEmpleados=0;
						$ca=mysql_query("SELECT * FROM Empleados");
						while ($com=mysql_fetch_array($ca)) 
						{
							$comi=explode(",", $com['categorias']);
							for ($i=0; $i <count($comi) ; $i++) 
							{ 
								if ($comi[$i]=='Comisiones') 
								{
									$nEmpleados++;
									echo "
									<td align='center' style='width:30px;'><h6>FACTOR</h6></td>									
									<td align='center'>".$com['nombre']."</td>";
								}
							}							
						}
					?>
				</tr>
                <tr>
                <td align="right" colspan="2"> Dias Trabajados</td>
             
                <?php
					$ca=mysql_query("SELECT * FROM Empleados");$inc=0;
						while ($com=mysql_fetch_array($ca)) 
						{
							$comi=explode(",", $com['categorias']);
							for ($i=0; $i <count($comi) ; $i++) 
							{ 
								if ($comi[$i]=='Comisiones') 
								{$inc++;
									echo "
									<td align='center'><input type='number' style='width:25px'name='Dias_T-".$inc."' id='".$com['sueldo']."' class='diasT' onChange='totalDias(this.name,this.id)' required /></td>									
									<td align='center'><input type='text' style='width:55px' name='Sueldo".$inc."' id='Sueldo".$inc."' value='0' required readonly /></td>";
								}
							}							
						}
                ?>
                </tr>                 
                <tr>
                 <td align="right" colspan="2"> Puntos</td>
                 <?php
					$ca=mysql_query("SELECT * FROM Empleados");$inc=0;
						while ($com=mysql_fetch_array($ca)) 
						{
							$comi=explode(",", $com['categorias']);
							for ($i=0; $i <count($comi) ; $i++) 
							{ 
								if ($comi[$i]=='Comisiones') 
								{$inc++;
									echo "
									<td align='center' bgcolor='#D97795'></td>									
									<td align='center'><input type='text'  style='width:45px' name='Pt-".$inc."' required /></td>";
								}
							}							
						}
                ?>
                </tr>             
                 <tr>
					<td align='center' colspan="2">COMISION</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$co=0;						
									while ($com=mysql_fetch_array($ca)) 
									{
										
										$comi=explode(",", $com['categorias']);
										for ($i=1; $i <=count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{ $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."' id='Comision-".$co."' title='Comision".$co."'></p>
												<input type='hidden' name='Comision".$co."' id='Comision".$co."' title='Comision".$co."'>
												</td>";
											}
										}							
									}			
					?>							
				</tr>
                <tr>
					<td align='center' colspan="2">BRUTO</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$inc=0;
									while ($com=mysql_fetch_array($ca)) 
									{
										$comi=explode(",", $com['categorias']);
										for ($i=0; $i <count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{$inc++;
												echo "
												<td align='center' colspan='2'><input type='text' name='Bruto".$inc."' id='Bruto".$inc."' readonly='readonly'</td>";
											}
										}							
									}			
					?>							
				</tr>
                 <tr>
					<td align='center' colspan="2">DESCUENTOS</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");$inc=0;
									while ($com=mysql_fetch_array($ca)) 
									{
										$comi=explode(",", $com['categorias']);
										for ($i=0; $i <count($comi) ; $i++) 
									{ 
											if ($comi[$i]=='Comisiones') 
											{$inc++;
												echo "
												<td align='center' colspan='2'><input type='text' name='descuento".$inc."' id='descuento".$inc."' onchange='calcula_neto(this.value,".$inc.")'/></td>";
											}
										}							
									}			
					?>							
				</tr>
                 <tr>
					<td align='center' colspan="2">NETO</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados"); $inc=0;
									while ($com=mysql_fetch_array($ca)) 
									{
										$comi=explode(",", $com['categorias']);
										for ($i=0; $i <count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{$inc++;
												echo "
												<td align='center' colspan='2'><input type='text' id='Neto".$inc."'  name='Neto".$inc."' title='Neto".$inc."' readonly='readonly' /></td>";
											}
										}							
									}			
					?>							
				</tr>
			</table>
           
            <table border="10" borde bordercolor="#000000" id="tablaExtraNominas" class="tablaExtraNominas" bgcolor="#fff">
            	<th colspan="2">RELACIONES</th>
                <tr><td colspan="2" style="height:83px;" bgcolor="#B1AAAA"></td></tr>
                <tr>
                	<td bgcolor="#860000" style="color:#FFF;"><b>NORMAL</b></td>
                	<td bgcolor="#860000" style="color:#FFF;"><b>APLICADA</b></td>
              
                </tr>                          
            </table>          
            

             <input type="hidden" name="filas" id="filas" value="" />
            <!-- <input type="hidden" name="accion" id="accion" value="" /> -->
            <input type="hidden" name="Texto" id="textoCo" />
            <input type="hidden" name="accion" value='Guardar Nomina Comision'/>

             </form>          
                

 			<div style="width:220px;height:20px;">
 			 
            <input type="button" name="comision"  onclick="PreguntaTexto(this.name)" value="GUARDA NOMINA COMISION" /> 			 
             <button onclick="myFunction()">Agregar</button>	
 			</div>
            
	
	</div>
    <div id="Extras" style="display: none;" align="center">	 
    	<form action="Acciones_Nomina.php" name="NominaExtra" method="post">
        	<table id="extras" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE EXTRAS</th>
                <tr> <th colspan="12"> Del <?php echo fechas();?></th></tr>
                <tr>
                    <td align="center" style="width:120px;"><b>Nombre</b></td>
                    <td align="center"><h6><b>Puntos</b></h6></td>
                     <td align="center"><h6><b>Hora Entrada</b></h6></td>
                    <td align="center"><h6><b>Hora Salida</b></h6></td>
                    <td align="center"><b>Lunes</b></td>
                    <td align="center"><b>Martes</b></td>
                    <td align="center"><b>Miercoles</b></td>
                    <td align="center"><b>Jueves</b></td>
                    <td align="center"><b>Viernes</b></td>
                    <td align="center"><b>Sabado</b></td>
                    <td align="center"><b>Domingo</b></td>
                    <td align="center"><b>Total</b></td>                
                </tr>
                	<?php
						$emp=mysql_query("SELECT * FROM Empleados");$inc=0;$chek=0;
						while($empl=mysql_fetch_array($emp))
						{
							$tip=explode(",",$empl['categorias']);
							for($e=0;$e<count($tip);$e++)
							{
								if($tip[$e]=='Extras')
								{	$inc++;								
										// EMPLEADOS DE TIPO EXTRAS
										echo '
							<tr>

								 <td colspan="4" bgcolor="#CCCCCC"></td>
			                    <td><input type="text" name="lunes'.$inc.'"  	id="Lunes'.$inc.'" 	class="extras"	title="Lunes-'.$inc.'"  		style="width:60px;"/></td>
			                    <td><input type="text" name="martes'.$inc.'" 	id="Martes'.$inc.'"		class="extras"		title="Martes-'.$inc.'" 		style="width:60px;"/></td>
			                    <td><input type="text" name="miercoles'.$inc.'" id="Miercoles'.$inc.'" 		class="extras"	title="Miercoles-'.$inc.'"	style="width:60px;"/></td>
			                    <td><input type="text" name="jueves'.$inc.'" 	id="Jueves'.$inc.'" 	class="extras"		title="Jueves-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text" name="viernes'.$inc.'" 	id="Viernes'.$inc.'" 	class="extras"		title="Viernes-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text" name="sabado'.$inc.'" 	id="Sabado'.$inc.'" 	class="extras"		title="Sabado-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text" name="domingo'.$inc.'" 	id="Domingo'.$inc.'" 	class="extras"		title="Domingo-'.$inc.'"		style="width:60px;"/></td>          
							</tr>
							<tr>
								<td align="center" style="width:180px;"><b style="width:180px;">'.$empl['nombre']." ".$empl['apellidos'].'</b></td>
								<td align="center"><input type="text" name="puntos'.$inc.'" style="width:60px;" /></td>
								<td align="center"><h6><b><input type="time" name="Hora_E'.$inc.'"  style="width:100px;" /></b></h6></td>
								<td align="center"><b><input type="time" name="Hora_S'.$inc.'" style="width:100px;" /></b></td>';
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Lunes-'.$inc.'" 		title="Lunes-'.$inc.'" 		onchange="calcula_Extra(this.id,'.$inc.')" disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Martes-'.$inc.'" 		title="Martes-'.$inc.'" 		onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Miercoles-'.$inc.'" 	title="Miercoles-'.$inc.'" 	onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Jueves-'.$inc.'" 		title="Jueves-'.$inc.'" 		onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Viernes-'.$inc.'" 	title="Viernes-'.$inc.'" 	onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Sabado-'.$inc.'" 		title="Sabado-'.$inc.'" 		onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Domingo-'.$inc.'" 	title="Domingo-'.$inc.'" 	onchange="calcula_Extra(this.id,'.$inc.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><input type="text" name="total'.$inc.'" id="total'.$inc.'" style="width:60px;" readonly="readonly" /></td>
              			   </tr>
								';
								}
							}
						}
                    ?>
            
            </table>
            <input type="hidden" name="Checks" value="<?php echo $chek;?>" />
            <input type="hidden" name="filas" value="<?php echo $inc;?>" />
            <input type="hidden" name="Texto" id="textoEx" />

            <br><br>
            <input type="hidden" name="tipo" value="GUARDA NOMINA EXTRA" />
            <input type="button" name="NominaExtra"  onclick="PreguntaTexto(this.name)" value="GUARDA NOMINA EXTRAS" />

        </form>
    </div>
     <div id="Eventos" style="display: none;" align="center">	 
    	<form action="Acciones_Nomina.php" name='NominaEventos' method="post">
        	<table id="extras" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE EVENTOS</th>
                <tr> <th colspan="12"> Del <?php echo fechas();?></th></tr>
                <tr>
                    <td align="center" style="width:120px;"><b>Nombre</b></td>
                    <td align="center"><h6><b>Puntos</b></h6></td>
                     <td align="center"><h6><b>Hora Entrada</b></h6></td>
                    <td align="center"><h6><b>Hora Salida</b></h6></td>
                    <td align="center"><b>Lunes</b></td>
                    <td align="center"><b>Martes</b></td>
                    <td align="center"><b>Miercoles</b></td>
                    <td align="center"><b>Jueves</b></td>
                    <td align="center"><b>Viernes</b></td>
                    <td align="center"><b>Sabado</b></td>
                    <td align="center"><b>Domingo</b></td>
                    <td align="center"><b>Total</b></td>                
                </tr>
                	<?php
						$emp=mysql_query("SELECT * FROM Empleados");$inc=0;$chek=0;
						while($empl=mysql_fetch_array($emp))
						{
							$tip=explode(",",$empl['categorias']);
							for($e=0;$e<count($tip);$e++)
							{
								if($tip[$e]=='Eventos')
								{	$inc++;								
										// EMPLEADOS DE TIPO EXTRAS
										echo '
							<tr>

								 <td colspan="4" bgcolor="#CCCCCC"></td>
			                    <td><input type="text" class="evento" name="lunes'.$inc.'"  onChange="validaE();" id="Lunes'.$inc.'E" 		title="Lunes-'.$inc.'"  		style="width:60px;"/></td>
			                    <td><input type="text" class="evento" name="martes'.$inc.'" onChange="validaE();" 	id="Martes'.$inc.'E"		title="Martes-'.$inc.'" 		style="width:60px;"/></td>
			                    <td><input type="text" class="evento" name="miercoles'.$inc.'" onChange="validaE();"  id="Miercoles'.$inc.'E" 	title="Miercoles-'.$inc.'"	style="width:60px;"/></td>
			                    <td><input type="text" class="evento" name="jueves'.$inc.'" 	onChange="validaE();"  id="Jueves'.$inc.'E" 	title="Jueves-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text" class="evento" name="viernes'.$inc.'" onChange="validaE();" 	id="Viernes'.$inc.'E" 	title="Viernes-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text"  class="evento" name="sabado'.$inc.'" onChange="validaE();" 	id="Sabado'.$inc.'E" 	title="Sabado-'.$inc.'"		style="width:60px;"/></td>
			                    <td><input type="text" class="evento" name="domingo'.$inc.'" 	onChange="validaE();"  id="Domingo'.$inc.'E" 	title="Domingo-'.$inc.'"		style="width:60px;"/></td>          
							</tr>
							<tr>
								<td align="center" style="width:180px;"><b style="width:180px;">'.$empl['nombre']." ".$empl['apellidos'].'</b></td>
								<td align="center"><input type="text" name="puntos'.$inc.'" style="width:60px;" /></td>
								<td align="center"><h6><b><input type="time" name="Hora_E'.$inc.'"  style="width:100px;" /></b></h6></td>
								<td align="center"><b><input type="time" name="Hora_S'.$inc.'" style="width:100px;" /></b></td>';
								echo '<td align="center"><b><input type="checkbox" class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Lunes-'.$inc.'" 		title="Lunes-'.$inc.'" onchange="calcula_Eventos(this.id,'.$inc.')"   disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" class="cevento"name="'.$chek.'" value="'.$chek.'" id="e-Martes-'.$inc.'" title="Martes-'.$inc.'" onchange="calcula_Eventos(this.id,'.$inc.')"  disabled  /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Miercoles-'.$inc.'" 	title=Miercoles-'.$inc.'" 	onchange="calcula_Eventos(this.id,'.$inc.')"  disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox"  class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Jueves-'.$inc.'" 		title=Jueves-'.$inc.'" 		onchange="calcula_Eventos(this.id,'.$inc.')"  disabled  /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Viernes-'.$inc.'" 	title=Viernes-'.$inc.'" 	onchange="calcula_Eventos(this.id,'.$inc.')"  disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Sabado-'.$inc.'" 		title=Sabado-'.$inc.'" 		onchange="calcula_Eventos(this.id,'.$inc.')"  disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" class="cevento" name="'.$chek.'" value="'.$chek.'" id="e-Domingo-'.$inc.'" 	title=Domingo-'.$inc.'" 	onchange="calcula_Eventos(this.id,'.$inc.')"  disabled /></b></td>';$chek++;
								echo '<td align="center"><input type="text" name="total'.$inc.'" id="total-'.$inc.'" style="width:60px;" readonly="readonly" readonly="readonly" /></td>
              			   </tr>
								';
								}
							}
						}
                    ?>
            
            </table>
            <input type="hidden" name="Checks" value="<?php echo $chek;?>" />
            <input type="hidden" name="filas" value="<?php echo $inc;?>" />
            <input type="hidden" name="Texto" id="textoEv" />
            <input type="hidden" name="tipo" value="GUARDA NOMINA EVENTOS" />
            <br><br>
           <!-- <input type="submit" name="tipo" value="GUARDA NOMINA EVENTOS" />-->
            <input type="button" name="NominaEventos"  onclick="PreguntaTexto(this.name)" value="GUARDA NOMINA EVENTOS" />
        </form>
    </div>
     <div id="Planta" style="display: none;" align="center">	 
    	<form action="Acciones_Nomina.php" name="planta" method="post">
        	<table id="planta" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE PLANTA</th>
                <tr> <th colspan="12"> Del <?php echo fechas();?></th></tr>
				<tr align="center">
					<td align="center">NOMBRE</td>
					<td align="center"><H6>Hora de Entrada</H6></td>
					<td align="center"><H6>Hora de Salida</H6></td>
					<td align="center"><H6>Salario Diario</H6></td>
					<td align="center"><H6>Dias Trabajados</H6></td>									
					<td align="center"><H6>Otros Pagos o Descuentos</H6></td>
					<td align="center"><H6>Salario por Semana</H6></td>					
					<td align="center"><H6>Puntos</H6></td>
					<td align="center"><H6>Total Nomina</H6></td>
				</tr>
				<?php

				$emp=mysql_query("SELECT * FROM Empleados");$inc=0;$chek=0;
						while($empl=mysql_fetch_array($emp))
						{
							$tip=explode(",",$empl['categorias']);
							for($e=0;$e<count($tip);$e++)
							{
								if($tip[$e]=='Planta')
								{	$inc++;								
								echo '				
									<tr>
										<td align="center" style="width:180px;"><h5><b style="width:180px;">'.$empl['nombre']." ".$empl['apellidos'].'</b></h5></td>
										<td><input type="time" 		name="Hora_E'.$inc.'" 		id="Hora_E'.$inc.'"  		title="Hora_E'.$inc.'" 		style="width:120px;" /></td>
										<td><input type="time" 		name="Hora_S'.$inc.'" 		id="Hora_E'.$inc.'" 		title="Hora_S'.$inc.'" 		style="width:120px;" /></td>
										<td><input type="text" 		name="Salario'.$inc.'" 		id="Salario'.$inc.'" value="'.$empl['sueldo'].'" title="Salario'.$inc.'" style="width:40px;" 	readonly="readonly"/></td>
										<td><input type="number" 	name="Dias_T'.$inc.'" 		id="Dias_T'.$inc.'" 		title="Dias_T'.$inc.'" 		style="width:40px;" 	onchange="modifico_PagoXEvrnto(this.id,'.$inc.');"/></td>
								
										<td><input type="text" 	name="Descuentos'.$inc.'" 	id="Descuentos'.$inc.'" 	title="Descuentos'.$inc.'"	 style="width:60px;" 		onchange="modifico_desceunto(this.id,'.$inc.');"/></td>
										<td><input type="text" 		name="Total_Semana'.$inc.'" id="Total_Semana'.$inc.'" 	title="Total_Semana'.$inc.'" style="width:60px;" readonly="readonly"/></td>
										<td><input type="text" 		name="Puntos'.$inc.'" 		id="Puntos'.$inc.'" 		title="Puntos'.$inc.'" 		style="width:60px;"/></td>										
										<td><input type="text" 		name="Total'.$inc.'" 		id="Total'.$inc.'" 			title="Total'.$inc.'" 		style="width:60px;" readonly="readonly"/></td>				

									<tr>  						 
		  						 ';
								}
							}
						}
						
				?>
            </table>      
            <input type="hidden" name="filas" value="<?php echo $inc;?>"  />
            <br><br>
            <input type="hidden" name="Texto" id="textoP" />

            <input type="hidden" name="tipo" value="GUARDA NOMINA PLANTA" />
        </form>
            <input type="button" name="planta"  onclick="PreguntaTexto(this.name)" value="GUARDA NOMINA PLANTA" />

   </div>
    <div id="Construccion" style="display: none;" align="center">	 
    	<form action="Acciones_Nomina.php" name="construccion" method="post">
        	<table id="construccion" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE CONSTRUCCION</th>
                <tr> <th colspan="12"> Del <?php echo fechas();?></th></tr>
				<tr align="center">
					<td align="center">NOMBRE</td>
					<td align="center"><H6>Hora de Entrada</H6></td>
					<td align="center"><H6>Hora de Salida</H6></td>
					<td align="center"><H6>Salario Diario</H6></td>
					<td align="center"><H6>Dias Trabajados</H6></td>										
					<td align="center"><H6>Otros Pagos o Descuentos</H6></td>
					<td align="center"><H6>Salario por Semana</H6></td>					
					<td align="center"><H6>Puntos</H6></td>
					<td align="center"><H6>Total Nomina</H6></td>
				</tr>
				<?php

				$emp=mysql_query("SELECT * FROM Empleados");$inc=0;$chek=0;
						while($empl=mysql_fetch_array($emp))
						{
							$tip=explode(",",$empl['categorias']);
							for($e=0;$e<count($tip);$e++)
							{
								if($tip[$e]=='Construccion')
								{	$inc++;								
								echo '				
									<tr>
										<td align="center" style="width:180px;"><h5><b style="width:180px;">'.$empl['nombre']." ".$empl['apellidos'].'</b></h5></td>
										<td><input type="time" 		name="Hora_E'.$inc.'" 		id="cHora_E'.$inc.'"  		title="Hora_E'.$inc.'" 		style="width:100px;" /></td>
										<td><input type="time" 		name="Hora_S'.$inc.'" 		id="cHora_E'.$inc.'" 		title="Hora_S'.$inc.'" 		style="width:100px;" /></td>
										<td><input type="text" 		name="Salario'.$inc.'" 		id="cSalario'.$inc.'" value="'.$empl['sueldo'].'" title="Salario'.$inc.'" style="width:40px;" 	readonly="readonly"/></td>
										<td><input type="number" 	name="Dias_T'.$inc.'" 		id="cDias_T'.$inc.'" 		title="Dias_T'.$inc.'" 		style="width:40px;" 	onchange="modifico_PagoXEvrnto2(this.id,'.$inc.');"/></td>									
										<td><input type="text" 		name="Descuentos'.$inc.'" 	id="cDescuentos'.$inc.'" 	title="Descuentos'.$inc.'"	 style="width:60px;" 		onchange="modifico_desceunto2(this.id,'.$inc.');"/></td>
										<td><input type="text" 		name="Total_Semana'.$inc.'" id="cTotal_Semana'.$inc.'" 	title="Total_Semana'.$inc.'" style="width:60px;" readonly="readonly"/></td>
										<td><input type="text" 		name="Puntos'.$inc.'" 		id="cPuntos'.$inc.'" 		title="Puntos'.$inc.'" 		style="width:60px;"/></td>										
										<td><input type="text" 		name="Total'.$inc.'" 		id="cTotal'.$inc.'" 			title="Total'.$inc.'" 		style="width:60px;" readonly="readonly"/></td>				

									<tr>  						 
		  						 ';
								}
							}
						}
						
				?>
            </table>      
            <input type="hidden" name="filas" value="<?php echo $inc;?>" />
            <br><br>
            <input type="hidden" name="tipo" value="GUARDA NOMINA CONSTRUCCION" />
            <input type="hidden" name="Texto" id="textoC" />
            
        </form>
            <input type="button" name="construccion"  onclick="PreguntaTexto(this.name)" value="GUARDA NOMINA CONSTRUCCION" />

   </div>
        <div id="Puntos" style="display: none;" align="center">	 
		<font color="#4635FF"><b>PUNTOS ACUMULADOS POR NOMINA</b></font>
		<br></br>
    		<table border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
			<?php
    		$Nom=mysql_query("SELECT * FROM Cornfirmacion_Nomina_Comision WHERE confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE COMISIONES</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['puntos']);		    			
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			
		    		}
		    		echo "<tr align='center'><td> <h5> <b>PUNTOS NOMINA DE COMISIONES </b></h5></td><td><h5><b> ".$t."</b></h5></td></tr>";
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Construccion WHERE confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE CONSTRUCCION</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['puntos']);		    		
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>PUNTOS NOMINA DE CONSTRUCCION </b></h5></td><td><h5><b>".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EVENTOS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['puntos']);		    
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>PUNTOS NOMINA DE EVENTOS </b></h5></td><td><h5><b>".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EXTRAS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['puntos']);		    
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>PUNTOS NOMINA DE EXTRAS </b></h5></td><td><h5><b> ".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Planta WHERE confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE PLANTA</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['puntos']);
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>PUNTOS NOMINA DE PLANTA </b></h5></td><td><h5><b> ".$t."</b></h5></td></tr>";		    		
	    		}
    	?>
   			</table>
 	</div>
     <div id="TPagado" style="display: none;" align="center">	 
		<font color="#4635FF"><b>TOTAL PAGADO POR NOMINA</b></font>
		<br></br>
    		<table border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<?php
				$fechaReinicio=mysql_fetch_array(mysql_query("SELECT * FROM Configuraciones WHERE nombre='Fecha Nóminas Empleados'  AND tipo= 'Fecha Empleados' "));
    			echo "FECHA DE INICIO ".$fechaReinicio=$fechaReinicio['descripcion'];
    		$Nom=mysql_query("SELECT * FROM Cornfirmacion_Nomina_Comision WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE COMISIONES</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['neto']);		    			
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			
		    		}
		    		echo "<tr align='center'><td> <h5> <b>TOTAL NOMINA DE COMISIONES </b></h5></td><td><h5><b> $ ".$t."</b></h5></td></tr>";
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Construccion WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE CONSTRUCCION</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['Total_nomina']);		    		
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>TOTAL NOMINA DE CONSTRUCCION </b></h5></td><td><h5><b> $ ".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EVENTOS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['totales']);		    
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>TOTAL NOMINA DE EVENTOS </b></h5></td><td><h5><b> $ ".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EXTRAS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['totales']);		    
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>TOTAL NOMINA DE EXTRAS </b></h5></td><td><h5><b> $ ".$t."</b></h5></td></tr>";

	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Planta WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
		    			$t=0;	    			
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE PLANTA</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['Total_nomina']);
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}		    			
		    		}
		    		echo "<tr align='center'><td><h5><b>TOTAL NOMINA DE PLANTA </b></h5></td><td><h5><b> $ ".$t."</b></h5></td></tr>";		    		
	    		}
    	?>
   			</table>
 	</div>
    <div id="NConfirmadas" style="display: none;" align="center">	 
<font color="#4635FF"><b>NOMINAS CONFIRMADAS</b></font>
<br></br>
    <table border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
    <th><b>Fecha</b></th>
    <th><b>Total</b></th>
    <th><b>Imprimir</b></th>
    	<?php
    			$fechaReinicio=mysql_fetch_array(mysql_query("SELECT * FROM Configuraciones WHERE nombre='Fecha Nóminas Empleados'  AND tipo= 'Fecha Empleados' "));
    			echo "FECHA DE INICIO ".$fechaReinicio=$fechaReinicio['descripcion'];
    		$Nom=mysql_query("SELECT * FROM Cornfirmacion_Nomina_Comision WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE COMISIONES</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['neto']);
		    			$t=0;
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			echo "
		    					<tr>
									<td align='center' style='width:100px;'><h5><b>".$nom_E['fecha']."</b></h5></td>								
									<td align='center'><b>".$t."</b></td>															
		    						<td style='width:100px;' align='center'><a href='https://greatmeeting.me/Config/Nominas/NominaE/excelComisiones.php?i=".$nom_E['id']."' target='_blank'>EXCEL</a></td>
								</tr>

		    				";
		    		}
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Construccion WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE CONSTRUCCION</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['Total_nomina']);
		    			$t=0;
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			echo "
		    					<tr>
									<td align='center' style='width:100px;'><h5><b>".$nom_E['fecha']."</b></h5></td>								
									<td align='center'><b>".$t."</b></td>															
		    						<td style='width:100px;' align='center'><a href='PDF_Nominas.php?tipo=construccion&id=".$nom_E['id']."' target='_blank'>PDF</a></td>
								</tr>

		    				";
		    		}
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EVENTOS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['totales']);
		    			$t=0;
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			echo "
		    					<tr>
									<td align='center' style='width:100px;'><h5><b>".$nom_E['fecha']."</b></h5></td>								
									<td align='center'><b>".$t."</b></td>															
		    						<td style='width:100px;' align='center'><a href='PDF_Nominas.php?tipo=eventos&id=".$nom_E['id']."' target='_blank'>PDF</a></td>
								</tr>

		    				";
		    		}
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE EXTRAS</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['totales']);
		    			$t=0;
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			echo "
		    					<tr>
									<td align='center' style='width:100px;'><h5><b>".$nom_E['fecha']."</b></h5></td>								
									<td align='center'><b>".$t."</b></td>															
		    						<td style='width:100px;' align='center'><a href='PDF_Nominas.php?tipo=extras&id=".$nom_E['id']."' target='_blank'>PDF</a></td>
								</tr>

		    				";
		    		}
	    		}
	    		$Nom=mysql_query("SELECT * FROM Confirmacion_Nomina_Planta WHERE fecha>='$fechaReinicio' AND confirmado='si'");
	    		if (mysql_num_rows($Nom)>0) 
	    		{	
	    			echo "
	    					<tr><th colspan='3'><b>NOMINA DE PLANTA</b></th></tr>
	    				";
	    			while($nom_E=mysql_fetch_array($Nom))
		    		{
		    			$tot=explode(",",$nom_E['Total_nomina']);
		    			$t=0;
		    			for($i=0;$i<count($tot);$i++)
		    			{
		    				$t=$t+$tot[$i];
		    			}
		    			echo "
		    					<tr>
									<td align='center' style='width:100px;'><h5><b>".$nom_E['fecha']."</b></h5></td>								
									<td align='center'><b>".$t."</b></td>															
		    						<td style='width:100px;' align='center'><a href='PDF_Nominas.php?tipo=planta&id=".$nom_E['id']."' target='_blank'>PDF</a></td>
								</tr>

		    				";
		    		}
	    		}
    	?>
    	</table>
    </div>

    <div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><img width='20px' src="images/x.png"/></a></div>
        <div>
           <h2>Detalle Empleado</h2>
         	<div id="detalle"></div>
        </div>
    </div>
</div>
 <?php
 function fechas()
 {
		$semana=date('W');
			for($mes=1;$mes<12;$mes++){
				$limite = date('t',mktime(0,0,0,$mes,1,date('Y')));
				for($dia=1;$dia<$limite;$dia++){
					if(date('W',mktime(0, 0, 0, $mes  , $dia, date('Y'))) == $semana){
						if(date('N',mktime(0, 0, 0, $mes  , $dia, date('Y'))) == 1){
				$fecha= date('d',mktime(0, 0, 0, $mes  , $dia,date('Y'))).' al '.date('d',mktime(0, 0, 0, $mes  , $dia+6, date('Y')));
						}
					}
				}
			}
			
			switch (date('m'))
			{
			case 1:
					$mes=Enero;					
					break;
			case 2:
					$mes=Febrero;					
					break;
			case 3:
					$mes=Marzo;					
					break;
			case 4:
					$mes=Abril;					
					break;
			case 5:
					$mes=Mayo;					
					break;
			case 6:
					$mes=Junio;					
					break;
			case 7:
					$mes=Julio;					
					break;
			case 8:
					$mes=Agosto;					
					break;
			case 9:
					$mes=Septiembre;					
					break;
			case 10:
					$mes=Octubre;					
					break;
			case 11:
					$mes=Noviembre;					
					break;
			case 12:
					$mes=Diciembre;					
					break;		
			}
			$fecha=$fecha." ".$mes." de ".date('Y');
			return $fecha;
 }
 function total_comensales($n,$fac)
 {

	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
	$gral=mysql_fetch_array($congral);

	if($gral['total']>0){//////////////es un contrato gral
		if($fac=='si'){
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else{//////es un contrato normal o subcontrato
		if($fac=='si'){
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}
?>
<script>
	function comisiones()
	{
		<?php
			for($i=0;$i<$sue;$i++){
				echo "var c".$i."=0;";
		
			}
		 ?>
		
		var tantos = "<?php echo $sue; ?>" ;
		var t=document.getElementById('Su-0').value;
		var x=0;
		for (j=0;j<tantos;j++)
		{
			if(j%tantos==j)
			{
				x=x+parseInt(document.getElementById('Su-'+j).value);
				alert(x);
			}
		}
		
		
	}
	
var contratos=[];
function myFunction() {
    NumE="<?php echo $nEmpleados;?>";
	Nume=parseInt(NumE);
	var bandera=false;
	var numero = prompt("Introduzca Contrato", "");
    if (numero != '') {

		/*for(x=0;x<contratos.length;x++){
			if(contratos[x]==numero){
				bandera=true;
			}
		}*/
		if(numero==null || numero==''){
			
		}else if(!bandera){
			agregar_fila(numero);
		}
    }else{
		alert("Error debe de introducir un contrato");
		myFunction();
	}
}
 var sig=5;var l=0; var ll=0;var otraT=3; var inc=1;var fila=1;
function agregar_fila(c){
	var posicion=contratos.length; 
	contratos[posicion]=c;	
	var table = document.getElementById("comision");	
	var row2=table.insertRow(sig);   sig++;  
    var row = table.insertRow(sig);     
    var cel= row2.insertCell(0);
    cel.innerHTML="<td colspan='2'>Precio Por Comensal</td>";
    cel.colSpan='2';
	cel.bgColor='#FAFFBF';
     for(i=1;i<=NumE;i++)
     {
		ll++;
       var cel2 = row2.insertCell(i);	  
	   cel2.innerHTML = "<input style='width:70px;' type='text' title='Precio_Comen"+(ll)+"-"+fila+"' name='Precio_Comen"+(ll)+"-"+fila+"' id='Precio_Comen-"+(ll)+"-"+fila+"' onchange='SumaC(this.value,this.id)'/>";
	   cel2.align='center';
	   cel2.colSpan='2';
	   cel2.bgColor='#FAFFBF';
    }
	
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);        
    //var cell3 = row2.insertCell(1);                
    cell1.innerHTML = "<input type='text' name='Contrato"+inc+"' value='"+c+"' style='width:60px' />";
	cell1.align='center';
	cell1.bgColor='#F9D8D8';
    cell2.innerHTML = "<input style='width:40px;' type='number' min='0' name='Comensal-"+inc+"' title='Comensal-"+inc+"' id='Comensal-"+inc+"' onchange='calcula_Comision(this.value,"+fila+")'>";
    cell2.align='center';
	cell2.bgColor='#F9D8D8';
    for(i=1;i<=NumE;i++){
		l++;
       var cell1 = row.insertCell(i*2);
	   var cell2 = row.insertCell((i*2)+1);
	   cell1.innerHTML = "<input style='width:50px;' type='text' title='factor-"+l+"' name='factor-"+l+"' id='factor-"+l+"' onchange='modifica_comision("+l+','+inc+")' >";
	   cell1.bgColor='#F9D8D8';
	   cell2.innerHTML = "<input style='width:50px;'  class='"+i+"' type='text' title='x"+(l)+"-"+fila+"' name='x"+(l)+"' id='x"+(l)+"-"+fila+"' onchange='SumaC(this.value,this.id)'/>";
	   cell2.bgColor='#F9D8D8';
	}
	sig++;
	var table2 = document.getElementById("tablaExtraNominas");	   
    var row4 = table2.insertRow(otraT);  
     var cel4 = row4.insertCell(0);
      cel4.innerHTML="<td></td>";        
      cel4.colSpan='2';
      cel4.bgColor='F9D8D8';
      cel4.height='15px';
    var row2 = table2.insertRow(otraT+1);          
    var cel2 = row2.insertCell(0);
    var cel3 = row2.insertCell(1);  
    var cel5 = row2.insertCell(2);  

    cel2.innerHTML = "<input style='width:40px;' type='number' min='0' id='normal-"+inc+"' name='normal-"+inc+"' title='normal-"+inc+"' onChange='calcula_Factor(this.value,"+fila+")'/>";   
    cel3.innerHTML = "<input style='width:40px;' type='number' min='0' id='aplicada-"+inc+"' name='aplicada-"+inc+"' title='aplica-"+inc+"' onChange='calcula_Factor(this.value,"+fila+")'/>";
    cel5.innerHTML = "<<input type='button' name='"+fila+"' value='Eliminar' onclick='eliminarFila(this.name);'>";
    
otraT=otraT+2;inc++; fila++;
document.getElementById("filas").value=fila;
}
/*
function suma(posicion){
	var c=contratos[posicion];
	var cantidad=document.getElementById(c+"-0").value;/////////cantidad
	var factor=document.getElementById(c+"-1").value;///////////factor
	var total=cantidad*factor;
	document.getElementById(c+"-2").value=total;///////////factor
	document.getElementById(c+"-3").innerHTML =total;
}*/

// CALCULO DEL FACTOR POR FILA
var inicio=0; var cal=1;var n=1; 
function calcula_Factor(valor,fila)
{ 
var Em=1;
	var tE=parseInt(NumE);
		var filas=inc-1;
		//alert("filas = "+filas);
		var tot=tE*fila;
	if (filas>1)  
		{n=(tE*(filas-1)+1);}
	for(o=inicio;o<=tot;o++)
	{			
	  var apl=document.getElementById('aplicada-'+fila).value;
	  var nor=document.getElementById('normal-'+fila).value;
	   var P_Co=document.getElementById('Precio_Comen'+(o+n)+'-'+fila).value;			
  	  fa=((apl*P_Co)/nor);							
  	  document.getElementById("factor-"+(o+n)).value = fa;					
	  Em++;
	}
	
}
function calcula_Comision(c,fila)
{	
	alert(c+" fila:  "+fila);
	var tE=parseInt(NumE); // TOTAL DE EMPLEADOS
	var filas=inc-1;		//	TOTAL DE FILAS
	var tot=tE*filas;

		n=(tE*(filas-1)+1);
			//alert(n);
	c=parseFloat(c);
		for (var i =n; i <(n+tE); i++) 
		{

			var factor=parseFloat($("#factor-"+i).val());
			var total=factor*c;
			$("#x"+i+"-"+fila).val(total);						
		}
		recalculoTotales(filas,tE);
}
function recalculoTotales(filas,tE)
{
	//alert("Entro a recalculo "+filas+" Emple:  "+tE);
	var tv=filas*tE;
	for (var i = 1; i <= (tE); i++) 
	{ var t=0;
		$("."+i).each(function() {
			
			t+=parseFloat($(this).val());
		});
		$("#Comision-"+i).text(t);
		$("#Comision"+i).val(t);
		$("#Bruto"+i).val((parseFloat($("#Sueldo"+1).val())+t));
		$("#Neto"+i).val((parseFloat($("#Sueldo"+1).val())+t));
	}

}
function calcula_neto(monto,pos)
{
	pos=parseInt(pos);
	monto=parseFloat(monto);
	alert("Entro a NJeto "+ monto+" - "+pos);
var Neto=document.getElementById("Neto"+(pos)).value;
Neto=parseFloat(Neto);
document.getElementById("Neto"+(pos)).value=(Neto+monto);
}
function modifica_comision(n,f)
{
	alert("Comensal-"+n+" POSICION "+f);
//	n=parseInt(n);
var filas=inc-1;
var tE=parseInt(NumE);
 var F=document.getElementById('factor-'+n).value;
	 var C=document.getElementById('Comensal-'+f).value;
	 var New_Comi=(C*F);
	 document.getElementById("x"+n).value =New_Comi;
	 var residuo=((n)%tE);	   
	  if(residuo==0)  {residuo=tE;} 
	 var Comi=document.getElementById("Comision"+residuo).value;
	// alert(Comi);
	 alert(filas);
	 if (filas<=1) 
	 	{
	 		document.getElementById("Comision"+residuo).value=New_Comi;
	 		document.getElementById("Bruto"+residuo).value=New_Comi+parseFloat(document.getElementById("Sueldo"+residuo).value);	
	 		document.getElementById("Neto"+residuo).value=New_Comi+parseFloat(document.getElementById("Sueldo"+residuo).value);		 		
	 	}
	 	else
	 	{	
			m=n;
			alert("entro al else");
			var comision=0;
			var bruto=0;
			var neto=0;
			for(t=filas;t>=1;t--)
			{
				comision=(parseFloat(document.getElementById("x"+m).value)+comision);					
				m=m-tE;
			}
			alert("Comision es "+comision);
			document.getElementById("Comision"+residuo).value=comision;
			document.getElementById("Bruto"+residuo).value=comision+parseFloat(document.getElementById("Sueldo"+residuo).value);	
	 		document.getElementById("Neto"+residuo).value=parseFloat(document.getElementById("descuento"+residuo).value)+parseFloat(document.getElementById("Bruto"+residuo).value);		 		
	 	
	 	}
		//	   CALCULOS DE NOMINA TYPO EXTRA			
}
function calcula_Extra(n,f)
	{		

		var id=n.split('-');
		id=id[0]+f;
	
		var v=parseFloat($("#"+id).val());
    		var t=parseFloat($("#total"+f).val());
    		if(isNaN(t)){t=0;}
  
		if( $('#'+n).attr('checked') ) {
    		$("#total"+f).val((v+t));    	
		}
		else{		
    			$("#total"+f).val((t-v));
    		document.getElementById(n).disabled=true;		
		//	alert(res[1]+res[2]);	
			document.getElementById(id).value='';
		}
		

	}
	function calcula_Eventos(n,f)
	{
		//alert("Entro " +n );
		// 	OBTENEMOS LO QUE HAYA EN LOS TOTALES
		var total=document.getElementById("total-"+f).value;
//		alert(total);
		if(total==''||total==null||total=='NaN') // SI NO EXISTE NADA EN EL TOTAL ESTE SERA 0
		{
			total=0;			
		}
		total=parseFloat(total);
		// OBTENEMOS EL VALOR DE LA SEMANA QUE SE VA A SUMAR
		var res = n.split("-"); 
		var dia=document.getElementById(res[1]+res[2]+"E").value;
		//alert(dia);
		if(document.getElementById(n).checked)
		{
			total=total+(parseFloat(dia));
		}
		else{
			total=total-(parseFloat(dia));
			document.getElementById(n).disabled=true;			
			document.getElementById(res[1]+res[2]+"E").value='';

		}		
		//alert(total);
		document.getElementById("total-"+f).value=total;		
		
	}
	function modifico_PagoXEvrnto(id,f)
	{	// TOTAL DE	SEMANA ANTERIOR
		var Semana_Anterior=document.getElementById("Total_Semana"+f).value;
		if(Semana_Anterior==''||Semana_Anterior==null||Semana_Anterior=='NaN')
		{Semana_Anterior=0;}Semana_Anterior=parseFloat(Semana_Anterior);
		//		 CANTIDAD DE EVENTOS POR SEMANA
		var Eventos_Semana=document.getElementById("Dias_T"+f).value;
		if(Eventos_Semana==''||Eventos_Semana==null||Eventos_Semana=='NaN')
		{Eventos_Semana=0;}Eventos_Semana=parseFloat(Eventos_Semana);
		// PAGO POR EVENTO
		var PagoEvento=document.getElementById("Salario"+f).value;
		if(PagoEvento==''||PagoEvento==null||PagoEvento=='NaN')
		{PagoEvento=0;}PagoEvento=parseFloat(PagoEvento);
	
		var t=document.getElementById("Total"+f).value;
		if(t==''||t==null||t=='NaN')
		{t=0;}t=parseFloat(t);		
		
		//	CALCULO DE TOTAL SEMANA MODIFICADA
		 var Semana= Eventos_Semana * PagoEvento;
		 //		CALCULO DE NUEVO TOTAL
		 var total=0;
		 if(t>Semana_Anterior){var total= t - Semana_Anterior ;}
		 else{var total= Semana_Anterior - t;}
//		 alert(total);
		 //	CALCULAMOS EL TOTAL DE NUEVO
		 	//alert("total "+total+" Semana "+Semana);
		 total=total+Semana;
		 // COLOCAMOS LA NUEVA SEMANA
		 document.getElementById("Total_Semana"+f).value=Semana;
		 //	COLOCAMOS EL TOTAL
		 document.getElementById("Total"+f).value=total;
		calcula_descuento(f);
	}
	function calcula_descuento(f)
	{
		var d=document.getElementById("Descuentos"+f).value;
		if(d==''||d==null||d=='NaN')
		{d=0;}d=parseFloat(d);		
		var Semana=document.getElementById("Total_Semana"+f).value;
		if(Semana==''||Semana==null||Semana=='NaN')
		{Semana=0;}Semana=parseFloat(Semana);		
		var PE=document.getElementById("PagoEventos"+f).value;
		if(PE==''||PE==null||PE=='NaN')
		{PE=0;}PE=parseFloat(PE);		
			var total=Semana+PE+d;			
		document.getElementById("Total"+f).value=total;
	}
	function modifico_desceunto(id,f)
	{	
		var s=parseFloat($("#Salario"+f).val());
		var di=parseFloat($("#Dias_T"+f).val());
		var d=parseFloat($("#"+id).val());
		alert(id+s+" => "+di+" => "+d);
		$("#Total"+f).val((s*di)+d);		
	}
	function calcula_PagoEventos(id,f)
	{
		var NumE=document.getElementById("Eventos_Sem"+f).value;
		if(NumE==''||NumE==null||NumE=='NaN')
		{NumE=0;}NumE=parseFloat(NumE);		
		var pago=document.getElementById("Pago_E"+f).value;
		if(pago==''||pago==null||pago=='NaN')
		{pago=0;}pago=parseFloat(pago);				
		var t=pago*NumE;
		document.getElementById("PagoEventos"+f).value=t;
		calcula_descuento(f);
	}
	//////////////////////////////////////////////////////////////
	function modifico_PagoXEvrnto2(id,f)
	{	// TOTAL DE	SEMANA ANTERIOR
		var Semana_Anterior=document.getElementById("cTotal_Semana"+f).value;
		if(Semana_Anterior==''||Semana_Anterior==null||Semana_Anterior=='NaN')
		{Semana_Anterior=0;}Semana_Anterior=parseFloat(Semana_Anterior);
		//		 CANTIDAD DE EVENTOS POR SEMANA
		var Eventos_Semana=document.getElementById("cDias_T"+f).value;
		if(Eventos_Semana==''||Eventos_Semana==null||Eventos_Semana=='NaN')
		{Eventos_Semana=0;}Eventos_Semana=parseFloat(Eventos_Semana);
		// PAGO POR EVENTO
		var PagoEvento=document.getElementById("cSalario"+f).value;
		if(PagoEvento==''||PagoEvento==null||PagoEvento=='NaN')
		{PagoEvento=0;}PagoEvento=parseFloat(PagoEvento);
	
		var t=document.getElementById("cTotal"+f).value;
		if(t==''||t==null||t=='NaN')
		{t=0;}t=parseFloat(t);		
		
		//	CALCULO DE TOTAL SEMANA MODIFICADA
		 var Semana= Eventos_Semana * PagoEvento;
		 //		CALCULO DE NUEVO TOTAL
		 var total=0;
		 if(t>Semana_Anterior){var total= t - Semana_Anterior ;}
		 else{var total= Semana_Anterior - t;}
//		 alert(total);
		 //	CALCULAMOS EL TOTAL DE NUEVO
		 	//alert("total "+total+" Semana "+Semana);
		 total=total+Semana;
		 // COLOCAMOS LA NUEVA SEMANA
		 document.getElementById("cTotal_Semana"+f).value=Semana;
		 //	COLOCAMOS EL TOTAL
		 document.getElementById("cTotal"+f).value=total;
		calcula_descuento2(f);
	}
	function calcula_descuento2(f)
	{
		var d=document.getElementById("cDescuentos"+f).value;
		if(d==''||d==null||d=='NaN')
		{d=0;}d=parseFloat(d);		
		var Semana=document.getElementById("cTotal_Semana"+f).value;
		if(Semana==''||Semana==null||Semana=='NaN')
		{Semana=0;}Semana=parseFloat(Semana);		
		var PE=document.getElementById("cPagoEventos"+f).value;
		if(PE==''||PE==null||PE=='NaN')
		{PE=0;}PE=parseFloat(PE);		
			var total=Semana+PE+d;			
		document.getElementById("cTotal"+f).value=total;
	}
	function modifico_desceunto2(id,f)
	{	
		var s=parseFloat($("#cSalario"+f).val());
		var di=parseFloat($("#cDias_T"+f).val());
		var d=parseFloat($("#"+id).val());
	
		$("#cTotal"+f).val((s*di)+d);		
	}
	function calcula_PagoEventos2(id,f)
	{
		var NumE=document.getElementById("cEventos_Sem"+f).value;
		if(NumE==''||NumE==null||NumE=='NaN')
		{NumE=0;}NumE=parseFloat(NumE);		
		var pago=document.getElementById("cPago_E"+f).value;
		if(pago==''||pago==null||pago=='NaN')
		{pago=0;}pago=parseFloat(pago);				
		var t=pago*NumE;
		document.getElementById("cPagoEventos"+f).value=t;
		calcula_descuento2(f);
	}
	function envia_Comision()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{
			document.getElementById('accion').value="Guardar Nomina Comision";
			 document.comision.submit();		      
		}
	}
	function validaNuevoE()
	{
		var nombre=$('#nombre').val();
		var apellidos=$('#apellidos').val();
		var sueldo=$('#sueldo').val();
		var con=0;
		$('.departamento:checked').each(
			function (){
		  		con++;				
			}
		);
		if (con<=0) {alert('SELECCIONE AL MENOS UN DEPARTAMENTO DONDE LABORARA EL EMPLEADO.');}
		else if(sueldo==''){alert("INGRESE UN SUELDO PARA EL EMPLEADO");}
		//else if(apellidos==""){alert("INGRESE LOS APELLIDOS DEL EMPLEADO");}			
		else if(nombre==""){alert("INGRESE EL NOMBRE DEL EMPLEADO");}
		else{ 	
		nuevoE.submit();	}
	}
	function modificaEmpleado(id)
	{
		window.open("modificaEmpleado.php?id="+id, "Modificar Empleado", "width=400, height=300");
	}
	function PreguntaTexto(t)
	{
		window.open("TextoX.php?t="+t, "Ingrese Texto de Fecha", "width=400, height=200");		
	}
	$(".evento").change(function(){
		// OBTENERMOS EL TITLE QUE ES IGUAL AL ID DE SU CHECK CORRESPONDIENTE
		 var id=$("#"+this.id).attr("title");
		//	 HABILITAMOS MARCAMOS POR DEFECTO EL CHECK DE ACUERDO A LA CASILLA MODIFICADA
		//$("#e-"+id).prop("checked", true);
		document.getElementById('e-'+id).disabled=false;
		document.getElementById('e-'+id).checked=true;

		//	REALIZAMOS EL CALCULO DE ACUERDO AL VALOR 
		var indice=id.split("-");
		var t= parseFloat($("#total-"+indice[1]).val());
		
    		if(isNaN(t)){t=0;}		
		var v=parseFloat($("#"+indice[0]+indice[1]+"E").val());
		$("#total-"+indice[1]).val(v+t);
	});
	$(".extras").change(function(){
		// OBTENERMOS EL TITLE QUE ES IGUAL AL ID DE SU CHECK CORRESPONDIENTE
		 var id=$("#"+this.id).attr("title");
		//	 HABILITAMOS MARCAMOS POR DEFECTO EL CHECK DE ACUERDO A LA CASILLA MODIFICADA
		//$("#e-"+id).prop("checked", true);
		document.getElementById(id).disabled=false;
		document.getElementById(id).checked=true;

		//	REALIZAMOS EL CALCULO DE ACUERDO AL VALOR 
		var indice=id.split("-");
		var t= parseFloat($("#total"+indice[1]).val());
		
    		if(isNaN(t)){t=0;}		
		var v=parseFloat($("#"+indice[0]+indice[1]).val());
		$("#total"+indice[1]).val(v+t);
	});
	function validaE()
	{	var total=0;
		$( ".cevento" ).each(function() {			
			var indice=(this.id).split("-");			
			var t= parseFloat($("#total-"+indice[1]).val());	
			if(isNaN(t)){t=0;}		
			var v=parseFloat($("#"+indice[1]+indice[2]+"E").val());
			total+=v;
		});
			$("#total-"+indice[1]).val(total);

	}
	function eliminarFila(id){
		alert(id);
		table.remove(id);
        $("#fila" + id).remove();   
        return true;
    } 
    function SumaC(v,id)
    {
    	var indice=id.split("-");
    	var n=parseFloat($("#normal-"+indice[2]).val());
    	var a=parseFloat($("#aplicada-"+indice[2]).val());
    	if(isNaN(n)){n=0;}		if(isNaN(a)){a=0;}		
    	
    	var f=(a/n)*parseFloat(v);
    	if(isNaN(f)){f=0;}		
    	$("#factor-"+indice[1]).val(f);
    	
    }
    $(".diasT").change(function() {

    	var v=parseFloat($(this).val());    	
   
    	var d=parseFloat($(this).attr("id"));
   		var indice=$(this).attr("name");
   		indice=indice.split('-');
    	var t=d*v;
    	$("#Sueldo"+indice[1]).val(t);
    });
    function detalleE(id)
    {
 		
 		$( "#detalle").text( '' );    
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
      	
            var datos = {
              "id":id                
            };
              $.ajax({
                    type: "POST",
                    url: "detalleEmpleado.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          //console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                          alert("error petición ajax"+tipo);
                          //cargaExternos(tipo);
                    },
                    success: function(data){                                                                            
                         $( "#detalle").append( data );                                     			
                    }
              });                            

    
    }
     $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

     function abrirHistorial(id)
     {
     	window.open("PDFHistorial.php?id="+id);
     }
     function Reajuste(id)
     {
		window.open("Reajuste.php?id="+id, "Modificar Empleado", "width=400, height=300");     	
     }
     function reiniciaN()
     {
     	if(confirm("REINICIAR NOMINAS, MODIFICARA LA INFORMACION DE LOS EMPLEADOS ASI COMO LOS PUNTOS ACUMULADOS Y PREMIOS DE LEALTAD"))
     	{
     		if(confirm("ESTA COMPLETAMENTE SEGURO DE REINICIAR LA NOMINA.?"))
     		{
     			alert('confirmo');
     			  var datos = {
              "accion":'Reinicia-Meseros'               
            };
              $.ajax({
                    type: "POST",
                    url: "Acciones_Nomina.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          //console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                          alert("error petición");
                          //cargaExternos(tipo);
                    },
                    success: function(data){                                                                     
	                    	if(data=='exito')
	                    	{	
	                         alert("REINICIO DE EMPLEADOS EFECTUADO CON EXITO..");  
	                         location.reload();
	                     	}
	                     	else{alert('Algo Salio mal..');}
	                         
                     	}
                                             
              });                            
     		}
     	}
     }
</script>
</body>
</html>