<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   MIT - http://www.opensource.org/licenses/mit-license.html
 */

/**
 * BlankTheme plugin to add a css class according the device and its os.
 *
 * Available parameters:
 *  - mov (bool) Check for mobile devices (default: true)
 *  - tab (bool) Check for tablet devices (default: false)
 *  - os  (bool) Check for operative system (default: false)
 *
 * Example:
 *  {blankmobile tab=true}
 *
 * @author Mateo Tibaquirá
 * @since  27/12/13
 *
 * @param array             $params All parameters passed to this function from the template.
 * @param Zikula_View_Theme &$view  Reference to the View_Theme object.
 *
 * @return string Mobile classes.
 */
function smarty_function_blankmobile($params, Zikula_View_Theme &$view)
{
    $mov = isset($params['mov']) ? (bool)$params['mov'] : true;
    $tab = isset($params['tab']) ? (bool)$params['tab'] : false;
    $os  = isset($params['os'])  ? (bool)$params['os']  : false;

    /*** Detection ***/
    $detect = new Mobile_Detect;

    $css = array();

    if ($detect->isMobile()) {
        if ($mov) {
            $css[] = 'is-mobile';
        }

        if ($tab) {
            $css[] = $detect->isTablet() ? 'is-tablet' : 'is-phone';
        }

        if ($os) {
            if ($detect->isiOS()) {
                $css[] = 'is-ios';
            }

            if ($detect->isAndroidOS()) {
                $css[] = 'is-android';
            }
        }
    }

    return $css ? ' '.implode(' ', $css) : '';
}
