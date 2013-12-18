<?php
/**
 * Zikula Application Framework
 *
 * @copyright Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   MIT - http://www.opensource.org/licenses/mit-license.html
 */

namespace Matheo\Theme\BlankTheme;

class BlankThemeVersion extends \Zikula_AbstractThemeVersion
{
    public function getMetaData()
    {
        $meta = array(
            'displayname' => $this->__('BlankTheme'),
            'description' => $this->__("Theme development framework for Zikula."),
            'version'     => '1.3.7',
            'admin'       => 1,
            'user'        => 1,
            'system'      => 0,
        );

        return $meta;
    }
}
