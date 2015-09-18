<?php
/*
Template Name: Apply Success
*/

get_header(); ?>

	<?php get_template_part( 'includes/header-study' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<div class='arianne' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
                <a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<div class='container'>

			<?php get_template_part( 'includes/sidebar-study' ); ?><section class='main'>

				<?php if ( have_posts() ) : the_post(); ?>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>

                    <div class="gform_confirmation_wrapper">
                        <div class="gform_confirmation_message">
                            <h2 class="small"><?php the_field('success'); ?></h2>
                        </div>
                    </div>

                    <aside>
                        <div class="address">
                            <h3><?php the_field('addressTitle', 'options'); ?></h3>
                            <p>
                                <em><?php the_field('placeName', 'options'); ?></em>
                                <?php the_field('address', 'options'); ?>
                            </p>
                        </div>
                    </aside><section>

                        <h2><?php the_field('subtitle'); ?></h2>
                        
                        <p><?php the_field('recommenders'); ?></p>
                        <ul>
                            <li>
                                <a href="<?php echo add_query_arg( array( 'token' => $_GET['token'], 'reference' => 1 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?>">
                                    <?php echo $_GET['reference_name_1'] ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo add_query_arg( array( 'token' => $_GET['token'], 'reference' => 2 ), get_permalink( AVIGNON_RECOMMENDATION_PAGE_ID ) ) ?>">
                                    <?php echo $_GET['reference_name_2'] ?>
                                </a>
                            </li>
                        </ul>
                        
                        <?php the_field('text'); ?>

                        <ul>
                            <li>
                                <a href="<?php the_field( 'health_evaluation_file', 'options' ) ?>">
                                    Health evaluation form
                                </a>
                            </li>
                        </ul>
                        
                        <p><?php the_field('last'); ?></p>
                    </section>

				<?php else : ?>

					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>