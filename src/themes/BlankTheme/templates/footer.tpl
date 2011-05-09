{*
     * Note:
     * If you want to remove the YAML backlink,
     * please check the YAML license conditions:
     * http://www.yaml.de/en/license/license-conditions.html
*}
        <a href="{modurl modname='News' type='user' func='view' theme='RSS'}" title="RSS"><img src="{$imagepath}/icons/rss.png" alt="RSS" width="14" height="14" /> RSS</a>
        <span class="text_separator">|</span>
        <a href="{modurl modname='News' type='user' func='view' theme='Atom'}" title="Atom"><img src="{$imagepath}/icons/atom.png" alt="Atom" width="14" height="14" /> Atom</a>
        <span class="text_separator">|</span>
        <a href="{modurl modname='Legal'}" title="{gt text='Terms of use'}">{gt text='Terms of use'}</a>
        <span class="text_separator">|</span>
        <a href="{modurl modname='Formicula'}" title="{gt text='Contact'}">{gt text='Contact'}</a>
        <span class="text_separator">|</span>
        <a href="#header" title="{gt text='Back to top'}">{gt text='Back to top'}</a>
        <br />
        &copy; {'Y'|date} <a href="{$baseurl}">{$modvars.ZConfig.sitename}</a>.
        &nbsp;&nbsp;&nbsp;
        <a href="http://community.zikula.org/" title="{gt text='Powered by Zikula'}">Zikula</a>
        <span class="text_separator">|</span>
        <a href="http://www.yaml.de/" title="{gt text='Layout based on YAML'}">YAML</a>
        <span class="text_separator">|</span>
        <a href="http://jigsaw.w3.org/css-validator/check/referer" title="{gt text='Valid CSS'}">CSS</a>
        <span class="text_separator">|</span>
        <a href="http://validator.w3.org/check?uri=referer" title="{gt text='Valid XHTML'}">XHTML</a>