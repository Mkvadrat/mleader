<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
<!-- Thumbnails -->
 <ul class="galery">
<?php foreach ( $images as $image ){ ?>
    <li style="background-image: url( '<?php echo $image->imageURL ?>' );">
        <a data-fancybox="gallery" href="<?php echo $image->imageURL ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
    </li>
<?php } ?>
</ul>
<?php endif; ?>