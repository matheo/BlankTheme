<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) 2008, BlankTheme Team
 * @link       http://www.blanktheme.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @version    $Id$
 */

/**
 * Smarty function to display the user navigation menu
 *
 * Example
 * <!--[bt_userlinks id='myId' current='home' currentclass='myActiveClass']-->
 *
 * @author       Mateo Tibaquira
 * @since        08/11/07
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$smarty     Reference to the Smarty object
 * @param        string      $class       CSS class
 * @param        string      $current     the current tab (i.e. home, account, news, forum)
 *                                        No default value
 * @param        string      $currentclass CSS class for the current link
 *                                        Default = 'current'
 * @param        boolean     $span        Put the menu text inside a <span> for sliding doors usage
 *                                        Default false
 * @return       string      the results of the module function
 */
function smarty_function_bt_userlinks($params, &$smarty)
{
    extract($params);
    unset($params);

    if (!isset($id)) {
        $id = 'nav_main';
    }
    if (!isset($currentclass)) {
        $currentclass = 'current';
    }
    if (!isset($current)) {
        $current = (isset($smarty->_tpl_vars['current'])) ? $smarty->_tpl_vars['current'] : $smarty->toplevelmodule;
    }
    if (!isset($span)) {
        $span = false;
    }

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_of_sublinks */
    $menu   = array();
    $menu[] = array('home', _NAV_HOME, $smarty->baseurl, null);
    if (pnModAvailable('News')) {
        $menu[] = array('News', _NAV_NEWS, pnModURL('News'), null);
    }
    if (pnModAvailable('Pages')) {
        $menu[] = array('Pages', _NAV_PAGES, pnModURL('Pages'), null);
    }
    if (pnModAvailable('Dizkus')) {
        $menu[] = array('Dizkus', _NAV_FORUMS, pnModURL('Dizkus'), null);
    }
    if (pnModAvailable('PNphpBB2')) {
        $menu[] = array('PNphpBB2', _NAV_FORUMS, pnModURL('PNphpBB2'), null);
    }
    if (pnModAvailable('Zafenio')) {
        $menu[] = array('Zafenio', _NAV_FORUMS, pnModURL('Zafenio'), null);
    }
    if (pnModAvailable('FAQ')) {
        $menu[] = array('FAQ', _NAV_FAQ, pnModURL('FAQ'), null);
    }
    if (pnModAvailable('Wikula')) {
        $menu[] = array('Wikula', _NAV_WIKI, pnModURL('Wikula'), null);
    }
    if (pnModAvailable('crpCalendar')) {
        $menu[] = array('crpCalendar', _NAV_CALENDAR, pnModURL('crpCalendar'), null);
    }
    if (pnModAvailable('TimeIt')) {
        $menu[] = array('TimeIt', _NAV_CALENDAR, pnModURL('TimeIt'), null);
    }
    if (pnModAvailable('Eventliner')) {
        $menu[] = array('Eventliner', _NAV_CALENDAR, pnModURL('Eventliner'), null);
    }
    if (pnModAvailable('formicula')) {
        $menu[] = array('formicula', _NAV_CONTACT, pnModURL('formicula'), null);
    }

    // Render the menu as an unordered list in a div
    $output  = '<div id="'.$id.'"><ul>';
    foreach($menu as $option) {
        $output .= bt_userlinks_drawmenu($option,$current,$currentclass,$span);
    }
    $output .= '</ul></div>';

    return $output;
}

/**
 * Draw the arra-menu recursively
 */
function bt_userlinks_drawmenu($option,$current,$currentclass,$span=false)
{
    $return = '';
    if(is_array($option)) {
        $return .= '<li' . (($option[0] == $current)?' id='.$currentclass:'') . '>';
        $return .= '<a'. ((isset($option[3]) && is_array($option[3]))?' class="navparent"':''). ' title="'. DataUtil::formatForDisplay($option[1]). '" href="'.DataUtil::formatForDisplay($option[2]).'">'. (($span)?'<span>':''). DataUtil::formatForDisplay($option[1]). (($span)?'</span>':''). '</a>';
        // Render the optional suboptions recursively
        if(isset($option[3]) && is_array($option[3])) {
            $return .= '<ul>';
            foreach($option[3] as $suboption) {
                $return .= bt_userlinks_drawmenu($suboption,$current,$currentclass,$span);
            }
            $return .= '</ul>';
        }
        $return .= '</li>';
    }
    return $return;
}
