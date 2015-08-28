<?php 
/*
Template Name: Live pages
*/

get_header(); ?>
	
	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<?php if ( have_posts() ) : the_post(); ?>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>
				
			<?php get_template_part( 'includes/sidebar-live' ); ?><section class='main live'>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>

					<?php the_content(); ?>
					
					<?php the_field('video'); ?>
					
					<?php the_field('secondPart'); ?>

			</section>

			<div></div>

		</div>

	<?php else : ?>
				
		<h1>404</h1>

	<?php endif; ?>

	</div>

<?php get_footer(); ?>