<?php
/**
 * Charmelle Beauty Center Theme — functions.php
 * Theme setup, asset enqueuing, WooCommerce support, SEO & Schema.
 */

// ─── Theme Support ───
function charmelle_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    // WooCommerce Support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Hauptnavigation', 'charmelle' ),
    ) );

    // Image sizes for product cards
    add_image_size( 'product-card', 600, 600, true );
    add_image_size( 'team-portrait', 1030, 704, true );
}
add_action( 'after_setup_theme', 'charmelle_theme_setup' );

// ─── Enqueue Styles & Scripts ───
function charmelle_enqueue_assets() {
    $theme_uri = get_template_directory_uri();
    $theme_ver = wp_get_theme()->get( 'Version' );

    // Google Fonts — Playfair Display + Jost + Great Vibes
    wp_enqueue_style(
        'charmelle-google-fonts',
        'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Jost:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap',
        array(),
        null
    );

    // Main design system stylesheet
    wp_enqueue_style(
        'charmelle-design-system',
        $theme_uri . '/styles.css',
        array( 'charmelle-google-fonts' ),
        $theme_ver
    );

    // WP theme stylesheet (contains only the theme header comment)
    wp_enqueue_style(
        'charmelle-style',
        get_stylesheet_uri(),
        array( 'charmelle-design-system' ),
        $theme_ver
    );

    // Main theme script (in footer)
    wp_enqueue_script(
        'charmelle-script',
        $theme_uri . '/main.js',
        array(),
        $theme_ver,
        true // Load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'charmelle_enqueue_assets' );

// ─── Preload Critical Assets ───
function charmelle_preload_assets() {
    $theme_uri = get_template_directory_uri();
    echo '<link rel="preload" href="' . esc_url( $theme_uri . '/images/hero-treatment.png' ) . '" as="image">' . "\n";
    echo '<link rel="preload" href="' . esc_url( $theme_uri . '/images/logo.png' ) . '" as="image">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'charmelle_preload_assets', 1 );

// ─── Custom Meta Tags (SEO, OG, GEO) ───
function charmelle_meta_tags() {
    $theme_uri = get_template_directory_uri();

    // Common meta for all pages
    ?>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $theme_uri . '/images/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( $theme_uri . '/images/favicon-16x16.png' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $theme_uri . '/images/apple-touch-icon.png' ); ?>">
    <meta name="theme-color" content="#C5A880">
    <meta name="format-detection" content="telephone=no">

    <!-- Language & Region -->
    <meta http-equiv="content-language" content="de-CH">
    <link rel="alternate" hreflang="de-CH" href="https://www.charmelle.ch/">
    <link rel="alternate" hreflang="de" href="https://www.charmelle.ch/">
    <link rel="alternate" hreflang="x-default" href="https://www.charmelle.ch/">

    <!-- GEO Tags -->
    <meta name="geo.region" content="CH-AG">
    <meta name="geo.placename" content="Aarau">
    <meta name="geo.position" content="47.3925;8.0440">
    <meta name="ICBM" content="47.3925, 8.0440">
    <?php

    if ( is_front_page() ) {
        ?>
        <meta name="description" content="Charmelle Beauty Center in Aarau - Ihr Kosmetikstudio für Hydra Facial, Microneedling, Anti-Aging, Wimpernlifting, Permanent Make-Up & LPG Endermologie. Erfahrene Kosmetikerinnen EFZ. Seit über 30 Jahren. Jetzt Termin buchen!">
        <meta name="keywords" content="Kosmetikstudio Aarau, Beauty Center Aarau, Hydra Facial Aarau, Microneedling Aarau, Anti-Aging Aarau, Gesichtspflege Aarau, Wimpernlifting Aarau, Permanent Make-Up Aarau, Haarentfernung Laser Aarau, Kosmetikerin EFZ Aarau, LPG Endermologie Aarau, Microblading Aarau">
        <meta name="author" content="Charmelle Beauty Center GmbH">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <link rel="canonical" href="https://www.charmelle.ch/">

        <!-- Open Graph -->
        <meta property="og:title" content="Charmelle Beauty Center Aarau | Premium Kosmetikstudio seit über 30 Jahren">
        <meta property="og:description" content="Hydra Facial, Microneedling, Anti-Aging, Wimpernlifting und medizinische Kosmetik in wohlfühlender Atmosphäre. Erfahrene Kosmetikerinnen EFZ in Aarau.">
        <meta property="og:image" content="https://www.charmelle.ch/wp-content/themes/charmelle/images/logo.png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="https://www.charmelle.ch/">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="de_CH">
        <meta property="og:site_name" content="Charmelle Beauty Center">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Charmelle Beauty Center Aarau | Premium Kosmetikstudio seit über 30 Jahren">
        <meta name="twitter:description" content="Hydra Facial, Microneedling, Anti-Aging, Wimpernlifting und medizinische Kosmetik in Aarau. Seit über 30 Jahren.">
        <meta name="twitter:image" content="https://www.charmelle.ch/wp-content/themes/charmelle/images/logo.png">
        <?php
    }
}
add_action( 'wp_head', 'charmelle_meta_tags', 2 );

// ─── Structured Data (JSON-LD) ───
function charmelle_structured_data() {
    if ( is_front_page() ) {
        $theme_uri = get_template_directory_uri();
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BeautySalon",
            "@id": "https://www.charmelle.ch/#organization",
            "name": "Charmelle Beauty Center",
            "alternateName": ["Charmelle", "Beauty Center Charmelle", "Charmelle Beauty Center GmbH"],
            "image": "<?php echo esc_url( $theme_uri . '/images/logo.png' ); ?>",
            "logo": "<?php echo esc_url( $theme_uri . '/images/logo.png' ); ?>",
            "url": "https://www.charmelle.ch/",
            "telephone": "+41628226647",
            "email": "info@charmelle.ch",
            "description": "Premium Kosmetikstudio in Aarau. Seit über 30 Jahren bieten wir Gesichtspflege, Hydra Facial, Microneedling, Anti-Aging-Behandlungen, LPG Endermologie, Wimpernlifting, Permanent Make-Up und medizinische Kosmetik im Kanton Aargau.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Girixweg 7",
                "addressLocality": "Aarau",
                "addressRegion": "AG",
                "postalCode": "5000",
                "addressCountry": "CH"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 47.3925,
                "longitude": 8.0440
            },
            "openingHoursSpecification": [
                {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday", "Thursday"], "opens": "09:00", "closes": "19:00"},
                {"@type": "OpeningHoursSpecification", "dayOfWeek": "Tuesday", "opens": "09:00", "closes": "18:30"},
                {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Wednesday", "Friday"], "opens": "09:00", "closes": "18:30"},
                {"@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "08:30", "closes": "14:00"}
            ],
            "priceRange": "CHF 30 – CHF 650",
            "currenciesAccepted": "CHF",
            "paymentAccepted": "Bargeld, EC-Karte, Kreditkarte, TWINT",
            "areaServed": [
                {"@type": "City", "name": "Aarau"},
                {"@type": "State", "name": "Kanton Aargau"},
                {"@type": "City", "name": "Buchs AG"},
                {"@type": "City", "name": "Rohr AG"},
                {"@type": "City", "name": "Suhr"},
                {"@type": "City", "name": "Gränichen"},
                {"@type": "City", "name": "Erlinsbach"},
                {"@type": "City", "name": "Küttigen"},
                {"@type": "City", "name": "Oberentfelden"},
                {"@type": "City", "name": "Unterentfelden"}
            ],
            "sameAs": [
                "https://www.instagram.com/beauty_charmelle/",
                "https://www.facebook.com/charmellebeautycenter/"
            ],
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "5.0",
                "bestRating": "5",
                "worstRating": "1",
                "ratingCount": "44",
                "reviewCount": "44"
            },
            "hasOfferCatalog": {
                "@type": "OfferCatalog",
                "name": "Kosmetik-Behandlungen",
                "itemListElement": [
                    {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Hydra Facial Syndeo", "description": "Die Hollywood-Behandlung für strahlende Haut"}},
                    {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Microneedling mit Hyaluron", "description": "Medical-Kosmetik zur Hauterneuerung und Straffung"}},
                    {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "LPG Endermologie", "description": "Patentierte Technologie für Straffung und Body-Forming"}},
                    {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Wimpernlifting", "description": "Natürlicher Wow-Effekt für Ihre Wimpern"}},
                    {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Permanent Make-Up", "description": "Augenbrauen, Lippen und Lidstriche dauerhaft betont"}}
                ]
            }
        }
        </script>
        <?php
    }
}
add_action( 'wp_head', 'charmelle_structured_data', 5 );

// ─── WooCommerce: Declare HPOS Compatibility ───
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

// ─── WooCommerce: Custom Wrapper ───
function charmelle_wc_wrapper_start() {
    echo '<div class="charmelle-woocommerce-wrap container">';
}
function charmelle_wc_wrapper_end() {
    echo '</div>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'charmelle_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'charmelle_wc_wrapper_end', 10 );

// ─── WooCommerce: Products per page ───
add_filter( 'loop_shop_per_page', function() { return 24; } );

// ─── WooCommerce: Products per row ───
add_filter( 'loop_shop_columns', function() { return 3; } );

// ─── Remove WordPress Emoji Scripts (Performance) ───
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// ─── Remove WordPress Version (Security) ───
remove_action( 'wp_head', 'wp_generator' );

// ─── Remove WooCommerce Default Styles We Override ───
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
    unset( $styles['woocommerce-general'] );
    return $styles;
} );

// ─── Contact Form 7 Support (if installed) ───
// The contact form shortcode can be placed in page-kontakt.php using:
// <?php echo do_shortcode('[contact-form-7 id="FORM_ID" title="Kontakt"]'); ?>
