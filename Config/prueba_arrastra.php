<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require "configuraciones.php";
    conectar();
    validarsesion();
    $nivel=$_SESSION['niv'];
    menuconfiguracion();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
                .BOTON 
            {
                border: 3px solid #333333;
  border-radius: 3px;
  color: #FFFC00;
  background-color:#0441DD;
  display: inline-block;
  font: oblique bold 160% cursive; 
  padding: 18px 19px;
  text-decoration: none;
            }
                
                .pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
        .BOTON 
            {
                border: 3px solid #333333;
  border-radius: 3px;
  color: #D1FF00;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;
  padding: 8px 11px;
  text-decoration: none;
            }
            .SelectStyle
            {
                width: 200px;
    height: 200px;
    position: relative;
    top: 0;right: 0;
    border: 1px solid #C1C1C1;
    background:#ebebeb;
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif');
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), -moz-linear-gradient(top,#dfdfdf 0%,#f6f6f6 100%);
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), -webkit-gradient(linear,left top,left bottom,color-stop(0%,#dfdfdf),color-stop(100%,#f6f6f6));
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), -webkit-linear-gradient(top,#dfdfdf 0%,#f6f6f6 100%);
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), -o-linear-gradient(top,#dfdfdf 0%,#f6f6f6 100%);
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), -ms-linear-gradient(top,#dfdfdf 0%,#f6f6f6 100%);
    background-image: url('http://www.ideup.com/sites/all/themes/ideup/img/bullet--arrow--down.gif'), linear-gradient(top,#dfdfdf 0%,#f6f6f6 100%);
    background-repeat: no-repeat;
    background-position: center center;
    -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
    -moz-box-sizing: border-box;    /* Firefox, other Gecko */
    box-sizing: border-box;         /* Opera/IE 8+ */
            }
    </style>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Permutar elementos de una lista</title>
<script type="text/javascript">
<!--
function arriba() {
    obj=document.getElementById('select2');
    indice=obj.selectedIndex;
    if (indice>0) cambiar(obj,indice,indice-1);
}
function abajo() {
    obj=document.getElementById('select2');
    indice=obj.selectedIndex;
    if (indice!=-1 && indice<obj.length-1)
        cambiar(obj,indice,indice+1);
}
function cambiar(obj,num1,num2) {
    proVal=obj.options[num1].value;
    proTex=obj.options[num1].text;
    obj.options[num1].value=obj.options[num2].value;    
    obj.options[num1].text=obj.options[num2].text;  
    obj.options[num2].value=proVal;
    obj.options[num2].text=proTex;
  obj.selectedIndex=num2;
}
function seleccionar()
    {
        select = document.getElementById("select2");
        for (var i = 0; i < select.options.length; i++) 
        {
         select.options[i].selected = true;
        }
    }
-->
</script>
</head>
 <br></br>
 <br></br>
 <br></br>
<body>
<p>
<div align="center">
<label for="sel"><h2><b><font color="#BC0000">ORDENE LOS MESEROS CON LOS BOTONES DE ARRIBA Y ABAJO..</FONT></b></h2></label>
<br>
<form method="post" action="cambiar_orden_meseros.php">

<select MULTIPLE  size='15' id='select2' name='select2[]'>
<?php
 $q="SELECT * FROM `Meseros` group by tipo";
            $consulta=mysql_query($q);
            $c=0;
            while($con=mysql_fetch_array($consulta))
            {

                echo "<option value=".$con['tipo'].">".$con['tipo']."</option>";
          

            }

?>
</select>
<br><br>
<input type="button" value="Arriba" onclick="arriba()"  class="BOTON" />
<input type="button" value="Abajo" onclick="abajo()" class="BOTON"/></p>

<br><br>

     <input type='submit' onClick='seleccionar()' value='Enviar'>

</form>

</div>
</body>


</html>