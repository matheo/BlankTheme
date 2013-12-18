<?php
/**
 * Zikula Application Framework
 *
 * @copyright Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   MIT - http://www.opensource.org/licenses/mit-license.html
 * @abstract  BlankTheme bundle definition with the strings to translate
 */

namespace Matheo\BlankTheme;

use Zikula\Bundle\CoreBundle\Bundle\AbstractTheme;

class MatheoBlankTheme extends AbstractTheme
{
    public function translationStrings()
    {
        /* themevariables.ini gettext strings */
        no__('yes');
        no__('no');

        no__('Master body template');
        no__('2 columns');
        no__('3 columns');
        no__('3 columns static');
        no__('grid');
        no__('full width');

        no__('Master layout');

        no__("Enable 'header' block position?");

        no__('User menu to use');
        no__('bt_userlinks plugin');
        no__("'topnav' block position");

        no__('Bottom navigation to use');
        no__('footer HTML links');
        no__("'bottomnav' block position");

        no__("Enable 'footer' block position?");

        no__('Enable font resize buttons');

        no__('Use the layout_X.css');
    }
}
