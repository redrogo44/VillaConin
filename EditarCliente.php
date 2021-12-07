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
				  width:700px;
				  right:1000px;
				  height:20px;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
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
				right:-150px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
 }else{
 document.getElementById('prg1').disabled = true;
 }
}
</script>
</head>
<body>

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
		$mail=$m['mail'];
		$rfc=$m['rfc'];
		$rgm=$m['regimen'];						
		$dcom=$m['dcom'];
		$dom=$m['dom'];
		$cp=$m['cp'];
		$tel=$m['tel'];		
	}
?>

<div align="center">
<br /><br /><br  style="background-position:center"/>

	 <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="EditadoCliente.php" method="post" >
          <td><b>Nombre</b></td>
          <td><input name="nom" type="text" size="35" maxlength="35"  required value="<?php echo $nomc;?>">
       </tr>
       
       <tr>
        <td><b>Apellido Paterno</b></td>
        <td><input name="ap" type="text" size="35" maxlength="35"   value="<?php echo $ap;?>" required>
      </tr>

      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="am" type="text" size="35" maxlength="35"  value="<?php echo $am;?>" required>

      </tr>

    <tr>
       <td><b>E-mail</b></td>
       <td><input name="mail" type="email" size="35" maxlength="" value="<?php echo $mail;?>" required>
    </tr>
     
    
    <tr>
         <td><b>RFC</b> </td>
         <td><input id="rfc" name="rfc" type="text" size="35" maxlength="18" value="<?php echo $rfc;?>" required>
    </tr>
    
    <tr>
         <td><b>Regimen</b> </td>
         <td><input id="regimen" name="regimen" type="text" size="35" maxlength="40" value="<?php echo $rgm;?>" required>
    </tr>
     <tr>
         <td><b>D. Comercial</b> </td>
         <td><input id="comercial" name="comercial" type="text" size="35" maxlength="40" value="<?php echo $dcom;?>">
    </tr>
    <tr >
       <td><b>Domicilio</b> </td>
      <td><input name="dom" type="text" size="40" maxlength="200" value="<?php echo $dom;?>" required></td>
       <tr >
       <td><b>Codigo Postal</b></td>
      <td><input name="cp" type="text" size="35" maxlength="5" value="<?php echo $cp;?>" required></td>
       <tr >
       <td><B>Telefono</B></td>
      <td><input name="tel" type="text" size="35" value="<?php echo $tel;?>" maxlength="100"  required></td>
      <tr >
          <tr>
         <td></td>
         <td align="center">
       <p>
       
     <div id="b">
  <input type="submit" name="sub" id="sub" value="Actualizar Cliente" /></p>
  <input type="hidden" name="id" value="<?php echo $_GET['idcliente'];?>"/>
    </div> 
       <!--</form>-->
       </td>
       </tr>
      </td>
    </tr>
   </table>
</div>
</body>
</html>