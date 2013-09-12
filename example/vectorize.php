<?php

echo 'Simple pixel vectorize';
require_once "../svglib/svglib.php";
require 'resource/function.php'; //convert color

$imagePath = 'resource' . DIRECTORY_SEPARATOR . 'axel.png';
$svgPath = 'output' . DIRECTORY_SEPARATOR . 'axel.svg';

$imgContent = file_get_contents( $imagePath );

$img = imagecreatefromstring( $imgContent );
$imageSize = getimagesize( $imagePath );
$imgW = $imageSize[ 0 ];
$imgH = $imageSize[ 1 ];

$svg = SVGDocument::getInstance();
$svg->setWidth( $imgW );
$svg->setHeight( $imgH );

for ( $x = 0; $x < $imgW; $x++ )
{
    for ( $y = 0; $y < $imgH; $y++ )
    {
        $rgb = imagecolorat( $img, $x, $y );
        $color = imagecolorsforindex( $img, $rgb );

        if ( $color[ 'alpha' ] < 126 )
        {
            $hex = RGBToHex( $color[ 'red' ], $color[ 'green' ], $color[ 'blue' ] );
            //$rect = SVGRect::getInstance( $x, $y, null, 1, 1, new SVGStyle( array( 'fill' => $hex ) ) );
            //$d = "m $x,$y 1,0 0,1 -1,0 z";
            $x1 = $x + 1;
            $y1 = $y + 1;
            $d = "M $x,$y $x,$y1 $x1,$y1 $x1,$y ";

            @$paths[ $hex ] .= $d;
            /* @$paths[$hex][$x . ',' . $y] = $x . ',' . $y;
              @$paths[$hex][$x . ',' . $y1] = $x . ',' . $y1;
              @$paths[$hex][$x1 . ',' . $y1] = $x1 . ',' . $y1;
              @$paths[$hex][$x1 . ',' . $y] = $x1 . ',' . $y; */

            //M 25,20 25,21 26,21 26,20 z
            //$path = SVGPath::getInstance( $d, null, new SVGStyle( array( 'fill' => $hex ) ) );
            //$svg->append( $path );
        }
    }
}

echo '<pre>';
foreach ( $paths as $hex => $d )
{
    //$d = implode( ' L ', $res );
    $path = SVGPath::getInstance( $d . ' z', null, new SVGStyle( array( 'fill' => $hex ) ) );
    $svg->append( $path );
}

$svg->asXML( $svgPath, TRUE );

echo "<img src='$imagePath'/>";
echo '<embed style="border:solid 1px gray;" src="' . $svgPath . '" type="image/svg+xml" pluginspage="http://www.adobe.com/svg/viewer/install/" /><br / >';
?>
