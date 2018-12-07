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
				<div>
				<!-- <h2>Welcome</h2> -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content();?>
					<?php endwhile; else : ?>
						<p>Add some content!</p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				</div>
			</article>
		</section>


		<!-- Tours -->
		<div class="home-tours-outer">
		<section class="home-section">
			<div class="home-tours">
				<?php
				$args = array(
					'posts_per_page' => 6,
					'post_type' => 'tours',
				);
				$the_query = new WP_Query( $args );
				?>
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php $thumbnail = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'medium' ) : 0;?>
				<?php $tour_permalink = get_the_permalink();?>
				<?php $tour_title = get_the_title();?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<div class="home-post-image" style="background-image:url(<?php echo $thumbnail;?>);">
						<h2><a href="<?php echo $tour_permalink ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $tour_title; ?></a></h2>
					</div>
					<div class="tour-locations-container">
					<?php
					if($locations = $post->tour_locations){
						$locations=explode(',',$locations);
						$html=null;
						foreach(array_slice($locations,0,3) as $id){
							$location=get_post( $id );
							$html.= '<li class="tour-location"><h3>'.
							'<a href="'.get_the_permalink( $location ).'">'.
							get_the_title( $location ).curatescape_subtitle( $location ).
							'</a></h3></li>';
						}
						echo '<ul class="tour-locations">'.$html.'</ul>';
					}
					echo '<div class="view-tours-link-container"><a class="button button-primary" href="'.$tour_permalink.'">View all</a></div>';
					?>
					</div>
				</article>
				<?php endwhile; ?>
				<?php else : ?>
					<article>
						<div class="home-article-type">Error</div>
						<h2><?php _e( 'Oops, Tours Not Found!', 'sepalandseedtheme' ); ?></h2>
					</article>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</section>
		</div>
	</main>
<?php get_footer(); ?>
