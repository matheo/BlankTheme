<!DOCTYPE html>
<html lang="{lang}">

{pageaddvar name='stylesheet' value="`$stylepath`/admin.css"}
{include file='sections/head.tpl'}

<!-- Admin template -->
<body id="bt-{$module}" class="bt-2col bt-admin">

<!-- skip navigation -->
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

{* for the backend we do not use a body template *}
<div class="bt-wrapper bt-12 bt-func-{$func}">
    <div class="bt-wbox {blankutil section='classesinnerpage'}">

        <!-- begin: nav -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1 class="navbar-brand">
                        {img src='logo.gif' modname='core' set='' class='logo' __alt='logo' height='18'}
                        <a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a>
                    </h1>
                </div>
                <div class="navbar-collapse">
                    {blankmenuadmin current=$module}
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{modurl modname='Users' type='user' func='logout'}">
                                <span class="sr-only">{gt text='Logout'}</span>
                                <i class="glyphicon glyphicon-log-out"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end: nav -->

        <!-- begin: #main -->
        <div id="main" class="container">
            {$maincontent}
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
