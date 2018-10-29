<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
<!-- Thumbnails -->
<ul class="description-category">
<?php foreach ( $images as $image ){ ?>
    <li>
        <a data-fancybox="gallery" href="<?php echo $image->imageURL; ?>">
            <span class="block-photo">
                <img src="<?php echo $image->imageURL; ?>">
            </span>
            <span class="title"><?php echo $image->alttext; ?></span>
        </a>
    </li>
<?php } ?>
</ul>
<?php endif; ?>