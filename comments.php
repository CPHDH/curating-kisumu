<?php
/*
The comments page for Sepal and Seed
*/

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

  <?php if ( have_comments() ) : ?>
    <div class="container">
      <h3><?php comments_number();?></h3>
      <section class="commentlist">

        <?php
          wp_list_comments( array(
            'style'             => 'div',
            'short_ping'        => true,
            'avatar_size'       => 0,
            'callback'          => 'sepal_and_seed_comments',
            'type'              => 'all',
            'reply_text'        => __('Reply', 'sepalandseedtheme'),
            'page'              => '',
            'per_page'          => '',
            'reverse_top_level' => null,
            'reverse_children'  => ''
          ) );
        ?>
      </section>

      <?php if ( ! comments_open() ) : ?>
      	<p class="no-comments"><?php _e( 'Comments are closed.' , 'sepalandseedtheme' ); ?></p>
      <?php endif; ?>

    </div>

  <?php endif; ?>

  <div class="container">
    <?php comment_form(); ?>
  </div>
