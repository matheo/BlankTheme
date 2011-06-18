<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Smarty function to centralize important html outputs
 *
 * Example
 * {bt_htmloutput section='head'}
 * {bt_htmloutput section='topnavlinks'}
 *
 * @author       Mateo Tibaquirá
 * @since        05/07/08
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$view     Reference to the Smarty object
 * @param        string      $section     Output section to return
 * @return       string      the results of the module function
 */
function smarty_function_bt_htmloutput($params, Zikula_View_Theme &$view)
{
    // variables to use
    // parameters
    if (!isset($params['section']) || empty($params['section'])) {
        return '';
    }

    $dom = ZLanguage::getThemeDomain('BlankTheme');

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

    // assign the respective output
    $output = '';
    switch ($params['section'])
    {
        case 'topnavlinks':
            // build the menu list
            // Option: id, lang string, link
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
            // Render the menu as an unordered list inside a div
            $count   = count($menu) - 1;
            $output  = '<div id="bt_topnavlinks"><ul>';
            foreach ($menu as $k => $option) {
                $class = '';
                if (count($menu) == 1) {
                    $class = 'unique';
                } elseif ($k == 0) {
                    $class = 'first';
                } elseif ($k == $count) {
                    $class = 'last';
                }
                $output .= '<li '.($class ? ' class="bt_'.$class.'"' : '').'>';
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
            if ($btconfig['fontresize'] != 'y') {
                break;
            }
            // font resize based in the efa script
            PageUtil::addVar('javascript', $view->getScriptpath().'/efa/efa_fontsize_packed.js');
            //PageUtil::addVar('javascript', $view->getScriptpath().'/efa/efa_fontsize.js');
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
                      .'<link rel="stylesheet" href="'.$view->getStylepath().'/patch_'.$body.'.css" type="text/css" />'
//                    .'<link rel="stylesheet" href="'.$view->getThemepath().'/yaml/core/slim_iehacks.css" type="text/css" />'
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
            if ($btconfig['optimize'] == 'y') {
                // do not load the layout_* stylesheet and load the basic styles directly
                PageUtil::addVar('stylesheet', $view->getThemepath().'/yaml/core/slim_base.css');
                PageUtil::addVar('stylesheet', $view->getStylepath().'/basemod.css');
                PageUtil::addVar('stylesheet', $view->getStylepath().'/content.css');
                // TODO rtl-support load yaml/add-ons/rtl-support/core/base-rtl.css with the respective basemod-rtl.css and content-rtl.css
            } else {
                PageUtil::addVar('stylesheet', $view->getStylepath()."/layout_{$body}.css");
            }
            break;

        /* First CSS level */
        case 'classesbody':
            // add a first level of CSS classes like current language, type parameter and body template in use with a 'bt_' prefix
            if (!empty($current)) {
                $output .= 'bt_'.$current.' ';
            }
            if ($btcssbody && isset($btcssbody[$body]) && $btcssbody[$body]) {
                $output .= $btcssbody[$body].' ';
            }
            $output .= 'bt_'.$body.' bt_type_'.$view->getType().' bt_lang_'.$view->getLanguage();
            break;

        /* Second CSS level */
        case 'classespage':
            // add a second level of CSS classes
            // add the current layout and enabled zones
            $output .= 'bt_'.str_replace('_', ' bt_', $layout);
            // add the current function name
            $output .= ' bt_func_'.$view->getFunc();
            break;

        /* Third CSS level */
        case 'classesinnerpage':
            // add a customized third level of CSS classes like specific parameters for specific modules
            /*
            switch ($view->getToplevelmodule()) {
                case 'Pages':
                    switch ($view->getFunc()) {
                        case 'display':
                            // Example: add the current pageid in a CSS class (bt_pageid_PID)
                            // note: this only works when using normal urls, shortURLs uses the title field
                            $output .= ' bt_pageid_'.FormUtil::getPassedValue('pageid');
                            break;
                    }
                    break;
                case 'Content':
                    switch ($view->getFunc()) {
                        case 'view':
                            // Example: add the current page category id in a CSS class (bt_contentcatpage_CID)
                            // works for normal and shortURLs
                            if (System::getVar('shorturls')) {
                                $urlname = $view->getRequest()->getGet()->get('name');
                                $pageId = ModUtil::apiFunc('Content', 'Page', 'solveURLPath', compact('urlname'));
                            } else {
                                $pageId = $view->getRequest()->getGet()->get('pid');
                            }
                            $page = ModUtil::apiFunc('Content', 'Page', 'getPage', array('id' => $pageId));
                            $output .= ' bt_contentcatpage_'.$page['categoryId'];
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
