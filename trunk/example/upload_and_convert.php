<html>
    <head>
        <title>SVG - Upload and convert</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="upload_and_convert.php" method="POST">
        Choose SVG to upload: <input name="uploadedfile" type="file" /><br />
        <input type="submit" value="Upload File" />
        </form>
    </body>
</html>

<?php
/**
 *
 * Description: upload and convertion examples
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2011
 *
 * @author Eduardo Bonfandini
 * @example transformation_request.svg.php?fill=green&stroke=blue&rotate=45&translate=10,5
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
//to SVG convert
ini_set('max_execution_time','0');

require_once "../svglib/svglib.php";

if ( $_FILES )
{
    $target_path = 'output/'. basename( $_FILES['uploadedfile']['name']);
    $mime = $_FILES['uploadedfile']['type'];

    if ( $_FILES['uploadedfile']['error'] )
    {
        die( 'Error on upload.');
    }

    if ( $mime != SVGDocument::HEADER )
    {
        die('Only SVG files can be converted.');
    }

    if ( move_uploaded_file( $_FILES['uploadedfile']['tmp_name'], $target_path ) )
    {
        $svg = SVGDocument::getInstance( $target_path );
        echo '<embed style="border:solid 1px gray;" src="'.$target_path.'" type="image/svg+xml" pluginspage="http://www.adobe.com/svg/viewer/install/" /><br / >';
        $svg->asXML('output/test.svgz'); //compacted svg
        $ok = $svg->export('output/upload.png');
        $svg->export('output/upload16x16.png',16,16,true);
        $svg->export('output/upload32x32.png',32,32,true);
        $svg->export('output/upload64x64.png',64,64,true);
        $svg->export('output/upload128x128.png',128,128,true);
        $svg->export('output/upload256x256.png',256,256,true);
        echo '<img src="output/upload.png"/><br/>';
        echo '<img src="output/upload16x16.png"/><br/>';
        echo '<img src="output/upload32x32.png"/><br/>';
        echo '<img src="output/upload64x64.png"/><br/>';
        echo '<img src="output/upload128x128.png"/><br/>';
        echo '<img src="output/upload256x256.png"/><br/>';
    }
    else
    {
        echo "There was an error uploading the file, verify permission and try again!";
    }
}
?>