
# views/body

This folder stores the templates responsible of the different body possibilities.

Each one supports one or more layouts, usable from each section template
through different $body and $layout combinations. The naming convention used for the columns is the following:

- col1 (`.bt-col1`): the main column with $maincontent
- col2 (`.bt-col2`): secondary column with left blocks
- col3 (`.bt-col3`): tertiary column with right blocks

Let's see which advantages offers the default bodies:

## 2col

body template to support 1 and 2 column layouts

* Includes the '2cb' (2subcolumns-at-center-bottom) to subdivide the main column;
  using the [centerbl] and [centerbr] block positions.
* Supported distributions: '21', '12', '31', '13' and also '1' to only have the main column

## 3col

body template to support 3 column layouts

* Additionaly to '2cb' this template includes another zone 'cb' at the bottom of the previous one;
  The 'cb' zone uses the [bottom] block position.
* Supported distributions: '213', '312', '123', '132', '231', '321'.

## grid

Uses the Bootstrap grid system like the flexible grids example to build the layout

* Is able to switch the side columns with the distributions: '123', '132', '12', '13'
* Also supports the '3b' zone (3subcolumnsat-bottom)
  and uses the [bottoml]. [bottomc] and [bottomr] block positions

## full2col

A 2col derivation changing the HTML structure of the template to get a full width layout

* As 2col, supports the '2cb' zone only

## full3col

A 3col derivation changing the HTML structure of the template to get a full width layout

* As 3col, supports the '2cb' and 'cb' zones


All of them also supports the additional zone 'nc' (no-center) to disable the [center] blocks
