<?php

/**
 *
 * Description: Default example, show some usefull functions / adding elements
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

class SVGLineGraph extends SVGDocument
{

    public $startX = 0;
    public $startY = 0;
    public $height = 0;
    public $width = 0;

    public static function getInstance( $startX = 30, $startY = 50, $height = 300, $width = 600 )
    {
        $svg = parent::getInstance( null, 'SVGLineGraph' );
        $svg->startX = $startX;
        $svg->startY = $startY;
        $svg->height = $height;
        $svg->width = $width;
        $svg->generate();
        $svg->setTitle( "Line Graph" );

        return $svg;
    }

    protected function generate()
    {
        $line1 = SVGLine::getInstance( $this->startX, $this->startY, $this->startX, $this->height + $this->startY, null, new SVGStyle( array( 'stroke'       => 'black', 'stroke-width' => 1 ) ) );
        $line2 = SVGLine::getInstance( $this->startX, $this->height + $this->startY, $this->width + $this->startX, $this->height + $this->startY, null, new SVGStyle( array( 'stroke'       => 'black', 'stroke-width' => 1 ) ) );

        $this->addShape( $line1 );
        $this->addShape( $line2 );

        #vertical counter
        for ( $i = 0; $i <= $this->height; $i += 25 )
        {
            $this->addShape( SVGText::getInstance( $this->startX - 30, $this->startY + $i, null, $this->height - $i ) );
        }

        #horizontal counter
        for ( $i = 0; $i <= $this->width; $i += 50 )
        {
            $this->addShape( SVGText::getInstance( $this->startX + $i, $this->startY + $this->height + 20, null, $i ) );
        }
    }

    public function addData( $data, $style = null )
    {
        if ( !$style )
        {
            $style = new SVGStyle( array( 'stroke'       => 'blue', 'fill'         => 'blue', 'stroke-width' => 1 ) );
        }

        if ( is_array( $data ) )
        {
            foreach ( $data as $line => $info )
            {
                $previous = $this->normalizeLineData( @$data[ $line - 1 ] );
                $info = $this->normalizeLineData( $info );

                $line = SVGLine::getInstance( $previous[ 0 ], $previous[ 1 ], $info[ 0 ], $info[ 1 ], null, $style );
                $this->addShape( $line );

                $circle = SVGCircle::getInstance( $info[ 0 ], $info[ 1 ], 3, null, $style );
                $circle->setTitle( $info[ 0 ] . ',' . $info[ 1 ] );

                $this->addShape( $circle );
            }
        }
    }

    /**
     * Normalize a line of data
     *
     * @param arrray $line the original line
     * @return type normalized line
     */
    protected function normalizeLineData( $line )
    {
        if ( !is_array( $line ) )
        {
            $line = array( 0, 0 );
        }

        $line[ 0 ] = $line[ 0 ] + $this->startX;
        $line[ 1 ] = $this->height - $line[ 1 ] + $this->startY;

        return $line;
    }

    public function asXML( $filename = NULL, $human = TRUE )
    {
        #clean fields that not has to be in svg
        unset( $this->height );
        unset( $this->width );
        unset( $this->startX );
        unset( $this->startY );
        return parent::asXML( $filename, $human );
    }

}

$svg = SVGLineGraph::getInstance( 50, 30, 300, 600 );

$data[ ] = array( 10, 20 );
$data[ ] = array( 30, 120 );
$data[ ] = array( 60, 40 );
$data[ ] = array( 153, 224 );
$data[ ] = array( 200, 100 );
$data[ ] = array( 254, 142 );
$data[ ] = array( 367, 45 );
$data[ ] = array( 382, 87 );
$data[ ] = array( 422, 207 );
$data[ ] = array( 484, 67 );
$data[ ] = array( 600, 300 );

$svg->addData( $data );

unset( $data );

#create random data
for ( $i = 0; $i <= 10; $i++ )
{
    $data[ ] = array( rand( $i * ( 540 / 10 ), $i * ( 600 / 10 ) ), rand( 0, 300 ) );
}

$svg->addData( $data, new SVGStyle( array( 'stroke'       => 'red', 'fill'         => 'red', 'stroke-width' => 1 ) ) );

$svg->output();
?>