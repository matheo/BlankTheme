
  This directory contains the main stylesheets that can be adapted for your site.

  - navigation.css deals with the navigation menus and their related elements
  - screen.css deals with positioning and geometry of the various layout elements.
  - typography.css deals with the visual styling (coloring, fonts, etc) and contains the Zikula specific styles.

  Once the development is ready you can combine the two stylesheets into 1 for less HTTP requests and thus faster websites.
  You need to adapt the `layout_2col.css` and the others in the /style directory.

  You can also configure the theme to not use the `layout_*` stylesheets (`themevariables.ini`)
  but load the core stylesheets directly without it and save one request to the server.
  You can also customize the PHP code of the `blankutil` plugin if you have PHP knowledge.

  You might also consider to minify your stylesheets with YUI compressor or enable the Zikula minifier.
  This reduces the bandwidth of your website.
