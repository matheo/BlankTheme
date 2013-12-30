
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

        <!-- begin: main -->
        <main>
            <div class="container">
                <div class="row">
                    <!-- begin: col1 main column -->
                    <div class="col-md-9">
                        <div class="bt-box">

                            <div class="jumbotron">
                                <div id="topnav">
                                    {blankutil section='topnavlinks'}
                                </div>
                                <strong class="h1">BlankTheme</strong>
                                <p>{gt text='This is the <code>example</code> body template to check the styles offered by this theme.'}</p>
                            </div>



                            <ul class="nav nav-tabs" id="btextabs">
                                <li class="active"><a href="#btexcss" data-toggle="tab">CSS</a></li>
                                <li><a href="#btexutility" data-toggle="tab">{gt text='Utilities'}</a></li>
                                <li><a href="#btextables" data-toggle="tab">{gt text='Tables'}</a></li>
                                <li><a href="#btexforms" data-toggle="tab">{gt text='Forms'}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="btexcss">
                                    <div class="page-header">
                                        <h2>{gt text='Titles'}</h2>
                                    </div>

                                    <h1>{gt text='%s heading and %s' tag1='h1' tag2='<code>.h1</code>'} <small>{gt text='on this theme'}</small></h1>
                                    <hr />
                                    <h2>{gt text='%s heading and %s' tag1='h2' tag2='<code>.h2</code>'} <small>{gt text='on this theme'}</small></h2>
                                    <hr />
                                    <h3>{gt text='%s heading and %s' tag1='h3' tag2='<code>.h3</code>'} <small>{gt text='on this theme'}</small></h3>
                                    <hr />
                                    <h4>{gt text='%s heading and %s' tag1='h4' tag2='<code>.h4</code>'} <small>{gt text='on this theme'}</small></h4>
                                    <hr />
                                    <h5>{gt text='%s heading and %s' tag1='h5' tag2='<code>.h5</code>'} <small>{gt text='on this theme'}</small></h5>
                                    <hr />
                                    <h6>{gt text='%s heading and %s' tag1='h6' tag2='<code>.h6</code>'} <small>{gt text='on this theme'}</small></h6>


                                    <div class="page-header">
                                        <h2>{gt text='Body copy'}</h2>
                                        <p>Global default <code>font-size</code> is <strong id="bt-fs">14px</strong>, with a <code>line-height</code> of <strong id="bt-lh">1.428</strong>.</p>
                                    </div>

                                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>

                                    <div class="page-header">
                                        <h3>{gt text='Lead body copy'}</h3>
                                        <p>{gt text='Make a paragraph stand out by adding <code>.lead</code>.'}</p>
                                    </div>

                                    <p class="lead">Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>


                                    <div class="page-header">
                                        <h2>{gt text='Emphasis'}</h2>
                                        <p>{gt text='Make use of HTML\'s default emphasis tags with lightweight styles.'}</p>
                                    </div>

                                    <p><code>&lt;small&gt; .small</code> <small>Lorem ipsum dolor sit amet.</small></p>
                                    <p><code>&lt;strong&gt; &lt;b&gt;</code> <strong>Integer molestie lorem at massa.</strong></p>
                                    <p><code>&lt;em&gt; &lt;i&gt;</code> <em>Facilisis in pretium nisl aliquet.</em></p>
                                    <p class="text-left"><code>.text-left</code></p>
                                    <p class="text-center"><code>.text-center</code></p>
                                    <p class="text-right"><code>.text-right</code></p>
                                    <p class="text-muted"><code>.text-muted</code> Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
                                    <p class="text-primary"><code>.text-primary</code> Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    <p class="text-success"><code>.text-success</code> Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                    <p class="text-info"><code>.text-info</code> Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                                    <p class="text-warning"><code>.text-warning</code> Etiam porta sem malesuada magna mollis euismod.</p>
                                    <p class="text-danger"><code>.text-danger</code> Donec ullamcorper nulla non metus auctor fringilla.</p>


                                    <div class="page-header">
                                        <h2>{gt text='Abbreviations'}</h2>
                                        <p>{gt text='Add %s to an abbreviation for a slightly smaller font-size.' tag1='<code>.initialism</code>'}</p>
                                    </div>

                                    <p><abbr title="attribute">attr</abbr> <code>&lt;abbr title="attribute"&gt;attr&lt;/abbr&gt;</code></p>
                                    <p><abbr title="HyperText Markup Language" class="initialism">HTML</abbr> <code>&lt;abbr title="HyperText Markup Language" class="initialism"&gt;HTML&lt;/abbr&gt;</code></p>


                                    <div class="page-header">
                                        <h2>{gt text='Addresses'}</h2>
                                    </div>

                                    <address>
                                        <strong>Twitter, Inc.</strong><br />
                                        795 Folsom Ave, Suite 600<br />
                                        San Francisco, CA 94107<br />
                                        <abbr title="Phone">P:</abbr> (123) 456-7890<br />
                                        <a href="mailto:#">first.last@example.com</a>
                                    </address>


                                    <div class="page-header">
                                        <h2>{gt text='Blockquotes'}</h2>
                                        <p>{gt text='Use %s for a floated, right-aligned blockquote.' tag1='<code>.pull-right</code>'}</p>
                                    </div>

                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <small>{gt text='Someone famous in'} <cite title="{gt text='Source Title'}">{gt text='Source Title'}</cite></small>
                                    </blockquote>

                                    <blockquote class="pull-right">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <small>{gt text='Someone famous in'} <cite title="{gt text='Source Title'}">{gt text='Source Title'}</cite></small>
                                    </blockquote>

                                    <div class="clearfix"></div>


                                    <div class="page-header">
                                        <h2>{gt text='Lists'}</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>{gt text='Unordered'}</h3>

                                            <ul>
                                                <li>Lorem ipsum dolor sit amet</li>
                                                <li>Integer molestie lorem at massa</li>
                                                <ul>
                                                    <li>Phasellus iaculis neque</li>
                                                    <li>Purus sodales ultricies</li>
                                                </ul>
                                                </li>
                                                <li>Faucibus porta lacus fringilla vel</li>
                                                <li>Aenean sit amet erat nunc</li>
                                            </ul>
                                        </div>

                                        <div class="col-md-6">
                                            <h3>{gt text='Ordered'}</h3>

                                            <ol>
                                                <li>Lorem ipsum dolor sit amet</li>
                                                <li>Integer molestie lorem at massa</li>
                                                <li>Facilisis in pretium nisl aliquet</li>
                                                <li>Nulla volutpat aliquam velit</li>
                                                <li>Faucibus porta lacus fringilla vel</li>
                                                <li>Aenean sit amet erat nunc</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>{gt text='Unstyled'}</h3>
                                            <p><code>.list-unstyled</code></p>

                                            <ul class="list-unstyled">
                                                <li>Lorem ipsum dolor sit amet</li>
                                                <ul>
                                                    <li>Phasellus iaculis neque</li>
                                                    <li>Purus sodales ultricies</li>
                                                </ul>
                                                </li>
                                                <li>Faucibus porta lacus fringilla vel</li>
                                            </ul>
                                        </div>

                                        <div class="col-md-6">
                                            <h3>{gt text='Inline'}</h3>
                                            <p><code>.list-inline</code></p>

                                            <ul class="list-inline">
                                                <li>Lorem ipsum</li>
                                                <li>Phasellus iaculis</li>
                                                <li>Nulla volutpat</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>{gt text='Description'}</h3>

                                            <dl>
                                                <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                                <dt>Euismod</dt>
                                                <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                                                <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-6">
                                            <h3>{gt text='Horizontal'}</h3>
                                            <p><code>.dl-horizontal</code></p>

                                            <dl class="dl-horizontal">
                                                <dt>Description</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                                <dt>Euismod</dt>
                                                <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                                            </dl>
                                        </div>
                                    </div>


                                    <div class="page-header">
                                        <h2>{gt text='Code'}</h2>
                                        <p>{gt text='You may optionally add the %s class, which will set a max-height of 350px and provide a y-axis scrollbar.' tag1='<code>.pre-scrollable</code>'}</p>
                                    </div>

                                    <pre>&lt;p&gt;{gt text='Sample code here'}...&lt;/p&gt;</pre>
                                </div>

                                <div class="tab-pane" id="btexutility">

                                    <div class="page-header">
                                        <h2>{gt text='Images and Thumbnails'}</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="thumbnail">
                                                <img data-src="holder.js/140x140" class="img-rounded" />
                                                <div class="caption">
                                                    <code>.img-rounded</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="thumbnail">
                                                <img data-src="holder.js/140x140" class="img-circle" />
                                                <div class="caption">
                                                    <code>.img-circle</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="visible-sm clearfix"></div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="thumbnail">
                                                <img data-src="holder.js/140x140" class="img-thumbnail" />
                                                <div class="caption">
                                                    <code>.img-thumbnail</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="thumbnail">
                                                <img src="{$imagepath}/logo.png" class="img-responsive" />
                                                <div class="caption">
                                                    <code>.img-responsive</code>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="page-header">
                                        <h2>{gt text='Alerts with Helper classes'}</h2>
                                    </div>

                                    <div class="alert alert-success center-block" style="width: 75%"><code>width: 75%</code> + <code>alert alert-success</code> + <code>.center-block</code></div>
                                    <div class="alert alert-warning pull-left"><code>alert alert-warning</code><br /> + <code>.pull-left</code></div>
                                    <div class="alert alert-danger pull-right"><code>alert alert-danger</code><br /> + <code>.pull-right</code></div>
                                    <div class="clearfix"><code>.clearfix</code></div>
                                    <div class="alert alert-info clearfix"><code>alert alert-info</code> + <code>.clearfix</code></div>


                                    <div class="page-header">
                                        <h3>{gt text='Showing and hiding content'}</h3>
                                    </div>

                                    {gettext}
                                        <p>Force an element to be shown or hidden (<strong>including for screen readers</strong>) with the use of <code>.show</code> and <code>.hidden</code> classes. These classes use <code>!important</code> to avoid specificity conflicts. They are only available for block level toggling. They can also be used as mixins.</p>
                                        <p><code>.hide</code> is available, but it does not always affect screen readers and is <strong>deprecated</strong> as of v3.0.1. Use <code>.hidden</code> or <code>.sr-only</code> instead.</p>
                                        <p>Furthermore, <code>.invisible</code> can be used to toggle only the visibility of an element, meaning its <code>display</code> is not modified and the element can still affect the flow of the document.</p>
                                    {/gettext}


                                    <div class="page-header">
                                        <h3>{gt text='Screen reader content'}</h3>
                                    </div>

                                    {gettext}
                                        <p>Hide an element to all devices <strong>except screen readers</strong> with <code>.sr-only</code>. Can also be used as a mixin.</p>
                                    {/gettext}


                                    <div class="page-header">
                                        <h3>{gt text='Image replacement'}</h3>
                                    </div>

                                    {gettext}
                                        <p>Utilize the <code>.text-hide</code> class or mixin to help replace an element's text content with a background image.</p>
                                    {/gettext}


                                    <div class="page-header">
                                        <h2>{gt text='List groups'}</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                <li class="list-group-item">Cras justo odio</li>
                                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                                <li class="list-group-item">Morbi leo risus</li>
                                                <li class="list-group-item">Porta ac consectetur ac</li>
                                                <li class="list-group-item">Vestibulum at eros</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="list-group">
                                                <a href="#" class="list-group-item">Cras justo odio</a>
                                                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                                                <a href="#" class="list-group-item active">Morbi leo risus</a>
                                                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                                                <a href="#" class="list-group-item">Vestibulum at eros</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="list-group">
                                                <a href="#" class="list-group-item active">
                                                    <h4 class="list-group-item-heading">List group item heading</h4>
                                                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
                                                </a>
                                                <a href="#" class="list-group-item">
                                                    <h4 class="list-group-item-heading">List group item heading</h4>
                                                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="page-header">
                                        <h2>{gt text='Panels'}</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">{gt text='Panel title'}</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Panel title</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Panel title</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Panel title</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Panel title</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Panel title</h3>
                                                </div>
                                                <div class="panel-body">
                                                    {gt text='Panel content'}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="page-header">
                                        <h2>{gt text='Wells'}</h2>
                                    </div>

                                    <div class="well">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
                                    </div>


                                    <div class="page-header">
                                        <h2>{gt text='Responsive utilities'}</h2>
                                    </div>

                                    <p>{gettext}Try to use these on a limited basis and avoid creating entirely different versions of the same site. Instead, use them to complement each device's presentation. <strong>Responsive utilities are currently only available for block and table toggling.</strong> Use with inline and table elements is currently not supported.{/gettext}</p>

                                    <p>
                                        <code>.visible-xs</code> <code>.visible-sm</code> <code>.visible-md</code> <code>.visible-lg</code>
                                        <br />
                                        <code>.hidden-xs</code> <code>.hidden-sm</code> <code>.hidden-md</code> <code>.hidden-lg</code>
                                        <br />
                                        <code>.visible-print</code> <code>.hidden-print</code>
                                    </p>
                                </div>

                                <div class="tab-pane" id="btextables">
                                    <div class="page-header">
                                        <h2>{gt text='Basic example'}</h2>
                                    </div>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='First Name'}</th>
                                            <th>{gt text='Last Name'}</th>
                                            <th>{gt text='Username'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Striped rows'}</h2>
                                    </div>

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='First Name'}</th>
                                            <th>{gt text='Last Name'}</th>
                                            <th>{gt text='Username'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Bordered table'}</h2>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='First Name'}</th>
                                            <th>{gt text='Last Name'}</th>
                                            <th>{gt text='Username'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@TwBootstrap</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="2">{gt text='Larry the Bird'}</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Hover rows'}</h2>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='First Name'}</th>
                                            <th>{gt text='Last Name'}</th>
                                            <th>{gt text='Username'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="2">{gt text='Larry the Bird'}</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Condensed table'}</h2>
                                    </div>

                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='First Name'}</th>
                                            <th>{gt text='Last Name'}</th>
                                            <th>{gt text='Username'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="2">{gt text='Larry the Bird'}</td>
                                            <td>@twitter</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Contextual classes'}</h2>
                                    </div>

                                    <p><code>.active</code> <code>.success</code> <code>.warning</code> <code>.danger</code></p>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{gt text='Column heading'}</th>
                                            <th>{gt text='Column heading'}</th>
                                            <th>{gt text='Column heading'}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                        </tr>
                                        <tr class="active">
                                            <td>2</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td class="success">{gt text='Column content'}</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                        </tr>
                                        <tr class="warning">
                                            <td>5</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>{gt text='Column content'}</td>
                                            <td>{gt text='Column content'}</td>
                                            <td class="danger">{gt text='Column content'}</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="page-header">
                                        <h2>{gt text='Responsive tables'}</h2>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{gt text='Table heading'}</th>
                                                <th>{gt text='Table heading'}</th>
                                                <th>{gt text='Table heading'}</th>
                                                <th>{gt text='Table heading'}</th>
                                                <th>{gt text='Table heading'}</th>
                                                <th>{gt text='Table heading'}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                                <td>{gt text='Table cell'}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="btexforms">
                                    <div class="page-header">
                                        <h2>{gt text='Basic example'}</h2>
                                    </div>

                                    <form role="form">
                                        <div class="form-group">
                                            <label for="exampleInputName1">File name</label>
                                            <input type="email" class="form-control" id="exampleInputName1" placeholder="File name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>


                                    <div class="page-header">
                                        <h2>{gt text='Inline form'}</h2>
                                    </div>

                                    <form class="form-inline" role="form">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Sign in</button>
                                    </form>


                                    <div class="page-header">
                                        <h2>{gt text='Horizontal form'}</h2>
                                    </div>

                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">Sign in</button>
                                            </div>
                                        </div>
                                    </form>


                                    <div class="page-header">
                                        <h2>{gt text='Supported controls'}</h2>
                                    </div>

                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="supported1" class="col-sm-2 control-label">Input</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="supported1" placeholder="Text input">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="supported2" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="supported2" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value=""> Checkbox
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Inline</label>
                                            <div class="col-sm-10">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Checkbox 3
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                        Radio option 1
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                        Radio option 2
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="supported3" class="col-sm-2 control-label">Select</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="supported3">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="supported4" class="col-sm-2 control-label">Multiple</label>
                                            <div class="col-sm-10">
                                                <select multiple class="form-control" id="supported4">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Static</label>
                                            <div class="col-sm-10">
                                                <p class="form-control-static">Control with Plain text</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Disabled</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Disabled input" disabled>
                                            </div>
                                        </div>
                                        <fieldset disabled>
                                            <span class="help-block">Disabled fieldset (IE9 and below doesn't actually support the <code>disabled</code> attribute on a <code>fieldset</code>)</span>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="disabledSelect">Select</label>
                                                <div class="col-sm-10">
                                                    <select id="disabledSelect" class="form-control">
                                                        <option>Disabled select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> Can't check this
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Sizing</label>
                                            <div class="col-sm-10">
                                                <input class="form-control input-lg" type="text" placeholder=".input-lg">
                                                <input class="form-control input-sm" type="text" placeholder=".input-sm">
                                                <span class="help-block">A <code>.help-block</code> text that breaks onto a new line and may extend beyond one line.</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Columns</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" placeholder=".col-sm-2">
                                            </div>
                                            <div class="col-sm-offset-1 col-sm-3">
                                                <input type="text" class="form-control" placeholder=".col-sm-3">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder=".col-sm-4">
                                            </div>
                                        </div>
                                    </form>



                                    <div class="page-header">
                                        <h2>{gt text='Buttons'}</h2>
                                    </div>

                                    <p>
                                        <button type="button" class="btn btn-default">{gt text='Default'}</button>
                                        <button type="button" class="btn btn-primary">{gt text='Primary'}</button>
                                        <button type="button" class="btn btn-success">{gt text='Success'}</button>
                                        <button type="button" class="btn btn-info">{gt text='Info'}</button>
                                        <button type="button" class="btn btn-warning">{gt text='Warning'}</button>
                                        <button type="button" class="btn btn-danger">{gt text='Danger'}</button>
                                        <button type="button" class="btn btn-link">{gt text='Link'}</button>
                                    </p>

                                    <p><button type="button" class="btn btn-primary btn-lg btn-block">{gt text='Block level button'}</button></p>

                                    <div class="page-header">
                                        <h3>{gt text='Active state'}</h3>
                                    </div>

                                    <p>
                                        <button type="button" class="btn btn-primary btn-lg active">{gt text='Primary button'}</button>
                                        <button type="button" class="btn btn-default btn-lg active">{gt text='Button'}</button>
                                        <a href="#" class="btn btn-info btn-lg active" role="button">{gt text='Link'}</a>
                                    </p>

                                    <div class="page-header">
                                        <h3>{gt text='Disabled state'}</h3>
                                    </div>

                                    <p>
                                        <button type="button" class="btn btn-lg btn-primary" disabled="disabled">{gt text='Primary button'}</button>
                                        <button type="button" class="btn btn-default btn-lg" disabled="disabled">{gt text='Button'}</button>
                                        <a href="#" class="btn btn-info btn-lg disabled" role="button">{gt text='Disabled link'}</a>
                                    </p>
                                    <p>
                                        {gettext}This class will only change the <code>&lt;a&gt;</code>'s appearance, not its functionality. Use custom JavaScript to disable them.{/gettext}
                                    </p>

                                    <div class="page-header">
                                        <h3>{gt text='Button tags'}</h3>
                                        <p>{gettext}As a best practice, we highly recommend using the <code>&lt;button&gt;</code> element whenever possible to ensure matching cross-browser rendering.{/gettext}</p>
                                    </div>

                                    <p>
                                        <a class="btn btn-default" href="#" role="button">{gt text='Link'}</a>
                                        <button class="btn btn-default" type="submit">{gt text='Button'}</button>
                                        <input class="btn btn-default" type="button" value="Input">
                                        <input class="btn btn-default" type="submit" value="Submit">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: col1 -->

                    <aside class="col-md-3">
                        {*blockposition name='search'*}

                        <div class="bt-box">
                            {blockposition name='left'}
                            {blockposition name='right'}
                        </div>
                    </aside>
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

<script type="text/javascript">
jQuery(function () {
    var fs = jQuery('body').css('font-size');
    var lh = jQuery('body').css('line-height');
    lh = (parseInt(lh)/parseInt(fs)).toFixed(3)
    jQuery('#bt-fs').text(fs);
    jQuery('#bt-lh').text(lh);

    jQuery('#btextabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
});
</script>
<script type="text/javascript" src="{$themepath}/Resources/public/js/holderjs/holder.js"></script>