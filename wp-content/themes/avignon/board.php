<?php 
/*
Template Name: Board
*/

get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>
	
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

					$cats = get_terms('board-category', array('order' => 'DESC'));
					$nbCats = wp_count_terms('board-category');
					$countCats = 0;

					foreach($cats as $cat){
						$countCats ++;

						echo '<h2 class="medium bordered">'. $cat->name . '</h2>';
						$loop = new WP_Query( array( 'post_type' => 'board-members', 'posts_per_page' => -1, 'order' => 'ASC', 'board-category' => $cat->slug ) );

						get_template_part( 'includes/teachers-list' );
					}

				else : ?>
							
					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>