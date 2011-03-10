<?php
require_once "../svglib/svglib.php";
//get one SVG with one image
$svg = SVGDocument::getInstance( 'resource/image.svg' );
//convert the image to SVGImage object
$embed= $svg->getElementById('stickEmbed');

$image = new SVGImage( $embed->asXML() ) ;
//export the image to a file, if is png
if ( $image->getImageData()->mime == 'image/png' )
{
    file_put_contents( 'output/test.png' , $image->getImage() );
    //chmod( 'output/test.png' , '777');
}
//add a new image to SVG (embed)
$svg->addShape( SVGImage::getInstance(50, 50, 'myImage', 'resource/stick.png') );
//make the output to browser
$svg->output();
?>