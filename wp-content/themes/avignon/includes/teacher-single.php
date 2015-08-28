<?php ?>

<h1 class='h2 bordered'><?php the_title(); ?></h1>

<aside class='contact-teacher'>
	<?php
		if(has_post_thumbnail()){
			the_post_thumbnail('teacher-thumb');
		}else{ ?>
			<img src='<?php echo get_template_directory_uri(); ?>/layoutImg/no-photo-big.png' alt='<?php the_title(); ?>' height='220' width='220'/>
		<?php }
	?>
	<p class='address-teacher'><?php the_field('functionLong'); ?></p>
	<span><?php the_field('establishment'); ?></span>
	<?php the_field('contact'); ?>
</aside><section>
	<?php the_content(); ?>
</section>