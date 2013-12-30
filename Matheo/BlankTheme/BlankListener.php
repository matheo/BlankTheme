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

class BlankListener implements EventSubscriberInterface
{
    public function checkExamples()
    {
        $req = ServiceUtil::get('request');
        $uri = str_replace($req->getBaseUrl(), '', $req->getRequestUri());

        if (in_array($uri, array('?btexample', '?btcover'))) {
            $theme = Zikula_View_Theme::getInstance();

            $theme->themeconfig['variables']['body'] = substr($uri, 3); // removes ?bt

            $theme->assign($theme->themeconfig['variables']);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            'theme.prefetch' => array('checkExamples')
        );
    }
}
