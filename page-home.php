<?php
/*
 Template Name: Homepage
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>
<?php get_header(); ?>

	<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<!-- Intro -->
		<section class="home-section">
			<article id="intro">
				<div class="" style="padding:0 5%;">
				<!-- <h2>Welcome</h2> -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content();?>
					<?php endwhile; else : ?>
						<p>Add some content!</p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<!-- <div class="home-social">
					<a target="_blank" href="https://www.facebook.com/curatingkisumu/"><i class="icon-facebook"></i></a>
					<a target="_blank" href="https://twitter.com/curatingkisumu"><i class="icon-twitter"></i></a>
					<a target="_blank" href="https://www.youtube.com/channel/UCiHA8Vz7Cwlpdy7KkZLXCKw"><i class="icon-youtube-play"></i></a>
				</div> -->
				</div>
			</article>
		</section>

		<!-- Stories -->
		<section class="home-section container">
			<h2>Recent Stories</h2>
			<div class="home-stories">

				<?php
				$args = array(
					'posts_per_page' => 3,
					'post_type' => 'stories',
				);
				$the_query = new WP_Query( $args );
				?>
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php $thumbnail = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'medium' ) : 0;?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<div class="home-article-type">Story</div>
					<a href="<?php the_permalink() ?>" class="home-post-image" style="background-image:url(<?php echo $thumbnail;?>);"></a>
					<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				</article>
				<?php endwhile; ?>
				<?php else : ?>
					<article>
						<div class="home-article-type">Error</div>
						<h4><?php _e( 'Oops, Stories Not Found!', 'sepalandseedtheme' ); ?></h4>
					</article>
				<?php endif; ?>
				<a class="button" style="width:100%;text-align:center" href="/stories">Browse Stories</a>
				<?php wp_reset_postdata(); ?>
			</div>
		</section>

		<!-- Map -->
		<section class="home-section">
			<div class="home-map">
			<!-- <div class="home-article-type" style="text-align:center">Stories Map</div> -->
				<?php echo do_shortcode('[curatescape_global_map]', false );?>
			</div>
		</section>

		<!-- Tours -->
		<div class="home-tours-outer">
		<section class="home-section container">
			<h2>Recent Tours</h2>
			<div class="home-tours">
				<?php
				$args = array(
					'posts_per_page' => 3,
					'post_type' => 'tours',
				);
				$the_query = new WP_Query( $args );
				?>
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php $thumbnail = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'medium' ) : 0;?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<div class="home-article-type">Tour</div>
					<!-- <a href="<?php the_permalink() ?>" class="home-post-image" style="background-image:url(<?php //echo $thumbnail;?>);background-color:#b48416;"></a> -->
					<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				</article>
				<?php endwhile; ?>
				<?php else : ?>
					<article>
						<div class="home-article-type">Error</div>
						<h4><?php _e( 'Oops, Tours Not Found!', 'sepalandseedtheme' ); ?></h4>
					</article>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<a class="button" style="width:100%;text-align:center" href="/tours">Browse Tours</a>
			</div>
		</section>
		</div>

	</main>
<?php get_footer(); ?>
