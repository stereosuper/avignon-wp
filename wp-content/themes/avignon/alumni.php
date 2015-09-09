<?php 
/*
Template Name: Alumni
*/

get_header(); ?>

	<?php get_template_part( 'includes/header-live' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
			</div>
		</div>

		<div class='container default'>

			<?php get_template_part( 'includes/sidebar-alumni' ); ?><section class='main live'>

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>
					
					<div class='text-alumni'>
						<?php the_content(); ?>
					</div><div class='img-alumni'>
						<?php echo wp_get_attachment_image( get_field('alumniImg') ); ?>
					</div>

					<div class='nav-alumni'>
						<a href='<?php the_field('blogUrl', 'options'); ?>' class='btn'>Alumni's blog</a>

						<div class='block-xp'>
							<em><?php the_field('getinvolvedText'); ?></em>
							<a href='<?php the_field('getinvolved'); ?>' class='btn-arrow'>Get involved</a>
						</div>
					</div>
						
					<?php $count = 0; $loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 2) ); 
					if($loop->have_posts()){ ?>

						<h2>Latest Articles</h2>

						<ul class='courses-list'>

							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?><li <?php if($count % 2 == 0) echo 'class="first"'; ?>>

								<a href='<?php the_permalink(); ?>' <?php if ( get_avatar( get_the_author_meta('ID') ) ) { echo "class='hasImg'"; } ?>>

									<?php if ( get_avatar( get_the_author_meta('ID') ) ) { echo get_avatar( get_the_author_meta('ID'), '120', get_template_directory_uri().'/layoutImg/no-photo.png' ); } ?>

									<span class='date'><?php echo get_the_date(); ?></span>
									<span class='title'>
										<strong class='title-course'><?php the_title(); ?> - </strong>
										<span class='author'>By <?php the_author(); ?></span>
									</span>
									<span class='txt'><?php echo get_the_excerpt(); ?></span>
									<span class='btn-arrow'>Read more</span>

								</a>
								
							</li><?php $count ++; endwhile; ?>

						</ul>

					<?php } ?>

				<?php else : ?>
						
					<h1 class="h2 bordered">404 - Page not found</h1>
					<p>
						We are sorry, the page you're looking for doesn't exist or has been removed.<br/>
						You can check the <a href='<?php echo site_url(); ?>/sitemap'>sitemap</a> if you're lost!
					</p>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>