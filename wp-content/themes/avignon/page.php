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
						
				<h1>404 - Page not found</h1>
				<p>
					We are sorry, the page you're looking for doesn't exist or has been removed.<br/>
					You can check the <a href='<?php echo site_url(); ?>/sitemap'>sitemap</a> if you're lost!
				</p>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>