<?php get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<?php global $wp_post_types; ?>
				<a href="<?php echo site_url('/') . $wp_post_types['teachers']->rewrite['slug']; ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>

			<?php require( get_template_directory() . '/includes/sidebar-study.php' ); ?><section class='main'>
				<article>

					<?php if ( have_posts() ) : the_post(); ?>
					
						<?php get_template_part( 'includes/teacher-single' ); ?>

						<?php 

							$courses = get_posts(array(
								'post_type' => 'courses',
								'meta_query' => array(
									array(
										'key' => 'author',
										'value' => '"' . get_the_ID() . '"',
										'compare' => 'LIKE'
									)
								)
							));

						?>
						
						<?php if( $courses ): $count = 0; ?>

							<div class='written-by'>
								<h2 class='medium bordered'>Courses taught</h2>
								<ul class='courses-list'>
									<?php foreach( $courses as $course ): ?><li <?php if($count % 2 == 0) echo 'class="first"'; ?>>
										
										<a href="<?php echo get_permalink($course->ID); ?>">
											<span class='ref'><?php the_field('ref', $course->ID); ?></span>
											<strong class='title-course'><?php echo get_the_title($course->ID); ?></strong>
											<span class='btn-arrow'>Read more</span>
										</a>
									
									</li><?php $count ++; endforeach; ?>
								</ul>
							</div>

						<?php endif; ?>
						
								
					<?php else : ?>
														
						<?php $border = true; get_template_part( 'includes/404' ); ?>

					<?php endif; ?>
														
				</article>
			</section>

		</div>

	</div>

<?php get_footer(); ?>