<?php
/*
Template name: Work page
Theme Name: Mleader
Theme URI: http://mleader.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mleader.ru/
Version: 1.0
*/

get_header(); 
?>
    
	<!-- start main-work -->
    <main class="main-work">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

                    <div class="grey-padding-block grey-padding-block-first">
						<?php  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); ?>
			
						<?php if(!empty($image_url)){ ?>
							<img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" class="half-img">
						<?php }else{ ?>
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/1.jpg" class="half-img" alt="<?php echo the_title(); ?>">
						<?php } ?>
                       
                        <div class="description">
                            <p class="h2-title"><?php echo the_title(); ?></p>
                            <?php echo get_post_meta( get_the_ID(), 'inter_text_gallery_page', $single = true ); ?>
						</div>
                    </div>
                    
                    <div class="grey-padding-block grey-padding-block-second">
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						
                        <p class="button-wrap button-wrap-last">
							<a class="button backward" href="javascript:void(0)">Назад</a>
                            <a href="#callback" class="button fancybox">Задать вопрос</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end main-work -->
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.button.backward').click(function(){
			parent.history.back();
			return false;
		});
	});
	</script>


<?php get_footer(); ?>