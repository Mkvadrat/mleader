<?php
/*
Template name: Contacts page
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

    <main class="main-contacts">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="grey-padding-block">
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php $sevastopol = get_post_meta( get_the_ID(), 'address_contact_page', $single = true ); ?> 
						
					<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
					<div id="sevastopol" style="width:100; height:338px"></div>
					<script type="text/javascript">
						var sevastopolMap, sevastopolPlacemark, sevastopolcoords;
						ymaps.ready(init);
						function init () {
							//Определяем начальные параметры карты
							sevastopolMap = new ymaps.Map('sevastopol', {
									center: [<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>], 
									zoom: 17
								});	
							//Определяем элемент управления поиск по карте	
							var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});	
							//Добавляем элементы управления на карту
							 sevastopolMap.controls              
								//.add('zoomControl')                
								.add('typeSelector') 
							sevastopolcoords = [<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>];
							//Определяем метку и добавляем ее на карту				
							sevastopolPlacemark = new ymaps.Placemark([<?php if(!empty($sevastopol)){ ?><?php echo $sevastopol; ?><?php }else{ echo '56.326944, 44.0075'; } ?>],{}, {preset: "twirl#redIcon", draggable: true});	
							sevastopolMap.geoObjects.add(sevastopolPlacemark);			
						}
					</script>
                </div>

                <div class="col-md-12">
                    <div class="grey-padding-block grey-padding-block-form">
                        <?php
                            $forms_a = get_field('contact_form_contact_page');
                            if($forms_a){
                                echo do_shortcode('[contact-form-7 id=" ' . $forms_a->ID . ' "]'); 
							}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- end main-index -->

<script type="text/javascript">
//форма обратной связи
function SendForm() {
	var data = {
		'action': 'SendForm',
		'name' : $('#name').val(),
        'phone' : $('#phone').val(),
		'message' : $('#message').val()
	};
	$.ajax({
		url:'http://' + location.host + '/wp-admin/admin-ajax.php',
		data:data,
		type:'POST',
		success:function(data){
			swal({
				title: data.message,
				text: "",
				timer: 1000,
				showConfirmButton: false
			});
		}
	});
};
</script>

<?php get_footer(); ?>