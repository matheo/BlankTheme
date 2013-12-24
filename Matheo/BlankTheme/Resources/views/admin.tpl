<!DOCTYPE html>
<html lang="{lang}">

{pageaddvar name='stylesheet' value="`$themepath`/style/admin.css"}
{include file='sections/head.tpl'}

<!-- Admin template -->
<body id="bt-{$module}" class="bt-2col bt-admin">

<!-- skip link navigation -->
<ul class="sr-only">
    <li><a class="ym-skip" href="#main">{gt text='Skip to main content'} {gt text='(Press Enter)'}.</a></li>
</ul>

{* for the backend we do not use a body template *}
<div class="ym-wrapper bt-12 bt-func-{$func}">
    <div class="ym-wbox {blankutil section='classesinnerpage'}">

        <!-- begin: nav -->
        {blankmenuadmin current=$module}
        <!-- end: nav -->

        <!-- begin: header -->
        <header>
            {img src='logo.gif' modname='core' set='' class='logo' __alt='logo' height='25'}
            <h1><a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a></h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </header>
        <!-- end: header -->

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
            {blankutil section='footer'}
        </footer>
        <!-- end: footer -->
    </div>
</div>
</body>
</html>
