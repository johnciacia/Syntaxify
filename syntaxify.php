<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/*
Plugin Name: Syntaxify
Description: Provides functionality to perform syntax highlighting for different file formats.
Version: 1.4
Author: John Ciacia
Author URI: http://www.johnciacia.com/


Copyright 2009  John Ciacia  (email : software@johnciacia.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/** 
 * If the PEAR package Text_Highlighter is not installed there is a version
 * of the package included with this plugin. $pear_dir is the location of 
 * this package.
 */
$pear_dir = WP_PLUGIN_DIR . '/syntaxify';

if( is_dir( $pear_dir ) )
    ini_set( "include_path", ini_get( "include_path" ) . PATH_SEPARATOR . $pear_dir );

/**
 * With Text_Highlighter it is possible to create syntax highlighted 
 * versions of different file formats. The supportedfile formats are: 
 * ABAP, C++, CSS, DTD, HTML, Java, JavaScript, MySQL, Perl, PHP, Python, 
 * Ruby, sh, SQL, VBScript, and XML.
 */
require_once( "Text/Highlighter.php" );
/**
 * There are different options for getting the results of the highlighting, 
 * through the use of renderers. This plugin uses the HTML renderer to
 * output the content using span-tags containing a CSS class name. 
 */
require_once( "Text/Highlighter/Renderer/Html.php" );


$syntaxify = new Syntaxify();

/**
*
*/
add_action('init', array(&$syntaxify, 'init'));
/**
*
*/
add_action('admin_menu', array(&$syntaxify, 'admin_menu'));
/**
*
*/
add_shortcode('code', array(&$syntaxify, 'code'));
/**
*
*/
if(remove_filter('the_content','do_shortcode', 11))
    add_filter('the_content','do_shortcode',9);
/**
*
*/   
remove_filter( 'the_content', 'convert_smilies');
/**
*
*/   
register_activation_hook(__FILE__, array(&$syntaxify , 'install'));

class Syntaxify {

  var $renderer = NULL;
  
  function init()
  {
    if(get_option('syntaxify_global_css') == "true") {
      wp_register_style('syntaxify', WP_PLUGIN_URL . '/syntaxify/style.css');		
      wp_enqueue_style('syntaxify');
    }
    
  }
  
  function admin_menu()
  {
    add_options_page('Syntaxify Options', 'Syntaxify', 'manage_options', 'syntaxify-settings', array(&$this, 'settings'));
  }
  
  function settings()
  {
    require_once('settings.php');
  }
  
  function install()
  {
    add_option("syntaxify_global_css", "true");
  }
  
  
  function code($atts, $content = null) 
  {
  
    $this->renderer =& new Text_Highlighter_Renderer_Html(array( "numbers" => FALSE, "tabsize" => 4));

		extract(shortcode_atts(array(
			'lang' => 'PHP'
		), $atts));

		
    if(is_single()) {
      $renderer = $this->renderer;
    } else {
      $renderer =& new Text_Highlighter_Renderer_Html(array( "tabsize" => 4 ) );
    }

    $hl =& Text_Highlighter::factory( $lang );
    $hl->setRenderer( $renderer );
    $output = '<div class="syntaxify">' . $hl->highlight($content) . '</div>';
    
    return $output;
    
  }


}

?>