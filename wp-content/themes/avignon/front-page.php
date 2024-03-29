<?php 
/*
Template Name: Home
*/

get_header(); ?>
	
	<div id="mask"></div>
	<div id="bloc-top" class="bloc-top-home">
		<?php
			$styleImg = '';
			if(has_post_thumbnail()){
				$styleImg = 'style="background-image:url('. wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .')"';
			}else if(get_field('studyImg', 'options')){
				$styleImg = 'style="background-image:url('. get_field('studyImg', 'options') .')"';
			}
		?>
		<div id="bg-top" <?php echo $styleImg; ?>></div>

  		<div id="container-bloc-txt-home">
  			<div id="wrapper-bloc-logo-home">
	  			<div id="bloc-logo-home">
					<span class="visu-bloc-logo"></span>
					<span class="txt-bloc-logo"><strong>Institut</strong> d'Avignon</span>
	  			</div>
  			</div>
			
			<div id="wrapper-bloc-txt-home">
				<div id="bloc-txt-home">
					<h1>
						<a href="#zone-left-study" id="btn-study"><?php the_field('studyTitle'); ?></a> 
						<i>&amp;</i> 
						<a href="#live-top" id="btn-live"><?php the_field('liveTitle'); ?></a><br/> 
						<span class="txt-h1"><?php the_field('title'); ?></span>
					</h1>
					<p><?php the_field('sub-title'); ?></p>
				</div>
	  		</div>
			
			<a href='#zone-left-study' id='btn-down-study' class='icon-down2'><span>Down</span></a>
  		</div>
		
		<div class='college'>
  			<div class='container big'>
  				<img src="<?php echo get_template_directory_uri(); ?>/layoutImg/logo-bryn-mawr.png" width="207" height="68" alt="Under the auspices of Bryn Mawr College">
  			</div>
  		</div>
  	</div>

	<div class="bloc-content white-bg" role='main'>

		<?php if ( have_posts() ) : the_post(); ?>

		  	<div id="zone-left-study">

		  		<div id="bloc-img-zone-left-study">
					<div class="content-bloc-img-zone imgLiquidFill">
						<?php echo wp_get_attachment_image( get_field('studyImg1'), 'large' ); ?>
					</div>
		  		</div>

				<div id="bloc-txt-zone-left-study">
					<h2 class="h1"><?php the_field('studyTitle'); ?></h2>
					<h3 class="h2"><?php the_field('curriculumTitle'); ?></h3>
					<p><?php the_field('curriculumText'); ?></p>
					<a href="<?php the_field('curriculumUrl'); ?>" class="btn"><?php the_field('curriculumBtn'); ?></a>
				</div>

		  	</div><div id="zone-right-study">
		  		
		  		<div id="bloc-img-zone-right-study">
					<div class="content-bloc-img-zone imgLiquidFill">
						<?php echo wp_get_attachment_image( get_field('studyImg2'), 'large' ); ?>
					</div>
		  		</div>

				<div id="bloc-txt-zone-right-study">
					<div id="bloc-apply-home" class="bloc-bg-pattern">
						<h3 class="h2"><?php the_field('applyTitle'); ?></h3>
						<div id="zone-txt-bloc-apply">
							<div id="zone-txt-left-bloc-apply">
								<p><?php the_field('applyText'); ?></p>
							</div>
							<div id="zone-txt-right-bloc-apply">
								<a href="<?php the_field('applyUrl'); ?>" class="btn btn-grey"><?php the_field('applyBtn'); ?></a>
							</div>
						</div>
					</div>

					<div id="bloc-faculty-home">
						<h3 class="h2"><?php the_field('facTitle'); ?></h3>
						<p><?php the_field('facText'); ?></p>
						<ul id="links-faculty">
							<li>
								<a class="btn-arrow" href="<?php the_field('facUrl1'); ?>"><?php the_field('facBtn1'); ?></a>
							</li><li>
								<a class="btn-arrow" href="<?php the_field('facUrl2'); ?>"><?php the_field('facBtn2'); ?></a>
							</li>
						</ul>
					</div>
				</div>
		  	
		  	</div>

		  	<div id="bloc-info-avignon" class="bloc-content bloc-bg-pattern">
		  		
		  		<div class="container">
		  			<div id="bloc-img-left2-live" class="bloc-img-border" data-sr='move 0px'>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<?php echo wp_get_attachment_image( get_field('liveImg1'), 'full' ); ?>
		  				</div>
		  			</div>

		  			<div id="bloc-img-right1-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<?php echo wp_get_attachment_image( get_field('liveImg2'), 'large' ); ?>
		  				</div>
		  			</div>

		  			<div id="bloc-img-right3-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<?php echo wp_get_attachment_image( get_field('liveImg3'), 'large' ); ?>
		  				</div>
		  			</div>

		  			<div id="bloc-img-right2-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<?php echo wp_get_attachment_image( get_field('liveImg4'), 'medium' ); ?>
		  				</div>
		  			</div>
		  			
		  			<div id="live-top">
		  				<div id="bloc-live-home">
		  					<h2 class="h1"><?php the_field('liveTitle'); ?></h2>
		  					<h3 class="h2"><?php the_field('discoverTitle'); ?></h3>
		  					<p><?php the_field('discoverText'); ?></p>
		  					<a href="<?php the_field('discoverUrl'); ?>" class="btn"><?php the_field('discoverBtn'); ?></a>
		  				</div>
		  			</div>

		  			<div id="container-live-left-right" class="clearfix">
		  				<div id="live-right">

		  					<div id="bloc-activities-home">
		  						<h3 class="h2"><?php the_field('activitiesTitle'); ?></h3>
		  						<p><?php the_field('activitiesText'); ?></p>

		  						<?php $acts = new WP_Query( array('post_type' => 'activities', 'posts_per_page' => 3, 'meta_query' => array( array( 'key' => 'date2' ) ), 'orderby' => 'meta_value_num', 'order' => 'ASC') ); ?>
		  						<?php if( $acts->have_posts() ) : ?>
			  						
			  						<?php
				  						function setDate($date){
				  							$srtDate = strtotime($date);
				  							$dateOk = date_i18n('F d', $srtDate);
				  							return $dateOk;
				  						}
			  						?>

			  						<ul class="activities">

			  							<?php while( $acts->have_posts() ) : $acts->the_post(); ?><li>
				  							<div class="activities-date">
				  								<span><?php echo setDate(get_field('date1')); ?></span>
				  							</div>
				  							<div class="activities-title"><?php the_title(); ?></div>
				  						</li><?php endwhile; ?>

			  						</ul>
			  					<?php endif; wp_reset_query(); ?>

		  						<a href="<?php the_field('activitiesUrl'); ?>" class="btn"><?php the_field('activitiesBtn'); ?></a>
		  					</div>

		  				</div><div id="live-left">
		  					
		  					<div id="bloc-img-left1-live" class="bloc-img-border" data-sr>
		  						<div class="content-bloc-img imgLiquidFill">
		  							<?php echo wp_get_attachment_image( get_field('liveImg5'), 'large' ); ?>
		  						</div>
		  					</div>
		  					
		  					<div id="bloc-twitter-home">
		  						<?php $hashtag = get_field('hashtag'); ?>
		  						<h5><strong>#<?php echo $hashtag; ?></strong> <?php the_field('twitterTitle'); ?></h5>
		  						<p><?php the_field('twitterText'); ?></p>
		  						<a class="twitter-timeline" href="https://twitter.com/hashtag/<?php echo $hashtag; ?>" data-widget-id="644869486735196160" data-chrome="noheader nofooter noborders">
		  							#<?php echo $hashtag; ?> tweets
		  						</a>
		  						<a href="https://twitter.com/hashtag/<?php echo $hashtag; ?>" target='_blank' class="btn"><?php the_field('twitterBtn'); ?></a>
		  					</div>
		  				</div>
		  			</div>
		  			
		  			<div id="bloc-alumni">
		  				<h3 class="h2"><?php the_field('alumniTitle'); ?></h3>
		  				<div id="bloc-alumni-stories">
		  					<h4><?php the_field('blogTitle'); ?></h4>
		  					<p><?php the_field('blogText'); ?></p>
		  					<a href="<?php the_field('blogUrl', 'options'); ?>" class="btn btn-grey btn-full-width"><?php the_field('blogBtn'); ?></a>
		  					<p><?php the_field('blogText2'); ?>&nbsp;&nbsp;<a class="btn-arrow btn-white" href="<?php the_field('contributeUrl', 'options'); ?>"><?php the_field('blogBtn2'); ?></a></p>
		  				</div><div id="bloc-alumni-fb">
		  					<?php $fbUrl = get_field('fbLink'); ?>
		  					<h4><?php the_field('fbTitle'); ?></h4>
		  					<div class="imgLiquidFill" id="bg-img-facebook">
		  						<?php echo wp_get_attachment_image( get_field('fbImg'), 'large' ); ?>
		  					</div>
		  					<div class="fb-page" data-href="<?php echo $fbUrl; ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false">
		  						<div class="fb-xfbml-parse-ignore">
		  							<blockquote cite="<?php echo $fbUrl; ?>">
		  								<a href="<?php echo $fbUrl; ?>" target='_blank'>
		  									<?php the_field('fbText'); ?>
		  								</a>
		  							</blockquote>
		  						</div>
		  					</div>
		  				</div>
		  				
		  				<!--<?php get_template_part( 'includes/bloc-alumni' ); ?>-->
		  				
		  				<div id="bloc-facebook-responsive">
		  					<h4><?php the_field('fbTitle'); ?></h4>
		  					<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
		  				</div>
		  			</div>
		  	  	
		  	  	</div>				
		  	</div>
				
		<?php else : ?>
						
			<?php get_template_part( 'includes/404' ); ?>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>