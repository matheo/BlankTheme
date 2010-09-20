<?php 
/**
 * Zikula Application Framework
 *
 * @copyright  (c) 2007, Mateo Tibaquira
 * @link       http://www.blanktheme.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @abstract   Blank theme to develop new themes with ease
 * @version    $Id$
 */


$dom = ZLanguage::getThemeDomain('BlankTheme');

$themeversion['name']           = 'BlankTheme';
$themeversion['displayname']    = __('BlankTheme', $dom);
$themeversion['description']    = __('Theme development framework for Zikula', $dom);
$themeversion['version']        = '1.0';

$themeversion['author']         = 'BlankTheme Team';
$themeversion['contact']        = 'http://www.blanktheme.org';
$themeversion['official']       = '0';
$themeversion['regid']          = '0';
$themeversion['admin']          = 1;
$themeversion['user']           = 1;
$themeversion['system']         = 0;
$themeversion['changelog']      = 'docs/changelog.txt';
$themeversion['credits']        = 'docs/credits.txt';
$themeversion['help']           = 'docs/help.txt';
$themeversion['license']        = 'docs/license.txt';
$themeversion['xhtml']          = true;

$themeversion['extra']          = array('BlankTheme' => '1.0',
                                        'YAML'       => '3.2.1');
