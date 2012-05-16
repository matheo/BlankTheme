<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme plugin to centralize important outputs.
 *
 * Available parameters:
 *  - section (string) Name of the output section to return.
 *  - noempty (bool)   Flag to disable the "bt-empty" CSS class for the classesinnerpage section.
 *
 * Example:
 *  {bt_htmloutput section='head'}
 *  {bt_htmloutput section='topnavlinks'}
 *
 * @author Mateo Tibaquirá
 * @since  05/07/08
 *
 * @param array             $params All parameters passed to this function from the template.
 * @param Zikula_View_Theme &$view  Reference to the View_Theme object.
 *
 * @return string Output of the requested section.
 */
function smarty_function_bt_htmloutput($params, Zikula_View_Theme &$view)
{
    $dom = ZLanguage::getThemeDomain('BlankTheme');

    // section parameter check
    if (!isset($params['section']) || empty($params['section'])) {
        return '';
    }

    // blanktheme vars
    $body      = $view->getTplVar('body');
    $layout    = $view->getTplVar('layout');
    $btconfig  = $view->getTplVar('btconfig');
    $btcssbody = $view->getTplVar('btcssbody');

    // check for the current variable
    if ($view->getTplVar('current')) {
        $current = $view->getTplVar('current');
    } else {
        $current = $view->getToplevelmodule();
        $view->assign('current', $current);
    }

    // process the respective output
    $output = '';

    switch ($params['section'])
    {
        case 'topnavlinks':
            // build the menu list
            // option: {id, translatable link text, link}
            $menu = array();
            if (UserUtil::isLoggedIn()) {
                if ($view->getTplVar('type') != 'admin' && SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
                    $menu[] = array('admin', __('Admin', $dom), ModUtil::url('Admin', 'admin', 'adminpanel'));
                }
                $profileModule = System::getVar('profilemodule', '');
                if (!empty($profileModule) && ModUtil::available($profileModule)) {
                    $menu[] = array('account', __('Your account', $dom), ModUtil::url($profileModule, 'user', 'main'));
                }
                $menu[] = array('logout', __('Log out', $dom), ModUtil::url('Users', 'user', 'logout'));
            } else {
                $menu[] = array('register', __('Register', $dom), ModUtil::url('Users', 'user', 'register'));
                $menu[] = array('login', __('Login', $dom), ModUtil::url('Users', 'user', 'login'));
            }
            // render the menu
            $count   = count($menu) - 1;
            $output  = '<div id="bt-topnavlinks"><ul>';
            foreach ($menu as $k => $option) {
                $class = '';
                if (count($menu) == 1) {
                    $class = 'unique';
                } elseif ($k == 0) {
                    $class = 'first';
                } elseif ($k == $count) {
                    $class = 'last';
                }
                $output .= '<li '.($class ? ' class="bt-'.$class.'"' : '').'>';
                if (!empty($option[2])) {
                    $output .= '<a title="'. DataUtil::formatForDisplay($option[1]). '" href="'.DataUtil::formatForDisplay($option[2]).'"><span>'. DataUtil::formatForDisplay($option[1]). '</span></a>';
                } else {
                    $output .= '<span>'. DataUtil::formatForDisplay($option[1]). '</span>';
                }
                $output .= '</li>';
            }
            $output .= '</ul></div>';
            break;

        case 'fontresize':
            if ($btconfig['fontresize'] != '1') {
                break;
            }
            // font resize based in the efa script
            PageUtil::addVar('javascript', $view->getScriptpath().'/efa_fontsize.min.js');
            //PageUtil::addVar('javascript', $view->getScriptpath().'/efa_fontsize.js');
            $output = '<script type="text/javascript">
                         // <![CDATA[
                         if (efa_fontSize) {
                           var efalang_zoomIn = "'.__('Increase font size', $dom).'";
                           var efalang_zoomReset = "'.__('Reset font size', $dom).'";
                           var efalang_zoomOut = "'.__('Decrease font size', $dom).'";
                           var efathemedir = "'.$view->getDirectory().'";
                           efa_fontSize.efaInit();
                           document.write(efa_fontSize.allLinks);
                         }
                         // ]]>
                       </script>
                       ';
            break;

        case 'head':
            // head stylesheets
            $output .= '<!--[if lte IE 7]>'
                      .'<link rel="stylesheet" href="'.$view->getThemepath().'/yaml/core/iehacks.min.css" type="text/css" />'
                      .'<![endif]-->';
/*                    .'<!--[if lte IE 6]>'
//                    .'<script type="text/javascript" src="'.$view->getScriptpath().'/ie_minmax.js"></script>'
                      .'<style type="text/css">
                            img, div, a, input { behavior: url('.$view->getStylepath().'/iepngfix.htc) }
                        </style>'
//                    .'<script type="text/javascript" src="'.$view->getScriptpath().'/ie_pngfix_tilebg.js"></script>'
                      .'<![endif]-->
                       ';
*/
            break;

        case 'footer':
            // load the Theme styles in the very end of the page rendering
            // TODO pending review with PageUtil weight assignment (when implemented)
            if ($btconfig['optimize'] == '1') {
                // do not load the layout_* stylesheet and load the basic styles directly
                PageUtil::addVar('stylesheet', $view->getThemepath().'/yaml/core/base.min.css');
                PageUtil::addVar('stylesheet', $view->getStylepath().'/navigation.css');
                PageUtil::addVar('stylesheet', $view->getStylepath().'/screen.css');
                PageUtil::addVar('stylesheet', $view->getStylepath().'/typography.css');
                // TODO rtl-support load yaml/add-ons/rtl-support/core/base-rtl.css with the respective typography-rtl.css
            } else {
                PageUtil::addVar('stylesheet', $view->getStylepath()."/layout_{$body}.css");
            }
            // full skip link functionality in webkit browsers
            PageUtil::addVar('footer', '<script src="'.$view->getThemepath().'/yaml/core/js/yaml-focusfix.js"></script>');
            break;

        /* Body ID */
        case 'bodyid':
            if ($view->getToplevelmodule()) {
                $output = 'bt-'.$view->getToplevelmodule();

            } elseif (!empty($current)) {
                $output = 'bt-'.$current;

            } else {
                $output = 'bt-staticpage';
            }
            break;

        /* First CSS level */
        case 'classesbody':
            // add a first level of CSS classes like current language, type parameter and body template in use with a 'bt-' prefix
            if (!empty($current)) {
                $output .= 'bt-'.$current.' ';
            }
            if ($btcssbody && isset($btcssbody[$body]) && $btcssbody[$body]) {
                $output .= $btcssbody[$body].' ';
            }
            $output .= 'bt-'.$body.' bt-type-'.$view->getType().' bt-lang-'.$view->getLanguage();
            break;

        /* Second CSS level */
        case 'classespage':
            // add a second level of CSS classes
            // add the current layout and enabled zones
            $output .= 'bt-'.str_replace('_', ' bt-', $layout);
            // add the current function name
            $output .= ' bt-func-'.$view->getFunc();
            break;

        /* Third CSS level */
        case 'classesinnerpage':
            // add a customized third level of CSS classes like specific parameters for specific modules
            /*
            switch ($view->getToplevelmodule()) {
                case 'Pages':
                    switch ($view->getFunc()) {
                        case 'display':
                            // Example: add the current pageid in a CSS class (bt-pageid-PID)
                            // note: this only works when using normal urls, shortURLs uses the title field
                            $output .= ' bt-pageid-'.FormUtil::getPassedValue('pageid');
                            break;
                    }
                    break;
                case 'Content':
                    switch ($view->getFunc()) {
                        case 'view':
                            // Example: add the current page category id in a CSS class (bt-contentcatpage-CID)
                            // works for normal and shortURLs
                            if (System::getVar('shorturls')) {
                                $urlname = $view->getRequest()->getGet()->get('name');
                                $pageId = ModUtil::apiFunc('Content', 'Page', 'solveURLPath', compact('urlname'));
                            } else {
                                $pageId = $view->getRequest()->getGet()->get('pid');
                            }
                            $page = ModUtil::apiFunc('Content', 'Page', 'getPage', array('id' => $pageId));
                            $output .= ' bt-contentcatpage-'.$page['categoryId'];
                    }
                    break;
            }
            */
            if (!isset($params['noempty']) || !$params['noempty']) {
                $output = !empty($output) ? $output : 'bt-empty';
            }
            break;
    }

    return $output;
}
