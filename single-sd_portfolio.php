<?php get_header();
the_post(); ?>
<div class="flexslider">
<article <?php post_class() ?>>
	<h1 class="entry-title portfolio-title"><?php the_title() ?></h1>
	<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'live_url', true) ); ?>" title="View on the web">
	<?php the_post_thumbnail('sd_portfolio', array(
		// I don't like images to be titled - normally just repeats the filename
		'title' => false,
		// add our own class to the image for easy styling
		'class' => 'portfolio-img'
	)); ?>
	</a>
	<div class="portfolio-meta">
		<dl class="client-quote">
			<dt><?php _e( 'Client Quote', 'my-portfolio' ); ?></dt>
			<dd><?php $quote = get_post_meta( get_the_ID(), 'client_quote', true );
				// escape for display -> stay secure!
				$quote = esc_html($quote);
				// add quotes to make the quote all quote-like
				$quote = "\"$quote\"";
				// Turn dumb quotes into smart quotes, encode entitites, and more
				$quote = wptexturize( $quote );
				// Automatically add paragraphs
				$quote = wpautop( $quote );
				echo $quote;
			 ?></dd>
		</dl>
		<dl class="work-done"> 
			<dt><?php _e( 'Work Done', 'my-portfolio' ); ?></dt>
			<dd><?php 
				$work = get_post_meta( get_the_ID(), 'work_done', true );
				echo esc_html( $work );
			 ?></dd>
		</dl>
		<dl class="agency">
			<dt><?php _e( 'Agency', 'my-portfolio' ); ?></dt>
			<dd><?php 
				$agency = get_post_meta( get_the_ID(), 'agency', true );
				echo esc_html($agency);
			?></dd>
		</dl>
	</div>
	<div class="entry-content">
		<?php the_content() ?>
		<p><?php 
			printf( '%s <a href="%s">%s</a>',
				__( 'View:', 'my-portfolio' ),
				esc_url( get_post_meta(get_the_ID(), 'live_url', true ) ),
				get_the_title()
			); ?></p>
	</div>
</article>
</div>
<?php get_footer(); ?>