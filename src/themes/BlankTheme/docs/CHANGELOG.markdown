
# CHANGELOG

## Version 1.3.3
* YAML updated to 4.0.1
* Removed fullheight body template

## Version 1.3

* Upgraded to work with Zikula 1.3+
* Updated admin links according Zikula 1.3 changes
* YAML upgraded to the 3.3 version
* INI files are noe in charge of everything, over the unique master.tpl
* Theme Variables rework according 1.3 capabilities
* CSS files reordered on the /style folder to avoid module override clashes
* Template files renamed to TPL
* Context templates moved to the root folder, moving head footer to /templates/sections
* Added fullheight and fullwidth body templates

## Version 1.0

* YAML upgraded to the 3.2.1 version
* Removed deprecated stuff
* `#bt_topnavlinks` now it's controlled from `bt_htmloutput`
* Admin menu extended
* Rename to BlankTheme

## Version 0.9
* YAML upgraded to the 3.1 version
* Major improvements in the theme flexibility/adaptability
* Added the 'nc' zone (no-center) to disable center blocks
* Improvements in the inline documentation
* Layout notation was changed from lcr|clr|lc to 213|123|21
* EFA fontSize on/off theme variable added
* Adminmenu options and colors improvement
* Adminmenu now is a CSSplay based menu
* Now the body ID is the $modname and the current layout is a class

## Version 0.8
* Menu plugins checks for module availability
* YAML styles `basemod_*` files ordered in a consistent way
* `E_ALL` errors fixes in the menu plugins 

Detailed log available here:  
https://github.com/matheo/BlankTheme/commits/master
