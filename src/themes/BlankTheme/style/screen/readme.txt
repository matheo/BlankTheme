
  This directory contains the main stylesheets that can be adapted for your site.

  - basemod.css deals with positioning and geometry of the various layout elements.
  - content.css deals with the visual styling (coloring, fonts, etc) and contains the Zikula specific styles.


  Once the development is ready you can combine the two stylesheets into 1 for less HTTP requests and thus faster websites.
  You need to adapt the layout_2col.css and the others one directory level higher.
  You might also consider to minify you stylesheets with YUI compressor.
  This reduces the bandwidth of your website.

  You can also enable the optimize flag in the bt_htmloutput call, on the head.htm template,
  to not use the layout_* stylesheets but load the core stylesheets directly without.
  You can also customize the PHP code of the bt_htmloutput plugin.

  E.Spaan
  12 May 2009
