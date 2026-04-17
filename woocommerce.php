<?php
/**
 * WooCommerce main wrapper template.
 * Overrides the default WooCommerce page wrapper.
 */
get_header();
$t = get_template_directory_uri();
?>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Charmelle Beauty Center</span>
      <?php if ( is_shop() ) : ?>
        <h1>Unser <em class="text-italic">Shop</em></h1>
        <p>Hochwertige Pflegeprodukte von Med Beauty Swiss, Team Dr. Joseph, Thalgo und mehr - direkt zu Ihnen nach Hause.</p>
      <?php elseif ( is_product_category() ) : ?>
        <h1><?php single_cat_title(); ?></h1>
        <?php if ( category_description() ) : ?>
          <p><?php echo category_description(); ?></p>
        <?php endif; ?>
      <?php elseif ( is_product() ) : ?>
        <h1><?php the_title(); ?></h1>
      <?php else : ?>
        <h1><?php the_title(); ?></h1>
      <?php endif; ?>
    </div>
  </section>

  <?php if ( is_shop() || is_product_category() ) : ?>
  <!-- ===== CATEGORY FILTER BAR ===== -->
  <section class="shop-categories" id="shop-filter">
    <div class="container">
      <div class="category-filter-bar">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="category-pill<?php echo is_shop() ? ' active' : ''; ?>">Alle Produkte</a>
        <?php
        $categories = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0,
            'exclude'    => array( get_option('default_product_cat') ),
        ) );
        if ( $categories && ! is_wp_error( $categories ) ) :
            foreach ( $categories as $cat ) :
                $active = ( is_product_category( $cat->slug ) ) ? ' active' : '';
        ?>
            <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="category-pill<?php echo $active; ?>"><?php echo esc_html( $cat->name ); ?> <span class="cat-count"><?php echo esc_html( $cat->count ); ?></span></a>
        <?php
            endforeach;
        endif;
        ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="section" id="shop-content">
    <div class="container">
      <?php woocommerce_content(); ?>
    </div>
  </section>

  <!-- ===== CTA BANNER ===== -->
  <?php if ( is_shop() || is_product_category() ) : ?>
  <section class="section section--dark" id="shop-cta">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Persönliche Beratung?</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Wir beraten Sie gerne</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Unsere Kosmetikerinnen helfen Ihnen, die perfekten Produkte für Ihre Haut zu finden - im Studio oder per Telefon.</p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Termin buchen</a>
        <a href="tel:+41628226647" class="btn btn--outline btn--large" style="border-color: rgba(253,251,247,0.3); color: var(--text-white);">062 822 66 47</a>
      </div>
    </div>
  </section>
  <?php endif; ?>

<?php get_footer(); ?>
