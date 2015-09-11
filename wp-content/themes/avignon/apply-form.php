<?php 
/*
Template Name: Apply Forms
*/

get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>

			<?php get_template_part( 'includes/sidebar-study' ); ?><section class='main'>

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
					<noscript>
						<p>If the page is blank, you need to enable javascript to fill the form.</p>
					</noscript>

				<?php else : ?>
							
					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>