
function b_inv(categoria)
{
  alert(categoria);
var xmlhttp;
document.getElementById('loader').style.display = 'block';
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log(xmlhttp.responseText)
      document.getElementById('loader').style.display = 'none';
      document.getElementById("resultado").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","c_inventario.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("categoria="+categoria+"&fecha_max="+fecha_corte);
}

// function cargar_inventario(id,ii,consumido,costo,etapa,fecha,hora)
// {
// //alert("id="+id+"&ii="+ii+"&consumido="+consumido+"&costo="+costo+"&etapa="+etapa+"&fecha="+fecha+"&hora="+hora);
// var xmlhttp;
// if (window.XMLHttpRequest)
//   {// code for IE7+, Firefox, Chrome, Opera, Safari
//   xmlhttp=new XMLHttpRequest();
//   }
// else
//   {// code for IE6, IE5
//   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
// xmlhttp.onreadystatechange=function()
//   {
//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
// 		document.getElementById("resultado2").innerHTML=xmlhttp.responseText;
// 		if(xmlhttp.responseText=="FINALIZANDO...."){
// 			alert("La actualizacion a finalizado");
// 			finaliza_registro(fecha,hora);
// 		}else{
			
// 		}
//     }
//   }
// xmlhttp.open("POST","a_inventario.php",true);
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
// xmlhttp.send("id="+id+"&ii="+ii+"&consumido="+consumido+"&costo="+costo+"&etapa="+etapa+"&fecha="+fecha+"&hora="+hora);
// }

function cargar_inventario(result, fecha, hora)
{
  var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("resultado2").innerHTML=xmlhttp.responseText;
        console.log("RESPUESTA DEL HAYA", xmlhttp.responseText)
        if(xmlhttp.responseText=="FINALIZANDO....") {
          alert("La actualizacion a finalizado");
          finaliza_registro(fecha, hora);
        }
      }
    }
    xmlhttp.open("POST","carga_inventarioRedrogo.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send('myArray=' + JSON.stringify(result));
}
