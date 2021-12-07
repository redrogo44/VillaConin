<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
				  height:auto;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;}
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:160px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-160px;
				top:0px;}			 
    </style>
</head>
<script language="javascript" type="text/javascript">
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
</script> 
<body>
 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
conectar();
$query0="select * from cliente where id=".$_GET['idcliente'];
	$res=mysql_query($query0);

	while($m=mysql_fetch_array($res))
	{
		$nomc=$m['nombre'];
		$ap=$m['ap'];
		$am=$m['am'];		
	}
	$q3="select * from preregistro where nombre='".$nomc."' and ap='".$ap."' and am='".$am."'";
	$re=mysql_query($q3);
	while($m=mysql_fetch_array($re))
	{
        $fechaevento=$m['fecha'];
	}
?>


<!--ESTILO CUERPO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>

<b style="border-color:#900" style="color:#900">PRE-CONTRATO</b>
	 <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <form action="altacontrato.php" method="post" name="newcontrato">
                 <td><b>Nombre de Contrato</b></td>
        <td><input id="name" name="nom" type="text" size="35" maxlength="35" placeholder="		Nombre"  required="required" onchange="valida()" value="<?php echo $nomc." ".$ap." ".$am?>">
<tr>
          

      <tr>
         <td><b>Fecha de Contrato</b></td>
         <td align="center">
         		<script>
					var mydate=new Date(); 
					var year=mydate.getYear(); 
					if (year < 1000) 
					year+=1900; 
					var day=mydate.getDay(); 
					var month=mydate.getMonth()+1; 
					if (month<10) 
					month="0"+month; 
					var daym=mydate.getDate(); 
					if (daym<10) 
					daym="0"+daym; 
					document.write("<small><font  color='000000' face='Arial'><b >"+daym+"/"+month+"/"+year+"</b></font></small>") 
					</script> 
       </td>
      </tr>

    <tr>
       <td><b>Fecha Evento</b></td>
       <td>
       	<input type="date" name="fechaevento" class="tcal" value="<?php echo $fechaevento;?>" />
       </td>
    </tr>
    <tr>
       <td><b>Festejado</b></td>
       <td>
       	<input type="text" name="festejado" class="tcal" required />
       </td>
    </tr>
    
    <?php
	conectar();
	$query="select * from cliente where id=".$_GET['idcliente'];
	$res=mysql_query($query);

	while($m=mysql_fetch_array($res)){
		
		echo '<tr>
       <td><b>Domicilio</b></td>
       <td><small>
    '.$m['dom'].'</small>
    <tr>
	<tr><td>RFC</td><td>'.$m['rfc'].'</td></tr>
	<tr><td>Correo</td><td>'.$m['mail'].'</td></tr>
	<tr><td>Telefono</td><td>'.$m['tel'].'</td></tr>
	';
		
		}
		
		
		$v="Select usuario from usuarios Where nivel=4";
		$Vende=mysql_query($v);
    ?>
    <input type="hidden" value=<?php echo $_GET[idcliente];?> name="idcliente"/>
    
    <tr>
       <td><b>Tipo de Evento</b></td>
        <td><label for='tipoevento'></label>
<select name='tipo' id='tipo' onchange="activar(this.form)">
            <option value='Seleccione una opcion'>Seleccione una Opcion</option>
            <option value='Bautizo'>Bautizo</option>
           <option value='Boda'>Boda</option>
            <option value='XV Años'>XV Años</option>
            <option value='Empresarial'>Empresarial</option>
            <option value='Graduacion'>Graduacion</option>
            <option value='Primera Comunion'>Primera Comunion</option>
            <option value='Cumpleaños'>Cumpleaños</option>
 			<option value='Presentacion'>Presentacion</option>
            <option value='Otros'>Otros</option>
           
        </select></td>

    </tr>
    <tr>
       <td><b>Salon</b></td>
        <td><label for='tipoevento'></label>
<select name='salon' id='salon' onchange="activar(this.form)">
            <option value='Seleccione una opcion'>Seleccione una Opcion</option>
            <option value='Fundador de Conin'>Fundador de Conin</option>
           <option value='Real de Conin'>Real de Conin</option>
            <option value='Alcazar de Conin'>Alcazar de Conin</option>
            <option value='Solar de Conin'>Solar de Conin</option>
			<option value="Marques">Marqués</option>
        </select></td>

    </tr>
    <tr>
       <td><b>Vendedor</b></td>
        <td><label for='tipoevento'></label>
<select name='vendedor'  onchange="activar(this.form)" >
			<option value='Seleccione una opcion'>Seleccione una Opcion</option>            
            <?php
			while($Vendedor=mysql_fetch_array($Vende))
			{
				$VENDEDOR=explode(" ",$Vendedor['usuario']);
			echo "<option value='".$VENDEDOR[1]."'>".$VENDEDOR[1]."</option>";					
			}
			?>                     
        </select></td>
    </tr>         
      <tr >
          <tr>
         <td></td>
         <td align="center">
       <p><input type="submit" name="buto" disabled="true" /></p>
</form>
       </td>
       </tr>
      </td>  
    </tr>
   </table>
</div>
</body>
</html>
<script>
function activar(formulario){
 if(document.newcontrato.tipo.value != "Seleccione una opcion" && document.newcontrato.salon.value!="Seleccione una opcion" && document.newcontrato.vendedor.value!="Seleccione una opcion") 
document.newcontrato.buto.disabled = false 
else 
document.newcontrato.buto.disabled = true 
}
</script>
