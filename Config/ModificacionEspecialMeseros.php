<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'configuraciones.php';
conectar();
validarsesion();
menuconfiguracion();
?>
 
 <title>Villa Conin</title>
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
				.button 
						{
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
    <script type="text/javascript" src="jquery/jquery-latest.js"></script> 
<script type="text/javascript" src="jquery/jquery.tablesorter.js"></script> 
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">

<?php
conectar();
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

	$numero=$_GET['numero'];	

 $q="Select * from Meseros ";
$co=mysql_query($q);

		if(isset($_POST))
		{
//			explode("-",$_POST[''])
				
				////unset($_SESSION["idd"] 
		for($i=1;$i<=$_POST['N'];$i++)
		{
			if(!empty($_POST['neventos'.$i])||!empty($_POST['comentarios'.$i]))
			{
				echo $Modi="UPDATE `Meseros` SET `neventos`=".$_POST['neventos'.$i].",`comentarios2`='".$_POST['comentarios'.$i]."' WHERE id=".$_POST['id'.$i];			
				mysql_query($Modi);
				unset($_POST["id"] );
			}
		}
	$N=0;
			
		}
	
?>


<!--ESTILO CUERPO-->
<div align="center">		

	<br /><br /><br  style="background-position:center"/>
	<div class="wrapper wrapper-style4">		

    <form method="post"  name="ModificaMe" action="ModificacionEspecialMeseros.php">

        <input type="submit" value="Guadar Cambios"   class="button"/>
            <br /><br />
    	<table id="myTable" class="tablesorter" border="6" bordercolor="#990000"> 
        <thead> 
        	<tr>
            	<th align="center"><b>Nombre</b></th>
                <td align="center"><b># de Eventos</b></td>
                <td align="center"><b>Historial de Comentarios</b></td>
                
            </tr>
            </thead> 
            <?php
			//print_r($_POST);
			//print_r($_SESSION);$N=0;$NN=1;
			$N=0;
			while($me=mysql_fetch_array($co))
			{$N=$N+1;
				if(empty($me['neventos'])||empty($me['comentarios2']))
				{
				echo
					"	
						<tr>
							<td align='center'><b>".$me['nombre']." ".$me['ap']." ".$me['am']."</b></td>
							<td align='center'><input type='number' name='neventos".$N."' /></td>
							<td align='center'><textarea name='comentarios".$N."'></textarea></td>
							<input type='hidden' value=".$me['id']." name='id".$N."'/>
						</tr> 
						
					";
				}
				else{
					
					}
				
			}
			echo "<input type='hidden' value=".$N." name='N'/>";
            ?>
        </table>
  
   </form>
</div>
</div>
<script language="javascript"type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    
	$(document).ready(function() 
    { 
        $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
    } 
); 
 
</script>
</body>


</body>
</html>



	