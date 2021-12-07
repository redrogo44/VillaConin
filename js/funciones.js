var tsi;
var tci;

	function d1(selectTag){
	 if(selectTag.value == 'otro1'){
	document.getElementById('prg1').disabled = false;
	 }else{
	 document.getElementById('prg1').disabled = true;
	 }
	}
	function Redireccionar()
	{
		location.href="Cliente-nuevo.php";
	}
	function valida(){
		var x=document.getElementById('name').value;
		
		}
	function calcular1(){
		var ca = document.getElementById('c_adultos').value;
		var pa = document.getElementById('p_adultos').value;
		var sub_adultos=ca*pa;
		document.getElementById('t_adultos').innerHTML = sub_adultos;
		total();
	}
	function calcular2(){
		var cj = document.getElementById('c_jovenes').value;
		var pj = document.getElementById('p_jovenes').value;
		var sub_jovenes=cj*pj;
		document.getElementById('t_jovenes').innerHTML = sub_jovenes;
		total();
		}
	function calcular3(){
		var cn = document.getElementById('c_ninos').value;
		var pn = document.getElementById('p_ninos').value;
		var ninos=cn*pn;
		document.getElementById('t_ninos').innerHTML = ninos;
		total();
	}
	function total(){
		var ca = document.getElementById('c_adultos').value;
		var pa = document.getElementById('p_adultos').value;
		var sub_adultos=ca*pa;
		var cj = document.getElementById('c_jovenes').value;
		var pj = document.getElementById('p_jovenes').value;
		var sub_jovenes=cj*pj;
		var cn = document.getElementById('c_ninos').value;
		var pn = document.getElementById('p_ninos').value;
		var sub_ninos=cn*pn;
		 dee=document.getElementById('depos').value;
		document.getElementById('d').innerHTML = dee;
		

				var impuesto=(sub_adultos+sub_jovenes+sub_ninos)*.16;
				document.getElementById('st').innerHTML = sub_adultos+sub_jovenes+sub_ninos;
				document.getElementById('i').innerHTML = impuesto.toFixed(2);
				var totalfinal=sub_adultos+sub_jovenes+sub_ninos;
				var totalfinal2=parseFloat(totalfinal)+parseFloat(impuesto)+parseFloat(dee);
				document.getElementById('t').innerHTML = parseFloat(totalfinal2.toFixed(2));
			
		
	
	}
	
	function todo(){
	
	var ca = document.getElementById('c_adultos').value;
		var pa = document.getElementById('p_adultos').value;
		var sub_adultos=ca*pa;
		document.getElementById('t_adultos').innerHTML = sub_adultos;
	
	var cj = document.getElementById('c_jovenes').value;
		var pj = document.getElementById('p_jovenes').value;
		var sub_jovenes=cj*pj;
		document.getElementById('t_jovenes').innerHTML = sub_jovenes;
	
	var cn = document.getElementById('c_ninos').value;
		var pn = document.getElementById('p_ninos').value;
		var ninos=cn*pn;
		document.getElementById('t_ninos').innerHTML = ninos;
	var depo=document.getElementById('depos').value;
	document.getElementById('d').innerHTML = depo;

				var impuesto=(sub_adultos+sub_jovenes+sub_ninos)*.16;
				document.getElementById('st').innerHTML = sub_adultos+sub_jovenes+sub_ninos;
				document.getElementById('i').innerHTML = impuesto.toFixed(2);
				var totalfinal=parseFloat(sub_adultos)+parseFloat(sub_jovenes)+parseFloat(sub_ninos)+parseFloat(impuesto)+parseFloat(depo);
				document.getElementById('t').innerHTML = parseFloat(totalfinal.toFixed(2));
		
	
	
	}