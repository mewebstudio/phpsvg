<?php
/**
 *
 * Description: Implementation of Shape, is a generic class.
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

class SVGShape extends XMLElement
{
    /**
     * Define the x coordinate of position
     *
     * @param integer $x the x coordinate of position
     */
    public function setX( $x )
    {
        $this->setAttribute( 'x', $x );
    }

    /**
     * Return the x coordinate of position
     *
     * @return string the x coordinate of position
     */
    public function getX()
    {
        return $this->getAttribute( 'x' );
    }

    /**
     * Define the y coordinate of position
     *
     * @param integer $y the y coordinate of position
     */
    public function setY( $y )
    {
        $this->setAttribute( 'y', $y );
    }

    /**
     * Return the y coordinate of position
     *
     * @return string the y coordinate of position
     */
    public function getY()
    {
        return $this->getAttribute( 'y' );
    }

    /**
     * Define the id of the object
     *
     * @param string $id
     */
    public function setId( $id )
    {
        $this->setAttribute( 'id', $id );
    }

    /**
     * Return the id of element
     *
     * @return string the id of element
     */
    public function getId()
    {
        return $this->getAttribute( 'id' );
    }

    //public $style;
}
?>
