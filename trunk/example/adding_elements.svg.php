<?php

/**
 *
 * Description: Default example, show some usefull functions / adding elements
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2011
 *
 * @author Eduardo Bonfandini
 *
 * -----------------------------------------------------------------------
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU Library General Public License as published
 *   by the Free Software Foundation; either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU Library General Public License for more details.
 *
 *   You should have received a copy of the GNU Library General Public
 *   License along with this program; if not, access
 *   http://www.fsf.org/licensing/licenses/lgpl.html or write to the
 *   Free Software Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 * ----------------------------------------------------------------------
 */
require_once "../svglib/svglib.php";

#start a svgDocument using apple.svg as base document
$svg = SVGDocument::getInstance( 'resource/apple.svg' );
#start a svgDocument using default (minimal) svg document
#$svg = SVGDocument::getInstance( ); //default
#define the title
$svg->setTitle( "Adding elements" );

#some possible svg functions
#$svg->getWidth();
#$svg->getHeight();
#$svg->getVersion();
#example of criation of an svg style
#$style = 'fill:#f2f2f2;stroke:#e1a100;';
#create a new rect with, x and y position, id, width and heigth, and the style
$rect = SVGRect::getInstance( 0, 5, 'myRect', 228, 185, new SVGStyle( array( 'fill'   => 'red', 'stroke' => 'blue' ) ) );
#$rect->style->setFill('#f2f2f2'); //still not work
#$rect->style->setStroke('#e1a100'); //still not work

$rect->setWidth( $svg->getWidth() ); #make the rect of the size of pages
$rect->skewX( 5 ); #make a skew x transformation
$rect->rotate( 1 ); #make a rotation
$rect->setRound( 30 );
$svg->addShape( $rect ); #add the rect to svg

$style = new SVGStyle();
$style->setFill( 'green' );
$style->setStroke( 'black', 5 );

$circle = SVGCircle::getInstance( 200, 100, 20, null, $style );
$svg->addShape( $circle );

$ellipse = SVGEllipse::getInstance( 200, 200, 100, 40 );
$ellipse->rotate( -30, 200, 200 );
$style2 = new SVGStyle();
$style2->setFill( 'none' );
$style2->setStroke( 'blue', 3 );
$ellipse->setStyle( $style2 );
$svg->addShape( $ellipse );

$style = new SVGStyle(); #create a style object
#set fill and stroke
$style->setFill( '#f2f2f2' );
$style->setStroke( '#e1a100' );
$style->setStrokeWidth( 2 );

#create a text
$text = SVGText::getInstance( 22, 50, 'myText', 'This is a text', $style );

$svg->addShape( $text );
#$svg->addShape( SVGPath::getInstance( array('m 58,480','639,1'), 'myPath', 'fill:none;stroke:#000000;stroke-width:1px;') );#create a path

$svg->addShape( SVGLine::getInstance( 50, 50, 500, 500, null, $style ) );

#many types of output
try
{
    $svg->asXML( getcwd() . '/output/output.svg' ); #svg
    #example how to using SVG Inkscape
    #define('INKSCAPE_PATH', 'H:\ferramentas\Inkscape\inkscape' );
    #$svg->export( getcwd() . '/output/inkscape.png', null, null, true, SVGDocument::EXPORT_TYPE_INKSCAPE );
    #$svg->export( getcwd() . '/output/output.png' ); #png
    $svg->export( getcwd() . '/output/output.jpg' ); #jpg
    $svg->export( getcwd() . '/output/output.gif' ); #gif
    $svg->export( getcwd() . '/output/thumb16x16.png', 16, 16, true ); #png resized using imagemagick
    $svg->export( getcwd() . '/output/thumb32x32.png', 32, 32, true );
    $svg->export( getcwd() . '/output/thumb64x64.png', 64, 64, true );
    #output to browser, with header
    $svg->output();
}
catch ( Exception $e )
{
    echo $e->getMessage() . ' on ' . $e->getFile() . ' line ' . $e->getLine();
}
?>