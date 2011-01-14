<?php

if(!is_admin()) {
  wp_die(__('Begone'));
}
?>


<div class="wrap">
<h2>Syntaxify</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<p>To reduce HTTP requests, you can disable the inclusion of the stylesheet included with this plugin, and define the styles in your themes style.css file. If you choose to define your own styles, you can copy the styles template from <a href="<?php echo WP_PLUGIN_URL . '/syntaxify/style.css' ?>"><?php echo WP_PLUGIN_DIR . '/syntaxify/style.css' ?></a></p>

<?php
if(get_option('syntaxify_global_css') == "true") {
  echo '<input type="radio" name="syntaxify_global_css" value="true" checked="checked"/> Yes (use css provided with plugin)<br />';
  echo '<input type="radio" name="syntaxify_global_css" value="false" /> No (use themes style.css)';
} else {
  echo '<input type="radio" name="syntaxify_global_css" value="true" /> Yes (use css provided with plugin)<br />';
  echo '<input type="radio" name="syntaxify_global_css" value="false" checked="checked" /> No (use themes style.css)';
}

?>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="syntaxify_global_css" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>