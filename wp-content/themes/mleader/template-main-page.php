<?php
/*
Template name: Main page
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

    <main class="main">

        <!-- start slider -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme top-slider">
                        <?php
                            global $nggdb;
                            $gallery_id = getNextGallery(get_the_ID(), 'banner_main_page');
                            $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
                            if($gallery_image){
                                foreach($gallery_image as $image) {
                                    if(!$image->exclude == 1){
                            ?>
                                <div><img src="<?php echo nextgen_esc_url($image->imageURL); ?>" alt=""></div>
                            <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- end slider -->
        
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

    </main>

    <!-- end main-index -->

    <!--start form -->

    <div class="container-fluid form-line-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-form" class="form-block">
                        <?php
                            $forms_a = get_field('contact_form_main_page');
                            if($forms_a){
                                echo do_shortcode('[contact-form-7 id=" ' . $forms_a->ID . ' "]'); 
							}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end form -->

    <!-- start main-index -->

    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">              
                <?php
                    $args = array(
                        'numberposts' => 4,
                        'post_type'   => 'post',
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                        'post_status' => 'publish',
                    );
        
                    $news_list = get_posts( $args );
                ?>
                <?php if($news_list){ ?>
                <ul class="product-list">
                <?php foreach($news_list as $news){ ?>
                <?php
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($news->ID), 'full');
                    $descr = wp_trim_words( $news->post_content, 30, '...' );
                    $link = get_permalink($news->ID);
                ?>
                    <li>
                        <?php if(!empty($image_url)){ ?>
                            <img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($service->ID), '_wp_attachment_image_alt', true ); ?>">
                        <?php }else{ ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/product-1.jpg">
                        <?php } ?>
                        <div class="description">
                            <p class="h3-title"><?php echo $news->post_title; ?></p>
                            <p><?php echo $descr; ?></p>
                            <p><a href="<?php echo $link; ?>">Подробнее</a></p>
                        </div>
                    </li>
                <?php } ?>
                </ul>
                <?php wp_reset_postdata(); ?>
                <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->
    
<?php get_footer(); ?>