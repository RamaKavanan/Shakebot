<?php
/*
 * Template Name: Frontpage
 */
get_header(); 

?>

<style>
	.row{margin-right:0px};
	

	.sucMsg{
    background-color: #D4EAF7;        
    border: 1px solid #00ADE7;
    margin-bottom: 8px;
    padding: 6px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;}  
	
</style>

<?php
	$current_page_id = get_option('page_on_front'); // get front page id

	// checking menu exist in location "primary"
	if(  ( $locations = get_nav_menu_locations() ) && $locations['primary'] )
	{
		$menu 			= wp_get_nav_menu_object( $locations['primary'] );
		$menu_items 	= wp_get_nav_menu_items( $menu->term_id );

		$post_ids = array();
		foreach ($menu_items as $items) {
			if($items->object == 'page'){
				$post_ids[] = $items->object_id;
			}
		}

		$args = array( 'post_type' => 'page', 'post__in' => $post_ids, 'posts_per_page' => count( $post_ids ), 'orderby' => 'post__in' );
		//$args = array( 'post_type' => 'page', 'post__in' => $post_ids, 'posts_per_page' => 3, 'orderby' => 'post__in' );
	}
	else
	{
		$args = array( 'post_type' => 'page');
		
	}

	$allPosts = new WP_Query( $args ); // get pages on menu

	$parallaxId = array();

	if (have_posts()) {
		// Start the Loop.
		while ( $allPosts->have_posts() ) { $allPosts->the_post();
			// set global $post
			global $post;

			$separator 			= get_post_meta( $post->ID, 'thm_no_hash', true );
			$page_section 		= get_post_meta( $post->ID, 'thm_section_type', true );
			$no_title 			= get_post_meta( $post->ID, 'thm_no_title', true );
			$menu_disable 		= get_post_meta( $post->ID, 'thm_disable_menu', true );
			$bg_color 			= get_post_meta( $post->ID, 'thm_bg_color', true );

			$postId = get_the_ID();

			if(( $separator != 1 ) && ( $postId != $current_page_id ))
			{
				if( $page_section == 'default' ){		// Default Content Page
				?>
					<section id="<?php echo $post->post_name; ?>" class="page-wrapper <?php echo getContrast50( $bg_color ); ?>" style="background-color:<?php echo $bg_color; ?>">
						
						<?php if($post->post_name == 'testimonial'){?>
						<div class="row" style="border:0px solid red">
							
							<div class="col-md-1" style="border:0px solid blue; margin-left:0px; text-align:center;">
								<!-- <img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/shake-img1.png" width="120px" style="margin-left:10px">-->
                                                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/shake-img1.png" width="120px" style="margin-left:10px">
							</div>
							
							<div class="col-md-10" style="border:0px solid green; /*margin-left:10px; margin-right:-20px;*/">						
						<?php }?>
									
						<div class="container">
						<?php if($post->post_name == 'testimonial'){?>	
									<div class="container-fluid1">								
								<?php }?>
						
						<?php
							if( $no_title != 1 ){
								$page_title 		= get_post_meta( $post->ID, 'thm_page_title', true );
								$page_subtitle 		= get_post_meta( $post->ID, 'thm_page_subtitle', true );
							?> 
								<div class="title-area">
									
									<h2 class="title"><?php if($page_title != '') { if($page_title != "What makes us unique"){echo $page_title;}else{echo "What makes Shakebot unique";} }else{ echo get_the_title(); } ?> </h2>

									<?php if( $page_subtitle != ''){ ?>
										<p class="subtitle"><?php echo $page_subtitle; ?></p>
									<?php } ?>
									
								</div> <!-- .section-title -->
							<?php }?>

							<div class="row page-content">	
								<?php if($post->post_name == 'testimonial'){?>	
									<div class="container-fluid1">								
								<?php }?>
								<?php echo do_shortcode(get_the_content()); ?>	
<?php if($post->post_name == 'testimonial'){?>	
									</div>								
								<?php }?>							
								<?php //echo get_the_content(); ?>								
							</div> <!-- .page-content -->
							
						<?php if($post->post_name == 'testimonial'){?>	
									</div>								
								<?php }?>
							
						</div> <!-- .container -->
						
						<?php if($post->post_name == 'testimonial'){?>
									
								</div>
								<div class="col-md-1" style="border:0px solid yellow; text-align:center;">
										<!--<img src="http://shakebot.biz/shakebotwp/wp-content/uploads/2015/10/shake-img1.png" width="120px"  id="leftimg">-->
                                                                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/10/shake-img1.png" width="120px"  id="leftimg">
									</div>
									
								</div>
							<?php }?>
						
						
												
					</section>
				<?php
				}
				elseif( $page_section == 'full' )
				{
				?>
					<div id="<?php echo $post->post_name; ?>" class="page-wrapper full-width <?php echo getContrast50( $bg_color ); ?>" style="background-color:<?php echo $bg_color; ?>">
						<?php
							if( $no_title != 1 ){
								$page_title 		= get_post_meta( $post->ID, 'thm_page_title', true );
								$page_subtitle 		= get_post_meta( $post->ID, 'thm_page_subtitle', true );
							?> 
							<div class="title-area">
								<h2 class="title"><?php if($page_title != '') { echo $page_title; }else{ echo get_the_title(); } ?> </h2>

								<?php if( $page_subtitle != ''){ ?>
									<p class="subtitle"><?php echo $page_subtitle; ?></p>
								<?php } ?>
								
							</div> <!-- .section-title -->
						<?php }?>
						<div class="page-fullwdth-content">	
								<?php echo do_shortcode(get_the_content()); ?>
						</div> <!-- .page-fullwdth-content -->
					</div> <!-- .page-content -->
				<?php
				}
				else
				{
					// Parallax Page
					$image = get_post_meta( $post->ID, 'thm_background_url', true );

					$parallaxId[] = $post->post_name;
				?>
					<section id="<?php echo $post->post_name; ?>" class="parallax parallax-image <?php echo getContrast50( $bg_color ); ?>" style="background-color: <?php echo $bg_color; ?>; background-image:url('<?php if(isset($image)) echo $image;?>');">
						<div class="overlay"></div>
						<div class="container">
							<div  class="parallax-content">
								<?php
									if( $no_title != 1 ){
										$page_title 		= get_post_meta( $post->ID, 'thm_page_title', true );
										$page_subtitle 		= get_post_meta( $post->ID, 'thm_page_subtitle', true );
									?> 
									<div class="title-area">
										<h2 class="title"><?php if($page_title != '') { echo $page_title; }else{ echo get_the_title(); } ?> </h2>

										<?php if( $page_subtitle != ''){ ?>
											<p class="subtitle"><?php echo $page_subtitle; ?></p>
										<?php } ?>
										
									</div> <!-- .section-title -->
								<?php }?>
								<div class="row">
									<?php echo do_shortcode(get_the_content()); ?>
								</div>
							</div> <!-- .parallax-content -->
						</div>
					</section> <!-- .parallax -->
				<?php
				}
			} // check only for one-page item
		}

		wp_reset_query();

		if( !empty( $parallaxId ) )
		{
			function add_my_script()
			{
				global $parallaxId;
				$output ='';
				$output .='<script type="text/javascript">';
				$output .='jQuery(document).ready(function($) {';
				$output .='$(window).load(function(){';
					
				foreach( $parallaxId as $id ){
					$output .='$("#'.$id.'").parallax("50%", 0.5);';
				}

				$output .='})';
				$output .='})';
				$output .='</script>';
				echo $output;
			}

			add_action('wp_footer','add_my_script',100);
		} // add parallax
	}

?>

<?php get_footer(); ?>

<script language="javascript">
	function showmore(stvar){
		var stvarlink, stvarmore;		
		for(var i=1;i<=5;i++){
			if(stvar == i){
				stvarlink = i+"morelink";
				stvarmore = i+"more";						
				document.getElementById(stvarmore).style.display = "";
				document.getElementById(stvarlink).style.display = "none";
			}else{
				stvarlink = i+"morelink";
				stvarmore = i+"more";				
				document.getElementById(stvarmore).style.display = "none";
				document.getElementById(stvarlink).style.display = "";
			}
		}
	}	
	
	function hidemore(stvar){		
		var stvarlink, stvarmore;		
		for(var i=1;i<=5;i++){
			if(stvar == i){
				stvarlink = i+"morelink";
				stvarmore = i+"more";						
				document.getElementById(stvarmore).style.display = "none";
				document.getElementById(stvarlink).style.display = "";
			}
		}
	}
</script>
