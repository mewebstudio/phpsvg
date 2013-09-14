<?php

/**
 *
 * Description: Default example, show how to deal with javascripts
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
$svg = SVGDocument::getInstance();
$svg->setTitle( "Javascript example" );

#add some javascript functions
$svg->addScript( "
    function changeColor(evt, element)
    {
        destination = document.getElementById('destination');

        if ( evt.ctrlKey )
        {
            destination.style.stroke = element.style.fill;
        }
        else
        {
            destination.style.fill = element.style.fill;
        }

        evt.preventDefault();
        return false;
    }
" );

#mount a simple color array
$colors[ ] = 'red';
$colors[ ] = 'green';
$colors[ ] = 'blue';
$colors[ ] = 'yellow';
$colors[ ] = 'orange';
$colors[ ] = 'gray';
$colors[ ] = 'black';
$colors[ ] = 'white';

$text = SVGText::getInstance( 10, 25, null, 'Left click for fill - control click for stroke' );

$svg->addShape( $text );

foreach ( $colors as $line => $color )
{
    $rect = SVGRect::getInstance( ( $line * 60 ) + 10, 40, null, 50, 50 );
    $style = new SVGStyle();
    $style->setFill( $color );
    $style->setStroke( "darkGray", 1 );
    $rect->setStyle( $style );

    $rect->addOnclick( "return changeColor(evt,this);" );
    $rect->addAttribute( "onmouseover", "this.style.stroke = 'lightGray';" );
    $rect->addAttribute( "onmouseout", "this.style.stroke = 'gray';" );

    $svg->addShape( $rect );
}

$rect = SVGRect::getInstance( 140, 100, 'destination', 200, 200 );
$style = new SVGStyle();
$style->setFill( 'none' );
$style->setStroke( "darkGray", 5 );
$rect->setStyle( $style );

$svg->addShape( $rect );

$svg->output();
?>
