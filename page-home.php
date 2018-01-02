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

			<div id="content">

				<div id="inner-content" class="wrap row">

					<div class="hero">

						<?php echo do_shortcode('[curatescape_global_map]', false );?>
						
							<div class="hero-inner">
							<div class="peer-buttons">

								<a href="/stories" class="primary-btn btn">Stories</a>
								<a href="/tours" class="secondary-btn btn">Tours</a>

							</div>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php echo get_bloginfo( 'name' ) ? '<h2>'.get_bloginfo( 'name' ).'</h2>' : null;?>
								<?php echo get_bloginfo( 'description' ) ? '<h3>'.get_bloginfo( 'description' ).'</h3>' : null;?>
								<?php the_content();?>	
								<?php endwhile; else : ?>
									<p>Add some content!</p>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>

					</div>

					<main id="main" class="col-xs-12 col-sm-8 col-md-8 col-lg-8" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						
						<?php					
						$args = array( 
							'posts_per_page' => 3,
							'post_type' => 'stories',
						);
						$the_query = new WP_Query( $args );
						?>

						<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

							<header class="article-header">

								<h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							</header>

							<section class="entry-content">
								<?php the_excerpt(); ?>
								<?php // theme support for "authors" custom field
								if ( $string=get_post_meta(get_the_ID(), 'authors', true) ) {
								$auth=wp_kses($string,array(
									'a' => array(
										'href' => array(),
										'title' => array()),
								    'em' => array(),
								    'strong' => array(),
								    'b' => array(),
								    'i' => array(),
								    )
								);
								} else {
								$auth=get_the_author_link( get_the_author_meta( 'ID' ) );
								}
								?>
								
								
								<p class="byline entry-meta vcard">
								<?php printf( __( 'Posted %1$s by %2$s', 'sepalandseedtheme' ),
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . $auth . '</span>'
								); ?>
								</p>
							</section>

						</article>

						<?php endwhile; ?>

								<?php sepal_and_seed_page_navi(); ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'sepalandseedtheme' ); ?></h1>
									</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'sepalandseedtheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the index.php template.', 'sepalandseedtheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>

					</main>

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php get_sidebar(); ?>
					</div>

				</div>

			</div>


<?php get_footer(); ?>

