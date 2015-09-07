<?php get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='container default'>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article>
							
						<h1><?php the_title(); ?></h1>
						<div class="post-meta">
							<span class='date'><?php echo get_the_date(); ?></span>
						</div>
								
						<?php the_content(); ?>
								
					</article>

				<?php endwhile; ?>


			<?php else : ?>
						
				<article>
					<h1>404</h1>
				</article>

			<?php endif; ?>


		</div>

	</div>

<?php get_footer(); ?>
