
  This directory contains the main stylesheets that can be adapted for your site.

  - navigation.css deals with the navigation menus and their related elements
  - screen.css deals with positioning and geometry of the various layout elements.
  - typography.css deals with the visual styling (coloring, fonts, etc) and contains the Zikula specific styles.

  Once the development is ready you can combine the two stylesheets into 1 for less HTTP requests and thus faster websites.
  You need to adapt the `layout_2col.css` and the others one directory level higher.

  You can also enable the optimize flag in the `themevariables.ini`, to not use the `layout_*` stylesheets
  but load the core stylesheets directly without it and save requests to the server.
  You can also customize the PHP code of the `bt_htmloutput` plugin if you have PHP basis.

  You might also consider to minify you stylesheets with YUI compressor or enable the Zikula minifier.
  This reduces the bandwidth of your website.
