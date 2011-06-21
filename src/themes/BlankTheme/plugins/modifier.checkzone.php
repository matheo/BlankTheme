<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme modifier to check Theme zones in the templates.
 *
 * Available parameters:
 *  - layout (string) The layout definition under test.
 *  - zone   (string) The zone to check in the current layout.
 *
 * Example
 *  with $layout = '213_cb2'
 *  {if $layout|checkzone:'cb2'}
 *    do some stuff when 'cb2' (center-bottom zone with 2 subcolumns) zone is enabled
 *  {/if}
 *
 * @author Mateo Tibaquirá
 * @since  30/01/08
 *
 * @param string $string Passed layout with the current definition.
 * @param string $zone   The zone to check into the passed layout.
 *
 * @return bool True if the zone is inside the passed layout, false otherwise.
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
