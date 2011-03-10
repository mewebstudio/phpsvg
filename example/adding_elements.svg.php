<?php
require_once "../svglib/svglib.php";

$svg = SVGDocument::getInstance( 'resource/apple.svg' );
#$svg = SVGDocument::getInstance( ); //default

#$svg->getWidth();
#$svg->getHeight();
#$svg->getVersion();

$style = 'fill:#f2f2f2;stroke:#e1a100;';

$rect = SVGRect::getInstance( 0, 5, 'myRect', $style, 228, 185 );
$rect->setWidth( $svg->getWidth() );
$svg->addShape( $rect );

$style = "font-size:56px;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;text-align:start;line-height:125%;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none;font-family:DejaVu Sans;";

$svg->addShape( SVGText::getInstance( 22, 50, 'myText', $style, 'This is a text') );

$svg->asXML('output/output.svg');
$svg->export('output/output.png');
$svg->export('output/thumb16x16.png',16,16);
$svg->export('output/thumb32x32.png',32,32);
$svg->export('output/thumb64x64.png',64,64);

$svg->output();
?>