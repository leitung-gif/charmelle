<?php
/**
 * The main template file — WordPress fallback.
 * This is the most generic template in any WordPress theme.
 */
get_header();
?>

<section class="section">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="entry-content">
            <?php the_excerpt(); ?>
          </div>
        </article>
      <?php endwhile; ?>
      <?php the_posts_navigation(); ?>
    <?php else : ?>
      <p>Keine Beiträge gefunden.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
