<html>
<head>
<meta charset="UTF-8">
<script src="includes/prototype.js" type="text/javascript"></script>
<!-- <script src="includes/scriptaculous.js" type="text/javascript"></script> -->

<style type="text/css">
 
  
</style>
</head>
<body >
<form action="cargarabono.php" method="post">
<table border="6" bordercolor="#990000">
<tr>
	<td>
		<select id="select" multiple>
		</select>
	</td>
     
    <td>
		<input type="button" onClick="add1()" value =">>"/><br/>
		<input type="button" onClick="add2()" value ="<<" />
		
	</td>
    <td>
    <select multiple id="select2" name="select2[]" >
		</select>
    </td>
    <td>
    <input type="hidden" name="numero" value="X080214L"/>
    <input type="submit" onClick="seleccionar()" value="Enviar" />
    </td>
    
</tr>
</table>
</form>
<script type="text/javascript">
var selecciones = new Array();
var incre=0;

function add1()
{
	if (getSelectText($('select'))!=null)
	{
		var option=new Element('option',{"value":$F('select')}).update(getSelectText($('select')));
		$('select2').appendChild(option);
		selecciones[incre] = option;
		incre=incre+1;
		removeOption ($('select'), $F('select'))
	}
}
function add2()
{
	if (getSelectText($('select2'))!=null)
	{
		var option=new Element('option',{"value":$F('select2')}).update(getSelectText($('select2')));
		$('select').appendChild(option);
		removeOption ($('select2'), $F('select2'));
	}
}

function removeOption (element, id)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==id)
		{
			element.down(n).remove();
		}
		n++;
	}
}

// funcion que devuelve el texto
function getSelectText(element)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==element.getValue())
		{
			return(element.down(n).innerHTML)
		}
		n++;
	}
	return null;
}

function dimePropiedades()
{
	document.write(seleccionados.length);
	for (i=0; i<=seleccionados.length; i++)
	{	
		document.write(selecciones[i]);
	}
}

function seleccionar(){
	select = document.getElementById("select2");
	for (var i = 0; i < select.options.length; i++) {
		select.options[i].selected = true;
	}
}


<?PHP 
require "configuraciones.php";
conectar();
$q="Select * from Servicios";
$consulta=mysql_query($q);
$var =1;
while($con=mysql_fetch_array($consulta))
{
	$option=$con['Servicio'];
	echo "var option = new Element('option',{'value':".$var."}).update('".$option."');
	$('select').appendChild(option);";
	$var=$var+1;
}
?>
// agrego valores al select





</script>
</body>
</html>
