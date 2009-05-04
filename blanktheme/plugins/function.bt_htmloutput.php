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
 * Smarty function to centralize important html outputs
 *
 * Example
 * <!--[bt_htmloutput section='head']-->
 *
 * @author       Mateo Tibaquira
 * @since        05/07/08
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$smarty     Reference to the Smarty object
 * @param        string      $section     Output section to return
 * @return       string      the results of the module function
 */
function smarty_function_bt_htmloutput($params, &$smarty)
{
    // variables to use
    // parameters
    $section = $params['section'];
    unset($params);
    // blanktheme vars
    $body      = $smarty->_tpl_vars['body'];
    $layout    = $smarty->_tpl_vars['layout'];
    $usefontr  = $smarty->_tpl_vars['usefontresize'];
    // check for the current variable
    $current   = (isset($smarty->_tpl_vars['current'])) ? $smarty->_tpl_vars['current'] : $smarty->toplevelmodule;

    // assign the respective output
    $output    = '';
    switch ($section)
    {
        case 'fontresize':
            if ($usefontr == 'y') {
            // font resize based in the efa script
            //PageUtil::addVar('javascript', $smarty->scriptpath.'/efa/efa_fontsize_packed.js');
            PageUtil::addVar('javascript', $smarty->scriptpath.'/efa/efa_fontsize.js');
            $output = '<script type="text/javascript">
                         // <![CDATA[
                         if (efa_fontSize) {
                           var efalang_zoomIn = "'.pnML('_AB_FONT_ZOOMIN').'";
                           var efalang_zoomReset = "'.pnML('_AB_FONT_ZOOMRESET').'";
                           var efalang_zoomOut = "'.pnML('_AB_FONT_ZOOMOUT').'";
                           var efathemedir = "'.$smarty->directory.'";
                           efa_fontSize.efaInit();
                           document.write(efa_fontSize.allLinks);
                         }
                         // ]]>
                       </script>
                       ';
            }
            break;

        case 'head':
            // head stylesheets
            $output = '<link rel="stylesheet" href="'.$smarty->stylepath.'/layout_'.$body.'.css" type="text/css"/>
                       <!--[if lte IE 7]>'
                     .'<link rel="stylesheet" href="'.$smarty->stylepath.'/patches/patch_'.$body.'.css" type="text/css" />'
//                     .'<link rel="stylesheet" href="'.$smarty->themepath.'/yaml/core/slim_iehacks.css" type="text/css" />'
                     .'<![endif]-->';
/*                       .'<!--[if lte IE 6]>'
//                     .'<script type="text/javascript" src="'.$smarty->scriptpath.'/minmax.js"></script>'
                     .'<style type="text/css">
                           img, div, a, input { behavior: url('.$smarty->stylepath.'/patches/iepngfix.htc) }
                       </style>' 
//                     .'<script type="text/javascript" src="'.$smarty->scriptpath.'/iepngfix_tilebg.js"></script>'
                     .'<![endif]-->
                       ';
*/
            // Add content in the final if needed
            if (isset($smarty->_tpl_vars['additionalhead'])) {
                $output .= $smarty->_tpl_vars['additionalhead'];
            }
            break;

        /* First CSS level */
        case 'classesbody':
            // add a first level of CSS classes like current language, type parameter and body template in use with a 'bt_' prefix
            if (!empty($current)) {
                $output .= 'bt_'.$current.' ';
            }
            $output .= 'bt_'.$body.' bt_type_'.$smarty->type.' bt_lang_'.$smarty->language;
            break;

        /* Second CSS level */
        case 'classespage':
            // add a second level of CSS classes
            // add the current layout and enabled zones
            $output .= 'bt_'.str_replace('_', ' bt_', $layout);
            // add the current function name
            $output .= ' bt_func_'.$smarty->func;
            break;

        /* Third CSS level */
        case 'classesinnerpage':
            // add a customized third level of CSS classes like specific parameters for specific modules
            /*
            switch ($smarty->toplevelmodule) {
                case 'Pages':
                    switch ($smarty->func) {
                        case 'display':
                            // Example: add the current pageid in a class
                            // note: this only works when using normal urls, shortURLs uses the title field
                            $output .= ' bt_pageid_'.FormUtil::getPassedValue('pageid');
                            break;
                    }
                    break;
            }
            */
            break;
    }

    return $output;
}
