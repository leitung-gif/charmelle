<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Skip Navigation (Accessibility) -->
    <a href="#main-content" class="skip-link" id="skip-nav">Zum Inhalt springen</a>

    <!-- ===== ANNOUNCEMENT MARQUEE BAR ===== -->
    <div class="announcement-bar" aria-label="Aktuelle Angebote" aria-live="off">
        <div class="marquee-track">
            <span class="marquee-item"><span class="dot"></span>Hochzeit Angebot - Fragen Sie uns</span>
            <span class="marquee-item"><span class="dot"></span>10+1 Abos - 10 Behandlungen buchen, 1 gratis</span>
            <span class="marquee-item"><span class="dot"></span>Rabatte für Lernende - Jetzt informieren</span>
            <span class="marquee-item"><span class="dot"></span>Geschenkgutscheine ab CHF 50.—</span>
            <span class="marquee-item"><span class="dot"></span>Hochzeit Angebot - Fragen Sie uns</span>
            <span class="marquee-item"><span class="dot"></span>10+1 Abos - 10 Behandlungen buchen, 1 gratis</span>
            <span class="marquee-item"><span class="dot"></span>Rabatte für Lernende - Jetzt informieren</span>
            <span class="marquee-item"><span class="dot"></span>Geschenkgutscheine ab CHF 50.—</span>
        </div>
    </div>

    <!-- ===== HEADER ===== -->
    <header class="site-header" id="site-header">
        <div class="header-inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="Charmelle Beauty Center - Startseite">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="Charmelle Beauty Center Logo" class="logo-img" style="height:44px!important;max-height:44px!important;width:auto!important;max-width:200px!important;object-fit:contain!important;">
            </a>
            <nav class="main-nav" id="main-nav" aria-label="Hauptnavigation">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php if ( is_front_page() ) echo ' class="active"'; ?>>Home</a>
                <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>"<?php if ( is_page( 'behandlungen' ) ) echo ' class="active"'; ?>>Behandlungen</a>
                <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>"<?php if ( is_page( 'team' ) ) echo ' class="active"'; ?>>Team</a>
                <a href="<?php echo function_exists('wc_get_page_id') ? esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) : esc_url( home_url( '/shop/' ) ); ?>"<?php if ( function_exists('is_shop') && ( is_shop() || is_product_category() || is_product() ) ) echo ' class="active"'; ?>>Shop</a>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"<?php if ( (is_home() && !is_front_page()) || (is_single() && get_post_type() === 'post') ) echo ' class="active"'; ?>>Blog</a>
                <a href="<?php echo esc_url( home_url( '/gutscheine/' ) ); ?>"<?php if ( is_page( 'gutscheine' ) ) echo ' class="active"'; ?>>Gutscheine</a>
                <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"<?php if ( is_page( 'kontakt' ) ) echo ' class="active"'; ?>>Kontakt</a>
                <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small header-cta--mobile" style="display:none;" target="_blank" rel="noopener">Termin Buchen</a>
            </nav>
            <div class="header-cta">
                <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Termin Buchen</a>
            </div>
            <button class="menu-toggle" id="menu-toggle" aria-label="Menü öffnen" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>

    <main id="main-content">
