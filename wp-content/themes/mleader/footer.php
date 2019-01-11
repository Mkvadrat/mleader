<?php
/*
Theme Name: Mleader
Theme URI: http://mleader.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mleader.ru/
Version: 1.0
*/
?>
        
    <!-- start footer -->
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if (has_nav_menu('footer_menu')){
                            wp_nav_menu( array(
                                'theme_location'  => 'footer_menu',
                                'menu'            => '',
                                'container'       => false,
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<nav><ul>%3$s</ul></nav>',
                                'depth'           => 2,
                                //'walker'          => new footer_menu(),
                            ) );
                        }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="products-list">
                        <?php
                            if (has_nav_menu('category_menu')){
                                wp_nav_menu( array(
                                    'theme_location'  => 'category_menu',
                                    'menu'            => '',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_page_menu',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul>%3$s</ul>',
                                    'depth'           => 1,
                                    //'walker'          => new footer_menu(),
                                ) );
                            }
                        ?>
                        
                        <?php
                            if (has_nav_menu('category_menu_second')){
                                wp_nav_menu( array(
                                    'theme_location'  => 'category_menu_second',
                                    'menu'            => '',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_page_menu',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul>%3$s</ul>',
                                    'depth'           => 1,
                                    //'walker'          => new footer_menu(),
                                ) );
                            }
                        ?>
                        
                        <?php
                            if (has_nav_menu('category_menu_third')){
                                wp_nav_menu( array(
                                    'theme_location'  => 'category_menu_third',
                                    'menu'            => '',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_page_menu',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul>%3$s</ul>',
                                    'depth'           => 1,
                                    //'walker'          => new footer_menu(),
                                ) );
                            }
                        ?>
                    </div>
                    
                    <?php echo getMeta('contact_block_c_main_page'); ?>
                </div>
                <div class="col-md-12 bottom-line">
                    <?php echo getMeta('wrapper_main_page'); ?>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- end footer -->

</div>

<?php wp_footer(); ?>

<?php echo getMeta('yandex_metrik_main_page'); ?>

<?php echo getMeta('google_metrik_main_page'); ?>

</body>
</html>

