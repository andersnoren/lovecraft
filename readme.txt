=== Lovecraft ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.5
Tested up to: 5.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Licenses ==

Lato
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Lato

Playfair Display
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Playfair+Display

Genericon font icon set
License: GNU GPL 2.0
Source: http://genericons.com

Included header image
License: CC0 Public Domain 
Source: http://www.unsplash.com

screenshot.png images
License: CC0 Public Domain 
Source: http://www.unsplash.com

Doubletaptogo.js
License: MIT License
Source: https://github.com/dachcom-digital/jquery-doubletaptogo


== Changelog ==

Version 2.0.0 (2020-05-22)
-------------------------
- Updated "Tested up to" to 5.4.1.
- Updated "Requires at least" to 4.5, since Lovecraft is now using `custom_logo`.
- Removed the Flickr widget, since the API it was using will be deprecated by Flickr.
- Cleaned up widgets, made them pluggable, fixed escaping.
- Updated the folder structure to include the `/inc/` and `/assets/` folders at the root.
- Removed `license.txt`.
- Minified `genericons.css` (unminified version is included as well).
- Minified `doubeltaptogo.js` (unminified version is included as well).
- Added unique id attributes to the search form.
- CSS: Reworked reset to inherit instead of reset.
- Replaced `<div class="clear"></div>` element with pseudo clearing.
- Removed all title attributes on links.
- Removed "Comments are closed" message in comments template.
- Added widget ID output to widget areas.
- Moved the archive navigation to `pagination.php`.
- Collected registration and deregistration of widgets in a single function.
- Removed unnecessary admin CSS.
- Renamed the "Regular" block editor font size to "Normal", to match expected block editor naming.
- Made block editor colors and font sizes target classes globally, rather than just in the `.post-content` wrapper.
- Added block editor colors to the block editor styles.
- Added theme version to enqueues.
- Cleanup of `functions.php`.
- Moved the Customizer class to `/inc/classes/class-lovecraft-customize.php`, made it pluggable.
- Updated the Customizer accent color styles to only be output if the accent color selected differs from the default.
- Removed live preview of Customizer settings.
- Added support for the core custom_logo setting, and updated the old lovecraft_logo setting to only be displayed if you already have a lovecraft_logo image set (thanks, @poena).
- CSS: Removed removal of outline.
- CSS: Default links to have underline, and to remove the underline on hover.
- Updated template files to use more semantic HTML5 elements.
- Made the old post content styles global, as part of the new "Element Base" CSS section.
- Collected the block styles in the new "Blocks" CSS section.
- Added base block margins.
- Updated block styles.
- Added styles to more inputs and button elements.
- Display sub menus on focus.
- Made the main menu more flexible in handling multi-line menu items.
- Added output of archive description to archive pages.
- Added the "Requires at least" and "Tested up to" fields to style.css.
- Fixed notice in the recent posts widget.
- Output `the_excerpt()` instead of `the_content()` when displaying search results.
- Updated block editor styles.
- Updated the style.css TOC.
- Changed the file format of the theme screenshot to JPG, reducing file size by ~400 KB.

Version 1.31 (2019-07-21)
-------------------------
- Updated "Tested up to"
- Added theme tags
- Added skip link
- Don't show the post thumbnail if the post is password protected
- Fixed font issues in the block editor styles

Version 1.30 (2019-04-13)
-------------------------
- Styling for select elements

Version 1.29 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.28 (2018-12-20)
-------------------------
- Combined index.php, archive.php, and search.php into index.php
- Combined content.php and content-aside.php into content.php
- Combined single.php and page.php into singular.php
- Updated the full width page template to use the same code as singular.php
- Fixed incorrect call of Lovecraft_Recent_Posts in fallback sidebar widgets
- Moved the post meta output into a function, to reduce duplicate code
- Removed output of unneccessary title attributes
- Added focus outline to link elements
- Changed the toggles to button elements
- Added screen reader text to the toggles

Version 1.27 (2018-12-07)
-------------------------
- Fixed Block Editor style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font

Version 1.26 (2018-11-30)
-------------------------
- Fixed Block Editor editor styles font being overwritten

Version 1.25 (2018-10-20)
-------------------------
- Updated with Block Editor support
	- Block Editor editor styles
	- Styling of Block Editor blocks
	- Custom Lovecraft Block Editor palette
	- Custom Lovecraft Block Editor typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description
- Removed the languages sub folder, since that is handled by WordPress.org

Version 1.24 (2018-05-24)
-------------------------
- Fixed output of cookie checkbox in comments
- Added missing paranthesis in image.php

Version 1.23 (2018-04-21)
-------------------------
- Fixed error in comments.php

Version 1.22 (2018-04-21)
-------------------------
- Added a Customizer setting for displaying the sidebar on tablet and mobile
- Fixed errors pointed out by Theme Sniffer
- Cleaned up the CSS a bit
- Code review with the Theme Sniffer WordPress-Extra ruleset

Version 1.21 (2018-01-21)
-------------------------
- Fixed layout issue with the website field label in the comment form in some browsers
- Added alt text to header image, extra escapes of values at output

Version 1.20 (2017-12-05)
-------------------------
- Fixed recent posts widget showing currently viewed post regardless of date

Version 1.19 (2017-12-03)
-------------------------
- Fixed bug caused by leftover code after update in recent posts widget
- Went back to full-length ternarys to prevent issue with older versions of PHP

Version 1.18 (2017-12-02)
-------------------------
- Updated to the new readme.txt format, with changelog.txt incorporated into it
- Added a demo link to the stylesheet theme description
- Added a deliberate dependency order to the stylesheet enqueueing
- Same for scripts enqueues
- Made all functions in functions.php pluggable
- Replaced a new WP_Query in widgets/recent-posts.php with a get_posts()
- Fixed genericons path
- Fixed notice in comments.php
- Changed closing element comment structure
- General code cleanup, improvements in readability
- Fixed potential overflow issue on mobile for the blog title and logo

Version 1.17 (2016-06-18)
-------------------------
- Added the new theme directory tags
- Added screen reader text

Version 1.16 (2015-08-11)
------------------------- 
- Added clearing divs after the post content on archive pages and single posts/pages
- Widgets now use the __construct() function in prep for WP 4.3
- Singular post titles now use the h1 element for SEO reasons
- Set the standard number of images in the Flickr widget to six
- Set the infinite handle button to antialiased

Version 1.15 (2014-04-07)
------------------------- 
- Replaced wp_print_styles() with wp_enqueue_styles() in functions.php

Version 1.14 (2014-03-23)
------------------------- 
- Renamed xx_XX.pot to lovecraft.pot
- Replaced doubletaptogo.min.js with doubletaptogo.js (non-minified)
- Removed the wp_is_mobile() function from functions.php
- Replaced get_stylesheet_directory_uri() with get_template_directory_uri() so that child themes load Genericons correctly

Version 1.13 (2014-03-09)
------------------------- 
- Added fallback widgets that are displayed in the sidebar if no widgets have been selected
– Added missing namespaces in widgets
– Updated the Swedish translation

Version 1.12 (2014-03-09)
------------------------- 
- Added validation for instances in widgets

Version 1.11 (2014-02-09)
------------------------- 
- Removed a duplicate title function causing the page title to be added twice to <title></title>

Version 1.10 (2014-01-29)
------------------------- 
- Added additional missing esc_attr() to widgets/flickr-widget.php

Version 1.09 (2014-01-29)
------------------------- 
- Added missing esc_attr() to widgets and header.php
- Replaced the query in widgets/recent-posts.php with a custom wp_query
- Wrapped the custom Read More text link in a paragraph element
- Optimized the comments respond form for subscribe checkboxes

Version 1.08 (2014-01-01)
------------------------- 
- Dialed up the contrast in the design
- Changed the layout of comments
- Made minor changes to the Swedish translation

Version 1.07 (2014-01-01)
------------------------- 
- Added support for the aside post format (sorry, theme reviewer)

Version 1.06 (2014-01-01)
------------------------- 
- Improved the styling of comments
- Added a missing element to the custom accent color function
- Broke promise on making the last update the last update before release

Version 1.05 (2014-01-01)
------------------------- 
- Improved the styling of the footer (last update before release, promise)

Version 1.04 (2014-01-01)
------------------------- 
- Fixed a bug in the title tag backwards compatibility code

Version 1.03 (2014-01-01)
------------------------- 
- Added support for the new title tag theme feature

Version 1.02 (2014-01-01)
------------------------- 
- Removed a misplaced comma in the theme meta information tags
- Removed a add_shortcode function

Version 1.01 (2014-01-01)
------------------------- 
- Added a sanitize_hex_color callback to the custom accent color control

Version 1.00 (2014-01-01)
------------------------- 