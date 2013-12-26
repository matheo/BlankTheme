
<!-- skip navigation -->
<a href="#nav" class="sr-only">{gt text='Skip to navigation'}.</a>
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

<!-- begin: header -->
<header>
    <div class="bt-wrapper">
        <div class="bt-wbox">
            <div id="topnav">
                {blankutil section='topnavlinks'}
                {blankutil section='fontresize'}
            </div>
            {if $btconfig.header eq 1}
                {blockposition name='header'}
            {/if}
            <a href="{$baseurl}">{img src='logo.png' class='logo' __alt='logo'}</a>
            <h1><a href="{$baseurl}" title="{gt text='Go to the homepage'}">{$modvars.ZConfig.sitename}</a></h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </div>
    </div>
</header>
<!-- end: header -->

<!-- begin: nav -->
<nav id="nav">
    <div class="bt-wrapper">
        <div class="ym-hlist">
            {if $btconfig.topnav eq 1}
                {blockposition name='topnav'}
            {else}
                {blankmenu}
            {/if}
        </div>
    </div>
</nav>
<!-- end: nav -->

<!-- begin: main -->
<main class="bt-2col">
    <div class="bt-wrapper {blankutil section='classespage'}">
        <div class="bt-wbox {blankutil section='classesinnerpage'}">
            <div class="ym-column linearize-level-1">

            <!-- begin: col1 main column -->
            <div class="ym-col1">
                <div class="ym-cbox">
                    {if $layout|checkzone:nc ne true}
                        {blockposition name='center'}
                    {/if}

                    {$maincontent}

                    {if $layout|checkzone:2cb}
                    <section id="bt-2cb" class="bt-zone ym-grid linearize-level-2">
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
                    </section>
                    {/if}
                </div>
            </div>
            <!-- end: col1 -->

            {if $layout|checklayout:2}
            <!-- begin: col2 column -->
            <aside class="ym-col2">
                <div class="ym-cbox">
                    {blockposition name='left'}
                </div>
            </aside>
            <!-- end: col2 -->
            {/if}

            {if $layout|checklayout:3}
            <!-- begin: col3 column -->
            <aside class="ym-col3">
                <div class="ym-cbox">
                    {*blockposition name='search'*}
                    {blockposition name='right'}
                </div>
            </aside>
            <!-- end: col3 -->
            {/if}

            </div>
        </div>
    </div>
</main>
<!-- end: main -->

<!-- begin: footer -->
<footer>
    <div class="bt-wrapper">
        <div class="bt-wbox">
            {include file='sections/footer.tpl'}
        </div>
    </div>
</footer>
<!-- end: footer -->
