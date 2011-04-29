<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) BlankTheme Team
 * @link       http://www.blanktheme.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @version    $Id$
 */

/**
 * Smarty function to display the user navigation menu
 *
 * Example
 * {bt_userlinks id='myId' current='home' currentclass='myActiveClass'}
 *
 * @author       Mateo Tibaquirá
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

    $dom = ZLanguage::getThemeDomain('BlankTheme');

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_of_sublinks */
    $menu   = array();
    $menu[] = array('home', __('Home', $dom), System::getHomepageUrl(), null);

    if (ModUtil::available('News')) {
        $menu[] = array('News', __('News', $dom), ModUtil::url('News'), null);
    }

    if (ModUtil::available('Pages')) {
        $menu[] = array('Pages', __('Pages', $dom), ModUtil::url('Pages'), null);
    }

    if (ModUtil::available('Dizkus')) {
        $menu[] = array('Dizkus', __('Forums', $dom), ModUtil::url('Dizkus'), null);
    }

    if (ModUtil::available('PNphpBB2')) {
        $menu[] = array('PNphpBB2', __('Forums', $dom), ModUtil::url('PNphpBB2'), null);
    }

    if (ModUtil::available('Zafenio')) {
        $menu[] = array('Zafenio', __('Forums', $dom), ModUtil::url('Zafenio'), null);
    }

    if (ModUtil::available('FAQ')) {
        $menu[] = array('FAQ', __('Faq', $dom), ModUtil::url('FAQ'), null);
    }

    if (ModUtil::available('wikula')) {
        $menu[] = array('wikula', __('Wiki', $dom), ModUtil::url('wikula'), null);
    }

    if (ModUtil::available('crpCalendar')) {
        $menu[] = array('crpCalendar', __('Calendar', $dom), ModUtil::url('crpCalendar'), null);
    }

    if (ModUtil::available('TimeIt')) {
        $menu[] = array('TimeIt', __('Calendar', $dom), ModUtil::url('TimeIt'), null);
    }

    if (ModUtil::available('Eventliner')) {
        $menu[] = array('Eventliner', __('Calendar', $dom), ModUtil::url('Eventliner'), null);
    }

    if (ModUtil::available('formicula')) {
        $menu[] = array('formicula', __('Contact', $dom), ModUtil::url('formicula'), null);
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
        $return .= '<li'. ($option[0] == $current ? " id=\"$currentclass\"" : '' ) .'>';
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
