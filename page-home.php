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
					<article <?php post_class( 'cf' ); ?> role="article">
						<div class="home-post-image" style="background-image:url(<?php echo get_template_directory_uri(); ?>/library/images/map.jpg);">
							<h2><a href="/map" rel="bookmark" title="Map">Story Map</a></h2>
						</div>
						<div class="tour-locations-container">
							<ul class="tour-locations">
							<li class="tour-location"><h3><a href="/map">Browse Stories by Location</a></h3><br><p><strong>Macleki</strong> is a location-based project. Each of the stories on this site are assigned geolocation coordinates on the interactive map. Story locations are determined based on how each author interprets their story. For stories about buildings, districts, historic sites and other topics having a discrete location, the coordinates represent either the current location, or a past location in the event that the subject is no longer found in the physical landscape. Some thematic stories do not have a discrete location and are thus placed in an area where the story is deemed by the author to have the most geographic relevance. </p></li>
							<div class="view-tours-link-container"><a class="button button-primary" href="/map">View Map</a></div>
							</ul>
						</div>
					</article>
					
				<?php wp_reset_postdata(); ?>
			</div>
			<figure class="home-tag-clouds">
				<?php $args = array( 
					'taxonomy'=> array('story_subjects'), 
					'echo'=> true,
					'show_count'=> 0,
					'orderby'=> 'count', 
					'order'=>'DESC',
					'smallest'=>1, 
					'largest'=> 2.2,
					'unit'=> 'em', 
				); ?>	
				<span>		   
				<?php wp_tag_cloud( $args ); ?>
				</span>
				<?php $args = array( 
					'taxonomy'=> array('post_tag'), 
					'echo'=> true,
					'show_count'=> 0,
					'orderby'=> 'count', 
					'order'=>'DESC',
					'smallest'=>0.85, 
					'largest'=> 2,
					'unit'=> 'em', 	
				); ?>			   
				<span>		   
				<?php wp_tag_cloud( $args ); ?>
				</span>
			</figure>		
			
		</section>
		</div>
		<!-- Story Categories (Subjects) -->
		<!--
		<section class="home-section">
			<?php 
			/*
			$subjects = get_terms( array(
			    'taxonomy' => 'story_subjects',
			    'hide_empty' => true,
			    'sort_by' =>'slug',
			) );
			$html=null;
			foreach($subjects as $subject){
				$url=get_term_link( $subject );
				$label=$subject->name;
				$html.= '<a class="button" href="'.$url.'">'.$label.'</a>';
			}
			*/			
			?>
			<div class="subject-scroller">
				<div class="fade-right">&larr;</div>
				<div class="story-subjects"><?php// echo $html;?></div>
				<div class="fade-left">&rarr;</div>
			</div>
		</section>
		-->
	</main>
<?php get_footer(); ?>
