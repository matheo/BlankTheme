
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
                {*<form class="ym-searchform">
                    <input class="ym-searchfield" type="search" placeholder="Search..." />
                    <input class="ym-searchbutton" type="submit" value="Search" />
                </form>*}
            </div>
        </nav>
        <!-- end: nav -->

        <!-- begin: #main -->
        <div id="main">
            <div class="ym-grid linearize-level-1">
                <!-- begin: col1 main column -->
                <div class="ym-g62 ym-gl">
                    <div class="ym-gbox">
                        {if $layout|checkzone:nc ne true}
                            {blockposition name='center'}
                        {/if}

                        {$maincontent}
                    </div>
                </div>
                <!-- end: col1 -->
                <aside class="ym-g38 ym-gr">
                    {*blockposition name='search'*}

                    {if $layout|checklayout:123 OR $layout|checklayout:132}
                    <div class="ym-grid linearize-level-2">
                        <!-- begin: #col2 column -->
                        <div class="ym-g50 ym-gl">
                            <div class="ym-gbox">
                            {if $layout|checklayout:123}
                                {blockposition name='left'}
                            {else}
                                {blockposition name='right'}
                            {/if}
                            </div>
                        </div>
                        <!-- end: #col2 -->
                        <!-- begin: #col3 column -->
                        <div class="ym-g50 ym-gr">
                            <div class="ym-gbox">
                            {if $layout|checklayout:123}
                                {blockposition name='right'}
                            {else}
                                {blockposition name='left'}
                            {/if}
                            </div>
                        </div>
                        <!-- end: #col3 -->
                    </div>
                    {else}
                    <div class="ym-gbox">
                        {if $layout|checklayout:12}
                            {blockposition name='right'}
                        {elseif $layout|checklayout:13}
                            {blockposition name='left'}
                        {/if}
                    </div>
                    {/if}
                </aside>
            </div>

            {if $layout|checkzone:3b}
            <div id="bt-3b" class="bt-zone ym-grid linearize-level-1 coolsubcol">
                <div class="ym-g33 ym-gl">
                    <div class="ym-gbox">
                        {blockposition name='bottoml'}
                    </div>
                </div>
                <div class="ym-g33 ym-gl">
                    <div class="ym-gbox">
                        {blockposition name='bottomc'}
                    </div>
                </div>
                <div class="ym-g33 ym-gr">
                    <div class="ym-gbox">
                        {blockposition name='bottomr'}
                    </div>
                </div>
            </div>
            {/if}
        </div>
        <!-- end: #main -->

        <!-- begin: footer -->
        <footer>
            {include file='sections/footer.tpl'}
        </footer>
        <!-- end: footer -->
    </div>
</div>
