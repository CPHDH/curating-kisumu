<?php get_header(); ?>

			<div id="content">

				<div id="inner-content">

						<main id="main" class="results" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<h1 class="archive-title"><?php single_tag_title('Tag: ',true);?></h1>

							<div class="container">

								<?php
								$tag = get_queried_object();
								$args = array (
									'post_type'=>'any',
									'tag' => $tag->slug,
								);
								$posts = get_posts( $args );
								if ($posts) :
								foreach ($posts as $post):
								?>


								<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

									<header class="article-header">

										<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

									</header>

									<section class="entry-content cf">

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
											$auth=get_the_author_meta( 'ID' ) ? get_the_author_link( get_the_author_meta( 'ID' ) ) : get_bloginfo('name');
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

							<?php endforeach; ?>

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
													<p><?php _e( 'This is the error message in the archive.php template.', 'sepalandseedtheme' ); ?></p>
											</footer>
										</article>

								<?php endif; ?>
							</div>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
