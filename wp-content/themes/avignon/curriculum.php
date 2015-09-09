<?php 
/*
Template Name: Curriculum
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

			<?php get_template_part( 'includes/sidebar-study' ); ?><section class="main">

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class='h2 bordered'><?php the_title(); ?></h1>
					<div class='intro'><?php the_content(); ?></div>

					<?php

					$cats = get_terms( 'types', array('order' => 'DESC') );

					foreach($cats as $cat) : 

						$loop = new WP_Query( array( 'post_type' => 'courses', 'posts_per_page' => 4, 'order' => 'ASC', 'tax_query' => array( array('taxonomy' => 'types', 'field' => 'slug', 'terms' => $cat->slug) ) ));

						if( $loop->have_posts() ) : $count = 0; ?>

							<h2 class='bordered medium'><a href='<?php echo get_term_link( $cat ); ?>'><?php echo $cat->name; ?></a></h2>
							<?php if($cat->description != '') echo '<div class="intro"><p>' . $cat->description . '</p></div>'; ?>

							<ul class='courses-list'>

								<?php while( $loop->have_posts() ) : $loop->the_post(); ?><li <?php if($count % 2 == 0) echo 'class="first"'; ?>>
										
										<a href='<?php the_permalink(); ?>'>
											<span class='ref'><?php the_field('ref'); ?></span>
											<strong class='title-course'><?php the_title(); ?> - </strong>
											<span class='author'>
												<?php $authors = get_field('author'); 
													if($authors) :
														foreach( $authors as $a ):
															echo 'By ' . get_the_title($a->ID);
														endforeach;
													endif;
												?>
											</span>
											<span class='btn-arrow'>Read more</span>
										</a>

								</li><?php $count ++; endwhile; ?>

							</ul>

							<hr>

						<?php endif; 

					endforeach;

					wp_reset_query(); ?>

				<?php else : ?>
							
					<h1 class="h2 bordered">404 - Page not found</h1>
					<p>
						We are sorry, the page you're looking for doesn't exist or has been removed.<br/>
						You can check the <a href='<?php echo site_url(); ?>/sitemap'>sitemap</a> if you're lost!
					</p>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>