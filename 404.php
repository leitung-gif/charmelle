<?php
/**
 * The 404 template — Page Not Found.
 */
get_header();
$t = get_template_directory_uri();
?>

<section class="hero section" style="min-height: 70vh; display: flex; align-items: center;">
  <div class="container text-center">
    <span class="subtitle">Seite nicht gefunden</span>
    <h1 style="font-size: clamp(4rem, 10vw, 8rem); color: var(--accent-gold); margin-bottom: 16px;">404</h1>
    <h2>Diese Seite existiert <em class="text-italic">leider nicht</em></h2>
    <hr class="golden-rule golden-rule--center">
    <p style="color: var(--text-light); max-width: 500px; margin: 0 auto 32px;">
      Die von Ihnen gesuchte Seite wurde möglicherweise verschoben, umbenannt oder existiert nicht mehr. Kehren Sie zur Startseite zurück oder entdecken Sie unsere Behandlungen.
    </p>
    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Zur Startseite</a>
      <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>" class="btn btn--outline">Behandlungen entdecken</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
