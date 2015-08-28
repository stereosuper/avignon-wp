<?php global $loop, $countCats, $nbCats; if( $loop->have_posts() ) : $count = 0; ?>

	<ul class='teachersList'>

		<?php while( $loop->have_posts() ) : $loop->the_post(); ?><li <?php if($count % 4 == 0) echo 'class="first"'; ?>>

				<a href='<?php the_permalink(); ?>' title='Read more about <?php the_title(); ?>'>
					<?php
						if(has_post_thumbnail()){
							the_post_thumbnail('thumbnail'); 
						}else{ ?>
							<img src='<?php echo get_template_directory_uri(); ?>/layoutImg/no-photo.png' alt='<?php the_title(); ?>' width='180' height='180'/>
						<?php }
					?>
					<strong><?php the_title(); ?></strong>
					<span><?php the_field('functionShort'); ?></span>
					<b><?php the_field('establishment'); ?></b>
				</a>

		</li><?php $count ++; endwhile; wp_reset_query(); ?>

		<?php if( get_field('bottomText') && (!isset($countCats) || $countCats == $nbCats) ){ ?>
			<li><div class='bottomText'><?php the_field('bottomText'); ?></div></li>
		<?php } ?>

	</ul>

<?php endif; ?>