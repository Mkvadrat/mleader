<?php
/*
Template name: Work main page
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

	<main class="main-work">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					
					<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

					<?php if (have_posts()): while (have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
					
					<p class="button-wrap">
						<a class="button backward" href="javascript:void(0)">Назад</a>
						<a class="button" href="#">Задать вопрос</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.button.backward').click(function(){
			parent.history.back();
			return false;
		});
	});
	</script>

<?php get_footer(); ?>