<?php get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
			</div>
		</div>

		<div class='container default'>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>

				<?php endwhile; ?>
			
			<?php else : ?>
						
				<?php get_template_part( 'includes/404' ); ?>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>