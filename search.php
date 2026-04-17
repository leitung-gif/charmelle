<?php
/**
 * Search results template.
 */
get_header();
?>

  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Suchergebnisse</span>
      <h1>Ergebnisse für «<em class="text-italic"><?php echo esc_html( get_search_query() ); ?></em>»</h1>
    </div>
  </section>

  <section class="section" id="search-results">
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
            <a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--small">Ansehen →</a>
          </div>
        </article>
        <?php endwhile; ?>
      </div>
      <div class="text-center mt-lg">
        <?php the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => '← Zurück', 'next_text' => 'Weiter →' ) ); ?>
      </div>
      <?php else : ?>
      <div class="text-center" style="padding: 80px 0;">
        <span class="subtitle">Nichts gefunden</span>
        <h2>Leider keine Ergebnisse für «<em class="text-italic"><?php echo esc_html( get_search_query() ); ?></em>»</h2>
        <p style="color: var(--text-light); margin-top: 16px; max-width: 500px; margin-left: auto; margin-right: auto;">Versuchen Sie einen anderen Suchbegriff oder entdecken Sie unsere Behandlungen und Produkte.</p>
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 28px;">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Zur Startseite</a>
          <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>" class="btn btn--outline">Behandlungen</a>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

<?php get_footer(); ?>
