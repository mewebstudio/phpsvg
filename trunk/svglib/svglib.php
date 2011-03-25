<?php
/**
 *
 * Description: Implementation SVGDocument inlude all other libs
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2010
 *
 * @version 0.1
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

include_once('xmlelement.php'); //extends SimpleXmlElement
include_once('svgstyle.php'); //generic shape
include_once('svgshape.php'); //generic shape
include_once('svgshapeex.php'); //extended shape
include_once('svgpath.php'); //path object
include_once('svgrect.php'); //rect object
include_once('svgtext.php'); //text object
include_once('svgimage.php'); //image object suports embed image


/**
 *
 * Needed to use:
 * SimpleXmlElement
 * gzip support (for compressed svg)
 * imagemagick to export to png
 * GD to use embed image
 *
 * Reference site:
 * http://www.leftontheweb.com/message/A_small_SimpleXML_gotcha_with_namespaces
 * http://blog.jondh.me.uk/2010/10/resetting-namespaced-attributes-using-simplexml/
 * http://www.w3.org/TR/SVG/
 */
class SVGDocument extends XMLElement
{
    const VERSION = '1.1';
    const XMLNS = 'http://www.w3.org/2000/svg';
    const EXTENSION = 'svg';
    const EXTENSION_COMPACT = 'svgz';
    const HEADER = 'image/svg+xml';


    /**
     * Return the extension of a filename
     * 
     * @param string $filename the filename to get the extension
     * @return string the filename to get the extension
     */
    protected static function getFileExtension($filename)
    {
        $explode = explode('.', $filename);
        return strtolower( $explode[ count( $explode ) -1 ]  );
    }

    /**
     * Return a SVGDocument
     *
     * If filename is not passed create a default svg.
     *
     * Supports gzipped content.
     *
     * @param $filename the file to load
     *
     * @return SVGDocument
     */
    public static function getInstance( $filename = null )
    {
        if ( $filename )
        {
            //if is svgz use compres.zlib to load the compacted SVG
            if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
            {
                //verify if zlib is installed
                if ( ! function_exists( 'gzopen' ) )
                {
                    throw new Exception('GZip support not installed.');
                    return false;
                }

                $filename = 'compress.zlib://'.$filename;
            }

            //get the content
            $content = file_get_contents($filename);

            //throw error if not found
            if ( !$content)
            {
                throw new Exception('Impossible to load content.');
                return false;
            }

            $svg = new SVGDocument( $content );
        }
        else
        {
            $svg = new SVGDocument( '<?xml version="1.0" encoding="UTF-8" standalone="no"?><svg></svg>' );

            //define the default parameters A4 pageformat
            $svg->setWidth( '210mm' );
            $svg->setHeight( '297mm' );
            $svg->setVersion( self::VERSION );
            $svg->setAttribute('xmlns', self::XMLNS );
            //create default graphics
            $svg->addChild('g');
        }

        return $svg;
    }

    /**
     * Out the file, used in browser situation,
     * because it changes the header to xml header
     *
     */
    public function output()
    {
        header( 'Content-type: '.self::HEADER );
        echo $this->asXML();
    }

    /**
     * Export the object as xml text, OR xml file.
     *
     * If the file extension is svgz, the function will save it correctely;
     *
     * @param string $filename the file to save, is optional, you can output to a var
     * @return string the xml string if filename is not passed
     */
    public function asXML( $filename = null )
    {
        //if is svgz use compres.zlib to load the compacted SVG
        if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
        {
            //verify if zlib is installed
            if ( ! function_exists( 'gzopen' ) )
            {
                throw new Exception('GZip support not installed.');
                return false;
            }

            $filename = 'compress.zlib://'.$filename;
        }

        //need to do it, if pass a null filename it return an error
        if ( $filename )
        {
            return parent::asXML( $filename );
        }

        return parent::asXML( );
    }

    /**
     * Magic toString function.
     *
     * @return string
     *
     */
    public function __toString()
    {
        return $this->asXML();
    }

    /**
     * Export to a image file, consider file extension
     * Uses imageMagick
     *
     * @param string $filename
     * @param integer $width the width of exported image
     * @param integer $height the height of exported image
     * @param boolean $respectRatio respect the ratio, image proportion
     */
    public function export($filename, $width=null, $height=null, $respectRatio = false )
    {
        $image = new Imagick();

        $ok = $image->readImageBlob( $this->asXML() );

        if ( $ok )
        {
            if ( $width && $height )
            {
                $image->thumbnailImage( $width, $height, $respectRatio );
            }

            $image->writeImage( $filename );

            $ok = true;
        }

        return $ok;
    }

    /**
     * Define the version of SVG document
     *
     * @param string $version
     */
    public function setVersion( $version )
    {
        $this->setAttribute('version', $version);
    }
    
    /**
     * Get the version of SVG document
     *
     * @param string $version
     */
    public function getVersion()
    {
        return $this->getAttribute('version');
    }

    /**
     * Define the page dimension , width.
     * 
     * @example setWidth('350px');
     * @example setWidth('350mm');
     *
     * @param string $width
     */
    public function setWidth( $width )
    {
        $this->setAttribute('width', $width);
    }

    /**
     * Returns the width of page
     *
     * @return string the width of page
     */
    public function getWidth( )
    {
        return $this->getAttribute('width');
    }

    /**
     * Define the height of page.
     *
     * @param string $height
     * 
     * @example setHeight('350mm');
     * @example setHeight('350px');
     */
    public function setHeight( $height )
    {
        $this->setAttribute('height', $height);
    }

    /**
     * Returns the height of page
     *
     * @return string the height of page
     */
    public function getHeight( )
    {
        return $this->getAttribute('height');
    }

    /**
     * Add a shape to SVG graphics
     *
     * @param XMLElement $append the element to append
     */
    public function addShape( $append )
    {
        $this->append( $append );
    }
}
?>