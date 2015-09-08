<?php get_header(); ?>

	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php the_field('blogUrl', 'options'); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container default'>

			<?php get_template_part( 'includes/sidebar-blog' ); ?><section class='main live'>

				<article>

					<?php if ( have_posts() ) : the_post(); ?>

						<h1 class="h2 bordered"><?php the_title(); ?></h1>

						<div class="post-meta">
							<div class='img'>
								<?php if ( get_avatar( get_the_author_meta('ID') ) ) { echo get_avatar( get_the_author_meta('ID'), '135', get_template_directory_uri().'/layoutImg/no-photo.png' ); } ?>
							</div><div class='txt'>
								<span class='date'><?php echo get_the_date(); ?></span>
								<span class='author'>By <?php the_author(); ?></span>
								<p class='desc'><?php echo get_the_author_meta('description'); ?></p>
							</div>
						</div>

						<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
									
						<?php the_content(); ?>

						<div class='nav-course nav-post clearfix'>
							<?php 
								function navPosts($id, $text, $class){
									$output = '<a href="'. get_permalink( $id ) .'" title="Go to '. $text .'" class="'. $class .'">';
									$output .= '<span class="nav-btn">'. $text .'</span>';
									$output .= '<span><span class="date">'. get_the_date( 'F j, Y', $id ) .'</span>';
									$output .= '<span class="title-course">' . get_the_title( $id ) . '</span>';
									$output .= '</span></a>';
									return $output;
								}
							
								$prev = get_previous_post(); 
								if($prev){
									echo navPosts($prev->ID, 'Previous post', 'prev'); 
								}

								$next = get_next_post(); 
								if($next){
									echo navPosts($next->ID, 'Next post', 'next'); 
								}
							?>
						</div>

					<?php else : ?>

						<h1 class="h2 bordered">404</h1>

						<p>Post not found</p>

					<?php endif; ?>

				</article>

			</section>

		</div>

	</div>

<?php get_footer(); ?>
