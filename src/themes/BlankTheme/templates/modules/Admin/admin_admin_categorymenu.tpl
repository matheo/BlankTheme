{ajaxheader modname='Admin' filename='admin_admin_ajax.js' ui=true}

<script type="text/javascript">
    /* <![CDATA[ */
    var lblclickToEdit = "{{gt text='Right-click down arrows to edit tab name'}}";
    var lblEdit = "{{gt text='Edit category'}}";
    var lblDelete = "{{gt text='Delete category'}}";
    var lblMakeDefault = "{{gt text='Make default category'}}";
    var lblSaving = "{{gt text='Saving'}}";
    /* ]]> */
</script>

<div class="z-admin-breadcrumbs">
    <span class="z-sub">{gt text='You are in:'}</span>
    <span class="z-breadcrumb"><a href="{modurl modname='Admin' type='admin' func='adminpanel'}">{gt text='Administration'}</a></span>

    <span class="z-sub">&raquo;</span>
    {if $func neq 'adminpanel'}
        <span class="z-breadcrumb"><a href="{modurl modname='Admin' type='admin' func='adminpanel' acid=$currentcat}">{$menuoptions.$currentcat.title|safetext}</a></span>
    {else}
        <span class="z-breadcrumb">{$menuoptions.$currentcat.title|safetext}</span>
    {/if}

    {if $func neq 'adminpanel'}
        <span class="z-sub">&raquo;</span>
        {foreach from=$menuoptions.$currentcat.items item='moditem'}
            {if $toplevelmodule eq $moditem.modname}
                <span class="z-breadcrumb"><a href="{modurl modname=$toplevelmodule type='admin' func='main'}" class="z-admin-pagemodule">{$moditem.menutext|safetext}</a></span>
                {break}
            {/if}
        {/foreach}

        {if $func neq 'main'}
            <span class="z-sub">&raquo;</span>
            <span class="z-breadcrumb" class="z-admin-pagefunc">{$func|safetext}</span>
        {/if}
    {/if}
</div>

<div id="admin-systemnotices">
{include file='admin_admin_securityanalyzer.tpl'}
{include file='admin_admin_developernotices.tpl'}
{include file='admin_admin_updatechecker.tpl'}
</div>

{insert name="getstatusmsg"}

<div class="ym-column linearize-level-1"> {* closed by admin.tpl *}
    <div class="ym-col1">

<div class="admintabs-container" id="admintabs-container">
    <ul class="clearfix" id="admintabs">
        {foreach from=$menuoptions name='menuoption' item='menuoption'}
        <li id="admintab_{$menuoption.cid}" class="floatbox admintab {if $currentcat eq $menuoption.cid} active{/if}" style="z-index:{if $currentcat eq $menuoption.cid}1{else}0{/if};">
            <span id="catcontext{$menuoption.cid}" class="z-admindrop">&nbsp;</span>
            <a id="C{$menuoption.cid}" href="{$menuoption.url|safetext}" title="{$menuoption.description|safetext}">{$menuoption.title|safetext}</a>

            <script type="text/javascript">
            /* <![CDATA[ */
                var context_catcontext{{$menuoption.cid}} = new Control.ContextMenu('catcontext{{$menuoption.cid}}',{
                    leftClick: true,
                    animation: false
                });

                {{foreach from=$menuoption.items item=item}}
                    context_catcontext{{$menuoption.cid}}.addItem({
                        label: '{{$item.menutext|safetext}}',
                        callback: function(){window.location = '{{$item.menutexturl}}';}
                    });
                {{/foreach}}

            /* ]]> */
            </script>

        </li>
        {/foreach}
        <li id="addcat" class="floatbox">
            <a id="addcatlink" href="{modurl modname=Admin type=admin func=new}" title="{gt text='New module category'}" onclick='return Admin.Category.New(this);'>&nbsp;</a>
        </li>
    </ul>

    {helplink}
    {include file='admin_admin_ajaxAddCategory.tpl'}
</div>

<div class="z-hide" id="admintabs-none"></div>

    </div>

    <!-- begin: #col1 - main column -->
    <div class="ym-col2"> {* closed by admin.tpl *}
        <div class="ym-cbox ym-contain-oh"> {* closed by admin.tpl *}
