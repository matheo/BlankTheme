
# CHANGELOG

## Version 1.3.7

* BlankTheme moved to Bootstrap and restructured for Zikula 1.3.7
* Added the `home` body template as example of bootstrap cover homepage
* Added the `blankmobile` plugin to add a CSS class according the device
* Cleaned `admin.css` and unified all the styles on `style.css`
* Removed the deprecated stuff by the Bootstrap grid
* Relicensed to MIT

## Version 1.3.5

* Removed `fullheight` body template
* Reworked `fullwidth` template to `full2col` and `full3col`
* Moved all the site specific styles to the end of `typography.css`

## Version 1.3

* Upgraded to work with Zikula 1.3+
* Updated admin links according Zikula 1.3 changes
* INI files are noe in charge of everything, over the unique master.tpl
* Theme Variables rework according 1.3 capabilities
* CSS files reordered on the `/css` folder to avoid module override clashes
* Template files renamed to TPL
* Context templates moved to the root folder, moving head footer to `/views/sections`
* Added `fullheight` and `fullwidth` body templates

## Version 1.0

* Removed deprecated stuff
* `#bt_topnavlinks` now it's controlled from `blankthemeutil`
* Admin menu extended
* Rename to BlankTheme

## Version 0.9

* Added the `nc` zone (no-center) to disable center blocks
* Improvements in the inline documentation
* Layout notation was changed from `lcr|clr|lc` to `213|123|21`
* Adminmenu options and colors improvement
* Now the body ID is the `$modname` and the current layout is a class

## Version 0.8

* Menu plugins checks for module availability
* `E_ALL` errors fixes in the menu plugins

Detailed log available here:  
https://github.com/matheo/BlankTheme/commits/master
