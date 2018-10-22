<?php
/*
Template name: Gallery page
Theme Name: Mleader
Theme URI: http://mleader.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mleader.ru/
Version: 1.0
*/

get_header(); 
?>
    
    <!-- start main-index -->

    <main class="main-materials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    
                    <div class="grey-padding-block">
                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>

                        <ul class="description-category">
                            <?php
								global $nggdb;
								$gallery_id = getNextGallery(get_the_ID(), 'gallery_material_page');
								$gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
								if($gallery_image){
									foreach($gallery_image as $image) {
										if(!$image->exclude == 1){
								?>
                                    <li>
                                        <a href="<?php echo nextgen_esc_url($image->imageURL); ?>" class="fancybox" rel="group">
                                            <span class="block-photo">
                                                <img src="<?php echo nextgen_esc_url($image->imageURL); ?>" alt="">
                                            </span>
                                            <span class="title"><?php echo esc_attr($image->alttext); ?></span>
                                        </a>
                                    </li>
								<?php
										}
									}
								}
							?>
                        </ul>

                        <p class="button-wrap">
                            <a class="button backward back" href="javascript:void(0)">Назад</a>
                            <a class="button" href="#">Задать вопрос</a>
                        </p>
                        <!-- <p><a class="get-more back" href="javascript:void(0)">Назад к списку материалов</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->
    
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.back').click(function(){
		parent.history.back();
		return false;
	});
});
</script>


<?php get_footer(); ?>