<?php 
/*
Template Name: Faculty
*/

get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
			</div>
		</div>

		<div class='container'>

			<?php get_template_part( 'includes/sidebar-study' ); ?><section class='main'>

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>
					<div class='intro'><?php the_content(); ?></div>

					<?php

					$loop = new WP_Query( array( 'post_type' => 'teachers', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );

					get_template_part( 'includes/teachers-list' );	

				else : ?>
							
					<h1>404</h1>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>