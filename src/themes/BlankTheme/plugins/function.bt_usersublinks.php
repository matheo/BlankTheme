<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Smarty function to display the user subnavigation menu
 *
 * Example
 * {bt_usersublinks id='nav' current='home' currentclass='myActiveClass'}
 *
 * @author       Mateo Tibaquirá
 * @since        19/06/11
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$view       Reference to the Smarty object
 * @param        string      $current     the current tab (i.e. home, account, news, forum)
 * @param        string      $currentclass CSS class for the current link (default: current)
 * @param        boolean     $span        Put the menu text inside a <span> for sliding doors usage
 *                                        (default: false)
 * @return       string      the results of the module function
 */
function smarty_function_bt_usersublinks($params, Zikula_View_Theme &$view)
{
    $id = isset($params['id']) ? $params['id'] : 'nav_sub';
    $span = isset($params['span']) ? (bool)$params['span'] : false;
    $currentclass = isset($params['currentclass']) ? $params['currentclass'] : 'current';

    if (!isset($params['current'])) {
        $current = $view->getTplVar('current') ? $view->getTplVar('current') : $view->getToplevelmodule();
    } else {
        $current = $params['current'];
    }

    $currentsub = $current.'-'.$view->getTplVar('type').'-'.$view->getTplVar('func');

    $dom = ZLanguage::getThemeDomain('BlankTheme');

    /*** Build the submenu-array ***/
    $menu = array();

    // dummy example links
    $menu['home'][] = array(
                          '',                       // page id : current-type-func
                          __('Home Sublink', $dom), // translatable title
                          '',                       // translatable description
                          '#'                       // link
                      );

    $menu['home'][] = array(
                          'home-user-list',
                          __('Second Sublink', $dom),
                          '',
                          '#'
                      );

    // Render the submenu as an unordered list in a div
    $output = '';

    if (isset($menu[$current])) {
        $output .= '<div id="'.$id.'"><ul>';
        foreach ($menu[$current] as $option) {
            $output .= bt_usersublinks_drawmenu($option, $currentsub, $currentclass, $span);
        }
        $output .= '</ul></div>';
    }

    return $output;
}

/**
 * Draw the array-submenu recursively
 */
function bt_usersublinks_drawmenu($option, $current, $currentclass, $span=false)
{
    $return = '';

    if (is_array($option)) {
        $option[3] = !empty($option[3]) ? $option[3] : '#';

        $return .= "\n".'<li'. ($option[0] == $current ? " class=\"$currentclass\"" : '' ) .'>';

        $linkclass = (isset($option[4]) && is_array($option[4]))?' class="navparent"' : '';
        $return .= "\n".'<a'.$linkclass;
        $return .= ' title="'.DataUtil::formatForDisplay($option[2]).'"';
        $return .= ' href="'.DataUtil::formatForDisplay($option[3]).'">';
        $return .= ($span ? '<span>' : ''). DataUtil::formatForDisplay($option[1]). ($span ? '</span>' : '');
        $return .= '</a>';

        // render the optional suboptions recursively
        if (isset($option[4]) && is_array($option[4])) {
            $return .= "\n".'<ul>';
            foreach ($option[4] as $suboption) {
                $return .= bt_usersublinks_drawmenu($suboption, $current, $currentclass, $span, false);
            }
            $return .= "\n".'</ul>';
        }
        $return .= "\n".'</li>';
    }

    return $return;
}
