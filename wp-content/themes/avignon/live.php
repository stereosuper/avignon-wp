<?php 
/*
Template Name: Live pages
*/

get_header(); ?>
	
	<?php get_template_part( 'includes/header-live' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>
				
			<?php get_template_part( 'includes/sidebar-live' ); ?><section class='main live'>

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
					<?php the_field('video'); ?>
					
					<?php the_field('secondPart'); ?>

				<?php else : ?>
							
					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>