
<!-- skip navigation -->
<a href="#nav" class="sr-only">{gt text='Skip to navigation'}.</a>
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

<div class="bt-wrapper {blankutil section='classespage'}">
    <div class="bt-wbox {blankutil section='classesinnerpage'}">

        <!-- begin: nav -->
        <nav id="nav" class="navbar navbar-default navbar-fixed-top clearfix" role="navigation">
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

        <!-- begin: main -->
        <main>
            <h2>BlankTheme</h2>

            <p class="lead">
                {gt text='Example of a simple and beautiful home page. Edit the content of the home.tpl body template, and add your own fullscreen background photo on the style.css.'}
            </p>
            <p class="lead">
                <a href="https://www.github.com/matheo/BlankTheme" class="btn btn-lg btn-info">{gt text='Learn more'} &raquo;</a>
            </p>
        </main>
        <!-- end: main -->
    </div>
</div>

<!-- begin: footer -->
<footer>
    <div class="container">
        {include file='sections/footer.tpl'}
    </div>
</footer>
<!-- end: footer -->
