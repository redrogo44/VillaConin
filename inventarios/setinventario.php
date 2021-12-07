<?php
require 'funciones.php';
conectar();
session_start();
$_SESSION['table'] = $_GET['op'];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Inventario Villa Conin</title>
		<link rel="shortcut icon" href="../Imagenes/icono.png">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/loader.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="js/contenido_inventario.js"></script>
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
	</head>
	<body>
	<div id="modal" style="display:none">
	
	<!--div del loader de consulta-->
		<div class="windows8" id='loader' style='display:none;'>
				<div class="wBall" id="wBall_1">
					<div class="wInnerBall">
					</div>
				</div>
				<div class="wBall" id="wBall_2">
					<div class="wInnerBall">
					</div>
				</div>
				<div class="wBall" id="wBall_3">
					<div class="wInnerBall">
					</div>
				</div>
				<div class="wBall" id="wBall_4">
					<div class="wInnerBall">
					</div>
				</div>
				<div class="wBall" id="wBall_5">
					<div class="wInnerBall">
					</div>
				</div>
			</div>
		</div>
		<!--fin del loader-->
		
		<div class="container">
			<?php
			/////////////////////////Menu
			menu();
			?>
		<header>	
			<style type="text/css">
				.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 400px !important;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
  height: 150px;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
			</style>
		<!-- <input style='position:absolute;right:130px;' placeholder="Buscar Categoria" id="b_inv" onkeyup='b_inv(this.value)' onblur='b_inv(this.value)'> -->
		<input style='position:absolute;right:130px;' placeholder="Buscar Categoria" id="b_inv">
		<!-- <button onclick='alert(this.value);'>Buscar</button> -->

		<div style='position:absolute;right:130px;top:140px;'>
		<!--button onclick='enviar();'>Guardar Inventario</button-->
		<button onclick='RecorrerForm();'>Corte de Inventario</button>
		</div>
		</header>
		<div id='resultado2' name='resultado2' style='color:#fff;font-size:30px;'>
		</div>
		<center><div id='resultado' name='resultado'>
		</div>
		</center>
		</div><!-- /container -->
<!-- template for the modal component -->
<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body" align="center">
            <slot name="body">
            	<input id="fechaxx" type="date" name="">
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button" @click="fechaCorte">
                ACEPTAR 
              </button>
              &nbsp;&nbsp;&nbsp;
              <button class="modal-default-button" @click="$emit('close')">
               CANCELAR
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>

<!-- app -->
<div id="app">
  <!-- use the modal component, pass in the prop -->
  <modal v-if="modal" @close="modal = false">
    <!--
      you can use custom content here to overwrite
      default content
    -->
    <h3 slot="header">Introduzca la fecha de corte</h3>
  </modal>
</div>
	</body>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<script>
			var fecha_corte='';
			Vue.component('modal', {
				template: '#modal-template',
				data() {
					return {
						modal: true
					}
				},
				methods: {
					fechaCorte () {
						fecha_corte=$('#fechaxx').val();
						vue.modal = false
						// console.log('FECHA DE CORTE', fecha_corte);
						if (fecha_corte == '') {
							alert('Seleccione una fecha');
							vue.modal = true
						}
					}
				}
			})

// start app
var vue = new Vue({
  el: '#app',
  data: {
    modal: true
  }
})	
	$('#b_inv').focusout(function() {
		var x = $(this).val();
		b_inv(x);
	});
		
			$(function(){
				$('#b_inv').autocomplete({
					source : 'categoria.php'
				});
			});
			
		function validarFormatoFecha(campo) {
			  var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
			  if ((campo.match(RegExPattern)) && (campo!='')) {
					return true;
			  } else {
					return false;
			  }
		}
		function existeFecha(fecha){
		  var fechaf = fecha.split("/");
		  var day = fechaf[0];
		  var month = fechaf[1];
		  var year = fechaf[2];
		  var date = new Date(year,month,'0');
		  if((day-0)>(date.getDate()-0)){
				return false;
		  }
		  return true;
	}
		
		function enviar(){
			alert("estoy en funcion enviar");
			/*if(confirm("Esta seguro en realizar el corte de inventario?")){
				alert(fecha_corte);
				document.getElementById('fecha_corte').value=fecha_corte;
				document.inventario.submit();
			}*/
		}
		function calcular(num){
			inventario=document.getElementById(num).value;
			ci=document.getElementById('cantidad'+num).value;
			p=document.getElementById('precio'+num).value;
			unidades=ci-inventario;
			document.getElementById('real'+num).innerHTML = unidades;
			document.getElementById('faltantes-'+num).value=unidades;
			dinero=unidades*p;
			document.getElementById('money'+num).innerHTML = '$ '+dinero;
			//alert('cantidad teorica='+inventario+"/n faltantes="+unidades);
		}
		
		function ingresar_fecha(){
			var fecha = prompt("Introduzca la fecha de corte", "dd/mm/YYYY");
				if (fecha != null) {
					if(validarFormatoFecha(fecha)){
				      if(existeFecha(fecha)){
							var f = fecha.split("/");
							var nf=f[2]+'-'+f[1]+'-'+f[0];
							fecha_corte=nf;
				      }else{
				            alert("La fecha introducida no existe.");
							ingresar_fecha();
				      }
				}else{
				      alert("El formato de la fecha es incorrecto.");
						ingresar_fecha();
					}
				}
		
		}
		
		function RecorrerForm()
		{
			//alert(fecha_corte);
			////hacemos visible el loader
			//document.getElementById('modal').style.display = 'block';
			//document.getElementById('loader').style.display = 'block';
			var hoy= new Date();
			var hora=hoy.getHours()+':'+hoy.getMinutes()+':'+hoy.getSeconds();
			///insertamos en la base de datos
				////////////insertar en corte de inventario
				//cargar_inventario(0,0,0,0,1,fecha_corte,hora);
				
				////////////actualizamos tabla inventario e insertamos en detalle				
				var frm = document.getElementById("inventario");
				i=1;
				let response = [];
				let cont = 0;
				while(i<frm.elements.length)
				{	
					id=frm.elements[i].name;
					i=i+1;
					ii=frm.elements[i].value;
					i=i+2;
					consumido=frm.elements[i].value;
					i=i+1;
					costo=frm.elements[i].value;
					i=i+1;
					// cargar_inventario(id,ii,consumido,costo,2,fecha_corte,hora);
					response[cont] = {
						id: id,
						ii: ii,
						consumido: consumido,
						costo: costo,
						etapa: 2,
						fecha_corte: fecha_corte,
						hora:hora
					};
					cont++;
				}
				// cargar_inventario(0,0,0,0,3,fecha_corte,hora);
				// response[cont] = {0,0,0,0,3,fecha_corte,hora};
				response[cont] = {
						id: 0,
						ii: 0,
						consumido: 0,
						costo: 0,
						etapa: 3,
						fecha_corte: fecha_corte,
						hora:hora
					};
				console.log(fecha_corte, hora)
				console.log(response);
				cargar_inventario(response, fecha_corte, hora);
		}
            
            
		function finaliza_registro(fecha,hora){
			//abrimos el PDF
			categoria=document.getElementById("categoria").value;
			window.open("insertar_corte.php?fecha="+fecha+"&hora="+hora, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			window.open("PDF_inventario.php?categoria="+categoria, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			//ocultamos el loader
			//document.getElementById('loader').style.display = 'none';
			//redireccionamos
			window.location="inventario.php";
		}
			// register modal component

		</script>
		
</html>