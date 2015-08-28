<?php get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='container default'>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>

				<?php endwhile; ?>
			
			<?php else : ?>
						
				<h1>404</h1>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>