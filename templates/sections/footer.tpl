
<div class="row">
    <div class="col-md-7">
        {if $btconfig.bottomnav eq 1}
            {blockposition name='bottomnav'}
        {else}
            <a href="{modurl modname='News' type='user' func='view' theme='RSS'}" title="RSS"><img src="{$imagepath}/icons/rss.png" alt="RSS" width="14" height="14" /> RSS</a>
            <span class="text-separator">|</span>
            <a href="{modurl modname='News' type='user' func='view' theme='Atom'}" title="Atom"><img src="{$imagepath}/icons/atom.png" alt="Atom" width="14" height="14" /> Atom</a>
            <span class="text-separator">|</span>
            <a href="{modurl modname='Legal' type='user' func='main'}" title="{gt text='Terms of use'}">{gt text='Terms of use'}</a>
            <span class="text-separator">|</span>
            <a href="{modurl modname='Formicula' type='user' func='main'}" title="{gt text='Contact'}">{gt text='Contact'}</a>
            {*
            <span class="text-separator">|</span>
            <a href="#header" title="{gt text='Back to top'}">{gt text='Back to top'}</a>
            *}
        {/if}

        <p id="footer-sublinks">
            &copy; {'Y'|date} {$modvars.ZConfig.sitename}.
            &nbsp;&nbsp;&nbsp;
            <a href="http://zikula.org/" title="{gt text='Powered by Zikula'}">Zikula</a>
            <span class="text-separator">|</span>
            <a href="http://getbootstrap.com/" title="{gt text='Layout supported by Bootstrap'}">Bootstrap</a>

            {if $serviceManager.development}
                {* displays validators links only on development mode *}
                <span class="text-separator">|</span>
                <a href="http://jigsaw.w3.org/css-validator/check/referer" title="{gt text='CSS Validator'}">CSS</a>
                <span class="text-separator">|</span>
                <a href="http://validator.w3.org/check?uri=referer" title="{gt text='HTML Validator'}">XHTML</a>
            {/if}
        </p>
    </div>
    <div class="col-md-5">
        {* default styles of footer block is float: right *}
        {if $btconfig.footer eq 1}
            {blockposition name='footer'}
        {/if}
    </div>
</div>

{blankutil section='footer'}
