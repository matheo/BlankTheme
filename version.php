<?php 
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2007-2012 Mateo Tibaquirá
 * @link      http://www.blanktheme.org
 * @license   MIT - http://www.opensource.org/licenses/mit-license.html
 * @abstract  Blank theme to develop new themes with ease
 */


$dom = ZLanguage::getThemeDomain('BlankTheme');

$themeversion['name']           = 'BlankTheme';
$themeversion['displayname']    = __('BlankTheme', $dom);
$themeversion['description']    = __('Theme development framework for Zikula', $dom);
$themeversion['version']        = '1.3.6';

$themeversion['author']         = 'BlankTheme Team';
$themeversion['contact']        = 'http://www.blanktheme.org';
$themeversion['admin']          = 1;
$themeversion['user']           = 1;
$themeversion['system']         = 0;
$themeversion['changelog']      = 'docs/CHANGELOG.markdown';
$themeversion['credits']        = 'docs/CREDITS.markdown';
$themeversion['help']           = 'docs/HELP.markdown';
$themeversion['license']        = 'docs/LICENSE.txt';
$themeversion['xhtml']          = true;

$themeversion['extra']          = array("BlankTheme" => '1.3.6',
                                        "Bootstrap"  => '3.3.4');
