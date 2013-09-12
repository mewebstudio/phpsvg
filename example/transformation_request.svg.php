<?php

/**
 *
 * Description: Show how to translations and dinamic SVG generation using request
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2011
 *
 * @author Eduardo Bonfandini
 * @example transformation_request.svg.php?fill=green&stroke=blue&rotate=45&translate=10,5
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

$rotate = @$_REQUEST[ 'rotate' ]; //rotate the square using passed angle
$translate = @$_REQUEST[ 'translate' ]; //rotate the square using passed angle
$file = @$_REQUEST[ 'file' ]; //load the file passed
$fill = @$_REQUEST[ 'fill' ] ? @$_REQUEST[ 'fill' ] : 'red';
$stroke = @$_REQUEST[ 'stroke' ] ? @$_REQUEST[ 'stroke' ] : 'black';

$svg = SVGDocument::getInstance( $file );

$style = new SVGStyle();
$style->setFill( $fill );
$style->setStroke( $stroke );

$rect = SVGRect::getInstance( 50, 50, 'myRect', 100, 100, $style );

if ( $rotate )
{
    //uses the x and y properties to align the rect
    $rect->rotate( $rotate, $rect->getX() * 2, $rect->getY() * 2 );
}

if ( $translate )
{
    $translate = explode( ',', $translate );
    $rect->translate( $translate[ 0 ], $translate[ 1 ] );
}

$svg->addShape( $rect );
$svg->output();
?>