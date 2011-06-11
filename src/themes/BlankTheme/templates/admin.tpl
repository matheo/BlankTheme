<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{lang}" lang="{lang}" dir="{langdirection}">

{pageaddvar name='stylesheet' value="`$themepath`/style/admin.css"}
{include file='sections/head.tpl'}

<!-- Admin template -->
<body id="bt_{$module}" class="bt_2col bt_admin">

<!-- skip link navigation -->
<ul id="skiplinks" dir="{langdirection}">
    <li><a class="skip" href="#nav">{gt text='Skip to navigation'} {gt text='(Press Enter)'}.</a></li>
    <li><a class="skip" href="#col1">{gt text='Skip to main content'} {gt text='(Press Enter)'}.</a></li>
</ul>

{* for the backend we do not use a body template *}
<div class="page_margins bt_12 bt_func_{$func}">
    <div class="page {bt_htmloutput section='classesinnerpage'}">

        <!-- begin: #header -->
        <div id="header">
            <div id="topnav">
                {bt_htmloutput section='topnavlinks'}
            </div>
            {img src='logo.gif' modname='core' set='' class='logo' __alt='logo' height='25'}
            <h1><a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a></h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </div>
        <!-- end: #header -->

        <!-- begin: main navigation #nav -->
        <div id="nav">
            {bt_adminlinks current=$module}
        </div>
        <!-- end: main navigation -->

        <!-- begin: main content area #main -->
        <div id="main">
            {$maincontent}
            </div> {* end: col1_content *}
            <div id="ie_clearing">&nbsp;</div>
            <!-- End: IE Column Clearing -->
            </div>
            <!-- end: #col2 -->
            </div> {* close admin_categorymenu cols wrapper *}
        </div>
        <!-- end: #main -->

        <!-- begin: #footer -->
        <div id="footer">
            <a href="{gt text='http://community.zikula.org/'}" title="{gt text='Powered by Zikula'}">{gt text='Powered by Zikula'} {$coredata.version_num}</a>
            {bt_htmloutput section='footer'}
        </div>
        <!-- end: #footer -->
    </div>
</div>
</body>
</html>
