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

// ─── Auto-configure Reading Settings (runs once) ───
function charmelle_configure_reading_settings() {
    if ( get_option( 'charmelle_reading_configured' ) ) return;

    // Find or create the "Blog" page
    $blog_page = get_page_by_path( 'blog' );
    if ( ! $blog_page ) {
        $blog_page_id = wp_insert_post( array(
            'post_title'  => 'Blog',
            'post_name'   => 'blog',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ) );
    } else {
        $blog_page_id = $blog_page->ID;
    }

    // Find the front page
    $front_page = get_page_by_path( 'home' );
    if ( ! $front_page ) {
        // Try to find any page using the front-page template
        $pages = get_pages();
        foreach ( $pages as $p ) {
            if ( get_page_template_slug( $p->ID ) === 'front-page.php' ) {
                $front_page = $p;
                break;
            }
        }
    }

    // Set reading settings
    update_option( 'show_on_front', 'page' );
    if ( $front_page ) {
        update_option( 'page_on_front', $front_page->ID );
    }
    update_option( 'page_for_posts', $blog_page_id );

    // Mark as configured
    update_option( 'charmelle_reading_configured', true );
}
add_action( 'init', 'charmelle_configure_reading_settings' );

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

    // Pass AJAX URL to frontend
    wp_localize_script( 'charmelle-script', 'charmelle_ajax', array(
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'charmelle_newsletter' ),
    ) );

    // WooCommerce cart fragments for AJAX cart count updates
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' );
    }
}
add_action( 'wp_enqueue_scripts', 'charmelle_enqueue_assets' );

// ─── Google Analytics 4 (Placeholder) ───
// Replace 'G-XXXXXXXXXX' with your actual GA4 Measurement ID
function charmelle_ga4_tracking() {
    $ga4_id = ''; // <-- PASTE YOUR GA4 ID HERE, e.g. 'G-XXXXXXXXXX'
    if ( empty( $ga4_id ) ) return;

    echo '<!-- Google Analytics 4 -->' . "\n";
    echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr( $ga4_id ) . '"></script>' . "\n";
    echo '<script>' . "\n";
    echo 'window.dataLayer = window.dataLayer || [];' . "\n";
    echo 'function gtag(){dataLayer.push(arguments);}' . "\n";
    echo 'gtag("js", new Date());' . "\n";
    echo 'gtag("config", "' . esc_js( $ga4_id ) . '", {' . "\n";
    echo '    "anonymize_ip": true,' . "\n";
    echo '    "cookie_flags": "SameSite=None;Secure"' . "\n";
    echo '});' . "\n";
    echo '</script>' . "\n";
}
add_action( 'wp_head', 'charmelle_ga4_tracking', 99 );

// ─── WooCommerce Cart Fragment (AJAX cart count update) ───
function charmelle_cart_fragment( $fragments ) {
    $count = WC()->cart->get_cart_contents_count();
    $cart_url = wc_get_cart_url();

    ob_start();
    ?>
    <a href="<?php echo esc_url( $cart_url ); ?>" class="header-cart" aria-label="Warenkorb" title="Warenkorb">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        <?php if ( $count > 0 ) : ?>
        <span class="cart-count"><?php echo esc_html( $count ); ?></span>
        <?php endif; ?>
    </a>
    <?php
    $fragments['a.header-cart'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'charmelle_cart_fragment' );

// ─── WebP Image Helper ───
// Usage in templates: charmelle_img('hero-treatment', 'Alt text', 'eager', '580', '520');
function charmelle_img( $name, $alt = '', $loading = 'lazy', $width = '', $height = '', $class = '' ) {
    $t = get_template_directory_uri() . '/images/';
    // Determine original extension
    $ext = '';
    $dir = get_template_directory() . '/images/';
    foreach ( array( 'png', 'jpg', 'jpeg' ) as $e ) {
        if ( file_exists( $dir . $name . '.' . $e ) ) {
            $ext = $e;
            break;
        }
    }
    $has_webp = file_exists( $dir . $name . '.webp' );
    $attrs = '';
    if ( $width )   $attrs .= ' width="' . esc_attr( $width ) . '"';
    if ( $height )  $attrs .= ' height="' . esc_attr( $height ) . '"';
    if ( $class )   $attrs .= ' class="' . esc_attr( $class ) . '"';
    $fetchpriority = ( $loading === 'eager' ) ? ' fetchpriority="high"' : '';

    if ( $has_webp && $ext ) {
        echo '<picture>';
        echo '<source srcset="' . esc_url( $t . $name . '.webp' ) . '" type="image/webp">';
        echo '<img src="' . esc_url( $t . $name . '.' . $ext ) . '" alt="' . esc_attr( $alt ) . '" loading="' . esc_attr( $loading ) . '"' . $fetchpriority . $attrs . '>';
        echo '</picture>';
    } elseif ( $ext ) {
        echo '<img src="' . esc_url( $t . $name . '.' . $ext ) . '" alt="' . esc_attr( $alt ) . '" loading="' . esc_attr( $loading ) . '"' . $fetchpriority . $attrs . '>';
    }
}

// ─── Newsletter AJAX Handler ───
function charmelle_newsletter_signup() {
    check_ajax_referer( 'charmelle_newsletter', 'nonce' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    if ( ! is_email( $email ) ) {
        wp_send_json_error( 'Ungültige E-Mail-Adresse.' );
    }
    // Store in wp_options
    $subscribers = get_option( 'charmelle_newsletter_subscribers', array() );
    if ( in_array( $email, $subscribers, true ) ) {
        wp_send_json_success( 'Bereits angemeldet.' );
    }
    $subscribers[] = $email;
    update_option( 'charmelle_newsletter_subscribers', $subscribers );

    // Notify admin
    wp_mail(
        get_option( 'admin_email' ),
        'Neue Newsletter-Anmeldung — Charmelle',
        'Neue Anmeldung: ' . $email . "\n\nGesamte Abonnenten: " . count( $subscribers ),
        array( 'Content-Type: text/plain; charset=UTF-8' )
    );

    wp_send_json_success( 'Erfolgreich angemeldet.' );
}
add_action( 'wp_ajax_charmelle_newsletter', 'charmelle_newsletter_signup' );
add_action( 'wp_ajax_nopriv_charmelle_newsletter', 'charmelle_newsletter_signup' );

// ─── Preload Critical Assets + GEO Discovery Links ───
function charmelle_preload_assets() {
    $theme_uri = get_template_directory_uri();
    echo '<link rel="preload" href="' . esc_url( $theme_uri . '/images/hero-treatment.png' ) . '" as="image" fetchpriority="high">' . "\n";
    echo '<link rel="preload" href="' . esc_url( $theme_uri . '/images/logo.png' ) . '" as="image">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    // GEO / AI Discovery Links
    echo '<link rel="llms" type="text/plain" href="https://www.charmelle.ch/llms.txt">' . "\n";
    echo '<link rel="alternate" type="text/plain" href="https://www.charmelle.ch/llms-full.txt" title="Extended AI Summary">' . "\n";
    echo '<link rel="author" type="text/plain" href="https://www.charmelle.ch/humans.txt">' . "\n";
}
add_action( 'wp_head', 'charmelle_preload_assets', 1 );

// ─── Custom Meta Tags (SEO, OG, GEO) ───
function charmelle_meta_tags() {
    $theme_uri = get_template_directory_uri();
    $seo = charmelle_get_page_seo();
    $og_image = 'https://www.charmelle.ch/wp-content/themes/charmelle/images/logo.png';

    // Favicon
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( $theme_uri . '/images/favicon-32x32.png' ) . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( $theme_uri . '/images/favicon-16x16.png' ) . '">' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( $theme_uri . '/images/apple-touch-icon.png' ) . '">' . "\n";
    echo '<meta name="theme-color" content="#C5A880">' . "\n";
    echo '<meta name="format-detection" content="telephone=no">' . "\n";

    // Language & Region
    echo '<meta http-equiv="content-language" content="de-CH">' . "\n";
    echo '<link rel="alternate" hreflang="de-CH" href="https://www.charmelle.ch/">' . "\n";
    echo '<link rel="alternate" hreflang="de" href="https://www.charmelle.ch/">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="https://www.charmelle.ch/">' . "\n";

    // GEO Tags
    echo '<meta name="geo.region" content="CH-AG">' . "\n";
    echo '<meta name="geo.placename" content="Aarau">' . "\n";
    echo '<meta name="geo.position" content="47.3925;8.0440">' . "\n";
    echo '<meta name="ICBM" content="47.3925, 8.0440">' . "\n";

    // Page-specific SEO
    echo '<meta name="description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
    echo '<meta name="keywords" content="' . esc_attr( $seo['keywords'] ) . '">' . "\n";
    echo '<meta name="author" content="Charmelle Beauty Center GmbH">' . "\n";
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $seo['url'] ) . '">' . "\n";

    // Open Graph
    echo '<meta property="og:title" content="' . esc_attr( $seo['title'] ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $seo['url'] ) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:locale" content="de_CH">' . "\n";
    echo '<meta property="og:site_name" content="Charmelle Beauty Center">' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $seo['title'] ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
}
add_action( 'wp_head', 'charmelle_meta_tags', 2 );

// ─── Structured Data (JSON-LD) — ALL PAGES ───
function charmelle_structured_data() {
    $theme_uri = get_template_directory_uri();
    $base      = 'https://www.charmelle.ch';
    $logo      = esc_url( $theme_uri . '/images/logo.png' );

    // ── BeautySalon + WebSite Schema (Homepage) ──
    if ( is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@graph'   => array(
                array(
                    '@type'         => 'BeautySalon',
                    '@id'           => $base . '/#organization',
                    'name'          => 'Charmelle Beauty Center',
                    'alternateName' => array( 'Charmelle', 'Beauty Center Charmelle', 'Charmelle Beauty Center GmbH' ),
                    'image'         => $logo,
                    'logo'          => $logo,
                    'url'           => $base . '/',
                    'telephone'     => '+41628226647',
                    'email'         => 'info@charmelle.ch',
                    'description'   => 'Premium Kosmetikstudio in Aarau. Seit über 30 Jahren bieten wir Gesichtspflege, Hydra Facial, Microneedling, Anti-Aging-Behandlungen, LPG Endermologie, Wimpernlifting, Permanent Make-Up und medizinische Kosmetik im Kanton Aargau.',
                    'address'       => array(
                        '@type'           => 'PostalAddress',
                        'streetAddress'   => 'Girixweg 7',
                        'addressLocality' => 'Aarau',
                        'addressRegion'   => 'AG',
                        'postalCode'      => '5000',
                        'addressCountry'  => 'CH',
                    ),
                    'geo' => array(
                        '@type'     => 'GeoCoordinates',
                        'latitude'  => 47.3925,
                        'longitude' => 8.0440,
                    ),
                    'openingHoursSpecification' => array(
                        array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Monday', 'Thursday' ), 'opens' => '09:00', 'closes' => '19:00' ),
                        array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Tuesday', 'opens' => '09:00', 'closes' => '18:30' ),
                        array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Wednesday', 'Friday' ), 'opens' => '09:00', 'closes' => '18:30' ),
                        array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Saturday', 'opens' => '08:30', 'closes' => '14:00' ),
                    ),
                    'priceRange'         => 'CHF 30 - CHF 650',
                    'currenciesAccepted' => 'CHF',
                    'paymentAccepted'    => 'Bargeld, EC-Karte, Kreditkarte, TWINT',
                    'areaServed' => array(
                        array( '@type' => 'City', 'name' => 'Aarau' ),
                        array( '@type' => 'State', 'name' => 'Kanton Aargau' ),
                        array( '@type' => 'City', 'name' => 'Buchs AG' ),
                        array( '@type' => 'City', 'name' => 'Rohr AG' ),
                        array( '@type' => 'City', 'name' => 'Suhr' ),
                        array( '@type' => 'City', 'name' => 'Graenichen' ),
                        array( '@type' => 'City', 'name' => 'Erlinsbach' ),
                        array( '@type' => 'City', 'name' => 'Kuettigen' ),
                        array( '@type' => 'City', 'name' => 'Oberentfelden' ),
                        array( '@type' => 'City', 'name' => 'Unterentfelden' ),
                    ),
                    'sameAs' => array(
                        'https://www.instagram.com/beauty_charmelle/',
                        'https://www.facebook.com/charmellebeautycenter/',
                    ),
                    'aggregateRating' => array(
                        '@type'       => 'AggregateRating',
                        'ratingValue' => '5.0',
                        'bestRating'  => '5',
                        'worstRating' => '1',
                        'ratingCount' => '44',
                        'reviewCount' => '44',
                    ),
                    'hasOfferCatalog' => array(
                        '@type' => 'OfferCatalog',
                        'name'  => 'Kosmetik-Behandlungen',
                        'itemListElement' => array(
                            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Hydra Facial Syndeo', 'description' => 'Die Hollywood-Behandlung fuer strahlende Haut' ) ),
                            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Microneedling mit Hyaluron', 'description' => 'Medical-Kosmetik zur Hauterneuerung und Straffung' ) ),
                            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'LPG Endermologie', 'description' => 'Patentierte Technologie fuer Straffung und Body-Forming' ) ),
                            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Wimpernlifting', 'description' => 'Natuerlicher Wow-Effekt fuer Ihre Wimpern' ) ),
                            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Permanent Make-Up', 'description' => 'Augenbrauen, Lippen und Lidstriche dauerhaft betont' ) ),
                        ),
                    ),
                ),
                array(
                    '@type'       => 'WebSite',
                    '@id'         => $base . '/#website',
                    'url'         => $base,
                    'name'        => 'Charmelle Beauty Center',
                    'description' => 'Premium Kosmetikstudio in Aarau seit ueber 30 Jahren',
                    'publisher'   => array( '@id' => $base . '/#organization' ),
                    'inLanguage'  => 'de-CH',
                    'potentialAction' => array(
                        '@type'  => 'SearchAction',
                        'target' => array(
                            '@type'       => 'EntryPoint',
                            'urlTemplate' => $base . '/?s={search_term_string}',
                        ),
                        'query-input' => 'required name=search_term_string',
                    ),
                ),
            ),
        );
        echo '<script type="application/ld+json">' . "\n" . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . "\n" . '</script>' . "\n";
    }

    // ── BreadcrumbList Schema (all subpages) ──
    if ( ! is_front_page() ) {
        $crumbs = array(
            array( 'name' => 'Home', 'url' => $base . '/' )
        );

        if ( is_page( 'behandlungen' ) ) {
            $crumbs[] = array( 'name' => 'Behandlungen' );
        } elseif ( is_page( 'team' ) ) {
            $crumbs[] = array( 'name' => 'Team' );
        } elseif ( is_page( 'kontakt' ) ) {
            $crumbs[] = array( 'name' => 'Kontakt' );
        } elseif ( is_page( 'gutscheine' ) ) {
            $crumbs[] = array( 'name' => 'Gutscheine' );
        } elseif ( function_exists('is_shop') && is_shop() ) {
            $crumbs[] = array( 'name' => 'Shop' );
        } elseif ( is_home() ) {
            $crumbs[] = array( 'name' => 'Blog' );
        } elseif ( is_singular( 'post' ) ) {
            $crumbs[] = array( 'name' => 'Blog', 'url' => $base . '/blog/' );
            $crumbs[] = array( 'name' => get_the_title() );
        } elseif ( is_404() ) {
            $crumbs[] = array( 'name' => '404 - Seite nicht gefunden' );
        } else {
            $crumbs[] = array( 'name' => get_the_title() );
        }

        $items = array();
        foreach ( $crumbs as $i => $crumb ) {
            $item = array(
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $crumb['name'],
            );
            if ( isset( $crumb['url'] ) ) {
                $item['item'] = $crumb['url'];
            }
            $items[] = $item;
        }
        $breadcrumb = array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items );
        echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    // ── FAQPage Schema (Behandlungen page) ──
    if ( is_page( 'behandlungen' ) ) {
        $faq = array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array(
                array( '@type' => 'Question', 'name' => 'Wie oft sollte man eine Gesichtsbehandlung machen?', 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Wir empfehlen eine professionelle Gesichtsbehandlung alle 4-6 Wochen. So kann die Haut optimal regenerieren und die Ergebnisse werden nachhaltig verbessert. Bei speziellen Behandlungen wie Microneedling oder Hydra Facial besprechen wir den idealen Rhythmus individuell.' ) ),
                array( '@type' => 'Question', 'name' => 'Was kostet eine Behandlung bei Charmelle?', 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Unsere Behandlungen starten ab CHF 15 fuer Haarentfernung mit Wachs. Eine klassische Gesichtspflege kostet ab CHF 155, Hydra Facial ab CHF 165, Microneedling ab CHF 250 und Permanent Make-Up ab CHF 350. Die genauen Preise finden Sie auf unserer Behandlungsseite.' ) ),
                array( '@type' => 'Question', 'name' => 'Brauche ich einen Termin?', 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Ja, wir arbeiten ausschliesslich mit Terminen. So koennen wir uns voll und ganz auf Sie konzentrieren. Buchen Sie bequem online, per Telefon (062 822 66 47) oder WhatsApp (079 828 66 47).' ) ),
                array( '@type' => 'Question', 'name' => 'Welche Zahlungsmittel akzeptiert Charmelle?', 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Wir akzeptieren Bargeld, EC-Karte, Kreditkarte (Visa, Mastercard) und TWINT.' ) ),
            ),
        );
        echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    // ── Article Schema (Blog posts) ──
    if ( is_singular( 'post' ) ) {
        $article = array(
            '@context'       => 'https://schema.org',
            '@type'          => 'Article',
            'headline'       => get_the_title(),
            'description'    => wp_trim_words( get_the_excerpt(), 25, '...' ),
            'image'          => has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : $logo,
            'datePublished'  => get_the_date( 'c' ),
            'dateModified'   => get_the_modified_date( 'c' ),
            'author'         => array( '@type' => 'Organization', 'name' => 'Charmelle Beauty Center' ),
            'publisher'      => array(
                '@type' => 'Organization',
                '@id'   => $base . '/#organization',
                'name'  => 'Charmelle Beauty Center',
                'logo'  => array( '@type' => 'ImageObject', 'url' => $logo ),
            ),
            'mainEntityOfPage' => array( '@type' => 'WebPage', '@id' => get_permalink() ),
            'inLanguage'       => 'de-CH',
        );
        echo '<script type="application/ld+json">' . wp_json_encode( $article, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'charmelle_structured_data', 5 );

// ─── WooCommerce: Declare HPOS Compatibility ───
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );

// ─── WooCommerce: Remove duplicate archive title (we have our own hero) ───
add_filter( 'woocommerce_show_page_title', '__return_false' );

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

// ─── Contact Form 7 Support (if installed) ───
// The contact form shortcode can be placed in page-kontakt.php using:
// echo do_shortcode('[contact-form-7 id="FORM_ID" title="Kontakt"]');

// ─── Blog Import Tool (one-time use) ───
// Only loads when visiting: ?charmelle_import_blogs=1
// Delete import-blogs.php from theme after successful import.
if ( isset( $_GET['charmelle_import_blogs'] ) && file_exists( get_template_directory() . '/import-blogs.php' ) ) {
    require_once get_template_directory() . '/import-blogs.php';
}

// ─── Page-Specific SEO Data (replaces Yoast) ───
function charmelle_get_page_seo() {
    $base = 'https://www.charmelle.ch';

    // Default fallback
    $seo = array(
        'title'       => 'Charmelle Beauty Center Aarau — Kosmetikstudio',
        'description' => 'Charmelle Beauty Center in Aarau — Ihr Kosmetikstudio für Hydra Facial, Microneedling, Anti-Aging, Wimpernlifting, Permanent Make-Up & LPG Endermologie. Erfahrene Kosmetikerinnen EFZ. Seit über 30 Jahren.',
        'keywords'    => 'Kosmetikstudio Aarau, Beauty Center Aarau, Hydra Facial Aarau, Microneedling Aarau, Anti-Aging Aarau, Gesichtspflege Aarau, Wimpernlifting Aarau, Permanent Make-Up Aarau, Kosmetikerin EFZ Aarau, LPG Endermologie Aarau',
        'url'         => $base . '/',
    );

    // Front page always wins — must come first
    if ( is_front_page() ) {
        return $seo; // Use the default which IS the front page SEO
    }

    if ( is_page( 'behandlungen' ) ) {
        $seo = array(
            'title'       => 'Behandlungen — Charmelle Beauty Center Aarau',
            'description' => 'Alle Behandlungen im Charmelle Beauty Center Aarau: Hydra Facial Syndeo, Microneedling, LPG Endermologie, Dermabrasion, Wimpernlifting, Permanent Make-Up, Gesichtspflege, Anti-Aging und medizinische Kosmetik.',
            'keywords'    => 'Hydra Facial Aarau, Microneedling Aarau, LPG Endermologie, Gesichtspflege Aarau, Wimpernlifting, Permanent Make-Up Aarau, Anti-Aging Behandlung, Kosmetik Behandlungen Aargau',
            'url'         => $base . '/behandlungen/',
        );
    } elseif ( is_page( 'team' ) ) {
        $seo = array(
            'title'       => 'Team — Charmelle Beauty Center Aarau',
            'description' => 'Lernen Sie das Charmelle-Team kennen: Aurora, Oriana, Giulia, Elif & Stella — erfahrene Kosmetikerinnen EFZ in Aarau. Wir sprechen Deutsch, Italienisch & Englisch.',
            'keywords'    => 'Kosmetikerin Aarau, Beauty Team Aarau, Kosmetikerin EFZ, Berufsbildnerin, Visagistin, Kosmetikstudio Team Aarau',
            'url'         => $base . '/team/',
        );
    } elseif ( is_page( 'kontakt' ) ) {
        $seo = array(
            'title'       => 'Kontakt — Charmelle Beauty Center Aarau',
            'description' => 'Kontaktieren Sie das Charmelle Beauty Center Aarau: ☎ 062 822 66 47 · 📍 Girixweg 7, 5000 Aarau · WhatsApp: 079 828 66 47 · Termin online buchen.',
            'keywords'    => 'Kontakt Charmelle Aarau, Kosmetikstudio Aarau Adresse, Beauty Center Telefonnummer, Termin buchen Aarau, Girixweg 7 Aarau',
            'url'         => $base . '/kontakt/',
        );
    } elseif ( is_page( 'gutscheine' ) ) {
        $seo = array(
            'title'       => 'Gutscheine — Charmelle Beauty Center Aarau',
            'description' => 'Schenken Sie Schönheit und Wohlbefinden! Geschenkgutscheine von Charmelle Beauty Center Aarau ab CHF 50.— Wertgutschein. Online bestellen & verschenken.',
            'keywords'    => 'Geschenkgutschein Kosmetik Aarau, Beauty Gutschein, Wertgutschein Kosmetikstudio, Geschenk Gesichtspflege, Gutschein Hydra Facial',
            'url'         => $base . '/gutscheine/',
        );
    } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
        $seo = array(
            'title'       => 'Shop — Charmelle Beauty Center Aarau',
            'description' => 'Hochwertige Pflegeprodukte im Charmelle Online-Shop: Med Beauty Swiss, Team Dr. Joseph, Thalgo und mehr. Professionelle Hautpflege direkt zu Ihnen nach Hause.',
            'keywords'    => 'Kosmetik Shop Aarau, Pflegeprodukte kaufen, Med Beauty Swiss, Thalgo Produkte, Hautpflege Online Shop Schweiz',
            'url'         => $base . '/shop/',
        );
    } elseif ( is_singular( 'post' ) ) {
        $seo = array(
            'title'       => get_the_title() . ' — Charmelle Blog',
            'description' => wp_trim_words( get_the_excerpt(), 25, '…' ),
            'keywords'    => 'Beauty Blog, Hautpflege Tipps, Kosmetik Aarau, Charmelle Blog',
            'url'         => get_permalink(),
        );
    } elseif ( is_home() ) {
        $seo = array(
            'title'       => 'Blog — Charmelle Beauty Center Aarau',
            'description' => 'Beauty-Wissen, Pflegetipps und Neuigkeiten aus dem Charmelle Beauty Center Aarau. Erfahren Sie mehr über Hydra Facial, Microneedling und professionelle Hautpflege.',
            'keywords'    => 'Beauty Blog Aarau, Hautpflege Tipps, Kosmetik Ratgeber, Hydra Facial Erfahrung, Microneedling Blog',
            'url'         => $base . '/blog/',
        );
    }

    return $seo;
}

// ─── WooCommerce Product Grid Styling ───
function charmelle_woocommerce_inline_styles() {
    if ( ! class_exists( 'WooCommerce' ) ) return;
    $css = '
    /* ═══════════════════════════════════════════════════
       Category Filter Bar
       ═══════════════════════════════════════════════════ */
    .shop-categories {
        padding: 0 0 8px;
        background: var(--bg-secondary, #F7F3ED);
    }
    .category-filter-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        padding: 24px 0;
    }
    .category-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 22px;
        border-radius: 50px;
        background: var(--bg-primary);
        color: var(--text-heading);
        font-family: var(--font-body);
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        border: 1px solid var(--border-color, #E8E0D4);
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        white-space: nowrap;
    }
    .category-pill:hover {
        border-color: var(--accent-gold);
        color: var(--accent-gold);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(184,149,106,0.15);
    }
    .category-pill.active {
        background: var(--accent-gold);
        color: #fff;
        border-color: var(--accent-gold);
    }
    .category-pill .cat-count {
        font-size: 0.72rem;
        opacity: 0.7;
        font-weight: 400;
    }
    .category-pill.active .cat-count {
        opacity: 0.85;
    }
    @media (max-width: 600px) {
        .category-filter-bar {
            justify-content: flex-start;
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 12px;
        }
        .category-pill {
            padding: 8px 18px;
            font-size: 0.82rem;
        }
    }

    /* ═══════════════════════════════════════════════════
       WooCommerce Product Grid — Charmelle Design System
       ═══════════════════════════════════════════════════ */

    /* --- Shop Page Layout --- */
    .woocommerce .woocommerce-result-count {
        font-family: var(--font-body);
        font-size: 0.85rem;
        color: var(--text-light);
        letter-spacing: 0.03em;
    }
    .woocommerce .woocommerce-ordering select {
        font-family: var(--font-body);
        font-size: 0.85rem;
        padding: 10px 16px;
        border: 1px solid var(--border-color, #E8E0D4);
        border-radius: 8px;
        background: var(--bg-primary);
        color: var(--text-heading);
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    .woocommerce .woocommerce-ordering select:focus {
        border-color: var(--accent-gold);
        outline: none;
    }

    /* --- Product Grid --- */
    .woocommerce ul.products {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        padding: 0;
        list-style: none;
    }

    /* --- Product Card --- */
    .woocommerce ul.products li.product {
        width: 100% !important;
        margin: 0 !important;
        float: none !important;
        background: var(--bg-primary);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(74,59,50,0.06);
        transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), box-shadow 0.4s cubic-bezier(0.4,0,0.2,1);
        position: relative;
    }
    .woocommerce ul.products li.product:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(74,59,50,0.12);
    }

    /* --- Product Image --- */
    .woocommerce ul.products li.product a img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 0;
        margin: 0;
        transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
    }
    .woocommerce ul.products li.product:hover a img {
        transform: scale(1.05);
    }
    .woocommerce ul.products li.product > a {
        display: block;
        overflow: hidden;
        text-decoration: none;
    }

    /* --- Product Info --- */
    .woocommerce ul.products li.product .woocommerce-loop-product__title {
        font-family: var(--font-heading);
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--text-heading);
        padding: 20px 24px 6px;
        margin: 0;
        line-height: 1.4;
    }
    .woocommerce ul.products li.product .price {
        font-family: var(--font-body);
        font-size: 1rem;
        color: var(--accent-gold);
        font-weight: 600;
        padding: 0 24px;
        display: block;
    }
    .woocommerce ul.products li.product .price del {
        color: var(--text-light);
        opacity: 0.5;
        font-weight: 400;
        font-size: 0.9rem;
    }
    .woocommerce ul.products li.product .price ins {
        text-decoration: none;
        color: var(--accent-gold);
    }

    /* --- Add to Cart Button --- */
    .woocommerce ul.products li.product .button,
    .woocommerce ul.products li.product .add_to_cart_button,
    .woocommerce ul.products li.product .product_type_variable {
        display: block;
        margin: 16px 24px 24px;
        padding: 13px 24px;
        background: var(--accent-gold);
        color: #fff !important;
        border: none;
        border-radius: 10px;
        font-family: var(--font-body);
        font-size: 0.82rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        text-decoration: none;
    }
    .woocommerce ul.products li.product .button:hover {
        background: var(--accent-gold-dark, #A07A58);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(184,149,106,0.3);
    }

    /* --- Sale Badge --- */
    .woocommerce ul.products li.product .onsale,
    .woocommerce span.onsale {
        background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark, #A07A58));
        color: #fff;
        font-family: var(--font-body);
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 8px;
        padding: 6px 14px;
        top: 16px;
        right: 16px;
        left: auto;
        min-height: auto;
        min-width: auto;
        line-height: 1.4;
        z-index: 2;
    }

    /* --- Star Rating --- */
    .woocommerce ul.products li.product .star-rating {
        margin: 10px 24px 0;
        color: var(--accent-gold);
        font-size: 0.85rem;
    }

    /* --- Pagination --- */
    .woocommerce nav.woocommerce-pagination {
        margin-top: 48px;
    }
    .woocommerce nav.woocommerce-pagination ul li a,
    .woocommerce nav.woocommerce-pagination ul li span {
        font-family: var(--font-body);
        border-radius: 10px !important;
        padding: 10px 16px;
        border-color: var(--border-color, #E8E0D4) !important;
        color: var(--text-heading);
        transition: all 0.3s ease;
    }
    .woocommerce nav.woocommerce-pagination ul li a:hover,
    .woocommerce nav.woocommerce-pagination ul li span.current {
        background: var(--accent-gold) !important;
        color: #fff !important;
        border-color: var(--accent-gold) !important;
    }

    /* ═══════════════════════════════════════
       Single Product Page
       ═══════════════════════════════════════ */
    .woocommerce div.product {
        max-width: 1100px;
        margin: 0 auto;
    }
    .woocommerce div.product div.images {
        border-radius: 16px;
        overflow: hidden;
    }
    .woocommerce div.product div.images img {
        border-radius: 16px;
    }
    .woocommerce div.product .product_title {
        font-family: var(--font-heading);
        font-size: 2rem;
        font-weight: 500;
        color: var(--text-heading);
        margin-bottom: 8px;
    }
    .woocommerce div.product .price {
        color: var(--accent-gold);
        font-size: 1.5rem;
        font-weight: 600;
        font-family: var(--font-body);
    }
    .woocommerce div.product .woocommerce-product-details__short-description {
        color: var(--text-light);
        line-height: 1.7;
        margin: 16px 0;
    }
    .woocommerce div.product form.cart {
        margin: 24px 0;
    }
    .woocommerce div.product form.cart .qty {
        font-family: var(--font-body);
        padding: 12px;
        border: 1px solid var(--border-color, #E8E0D4);
        border-radius: 10px;
        width: 80px;
        text-align: center;
    }
    .woocommerce div.product .single_add_to_cart_button {
        background: var(--accent-gold) !important;
        border: none !important;
        border-radius: 10px;
        font-family: var(--font-body);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 16px 40px;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    .woocommerce div.product .single_add_to_cart_button:hover {
        background: var(--accent-gold-dark, #A07A58) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(184,149,106,0.3);
    }

    /* --- Product Tabs --- */
    .woocommerce div.product .woocommerce-tabs {
        margin-top: 48px;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs {
        padding: 0 !important;
        margin: 0 0 24px !important;
        border-bottom: 2px solid var(--border-color, #E8E0D4) !important;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs::before {
        border-bottom: none !important;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li {
        background: none !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li::before,
    .woocommerce div.product .woocommerce-tabs ul.tabs li::after {
        display: none !important;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li a {
        font-family: var(--font-body);
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-light);
        padding: 12px 24px;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s ease;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a {
        color: var(--accent-gold);
        border-bottom-color: var(--accent-gold);
    }

    /* --- Related Products --- */
    .woocommerce div.product .related.products > h2,
    .woocommerce div.product .upsells.products > h2 {
        font-family: var(--font-heading);
        font-size: 1.6rem;
        font-weight: 500;
        margin-bottom: 24px;
    }

    /* ═══════════════════════════════════════
       Cart & Checkout
       ═══════════════════════════════════════ */
    .woocommerce table.cart {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-color, #E8E0D4);
    }
    .woocommerce table.cart th {
        font-family: var(--font-body);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-light);
        background: var(--bg-secondary, #F7F3ED);
    }
    .woocommerce table.cart td {
        font-family: var(--font-body);
        vertical-align: middle;
    }
    .woocommerce table.cart img {
        border-radius: 10px;
    }
    .woocommerce .cart-collaterals .cart_totals {
        border-radius: 16px;
        border: 1px solid var(--border-color, #E8E0D4);
        padding: 24px;
        background: var(--bg-primary);
    }
    .woocommerce .button.checkout-button,
    .woocommerce #place_order,
    .woocommerce .wc-proceed-to-checkout a.checkout-button {
        background: var(--accent-gold) !important;
        border: none !important;
        border-radius: 10px !important;
        font-family: var(--font-body);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 16px 32px;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        color: #fff !important;
    }
    .woocommerce .button.checkout-button:hover,
    .woocommerce #place_order:hover,
    .woocommerce .wc-proceed-to-checkout a.checkout-button:hover {
        background: var(--accent-gold-dark, #A07A58) !important;
        transform: translateY(-2px);
    }

    /* --- Breadcrumb --- */
    .woocommerce .woocommerce-breadcrumb {
        font-family: var(--font-body);
        font-size: 0.82rem;
        color: var(--text-light);
        margin-bottom: 24px;
    }
    .woocommerce .woocommerce-breadcrumb a {
        color: var(--accent-gold);
        text-decoration: none;
    }
    .woocommerce .woocommerce-breadcrumb a:hover {
        text-decoration: underline;
    }

    /* --- Notices --- */
    .woocommerce .woocommerce-message,
    .woocommerce .woocommerce-info {
        border-top-color: var(--accent-gold);
        border-radius: 10px;
        font-family: var(--font-body);
    }
    .woocommerce .woocommerce-message::before,
    .woocommerce .woocommerce-info::before {
        color: var(--accent-gold);
    }
    .woocommerce .woocommerce-message .button {
        background: var(--accent-gold);
        color: #fff;
        border-radius: 8px;
        font-family: var(--font-body);
        text-transform: uppercase;
        font-size: 0.82rem;
        letter-spacing: 0.08em;
    }

    /* ═══════════════════════════════════════
       Responsive
       ═══════════════════════════════════════ */
    @media (max-width: 900px) {
        .woocommerce ul.products {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .woocommerce ul.products li.product a img {
            height: 240px;
        }
        .woocommerce ul.products li.product .woocommerce-loop-product__title {
            padding: 14px 16px 4px;
            font-size: 0.95rem;
        }
        .woocommerce ul.products li.product .price {
            padding: 0 16px;
        }
        .woocommerce ul.products li.product .button {
            margin: 12px 16px 16px;
        }
    }
    @media (max-width: 540px) {
        .woocommerce ul.products {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .woocommerce ul.products li.product a img {
            height: 280px;
        }
        .woocommerce div.product .product_title {
            font-size: 1.5rem;
        }
    }
    ';
    wp_add_inline_style( 'charmelle-design-system', $css );
}
add_action( 'wp_enqueue_scripts', 'charmelle_woocommerce_inline_styles', 20 );

// ─── Accessibility & Polish CSS ───
function charmelle_a11y_inline_styles() {
    $css = '
    /* Focus-visible outlines for keyboard navigation */
    :focus-visible {
        outline: 2px solid var(--accent-gold);
        outline-offset: 2px;
    }
    :focus:not(:focus-visible) {
        outline: none;
    }
    /* Hamburger menu touch target (min 44x44px) */
    .menu-toggle {
        min-width: 44px;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Mobile font-size: minimum 16px (prevents iOS zoom on input focus) */
    @media (max-width: 768px) {
        body {
            font-size: 16px;
        }
        input, select, textarea {
            font-size: 16px;
        }
    }
    ';
    wp_add_inline_style( 'charmelle-design-system', $css );
}
add_action( 'wp_enqueue_scripts', 'charmelle_a11y_inline_styles', 21 );

