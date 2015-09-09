<?php get_header(); ?>
	
	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

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

				<?php if ( have_posts() ) : 
				
					global $paged;
					if(get_query_var('paged')){
						$paged = get_query_var('paged');
					}elseif(get_query_var('page')){
						$paged = get_query_var('page');
					}else{
						$paged = 1;
					} 

					$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					global $wp_post_types;

					$count = 0;
				?>

					<h1 class='h2 bordered'><?php echo $term->name; ?></h1>
					<?php if($term->description != '') echo '<div class="intro"><p>' . $term->description . '</p></div>'; ?>

					<ul class='courses-list'>

						<?php while( have_posts() ) : the_post(); ?><li <?php if($count % 2 == 0) echo 'class="first"'; ?>>
								
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

					<div class='pagination'><?php echo paginate_links( array('prev_text' => '<span class="icon-left"><span class="hidden">Previous</span></span>', 'next_text' => '<span class="icon-arrow"><span class="hidden">Next</span></span>', 'type' => 'list') ); ?></div>
	
				<?php else : ?>
							
					<h1 class='h2 bordered'>No courses in this category yet</h1>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>