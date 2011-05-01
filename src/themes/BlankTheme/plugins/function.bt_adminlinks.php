<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * Smarty function to display the admin navigation menu
 *
 * Example
 * {bt_adminlinks id='myId' ulclass='myUlClass' current='home' currentclass='myActiveClass'}
 *
 * @author       Mateo Tibaquirá [mateo]
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

    $dom = ZLanguage::getThemeDomain('BlankTheme');

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_sublinks */
    $menu = array();

    /* Homepage link */
    $menu[] = array('home', __('Home', $dom), System::getHomepageURL());

    if (SecurityUtil::checkPermission('Admin::', '::', ACCESS_EDIT))
    {
        /* Config menu */
        $linkoptions = array(
                             array(null, __('Site settings', $dom),  ModUtil::url('Settings', 'admin'),
                                 array(
                                     array(null, __('Localization', $dom),  ModUtil::url('Settings', 'admin', 'multilingual')),
                                     array(null, __('HTML settings', $dom), ModUtil::url('SecurityCenter', 'admin', 'allowedhtml'))
                                 )
                             ),
                             array(null, __('Permissions', $dom),    ModUtil::url('Permissions', 'admin')),
                             array(null, __('Categories', $dom),     ModUtil::url('Categories', 'admin'),
                                 array(
                                     array(null, __('Category registry', $dom), ModUtil::url('Categories', 'admin', 'editregistry')),
                                     array(null, __('New category', $dom),      ModUtil::url('Categories', 'admin', 'new'))
                                 )
                             ),
                             array(null, __('Admin panel', $dom),    ModUtil::url('Admin', 'admin')),
                             array(null, __('System mailer', $dom),  ModUtil::url('Mailer', 'admin')),
                             array(null, __('Search options', $dom), ModUtil::url('Search', 'admin')),
                       );
        if (ModUtil::available('legal')) {
            $linkoptions[] = array(null, __('Legal settings', $dom), ModUtil::url('legal', 'admin'));
        }
        if (ModUtil::available('scribite')) {
            $linkoptions[] = array(null, __('WYSIWYG editors', $dom), ModUtil::url('scribite', 'admin'));
        }
        if (ModUtil::available('Thumbnail')) {
            $linkoptions[] = array(null, __('Thumbnails', $dom), ModUtil::url('Thumbnail', 'admin'));
        }

        $menu[] = array('config', __('Config', $dom),  '#', $linkoptions);


        /* System menu */
        /* Search for installed hooks*/
        $linkoptions = array();

        if (ModUtil::available('EZComments')) {
            $linkoptions[] = array(null, __('Comments', $dom),  ModUtil::url('EZComments', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('MultiHook')) {
            $linkoptions[] = array(null, __('MultiHook', $dom), ModUtil::url('MultiHook', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('bbcode')) {
            $linkoptions[] = array(null, __('BBCode', $dom),    ModUtil::url('bbcode', 'admin', 'config'));
        }
        if (ModUtil::available('bbsmile')) {
            $linkoptions[] = array(null, __('Smilies', $dom),   ModUtil::url('bbsmile', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('Ratings')) {
            $linkoptions[] = array(null, __('Ratings', $dom),   ModUtil::url('Ratings', 'admin', 'modifyconfig'));
        }
        if (empty($linkoptions)) {
            $linkoptions[] = array(null, __('No hooks installed', $dom), '#');
        }

        $menu[] = array('system', __('System', $dom), '#',
                    array(
                        array(null, __('Modules', $dom),              ModUtil::url('Modules', 'admin'),
                            array(
                                array(null, __('System hooks', $dom), ModUtil::url('Modules', 'admin', 'hooks', array('id' => 0)))
                            )
                        ),
                        array(null, __('Hooks', $dom), '#',
                            $linkoptions
                        ),
                        array(null, __('Blocks', $dom),             ModUtil::url('Blocks', 'admin')),
                        array(null, __('Themes', $dom),             ModUtil::url('Theme', 'admin')),
                        array(null, __('Security center', $dom),    ModUtil::url('SecurityCenter', 'admin', 'modifyconfig'),
                            array(
                                array(null, __('Registered attacks', $dom), ModUtil::url('SecurityCenter', 'admin'))
                            )
                        ),
                        array(null, __('System information', $dom), ModUtil::url('SysInfo', 'admin'))
                    )
                );


        /* Users/Groups menu */
        // build the Users management submenu options
        $subusr   = array();
        $subusr[] = array(null, __('Users settings', $dom), ModUtil::url('Users', 'admin', 'modifyconfig'));

        $profileModule = System::getVar('profilemodule', '');
        if (!empty($profileModule) && ModUtil::available($profileModule)) {
            $subusr[] = array(null, __('Account properties', $dom), ModUtil::url($profileModule, 'admin', 'view'));
        }

        $menu[] = array('users', __('Users', $dom), '#',
                    array(
                        array(null, __('Manage groups', $dom), ModUtil::url('Groups', 'admin'),
                            array(
                                array(null, __('Groups settings', $dom), ModUtil::url('Groups', 'admin', 'modifyconfig'))
                            )
                        ),
                        array(null, __('Manage users', $dom), ModUtil::url('Users', 'admin'),
                            $subusr
                        ),
                        array(null, __('Create user', $dom), ModUtil::url('Users', 'admin', 'new')),
                        array(null, __('Find and e-mail users', $dom), ModUtil::url('Users', 'admin', 'search'))
                    )
                );


        /* Common Routines links */
        $authidthm = SecurityUtil::generateAuthKey('Theme');
        $linkoptions = array(
                           array(null, __('Template engine', $dom), '#',
                               array(
                                   array(null, __('Clear compiled templates', $dom), ModUtil::url('Theme', 'admin', 'render_clear_compiled', array('authid' => $authidthm))),
                                   array(null, __('Clear cache', $dom),              ModUtil::url('Theme', 'admin', 'render_clear_cache', array('authid' => $authidthm)))
                               )
                           ),
                           array(null, __('Theme engine', $dom), ModUtil::url('Theme', 'admin', 'modifyconfig'),
                               array(
                                   array(null, __('Clear compiled templates', $dom), ModUtil::url('Theme', 'admin', 'clear_compiled', array('authid' => $authidthm))),
                                   array(null, __('Clear cache', $dom),              ModUtil::url('Theme', 'admin', 'clear_cache', array('authid' => $authidthm)))
                               )
                           ),
                           array(null, __('Filesystem check', $dom),       ModUtil::url('SysInfo', 'admin', 'filesystem')),
                           array(null, __('Temporary folder check', $dom), ModUtil::url('SysInfo', 'admin', 'ztemp'))
                       );

        $menu[] = array('routines', __('Routines', $dom), '#', $linkoptions);


    } /* Permission Admin:: | :: | ACCESS_EDIT ends here */

    /* Create content menu */
    $linkoptions = array();

    // Content Modules
    if (ModUtil::available('News') && (SecurityUtil::checkPermission('News::', '::', ACCESS_EDIT) || SecurityUtil::checkPermission('Stories::Story', '::', ACCESS_EDIT))) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('News', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('News', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add an article', $dom), ModUtil::url('News', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('Pages') && SecurityUtil::checkPermission('Pages::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('Pages', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('Pages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a page', $dom), ModUtil::url('Pages', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('Content') && SecurityUtil::checkPermission('Content::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Settings', $dom), ModUtil::url('Content', 'admin', 'settings'))
                      );
        $linkoptions[] = array(null, __('Edit contents', $dom), ModUtil::url('Content', 'edit'), $suboptions);
    }

    // Downloads modules
    if (ModUtil::available('MediaAttach') && SecurityUtil::checkPermission('MediaAttach::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('MediaAttach', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('MediaAttach', 'admin'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), ModUtil::url('MediaAttach', 'admin', 'view', array(), null, 'myuploadform_switch'), $suboptions);
    }
    if (ModUtil::available('Downloads') && SecurityUtil::checkPermission('Downloads::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Add category', $dom), ModUtil::url('Downloads', 'admin', 'category_menu')),
                         array(null, __('Settings', $dom),     ModUtil::url('Downloads', 'admin'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), ModUtil::url('Downloads', 'admin', 'newdownload'), $suboptions);
    }

    // Community modules
    if (ModUtil::available('Polls') && SecurityUtil::checkPermission('Olls::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('Polls', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('Polls', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a poll', $dom), ModUtil::url('Polls', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('FAQ') && SecurityUtil::checkPermission('FAQ::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('FAQ', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('FAQ', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a FAQ', $dom), ModUtil::url('FAQ', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('Feeds') && SecurityUtil::checkPermission('Feeds::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('Feeds', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('Feeds', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a feed', $dom), ModUtil::url('Feeds', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('Reviews') && SecurityUtil::checkPermission('Reviews::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('Reviews', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('Reviews', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a review', $dom), ModUtil::url('Reviews', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('Web_Links') && SecurityUtil::checkPermission('Web_Links::', '::', ACCESS_EDIT)) {
        $linkoptions[] = array(null, __('Add a web link', $dom), ModUtil::url('Web_Links', 'admin', 'main', array('op' => 'LinksAddLink')));
    }

    // Calendar modules
    if (ModUtil::available('EventLiner') && SecurityUtil::checkPermission('EventLiner::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('EventLiner', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('EventLiner', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), ModUtil::url('EventLiner', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('TimeIt') && SecurityUtil::checkPermission('TimeIt::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Settings', $dom), ModUtil::url('TimeIt', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), ModUtil::url('TimeIt', 'admin', 'new'), $suboptions);
    }
    if (ModUtil::available('crpCalendar') && SecurityUtil::checkPermission('crpCalendar::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('crpCalendar', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('crpCalendar', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add a calendar event', $dom), ModUtil::url('crpCalendar', 'admin', 'new'), $suboptions);
    }

    // Legacy modules
    if (ModUtil::available('Admin_Messages') && SecurityUtil::checkPermission('Admin_Messages::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('Admin_Messages', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('Admin_Messages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add an admin message', $dom), ModUtil::url('Admin_Messages', 'admin', 'new'), $suboptions);
    }

    $menu[] = array('content', __('Create content', $dom), '#', $linkoptions);

    /* Logout link */
    $menu[] = array('logout', __('Log out', $dom), ModUtil::url('Users', 'user', 'logout'));


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
