<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
 
function photolistic_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'photolistic');
	$sections['txt_section'] 		= __('General Settings', 'photolistic');
	//$sections['txtarea_section'] 	= __('Textarea Form Fields', 'photolistic');
	//$sections['select_section'] 	= __('Select Form Fields', 'photolistic');
	//$sections['checkbox_section'] 	= __('Checkbox Form Fields', 'photolistic');
	
	return $sections;	
} 


/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function photolistic_options_page_fields() {
	// Text Form Fields section
	$options[] = array(
		"section" => "txt_section",
		"id"      => photolistic_SHORTNAME . "_featured_txt",
		"title"   => __( 'Featured Text - Some HTML OK!', 'photolistic' ),
		"desc"    => __( 'Write something that describes what you do. You can use some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'photolistic' ),
		"type"    => "text",
		"std"     => __('You can change this text in the Theme Options.','photolistic')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => photolistic_SHORTNAME . "_featured_posts_nr",
		"title"   => __( 'Number of featured posts in the homepage', 'wptuts_textdomain' ),
		"desc"    => __( 'Write a number. Default is 3.', 'wptuts_textdomain' ),
		"type"    => "text",
		"std"     => "3",
		"class"   => "numeric"
	);
		
	return $options;	
}

