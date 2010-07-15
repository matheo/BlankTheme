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
function smarty_function_bt_userlinks($params, $smarty)
{
    $id = isset($params['id']) ? $params['id'] : 'nav_main';

    $currentclass = isset($params['currentclass']) ? $params['currentclass'] : 'current';

    if (!isset($params['current'])) {
        $current = (isset($smarty->_tpl_vars['current'])) ? $smarty->_tpl_vars['current'] : $smarty->toplevelmodule;
    } else {
        $current = $params['current'];
    }

    $span = isset($params['span']) ? (bool)$params['span'] :  false;

    $dom = ZLanguage::getThemeDomain('blanktheme');

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_of_sublinks */
    $menu   = array();
    $menu[] = array('home', __('Home', $dom), pnGetHomepageURL(), null);

    if (pnModAvailable('News')) {
        $menu[] = array('News', __('News', $dom), pnModURL('News'), null);
    }

    if (pnModAvailable('Pages')) {
        $menu[] = array('Pages', __('Pages', $dom), pnModURL('Pages'), null);
    }

    if (pnModAvailable('Dizkus')) {
        $menu[] = array('Dizkus', __('Forums', $dom), pnModURL('Dizkus'), null);
    }

    if (pnModAvailable('PNphpBB2')) {
        $menu[] = array('PNphpBB2', __('Forums', $dom), pnModURL('PNphpBB2'), null);
    }

    if (pnModAvailable('Zafenio')) {
        $menu[] = array('Zafenio', __('Forums', $dom), pnModURL('Zafenio'), null);
    }

    if (pnModAvailable('FAQ')) {
        $menu[] = array('FAQ', __('Faq', $dom), pnModURL('FAQ'), null);
    }

    if (pnModAvailable('wikula')) {
        $menu[] = array('wikula', __('Wiki', $dom), pnModURL('wikula'), null);
    }

    if (pnModAvailable('crpCalendar')) {
        $menu[] = array('crpCalendar', __('Calendar', $dom), pnModURL('crpCalendar'), null);
    }

    if (pnModAvailable('TimeIt')) {
        $menu[] = array('TimeIt', __('Calendar', $dom), pnModURL('TimeIt'), null);
    }

    if (pnModAvailable('Eventliner')) {
        $menu[] = array('Eventliner', __('Calendar', $dom), pnModURL('Eventliner'), null);
    }

    if (pnModAvailable('formicula')) {
        $menu[] = array('formicula', __('Contact', $dom), pnModURL('formicula'), null);
    }

    // Render the menu as an unordered list in a div
    $output  = '<div id="'.$id.'"><ul>';
    foreach ($menu as $option) {
        $output .= bt_userlinks_drawmenu($option, $current, $currentclass, $span);
    }
    $output .= '</ul></div>';

    return $output;
}

/**
 * Draw the arra-menu recursively
 */
function bt_userlinks_drawmenu($option, $current, $currentclass, $span=false)
{
    $return = '';

    if (is_array($option)) {
        $return .= '<li'. (($option[0] == $current)?' id='.$currentclass:'') .'>';
        if (!empty($option[2])) {
            $return .= '<a'. ((isset($option[3]) && is_array($option[3]))?' class="navparent"':''). ' title="'. DataUtil::formatForDisplay($option[1]). '" href="'.DataUtil::formatForDisplay($option[2]).'">'. ($span ? '<span>' : ''). DataUtil::formatForDisplay($option[1]). ($span ? '</span>' : ''). '</a>';
        } else {
            $return .= ($span ? '<span>' : ''). DataUtil::formatForDisplay($option[1]). ($span ? '</span>' : '');
        }
        // Render the optional suboptions recursively
        if (isset($option[3]) && is_array($option[3])) {
            $return .= '<ul>';
            foreach ($option[3] as $suboption) {
                $return .= bt_userlinks_drawmenu($suboption, $current, $currentclass, $span);
            }
            $return .= '</ul>';
        }
        $return .= '</li>';
    }

    return $return;
}
