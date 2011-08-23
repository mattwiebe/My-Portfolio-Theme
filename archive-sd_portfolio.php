<?php get_header(); ?>
<div class="flexslider-container">
<div class="flexslider">
	<ul class="slides">
	<?php // start loop
	/*
	query_posts(array(
		'post_type' => 'sd_portfolio',
		'posts_per_page' => -1,
		'order' => 'DESC',
		'orderby' => 'title'
	));
	*/
	while( have_posts() ) : the_post(); ?>

	<li <?php post_class() ?>>
		<a href="<?php the_permalink(); ?>" title="View ‘<?php the_title_attribute() ?>’">
		<h1 class="entry-title portfolio-title"><?php the_title() ?></h1>
		<?php the_post_thumbnail('sd_portfolio', array(
			// I don't like images to be titled - normally just repeats the filename
			'title' => false,
			// add our own class to the image for easy styling
			'class' => 'portfolio-img'
		)); ?>
		</a>
	</li>

	<?php	//end loop
	endwhile;
	# wp_reset_query();
		?>
	</ul>
</div>
</div>
<?php get_footer(); ?>