<?php 
/*
Template Name: Apply
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

					<h1 class="h2 bordered"><?php the_field('title'); ?></h1>
					
					<aside>

						<div class="info">
							<span><?php the_field('infoTitle'); ?></span>
							<strong><?php the_field('infoTxt'); ?></strong>
						</div>

						<div class="address">
							<h3><?php the_field('addressTitle'); ?></h3>
							<p>
								<em><?php the_field('placeName'); ?></em>
								<?php the_field('address'); ?>
							</p>
						</div>

					</aside><section>
						<?php the_content(); ?>
					</section>

				<?php else : ?>
							
					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>