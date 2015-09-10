<?php 
/*
Template Name: Sitemap
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

		<div class='container default'>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>

					<h2 class='bordered'>Pages</h2>
					<ul class='sitemap'>
						<?php wp_list_pages( array('post_type' => 'page', 'title_li' => '', 'sort_column' => 'post_title') ); ?>
					</ul>

					<?php 
						function listPosts($postType, $tax){
							if($tax) 
								$options = array( array('taxonomy' => 'types', 'field' => 'slug', 'terms' => $tax) );

							$posts = get_posts( array('post_type' => $postType, 'orderby' => 'title', 'posts_per_page' => -1, 'order' => 'ASC', 'tax_query' => $options) );

							if(!$posts) 
								echo '<p>Nothing was found</p>';

							$output = "<ul class='sitemap'>";
							foreach( $posts as $post ){
								$output .= '<li>';
								$output .= '<a href="'. get_permalink($post->ID) .'" title="Go to '. get_the_title($post->ID) .'">';
								$output .= get_the_title($post->ID);
								$output .= '</a>';
								$output .= '</li>';
							}
							$output .= '</ul>';

							echo $output;
						}
					?>

					<h2 class='bordered'>Advisory Board Members</h2>
					<?php listPosts('board-members', ''); ?>

					<h2 class='bordered'>Courses</h2>
					<?php 
						$cats = get_terms( 'types', array('order' => 'DESC') ); 

						foreach($cats as $cat){ ?>
							<h3><a href='<?php echo get_term_link( $cat ); ?>'><?php echo $cat->name; ?></a></h3>
							<?php listPosts('courses', $cat->slug); 
						}					
					?>

					<h2 class='bordered'>Teachers</h2>
					<?php listPosts('teachers', ''); ?>

					<h2 class='bordered'>Alumni's Blog posts</h2>
					<?php listPosts('post', ''); ?>

				<?php endwhile; ?>
			
			<?php else : ?>
						
				<?php get_template_part( 'includes/404' ); ?>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>