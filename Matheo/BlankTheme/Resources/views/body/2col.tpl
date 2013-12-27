
<!-- skip navigation -->
<a href="#nav" class="sr-only">{gt text='Skip to navigation'}.</a>
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

<div class="bt-wrapper {blankutil section='classespage'}">
    <div class="bt-wbox {blankutil section='classesinnerpage'}">

        <!-- begin: nav -->
        <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
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
            <div class="container">
                <div class="row">

                <!-- begin: col1 main column -->
                <div class="col-md-8 bt-col1">
                    <div class="bt-box">
                        {if $layout|checkzone:nc ne true}
                            {blockposition name='center'}
                        {/if}

                        {$maincontent}

                        {if $layout|checkzone:2cb}
                        <section id="bt-2cb" class="row bt-zone">
                            <div class="col-md-6">
                                <div class="bt-box">
                                    {blockposition name='centerbl'}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bt-box">
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
                <aside class="col-md-4 bt-col2">
                    <div class="bt-box">
                        {blockposition name='left'}
                    </div>
                </aside>
                <!-- end: col2 -->
                {/if}

                {if $layout|checklayout:3}
                <!-- begin: col3 column -->
                <aside class="col-md-4 bt-col3">
                    <div class="bt-box">
                        {*blockposition name='search'*}
                        {blockposition name='right'}
                    </div>
                </aside>
                <!-- end: col3 -->
                {/if}

                </div>
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
