<?php get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<?php global $wp_post_types; ?>
				<a href="<?php echo site_url('/') . $wp_post_types['board-members']->rewrite['slug']; ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>

			<?php require( get_template_directory() . '/includes/sidebar-study.php' ); ?><section class='main'>
				<article>

					<?php if ( have_posts() ) : the_post(); ?>
					
						<?php get_template_part( 'includes/teacher-single' ); ?>
								
					<?php else : ?>
														
						<h1>404</h1>

					<?php endif; ?>
														
				</article>
			</section>

		</div>

	</div>

<?php get_footer(); ?>