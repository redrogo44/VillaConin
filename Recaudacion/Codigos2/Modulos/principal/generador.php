<?php
  include('Barcode.php');
  
  $fontSize = 10;   // GD1 in px ; GD2 in point
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 150;  // barcode center
  $y        = 50;  // barcode center
  $height   = 100;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    =0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
        
  $code     = $_GET['codigo']; // barcode, of course ;)
  $type     = code128;
  
  function drawCross($im, $color, $x, $y){
    imageline($im, $x - 10, $y, $x + 10, $y, $color);
    imageline($im, $x, $y- 10, $x, $y + 10, $color);
  }
  
  ########## ancho largo ##################33
  $im     = imagecreatetruecolor(350, 100);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0, 350, 100, $white);
  
  $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  if ( isset($font) ){
    $box = imagettfbbox($fontSize, 0, $font, $data['hri']);
    $len = $box[2] - $box[0];
    Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
    imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
  }
  //if($_POST['generar']=='i'){
    imagegif($im,$code.'.gif');
    imagedestroy($im);  
//print_r($_POST);
  #  header('Location: index.php');
  /*}else{
    header('Content-type: image/gif');
    imagegif($im);
    imagedestroy($im);  
  }
*/
  echo "<script>
  window.close();
  </script>";
?>