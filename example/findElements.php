<?php
require_once "../svglib/svglib.php";
$svg = SVGDocument::getInstance( 'resource/image.svg' );

echo "Element with id=layer1\n";

$result = $svg->getElementById( 'layer1' );
var_dump($result);

echo "Elements with width > 100\n";

$result = $svg->getElementsByAttribute( 'width', '100' ,'>');

var_dump($result);


echo "Elements with id\n";

$result = $svg->getElementsByAttribute( 'id', '' ,'!=');

var_dump($result);
?>