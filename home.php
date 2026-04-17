<?php
/**
 * Blog listing template (for the Posts page).
 */
get_header();
$t = get_template_directory_uri();
?>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Beauty-Wissen & Neuigkeiten</span>
      <h1>Unser <em class="text-italic">Blog</em></h1>
      <p>Tipps, Trends und Einblicke aus der Welt der professionellen Hautpflege und Kosmetik.</p>
    </div>
  </section>

  <!-- ===== BLOG LISTING ===== -->
  <section class="section" id="blog-listing">
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
        <?php
        the_posts_pagination( array(
          'mid_size'  => 2,
          'prev_text' => '← Zurück',
          'next_text' => 'Weiter →',
        ) );
        ?>
      </div>
      <?php else : ?>
      <div class="text-center" style="padding: 80px 0;">
        <span class="subtitle">Noch keine Beiträge</span>
        <h2>Bald gibt es hier spannende <em class="text-italic">Beauty-Tipps</em></h2>
        <p style="color: var(--text-light); margin-top: 16px;">Wir arbeiten an interessanten Artikeln für Sie. Schauen Sie bald wieder vorbei!</p>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ===== NEWSLETTER ===== -->
  <section class="section section--dark" id="newsletter">
    <div class="container text-center">
      <div class="reveal">
        <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Beauty News</span>
        <h2 style="color: var(--text-white);">Nie wieder eine Aktion verpassen</h2>
        <p style="color: rgba(253,251,247,0.6); max-width: 480px; margin: 8px auto 28px;">Erhalten Sie exklusive Angebote, Beauty-Tipps und Neuigkeiten direkt in Ihre Inbox.</p>
        <form class="newsletter-form" action="#" method="post" aria-label="Newsletter Anmeldung">
          <input type="email" placeholder="Ihre E-Mail-Adresse" required aria-label="E-Mail-Adresse" id="newsletter-email">
          <button type="submit" class="btn btn--primary">Anmelden</button>
        </form>
        <p style="font-size: 0.75rem; color: rgba(253,251,247,0.35); margin-top: 12px;">Wir respektieren Ihre Privatsphäre. Abmeldung jederzeit möglich.</p>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
