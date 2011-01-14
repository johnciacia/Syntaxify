=== Plugin Name ===
Contributors: sidewindernet
Tags: syntax, highlight, code
Requires at least: 2.8
Tested up to: 3.1
Stable tag: 1.4

This plugin allows users to highlight code.

== Description ==

This plugin enables you to highlight syntax using the PEAR Text_Highlighter class. Other syntax highlighters that use GeSHi have slower rendering speeds which will increase your page load time. However, this plugin gives you the speed and efficiency provided by the PEAR developers. You even have the option of enabling or disabling the line numbers as well as specifying your own style.


== Installation ==

1. Download ionhighlight.zip and unzip it.
2. Upload the plugin folder to wp-content/plugins/ and activate from the Plugin administrative menu.

== Frequently Asked Questions ==

= How do I highlight my code? =
You can use the [code][/code] bbtags. Simply place your code between the tags and your code will be highlighted. You may also specify one of the supported languages by using the lang parameter - [code lang="PHP"][/code]

= How do I enable/disable line numbers? =
Under the settings menu click on the Syntax Highlighter link. From there either select "Yes" or "No" to the Line Numbers option.

= Characters are being converted to their HTML entities =
This is because you have entered your code in Visual mode. You must enter your code in HTML mode.

= This plugin breaks my XHTML validation. =
This plugin encapsulates code using div tags. Div is a block element and cannot be placed inside an inline element. This is probably causing your validation to break. If you place [code] tags inline, you are placing them inside a <p> which is an inline element. This causes your validation to break. Therefor you must place [code] tags on a line by itself. For example:
BAD
    This is hello world in PHP: [code]<?php echo "Hello World"; ?>[/code]
GOOD
    This is hello world in PHP: 
    [code]<?php echo "Hello World"; ?>[/code]
