
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
        <header>
            <div class="container">
                <div class="jumbotron">
                    <div id="topnav">
                        {blankutil section='topnavlinks'}
                        {blankutil section='fontresize'}
                    </div>

                    {if $btconfig.header eq 1}
                        {blockposition name='header'}
                    {/if}

                    {img src='logo.png' class='logo' __alt='logo'}
                    <h1>{$modvars.ZConfig.sitename}</h1>
                    <p class="slogan">{$modvars.ZConfig.slogan}</p>
                </div>
            </div>
        </header>
        <!-- end: header -->

        <!-- begin: main -->
        <main>
            <div class="ym-column linearize-level-1">

            <!-- begin: col1 main column -->
            <div class="ym-col1">
                <div class="ym-cbox ym-clearfix">
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

            <!-- begin: col2 column -->
            <aside class="ym-col2">
                <div class="ym-cbox">
                    {blockposition name='left'}
                </div>
            </aside>
            <!-- end: col2 -->

            <!-- begin: col3 column -->
            <aside class="ym-col3">
                <div class="ym-cbox">
                    {*blockposition name='search'*}
                    {blockposition name='right'}
                </div>
            </aside>
            <!-- end: col3 -->

            </div>
        </main>
        <!-- end: main -->

        <!-- begin: footer -->
        <footer>
            <div class="container">
                {include file='sections/footer.tpl'}
            </div>
        </footer>
        <!-- end: footer -->
    </div>
</div>
