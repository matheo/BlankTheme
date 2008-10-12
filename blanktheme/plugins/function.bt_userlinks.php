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
 *                                        Default = 'navselected'
 * @return       string      the results of the module function
 */
function smarty_function_bt_userlinks($params, &$smarty)
{
    extract($params);
    unset($params);

    if (!isset($id))
    {
        $id = 'nav_main';
    }

    if (!isset($currentclass))
    {
        $currentclass = 'current';
    }

    if (!isset($current))
    {
        $current = $smarty->toplevelmodule;
    }

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_sublinks */
    $menu   = array();
    $menu[] = array('home',          _NAV_HOME,    pnGetBaseURL(), null);
    if (pnModAvailable('News')) {
        $menu[] = array('News',      _NAV_NEWS,    pnModURL('News'), null);
    }
    if (pnModAvailable('Pages')) {
        $menu[] = array('Pages',     _NAV_PAGES,   pnModURL('Pages'), null);
    }
    if (pnModAvailable('pnForum')) {
        $menu[] = array('pnForum',   _NAV_FORUMS,  pnModURL('pnForum'), null);
    }
    if (pnModAvailable('PNphpBB2')) {
        $menu[] = array('PNphpBB2',  _NAV_FORUMS,  pnModURL('PNphpBB2'), null);
    }
    if (pnModAvailable('FAQ')) {
        $menu[] = array('FAQ',       _NAV_FAQ,     pnModURL('FAQ'), null);
    }
    if (pnModAvailable('formicula')) {
        $menu[] = array('formicula', _NAV_CONTACT, pnModURL('formicula'), null);
    }

    $output  = '<div id="'.$id.'">';
    $output .= '<ul>';
    foreach($menu as $option) {
        $output .= bt_userlinks_drawmenu($option,$current,$currentclass);
    }
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}

/**
 * Add a style to a link if it has suboptions
 */
function bt_userlinks_stylea($option = null)
{
    $return = '';
    if(!empty($option) && is_array($option))
        $return .= ' class="navparent"';
    return $return;
}

/**
 * Add a style to a list-item if it's the current option
 */
function bt_userlinks_styleli($option,$current,$currentclass)
{
    $return = '';
    if($option==$current)
        $return .= ' id="'.$currentclass.'"';
    return $return;
}

/**
 * Draw the arra-menu recursively
 */
function bt_userlinks_drawmenu($option,$current,$currentclass)
{
    $return = '';
    if(is_array($option)) {
        $return .= '<li'. bt_userlinks_styleli($option[0],$current,$currentclass) .'>';
        $stylea = (isset($option[3]) && !empty($option[3])) ? bt_userlinks_stylea($option[3]) : '';
        $return .= '<a'. $stylea .' title="'.DataUtil::formatForDisplay($option[1]).'" href="'.DataUtil::formatForDisplay($option[2]).'">'.DataUtil::formatForDisplay($option[1]).'</a>';
        
        if(isset($option[3]) && !empty($option[3]) && is_array($option[3])) {
            $suboptions = $option[3];
            $return .= '<ul>';
            foreach($suboptions as $suboption) {
                $return .= bt_userlinks_drawmenu($suboption,$current,$currentclass);
            }
            $return .= '</ul>';
        }
        $return .= '</li>';
    }
    return $return;
}
