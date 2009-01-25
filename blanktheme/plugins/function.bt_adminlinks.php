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

    /*** Build the menu-array ***/
    /* Option format: id, lang_constant, link, array_sublinks */
    $menu = array();

    if (SecurityUtil::checkPermission('Admin::', '::', ACCESS_EDIT)) {

    /* Homepage link */
    $menu[] = array('home',   _NAV_HOME,   pnGetBaseURL());


    /* Config options */
    $linkoptions = array(
                         array(null, _NAV_SETTINGS,      pnModURL('Settings', 'admin')),
                         array(null, _NAV_PERMISSIONS,   pnModURL('Permissions', 'admin')),
                         array(null, _NAV_CATEGORIES,    pnModURL('Categories', 'admin')),
                         array(null, _NAV_MAILER,        pnModURL('Mailer', 'admin')),
                         array(null, _NAV_SEARCHOPTIONS, pnModURL('Search', 'admin')),
                   );
    if (pnModAvailable('legal')) {
        $linkoptions[] = array(null, _NAV_LEGAL, pnModURL('legal', 'admin'));
    }
    if (pnModAvailable('scribite')) {
        $linkoptions[] = array(null, _NAV_WYSIWYG, pnModURL('scribite', 'admin'));
    }
    if (pnModAvailable('EZComments')) {
        $linkoptions[] = array(null, _NAV_COMMENTS, pnModURL('EZComments', 'admin'));
    }

    $menu[] = array('config', _NAV_CONFIG,  '#', $linkoptions);


    /* System link */
    $menu[] = array('system', _NAV_SYSTEM, '#',
                array(
                    array(null, _NAV_MODULES,         pnModURL('Modules', 'admin')),
                    array(null, _NAV_BLOCKS,          pnModURL('Blocks', 'admin')),
                    array(null, _NAV_RENDER,          pnModURL('pnRender', 'admin')),
                    array(null, _NAV_THEME,           pnModURL('Theme', 'admin')),
                    array(null, _NAV_SECURITYCENTER,  pnModURL('SecurityCenter', 'admin')),
                    array(null, _NAV_SYSINFO,         pnModURL('SysInfo', 'admin'))
                )
            );


    /* Users/Groups link */
    $menu[] = array('users', _NAV_USERS, '#',
                array(
                    array(null, _NAV_ADMINGROUPS,  pnModURL('Groups', 'admin'),
                        array(
                            array(null, _NAV_GROUPSETTINGS,  pnModURL('Groups', 'admin', 'modifyconfig'))
                        )
                    ),
                    array(null, _NAV_ADMINUSERS,   pnModURL('Users', 'admin'),
                        array(
                            array(null, _NAV_USERSMANAGER,     pnModURL('Users', 'admin', 'modifyconfig')),
                            array(null, _NAV_USERSPROPERTIES,  pnModURL('Profile', 'admin', 'view'))
                        )
                    ),
                    array(null, _NAV_SEARCHUSERS,  pnModURL('Users', 'admin', 'search')),
                    array(null, _NAV_CREATEUSER,  pnModURL('Users', 'admin', 'new'))
                )
            );


    /* Common Routines links */
    $authidpnr = SecurityUtil::generateAuthKey('pnRender');
    $authidthm = SecurityUtil::generateAuthKey('Theme');
    $linkoptions = array(
                       array(null, _NAV_RENDER,   pnModURL('pnRender', 'admin'),
                           array(
                               array(null, _NAV_CLEARCOMPILEDTEMPLATES, pnModURL('pnRender', 'admin', 'clear_compiled', array('authid' => $authidpnr))),
                               array(null, _NAV_CLEARPNRENDERCACHE, pnModURL('pnRender', 'admin', 'clear_cache', array('authid' => $authidpnr)))
                           )
                       ),
                       array(null, _NAV_THEME,    pnModURL('Theme', 'admin'),
                           array(
                               array(null, _NAV_CLEARCOMPILEDTEMPLATES, pnModURL('Theme', 'admin', 'clear_compiled', array('authid' => $authidthm))),
                               array(null, _NAV_CLEARTHEMECACHE, pnModURL('Theme', 'admin', 'clear_cache', array('authid' => $authidthm)))
                           )
                       ),
                       array(null, _NAV_FILESYSTEMCHECK, pnModURL('SysInfo', 'admin', 'filesystem')),
                       array(null, _NAV_PNTEMPCHECK, pnModURL('SysInfo', 'admin', 'pntemp'))
                   );
    
    if (pnModAvailable('MailUsers')) {
        $linkoptions[] = array(null, _NAV_MAILUSERS, pnModURL('MailUsers', 'admin'));
    }
    
    $menu[] = array('routines', _NAV_ROUTINES, '#', $linkoptions);


    /* Create Content links */
    $linkoptions = array();

    // Content Modules
    if (pnModAvailable('News')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('News', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('News', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDARTICLE,  pnModURL('News', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Pages')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,     pnModURL('Pages', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,     pnModURL('Pages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDPAGE,     pnModURL('Pages', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Content')) {
        $suboptions = array(
                         array(null, _MODIFYCONFIG,    pnModURL('Content', 'admin', 'settings'))
                      );
        $linkoptions[] = array(null, _NAV_ADDCONTENT,  pnModURL('Content', 'edit'), $suboptions);
    }

    // Downloads modules
    if (pnModAvailable('MediaAttach')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('MediaAttach', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('MediaAttach', 'admin'))
                      );
        $linkoptions[] = array(null, _NAV_ADDDOWNLOAD, pnModURL('MediaAttach', 'admin', 'view', array(), null, 'myuploadform_switch'), $suboptions);
    }
    if (pnModAvailable('Downloads')) {
        $suboptions = array(
                         array(null, _AB_ADDCATEGORY,  pnModURL('Downloads', 'admin', 'category_menu')),
                         array(null, _MODIFYCONFIG,    pnModURL('Downloads', 'admin'))
                      );
        $linkoptions[] = array(null, _NAV_ADDDOWNLOAD, pnModURL('Downloads', 'admin', 'newdownload'), $suboptions);
    }

    // Community modules
    if (pnModAvailable('Polls')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('Polls', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('Polls', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDPOLL,     pnModURL('Polls', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('FAQ')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('FAQ', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('FAQ', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDFAQ,      pnModURL('FAQ', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Feeds')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('Feeds', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('Feeds', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDFEED,     pnModURL('Feeds', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Reviews')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('Reviews', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('Reviews', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDREVIEW,   pnModURL('Reviews', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('Web_Links')) {
        $linkoptions[] = array(null, _NAV_ADDWEBLINK,  pnModURL('Web_Links', 'admin', 'main', array('op' => 'LinksAddLink')));
    }

    // Calendar modules
    if (pnModAvailable('EventLiner')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('EventLiner', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('EventLiner', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDEVENT,    pnModURL('EventLiner', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('TimeIt')) {
        $suboptions = array(
                         array(null, _MODIFYCONFIG,    pnModURL('TimeIt', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDEVENT,    pnModURL('TimeIt', 'admin', 'new'), $suboptions);
    }
    if (pnModAvailable('crpCalendar')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('crpCalendar', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('crpCalendar', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDEVENT,    pnModURL('crpCalendar', 'admin', 'new'), $suboptions);
    }

    // Legacy modules
    if (pnModAvailable('Topics')) {
        $linkoptions[] = array(null, _NAV_ADMINTOPICS, pnModURL('Topics', 'admin'));
    }
    if (pnModAvailable('Admin_Messages')) {
        $suboptions = array(
                         array(null, _AB_ADMINLIST,    pnModURL('Admin_Messages', 'admin', 'view')),
                         array(null, _MODIFYCONFIG,    pnModURL('Admin_Messages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, _NAV_ADDADMINMESSAGE,  pnModURL('Admin_Messages', 'admin', 'new'), $suboptions);
    }

    $menu[] = array('content', _NAV_CONTENT, '#', $linkoptions);

    /* Logout link */
    $menu[] = array('logout', _NAV_LOGOUT, pnModURL('Users', 'user', 'logout'));

    }

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
        $return .= ' title="'.DataUtil::formatForDisplay($option[1]).'" href="'.pnVarPrepForDisplay($option[2]).'">';
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
