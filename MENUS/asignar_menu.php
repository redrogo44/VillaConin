<html>
	<head>
		<title>Asignar Menu</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script>
    <?php
		require("../funciones2.php");
		conectar();
		$ad=mysql_fetch_array(mysql_query("select sum(cantidad) as t from logistica_menu where tipo_comensal='adultos' and contrato='".$_GET['numero']."'"));
		if($ad['t']==''){$ad['t']=0;}
			echo "var adultos_asignados=".$ad['t'].";";
			$jo=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='jovenes' and contrato='".$_GET['numero']."'"));
		if($jo['t']==''){$jo['t']=0;}
			echo "var jovenes_asignados=".$jo['t'].";";
		$ni=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='ninos' and contrato='".$_GET['numero']."'"));
		if($ni['t']==''){$ni['t']=0;}
			echo "var ninos_asignados=".$ni['t'].";";

		$e=mysql_fetch_array(mysql_query("select * from Extras where id=".$_GET["numero"]));
		$t_comensales=$e["comensales"];
			?> 
     </script>
	</head>
	<body onload='mostrar_menu()'>		
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

		<script>
		

		 var total_c=<?php echo $t_comensales;?>;
		var adultos=0;
		var jovenes=0;
		var ninos=0;


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
		xmlhttp.open("POST","../info_platillo.php",true);
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
		xmlhttp.open("POST","../mi_menu.php",true); 
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
		xmlhttp.open("POST","../mi_menu.php",true);
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
		xmlhttp.open("POST","../logistica_buscar.php",true);
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
		xmlhttp.open("POST","../logistica_buscar.php",true);
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
				xmlhttp.open("POST","../logistica_buscar.php",true);
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
			xmlhttp.open("POST","../logistica_buscar.php",true);
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
			xmlhttp.open("POST","../logistica_buscar.php",true);
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
				xmlhttp.open("POST","../logistica_buscar.php",true);
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
				xmlhttp.open("POST","../logistica_buscar.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("type=remove_one&id="+id+"&cant="+cantidad);

		}
		</script>
	</body>
</html>