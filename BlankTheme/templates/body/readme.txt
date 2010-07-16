This folder stores the templates responsible of the different body possibilities.

Each one supports one or more layouts, usable from each section template
through different $body and $layout combinations.
Let's see which advantages offers the default ones:

2col:
body template to support 2 and 1 column layouts
#col1 is static and #col1 and #col3 are floating columns
* Easy width change in the basemod from 25% to any fluid or fixed value.
* Includes the '2cb' (2subcolumnsat-center-bottom) to subdivide the main column;
  using the [centerbl] and [centerbr] block positions.
* Supported distributions: '21', '12', '31', '13' and also '1' to only have the main column

3col:
body template to support 3 column layouts
all the columns are floating
* Easy changeable from fixed width values to fluid ones.
* Additionaly to '2cb' this template includes another zone 'cb' at the bottom of the previous one;
  The 'cb' zone uses the [bottom] block position.
* Supported distributions: '213', '312', '123', '132', '231', '321'.

3col231:
3col derivation with the #col1 at the end of the #main container to use #col1 static
* Static main column to have fixed side columns but fluid main content
* Same features that 3 col, but only supports the distributions '213' and '312' 

grid:
uses the YAMl subtemplates like the flexible grids example to build the layout
* Is able to switch the side columns with the distributions: '123', '132', '12', '13'
* Also supports the '3b' zone (3subcolumnsat-bottom)
  and uses the [bottoml]. [bottomc] and [bottomr] block positions

 
All of them also supports the additional zone 'nc' (no-center) to disable the [center] blocks
