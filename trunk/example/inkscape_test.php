<?php

/**
 *
 * Description: Inkscape exportation example
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Dez 15, 2012
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
#if inkscape is not in default system path you must define it's path
define( 'INKSCAPE_PATH', '"C:\Program Files (x86)"\inkscape\\inkscape.exe' );
require_once '../svglib/inkscape.php';
$inkscape = new Inkscape( getcwd() . '/resource/apple.svg' );
echo '<pre>';
echo "Testing inkscape..." . PHP_EOL;
echo 'Version:' . PHP_EOL . $inkscape->getVersion() . PHP_EOL;
echo 'Help:' . PHP_EOL . $inkscape->getHelp() . PHP_EOL;
echo 'Usage:' . PHP_EOL . $inkscape->getUsage() . PHP_EOL;

$inkscape->exportAreaSnap(); //better pixel art
$inkscape->exportTextToPath();

try
{
    $ok = $inkscape->export( 'png', getcwd() . '/output/apple.png' );
    if ( $ok )
    {
        echo 'Export sucess to output/apple.png!';
    }
}
catch ( Exception $exc )
{
    echo $exc->getMessage();
    echo $exc->getTraceAsString();
}

echo '</pre>';
?>
