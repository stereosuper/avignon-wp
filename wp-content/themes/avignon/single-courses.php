<?php get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<?php global $wp_post_types; ?>
				<a href="<?php echo site_url('/') . $wp_post_types['courses']->rewrite['slug']; ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>

			<?php get_template_part( 'includes/sidebar-study' ); ?><section class='main'>
				<article>

					<?php if ( have_posts() ) : the_post(); ?>
							
						<h1 class='h2 bordered'><?php the_title(); ?></h1>
						
						<aside class='aside-course'>
							<?php $authors = get_field('author'); 
								if($authors) :
									foreach( $authors as $a ): ?>
										<?php echo get_the_post_thumbnail($a->ID, 'teacher-small-thumb'); ?>
										<div>
											<span>
												By 
												<a href='<?php echo get_the_permalink($a->ID); ?>' title='Read more about <?php echo get_the_title($a->ID); ?>'><?php echo get_the_title($a->ID); ?></a>
											</span>
											<br/>
											<span class='author'><?php the_field('functionShort', $a->ID); ?>,</span>
											<span><?php the_field('establishment', $a->ID); ?></span>
										</div>
									<?php endforeach;
								endif;
							?>
						</aside><section>
							<?php the_content(); ?>

							<?php if(get_field('btn') && get_field('file')): ?>
								<div class='center'>
									<a href='<?php the_field("file"); ?>' class='btn' target='_blank'><?php the_field('btn'); ?></a>
								</div>
							<?php endif; ?>
						</section>

						<div class='nav-course clearfix'>

							<?php 
								function navCourses($id, $text, $class){
									$output = '<a href="'. get_permalink( $id ) .'" title="Go to '. $text .'" class="'. $class .'">';
									$output .= '<span class="nav-btn">'. $text .'</span>';
									$output .= '<span><span class="ref">'. get_field('ref', $id) .'</span>';
									$output .= '<span class="title-course">' . get_the_title( $id ) . '</span>';

									$authorsNav = get_field('author', $id);
									if($authorsNav) :
										foreach( $authorsNav as $aN ): 
											$output .= '<span class="author">By '. get_the_title($aN->ID) .'</span>';
										endforeach;
									endif;

									$output .= '</span></a>';
									return $output;
								}
							
								$prev = get_previous_post( true, '', 'types' ); 
								if($prev){
									echo navCourses($prev->ID, 'Previous course', 'prev'); 
								}

								$next = get_next_post( true, '', 'types' ); 
								if($next){
									echo navCourses($next->ID, 'Next course', 'next'); 
								}
							?>
						</div>

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