<?php
/*
Plugin Name: EW Gallery Plugin
Plugin URI: http://www.eastwestconsultinggroup.com/plugins
Description: The EW Gallery is a photo gallery plugin designed by <a href="http://www.eastwestconsultinggroup.com">East West Consulting Group, Inc.</a> that allows you to display multiple photo and video galleries on an index page with large thumbnails linked to gallery pages that display a Jssor slider.  Settings are available to adjust the index and slider to your website's layout and theme.  Development by Aziz Ahmed Chouhan.
Version:  1.0 Beta
Author: East West Consulting Group, Inc.
Author URI: http://www.eastwestconsultinggroup.com
License: GPLv2 (Open Source)
Copyright 2015  
*/


include_once('ew-meta-template.php');

include_once('ew_shortcodes.php');

add_action('init', 'load_ew_gallery_scripts');
function load_ew_gallery_scripts(){
	wp_enqueue_script( 'jquery' );
	//wp_register_script( 'custom_jquery_js',  plugins_url( 'js/jquery.js' , __FILE__ )  );
	//wp_enqueue_script( 'custom_jquery_js' );

	wp_register_script( 'custom_jssor_core_js',  plugins_url( 'js/jssor/jssor.core.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_jssor_core_js' );
	wp_register_script( 'custom_jssor_utils_js',  plugins_url( 'js/jssor/jssor.utils.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_jssor_utils_js' );
	wp_register_script( 'custom_jssor_slider_js',  plugins_url( 'js/jssor/jssor.slider.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_jssor_slider_js' );
	
	wp_register_script( 'custom_jssor_player_js',  plugins_url( 'js/jssor/jssor.player.ytiframe.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_jssor_player_js' );
	
	
	
	wp_register_script( 'custom_js',  plugins_url( 'js/custom_js.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_js' );
	
	wp_register_style( 'custom-ntad-style_css',  plugins_url( 'css/custom-ntad-style.css' , __FILE__ )  );
	wp_enqueue_style( 'custom-ntad-style_css' );
	
	wp_register_style( 'custom_custom_style_css',  plugins_url( 'css/custom_style.css' , __FILE__ )  );
	wp_enqueue_style( 'custom_custom_style_css' );
	
	}


	
add_action('admin_init', 'load_ew_gallery_admin_scripts');
function load_ew_gallery_admin_scripts(){
	
	wp_enqueue_script('jquery');
	
	if ( ! did_action( 'wp_enqueue_media' ) )
    	wp_enqueue_media();
	
	wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_register_script( 'custom_ntad_js',  plugins_url( 'js/ntad_script.js' , __FILE__ )  );
	wp_enqueue_script( 'custom_ntad_js' );
	
}

add_action( 'admin_enqueue_scripts', 'wp_enqueue_color_picker' );
function wp_enqueue_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-script', plugins_url('script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

	
add_action('admin_menu', 'ew_gallery_settings_submenu_page');

function ew_gallery_settings_submenu_page() {
	add_submenu_page( 'edit.php?post_type=ew_gallery', 'EW Gallery Settings', 'EW Gallery Settings',  'manage_options', 'ew_gallery_settings', 'ew_gallery_settings_callback' ); 
}

function add_new_ew_gallery_column($ew_gallery_columns) {
  $ew_gallery_columns['menu_order'] = "Gallery Order";
  return $ew_gallery_columns;
}
add_action('manage_edit-ew_gallery_columns', 'add_new_ew_gallery_column');



function ew_gallery_cpt_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'gallery_id' => __( 'Gallery Id' ),
		'menu_order' => __( 'Gallery Order' )
	);
	return $columns;
}

add_filter('manage_edit-ew_gallery_columns' , 'ew_gallery_cpt_columns');


add_action( 'manage_ew_gallery_posts_custom_column', 'my_manage_ew_gallery_columns', 10, 2 );
function my_manage_ew_gallery_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		case 'menu_order':
		  $order = $post->menu_order;
		  echo $order;
		  break;
		case 'gallery_id' :
				echo $post_id; 
			break;
		default :
			break;
	}
}





function ew_gallery_settings_callback(){

	echo '<div class="wrap"><h2>EW Gallery Settings</h2>';
?>
<style type="text/css">
.meta-input { width:75%; }
</style>
<?php	
	
	$ew_gallery_settings_meta_boxes = array(
		
		"Gallery Lists Styles" => array(
			'title'=>__('Gallery Index Settings'),
			'type'=>'header',
			'description'=>"",),
		
		"gal-lists Margin" => array(
			'title'=>__('Index Margin'),
			'name'=>'ewg-gallists-margin',
			'type'=>'inputtext',
			'default'=>'10px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),
		"gal-lists Padding" => array(
			'title'=>__('Index Padding'),
			'name'=>'ewg-gallists-padding',
			'type'=>'inputtext',
			'default'=>'10px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"gal-lists Alignment" => array(
			'title'=>__('Index Alignment'),
			'name'=>'ewg-gallists-alignment',
			'type'=>'combobox',
			'options' => array('Left','Center','Right'),
			'default'=>'Center',
			'description'=>"",
			'hr'=>'none'),	
				
		///////////////////////////////////////////////////////////////////////////
		"Gallery Image Styles" => array(
			'title'=>__('Gallery Thumbnail Settings'),
			'type'=>'header',
			'description'=>"",),	
		
		"Gallery Image - Thumbnail Width" => array(
			'title'=>__('Thumbnail Width (add Border Width x2)'),
			'name'=>'ewg-galimage-width',
			'type'=>'inputtext',
			'default'=>'150px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),
		"Gallery Image - Thumbnail Margin" => array(
			'title'=>__('Thumbnail Margin'),
			'name'=>'ewg-galimage-margin',
			'type'=>'inputtext',
			'default'=>'0px 5px 0px 0px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"Gallery Image - Thumbnail Padding" => array(
			'title'=>__('Thumbnail Padding'),
			'name'=>'ewg-galimage-padding',
			'type'=>'inputtext',
			'default'=>'0px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"Gallery Image - Thumbnail Alignment" => array(
			'title'=>__('Thumbnail Alignment'),
			'name'=>'ewg-galimage-alignment',
			'type'=>'combobox',			
			'options' => array('Left','Center','Right'),
			'default'=>'Center',
			'description'=>"",
			'hr'=>'none'),
		
		"Gallery Image - Thumbnail Border Style" => array(
			'title'=>__('Thumbnail Border Style'),
			'name'=>'ewg-galimage-border-style',
			'type'=>'combobox',
			'options' => array('Solid','Dotted','None'),
			'default'=>'Solid',
			'description'=>"",
			'hr'=>'none'),
		"Gallery Image - Thumbnail Border Width" => array(
			'title'=>__('Thumbnail Border Width'),
			'name'=>'ewg-galimage-border-width',
			'type'=>'inputtext',
			'default'=>'10px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),
		"Gallery Image - Thumbnail Border Color" => array(
			'title'=>__('Thumbnail Border Color'),
			'name'=>'ewg-galimage-border-color',
			'type'=>'colorbox',
			'default'=>'#CCCCCC',
			'description'=>"",
			'hr'=>'none'),
		"Gallery Image - Thumbnail Border Radius" => array(
			'title'=>__('Thumbnail Border Radius'),
			'name'=>'ewg-galimage-border-radius',
			'type'=>'inputtext',
			'default'=>'0px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),
			
		//////////////////////////////////////////////////////////////////////////
		"Slider Setting" => array(
			'title'=>__('Slider Settings'),
			'type'=>'header',
			'description'=>"",),
		
		"Slider - Slider Wrapper Width" => array(
			'title'=>__('Slider Wrapper Width'),
			'name'=>'ewg-slider-wrapper-width',
			'type'=>'inputtext',
			'default'=>'100%',
			'description'=>"i.e. 1024px or 100%, no semi-colons (;)",
			'hr'=>'none'),
		"Slider - Slider Wrapper Height" => array(
			'title'=>__('Slider Wrapper Height'),
			'name'=>'ewg-slider-height',
			'type'=>'inputtext',
			'default'=>'456px',
			'description'=>"i.e. 456px in px only (no % or em, no semi-colons (;))",
			'hr'=>'none'),	
		"Slider - Slider Width" => array(
			'title'=>__('Slider Width'),
			'name'=>'ewg-slider-width',
			'type'=>'inputtext',
			'default'=>'800px',
			'description'=>"i.e. 800px in px only (no % or em, no semi-colons (;))",
			'hr'=>'none'),		
		"Slider - Slider Image Height" => array(
			'title'=>__('Slider Image Height'),
			'name'=>'ewg-slider-height-thumbs',
			'type'=>'inputtext',
			'default'=>'356px',
			'description'=>"i.e. 356px or 100%, no semi-colons (;)",
			'hr'=>'none'),		
			
		"Slider - Slider Margin" => array(
			'title'=>__('Slider Margin'),
			'name'=>'ewg-slider-margin',
			'type'=>'inputtext',
			'default'=>'auto',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"Slider - Slider Padding" => array(
			'title'=>__('Slider Padding'),
			'name'=>'ewg-slider-padding',
			'type'=>'inputtext',
			'default'=>'0px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"Slider - Slider Border Style" => array(
			'title'=>__('Slider Border Style'),
			'name'=>'ewg-slider-border-style',
			'type'=>'combobox',
			'options' => array('Solid','Dotted','None'),
			'default'=>'Solid',
			'description'=>"",
			'hr'=>'none'),
		"Slider - Slider Border Width" => array(
			'title'=>__('Slider Border Width'),
			'name'=>'ewg-slider-border-width',
			'type'=>'inputtext',
			'default'=>'2px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),
		"Slider - Slider Border Color" => array(
			'title'=>__('Slider Border Color'),
			'name'=>'ewg-slider-border-color',
			'type'=>'colorbox',
			'default'=>'#ff0000',
			'description'=>"",
			'hr'=>'none'),
		"Slider - Slider Border Radius" => array(
			'title'=>__('Slider Border Radius'),
			'name'=>'ewg-slider-border-radius',
			'type'=>'inputtext',
			'default'=>'0px',
			'description'=>"i.e. 1px or 1em or 100% or auto, no semi-colons (;)",
			'hr'=>'none'),	
		"Slider Background Color" => array(
			'title'=>__('Slider Background Color'),
			'name'=>'ewg-slider-background-color',
			'type'=>'colorbox',
			'default'=>'#ff0000',
			'description'=>"",
			'hr'=>'none'),	
		"Slider Background Transparent" => array(
			'title'=>__('Slider Background Transparent'),
			'name'=>'ewg-slider-background-transparent',
			'type'=>'checkbox',
			'label'=>'Yes',
			'default'=>'0',
			'description'=>"",
			'hr'=>'none'),		
		
		//////////////////////////////////////////////////////////////////////////
		"Slideshow Setting" => array(
			'title'=>__('Slideshow Settings'),
			'type'=>'header',
			'description'=>"",),
			
		"Slideshow Setting - AutoPlay Slides" => array(
			'title'=>__('AutoPlay Slides'),
			'name'=>'ewg-slideshow-slide-autoplay',
			'type'=>'checkbox',
			'label'=>'Yes',
			'default'=>'1',
			'description'=>"",
			'hr'=>'none'),					
		"Slideshow Setting - Slide Duration" => array(
			'title'=>__('Slide Duration'),
			'name'=>'ewg-slideshow-slide-duration',
			'type'=>'inputtext',
			'default'=>'4000',
			'description'=>"Duration between each slide, default is 4000ms (4 seconds)",
			'hr'=>'none'),		
		"Slideshow Setting - Autoplay Delay" => array(
			'title'=>__('Autoplay Delay'),
			'name'=>'ewg-slideshow-autoplay-interval',
			'type'=>'inputtext',
			'default'=>'4000',
			'description'=>"Autoplay delay before starting slideshow, default is 4000ms (4 seconds)",
			'hr'=>'none'),			
				
		//////////////////////////////////////////////////////////////////////////
		"Index Link Settings" => array(
			'title'=>__('Index Link Settings'),
			'type'=>'header',
			'description'=>"",),	
				
		"Index Link Color" => array(
			'title'=>__('Index Link Color'),
			'name'=>'ewg-link-color',
			'type'=>'colorbox',
			'default'=>'#ff0000',
			'description'=>"",
			'hr'=>'none'),	
		"Index Link Hover Color" => array(
			'title'=>__('Index Link Hover Color'),
			'name'=>'ewg-link-hover-color',
			'type'=>'colorbox',
			'default'=>'#ff0000',
			'description'=>"",
			'hr'=>'none'),			
			
		//////////////////////////////////////////////////////////////////////////
		"Index Font Settings" => array(
			'title'=>__('Index Font Settings'),
			'type'=>'header',
			'description'=>"",),		
		
		"Index Font Size" => array(
			'title'=>__('Index Font Size'),
			'name'=>'ewg-font-size',
			'type'=>'inputtext',
			'default'=>'16px',
			'description'=>"",
			'hr'=>'none'),
		"Index Font Size (Mobile Settings)" => array(
			'title'=>__('Index Font Size (Mobile Settings)'),
			'name'=>'ewg-font-size-mobile',
			'type'=>'inputtext',
			'default'=>'12px',
			'description'=>"",
			'hr'=>'none'),	
		"Index Font Family" => array(
			'title'=>__('Index Font Family'),
			'name'=>'ewg-font-family',
			'type'=>'inputtext',
			'default'=>'Arial,Helvetica',
			'description'=>" i.e. Arial,Helvetica, no semi-colons (;)",
			'hr'=>'none'),
		"Index Font Weight" => array(
			'title'=>__('Index Font Weight'),
			'name'=>'ewg-font-weight',
			'type'=>'inputtext',
			'default'=>'normal',
			'description'=>" i.e. normal / bold / etc, no semi-colons (;)",
			'hr'=>'none'),	

		"Gallery Title Font Size" => array(
			'title'=>__('Gallery Title Font Size'),
			'name'=>'ewg-font-size2',
			'type'=>'inputtext',
			'default'=>'16px',
			'description'=>"",
			'hr'=>'none'),
		"Gallery Title Font Size (Mobile Layout)" => array(
			'title'=>__('Gallery Title Font Size (Mobile Layout)'),
			'name'=>'ewg-font-size2-mobile',
			'type'=>'inputtext',
			'default'=>'10px',
			'description'=>"",
			'hr'=>'none'),	
		"Gallery Title Font Family" => array(
			'title'=>__('Gallery Title Font Family'),
			'name'=>'ewg-font-family2',
			'type'=>'inputtext',
			'default'=>'Arial,Helvetica',
			'description'=>" i.e. Arial,Helvetica, no semi-colons (;)",
			'hr'=>'none'),
		"Gallery Title Font Weight" => array(
			'title'=>__('Gallery Title Font Weight'),
			'name'=>'ewg-font-weight2',
			'type'=>'inputtext',
			'default'=>'normal',
			'description'=>" i.e. normal / bold / etc, no semi-colons (;)",
			'hr'=>'none'),	
		
		//////////////////////////////////////////////////////////////////////////
		"Other Settings" => array(
			'title'=>__('Other Settings'),
			'type'=>'header',
			'description'=>"",),
		
		"Other CSS" => array(
			'title'=>__('Other CSS'),
			'name'=>'ewg-other-css',
			'type'=>'textarea',
			'description'=>"Enter additional css settings, i.e.: a {color:#000000; text-decoration:none; }",
			'hr'=>'none'),	
				
			
	);	
	
	$default_settings = array();
	foreach($ew_gallery_settings_meta_boxes as $meta_box){
		$default_settings [$meta_box['name']] = $meta_box['default'];
	}
	
	$gallery_settings = get_option("ew_gallery_setting" , $default_settings);


	if(isset($_POST['submit']))
	{
		//echo '<pre>';
		//print_r($gallery_settings );
		//print_r($_POST);
		//echo '</pre>';
		//update_option 
		foreach($ew_gallery_settings_meta_boxes as $meta_box){
			//$default_settings [$meta_box['name']] = $meta_box['default'];
			$gallery_settings [$meta_box['name']] = $_POST[$meta_box['name']];	
		}
		
		update_option("ew_gallery_setting" , $gallery_settings);
		
	}
	
	
	
	//global $post, $ew_gallery_settings_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">'; ?>
		
		<form name="gallery-setting-form" action="" method="post" enctype="multipart/form-data">	
		
		<div class="nt-option-meta" id="nt-option-meta"> <?php
		
			set_ew_nonce();
			foreach($ew_gallery_settings_meta_boxes as $meta_box){
				$meta_box['value'] =  $gallery_settings [$meta_box['name']] ;
				print_ew_meta($meta_box);
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> 
		<input type="submit" name="submit" class="button button-primary" value="Save Setting" />
		<input type="hidden" name="action"  value="save_setting" />
		</form>
		
		<?php
		
		echo '</div>';
	
	
	
	
	
	
	
	echo '</div >';


}

	


add_action('init','create_ew_menu');

function create_ew_menu()
{
	
	
	$labels = array(
    'name'               => 'EW Gallery',
    'singular_name'      => 'EW Gallery',
    'add_new'            => 'New EW Gallery',
    'add_new_item'       => 'New EW Gallery',
    'edit_item'          => 'Edit EW Gallery',
    'new_item'           => 'New EW Gallery',
    'all_items'          => 'EW Galleries',
    'view_item'          => 'View Gallery',
    'search_items'       => 'Search Gallery',
    'not_found'          => 'No Gallery found',
    'not_found_in_trash' => 'No Gallery found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'EW Gallery'
  );
  
  $args = array(
    'labels'             => $labels,
    'public'             => false,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
	'rewrite'            => true,
    'capability_type' => 'post',
    'hierarchical'       => false,
    'menu_position'      => 8,
    'supports'           => array( 'title' ,'page-attributes' )//,'editor','thumbnail' )
  );

  register_post_type( 'ew_gallery', $args );
  
}


/**********************************************************************************/

	$ew_gallery_meta_boxes = array(
		"Gallery Images" => array(
			'title'=>__(''),
			'name'=>'ew-gallery-images',
			'type'=>'multiimgupload',
			'description'=>"Please provide Gallery images, These images will be displayed in Gallery. ",
			'hr'=>'none'),
	);	

	add_action('add_meta_boxes', 'add_ew_gallery_blocks_option');

	function add_ew_gallery_blocks_option(){	
	
		add_meta_box('ew-gallery-option', 'Gallery Images', 'add_ew_gallery_block_option_element',
			'ew_gallery', 'normal', 'high');
			
	}	

	function add_ew_gallery_block_option_element(){
	
		global $post, $ew_gallery_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="nt-option-meta" id="nt-option-meta"> <?php
		
			set_ew_nonce();
			foreach($ew_gallery_meta_boxes as $meta_box){
				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				print_ew_meta($meta_box);
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
	}

// save option function that trigger when saveing each post
add_action('save_post','save_ew_gallery_meta');
function save_ew_gallery_meta($post_id){

	global $ew_gallery_meta_boxes;
	$edit_meta_boxes = $ew_gallery_meta_boxes;
	
	
	// save
	foreach ($edit_meta_boxes as $edit_meta_box){
	
		//print_r($edit_meta_box);
		//print_r($_POST);
	
		if(isset($_POST[$edit_meta_box['name']])){	
			
			if(isset($_POST['ew-gallery-images']) )
			{
				$new_data = array();
				$new_data = $_POST[$edit_meta_box['name']];
				
			}
			else
			{
				$new_data = stripslashes($_POST[$edit_meta_box['name']]);
				
			}
		}else{
			$new_data = '';

		}
		
		$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
		save_ew_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
		
	}
	
	//exit;
	
}
?>