<?php
/**
 *
 * Description: Very simple example
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Dez 15, 2012
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
$svg = SVGDocument::getInstance( ); #start a svgDocument using default (minimal) svg document
$svg->setTitle("Simple example"); #define the title
$rect = SVGRect::getInstance( 0, 5, 'myRect', 228, 185, new SVGStyle( array('fill'=>'blue', 'stroke' =>'gray' ) ) ); #create a new rect with, x and y position, id, width and heigth, and the style
$svg->addShape( $rect ); #add the rect to svg
$svg->output(); #output to browser, with header
?>