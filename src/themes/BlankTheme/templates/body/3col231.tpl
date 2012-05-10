
<!-- skip link navigation -->
<ul class="ym-skiplinks">
    <li><a class="ym-skip" href="#nav">{gt text='Skip to navigation'} {gt text='(Press Enter)'}.</a></li>
    <li><a class="ym-skip" href="#main">{gt text='Skip to main content'} {gt text='(Press Enter)'}.</a></li>
</ul>

<div class="ym-wrapper {bt_htmloutput section='classespage'}">
    <div class="ym-wbox bordered {bt_htmloutput section='classesinnerpage'}">

        <!-- begin: header -->
        <header>
            <div id="topnav">
                {bt_htmloutput section='topnavlinks'}
                {bt_htmloutput section='fontresize'}
            </div>
            {if $btconfig.header eq 1}
                {blockposition name='header'}
            {/if}
            <a href="{$baseurl}">{img src='logo.png' class='logo' __alt='logo'}</a>
            <h1><a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a></h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </header>
        <!-- end: header -->

        <!-- begin: nav -->
        <nav id="nav">
            <div class="ym-hlist">
                {if $btconfig.topnav eq 1}
                    {blockposition name='topnav'}
                {else}
                    {bt_userlinks}
                {/if}
            </div>
        </nav>
        <!-- end: nav -->

        <!-- begin: #main -->
        <div id="main">
            <div class="ym-column linearize-level-1">

            <!-- begin: col2 column -->
            <div class="ym-col2">
                <div class="ym-cbox">
                    {blockposition name='left'}
                </div>
            </div>
            <!-- end: col2 -->

            <!-- begin: col3 column -->
            <div class="ym-col3">
                <div class="ym-cbox">
                    {*blockposition name='search'*}
                    {blockposition name='right'}
                </div>
            </div>
            <!-- end: col3 -->

            <!-- begin: col1 - main column -->
            <div class="ym-col1">
                <div class="ym-cbox ym-clearfix">
                    {if $layout|checkzone:nc ne true}
                        {blockposition name='center'}
                    {/if}

                    {$maincontent}

                    {if $layout|checkzone:2cb}
                    <div id="bt-2cb" class="bt-zone ym-grid">
                        <div class="ym-g50 ym-gl">
                            <div class="ym-gbox">
                                {blockposition name='centerbl'}
                            </div>
                        </div>
                        <div class="ym-g50 ym-gr">
                            <div class="ym-gbox">
                                {blockposition name='centerbr'}
                            </div>
                        </div>
                    </div>
                    {/if}
                </div>

                <div class="ym-ie-clearing">&nbsp;</div>
            </div>
            <!-- end: col1 -->
        </div>
        <!-- end: #main -->

        <!-- begin: footer -->
        <footer>
            {include file='sections/footer.tpl'}
        </footer>
        <!-- end: footer -->
    </div>
</div>
