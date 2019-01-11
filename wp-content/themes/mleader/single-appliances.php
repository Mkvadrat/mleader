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
                        <p class="h1-title"><?php echo the_title(); ?></p>
                        <div class="two_colons">
                            <?php $images = get_field('image_group_product_appliances_single', $list->ID); ?>
                            <div class="img">
                                <?php if($images){ ?>
                                <?php foreach($images as $image){ ?>
                                <?php if(!empty($images)) ?>
                                <a data-fancybox="gallery" href="<?php echo $image['image_product_appliances_single'] ? $image['image_product_appliances_single'] : '/wp-content/themes/mleader/images/placeholder.jpg'; ?>"><img src="<?php echo $image['image_product_appliances_single'] ? $image['image_product_appliances_single'] : '/wp-content/themes/mleader/images/placeholder.png'; ?>" alt=""></a>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <div>
                                <?php
                                    $term = get_the_terms(get_the_ID(), 'appliances-list');
                                    
                                    $data = getData(get_the_ID(), $term[0]->term_id);
                                ?>
                                <?php if($data){?>
                                <p class="h2-title">Описание</p>
                                <?php } ?>
                                
                                <?php if(!empty($data['artikul'])){?>
                                <p>Артикул — <?php echo $data['artikul']; ?>,</p>
                                <?php } ?>
                                
                                <?php if(!empty($data['cvet'])){?>
                                <p>Цвет — <?php echo $data['cvet']; ?>,</p>
                                <?php } ?>
                                
                                <?php if(!empty($data['mat'])){?>
                                <p>Материал — <?php echo $data['mat']; ?>,</p>
                                <?php } ?>
                                
                                <?php if(!empty($data['proizvoditel'])){?>
                                <p>Производитель — <?php echo $data['proizvoditel']; ?>,</p>
                                <?php } ?>
                                
                                <?php if(!empty($data['price'])){?>
                                <p>Цена: <span class="h2-title"><?php echo $data['price']; ?> руб.</span></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie1'])){?>
                                <p><?php echo $data['opisanie1']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie2'])){?>
                                <p><?php echo $data['opisanie2']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie3'])){?>
                                <p><?php echo $data['opisanie3']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie4'])){?>
                                <p><?php echo $data['opisanie4']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie5'])){?>
                                <p><?php echo $data['opisanie5']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie6'])){?>
                                <p><?php echo $data['opisanie6']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie7'])){?>
                                <p><?php echo $data['opisanie7']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie8'])){?>
                                <p><?php echo $data['opisanie8']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie9'])){?>
                                <p><?php echo $data['opisanie9']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie10'])){?>
                                <p><?php echo $data['opisanie10']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie11'])){?>
                                <p><?php echo $data['opisanie4']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie12'])){?>
                                <p><?php echo $data['opisanie12']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie13'])){?>
                                <p><?php echo $data['opisanie13']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie14'])){?>
                                <p><?php echo $data['opisanie14']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie15'])){?>
                                <p><?php echo $data['opisanie15']; ?></p>
                                <?php } ?>
                                
                                <?php if(!empty($data['opisanie_html'])){?>
                                <?php $descr = html_entity_decode($data['opisanie_html'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo $data['opisanie_html']; ?>
                                <?php } ?>
                            </div>
                        </div>

                        <p class="button-wrap">
                            <a class="button backward back" href="javascript:void(0)">Назад</a>
                            <a class="button" href="#">Задать вопрос</a>
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