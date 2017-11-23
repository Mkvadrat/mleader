<?php
/*
Template name: About page
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

    <main class="main-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
					
                    <div class="grey-padding-block">
                        <p class="h2-title"><?php the_title(); ?></p>
                    
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>                    
					</div>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->

<?php get_footer(); ?>