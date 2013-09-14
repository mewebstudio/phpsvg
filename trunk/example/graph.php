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

    protected $startX = 0;
    protected $startY = 0;
    protected $maxY = 0;
    protected $maxX = 0;
    protected $data = 0;

    /**
     * Create a SVGLineGraph
     *
     * @param int $startX
     * @param int $startY
     * @param int $maxY
     * @param int $maxX
     * @return SVGLineGraph
     */
    public static function getInstance( $startX = 30, $startY = 50, $maxY = NULL, $maxX = NULL )
    {
        $svg = parent::getInstance( null, 'SVGLineGraph' );
        $svg->startX = $startX;
        $svg->startY = $startY;
        $svg->maxY = $maxY;
        $svg->maxX = $maxX;

        return $svg;
    }

    public function getStartX()
    {
        return $this->startX . '';
    }

    public function setStartX( $startX )
    {
        $this->startX = $startX;
    }

    public function getStartY()
    {
        return $this->startY . '';
    }

    public function setStartY( $startY )
    {
        $this->startY = $startY;
    }

    public function getMaxY()
    {
        return $this->maxY . '';
    }

    public function setMaxY( $maxY )
    {
        $this->maxY = $maxY;
    }

    public function getMaxX()
    {
        return $this->maxX . '';
    }

    public function setMaxX( $maxX )
    {
        $this->maxX = $maxX;
    }

    public function getData()
    {
        return unserialize( $this->data );
    }

    public function setData( $data )
    {
        $this->data = serialize( $data );
    }

    public function addData( $data, $style = null )
    {
        $dataAll = $this->getData();

        $obj = new stdClass();
        $obj->data = $data;
        $obj->style = $style;

        $dataAll[ ] = $obj;

        $this->setData( $dataAll );
    }

    protected function findMaxY()
    {
        $maxHeight = 0;

        $data = $this->getData();

        if ( is_array( $data ) )
        {
            foreach ( $data as $obj )
            {
                foreach ( $obj->data as $line )
                {
                    if ( $line[ 1 ] > $maxHeight )
                    {
                        $maxHeight = $line[ 1 ];
                    }
                }
            }
        }

        $this->maxY = $maxHeight;
    }

    protected function findMaxX()
    {
        $maxWidth = 0;

        $data = $this->getData();

        if ( is_array( $data ) )
        {
            foreach ( $data as $obj )
            {
                foreach ( $obj->data as $line )
                {
                    if ( $line[ 0 ] > $maxWidth )
                    {
                        $maxWidth = $line[ 0 ];
                    }
                }
            }
        }

        $this->maxX = $maxWidth;
    }

    public function onCreate()
    {
        if ( !$this->getMaxY() )
        {
            $this->findMaxY();
        }

        if ( !$this->getMaxX() )
        {
            $this->findMaxX();
        }

        $this->setWidth( ($this->getMaxX() + 100) . 'px' );
        $this->setHeight( ($this->getMaxY() + 100) . 'px' );

        $this->setDefaultViewBox();


        $clipPath = SVGClipPath::getInstance( 'clipPath' );
        $clipRect = SVGRect::getInstance( 0, 0, null, $this->getWidth(), $this->getHeight() );
        $clipPath->addShape( $clipRect );

        $this->addDefs( $clipPath );

        $backGroup = SVGGroup::getInstance( 'backGroup' );

        $line1 = SVGLine::getInstance( $this->startX, $this->startY, $this->startX, $this->maxY + $this->startY, null, new SVGStyle( array( 'stroke'       => 'black', 'stroke-width' => 1 ) ) );
        $line2 = SVGLine::getInstance( $this->startX, $this->maxY + $this->startY, $this->maxX + $this->startX, $this->maxY + $this->startY, null, new SVGStyle( array( 'stroke'       => 'black', 'stroke-width' => 1 ) ) );

        $backGroup->addShape( $line1 );
        $backGroup->addShape( $line2 );

        #vertical counter
        for ( $i = 0; $i <= $this->maxY; $i += 25 )
        {
            $text = SVGText::getInstance( $this->startX - 30, $this->startY + $i, null, $this->maxY - $i );
            $text->setStyle( "font-family:Arial" );
            $backGroup->addShape( $text );
        }

        #horizontal counter
        for ( $i = 0; $i <= $this->maxX; $i += 50 )
        {
            $text = SVGText::getInstance( $this->startX + $i, $this->startY + $this->maxY + 20, null, $i );
            $text->setStyle( "font-family:Arial" );
            $backGroup->addShape( $text );
        }

        $data = $this->getData();

        $mainGroup = SVGGroup::getInstance( 'mainGroup' );
        $mainGroup->setStyle( new SVGStyle( array( 'clip-path' => 'url(#clipPath)' ) ) );

        if ( is_array( $data ) )
        {
            foreach ( $data as $obj )
            {
                $itemData = $obj->data;
                $style = $obj->style;

                if ( !$style )
                {
                    $style = new SVGStyle( array( 'stroke'       => 'blue', 'fill'         => 'blue', 'stroke-width' => 1 ) );
                }

                if ( is_array( $itemData ) )
                {
                    foreach ( $itemData as $line => $info )
                    {
                        $previous = $this->normalizeLineData( @$itemData[ $line - 1 ] );
                        $info = $this->normalizeLineData( $info );

                        $line = SVGLine::getInstance( $previous[ 0 ], $previous[ 1 ], $info[ 0 ], $info[ 1 ], null, $style );
                        //$this->addShape( $line );
                        $mainGroup->addShape( $line );

                        $circle = SVGCircle::getInstance( $info[ 0 ], $info[ 1 ], 3, null, $style );
                        $circle->setTitle( $info[ 0 ] . ',' . $info[ 1 ] );
                        $circle->addAttribute( "onmouseover", "this.style.stroke = 'lightGray';" );
                        $circle->addAttribute( "onmouseout", "this.style.stroke = 'gray';" );

                        //$this->addShape( $circle );
                        $mainGroup->addShape( $circle );
                    }
                }
            }
        }

        $this->addShape( $backGroup );
        $this->addShape( $mainGroup );

        $this->addScript( "
    var width = $('svg').attr('width').replace('px','');
    $('svg #clippath rect').attr('width',0);
    var anim = setInterval('slideRight()', 1);

    function slideRight()
    {
        var currentWidth = parseInt( $('svg #clippath rect').attr('width') );
        currentWidth += 1;

        $('svg #clippath rect').attr('width',currentWidth );

        if ( currentWidth >= width )
        {
            clearInterval(anim);
        }
    }
" );

        /* $this->addScript( "
          $('svg #mainGroup').hide();
          setTimeout('showGraph()', 500);

          function showGraph()
          {
          $('svg #mainGroup').hide();
          $('svg #mainGroup').show('slow');
          }" ); */
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
        $line[ 1 ] = $this->maxY - $line[ 1 ] + $this->startY;

        return $line;
    }

    public function asXML( $filename = NULL, $human = TRUE )
    {
        #clean fields that not has to be in svg
        unset( $this->maxY );
        unset( $this->maxX );
        unset( $this->startX );
        unset( $this->startY );
        unset( $this->data );
        return parent::asXML( $filename, $human );
    }

}

$svg = SVGLineGraph::getInstance( 50, 30 );
$svg->setTitle( 'SVGLineGraph' );

$data[ ] = array( 12, 23 );
$data[ ] = array( 42, 65 );
$data[ ] = array( 117, 115 );
$data[ ] = array( 153, 224 );
$data[ ] = array( 200, 100 );
$data[ ] = array( 254, 142 );
$data[ ] = array( 367, 45 );
$data[ ] = array( 382, 87 );
$data[ ] = array( 422, 310 );
$data[ ] = array( 484, 67 );
$data[ ] = array( 600, 200 );

$svg->addData( $data );

unset( $data );

#create random data
for ( $i = 0; $i <= 10; $i++ )
{
    $data[ ] = array( rand( $i * ( 540 / 10 ), $i * ( 600 / 10 ) ), rand( 0, 300 ) );
}

$svg->addData( $data, new SVGStyle( array( 'stroke'       => 'red', 'fill'         => 'red', 'stroke-width' => 1 ) ) );

unset( $data );

#create random data
for ( $i = 0; $i <= 10; $i++ )
{
    $data[ ] = array( rand( $i * ( 540 / 10 ), $i * ( 600 / 10 ) ), rand( 0, 300 ) );
}

$svg->addData( $data, new SVGStyle( array( 'stroke'       => 'green', 'fill'         => 'green', 'stroke-width' => 3 ) ) );
$svg->onCreate();
?>

<html>
    <head>
        <title>Line graph</title>
        <script src = "http://code.jquery.com/jquery-1.10.1.min.js"></script>
    </head>
    <body>
        <div>
            <?php
            echo $svg->asXML();
            ?>
        </div>
    </body>
</html>