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

    <main class="main-404">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    
                    <div class="grey-padding-block">
                        <p class="h2-title">Ошика 404</p>
                        <p>Данная страница не найдена</p>
                        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->

<?php get_footer(); ?>