<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme plugin to display the user navigation submenu.
 *
 * Available parameters:
 *  - id           (string) ID of the wrapper div (default: 'nav_main')
 *  - current      (string) Current screen ID (.ini current value or module name) (optional)
 *  - currentclass (string) CSS class name of the current tab, list item (default: 'current')
 *  - span         (bool)   Flag to enable SPAN wrappers on the links text, useful for sliding doors (default: false)
 *
 * Example:
 *  {bt_usersublinks id='nav' current='home' currentclass='myActiveClass'}
 *
 * @author Mateo Tibaquirá
 * @since  19/06/11
 *
 * @param array             $params All parameters passed to this function from the template.
 * @param Zikula_View_Theme &$view  Reference to the View_Theme object.
 *
 * @return string User submenu output.
 */
function smarty_function_bt_usersublinks($params, Zikula_View_Theme &$view)
{
    $dom = ZLanguage::getThemeDomain('BlankTheme');

    $id = isset($params['id']) ? $params['id'] : 'nav_sub';
    if (!isset($params['current'])) {
        $current = $view->getTplVar('current') ? $view->getTplVar('current') : $view->getToplevelmodule();
    } else {
        $current = $params['current'];
    }
    $currentclass = isset($params['currentclass']) ? $params['currentclass'] : 'current';
    $span = isset($params['span']) ? (bool)$params['span'] : false;

    $currentsub = $current.'-'.$view->getTplVar('type').'-'.$view->getTplVar('func');

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
                          '',
                          __('Second Sublink', $dom),
                          '',
                          '#'
                      );

    // render the submenu
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
 * Draw the array-submenu recursively.
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

        // render the suboptions recursively
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
