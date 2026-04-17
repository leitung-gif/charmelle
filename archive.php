<?php
/**
 * Archive template (categories, tags, date archives).
 */
get_header();
?>

  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Beiträge</span>
      <h1><?php the_archive_title(); ?></h1>
      <?php if ( get_the_archive_description() ) : ?>
        <p><?php echo get_the_archive_description(); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="section" id="archive-listing">
    <div class="container">
      <?php if ( have_posts() ) : ?>
      <div class="grid grid--3">
        <?php while ( have_posts() ) : the_post(); ?>
        <article class="blog-card reveal" id="post-<?php the_ID(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" class="blog-card-image">
            <div class="arch-img">
              <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
            </div>
          </a>
          <?php endif; ?>
          <div class="blog-card-content">
            <span class="blog-card-date"><?php echo get_the_date( 'j. F Y' ); ?></span>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--small">Weiterlesen →</a>
          </div>
        </article>
        <?php endwhile; ?>
      </div>
      <div class="text-center mt-lg">
        <?php the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => '← Zurück', 'next_text' => 'Weiter →' ) ); ?>
      </div>
      <?php else : ?>
      <div class="text-center" style="padding: 80px 0;">
        <h2>Keine Beiträge gefunden</h2>
        <p style="color: var(--text-light); margin-top: 16px;">In dieser Kategorie gibt es noch keine Beiträge.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--outline" style="margin-top: 24px;">Zur Startseite</a>
      </div>
      <?php endif; ?>
    </div>
  </section>

<?php get_footer(); ?>
