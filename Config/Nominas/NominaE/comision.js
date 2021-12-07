$(document).ready(function(){
	$(".diasT").change(function(){
		var d=this.value;
		var s=this.title;
		var i=this.id;

		s=s*d;

		$("#Sueldo"+i).val(s);
	});
    $("#confirmar").click(function(){
        var r = confirm("Esta Seguro de Confirmar esta Nomina de Comisiones");
    if (r == true) 
    {
         var person = prompt("Ingrese una Fecha de aplicación 'Año/Mes/Dia'", "aaaa/mm/dd");
        if (person != null) 
        {
            document.getElementById("Fecha").value=person;
        }
        var texto = prompt("Ingrese el Texto a Mostrar en el Excel", "Del dia tal del mes tal");
        if (texto != null) 
        {
            document.getElementById("Texto").value=texto;
        }

            NominaComisiones.submit();

    } 
       
    });
    /////////// GUARDAR NOMINA  /////////////77
    ///
    ///
        $("#save").click(function(){
            NominaComisiones.submit();
        });
    ///
	//////////////////		AGREGAR  O ELIMINAR FILAS
	
	 $("#add").click(function(){
//           $("#tComision tbody tr:eq(3)").clone().removeClass('fila-base').appendTo("#tComision tbody");

        var table = document.getElementById("tComision");  
        var fila=$(".Fcontratos").val();
        var row = table.insertRow(fila);

        fila++; // CONTROL DE FILAS
        $(".Fcontratos").val(fila); // CONTROL DE FILAS
        var row2 = table.insertRow(fila);
       var cel = row.insertCell(0);
        cel.colSpan='2';
        row.id='PrecioComen-'+fila;
    cel.bgColor='#FAFFBF';
       /*
        var cell2 = row.insertCell(1);

        cell1.innerHTML = "Quiero insertar input text aaqui";
        cell2.innerHTML = "Aqui tambien";
*/
    cel.innerHTML="<td colspan='2'>Precio Por Comensal</td>";
//alert($(".empleados").val());
//
///////// AGREGAR FILAS A LA TABLA 
//
var nEmpleados=$(".empleados").val();  /////////// # DE EMPLEADOS

////////////////    PRECIO POR COMENSAL
         for(i=1;i<=$(".empleados").val();i++)
        {        
            var cel2 = row.insertCell(i);     
            cel2.innerHTML = "<input style='width:70px;' type='text' name='pComensal-"+i+"-"+((fila/2)-1)+"' title='pComensales"+i+"' value='0' class='PrecioComensal"+fila+" ' onchange='PrecioComensal(this.value,"+fila+")' />";
            cel2.align='center';
            cel2.colSpan='2';
            cel2.bgColor='#FAFFBF';
        }
        
            nEmpleados++;
            var cel2 = row.insertCell(nEmpleados);     
            cel2.innerHTML = "";    
             cel2.align='center';
            cel2.colSpan='2';
            cel2.bgColor='#FAFFBF'; 

///////7    CONTRATOS Y FACTOR  //////////////////////////////////7
///
///
    var cell1 = row2.insertCell(0);
    var cell2 = row2.insertCell(1);        
    //var cell3 = row22.insertCell(1);                
    cell1.innerHTML = "<input type='text' name='Contrato-"+((fila/2)-1)+"'  style='width:60px' placeholder='Contrato' />";
    cell1.align='center';
    cell1.bgColor='#F9D8D8';
    cell2.innerHTML = "<input style='width:40px;' type='number' min='0' name='nComensales-"+((fila/2)-1)+"' title='Comensal-' id='Comensal' placeholder='Comensal' class='cComensales"+fila+"' value='0' onchange='PrecioComensal(this.id,"+fila+");'>";
    cell2.align='center';
    cell2.bgColor='#F9D8D8';
    nEmpleados=nEmpleados-1;
    var columna=1;
    for(i=1;i<=(nEmpleados);i++)
    {

       var cell1 = row2.insertCell(i*2);
       var cell2 = row2.insertCell((i*2)+1);
       cell1.innerHTML = "<input style='width:50px;' type='text' title='factor' name='factor-"+i+"-"+((fila/2)-1)+"' class='factor-"+i+fila+"'  value='0' >";
       cell1.bgColor='#F9D8D8';
       cell2.innerHTML = "<input style='width:50px;' type='text' title='x' class='comision"+i+fila+" "+i+" rComisiones"+i+"' name='comisionContrato-"+i+"-"+((fila/2)-1)+"' id='x' value='0' />";
       cell2.bgColor='#F9D8D8';
       columna+=2;
    }
    //nEmpleados++;

        
            var cel3 = row2.insertCell(columna+1);     
            var cel4 = row2.insertCell(columna+2);                 
                cel3.innerHTML = "<input style='width:40px;' type='number' min='0' class='normal-"+fila+"' value='0' name='normal-"+((fila/2)-1)+"' title='normal' onchange='CalculaFactor(this.value,"+fila+")' />";   
                cel4.innerHTML = "<input style='width:40px;' type='number' min='0' class='aplicada-"+fila+"' value='0' name='aplicada-"+((fila/2)-1)+"' title='aplica' onchange='CalculaFactor(this.value,"+fila+")' />";
                cel3.align='center';            
                cel4.align='center';            
                cel3.bgColor='#FAFFBF'; 
                cel4.bgColor='#FAFFBF'; 
///
///
////////////////////////////////////////////////
///

        fila++; // CONTROL DE FILAS
        $(".Fcontratos").val(fila); // CONTROL DE FILAS
        var ff=fila-2;
        $(".Filas").val(ff/2); // CONTROL DE FILAS

});
 
        /**
         * Funcion para eliminar la ultima columna de la tComision.
         * Si unicamente queda una columna, esta no sera eliminada
         */
        $("#del").click(function(){
            // Obtenemos el total de columnas (tr) del id "tComision"
            var trs=$("#tComision tr").length;
            if(trs>1)
            {
                // Eliminamos la ultima columna
                $("#tComision tr:last").remove();
            }
        });  
	////////////77777	TERMINA AGREGAR O ELIMINAR FILAS
});



/////////////////////////       FUNCIONES DE CALCULOS GENERALES    ///////////////////////////
function PrecioComensal(v,f)
{
 // alert("que rollo "+v+" "+f);
    CalculaFactor(3,f);
}

function CalculaFactor(v,fila)
{
    //alert("cambio "+v+" "+fila);
    var normal=0;
    normal=$(".normal-"+fila).val();
    var aplicada=0;
    aplicada=$(".aplicada-"+fila).val();
    //alert("Normal "+normal+" Aplicada "+aplicada);
    //  Formula=  ((Aplicada entre Normal) * PrecioComensal = Factor)
    //  
    var f=0;
    f= parseFloat(aplicada)/parseFloat(normal);
    //alert("Esto es f "+f);
    var inc=1;
    
   $( "#PrecioComen-"+fila+" td input" ).each(function() {
        var pc=parseInt($(this).val());
       // alert(pc);
        var ff=f*pc;        
        $(".factor-"+inc+fila).val(ff)
        var cComensales=parseInt($(".cComensales"+fila).val());
        var comision=ff*cComensales;
        if(isNaN(comision)) 
        {
                comision = 0;
        }
        $(".comision"+inc+fila).val(comision);              
        inc++;
    });
   
    //  
    //
    reCorreComisiones();  // CALCULA COMISIONES
    recorreClases();    //CALCULA BRUTO
    calculaNeto();

}
function recorreClases()
{
    //alert($(".empleados").val());
    
    for (var i =1; i <= $(".empleados").val(); i++) 
    {        
        var t=0;
         $( "."+i ).each(function() {
            var p=parseFloat($(this).val());            

            t=parseFloat(t)+parseFloat(p);
            //alert("Clase : "+i+" valor: "+p+" Total:"+t);
            //t+=parseFloat($("#Comision"+i).val());        
            //alert("Esto es p en clase "+i+" "+p);            
            
         });
         $("#Brutot"+i).text(t);
         $("#Bruto"+i).val(t);
    }

    
    /* 
    */
}
function reCorreComisiones()
{
    
     for (var i =1; i <= $(".empleados").val(); i++) 
    {
       // alert($("#Comision"+i).val());
        var t=0;
         $( ".rComisiones"+i ).each(function() {
             var p=parseFloat($(this).val());
             t+=p;           
         });
         if(isNaN(t)) 
         {
                t = 0;
         }
          $("#Comisiont"+i).text(t);
            $("#Comision"+i).val(t);
    }
}
function calculaNeto()
{
    for (var i =1; i <= $(".empleados").val(); i++) 
    {
         var b=parseFloat($("#Bruto"+i).val());    
         b+=parseFloat($("#Descuento"+i).val());
         $("#Neto"+i).val(b);
         $("#Netot"+i).text(b);
    }
}