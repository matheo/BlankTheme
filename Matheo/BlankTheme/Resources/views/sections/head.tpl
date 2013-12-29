<head>

<meta charset="{charset}" />
<title>{pagegetvar name='title'}</title>

<!-- Mobile viewport optimisation -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="description" content="{$metatags.description}" />
<meta name="keywords" content="{$metatags.keywords}" />
<meta name="author" content="{$modvars.ZConfig.sitename}" />
<meta name="copyright" content="Copyright (c) {'Y'|date} by {$modvars.ZConfig.sitename}" />
<meta name="robots" content="index,follow" />
<meta name="generator" content="Zikula - www.zikula.org" />

<link rel="alternate" href="{modurl modname='News' type='user' func='view' theme='RSS'}" type="application/rss+xml" title="{$modvars.ZConfig.sitename}" />
<link rel="icon" type="image/x-icon" href="{$imagepath}/favicon.ico" /> {* W3C *}
<link rel="shortcut icon" type="image/ico" href="{$imagepath}/favicon.ico" /> {* IE *}

{blankutil section='head'}

<!-- pagevars -->

{browserhack condition='if lt IE 9'}
<script src="{$themepath}/Resources/public/js/html5shiv/html5shiv.js"></script>
<script src="{$themepath}/Resources/public/js/respondjs/respond.min.js"></script>
{/browserhack}

{*browserhack condition='if lt IE 9'}
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
{/browserhack*}
</head>
