<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Smarty modifier to implement Theme zone checks in a template
 *
 * available parameters:
 *  - layout       the layout definition under test
 *  - zone         the zone to check
 *
 * Example
 * with $layout = '213_cb2'
 * {if $layout|checkzone:'cb2'}
 * do some stuff when 'cb2' (center-bottom zone with 2 subcolumns) zone is enabled
 * {/if}
 *
 * @author   Mateo Tibaquirá
 * @since    30 Ene 08
 * @param    string   $string     Passed layout with the current definition
 * @param    string   $zone       The zone to check into the passed layout
 * @return   bool     true is the zone is inside the $layout, false if not or on an error
 */
function smarty_modifier_checkzone($layout, $zone)
{
    if (empty($layout) || empty($zone)) {
        return false;
    }

    $layout = explode('_', $layout);
    unset($layout[0]);

    return in_array((string)$zone, $layout);
}
