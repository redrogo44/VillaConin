
function c(costo)
{
var xmlhttp;
var categoria= document.getElementById("categoria").value;
var tipo= document.getElementById("tipo").value;
var descripcion= document.getElementById("descripcion").value;

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
    document.getElementById("cost").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","costopromedio.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("costo="+costo+","+categoria+","+tipo+","+descripcion);
}