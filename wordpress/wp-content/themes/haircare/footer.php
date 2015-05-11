</div> <!-- end middle content section -->
</div> <!-- end middle Container wrapper section -->
	</div> <!-- Main Layout Section End -->
	
	 <?php if( get_theme_mod('disable_overlay_container') != 'on' ) {	?>
	 <div class="bottom_footer">
		<i class="fa fa-times footer-open"> </i>
	 </div>
	
			

	<?php } ?>
	<?php  get_template_part('lib/includes/footer_general'); // General Footer ?>
	<div class="clear"> </div>
	<!--  Scrollto Top  -->
	<a href="#" class="scroll_top "><i class = "fa fa-arrow-up"> </i></a>
	<!--  Google Analytic  -->
	<?php $google_tracking_code= get_theme_mod('google_tracking_code') ? get_theme_mod('google_tracking_code') : '';
		if ($google_tracking_code) { 	
			echo stripslashes($google_tracking_code); 					
		} else { ?>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>