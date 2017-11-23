<?php
/*
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

    <main class="main-articles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					
					<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
					
					<?php
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'terms' => getCurrentCatID()
								)
							),
							'post_type'   => 'post',
							'orderby'     => 'date',
							'order'       => 'DESC',
							'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
							'paged'          => $current_page,
						);
			
						$service_list = get_posts( $args );
					?>
					<ul class="product-list">
						<?php if($service_list){ ?>
						<?php foreach($service_list as $service){ ?>
						<?php
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($service->ID), 'full');
							$descr = wp_trim_words( $service->post_content, 30, '...' );
							$link = get_permalink($service->ID);
						?>
                        <li>
							<?php if(!empty($image_url)){ ?>
								<img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($service->ID), '_wp_attachment_image_alt', true ); ?>">
							<?php }else{ ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/product-1.jpg">
							<?php } ?>
                            <div class="description">
                                <p class="h3-title"><?php echo $service->post_title; ?></p>
                                <p><?php echo $descr; ?></p>
                                <p><a href="<?php echo $link; ?>">Подробнее</a></p>
                            </div>
                        </li>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
						<?php }else{ ?>
						<li>В данной категории продуктов не найдено!</li>
						<?php } ?>
					</ul>
					
					<?php
						$defaults = array(
							'type' => 'array',
							'prev_next'    => True,
							'prev_text'    => __(''),
							'next_text'    => __(''),
						);
	
						$pagination = paginate_links($defaults);
						
					if($pagination){
					?>
					<ul class="bread-crumbs">
						<?php foreach ($pagination as $pag){ ?>
	                        <li><?php echo $pag; ?></li>
						<?php } ?>
                    </ul>
					<?php }else{ ?>
					<ul class="bread-crumbs">
					<li></li>
					</ul>
					<?php } ?>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->

<?php get_footer(); ?>