<?php
/**
 *
 * Description: Show how to use image in svg, extract image from SVG and add image to SVG
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2011
 *
 * @author Eduardo Bonfandini
 *
 *-----------------------------------------------------------------------
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
 *----------------------------------------------------------------------
 */
require_once "../svglib/svglib.php";
//get one SVG with one image
$svg = SVGDocument::getInstance( 'resource/image.svg' );
//convert the image to SVGImage object
$embed= $svg->getElementById('stickEmbed');
//convert the element to an image
$image = @new SVGImage( $embed->asXML() ) ;
//export the image to a file, if is png
if ( $image->getImageData()->mime == 'image/png' )
{
    file_put_contents( 'output/test.png' , $image->getImage() );
    //chmod( 'output/test.png' , '0777');
}
//add a new image to SVG (embed)
$svg->addShape( SVGImage::getInstance(50, 50, 'myImage', 'resource/stick.png') );
//make the output to browser
$svg->output();
?>