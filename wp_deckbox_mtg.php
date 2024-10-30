<?php
/**
 * @package MtgpulseDeckbox
 * @author Per Stilling
 * @version 1.0.0
 */
/*
Plugin Name: Mtgpulse deckboxes
Plugin URI: http://mtgpulse.com
Description: Display MTGPulse.com decks on your word press site
Author: Per Stilling
Version: 1.0.3
Author URI: http://mtgpulse.com
*/


function mtgpulsedeckbox_register_button($buttons) {
   array_push($buttons, "separator", "mtgpulsedeckbox", "mtgpulsedeckboxcustom");
   return $buttons;
}

function mtgpulsedeckbox_add_tinymce_plugin($plugin_array) {
   $plugin_array['mtgpulsedeckbox'] = get_bloginfo('wpurl') . '/wp-content/plugins/mtgpulse-deckbox/resources/tinymce3/editor_plugin.js';
   return $plugin_array;
}

function mtgpulsedeckbox_parse($atts, $content=null, $code="") {
	$options = get_option('deckbox-options');
	extract(shortcode_atts(array(
		'did' => '1381',
		'size' => isset($options["deckbox-size"])?$options["deckbox-size"]:"normal",
		'width' => isset($options["deckbox-width"])?$options["deckbox-width"]:"800",
		'bgcolor' => isset($options["deckbox-bgcolor"])?$options["deckbox-bgcolor"]:"FFFFFF"
	), $atts));
	return "<script type=\"text/javascript\" src=\"http://mtgpulse.com/embeddeck.php?size={$size}&did={$did}&width={$width}&bgcolor={$bgcolor}\"></script>";
}

function mtgpulsedeckboxdeckboxcustom_parse($atts, $content, $code="") {
	$options = get_option('deckbox-options');
	extract(shortcode_atts(array(
		'name' => ' ',
		'size' => isset($options["deckbox-size"])?$options["deckbox-size"]:"normal",
		'width' => isset($options["deckbox-width"])?$options["deckbox-width"]:"800",
		'bgcolor' => isset($options["deckbox-bgcolor"])?$options["deckbox-bgcolor"]:"FFFFFF"
	), $atts));
	
	$content = str_replace(array("<p>", "</p>", "<br/>", "&nbsp;", "<br />", "SB:"), array("", "", "", "", "", "\r\n\r\n"), $content);

	$content = str_replace("\r\n\r\n", "||", $content);
	$content = str_replace("\n\n", "||", $content);

	$content = str_replace("\r\n", "|", $content);
	$content = str_replace("\n", "|", $content);

	$content = str_replace("|||", "||", $content);
	$content = str_replace("||||", "||", $content);
	$content = str_replace("|||||", "||", $content);
	
	
	return "<script type=\"text/javascript\" src=\"http://mtgpulse.com/embeddeck.php?size={$size}&width={$width}&bgcolor={$bgcolor}&name={$name}&cards={$content}\"></script>";
}

function mtgpulsedeckbox_add_buttons() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "mtgpulsedeckbox_add_tinymce_plugin");
     add_filter('mce_buttons', 'mtgpulsedeckbox_register_button');
   }
}



add_action('init', 'mtgpulsedeckbox_add_buttons');
add_shortcode('deckbox', 'mtgpulsedeckbox_parse');
add_shortcode('deckboxcustom', 'mtgpulsedeckboxdeckboxcustom_parse');
add_action('admin_menu', 'deckbox_createmenu');
add_action( 'admin_init', 'register_deckbox_settings' );

function deckbox_createmenu() {
	add_options_page('MTGPulse deckbox settings', 'Deckbox settings', 'manage_options', 'mtgpulsedeckbox', 'deckbox_settings_page');
}

function deckbox_settings_page() {
?>
<div>
<h2>MTGPulse plug-in settings</h2>
This page let's you define default settings for the MTGPulse deckbox plug in
<form action="options.php" method="post">
<?php settings_fields('mtgpulsedeckbox'); ?>
<?php do_settings_sections('mtgpulsedeckbox'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
<?php }

function register_deckbox_settings() {
	register_setting( 'mtgpulsedeckbox', 'deckbox-options' , 'plugin_options_validate');
	
	add_settings_section('mtgpulsedeckbox_1st_section', 'General settings', 'plugin_section_text', 'mtgpulsedeckbox');
	add_settings_field('deckbox-size-field', 'Default size (small or normal)', 'plugin_setting_size', 'mtgpulsedeckbox', 'mtgpulsedeckbox_1st_section');
	add_settings_field('deckbox-width-field', 'Default width (0-9999)', 'plugin_setting_width', 'mtgpulsedeckbox', 'mtgpulsedeckbox_1st_section');
	add_settings_field('deckbox-bgcolor-field', 'Default bgcolor (hex e.g. CCCCCC)', 'plugin_setting_bgcolor', 'mtgpulsedeckbox', 'mtgpulsedeckbox_1st_section');
}

function plugin_section_text() {
	echo '';
}

function plugin_setting_size() {
	$options = get_option('deckbox-options');
	echo "<input id='deckbox-size-field' name='deckbox-options[deckbox-size]' size='40' type='text' value='{$options['deckbox-size']}' />";
}

function plugin_setting_width() {
	$options = get_option('deckbox-options');
	echo "<input id='deckbox-size-field' name='deckbox-options[deckbox-width]' size='40' type='text' value='{$options['deckbox-width']}' />";
}

function plugin_setting_bgcolor() {
	$options = get_option('deckbox-options');
	echo "<input id='deckbox-size-field' name='deckbox-options[deckbox-bgcolor]' size='40' type='text' value='{$options['deckbox-bgcolor']}' />";
}

function plugin_options_validate($input) {
	/*$newinput['deckbox-size'] = trim($input['deckbox-size']);
	if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['deckbox-size'])) {
	$newinput['deckbox-size'] = '';
	}*/
	return $input;
}


