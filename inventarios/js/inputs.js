$(function(){
	$('#categoria').autocomplete({
		source : 'consultas/categoria.php'
	});
});
$(function(){
	$('#subcategoria').autocomplete({
		source : 'consultas/subcategoria.php'
	});
});
$(function(){
	$('#unidad').autocomplete({
		source : 'consultas/unidad.php'
	});
});
