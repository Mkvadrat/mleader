<?php 
/**
Template Page for the album overview

Follow variables are useable :

	$album     	 : Contain information about the album
	$galleries   : Contain all galleries inside this album
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) { ?>

	<?php foreach ($galleries as $gallery) { ?>
		<li>
			<a href="<?php echo $gallery->pagelink ?>">
				<span class="block-photo">
					<img src="<?php echo $gallery->previewurl ?>" alt="">
				</span>
				<span class="title"><?php echo $gallery->title; ?></span>
			</a>
		</li>
 	<?php } ?>
 	
<?php } ?>