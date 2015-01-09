<?php

	/*	
	*	Goodlayers Meta Template File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the template of meta box for each input type.
	* 	The framework will use it when create meta box for each post_type.
	*	---------------------------------------------------------------------
	*/
	
	// decide to print each meta box type
	function print_ew_meta($meta_box){
	
		if(empty($meta_box['default'])) $meta_box['default'] = '';
		
		switch($meta_box['type']){
		
			case "open" : print_ew_meta_open_div($meta_box); break;
			case "close" : print_ew_meta_close_div($meta_box); break;
			case "header": print_ew_meta_header($meta_box); break;
			case "text": print_ew_meta_text($meta_box); break;
			case "description": print_ew_description($meta_box); break;
			case "inputtext": print_ew_meta_input_text($meta_box); break;
			case "colorbox": print_ew_meta_color_box($meta_box); break;
			
			case "upload": print_ew_meta_upload($meta_box); break;
			
			case "multiimgupload": print_ew_meta_multiimgupload($meta_box); break;
			
			case "textarea": print_ew_meta_input_textarea($meta_box); break;
			case "checkbox": print_ew_meta_input_checkbox($meta_box); break;
			case "userrelatedtocheckbox": print_ew_user_related_to_input_checkbox($meta_box); break;
			case "combobox": print_ew_meta_input_combobox($meta_box); break;
			case "radioenabled": print_ew_meta_input_radioenabled($meta_box); break;
			case "radioimage": print_ew_meta_input_radioimage($meta_box); break;
			case "imagepicker": print_ew_image_picker($meta_box); break;

		}
		
	}
	
	// nonce Verification	
	function set_ew_nonce(){
	
		wp_nonce_field( 'ew_gallery', 'ew_gallery_nonce');
		
	}
	
	// header => name, title
	function print_ew_meta_header($args){
	
		extract($args);
		$meta_id = (isset($meta_id))? $meta_id : '';
		
		?>	
			
			<div id="meta-header" class="<?php echo $meta_id; ?>">
				<h3><?php _e($title, 'gdl_back_office'); ?></h3>
			</div>
			
		<?php 
		
	}

	// text => name, text
	function print_ew_meta_text($args){
	
		extract($args); 
		
		?>
		
			<div class="meta-body">
				<div class="meta-title pb10">
					<?php _e($title, 'gdl_back_office'); ?>
				</div>
			</div>
			
		<?php 
		
	}
	
	// text => name, title, value, default
	function print_ew_meta_input_text($args){
		extract($args);
		
		//print_r($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
		
				<div class="meta-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
						?>" class="popup-colorpicker" 
						/>
					
					
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description" > 
					<?php echo $description; ?> </div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}


	function print_ew_meta_color_box($args){
		extract($args);
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
		
				<div class="meta-input">
					
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>"  
						value="<?php echo ($value == '')? esc_html($default): esc_html($value);	?>" 
						class="wp-color-picker-field" 
						data-default-color="<?php echo esc_html($default);	?>" />	
					
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description" > 
					<?php echo $description; ?> </div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}



	
	// text => name, title, value, default
	function print_ew_description($args){
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="only-description"> <?php echo $description; ?> </div>
				<br class=clear>
			</div>
			
		<?php
		
	}	
		
	// text => name, title, value
	function print_ew_meta_upload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="meta-input-example-image single-img" id="meta-input-example-image">
					
						
							<img id="property_thumb_img" src="<?php if(!empty($value)) echo $value; ?>" 
							<?php if(!empty($value))
									{echo 'width="100" height="100"';}
								  else
									{echo 'width="0" height="0"';}
							?>
							/>
						
						<a style="" class="remove_single_img single_img" id="a-p_image" name="" href="javascript:void();">X</a>
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
												
						echo (empty($value))? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_ew_image_text_meta" class="<?php echo $name; ?>" type="text" name="<?php echo $name; ?>" value="<?php if(!empty($value)) echo $value; ?>" />
					<input class="upload_ew_image_button_meta button" type="button" value="Upload" />
				
				
				<?php if(isset($description)){ ?>
					<div class="meta-description">
					<?php echo $description; ?></div>
					
					
					
					
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	function print_ew_meta_multiimgupload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="meta-input-example-image" id="meta-input-example-image">
					
						<div class="added_image_div" >
						<?php 
							
							//print_r($value);
						
						if(!empty($value)) { 
							
							$c = 0;
							foreach($value as $k => $v){ 
							$c++;
							
							//echo $v;
							if(is_numeric($v))
							{
								$thumb = wp_get_attachment_image_src( $v, "thumbnail");
							
								//echo $v;	
							?>
							
		<div id="ImageDiv_<?php echo $c; ?>" class="multi_img_div">
		<input type="hidden" class="ew-gallery-images[<?php echo $c; ?>]" name="ew-gallery-images[]" value="<?php echo $v; ?>">
		<img width="150" height="150" class="pimages[<?php echo $c; ?>] img_hover" id="p_image_<?php echo $c; ?>" name="pimages[<?php echo $c; ?>]" src="<?php echo $thumb[0]; ?>">
		<a style="" class="remove_img_div" id="a-p_image_<?php echo $c; ?>" name="a-pimages[<?php echo $c; ?>]" href="javascript:void();">X</a></div>
		
						<?php } else {  ?>
							
		<div id="ImageDiv_<?php echo $c; ?>" class="multi_img_div ">
		<input type="hidden" class="ew-gallery-images[<?php echo $c; ?>]" name="ew-gallery-images[]" value="<?php echo $v; ?>">
			<div class="med_video"> <?php 
		
		$video_id = explode("?v=", $v); // For videos like http://www.youtube.com/watch?v=...
		if (empty($video_id[1]))
			$video_id = explode("/v/", $v); // For videos like http://www.youtube.com/watch/v/..
		
		$video_id = explode("&", $video_id[1]); // Deleting any other params
		$video_id = $video_id[0];
		
		
		$thumb_default = "http://img.youtube.com/vi/$video_id/default.jpg";
		echo '<img width="150" height="150"  src="'.$thumb_default.'">';
		//echo $v; 
		?>
		<a style="" class="remove_vid_div" id="a-p_image_<?php echo $c; ?>" name="a-pimages[<?php echo $c; ?>]" href="javascript:void();">X</a>
			</div>
		
		</div>
		
						<?php }
						  
						  }
		
		 				} ?>
		
	<input type="hidden" name="img_c" id="img_c" value="<?php if(!empty($value))
												{echo count($value); } 
												else{ echo "0" ;}  ?>" />
						</div>
					</div>
				
					<div class="add_media_div"></div>
				
				<input type="button" id="add_media_img" name="<?php echo $name;?>" class="button"  value="Add Gallery Image" />
				
				<input type="button" id="add_media_video" name="<?php echo 'media_video';?>" class="button"  
				value="Add Video Link" />
				<input type="text" id="media_video_url"  name="media_video_url" value=""  style="width:100%;" />
				
				<?php if(isset($description)){ ?>
					<div class="meta-description">
					<?php echo $description; ?></div>
					
					
					
					
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	// textarea => name, title, value, default
	function print_ew_meta_input_textarea($args){
	
		extract($args);
		
		?>
		
			<div  class="meta-body <?php echo str_replace('[]','',$name); ?>-wrapper">
				<div class="meta-title" >
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input" >
					<textarea style="width:100%;" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="<?php echo str_replace('[]','',$name); ?>"><?php
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"  style="font-style: italic;">
					<?php echo $description; ?></div>
					
				<?php } ?>
				</div>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// checkbox => name, title, value
	function print_ew_meta_input_checkbox($args){
	
		extract($args);
		//$value = (empty($value) && !isset($value))? $default: $value;
		$value = (!isset($name))? $default: $value;
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="checkbox" <?php if($value == 1) echo 'checked="checked"';?> value="1" id="<?php echo $name;?>" name="<?php echo $name;?>"> <?php echo $label;?>
				
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
	}	
	
	// checkbox => name, title, value
	function print_ew_user_related_to_input_checkbox($args){
	
		extract($args);
		//echo '<pre>';
		//print_r($args);
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<!--<input type="checkbox" <?php if($value == 1) echo 'checked="checked"';?> value="1" id="<?php echo $name;?>" name="<?php echo $name;?>">-->
					<?php 
						if(!empty($options))
						$o = 0;
						$i = 0;
						$f = false;
						foreach($options as $k=>$v)
						{$o++;?>
						<span style="display:block;"><?php echo '-- '.ucfirst($k).' --';?></span>
						<?php $all_user_name = explode(',',$v);
						foreach($all_user_name as $k1=>$v1)
						{if(empty($v1)) {
							echo '<span style="padding: 5px 0 5px 15px;">0 '.$k.' found</span>';
							break;
						}
						$i++;
						$user_meta = explode('-',$v1);
						$sellected_ids = get_post_meta($cur_post_id, 'user_related_to');
						//echo '<pre>';
						//print_r($user_meta);
						?>
	<span style="display: inline-block; width:45%;padding: 5px 0 5px 15px;">
	
	<input type="checkbox" 
	<?php 
	if(!empty($sellected_ids[0])){
		if((in_array($user_meta[1],$sellected_ids[0]))) 
			{
				echo 'checked="checked"';
				$f = true;
			}
		}
	
	if( !empty($author_id) && $author_id == $user_meta[1])
	{
		if($f)
			{
				echo 'onclick="return false"';
			}
		else
			{
				echo 'onclick="return false" checked="checked"';
			}
	}
		?>
	value="<?php echo $user_meta[1];?>" id="<?php echo $name."_$o"."_$i";?>" 
	name="sumitted_id[]" 
	
	>
	<label style=" vertical-align: top;" rel="<?php echo $name."_$o"."_$i";?>"><?php echo $user_meta[0];?></label>
	</span>
						<?php
						}
						}
					?>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
	}
	
	// combobox => name, title, value, options[]
	function print_ew_meta_input_combobox($args){
	
		extract($args);
		
		$value = (empty($value))? $default: $value;
		
		?>
			
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo str_replace('[]', '', $name); ?>">
						<option value="0" >----</option>
							<?php foreach($options as $option){ ?>
								
								<option rel="<?php echo $option ; ?>" value="<?php echo $option ; ?>" <?php if( $option==esc_html($value) ){ echo 'selected'; }?> ><?php echo $option ; ?></option>
						
							<?php } ?>
							
						</select>
					</div>
				
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}	
	
	// radioenabled => name, title, value
	function print_ew_meta_input_radioenabled($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="radio" name="<?php echo $name; ?>" value="enabled" <?php if($value=='enabled' || $value=='') echo 'checked'; ?>> Enable &nbsp&nbsp&nbsp
					<input type="radio" name="<?php echo $name; ?>" value="disable" <?php if($value=='disable') echo 'checked'; ?>> Disable
				
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}	

	
	// radioimage => name, title, type, value, option=>array(value, image)
	function print_ew_meta_input_radioimage($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
				
					<?php foreach( $options as $option ){ ?>
					
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo GOODLAYERS_PATH.$option['image']?> alt=<?php echo $name;?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value'];?>" <?php 
								
								if($value == $option['value']){
								
									echo 'checked';
									
								}else if($value == '' && $default == $option['value']){
								
									echo 'checked';
									
								}
								
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>" > 
						</div>
						
					<?php } ?>
					<br class=clear>
				</div>
				<br class=clear>
			</div>
		<?php
	}	
	
	// imagepicker => title, name=>array(num,image,title,caption,link)
	function print_ew_image_picker($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body image-picker-wrapper">
				<div class="meta-input-slider">
					<div class="image-picker" id="image-picker">
						<input type='hidden' class="slider-num" id="slider-num" name='<?php 
						
							echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
						
						?>' value=<?php 
							
							echo empty($value)? 0: $value->childNodes->length;
							
						?> />
						<div class="selected-image" id="selected-image">
							<div id="selected-image-none"></div>
							<ul>
								<li id="default" class="default">
									<div class="selected-image-wrapper">
										<img src="#"/>
										<div class="selected-image-element">
											<div id="edit-image" class="edit-image"></div>
											<div id="unpick-image" class="unpick-image"></div>
											<br class="clear">
										</div>
									</div>
									<input type="hidden" class='slider-image-url' id='<?php echo $name['image']; ?>' />
									<div id="slider-detail-wrapper" class="slider-detail-wrapper">
									<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php _e('SLIDER TITLE', 'gdl_back_office'); ?></div> 
										<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['title']; ?>' /></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php _e('SLIDER CAPTION', 'gdl_back_office'); ?></div>
										<div class="meta-detail-input meta-input"><textarea id='<?php echo $name['caption']; ?>' ></textarea></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div> 
										<div class="meta-input meta-detail-input">
											<div class="combobox">
												<select id='<?php echo $name['linktype']; ?>'>
													<option selected >No Link</option>
													<option>Lightbox</option>
													<option>Link to URL</option>	
													<option>Link to Video</option>
												</select>
											</div>
											<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
											<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php _e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'gdl_back_office'); ?></div> 
											<div><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div>
										</div>
										<br class="clear">
										<div class="meta-detail-done-wrapper">
											<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
										</div>
									</div>
									</div>
								</li>
								
								<?php 
								
									if(!empty($value)){
										
										foreach ($value->childNodes as $slider){ ?> 
										
											<li class="slider-image-init">
												<div class="selected-image-wrapper">
													<img src="<?php 
													
														$thumb_src_preview = wp_get_attachment_image_src( find_xml_value($slider, 'image'), '160x110');
														echo $thumb_src_preview[0]; 
														
													?>"/>
													<div class="selected-image-element">
														<div id="edit-image" class="edit-image"></div>
														<div id="unpick-image" class="unpick-image"></div>
														<br class="clear">
													</div>
												</div>
												<input type="hidden" class='slider-image-url' name='<?php echo $name['image']; ?>[]' id='<?php echo $name['image']; ?>[]' value="<?php echo find_xml_value($slider, 'image'); ?>" /> 
												<div id="slider-detail-wrapper" class="slider-detail-wrapper">
												<div id="slider-detail" class="slider-detail">								
													<div class="meta-title meta-detail-title"><?php _e('SLIDER TITLE', 'gdl_back_office'); ?></div> 
													<div class="meta-detail-input meta-input"><input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>[]' value="<?php echo find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php _e('SLIDER CAPTION', 'gdl_back_office'); ?></div>
													<div class="meta-detail-input meta-input"><textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>[]' ><?php echo find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div>
													<div class="meta-input meta-detail-input">
														<div class="combobox">
															<?php $linktype_val =  find_xml_value($slider, 'linktype'); ?>
															<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> >No Link</option>
																<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>>Lightbox</option>
																<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>>Link to URL</option>
																<option <?php echo ($linktype_val == 'Link to Video')?  "selected" : ''; ?>>Link to Video</option>
															</select>
														</div>
														<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
														<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php _e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'gdl_back_office'); ?></div> 
														<div><input class="mt10" type="text" name='<?php echo $name['link']; ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo find_xml_value($slider, 'link'); ?>" /></div>
													</div>
													<br class="clear">
													<div class="meta-detail-done-wrapper">
														<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
													</div>
												</div>
												</div>
												</li> 
												
											<?php
											
										}
										
									}
									
								?>	
								
							</ul>
							<br class=clear>
							<div id="show-media" class="show-media">
								<span id="show-media-text"></span>
								<div id="show-media-image"></div>
							</div>
						</div>
						<div class="media-image-gallery-wrapper">
							<div class="media-image-gallery" id="media-image-gallery">
								<?php get_media_image(); ?>
							</div>
						</div>
					</div>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	// open => id
	function print_ew_meta_open_div($args){
	
		extract($args);
		
		?>
		
			<div id="<?php echo $id; ?>" class="<?php echo $id; ?>" >
		
		<?php
		
	}
	
	// close
	function print_ew_meta_close_div($args){
	
		?>
		
			</div>
			
		<?php
		
	}
	
	
	
	
	function save_ew_meta_data($post_id, $new_data, $old_data, $name){
	
		//print_r($new_data);
		
		if($new_data == $old_data){
		
			add_post_meta($post_id, $name, $new_data, true);
			//echo "ad here";
			
		}else if(!$new_data){
		
			delete_post_meta($post_id, $name, $old_data);
			
		}else if($new_data != $old_data){
		
			update_post_meta($post_id, $name, $new_data, $old_data);
			
			//echo "here";
		}
		
		//exit;
	}
	
	
	
?>