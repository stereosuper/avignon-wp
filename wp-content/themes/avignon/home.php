<?php get_header(); ?>
	
	<div id="mask"></div>
	<div id="bloc-top"><div id="bg-top"></div></div>

	<div class="bloc-content white-bg" role='main'>

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

			<aside class="second-menu" data-scroll='submenu'>

				<h2 class="h3">Categories</h2>
				<ul class='menu'><?php wp_list_categories( array('title_li' => '') ); ?></ul>

			</aside><section class='main live'>

				<h1 class="h2 bordered">Blog</h1>

				<?php while ( have_posts() ) : the_post(); ?>
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="post-meta">
						<span class='date'><?php echo get_the_date(); ?> - </span>
						<span class='date'><?php if(get_the_category()){ foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' '; } } ?></span>
					</div>

					<?php if ( has_post_thumbnail() ) { ?> <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a> <?php } ?>
					
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>">lire la suite</a>
				
				<?php endwhile; ?>

				<?php echo paginate_links( $args ); ?>

			</section>
			
			<?php else : ?>
						
				<p>Pas d'articles</p>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>