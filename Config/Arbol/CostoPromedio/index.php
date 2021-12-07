<?php
require('../../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	//menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  ul{
    list-style: none;
  }
  </style>
  <script>
  var tCobra = 0; var tGasta = 0;
  $(document).ready(function()
  {
    $(".btn-folder").on("click", function(e)
    {
      e.preventDefault();
      if($(this).attr("data-status") === "1")
      {
        $(this).attr("data-status", "0");
        $(this).find("span").removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign")
      }
      else
      {
        $(this).attr("data-status", "1");
        $(this).find("span").removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign")
      }
      $(this).next("ul").slideToggle();
    });

     $( ".btn" ).click(function() {
      var t=this.name;
      var f1=$(".f1").val();
      var f2=$(".f2").val();
         window.open("detalle.php?tipo="+t+"&&f1="+f1+"&&f2="+f2, '_blank');
    });
  });

  // REALIZAR OPERACION CADA CIERTO TIEMPO
  /*
  setInterval(function(){
     //setTimeout(function (){                   
      $.each( ["numeroEventos","comensales","cobrado","eventosAdicionales"], 
        function( i, l ){      
            buscaDatos(l);            
      });     
      $.each( ["eventosRecaudacion","ventasVinos","ventasT" ,"Cancelaciones","gastoInsumo"], 
        function( i, l ){      
            buscaDatos(l);            
      }); 
        $.each( ["gastoActivo","gastoOperativo","nomina","premioLealtad","vinos"], 
        function( i, l ){      
            buscaDatos(l);            
      });             

      },1000);
  */
    var accion = ["numeroEventos","comensales","cobrado","eventosAdicionales","eventosRecaudacion","ventasVinos","ventasT" ,"Cancelaciones","gastoInsumo","compras","faltantes","gastoOperativo","nomina","premioLealtad","gastoPersonal","gastoInversion","vinos"];
    var dobles  = accion.map(function(num) {
      console.log('XXXXXXDDDDDDD',num)
      buscaDatos(num);  
    });
      // for (var i = 0; i < accion.length; i++) 
      // {
      //   buscaDatos(accion[i]);      
      // }
     function buscaDatos (tipo)
     {


      if(tipo == 'vinos')
       {
          //alert(tipo);      
            var datos = {
                "tipo":tipo,
            }; 
              $.ajax({
                    type: "POST",
                    url: "InventarioVinos.php",
                    data: datos,
                    dataType: "html", 
                    beforeSend: function(){
                          //console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                         // alert("error petición ajax "+tipo+" "+e);     
                          console.log('Error peticion '+tipo+" - "+e);
                    },
                    success: function(data){  
                    //alert(data);    
                //  console.log("tipo: "+tipo+" "+data);
                     var signo = '';
                     if (data < 0) {
                      signo = ' - '
                     }
                        $( "."+tipo ).text(signo + number_format( data,2) );  
                        $( "."+tipo ).val( data );  
                    }
              });                            
       } 
       else
       {
          //alert(tipo);
            var f1='<?php echo $_POST["fecha1"]?>';
            var f2='<?php echo $_POST["fecha2"]?>';            
            var datos = {
                "tipo":tipo,
                "fecha1" : f1,
                "fecha2" : f2
            }; 
              $.ajax({
                    type: "POST",
                    url: "tree.php",
                    data: datos,
                    dataType: "html", 
                    beforeSend: function(){
                          //console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                         // alert("error petición ajax "+tipo+" "+e);     
                          console.log('Error peticion '+tipo+" - "+e);
                    },
                    success: function(data){  
                    //alert(data);    
                //  console.log("tipo: "+tipo+" "+data);
                var signo = ''
                    if(tipo == "gastoOperativo")
                    {
                      console.log("**************** GATO OPERATIVO ************", data);
                      if (data < 0) {
                        signo = ' - '
                      }
                      $( "."+tipo ).text(signo + number_format(data,2) );  
                    }
                    else
                    {

                      if (data < 0) {
                        signo = ' - '
                      }
                      $( "."+tipo ).text( signo + number_format(data,2) );  
                    }
                         $( "."+tipo ).val( data );  

                    }
              });                            
       }
       
     }     
    
var com=parseFloat(comensales());            
var c=0,g=0,i=0,r=0,ven=0,can=0,a=0,n=0,op=0,p=0;
    var tCobrado = setInterval(function(){
           c=parseFloat(Cobrado());
           v=Vinos();
           r=Recaudacion(); 
           ven=Ventas();
           can=Cancelaciones();

           // console.log("C: "+c);
           // console.log("V: "+v);
           // console.log("R: "+r);
           // console.log("Ven: "+ven);
           // console.log("Can: "+can);

          if(c>=0 && v>=0 && r>=0 && ven>=0 && can>=0)
          {
            clearInterval(tCobrado);
           // alert("ya hay algo ");      
          
            c += parseFloat(can);
            c += parseFloat(r);
            c += parseFloat(v);
            c += parseFloat(ven);
            console.log('esto es ventas', ven);
            $(".TotalCobrado").text(number_format(c,2));                         
              //  VAR COMENSALES  
                 var comens=setInterval(function(){
                      com=$(".comensales").val();         
                      if(com>=0)
                      {
                          // c+=parseFloat(r);  
                          // c+=parseFloat(v);  
                          // c+=parseFloat(ven);  
                          // c+=parseFloat(can); 
                          console.log("Recaudacion: "+r);
                          console.log("Vinos: "+v);
                          console.log("Ventas: "+ven);
                          console.log("Cancelaciones: "+can); 

                          console.log("Total Cobrado 44: "+c+ven);    
                          tCobra = c;
                          // tCobra += r
                          // tCobra += v
                          var xxd= parseFloat(c)/parseFloat(com);
                          c += can;
                          console.log("Comensales: "+com);                         
                          console.log("Precio x Comen: "+(c/com));

                          console.log("c: "+c+" com: "+com)
                          
                          console.log("PPPRPRP: "+parseFloat(c)/parseFloat(com));
                          var prxcom =  number_format((xxd),2);
                          console.log("Currency: "+prxcom);
                          $(".precioXComensal").text(prxcom);
                          console.log("Total cobreado 44: "+$(".TotalCobrado").text());                     
                        clearInterval(comens);                        
                         // PRECIO PROMEDIO POR COMENSAL                    
                        var cpxc=(parseFloat(c)) / com;                              
                          $(".costoxcomensal").text(number_format(cpxc,2));
                          $(".TotalCobrado").val(number_format(c,2));

                      }
                 },2000);             
          }
          else
          {
            console.log("Aun no hay nada Cobros");
          }
      },5000);


      var gastado = setInterval(function(){
        var i=0,a=0,n=0,op=0,p=0;
           i=parseFloat(Insumo());
           a=parseFloat(Activo());
           n=parseFloat(Nomina()); 
           op=parseFloat(Operativo());
           p=parseFloat(pLealtad());
           //console.log("Insumo: "+i);
           
          
           //console.log("ins: "+i+" act: "+a+" n:"+n+" op:"+op+" p:"+p);
           console.log("I: "+i);
           console.log("A: "+a);
           console.log("n: "+n);
           console.log("OP: "+op);
           console.log("P: "+p);
           var signo = ''
          if(i>=0 && a>=0 && n>=0 && p>=0)
          {
             i=parseFloat(Insumo());
             console.log('esto es insumo', Insumo());
             a=parseFloat(Activo());
             n=parseFloat(Nomina()); 
             op=parseFloat(Operativo());
             console.log('Gasto Operativo XXD', op)
             p=parseFloat(pLealtad());          
             clearInterval(gastado);           
            
            // GASTO INSUMO + GASTO ACTIVO + GASTO OPERATIVO + NOMINA + PREMIO DE LEALTAD = TOTAL COBRADO       
                var comens=setInterval(function(){
                  i+= parseFloat(a);  // activo
                  i+=parseFloat(p);   // premio de lealtad
                  i+=parseFloat(n);  // Nomina
                  i+=parseFloat(op);  // Gato Operativo
                  tGasta = i;      
                  var signo = "";  
                  if (tGasta < 0) {
                    signo = ' - '
                  }
                  $(".tGastado").text(signo +   number_format(i,2));  
                  console.log("Total Gastado wilson: ",tGasta)

                      com = $(".comensales").val();         
                      if(com>=0)
                      {
                        clearInterval(comens);                        
                        console.log("Total Gastado: "+i);
                  
                          var pxc=parseFloat(i/com);
                          $(".costoxcomensal").text(number_format(pxc,2));                          
                          var cob=$(".TotalCobrado").val();
                          console.log("Total Cobrado wilson: ", tCobra);
                          var uBruta=parseFloat(tCobra) - parseFloat(tGasta);
                          console.log("brutatat: "+uBruta);
                          var signo = "";
                          if(uBruta < 0)
                          {
                            signo = " - ";
                          }
                          $(".utilidad").text(signo +number_format(uBruta,2));                          
                      }
                 },2000);               
          }
          else
          {
            console.log("Aun no hay Gastos");
          }
      },5000);
      function Insumo(){
        var insumo=$(".gastoInsumo").val();
        insumo = insumo.replace(/,/g, "");
        return insumo;
      }
      function Activo(){
         var activo=$(".compras").val();
         activo = activo.replace(/,/g, "");
        return activo;
      }
      function Nomina(){
         var nomina=$(".nomina").val();
         nomina = nomina.replace(/,/g, "");
        return nomina;
      }
      function Operativo(){
         var operativo=$(".gastoOperativo").val();
         operativo = operativo.replace(/,/g, "");
        return operativo;
      }
      function pLealtad(){
         var lealtad=$(".premioLealtad").val();
         lealtad = lealtad.replace(/,/g, "");
        return lealtad;
      }


     function Cancelaciones()
    {
      var cancelacion=$(".Cancelaciones").val();
      return cancelacion;
    }
    function Ventas()
    {
      var ventas=$(".ventasT").val();
      return ventas;
    }
    function Recaudacion()
    {
      var recau=$(".eventosRecaudacion").val();
      return recau;
    }
    function Vinos()
    {
      var vinos=$(".ventasVinos").val();
      return vinos;
    }
    function Cobrado()
    {
      var cobrado=$(".cobrado").val();
      return cobrado;
    }
    function currency(value, decimals, separators) {
    decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
    separators = separators || [',', "'", '.'];
    var number = (parseFloat(value) || 0).toFixed(decimals);
    if (number.length <= (4 + decimals))
        return number.replace('.', separators[separators.length - 1]);
    var parts = number.split(/[-.]/);
    value = parts[parts.length > 1 ? parts.length - 2 : 0];
    var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
        separators[separators.length - 1] + parts[parts.length - 1] : '');
    var start = value.length - 6;
    var idx = 0;
    while (start > -3) {
        result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
            + separators[idx] + result;
        idx = (++idx) % 2;
        start -= 3;
    }
    return (parts.length == 3 ? '-' : '') + result;
  }
    var  comm=0;
  function comensales()
  {
     var f1='<?php echo $_POST["fecha1"]?>';
     var f2='<?php echo $_POST["fecha2"]?>';            
            var datos = {
                "tipo":"comensalesGlobales",
                "fecha1" : f1,
                "fecha2" : f2
            }; 
              $.ajax({
                    type: "POST",
                    url: "tree.php",
                    data: datos,
                    dataType: "html", 
                    beforeSend: function(){
                         // console.log('Conexion correcta ajax '+comensalesGlobales);
                    },
                    error: function(e){
                         // alert("error petición ajax "+comensalesGlobales+" "+e);     
                          //console.log('Error peticion '+comensalesGlobales+" - "+e);
                    },
                    success: function(data){                    
                     //console.log("comensalesGlobales: "+comensalesGlobales+" "+data);                       
                     $(".comensalesGlobales").val(data);                     

                    }
              });                                                                      
  }
  function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
  }
  </script>
</head>
<body>
  <div class="container">
    <div class='col-md-12' align="center">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
          De: <input type="date" name="fecha1" value="<?php echo $_POST['fecha1']?>" placeholder="">    Hasta: <input type="date" max="<?php echo date('Y-m-d');?>" name="fecha2" value="<?php echo $_POST['fecha2']?>" placeholder="">       
          <input type="submit" name="submit" value="Buscar">
      </form>
    </div>

    <?php
     if ($_POST['submit']):
    echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";    
    ?>
    <input type="hidden" class='f1' value="<?php echo $_POST['fecha1'];?>">
    <input type="hidden" class='f2' value="<?php echo $_POST['fecha2'];?>">
    <div class="row col-lg-6" style='display: inline-block;  vertical-align:top;  '>
      <div class="col-md-10" id="nested" style="background: #222; color: #ddd">
        <h3 class="heading text-center">COSTO PROMEDIO</h3><hr>
        
        <ul>
        
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
               <a href="#" data-status="hijos" name='eventos' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
                Catidad de Eventos: <font color="red"><b class='numeroEventos'></b></font>
               </a>          
          </li>    
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='comensales' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Comensales: <font color="red"><b class='comensales'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='cobrado' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Cobrado: <font color="red">$ <b class='cobrado'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='eAdicional' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Eventos Adicionales: <font color="red"><b class='eventosAdicionales'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='eRecaudacion' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Eventos de Recaudación: <font color="red">$ <b class='eventosRecaudacion'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='ventasVinos' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Venta de Vinos: <font color="red">$ <b class='ventasVinos'></b></font>
              </a>           
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='ventasT' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Ventas: <font color="red">$ <b class='ventasT'></b></font>
              </a>           
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='Cancelaciones' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Cancelaciones: <font color="red">$ <b class='Cancelaciones'></b></font>
              </a>           
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos"  name='TotalCobrado' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Total Cobrado: <font color="red">$ <b class='TotalCobrado'>???????????????????????????</b></font>
              </a>           
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='gastoInsumo' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Gasto Insumo: <font color="red">$ <b class='gastoInsumo'></b></font>
              </a>           
          </li>    
           <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='compras' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Gasto Activo: <font color="red">$ <b class='compras'></b></font>
              </a>           
              
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='gastoOperativo' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Gasto Operativo: <font color="red">$ <b class='gastoOperativo'></b></font>
              </a>           
              
          </li> 
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='nomina' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Nomina: <font color="red">$ <b class='nomina'></b></font>
              </a>           
              
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='premioLealtad' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Premio de Lealtad: <font color="red">$ <b class='premioLealtad'></b></font>
              </a>           
              
          </li>      
        </ul>
      </div>
    </div>

    <!--  SEGUNDO PANEL DE EVENTOS -->
      <div class="row col-lg-6" style='display: inline-block; vertical-align:top;'>
      <div class="col-md-10" id="nested" style="background: #222; color: #ddd">
        <h3 class="heading text-center">COSTO PROMEDIO</h3><hr>
        
        <ul>
        
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
               <a href="#" data-status="hijos" style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
                Total Gastado: <font color="red"><b class='tGastado' ></b></font>
               </a>          
          </li>    
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Costo Promedio por Comensol: <font color="red"><b class='costoxcomensal'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Precio Promedio por Comensal: <font color="red">$ <b class='precioXComensal'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Utilidad Bruta: <font color="red"><b class='utilidad'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="padres" name ='gastoPersonal' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Gastos Personales: <font color="red">$ <b class='gastoPersonal'></b></font>
              </a>           
          </li>       
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" name='gastoInversion' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Inversion: <font color="red">$ <b class='gastoInversion'></b></font>
              </a>           
          </li>      
          <li style="margin: 5px 0px">
            <span><i class='glyphicon glyphicon-folder-open'></i></span>
              <a href="#" data-status="hijos" NAME ='vinos' style="margin: 5px 6px" class="btn btn-warning btn-xs btn-folder">
                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
               Inversion Vinos: <font color="red">$ <b class='vinos'></b></font>
              </a>           
          </li>      
         
        </ul>
      </div>
    </div>
    <?php endif?>
        <input type="hidden" class='comensalesGlobales' value="">
        <input type="hidden" class='vinos' value="">
        <input type="hidden" class='gastoInversion' value="">
        <input type="hidden" class='gastoPersonal' value="">
        <input type="hidden" class='premioLealtad' value="">
        <input type="hidden" class='nomina' value="">
        <input type="hidden" class='gastoOperativo' value="">
        <input type="hidden" class='gastoInsumo' value="">
        <input type="hidden" class='TotalCobrado' value="">
        <input type="hidden" class='numeroEventos' value="">
        <input type="hidden" class='comensales' value="">
        <input type="hidden" class='cobrado' value="">
        <input type="hidden" class='eventosAdicionales' value="">
        <input type="hidden" class='eventosRecaudacion' value="">
        <input type="hidden" class='ventasVinos' value="">
        <input type="hidden" class='ventasT' value="">
        <input type="hidden" class='Cancelaciones' value="">
        <input type="hidden" class='compras' value="">
        <input type="hidden" class='TotalCobrado' value="">
        <input type="hidden" class='TotalGastado' value="">
        
  </div>


</body>
</html>