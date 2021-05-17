<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- .row -->
	</div><!-- #wrapper -->

<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
	$(function(){
		var banner = $('.banner-selected').children('.banner-item').attr('for');

		$('.banner-item').click(function(){
			var trigger = $(this).attr('for');
			var parent  = $(this).parent();

			$('.banner').removeClass('banner-selected');
			parent.addClass('banner-selected');			
		});
	})
</script>
	<?php wp_footer(); ?>
</body>
</html>
