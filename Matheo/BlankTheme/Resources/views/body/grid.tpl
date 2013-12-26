
<!-- skip navigation -->
<a href="#nav" class="sr-only">{gt text='Skip to navigation'}.</a>
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

<div class="bt-wrapper {blankutil section='classespage'}">
    <div class="bt-wbox {blankutil section='classesinnerpage'}">

        <!-- begin: nav -->
        <nav id="nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="{$baseurl}" title="{gt text='Go to the homepage'}" class="navbar-brand">{$modvars.ZConfig.sitename}</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    {if $btconfig.topnav eq 1}
                        {blockposition name='topnav'}
                    {else}
                        {blankmenu}
                    {/if}
                </div>
            </div>
        </nav>
        <!-- end: nav -->

        <!-- begin: header -->
        <header class="container">
            <div id="topnav">
                {blankutil section='topnavlinks'}
                {blankutil section='fontresize'}
            </div>

            {if $btconfig.header eq 1}
                {blockposition name='header'}
            {/if}

            {img src='logo.png' class='logo' __alt='logo'}
            <h1>{$modvars.ZConfig.sitename}</h1>
            <span class="slogan">{$modvars.ZConfig.slogan}</span>
        </header>
        <!-- end: header -->

        <!-- begin: main -->
        <main>
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
            <section id="bt-3b" class="bt-zone ym-grid linearize-level-1 coolsubcol">
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
            </section>
            {/if}
        </main>
        <!-- end: main -->

        <!-- begin: footer -->
        <footer>
            {include file='sections/footer.tpl'}
        </footer>
        <!-- end: footer -->
    </div>
</div>
