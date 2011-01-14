<?php 
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();
	
function uninstall() {	
	delete_option('snytaxify_global_css');
	//delete_option('SYNTAXIFY_LINE_NUMBERS');
}

uninstall();

?>