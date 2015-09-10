<?php 
/*
Template Name: Calendar
*/

get_header(); ?>
	
	<?php get_template_part( 'includes/header-study' ); ?>

	<div class="bloc-content white-bg" role='main'>

		<?php if ( have_posts() ) : the_post(); ?>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
				
				<?php $postType = get_field('slug'); ?>
				<?php $url = str_replace('http://', '', get_site_url()); ?>
				<ul>
					<li><a href='<?php echo "webcal://" . $url . "?feed=avignon-".$postType; ?>' title='Suscribe to these <?php echo $postType; ?> in iCal' class='btn-arrow' rel='nofollow'>Add to iCal</a></li>
					<li class='none850'><a href='https://www.google.com/calendar/render?cid=<?php echo site_url() . "?feed=avignon-".$postType; ?>' title='Suscribe to these <?php echo $postType; ?> in Google Calendar' target='_blank' class='btn-arrow' rel='nofollow'>Add to Google Calendar</a></li>
					<li class='none850'><a href='<?php echo "webcal://" . $url . "?feed=avignon-".$postType; ?>' title='Suscribe to these <?php echo $postType; ?> in MS Outlook' class='btn-arrow' rel='nofollow'>Add to Outlook</a></li>
					<li><a href='<?php echo site_url() . "?feed=avignon-".$postType; ?>' title='Download ICS file' class='btn-arrow' rel='nofollow'>Download .ics</a></li>
				</ul>
			</div>
		</div>

		<div class='container'>
				
			<?php get_template_part( 'includes/sidebar-' . get_field('parent') ); ?><section class='main'>

					<h1 class="h2 bordered"><?php the_title(); ?></h1>

					<?php $today = date('Ymd'); 

					function setDate($date){
						$srtDate = strtotime($date);
						$dateOk = date_i18n('l, F d', $srtDate);
						return $dateOk;
					}

					$loop = new WP_Query( array( 'post_type' => $postType, 'posts_per_page' => -1, 'meta_query' => array( array( 'key' => 'date2'/*, 'compare' => '>=', 'value' => $today*/ ) ), 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );

						if( $loop->have_posts() ) : ?>
						
						<div class='the-content'>
							<ul class='events-list'>

								<?php while( $loop->have_posts() ) : $loop->the_post();  

								$dateOk1 = setDate(get_field('date1'));
								$dateOk2 = setDate(get_field('date2'));

								?>

									<li>
										<span class='date'>
											<?php 
												echo $dateOk1; 
												if(get_field('displayTime1')){ 
													echo ' (' . get_field('time1');
													if(get_field('displayTime2') && $dateOk1 == $dateOk2){
														echo ' to ' . get_field('time2');
													}
													echo ')'; 
												} 
												if($dateOk1 != $dateOk2){ 
													echo ' to ' . $dateOk2; 
													if(get_field('displayTime2')){
														echo ' (' . get_field('time2') . ')';
													}
												}
											?>
										</span>
										<h2 class='small'><?php the_title(); ?></h2>
										<?php the_field('content'); ?>
										<?php if(get_field('file') && get_field('fileName')){ ?>
											<a href='<?php the_field('file'); ?>' title='Download this file' target='_blank' class='btn-arrow'><?php the_field('fileName'); ?></a>
										<?php } ?>
									</li>

								<?php endwhile; ?>

							</ul>

						<?php endif; 

					wp_reset_query(); ?>

					<div>
						<?php the_content(); ?>

						<?php if(get_field('btn') && get_field('file')){ ?>
							<a href='<?php the_field('file'); ?>' target='_blank' class='btn'><?php the_field('btn'); ?></a>
						<?php } ?>
					</div>
				</div>

			</section>

		</div>

	<?php else : ?>

		<div class='arianne clearfix' data-scroll='arianne'>
			<div class="container">
				<a href="<?php echo site_url(); ?>" title="Back to home" class='btn-arrow-back'>Home</a>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Go back" class='btn-arrow-back' data-click='back'>Back</a>
			</div>
		</div>

		<section class='main'>
				
			<?php $border = true; get_template_part( 'includes/404' ); ?>

		</section>

	<?php endif; ?>

	</div>

<?php get_footer(); ?>