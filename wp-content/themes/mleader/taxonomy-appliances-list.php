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
    <main class="main-materials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    
                    <div class="grey-padding-block">
                        <p class="h2-title"><?php echo single_cat_title(); ?></p>
                        
                        <?php $text = get_field('text_appliances_category'); ?>
                        <?php if($text){ ?>
                            <?php echo $text; ?>
                        <?php } ?>
                        
                        <?php
                            $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                            $args = array(
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'appliances-list',
                                        'field' => 'id',
                                        'terms' => array( get_queried_object()->term_id )
                                    )
                                ),
                                    'post_type' => 'appliances',
                                    'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
                                    'paged'          => $current_page
                            );
                
                            $appliances_list = get_posts( $args );
                        ?>

                        <ul class="description-category">
                            <?php if($appliances_list){ ?>
                            
                            <?php foreach($appliances_list as $list){ ?>
                            <?php $data = getImport($list->ID, get_post_meta( $list->ID, 'sku_product_appliances_single', $single = true ),  get_queried_object()->term_id); ?>
                            <?php $images = get_field('image_group_product_appliances_single', $list->ID); ?>
                            <li>
                                <a href="<?php echo get_permalink($list->ID);?>">
                                    <span class="block-photo">
                                        <?php if($images) { ?>
                                        <?php $i = 0; ?>
                                        <?php foreach($images as $image){ ?>
                                            <?php $i++; ?>
                                            <?php if($i > 1) break;  ?>
                                            <img src="<?php echo $image['image_product_appliances_single'] ? $image['image_product_appliances_single'] : '/wp-content/themes/mleader/images/placeholder.jpg'; ?>" alt="">
                                        <?php } ?>
                                        <?php } ?>
                                    </span>
                                    <span class="title"><?php echo $list->post_title; ?><br>
                                    <?php if($data['price']){ ?>
                                        <strong><?php echo $data['price']; ?> руб.</strong>
                                    <?php } ?>
                                    </span>
                                </a>
                            </li>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                            <?php }else{ ?>
                            <li class="product-not-found">Товары в данном разделе не найдены!</li>
                            <?php } ?>
                        </ul>
                        
                        <?php
                        $defaults = array(
                            'type' => 'array',
                            'prev_next'    => True,
                            'prev_text'    => __('<'),
                            'next_text'    => __('>'),
                        );
            
                        $pagination = paginate_links($defaults);
                        
                        if($pagination){
                        ?>
                        <ul class="paggination">
                            <?php foreach ($pagination as $pag){ ?>
                                <li><?php echo $pag; ?></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>

                        <p class="button-wrap">
                            <a class="button backward back" href="javascript:void(0)">Назад</a>
                            <a href="#callback" class="button fancybox">Задать вопрос</a>
                        </p>
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