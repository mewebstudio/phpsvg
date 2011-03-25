<?php
/**
 *
 * Description: Implementation of Style class.
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 18, 2010
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

class SVGStyle
{
    public $fill;
    public $stroke;

    /**
     * Construct the style
     *
     * @param array $style an array with styles
     */
    public function __construct( $style )
    {
        if (is_string($style) )
        {
            $style = explode(';', $style);

            if ( is_array($style))
            {
                foreach ( $style as $line => $info )
                {
                    $styleElement = explode(':', $info);

                    if ( $styleElement[0] )
                    {
                        $this->{$styleElement[0]} = $styleElement[1];
                    }
                }
            }
        }
        else if ( is_array($style) )
        {
            foreach ( $style as $line => $info )
            {
                $this->$line = $info;
            }
        }
    }

    /**
     * Return the string representation of object
     *
     * @return string representation of object
     */
    public function __toString()
    {
        $vars = get_object_vars($this);

        if ( is_array($vars) )
        {
            foreach ( $vars as $line => $info )
            {
                $result .= "$line:$info;";
            }
        }

        return $result;
    }

    /**
     * Set the fill color
     *
     * @param string $fill color
     */
    public function setFill($fill)
    {
        $this->fill = $fill;
    }

    /**
     * Get the fill color
     * 
     * @return string fill color
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Set the stroke (contour) color
     *
     * @param string $stroke the stroke color
     */
    public function setStroke($stroke)
    {
        $this->stroke = $stroke;
    }

    public function getStroke( )
    {
        return $this->stroke;
    }

}
?>
