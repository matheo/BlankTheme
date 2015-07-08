
<!-- skip navigation -->
<a href="#nav" class="sr-only">{gt text='Skip to navigation'}.</a>
<a href="#main" class="sr-only">{gt text='Skip to main content'}.</a>

<div class="bt-wrapper {blankutil section='classespage'}">
    <div class="bt-wbox {blankutil section='classesinnerpage'}">
        <div class="bt-cover-container">

        <!-- begin: nav -->
        <nav id="nav" class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <span class="navbar-brand">{$modvars.ZConfig.sitename}</span>
            </div>

            {blankmenu css='navbar-right examplehome-nav'}
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

        <!-- begin: footer -->
        <footer>
            {include file='sections/footer.tpl'}
        </footer>
        <!-- end: footer -->

        </div>
    </div>
</div>
