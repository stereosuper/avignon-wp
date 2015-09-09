<?php get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>

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
														
						<h1 class="h2 bordered">404 - Page not found</h1>
						<p>
							We are sorry, the page you're looking for doesn't exist or has been removed.<br/>
							You can check the <a href='<?php echo site_url(); ?>/sitemap'>sitemap</a> if you're lost!
						</p>

					<?php endif; ?>
														
				</article>
			</section>

		</div>

	</div>

<?php get_footer(); ?>