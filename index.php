<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap row">

					<main id="main" class="results" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<h1 class="archive-title">News</h1>

						<div class="container">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">

									<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								</header>

								<section class="entry-content">
									<?php the_excerpt(); ?>

										<p class="byline entry-meta vcard">
												<?php printf( __( 'Posted %1$s by %2$s', 'sepalandseedtheme' ),
													/* the time the post was published */
													'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
															/* the author of the post */
															'<span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
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
						</div>

					</main>

				</div>

			</div>


<?php get_footer(); ?>
