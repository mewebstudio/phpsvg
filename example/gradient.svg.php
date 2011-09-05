<?php
/**
 *
 * Description: Drawing example
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

$svg = SVGDocument::getInstance();

$stop = SVGStop::getInstance();
$stop->setColor('red');
$stop->setOpacity(1);
$stops[] = $stop;

$stops[] = SVGStop::getInstance( null , "stop-color:blue;stop-opacity:1");
$stops[] = SVGStop::getInstance( null , "stop-color:black;stop-opacity:1");
$gradient = SVGLinearGradient::getInstance( null, $stops);
$svg->addDefs( $gradient );

//$style = new SVGStyle( array( 'fill' => $gradient ));//TODO make it work
$style = new SVGStyle( );
$style->setFill( $gradient );

$rect = SVGRect::getInstance( 10, 20, null , '100', '200', $style );

$svg->append( $rect );
$svg->output();
?>