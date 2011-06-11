<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
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
 * @param        object      &$view       Reference to the Smarty object
 * @param        string      $class       CSS class
 * @param        string      $current     the current tab (i.e. home, account, news, forum)
 * @param        string      $currentclass CSS class for the current link (default: current)
 * @param        boolean     $desc        Put the title in a <span> inside the link instead the link title
 *                                        for extended parent info (default: false)
 * @param        boolean     $span        Put the menu text inside a <span> for sliding doors usage
 *                                        (default: false)
 * @return       string      the results of the module function
 */
function smarty_function_bt_userlinks($params, Zikula_View_Theme &$view)
{
    $id = isset($params['id']) ? $params['id'] : 'nav_main';

    $currentclass = isset($params['currentclass']) ? $params['currentclass'] : 'current';

    if (!isset($params['current'])) {
        $current = $view->getTplVar('current') ? $view->getTplVar('current') : $view->getToplevelmodule();
    } else {
        $current = $params['current'];
    }

    $span = isset($params['span']) ? (bool)$params['span'] : false;
    $desc = isset($params['desc']) ? (bool)$params['desc'] : false;

    $dom = ZLanguage::getThemeDomain('BlankTheme');

    /*** Build the menu-array ***/
    $menu   = array();
    $menu[] = array(
                  'home',                     // page id / module name
                  __('Home', $dom),           // translatable title
                  __('Go to home page', $dom), // translatable description
                  System::getHomepageUrl(),   // link
                  null                        // array of sublinks (optional)
              );
/*
    $menu[] = array(
                  'ModName / Current',
                  __('Home', $dom),
                  __('Go to home page', $dom),
                  ModUtil::url('Modname', 'type', 'func', array('param' => 'value'))
              );
*/
    if (ModUtil::available('News')) {
        $menu[] = array(
                      'News',
                      __('News', $dom),
                      __('Articles index', $dom),
                      ModUtil::url('News', 'user', 'main')
                  );
    }

    if (ModUtil::available('Pages')) {
        $menu[] = array(
                      'Pages',
                      __('Pages', $dom),
                      __('Content section', $dom),
                      ModUtil::url('Pages', 'user', 'main')
                  );
    }

    if (ModUtil::available('Dizkus')) {
        $menu[] = array(
                      'Dizkus',
                      __('Forums', $dom),
                      __('Discuss area', $dom),
                      ModUtil::url('Dizkus', 'user', 'main')
                  );
    }

    if (ModUtil::available('FAQ')) {
        $menu[] = array(
                      'FAQ',
                      __('FAQ', $dom),
                      __('Frequent questions', $dom),
                      ModUtil::url('FAQ', 'user', 'main')
                  );
    }

    if (ModUtil::available('Wikula')) {
        $menu[] = array(
                      'Wikula',
                      __('Wiki', $dom),
                      __('Documents', $dom),
                      ModUtil::url('Wikula', 'user', 'main')
                  );
    }

    if (ModUtil::available('TimeIt')) {
        $menu[] = array(
                      'TimeIt',
                      __('Calendar', $dom),
                      __('List of events', $dom),
                      ModUtil::url('TimeIt', 'user', 'main')
                  );
    }

    if (ModUtil::available('crpCalendar')) {
        $menu[] = array(
                      'crpCalendar',
                      __('Calendar', $dom),
                      __('List of events', $dom),
                      ModUtil::url('crpCalendar', 'user', 'main')
                  );
    }

    if (ModUtil::available('Formicula')) {
        $menu[] = array(
                      'Formicula',
                      __('Contact us', $dom),
                      __('Comment or suggest', $dom),
                      ModUtil::url('Formicula', 'user', 'main')
                  );
    }

    // Render the menu as an unordered list in a div
    $output  = '<div id="'.$id.'"><ul>';
    foreach ($menu as $option) {
        $output .= bt_userlinks_drawmenu($option, $current, $currentclass, $span, $desc);
    }
    $output .= '</ul></div>';

    return $output;
}

/**
 * Draw the arra-menu recursively
 */
function bt_userlinks_drawmenu($option, $current, $currentclass, $span=false, $desc=false)
{
    $return = '';

    if (is_array($option)) {
        $option[3] = !empty($option[3]) ? $option[3] : '#';

        $return .= "\n".'<li'. ($option[0] == $current ? " class=\"$currentclass\"" : '' ) .'>';

        $linkclass = (isset($option[4]) && is_array($option[4]))?' class="navparent"' : '';
        $return .= "\n".'<a'.$linkclass;
        $return .= $desc ? '' : ' title="'.DataUtil::formatForDisplay($option[2]).'"';
        $return .= ' href="'.DataUtil::formatForDisplay($option[3]).'">';
        if ($desc) {
            $return .= DataUtil::formatForDisplay($option[1]).' <span class="bt_desc">'.DataUtil::formatForDisplay($option[2]).'</span>';
        } else {
            $return .= ($span ? '<span>' : ''). DataUtil::formatForDisplay($option[1]). ($span ? '</span>' : '');
        }
        $return .= '</a>';

        // render the optional suboptions recursively
        if (isset($option[4]) && is_array($option[4])) {
            $return .= "\n".'<ul>';
            foreach ($option[4] as $suboption) {
                $return .= bt_userlinks_drawmenu($suboption, $current, $currentclass, $span, false);
            }
            $return .= "\n".'</ul>';
        }
        $return .= "\n".'</li>';
    }

    return $return;
}
