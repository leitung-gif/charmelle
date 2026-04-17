<?php
/**
 * Single blog post template.
 */
get_header();
$t = get_template_directory_uri();
?>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle"><?php echo get_the_date( 'j. F Y' ); ?> · <?php the_category( ', ' ); ?></span>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <!-- ===== ARTICLE ===== -->
  <section class="section" id="blog-article">
    <div class="container container--narrow">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php if ( has_post_thumbnail() ) : ?>
      <div class="arch-img reveal" style="margin-bottom: 48px; aspect-ratio: 16/9;">
        <?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
      </div>
      <?php endif; ?>

      <article class="blog-article-content reveal" id="post-<?php the_ID(); ?>">
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>

      <!-- Post Navigation -->
      <div class="blog-post-nav reveal" style="display: flex; justify-content: space-between; gap: 24px; margin-top: 64px; padding-top: 32px; border-top: 1px solid var(--border-color);">
        <div>
          <?php
          $prev = get_previous_post();
          if ( $prev ) :
          ?>
            <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-light);">← Vorheriger Beitrag</span>
            <a href="<?php echo get_permalink( $prev ); ?>" style="display: block; margin-top: 4px; color: var(--text-heading);"><?php echo get_the_title( $prev ); ?></a>
          <?php endif; ?>
        </div>
        <div style="text-align: right;">
          <?php
          $next = get_next_post();
          if ( $next ) :
          ?>
            <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-light);">Nächster Beitrag →</span>
            <a href="<?php echo get_permalink( $next ); ?>" style="display: block; margin-top: 4px; color: var(--text-heading);"><?php echo get_the_title( $next ); ?></a>
          <?php endif; ?>
        </div>
      </div>

      <?php endwhile; endif; ?>

      <div class="text-center mt-lg">
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn--outline">← Zurück zum Blog</a>
      </div>
    </div>
  </section>

  <!-- ===== CTA ===== -->
  <section class="section section--dark" id="cta">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Interessiert?</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Buchen Sie Ihre nächste Behandlung</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Lassen Sie sich von unseren Kosmetikerinnen persönlich beraten.</p>
      <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Termin buchen</a>
    </div>
  </section>

<?php get_footer(); ?>
