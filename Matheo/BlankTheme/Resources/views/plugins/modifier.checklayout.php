<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme modifier to check the Theme layout in the templates.
 *
 * Available parameters:
 *  - layout  (string) The layout definition under test.
 *  - columns (string) The columns to check in the current layout.
 *
 * Example
 *  with $layout = '213_cb2'
 *  {if $layout|checklayout:2}
 *    do some stuff when '2' (left column) column is enabled
 *  {/if}
 *
 * @author Mateo Tibaquirá
 * @since  30/01/08
 *
 * @param string $string  Passed layout with the current definition.
 * @param string $columns The column(s) definition to check into the passed layout.
 *
 * @return bool True if the columns are inside the passed layout, false otherwise.
 */
function smarty_modifier_checklayout($layout, $columns)
{
    if (empty($layout) || empty($columns)) {
        return false;
    }

    $layout = explode('_', $layout, 2);
    if (strpos($layout[0], (string)$columns) !== false) {
        return true;
    }

    return false;
}
