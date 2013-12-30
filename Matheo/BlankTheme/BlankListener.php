<?php
/**
 * Zikula Application Framework
 *
 * @copyright Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   MIT - http://www.opensource.org/licenses/mit-license.html
 */

namespace Matheo\BlankTheme;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula_View_Theme;
use \ServiceUtil;
use \PageUtil;

class BlankListener implements EventSubscriberInterface
{
    public function themePrefetch()
    {
        $theme = Zikula_View_Theme::getInstance();

        // load the Theme styles in the very end of the page rendering
        // TODO pending review with PageUtil weight assignment (when implemented)
        PageUtil::addVar('stylesheet', $theme->getStylepath().'/style.css');

        // check custom example requests
        $req = ServiceUtil::get('request');
        $uri = str_replace($req->getBaseUrl(), '', $req->getRequestUri());

        if (in_array($uri, array('?btexample', '?btcover'))) {
            $theme->themeconfig['variables']['body'] = substr($uri, 3); // removes ?bt

            $theme->assign($theme->themeconfig['variables']);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            'theme.prefetch' => array('themePrefetch')
        );
    }
}
