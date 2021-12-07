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
	var numero = prompt("Introsuzca Contrato", "");
    if (numero != '') {
		for(x=0;x<contratos.length;x++){
			if(contratos[x]==numero){
				bandera=true;
			}
		}
		if(numero==null || numero==''){
			
		}else if(!bandera){
			agregar_fila(numero);
		}else{
			alert("Error ya existe el contrato");
			myFunction();
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
	   cel2.innerHTML = "<input style='width:70px;' type='text' title='Precio_Comen"+(ll)+"-"+fila+"' name='Precio_Comen"+(ll)+"-"+fila+"' id='Precio_Comen"+(ll)+"-"+fila+"' onchange='SumaC(this.value)'/>";
	   cel2.align='center';
	   cel2.colSpan='2';
	   cel2.bgColor='#FAFFBF';
    }
	
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);        
    //var cell3 = row2.insertCell(1);                
    cell1.innerHTML = "<input type='text' name='Contrato"+inc+"' value='"+c+"' readonly='readonly' style='width:60px' />";
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
	   cell2.innerHTML = "<input style='width:50px;' type='text' title='x"+(l)+"-"+fila+"' name='x"+(l)+"' id='x"+(l)+"-"+fila+"' onchange='SumaC(this.value)'/>";
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
    cel2.innerHTML = "<input style='width:40px;' type='number' min='0' id='normal-"+inc+"' name='normal-"+inc+"' title='normal-"+inc+"' onChange='calcula_Factor(this.value,"+fila+")'/>";   
    cel3.innerHTML = "<input style='width:40px;' type='number' min='0' id='aplicada-"+inc+"' name='aplicada-"+inc+"' title='aplica-"+inc+"' onChange='calcula_Factor(this.value,"+fila+")'/>";
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
function calcula_Comision(Come,fila)
{	
alert('Entro a Comision');
	var tE=parseInt(NumE);
		var filas=inc-1;		
		var tot=tE*filas;
	if (filas>1)  
		{n=(tE*(filas-1)+1);
		}
		//alert("Total E "+tE);
	for(o=inicio;o<=tot;o++)
	{
		var S_Com=0;	var residuo=0;
	   var Factor=document.getElementById('factor-'+(o+n)).value;	 
  	   var Comision=(Factor*Come);	
  	   document.getElementById("x"+(o+n)+"-"+fila).value = Comision;	  	  
	  // alert("o = "+o+" o+n = "+(o+n));
	   residuo=((o+n)%tE);	   
	  if(residuo==0)  {residuo=tE;} 
	 // alert(document.getElementById("Comision"+(residuo)).value);
	 // 	SUMA DE COMISIONES
		var S_com=document.getElementById("Comision"+(residuo)).value;
		if(S_com==''||S_com==null)
		{S_com=0;}
		S_com=parseFloat(S_com);
		document.getElementById("Comision"+(residuo)).value = (Comision+S_com);	
		if(filas<=1)
		{
			var sueldo=document.getElementById("Sueldo"+(residuo)).value;
			if(sueldo==''||sueldo==null){sueldo=0;}
			sueldo=parseFloat(sueldo);
			document.getElementById("Bruto"+(residuo)).value = (sueldo+Comision);
			 document.getElementById("Neto"+(residuo)).value=(sueldo+Comision);
		}
		else if(filas>1)
		{
			var Br=document.getElementById("Bruto"+(residuo)).value;
			Br=parseFloat(Br);
			Br=Br+Comision;
			document.getElementById("Bruto"+(residuo)).value=Br;
			 document.getElementById("Neto"+(residuo)).value=Br;
			
		}
	};
	
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
		//alert("Entro " +n );
		// 	OBTENEMOS LO QUE HAYA EN LOS TOTALES
		var total=document.getElementById("total"+f).value;
		if(total==''||total==null) // SI NO EXISTE NADA EN EL TOTAL ESTE SERA 0
		{
			total=0;			
		}
		total=parseFloat(total);
		// OBTENEMOS EL VALOR DE LA SEMANA QUE SE VA A SUMAR
		var res = n.split("-"); 
		var dia=document.getElementById(res[0]).value;
		//alert(document.getElementById(n).checked)
		if(document.getElementById(n).checked)
		{
			total=total+(parseFloat(dia));
		}
		else{total=total-(parseFloat(dia));}		
		//alert(total);
		document.getElementById("total"+f).value=total;		
		
	}// JavaScript Document
	function re_Calcula()
	{
		alert('entro al Re Calculo');
	}