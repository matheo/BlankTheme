<head>

<meta charset="{charset}" />
<title>{pagegetvar name='title'}</title>

<!-- Mobile viewport optimisation -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="{$metatags.description}" />
<meta name="keywords" content="{$metatags.keywords}" />
<meta name="Author" content="{$modvars.ZConfig.sitename}" />
<meta name="Copyright" content="Copyright (c) {'Y'|date} by {$modvars.ZConfig.sitename}" />
<meta name="Robots" content="index,follow" />
<meta name="Generator" content="Zikula - www.zikula.org" />
<meta http-equiv="X-UA-Compatible" content="chrome=1" />

<link rel="alternate" href="{modurl modname='News' type='user' func='view' theme='RSS'}" type="application/rss+xml" title="{$modvars.ZConfig.sitename}" />
<link rel="icon" type="image/x-icon" href="{$imagepath}/favicon.ico" /> {* W3C *}
<link rel="shortcut icon" type="image/ico" href="{$imagepath}/favicon.ico" /> {* IE *}

<!-- pagevars -->
{bt_htmloutput section='head'}
{browserhack condition='if lt IE 9'}<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>{/browserhack}
</head>
