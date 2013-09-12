<?php

/**
 * Convert hex color to rgb
 *
 * @param string $hex
 * @return string
 */
function HexToRGB( $hex )
{
    $hex = ereg_replace( "#", "", $hex );
    $color = array( );

    if ( strlen( $hex ) == 3 )
    {
        $color[ 'r' ] = hexdec( substr( $hex, 0, 1 ) . $r );
        $color[ 'g' ] = hexdec( substr( $hex, 1, 1 ) . $g );
        $color[ 'b' ] = hexdec( substr( $hex, 2, 1 ) . $b );
    }
    else if ( strlen( $hex ) == 6 )
    {
        $color[ 'r' ] = hexdec( substr( $hex, 0, 2 ) );
        $color[ 'g' ] = hexdec( substr( $hex, 2, 2 ) );
        $color[ 'b' ] = hexdec( substr( $hex, 4, 2 ) );
    }

    return $color;
}

/**
 * Convert RGB color to ex
 * @param int $r
 * @param int $g
 * @param int $b
 * @return string
 */
function RGBToHex( $r, $g, $b )
{
    //String padding bug found and the solution put forth by Pete Williams (http://snipplr.com/users/PeteW)
    $hex = "#";
    $hex.= str_pad( dechex( $r ), 2, "0", STR_PAD_LEFT );
    $hex.= str_pad( dechex( $g ), 2, "0", STR_PAD_LEFT );
    $hex.= str_pad( dechex( $b ), 2, "0", STR_PAD_LEFT );

    return $hex;
}

?>
