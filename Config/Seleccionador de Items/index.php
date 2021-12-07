<html>
<head>
<script src="includes/prototype.js" type="text/javascript"></script>
<!-- <script src="includes/scriptaculous.js" type="text/javascript"></script> -->

<style type="text/css">
 
  
</style>
</head>
<body >

<table>
<tr>
	<td>
		<select id="select" size=4>
		</select>
	</td><td>
		<input type="button" onClick="add1();" value =">>"/><br/>
		<input type="button" onClick="add2();" value ="<<"/>
	</td><td>
		<select id="select2" size=4>
		</select>
	</td>
</tr>
</table>

<script type="text/javascript">

function add1()
{
	if (getSelectText($('select'))!=null)
	{
		var option=new Element('option',{"value":$F('select')}).update(getSelectText($('select')));
		$('select2').appendChild(option);
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

// agrego valores al select
var option = new Element('option',{'value':3}).update('opcion3');
$('select').appendChild(option);
var option = new Element('option',{'value':2}).update('opcion2');
$('select').appendChild(option);
var option = new Element('option',{'value':1}).update('opcion1');
$('select').appendChild(option);

</script>
</body>
</html>
