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
 * Smarty function to display the admin navigation menu
 *
 * Example
 * <!--[bt_adminlinks id='myId' ulclass='myUlClass' current='home' currentclass='myActiveClass']-->
 *
 * @author       Mateo Tibaquira [mateo]
 * @author       Erik Spaan [espaan]
 * @since        08/11/2007
 * @param        array       $params       All attributes passed to this function from the template
 * @param        object      &$smarty      Reference to the Smarty object
 * @param        string      $id           CSS surrounding div id, default = 'nav_admin'
 * @param        string      $ulclass      UL class, default = 'cssplay_prodrop'
 * @param        string      $current      the current tab (i.e. home, account, news, forum)
 * @param        string      $currentclass CSS class for the current link, default = 'selected'
 * @return       string      the results of the module function
 */
function smarty_function_bt_adminlinks($params, &$smarty)
{
    extract($params);
    unset($params);

    if (!isset($id)) {
        $id = 'nav_admin';
    }
    if (!isset($ulclass)) {
        $ulclass = 'cssplay_prodrop';
    }
    if (!isset($current)) {
        $current = '';
    }
    if (!isset($currentclass)) {
        $currentclass = 'selected';
    }

    $dom = ZLanguage::getThemeDomain('blanktheme');

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_sublinks */
    $menu = array();

    /* Homepage link */
    $menu[] = array('home',   __('Home', $dom),   pnGetHomepageURL());

    if (SecurityUtil::checkPermission('Admin::', '::', ACCESS_EDIT))
    {
        /* Config options */
        $linkoptions = array(
                             array(null, __('Settings', $dom),       pnModURL('Settings', 'admin')),
                             array(null, __('Permissions', $dom),    pnModURL('Permissions', 'admin')),
                             array(null, __('Categories', $dom),     pnModURL('Categories', 'admin')),
                             array(null, __('System mailer', $dom),  pnModURL('Mailer', 'admin')),
                             array(null, __('Search options', $dom), pnModURL('Search', 'admin')),
                       );
        if (pnModAvailable('legal')) {
            $linkoptions[] = array(null, __('Legal settings', $dom), pnModURL('legal', 'admin'));
        }
        if (pnModAvailable('scribite')) {
            $linkoptions[] = array(null, __('WYSIWYG editors', $dom), pnModURL('scribite', 'admin'));
        }
        if (pnModAvailable('EZComments')) {
            $linkoptions[] = array(null, __('Comments options', $dom), pnModURL('EZComments', 'admin'));
        }

        $menu[] = array('config', __('Config', $dom),  '#', $linkoptions);


        /* System link */
        $menu[] = array('system', __('System', $dom), '#',
                    array(
                        array(null, __('Modules', $dom),            pnModURL('Modules', 'admin')),
                        array(null, __('Blocks', $dom),             pnModURL('Blocks', 'admin')),
                        array(null, __('Template engine', $dom),    pnModURL('pnRender', 'admin')),
                        array(null, __('Theme engine', $dom),       pnModURL('Theme', 'admin')),
                        array(null, __('Security center', $dom),    pnModURL('SecurityCenter', 'admin')),
                        array(null, __('System information', $dom), pnModURL('SysInfo', 'admin'))
                    )
                );


        /* Users/Groups link */
        // build the Users management submenu options
        $subusr   = array();
        $subusr[] = array(null, __('Users settings', $dom), pnModURL('Users', 'admin', 'modifyconfig'));

        $profileModule = pnConfigGetVar('profilemodule', '');
        if (!empty($profileModule) && pnModAvailable($profileModule)) {
            $subusr[] = array(null, __('Account properties', $dom),     pnModURL($profileModule, 'admin', 'view'));
        }

        $menu[] = array('users', __('Users', $dom), '#',
                    array(
                        array(null, __('Manage groups', $dom), pnModURL('Groups', 'admin'),
                            array(
                                array(null, __('Groups settings', $dom), pnModURL('Groups', 'admin', 'modifyconfig'))
                            )
                        ),
                        array(null, __('Manage users', $dom), pnModURL('Users', 'admin'),
                            $subusr
                        ),
                        array(null, __('Search users', $dom), pnModURL('Users', 'admin', 'search')),
                        array(null, __('Create user', $dom),  pnModURL('Users', 'admin', 'new'))
                    )
                );


        /* Common Routines links */
        $authidpnr = SecurityUtil::generateAuthKey('pnRender');
        $authidthm = SecurityUtil::generateAuthKey('Theme');
        $linkoptions = array(
                           array(null, __('Template engine', $dom), pnModURL('pnRender', 'admin'),
                               array(
                                   array(null, __('Clear compiled templates', $dom), pnModURL('pnRender', 'admin', 'clear_compiled', array('authid' => $authidpnr))),
                                   array(null, __('Clear pnRender cache', $dom),     pnModURL('pnRender', 'admin', 'clear_cache', array('authid' => $authidpnr)))
                               )
                           ),
                           array(null, __('Theme engine', $dom), pnModURL('Theme', 'admin'),
                               array(
                                   array(null, __('Clear compiled templates', $dom), pnModURL('Theme', 'admin', 'clear_compiled', array('authid' => $authidthm))),
                                   array(null, __('Clear Theme cache', $dom), pnModURL('Theme', 'admin', 'clear_cache', array('authid' => $authidthm)))
                               )
                           ),
                           array(null, __('Filesystem check', $dom),    pnModURL('SysInfo', 'admin', 'filesystem')),
                           array(null, __('Temporary folder check', $dom), pnModURL('SysInfo', 'admin', 'pntemp'))
                       );

        if (pnModAvailable('MailUsers')) {
            $linkoptions[] = array(null, __('Mail users', $dom), pnModURL('MailUsers', 'admin'));
        }

        $menu[] = array('routines', __('Routines', $dom), '#', $linkoptions);


    } /* Permission Admin:: | :: | ACCESS_EDIT ends here */

    /* Create Content links */
    $linkoptions = array();

    // Content Modules
    if (pnModAvailable('News') && (SecurityUtil::checkPermission('News::', '::', ACCESS_EDIT) || SecurityUtil::checkPermission('Stories::Story', '::', ACCESS_EDIT))) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('News', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('News', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add an article', $dom), pnModURL('News', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Pages') && SecurityUtil::checkPermission('Pages::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('Pages', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('Pages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a page', $dom), pnModURL('Pages', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Content') && SecurityUtil::checkPermission('Content::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Settings', $dom), pnModURL('Content', 'admin', 'settings'))
                      );
        $linkoptions[] = array(null, __('Edit contents', $dom), pnModURL('Content', 'edit'), $suboptions);
    }

    // Downloads modules
    if (pnModAvailable('MediaAttach') && SecurityUtil::checkPermission('MediaAttach::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('MediaAttach', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('MediaAttach', 'admin'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), pnModURL('MediaAttach', 'admin', 'view', array(), null, 'myuploadform_switch'), $suboptions);
    }
    if (pnModAvailable('Downloads') && SecurityUtil::checkPermission('Downloads::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Add category', $dom), pnModURL('Downloads', 'admin', 'category_menu')),
                         array(null, __('Settings', $dom),     pnModURL('Downloads', 'admin'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), pnModURL('Downloads', 'admin', 'newdownload'), $suboptions);
    }

    // Community modules
    if (pnModAvailable('Polls') && SecurityUtil::checkPermission('Olls::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('Polls', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('Polls', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a poll', $dom), pnModURL('Polls', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('FAQ') && SecurityUtil::checkPermission('FAQ::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('FAQ', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('FAQ', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a FAQ', $dom),  pnModURL('FAQ', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Feeds') && SecurityUtil::checkPermission('Feeds::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('Feeds', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('Feeds', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a feed', $dom), pnModURL('Feeds', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Reviews') && SecurityUtil::checkPermission('Reviews::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('Reviews', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('Reviews', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a review', $dom), pnModURL('Reviews', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Web_Links') && SecurityUtil::checkPermission('Web_Links::', '::', ACCESS_EDIT)) {
        $linkoptions[] = array(null, __('Add a web link', $dom), pnModURL('Web_Links', 'admin', 'main', array('op' => 'LinksAddLink')));
    }

    // Calendar modules
    if (pnModAvailable('EventLiner') && SecurityUtil::checkPermission('EventLiner::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('EventLiner', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('EventLiner', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), pnModURL('EventLiner', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('TimeIt') && SecurityUtil::checkPermission('TimeIt::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Settings', $dom), pnModURL('TimeIt', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), pnModURL('TimeIt', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('crpCalendar') && SecurityUtil::checkPermission('crpCalendar::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('crpCalendar', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('crpCalendar', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), pnModURL('crpCalendar', 'admin', 'new'), $suboptions);
    }

    // Legacy modules
    if (pnModAvailable('Topics') && SecurityUtil::checkPermission('Topics::', '::', ACCESS_EDIT)) {
        $linkoptions[] = array(null, __('Manage topics', $dom), pnModURL('Topics', 'admin'));
    }
    if (pnModAvailable('Admin_Messages') && SecurityUtil::checkPermission('Admin_Messages::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), pnModURL('Admin_Messages', 'admin', 'view')),
                         array(null, __('Settings', $dom),   pnModURL('Admin_Messages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add an admin message', $dom), pnModURL('Admin_Messages', 'admin', 'new'), $suboptions);
    }

    $menu[] = array('content', __('Create content', $dom), '#', $linkoptions);

    /* Logout link */
    $menu[] = array('logout', __('Log out', $dom), pnModURL('Users', 'user', 'logout'));


    /* Actually create the menu based on the array above */
    $output  = '<div id="'.$id.'"><ul' . ((!empty($ulclass))?' class="'.$ulclass.'"':'') . '>';
    foreach ($menu as $option) {
        $output .= bt_adminlinks_drawmenu($option, $current, $currentclass);
    }
    $output .= '</ul></div>';

    return $output;
}

/**
 * Draw the array-menu recursively
 */
function bt_adminlinks_drawmenu($option, $current, $currentclass, $level=0)
{
    $return = '';

    if (is_array($option)) {
        $return .= '<li class="'.(($level==0)?'top':'').(($option[0]==$current)?' '.$currentclass:'').'">';
        $return .= '<a';
        if ($level == 0) {
            $return .= ' class="top_link"';
        } elseif (isset($option[3]) && is_array($option[3])) {
            $return .= ' class="fly"';
        }
        $return .= ' title="'.DataUtil::formatForDisplay($option[1]).'" href="'.DataUtil::formatForDisplay($option[2]).'">';
        $return .= (($level==0)?'<span>':'') . DataUtil::formatForDisplay($option[1]). (($level==0)?'</span>':'');
        /* Recursively render submenus */
        if (isset($option[3]) && is_array($option[3])) {
            if ($level == 0) {
                /* at 1st level add iframe for IE6 menu over form display */
                $return .= '<!--[if gte IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><iframe frameborder="0"></iframe><![endif]-->';
                $return .= '<ul class="drop">';
            } else {
                $return .= '<!--[if gte IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->';
                $return .= '<ul>';
            }
            foreach ($option[3] as $suboption) {
                $return .= bt_adminlinks_drawmenu($suboption, $current, $currentclass, $level+1);
            }
            $return .= '</ul>';
            $return .= '<!--[if lte IE 6]></td></tr></table></a><![endif]-->'; /* IE extras */
        } else {
            $return .= '</a>';
        }
        $return .= '</li>';
    }

    return $return;
}
