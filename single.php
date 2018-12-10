<?php get_header(); ?>

			<div id="content" >

				<div id="inner-content">

						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article data-image="<?php echo has_post_thumbnail() ? the_post_thumbnail_url( 'large' ) : null;?>" id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

								    <header class="article-header entry-header">

								      <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

								      <p class="byline entry-meta vcard">
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
								        <?php printf( __( 'Posted', 'sepalandseedtheme' ).' %1$s %2$s',
								            /* the time the post was published */
								            '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
								            /* the author of the post */
								            '<span class="by">'.__( 'by', 'sepalandseedtheme' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . $auth . '</span>'
								        ); ?>
								      </p>
								    </header> <?php // end article header ?>

								    <div class="container">

								      <section class="entry-content" itemprop="articleBody">
								        <?php the_content(); ?>
								      </section>

								      <footer class="article-footer">
									    <ul class="tags">
										<?php the_terms(get_the_ID(),'story_subjects', '<li class="button button-primary">', '</li><li class="button button-primary">', '</li>' ); ?>
								        <?php the_tags( '<li class="button">', '</li><li class="button">', '</li>' ); ?>
								        </ul>
								      </footer>

								    </div>

								</article> <?php // end article ?>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'sepalandseedtheme' ); ?></h1>
											</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'sepalandseedtheme' ); ?></p>
											</section>
											<footer class="article-footer">
													<p><?php _e( 'This is the error message in the single.php template.', 'sepalandseedtheme' ); ?></p>
											</footer>
									</article>

							<?php endif; ?>

						</main>

						<div class="comments-outer">
							<?php comments_template(); ?>
						</div>

				</div>

			</div>

<?php get_footer(); ?>
