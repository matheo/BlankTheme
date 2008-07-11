<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2008, Mateo Tibaquirá
 * @link http://www.blanktheme.org
 * @version $Id: modifier.checklayout.php 192 2008-07-06 12:38:47Z mateo $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Smarty modifier to implement Theme layout checks in a template
 *
 * available parameters:
 *  - layout       the layout definition under test
 *  - check        the layout to check or
 *  - zone         the zone to check
 *
 * Example
 * with $layout = 'lcr_cb2'
 * <!--[if $layout|checklayout:'l']-->
 * do some stuff when 'l' (left) column is enabled
 * <!--[/if]-->
 *
 * @author   Mateo Tibaquirá
 * @since    30 Ene 08
 * @param    string   $string     Passed layout with the current definition
 * @param    string   $columns    The column(s) definition to check into the passed layout 
 * @return   bool     true is the columns are inside the $layout, false if not or on an error
 */
function smarty_modifier_checklayout($layout, $columns)
{
	if ($layout == '' || $columns == '') {
		return false;
	}

    $layout = explode('_', $layout, 2);
    if (strpos($layout[0], (string)$columns) !== false) {
    	return true;
    }
    return false;
}
