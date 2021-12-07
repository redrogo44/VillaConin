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
 <title>Villa Conin</title>
<head>
<script type="text/javascript">
<?php 
conectar();
$qy="select count(*) as 'c' from TManteleria";
$ro=mysql_query($qy);
$ma=mysql_fetch_array($ro);

?>
	function vender(){
	var todo="";
		for (var i=1;i<=<?php echo $ma['c'];?>;i++)
		{  
			if(document.getElementById(i).checked){
				todo=todo+i+",";
			}
		}
		window.location="vender_vinos.php?vinos="+todo; 	
	}
</script>
</head>
 <style type="text/css">
             *{
				 padding:0px;
				 margin:0px;
			  }
			  #header{
				  margin:auto;
				  width:700px;
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
	<style>
	.button {
   border-top: 1px solid #8f0d0d;
   background: #9c132a;
   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
   background: -webkit-linear-gradient(top, #a12a2e, #9c132a);
   background: -moz-linear-gradient(top, #a12a2e, #9c132a);
   background: -ms-linear-gradient(top, #a12a2e, #9c132a);
   background: -o-linear-gradient(top, #a12a2e, #9c132a);
   padding: 8px 16px;
   -webkit-border-radius: 10px;
   -moz-border-radius: 10px;
   border-radius: 10px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: #ffffff;
   font-size: 14px;
   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button:hover {
   border-top-color: #b02128;
   background: #b02128;
   color: #ffffff;
   }
.button:active {
   border-top-color: #0f2d40;
   background: #0f2d40;
   }
	</style>
</body>
<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<!--ESTILO CUERPO-->
<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">CRITERIOS DE BUSQUEDA</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="categoria" size="1" id="categoria">
                <option value="MANTELERIA">MANTELERIA</option>
                <option value="SERVILLETAS">SERVILLETAS</option>
                <option value="CAMINOS">CAMINOS</option>
                <option value="MANTELES">MANTELES</option>
                <option value="MOÑOS">MOÑOS</option>
                <option value="CASCADAS">CASCADAS</option>
                <option value="GENERAL">GENERAL</option>
                <option value="COJINES">COJINES</option>
                <option value="BAMBALINA">BAMBALINA</option>
                <option value="MANTELES PARA TABLON">MANTELES PARA TABLON</option>
			</select>
		<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					busca_manteleria();	
				}
			?>
</body>
</html>
