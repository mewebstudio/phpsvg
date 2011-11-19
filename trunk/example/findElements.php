<?php
/**
 *
 * Description: Show how to locate elements in SVG object
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
echo '<pre>';
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
echo '</pre>';
?>