<div id="bloc-contribute">
	<div id="content-bloc-contribute">
		<?php if(get_field('contributeTitle', 'options')){ ?>
		    <h3 class="h2"><?php the_field('contributeTitle', 'options'); ?></h3>
		<?php } if(get_field('contributeText', 'options')){ ?>
		   	<p><?php the_field('contributeText', 'options'); ?></p>
		<?php } if(get_field('contributeBtn', 'options') && get_field('contributeUrl', 'options')){ ?>
		    <a href="<?php the_field('contributeUrl', 'options'); ?>" class="btn btn-grey-2">
		    	<?php the_field('contributeBtn', 'options'); ?>
		    </a>
		<?php } ?>
	</div>
	<div id="img-bloc-contribute">
		<ul id="images-contribute">
			<li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg1', 'options') ); ?>
			</li><li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg2', 'options') ); ?>
			</li><li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg3', 'options') ); ?>
			</li><li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg4', 'options') ); ?>
			</li><li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg5', 'options') ); ?>
			</li><li class="imgLiquidFill">
				<?php echo wp_get_attachment_image( get_field('contributeImg6', 'options') ); ?>
			</li>
		</ul>
	</div>
</div>