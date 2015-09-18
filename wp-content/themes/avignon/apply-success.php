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
                            <h2 class="small">Your informations have been successfully sended</h2>
                        </div>
                    </div>

                    <aside>
                        <div class="address">
                            <h3>Address all correspondence to :</h3>
                            <p><em>Institut d'Etudes Françaises d'Avignon</em>
                                Bryan Mawr College, 101 North<br>
                                Merion Avenue<br>
                                Bryn Mawr, PA 19010-2899
                            </p>
                        </div>
                    </aside><section>
                        <h2>Your application has been submitted. Please complete these steps in order to be officially enrolled:</h2>

                        <p>
                            Your recommenders (French professor and dean, or graduate advisor) should have received a recommendation request by email.
                            Please confirm that they have received a request from us. If not, they may access the information via this link:
                        </p>

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

                        <p>NB: please don’t forget to have your official transcripts mailed to us! (mailing address: see below)</p>

                        <p>
                            Once you have provided all required materials, including your recommendations and transcripts,
                            your application will be considered for enrollment.
                            You will be notified by email whether your application has been accepted or rejected.
                        </p>

                        <p>
                            If your application has been accepted, you will still need to provide us with a signed health evaluation
                            from your primary care doctor in order for you to be officially enrolled in the program.
                            Here is the form to be completed by you and your doctor:
                        </p>

                        <ul>
                            <li>
                                <a href="<?php echo add_query_arg( 'token', $_GET['token'], get_permalink( AVIGNON_HEALTH_EVALUATION_PAGE_ID ) ) ?>">
                                    Health evaluation form
                                </a>
                            </li>
                        </ul>

                        <p>
                            Once this form is submitted, you will receive a link to upload this document.
                        </p>
                    </section>

					<?php the_content(); ?>

				<?php else : ?>

					<?php $border = true; get_template_part( 'includes/404' ); ?>

				<?php endif; ?>

			</section>

		</div>

	</div>

<?php get_footer(); ?>