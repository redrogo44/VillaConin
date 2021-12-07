<html>
<head>
</head>
<body>
<?php
echo '
<div style="position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:17;font-family:Arial, Helvetica, sans-serif;" align="center">
<MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 2.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones 
<div id="reloj" style="color: #FFF;
background: #900;
position:absolute;
 bottom:0;
 right:0;
height:39px; /*alto del div*/
Width:150px;
z-index:99999;
" >
<a style=" color: #fff;	text-decoration:none;" href="calendario.php" target="_blank">
<span id="liveclock" style="position:relative;left:0;top:0;"></span></a><script language="JavaScript" type="text/javascript">

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
	
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
//change font size here to your desire
myclock="<font size=5 ><b><font size=2>'.date("d-m-Y").'</font></br>"+hours+":"+minutes+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }
window.onload=show5
 
 </script>   
</div>
</div>';
?>
<body>
<html>