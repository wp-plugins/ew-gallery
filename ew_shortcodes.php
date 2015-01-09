<?php
	
function display_ewGallery($atts){

	ob_start();
	
	$atts = shortcode_atts( array(
 	      'hideindex' => false,
 	      'gallery_ids' => '',
		  'gallery_id' => '0',
      ), $atts );
	  
	  extract($atts);
	  
	  //if($hideindex)  echo "true"; else echo "false";
	if(!empty($gallery_ids ))
		$gallery_ids =  explode(",",$gallery_ids);
	else
		$gallery_ids = array();	
	//print_r($gallery_ids);
	
	$gallery_settings = get_option("ew_gallery_setting" );
	//extract($gallery_settings);
	//print_r($gallery_settings);
	/*
	[ewg-border-style] => Dotted [ewg-border-width] => 5px [ewg-border-color] => #99b500 [ewg-background-color] => #002dd3 [ewg-link-color] => #e000b7 [ewg-link-hover-color] => #00726e
	*/
?>

<style type="text/css">


.slider-wrapper{
	border-style: <?php echo $gallery_settings['ewg-slider-border-style'];?>;
	border-width: <?php echo $gallery_settings['ewg-slider-border-width'];?>;
	
	border-color: <?php echo $gallery_settings['ewg-slider-border-color'];?>;
    border-radius: <?php echo $gallery_settings['ewg-slider-border-radius'];?>;
	
	width:<?php //echo $gallery_settings['ewg-slider-width'];
				echo $gallery_settings['ewg-slider-wrapper-width'];	
	?>;
	margin:<?php echo $gallery_settings['ewg-slider-margin'];?>;
	padding:<?php echo $gallery_settings['ewg-slider-padding'];?>;
}


@media (min-width: 362px) {
	a.ew_gal_nav { 
		color:<?php echo $gallery_settings['ewg-link-color'];?>!important;
		font-family:<?php echo $gallery_settings['ewg-font-family'];?>!important; 
		font-size:<?php echo $gallery_settings['ewg-font-size'];?>!important ; 
		font-weight:<?php echo $gallery_settings['ewg-font-weight'];?>!important;
	}
	a.ew_gal_nav:hover { color:<?php echo $gallery_settings['ewg-link-hover-color'];?>!important;}

	.ewg_cat_block > a {
		display: block;
		text-align: center;
		text-decoration: none;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		width: 100%;
		color:<?php echo $gallery_settings['ewg-link-color'];?>!important;
		
		font-family:<?php echo $gallery_settings['ewg-font-family2'];?>!important; 
		font-size:<?php echo $gallery_settings['ewg-font-size2'];?>!important ; 
		font-weight:<?php echo $gallery_settings['ewg-font-weight2'];?>!important;
		
	}
	
	.ewg_cat_block > a:hover { color:<?php echo $gallery_settings['ewg-link-hover-color'];?>!important;}



}

@media (max-width: 362px) {
	a.ew_gal_nav { 
		color:<?php echo $gallery_settings['ewg-link-color'];?>!important;
		font-family:<?php echo $gallery_settings['ewg-font-family'];?>!important; 
		font-size:<?php echo $gallery_settings['ewg-font-size-mobile'];?>!important ; 
		font-weight:<?php echo $gallery_settings['ewg-font-weight'];?>!important;
	}
	a.ew_gal_nav:hover { color:<?php echo $gallery_settings['ewg-link-hover-color'];?>!important;}

	.ewg_cat_block > a {
		display: block;
		text-align: center;
		text-decoration: none;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		width: 100%;
		color:<?php echo $gallery_settings['ewg-link-color'];?>!important;
		
		font-family:<?php echo $gallery_settings['ewg-font-family2'];?>!important; 
		font-size:<?php echo $gallery_settings['ewg-font-size2-mobile'];?>!important ; 
		font-weight:<?php echo $gallery_settings['ewg-font-weight2'];?>!important;
		
	}
	
	.ewg_cat_block > a:hover { color:<?php echo $gallery_settings['ewg-link-hover-color'];?>!important;}


}



.ew_cat_list{
	display: block; 
	margin: <?php echo $gallery_settings['ewg-gallists-margin'];?>; 
	padding: <?php echo $gallery_settings['ewg-gallists-padding'];?>;
	color:<?php echo $gallery_settings['ewg-link-hover-color'];?>!important;
	
}
.ew_cat_list a{
	text-decoration:none;

}

.ewg_cat_block {
    display: inline-block;
    /*margin-right: 5px;*/
	width: <?php echo $gallery_settings['ewg-galimage-width'];?>; 
	margin: <?php echo $gallery_settings['ewg-galimage-margin'];?>; 
	padding: <?php echo $gallery_settings['ewg-galimage-padding'];?>;
	/*float:left;*/
	
}


.ewg_cat_block a img {
    /*border: 5px solid #E4E4E4;
    outline: 1px solid #CCCCCC;*/
	border-style: <?php echo $gallery_settings['ewg-galimage-border-style'];?>;
	border-width: <?php echo $gallery_settings['ewg-galimage-border-width'];?>;
	border-color: <?php echo $gallery_settings['ewg-galimage-border-color'];?>;
    border-radius: <?php echo $gallery_settings['ewg-galimage-border-radius'];?>;
	
	
}


.cat-list-block { text-align:<?php echo $gallery_settings['ewg-gallists-alignment'];?>!important ; }
.gallery-blocks { text-align:<?php echo $gallery_settings['ewg-galimage-alignment'];?>!important ; }

#slider1_container img {
    height: auto !important;
}

<?php echo $gallery_settings['ewg-other-css'];?>



</style>

	<!-- Arrow Navigator Skin Begin -->
	<style>
		/* jssor slider arrow navigator skin 05 css */
		/*
		.jssora05l              (normal)
		.jssora05r              (normal)
		.jssora05l:hover        (normal mouseover)
		.jssora05r:hover        (normal mouseover)
		.jssora05ldn            (mousedown)
		.jssora05rdn            (mousedown)
		*/
		.jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
		{
			position: absolute;
			cursor: pointer;
			display: block;
			background: url(<?php echo plugins_url( 'img/a17.png' , __FILE__ ); ?>) no-repeat;
			overflow:hidden;
		}
		.jssora05l { background-position: -10px -40px; }
		.jssora05r { background-position: -70px -40px; }
		.jssora05l:hover { background-position: -130px -40px; }
		.jssora05r:hover { background-position: -190px -40px; }
		.jssora05ldn { background-position: -250px -40px; }
		.jssora05rdn { background-position: -310px -40px; }
	</style>
	<!-- Thumbnail Item Skin Begin -->
	<style>
		/* jssor slider thumbnail navigator skin 01 css */
		/*
		.jssort01 .p           (normal)
		.jssort01 .p:hover     (normal mouseover)
		.jssort01 .pav           (active)
		.jssort01 .pav:hover     (active mouseover)
		.jssort01 .pdn           (mousedown)
		*/
		.jssort01 .w {
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
		}

		.jssort01 .c {
			position: absolute;
			top: 0px;
			left: 0px;
			width: 68px;
			height: 68px;
			border: #000 2px solid;
		}

		.jssort01 .p:hover .c, .jssort01 .pav:hover .c, .jssort01 .pav .c {
			background: url(<?php echo plugins_url( 'img/t01.png' , __FILE__ ); ?>) center center;
			border-width: 0px;
			top: 2px;
			left: 2px;
			width: 68px;
			height: 68px;
		}

		.jssort01 .p:hover .c, .jssort01 .pav:hover .c {
			top: 0px;
			left: 0px;
			width: 70px;
			height: 70px;
			border: #fff 1px solid;
		}
	</style>


		<?php if(!$hideindex ) { ?>

		<div class="main-title clearfix cat-list-block" style="text-align:center;">
				<span class="ew_cat_list" >
		<?php 
			$term_result = get_terms( 'ew_gallery_category' );
			echo '<a href="'.get_permalink().'" class="ew_gal_nav"> Index </a>';
			/*foreach($term_result as $k=>$v)
			{
				echo '<a href="?ew_cat_id='.$v->term_id.'">'.$v->name.'</a>';
			}*/
			
			$galleries = get_posts(array(
				'post_type' => 'ew_gallery', 
				//'p' => $gallery_id,
				'showposts'=> -1, 'orderby' => 'menu_order', 'order' => 'ASC'));	
				
			foreach($galleries as $k=>$v)
			{	
				//print_r($gallery_ids);
				//print_r( $v);
				if(in_array($v->ID,$gallery_ids)  || count($gallery_ids)==0)
					echo ' - <a href="'.add_query_arg( 'gallery_id', $v->ID).'" class="ew_gal_nav">'.$v->post_title.'</a>';		
			}
		?> 
				</span>
			</div>
			
		<?php  }  ?>	
			
			<?php
				
				if($gallery_id == 0)
				{
					if(isset($_GET['gallery_id']) && $_GET['gallery_id'] != "")
						$gallery_id = $_GET['gallery_id'];
					else
						$gallery_id = 0;	
				}
				// Start the Loop.
				//if(isset($_GET['gallery_id']) && $_GET['gallery_id'] != "")
				//echo $gallery_id ;
				if($gallery_id )
				{
					
					$args = array('post_type' => 'ew_gallery', 'post_status'=>'publish', 'posts_per_page' => -1,
					'p' => $gallery_id, 'orderby' => 'menu_order', 'order' => 'ASC' );
				}
				else
				{
					$args = array( 'post_type' => 'ew_gallery', 'posts_per_page' => -1, 'post_status'=>'publish',
					'orderby' => 'menu_order', 'order' => 'ASC' );
					
				}
						
			
			$the_query = new WP_Query( $args );
			$ew_id = array();
			
			echo "<div class='gallery-blocks'>";
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) : $post = $the_query->the_post();
				
				if($gallery_id )
				{

					$galleries =  get_post_meta( get_the_ID(), 'ew-gallery-images',true );
					
					$showSlideShow = true;

					if($galleries){
					foreach($galleries as $gallery)
						{
	
							if(is_numeric($gallery))
							{
								$larges = wp_get_attachment_image_src(  $gallery , "large");
								$thumb = wp_get_attachment_image_src(  $gallery , "thumbnail");
							
		
								$gallery_lists .= '<div> <img u="image" src="'.$larges[0].'" />
													 <img u="thumb" src="'.$thumb[0].'" />
												   </div>';
							}					  
							else
							{
								$link = $gallery;
								$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
								if (empty($video_id[1]))
									$video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
								
								$video_id = explode("&", $video_id[1]); // Deleting any other params
								$video_id = $video_id[0];
								
								$thumb_default = "http://img.youtube.com/vi/$video_id/default.jpg";
								$thumb_img = '<img width="150" height="150"  src="'.$thumb_default.'">';
								//<img u="thumb" src="'.$thumb_img.'" />
								
								$pw = $gallery_settings['ewg-slider-width'];
								$ph = $gallery_settings['ewg-slider-height'];
								
							
								$gallery_lists .='<div>
								<div u="player" style="position: relative; top: 0px; left: 0px; width: '.$pw.'; height: '.$ph.'; overflow: hidden;margin:auto;">
						
						<iframe pHandler="ytiframe" pHideControls="0"   style="z-index: 0;" url="http://www.youtube.com/embed/'.$video_id.'?enablejsapi=1&version=3&playerapiid=ytplayer&fs=1&wmode=transparent" frameborder="0" scrolling="no"></iframe>                    
						
					</div>
						<img u="thumb" src="'.$thumb_default.'" height="150"  />
				</div>';
							$showSlideShow = false;
							
							
							
							
							} 
						}
					}
					
				}
				else
				{
					$galleries =  get_post_meta( get_the_ID(), 'ew-gallery-images',true );

					if(is_array($galleries) && count($galleries))
						$gallery = $galleries[0];
					else 
						continue;	
					
					if(in_array(get_the_ID(),$gallery_ids)  || count($gallery_ids)==0)
					{	}
					else 
						continue;		
					
					
					
					$link = add_query_arg("gallery_id", get_the_ID());		
						
					echo '<div class="ewg_cat_block"><a href="'.$link.'">';

					if(is_numeric($gallery))
					{

						$large = wp_get_attachment_image_src(  $gallery , "large");
						$thumb = wp_get_attachment_image_src(  $gallery , "thumbnail");
						
						echo '<img width="'.$thumb[1].'" height="'.$thumb[2].'"  src="'.$thumb[0].'">';
					
					}
					else
					{
						//echo '<div> Video Gallery </div>';
						$link = $gallery;
						$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
						if (empty($video_id[1]))
							$video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
						
						$video_id = explode("&", $video_id[1]); // Deleting any other params
						$video_id = $video_id[0];
						
						
						$thumb_default = "http://img.youtube.com/vi/$video_id/default.jpg";
						echo '<img width="150" height="150"  src="'.$thumb_default.'">';
						
						
					}
					
					echo '<span>'.get_the_title().'</span>';
					echo '</a></div>';
								
					$ew_id[] = $thumb;
								
				}
					
				endwhile;
			}
			echo "</div>";
			//if(isset($_GET['gallery_id']) && $_GET['gallery_id'] != "")
			if($gallery_id )
				{
			?>
	<div class="slider-wrapper" id="sliderDiv">

	<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: <?php echo $gallery_settings['ewg-slider-width'];?>;
        height: <?php echo $gallery_settings['ewg-slider-height'];?>; background: #191919; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?php echo plugins_url( 'img/loading.gif' , __FILE__ ); ?>) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: <?php echo $gallery_settings['ewg-slider-width'];?>; height: <?php echo $gallery_settings['ewg-slider-height-thumbs'];?>; overflow: hidden;">
		<?php echo $gallery_lists; ?>
		
			
            
		
        </div>
        <?php $arr_height = str_replace('px', '', $gallery_settings['ewg-slider-height-thumbs']); ?>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: <?php echo $arr_height/2;?>px; left: 8px;">
        </span>
        
		<!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: <?php echo $arr_height/2;?>px; right: 8px">
        </span>
                
        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort01" style="position: absolute; width: <?php echo $gallery_settings['ewg-slider-width'];?>; height: 100px; left:0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                    <div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
    </div>
</div>

<?php //print_r($gallery_settings );?>	

<script type="text/javascript">
		jQuery(document).ready(function ($) {
		
			
			<?php if($showSlideShow ) { ?>	

            var _SlideshowTransitions = [
            //Fade in L
                {$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out R
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade in R
                , { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out L
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

            //Fade in T
                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out B
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade in B
                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out T
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade in LR
                , { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out LR
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade in TB
                , { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out TB
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade in LR Chess
                , { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out LR Chess
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade in TB Chess
                , { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out TB Chess
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

            //Fade in Corners
                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out Corners
                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                ];
			<?php } ?>	
			
			<?php 
			
	$slide_duration = (	$gallery_settings['ewg-slideshow-slide-duration']) ?
			$gallery_settings['ewg-slideshow-slide-duration'] : 4000 ;
	
	//echo " alert('".$gallery_settings['ewg-slideshow-slide-autoplay']."');";
			
	$autoplay = (isset(	$gallery_settings['ewg-slideshow-slide-autoplay'] ) ) ?
			$gallery_settings['ewg-slideshow-slide-autoplay'] : 'false' ;		
	
	//$autoplay = $gallery_settings['ewg-slideshow-slide-autoplay'] ;
	
	//echo " alert('$autoplay');";
			
	if($autoplay == 1)	$autoplay = 'true'; else $autoplay = 'false';	
			
			
	$autoplay_interval = (	$gallery_settings['ewg-slideshow-autoplay-interval']) ?
			$gallery_settings['ewg-slideshow-autoplay-interval'] : 4000 ;		
			
			
			
			?>
			
            var options = {
				$FillMode: 1,
                //$AutoPlay: true,
				$AutoPlay: <?php echo $autoplay; ?>,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
				
                //$AutoPlayInterval: 4000,
				$AutoPlayInterval: <?php echo $autoplay_interval; ?>,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
				<?php if($showSlideShow ) { ?>	
				
                //$SlideDuration: 4000,
				$SlideDuration: <?php echo $slide_duration; ?>,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },
				<?php } ?>	

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                }
            };
			
			

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
			//alert(jssor_slider1.$Elmt.parentNode.clientWidth);
			
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                //var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                //if (parentWidth)
                //    jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
				
				/*****************************************************************/
				//reserve blank width for margin+padding: margin+padding-left (10) + margin+padding-right (10)
                var paddingWidth = 0; //20;

                //minimum width should reserve for text
                var minReserveWidth = 225;

                var parentElement = jssor_slider1.$Elmt.parentNode;

                //evaluate parent container width
                var parentWidth = $('#sliderDiv').width();//parentElement.clientWidth;
				
				/****************************************************************/
				
				//alert(parentWidth);
				
				if (parentWidth) {
					

                    //exclude blank width
                    var availableWidth = parentWidth - paddingWidth;

                    //calculate slider width as 70% of available width
                    var sliderWidth = availableWidth * 0.7;
					//alert(parentWidth);
					//alert(sliderWidth );

                    //slider width is maximum 600
                    sliderWidth = Math.min(sliderWidth, parentWidth); //600);
					//alert(sliderWidth );

                    //slider width is minimum 200
                    sliderWidth = Math.max(sliderWidth, 200);
					//alert(sliderWidth );
                    var clearFix = "none";
					
					//alert(sliderWidth );

                    //evaluate free width for text, if the width is less than minReserveWidth then fill parent container
                    if (availableWidth - sliderWidth < minReserveWidth) {

                        //set slider width to available width
                        sliderWidth = availableWidth;

                        //slider width is minimum 200
                        sliderWidth = Math.max(sliderWidth, 200);
						//alert(sliderWidth );

                        clearFix = "both";
                    }
					else
						sliderWidth = parentWidth; 
					//alert(sliderWidth );

                    //clear fix for safari 3.1, chrome 3
                    $('#clearFixDiv').css('clear', clearFix);

                    jssor_slider1.$SetScaleWidth(sliderWidth);
					//jssor_slider1.$SetScaleWidth(Math.min(sliderWidth, 640));
					
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            //ScaleSlider();
			var bodyWidth = $('#sliderDiv').width();//jssor_slider1.$Elmt.parentNode.clientWidth;
				//alert(bodyWidth );
                if (bodyWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(bodyWidth, 1920));
				else
                    window.setTimeout(ScaleSlider, 30);	

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
				//alert('resize');
                $(window).bind('resize', ScaleSlider);
            }
			//$(window).bind('resize', ScaleSlider);
			
			 $JssorPlayer$.$FetchPlayers(document.body);

        });
</script>
<?php } 

return ob_get_clean();

}
add_shortcode("EWGallery_display","display_ewGallery");
?>