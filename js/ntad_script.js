jQuery(document).ready(function($){

		

		var uploadID          = '';  
		
		
		//var counter = 1;
		var counter = jQuery('#img_c').val();
		jQuery('#add_media_img').on('click',function() {

		var newTextBoxDiv = jQuery(document.createElement('div'))
         .attr("id", 'ImageBoxDiv' + counter);

		newTextBoxDiv.after().html(
		  '<input type="text" name="kpgallery-image[]" id="imageurl_'+counter+'" class="kpgallery-image[]">'+
		  '<input type="button" name="upload_img"  id="upload_img" class="button uploader" value="Upload" >'+
		  '<input type="button" name="remove_img" id="remove_img" class="button remove_img" value="Remove" >'
		  );

		//alert(newTextBoxDiv.html() );

		newTextBoxDiv.appendTo(".add_media_div");
		//counter++;
		
		/*jQuery('.remove_img').on('click',function() {
			jQuery(this).parent().remove();
		});*/
		
		var custom_uploader;
		
		
		jQuery('.uploader').on('click',function() {											  
			 form_field = jQuery(this).parent().find(('input[type=text]')).attr('id');

			//alert('');

			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Gallery Image',
				button: {
					text: 'Choose Gallery Image'
				},
				multiple: true
			});
	
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {

				attachments = custom_uploader.state().get('selection').toJSON();
			   
			
				 $.each(attachments , function(i, attachment){
 				
				var newImageBoxDiv = jQuery(document.createElement('div'))
		         .attr("id", 'ImageDiv_' + counter).attr('class','multi_img_div');
				
				
				newImageBoxDiv.after().html(
		 '<input type="hidden" value="'+ attachment.id +'" name="ew-gallery-images[]" class="ew-gallery-images[]">'+
          '<img src="'+ attachment.sizes.thumbnail.url  +'" name="pimages['+counter+']" id="p_image_'+counter+'"  class="pimages['+counter+'] img_hover" height="150" width="150">'+
		  '<a href="javascript:void();" name="a-pimages['+counter+']" id="a-p_image_'+counter+'" class="remove_img_div close_btn">X</a>');
				
				newImageBoxDiv.appendTo(".added_image_div");		
				counter++;
				//alert(counter);
        	});
		
		
			removable_div = jQuery('#'+form_field).parent().attr('id');
			jQuery('#'+removable_div).remove();

			jQuery('.remove_img_div').on('click',function() {
				//alert('clicked');										  	
				jQuery(this).parent().remove();
			});
	
			   
			   
			});
	
			//Open the uploader dialog
			custom_uploader.open();
			return false;
			 
		 });
		
		
    });
		
	
	jQuery('.remove_img_div').on('click',function() {
		//alert('clicked');											  
		jQuery(this).parent().remove();
	});
	jQuery('.remove_vid_div').on('click',function() {
		//alert('clicked');											  
		jQuery(this).parent().parent().remove();
	});
	
	
		jQuery('#add_media_video').on('click',function() {
	    
			
			
			var vurl = jQuery('#media_video_url').val();
			if(vurl =='') return;
			var counter = jQuery('#img_c').val();
			
			var newImageBoxDiv = jQuery(document.createElement('div'))
		         .attr("id", 'ImageDiv_' + counter).attr('class','multi_img_div');
				
				
				newImageBoxDiv.after().html(
		 '<input type="hidden" value="'+ vurl +'" name="ew-gallery-images[]" class="ew-gallery-images[]">'+
          '<div class="med_video"> '+ vurl  +'</div>'+
		  '<a href="javascript:void();" name="a-pimages['+counter+']" id="a-p_image_'+counter+'" class="remove_img_div close_btn">X</a>');
				
				newImageBoxDiv.appendTo(".added_image_div");		
			jQuery('#media_video_url').val('');
		
		//alert('');
		
			jQuery('.remove_img_div').on('click',function() {
				//alert('clicked');										  	
				jQuery(this).parent().remove();
			});
		});	
	
		
});


jQuery(document).ready(function($){
//alert('2');
	$('.wp-color-picker-field').wpColorPicker();
	$('.added_image_div').sortable();
});