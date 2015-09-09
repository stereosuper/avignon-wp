<?php get_header(); ?>
	
	<?php get_template_part( 'includes/header-live' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
			</div>
		</div>

		<div class='container default'>

			<?php if ( have_posts() ) : 
			global $paged;
			if(get_query_var('paged')){
				$paged = get_query_var('paged');
			}elseif(get_query_var('page')){
				$paged = get_query_var('page');
			}else{
				$paged = 1;
			} ?>

			<?php get_template_part( 'includes/sidebar-alumni' ); ?><section class='main live'>

				<h1 class="h2 bordered">Blog</h1>

				<ul class='courses-list'>
					
					<?php $count = 0; ?>
					<?php while ( have_posts() ) : the_post(); ?><li <?php if($count % 2 == 0) echo 'class="first"'; ?>>

						<a href='<?php the_permalink(); ?>' <?php if ( get_avatar( get_the_author_meta('ID') ) ) { echo "class='hasImg'"; } ?>>

							<?php if ( get_avatar( get_the_author_meta('ID') ) ) { echo get_avatar( get_the_author_meta('ID'), '120', get_template_directory_uri().'/layoutImg/no-photo.png' ); } ?>

							<span class='date'><?php echo get_the_date(); ?></span>
							<span class='title'>
								<strong class='title-course'><?php the_title(); ?> - </strong>
								<span class='author'>By <?php the_author(); ?></span>
							</span>
							<span class='txt'><?php echo get_the_excerpt(); ?></span>
							<span class='btn-arrow'>Read more</span>

						</a>
						
					</li><?php $count ++; endwhile; ?>

				</ul>

				<div class='pagination'><?php echo paginate_links( array('prev_text' => '<span class="icon-left"><span class="hidden">Previous</span></span>', 'next_text' => '<span class="icon-arrow"><span class="hidden">Next</span></span>', 'type' => 'list') ); ?></div>

			</section>
			
			<?php else : ?>
						
				<p>Nothing was post here.</p>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>