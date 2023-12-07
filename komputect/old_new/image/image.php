
<?php
// create new imagick object from image.jpg
$im = new Imagick( "drogba.jpg" );

// change format to png
$im->setImageFormat( "png" );

// output the image to the browser as a png
header( "Content-Type: image/png" );
echo $im;

// or you could output the image to a file:
//$im->writeImage( "image.png" );
?>