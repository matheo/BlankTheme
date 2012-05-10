<!DOCTYPE html>
<html lang="{lang}">

{pageaddvar name='stylesheet' value="`$themepath`/style/admin.css"}
{include file='sections/head.tpl'}

<!-- Admin template -->
<body id="bt-{$module}" class="bt-2col bt-admin">

<!-- skip link navigation -->
<ul class="ym-skiplinks">
    <li><a class="ym-skip" href="#nav">{gt text='Skip to navigation'} {gt text='(Press Enter)'}.</a></li>
    <li><a class="ym-skip" href="#main">{gt text='Skip to main content'} {gt text='(Press Enter)'}.</a></li>
</ul>

{* for the backend we do not use a body template *}
<div class="ym-wrapper bt-12 bt-func-{$func}">
    <div class="ym-wbox {bt_htmloutput section='classesinnerpage'}">

        <!-- begin: header -->
        <header>
            <div id="topnav">
                {bt_htmloutput section='topnavlinks'}
            </div>
            {img src='logo.gif' modname='core' set='' class='logo' __alt='logo' height='25'}
            <h1><a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a></h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </header>
        <!-- end: header -->

        <!-- begin: nav -->
        <nav id="nav">
            {bt_adminlinks current=$module}
        </nav>
        <!-- end: nav -->

        <!-- begin: #main -->
        <div id="main">
            {$maincontent}
            </div> {* end: .ym-cbox *}
            <div class="ym-ie-clearing">&nbsp;</div>
            </div> {* end: .ym-col1 *}
            </div> {* close .ym-column wrapper *}
        </div>
        <!-- end: #main -->

        <!-- begin: footer -->
        <footer>
            <a href="{gt text='http://community.zikula.org/'}" title="{gt text='Powered by Zikula'}">{gt text='Powered by Zikula'} {$coredata.version_num}</a>
            {bt_htmloutput section='footer'}
        </footer>
        <!-- end: footer -->
    </div>
</div>
</body>
</html>
