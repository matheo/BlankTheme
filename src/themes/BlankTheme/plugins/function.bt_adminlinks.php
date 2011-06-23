<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) BlankTheme Team
 * @link      http://www.blanktheme.org
 * @license   GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

/**
 * BlankTheme plugin to display the admin navigation menu.
 *
 * Available parameters:
 *  - id           (string) ID of wrapper div (default: 'nav_admin')
 *  - ulclass      (string) CSS class name of the UL (default: 'cssplay_prodrop')
 *  - current      (string) Current screen ID (optional)
 *  - currentclass (string) CSS class name of the current tab, list item (default: 'selected')
 *
 * Example:
 *  {bt_adminlinks id='myId' ulclass='myUlClass' current='config' currentclass='myActiveClass'}
 *
 * @author Mateo Tibaquirá [mateo]
 * @author Erik Spaan [espaan]
 * @since  08/11/2007
 *
 * @param array             $params All parameters passed to this function from the template.
 * @param Zikula_View_Theme &$view  Reference to the View_Theme object.
 *
 * @return string Admin menu output.
 */
function smarty_function_bt_adminlinks($params, Zikula_View_Theme &$view)
{
    $dom = ZLanguage::getThemeDomain('BlankTheme');

    $id      = isset($params['id']) ? $params['id'] : 'nav_admin';
    $ulclass = isset($params['ulclass']) ? $params['ulclass'] : 'cssplay_prodrop';
    $current = isset($params['current']) ? $params['current'] : '';
    $cclass  = isset($params['currentclass']) ? $params['currentclass'] : 'selected';

    /*** Build the menu-array ***/
    /* menu option: {id, translatable link text, link, array of sublinks} */
    $menu = array();

    /* Homepage link */
    $menu[] = array('home', __('Home', $dom), System::getHomepageURL());

    if (SecurityUtil::checkPermission('Admin::', '::', ACCESS_EDIT))
    {
        /* Config menu */
        // System basis
        $linkoptions = array(
                             array(null, __('Site settings', $dom),  ModUtil::url('Settings', 'admin', 'main'),
                                 array(
                                     array(null, __('Localization', $dom),  ModUtil::url('Settings', 'admin', 'multilingual')),
                                     array(null, __('HTML settings', $dom), ModUtil::url('SecurityCenter', 'admin', 'allowedhtml'))
                                 )
                             ),
                             array(null, __('Permissions', $dom),    ModUtil::url('Permissions', 'admin', 'main')),
                             array(null, __('Categories', $dom),     ModUtil::url('Categories', 'admin', 'main'),
                                 array(
                                     array(null, __('Category registry', $dom), ModUtil::url('Categories', 'admin', 'editregistry')),
                                     array(null, __('New category', $dom),      ModUtil::url('Categories', 'admin', 'newcat'))
                                 )
                             ),
                             array(null, __('Admin panel', $dom),    ModUtil::url('Admin', 'admin', 'main'),
                                 array(
                                     array(null, __('Settings', $dom), ModUtil::url('Admin', 'admin', 'modifyconfig')),
                                     array(null, __('Help', $dom),     ModUtil::url('Admin', 'admin', 'help'))
                                 )
                             ),
                             array(null, __('System mailer', $dom),  ModUtil::url('Mailer', 'admin', 'main')),
                             array(null, __('Search options', $dom), ModUtil::url('Search', 'admin', 'main')),
                       );
        // Legal
        if (ModUtil::available('Legal')) {
            $linkoptions[] = array(null, __('Legal settings', $dom), ModUtil::url('Legal', 'admin', 'main'));
        }

        $menu[] = array('config', __('Config', $dom),  '#', $linkoptions);


        /* System menu */
        // Search for installed hooks
        $linkoptions = array();

        if (ModUtil::available('EZComments')) {
            $linkoptions[] = array(null, __('Comments', $dom),  ModUtil::url('EZComments', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('MultiHook')) {
            $linkoptions[] = array(null, __('MultiHook', $dom), ModUtil::url('MultiHook', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('BBCode')) {
            $linkoptions[] = array(null, __('BBCode', $dom),    ModUtil::url('bbcode', 'admin', 'config'));
        }
        if (ModUtil::available('BBSmile')) {
            $linkoptions[] = array(null, __('Smilies', $dom),   ModUtil::url('bbsmile', 'admin', 'modifyconfig'));
        }
        if (ModUtil::available('Ratings')) {
            $linkoptions[] = array(null, __('Ratings', $dom),   ModUtil::url('Ratings', 'admin', 'modifyconfig'));
        }
        if (empty($linkoptions)) {
            $linkoptions[] = array(null, __('No known hooks are installed', $dom), '#');
        }

        $theme  = System::getVar('Default_Theme');
        $menu[] = array('system', __('System', $dom), '#',
                    array(
                        array(null, __('Extensions', $dom),             ModUtil::url('Extensions', 'admin', 'main'),
                            array(
                                array(null, __('System plugins', $dom), ModUtil::url('Extensions', 'admin', 'viewPlugins', array('systemplugins' => 1))),
                                array(null, __('Module plugins', $dom), ModUtil::url('Extensions', 'admin', 'viewPlugins'))
                            )
                        ),
                        array(null, __('Hooks', $dom), '#',
                            $linkoptions
                        ),
                        array(null, __('Blocks', $dom),               ModUtil::url('Blocks', 'admin', 'main'),
                            array(
                                array(null, __('New block', $dom),    ModUtil::url('Blocks', 'admin', 'newblock')),
                                array(null, __('New position', $dom), ModUtil::url('Blocks', 'admin', 'newposition'))
                            )
                        ),
                        array(null, __('Themes', $dom),                        ModUtil::url('Theme', 'admin', 'main')),
                        array(null, __('Security center', $dom),               ModUtil::url('SecurityCenter', 'admin', 'modifyconfig'),
                            array(
                                array(null, __('View IDS log', $dom),          ModUtil::url('SecurityCenter', 'admin', 'viewidslog')),
                                array(null, __('HTMLPurifier settings', $dom), ModUtil::url('SecurityCenter', 'admin', 'purifierconfig'))
                            )
                        )
                    )
                );

        // SysInfo check
        if (ModUtil::available('SysInfo')) {
            $menu[] = array(null, __('System information', $dom), ModUtil::url('SysInfo', 'admin', 'main'));
        }


        /* Users/Groups menu */
        // build the Users management submenu options
        $subusr   = array();

        $profileModule = System::getVar('profilemodule', '');
        if (!empty($profileModule) && ModUtil::available($profileModule)) {
            $subusr[] = array(null, __('Profile module', $dom), ModUtil::url($profileModule, 'admin', 'main'));
        }

        $subusr[] = array(null, __('Users settings', $dom), ModUtil::url('Users', 'admin', 'config'));
        $subusr[] = array(null, __('Import users', $dom), ModUtil::url('Users', 'admin', 'import'));
        $subusr[] = array(null, __('Export users', $dom), ModUtil::url('Users', 'admin', 'exporter'));

        $menu[] = array('users', __('Users', $dom), '#',
                    array(
                        array(null, __('Manage groups', $dom), ModUtil::url('Groups', 'admin', 'main'),
                            array(
                                array(null, __('Groups settings', $dom), ModUtil::url('Groups', 'admin', 'modifyconfig'))
                            )
                        ),
                        array(null, __('Manage users', $dom), ModUtil::url('Users', 'admin', 'main'),
                            $subusr
                        ),
                        array(null, __('Create user', $dom), ModUtil::url('Users', 'admin', 'newUser')),
                        array(null, __('Find users', $dom), ModUtil::url('Users', 'admin', 'search')),
                        array(null, __('Find and e-mail users', $dom), ModUtil::url('Users', 'admin', 'mailUsers'))
                    )
                );


        /* Common Utils */
        $linkoptions = array(
                           array(null, __("Edit default theme", $dom), ModUtil::url('Theme', 'admin', 'modify', array('themename' => $theme)))
                       );

        // File handling
        if (ModUtil::available('Files')) {
            $linkoptions[] = array(null, __('File manager', $dom), ModUtil::url('Files', 'admin', 'main'));
        }

        // WYSIWYG handling
        if (ModUtil::available('Scribite') || ModUtil::available('LuMicuLa')) {
            $subopt = array();
            if (ModUtil::available('Scribite')) {
                $subopt[] = array(null, 'Scribite', ModUtil::url('Scribite', 'admin', 'main'));
            }
            if (ModUtil::available('LuMicuLa')) {
                $subopt[] = array(null, 'LuMicuLa', ModUtil::url('LuMicuLa', 'admin', 'main'));
            }
        }
        if (isset($subopt)) {
            $linkoptions[] = array(null, __('WYSIWYG editors', $dom), '#', $subopt);
        }
        // Thumbnails handling
        if (ModUtil::available('Thumbnail')) {
            $linkoptions[] = array(null, __('Thumbnails', $dom), ModUtil::url('Thumbnail', 'admin', 'main'));
        }

        $menu[] = array('utils', __('Utils', $dom), '#', $linkoptions);


        /* Common Routines links */
        $token = SecurityUtil::generateCsrfToken(null, true);
        $linkoptions = array(
                           array(null, __('Template engine', $dom), ModUtil::url('Theme', 'admin', 'modifyconfig', array(), null, 'render_compile_dir'),
                               array(
                                   array(null, __('Delete compiled render templates', $dom), ModUtil::url('Theme', 'admin', 'render_clear_compiled', array('csrftoken' => $token))),
                                   array(null, __('Delete cached render templates', $dom),   ModUtil::url('Theme', 'admin', 'render_clear_cache', array('csrftoken' => $token)))
                               )
                           ),
                           array(null, __('Theme engine', $dom), ModUtil::url('Theme', 'admin', 'modifyconfig'),
                                array(
                                   array(null, __('Delete compiled theme templates', $dom), ModUtil::url('Theme', 'admin', 'clear_compiled', array('csrftoken' => $token))),
                                   array(null, __('Delete cached theme templates', $dom),   ModUtil::url('Theme', 'admin', 'clear_cache', array('csrftoken' => $token)))
                               )
                           ),
                           array(null, __('Clear combination cache', $dom), ModUtil::url('Theme', 'admin', 'clear_cssjscombinecache', array('csrftoken' => $token))),
                           array(null, __('Delete theme configurations', $dom), ModUtil::url('Theme', 'admin', 'clear_config', array('csrftoken' => $token)))
                       );

        if (ModUtil::available('SysInfo')) {
            $linkoptions[] = array(null, __('Filesystem check', $dom),       ModUtil::url('SysInfo', 'admin', 'filesystem'));
            $linkoptions[] = array(null, __('Temporary folder check', $dom), ModUtil::url('SysInfo', 'admin', 'ztemp'));
        }

        $menu[] = array('routines', __('Routines', $dom), '#', $linkoptions);
    }
    /* Permission Admin:: | :: | ACCESS_EDIT ends here */

    /* Create content menu */
    $linkoptions = array();

    // Content Modules
    if (ModUtil::available('Clip') && SecurityUtil::checkPermission('Clip::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Clip Editor Panel', $dom), ModUtil::url('Clip', 'editor', 'main')),
                         array(null, __('Create publication type', $dom), ModUtil::url('Clip', 'admin', 'pubtype'))
                      );
        $linkoptions[] = array(null, __('Clip Admin Panel', $dom), ModUtil::url('Clip', 'admin', 'main'), $suboptions);
    }
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
        $linkoptions[] = array(null, __('Edit contents', $dom), ModUtil::url('Content', 'edit', 'main'), $suboptions);
    }

    // Downloads modules
    if (ModUtil::available('MediaAttach') && SecurityUtil::checkPermission('MediaAttach::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('MediaAttach', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('MediaAttach', 'admin', 'main'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), ModUtil::url('MediaAttach', 'admin', 'view', array(), null, 'myuploadform_switch'), $suboptions);
    }
    if (ModUtil::available('Downloads') && SecurityUtil::checkPermission('Downloads::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('Add category', $dom), ModUtil::url('Downloads', 'admin', 'category_menu')),
                         array(null, __('Settings', $dom),     ModUtil::url('Downloads', 'admin', 'main'))
                      );
        $linkoptions[] = array(null, __('Add a download', $dom), ModUtil::url('Downloads', 'admin', 'newdownload'), $suboptions);
    }

    // Community modules
    if (ModUtil::available('Polls') && SecurityUtil::checkPermission('Polls::', '::', ACCESS_EDIT)) {
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
    if (ModUtil::available('WebLinks') && SecurityUtil::checkPermission('Web_Links::', '::', ACCESS_EDIT)) {
        $linkoptions[] = array(null, __('Add a web link', $dom), ModUtil::url('WebLinks', 'admin', 'main', array('op' => 'LinksAddLink')));
    }

    // Calendar modules
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
    if (ModUtil::available('AdminMessages') && SecurityUtil::checkPermission('AdminMessages::', '::', ACCESS_EDIT)) {
        $suboptions = array(
                         array(null, __('View list', $dom), ModUtil::url('AdminMessages', 'admin', 'view')),
                         array(null, __('Settings', $dom),  ModUtil::url('AdminMessages', 'admin', 'modifyconfig'))
                      );
        $linkoptions[] = array(null, __('Add an admin message', $dom), ModUtil::url('AdminMessages', 'admin', 'new'), $suboptions);
    }

    if (!$linkoptions) {
        $linkoptions[] = array(null, __('No known modules are installed', $dom), '#');
    }

    $menu[] = array('content', __('Create content', $dom), '#', $linkoptions);

    /* Logout link */
    $menu[] = array('logout', __('Log out', $dom), ModUtil::url('Users', 'user', 'logout'));



    /* Create the menu based on the array above */
    $output  = '<div id="'.$id.'"><ul' . ((!empty($ulclass))?' class="'.$ulclass.'"':'') . '>';
    foreach ($menu as $option) {
        $output .= bt_adminlinks_drawmenu($option, $current, $cclass);
    }
    $output .= '</ul></div>';

    return $output;
}

/**
 * Draw the array-menu recursively.
 */
function bt_adminlinks_drawmenu($option, $current, $currentclass, $level=0)
{
    $return = '';

    if (is_array($option)) {
        $return .= '<li class="'.($level == 0 ? 'top' : '').($option[0] == $current ? ' '.$currentclass : '').'">';
        $return .= '<a';
        if ($level == 0) {
            $return .= ' class="top_link"';
        } elseif (isset($option[3]) && is_array($option[3])) {
            $return .= ' class="fly"';
        }
        $return .= ' title="'.DataUtil::formatForDisplay($option[1]).'" href="'.DataUtil::formatForDisplay($option[2]).'">';
        $return .= ($level == 0 ? '<span>' : '') . DataUtil::formatForDisplay($option[1]). ($level == 0 ? '</span>' : '');
        // Recursively render the suboptions
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
