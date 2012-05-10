<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme plugin to display the user navigation menu.
 *
 * Available parameters:
 *  - id           (string) ID of the wrapper div (default: null)
 *  - current      (string) Current screen ID (.ini current value or module name) (optional)
 *  - currentclass (string) CSS class name of the current tab, list item (default: 'active')
 *  - span         (bool)   Flag to enable SPAN wrappers on the links text, useful for sliding doors (default: false)
 *  - desc         (bool)   Flag to put the parent links descriptions inside SPAN.bt-desc instead the link title (default: false)
 *
 * Example:
 *  {bt_userlinks id='myId' current='home' currentclass='myActiveClass'}
 *
 * @author Mateo Tibaquirá
 * @since  08/11/07
 *
 * @param array             $params All parameters passed to this function from the template.
 * @param Zikula_View_Theme &$view  Reference to the View_Theme object.
 *
 * @return string User menu output.
 */
function smarty_function_bt_userlinks($params, Zikula_View_Theme &$view)
{
    $dom = ZLanguage::getThemeDomain('BlankTheme');

    $id = isset($params['id']) ? $params['id'] : null;
    if (!isset($params['current'])) {
        $current = $view->getTplVar('current') ? $view->getTplVar('current') : $view->getToplevelmodule();
    } else {
        $current = $params['current'];
    }
    $currentclass = isset($params['currentclass']) ? $params['currentclass'] : 'active';
    $span = isset($params['span']) ? (bool)$params['span'] : false;
    $desc = isset($params['desc']) ? (bool)$params['desc'] : false;

    /*** Build the menu-array ***/
    $menu   = array();
    $menu[] = array(
                  'home',                      // page id / module name
                  __('Home', $dom),            // translatable title
                  __('Go to home page', $dom), // translatable description
                  System::getHomepageUrl(),    // link
                  null                         // array of sublinks (optional)
              );

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

    // render the menu
    $output  = $id ? '<div id="'.$id.'">' : '';
    $output .= '<ul>';
    foreach ($menu as $option) {
        $output .= bt_userlinks_drawmenu($option, $current, $currentclass, $span, $desc);
    }
    $output .= '</ul>';
    $output .= $id ? '</div>' : '';

    return $output;
}

/**
 * Draw the array-menu recursively.
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
            $return .= DataUtil::formatForDisplay($option[1]).' <span class="bt-desc">'.DataUtil::formatForDisplay($option[2]).'</span>';
        } else {
            $return .= ($span ? '<span>' : ''). DataUtil::formatForDisplay($option[1]). ($span ? '</span>' : '');
        }
        $return .= '</a>';

        // render the suboptions recursively
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
