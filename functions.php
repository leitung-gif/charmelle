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

    // Pass AJAX URL to frontend
    wp_localize_script( 'charmelle-script', 'charmelle_ajax', array(
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'charmelle_newsletter' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'charmelle_enqueue_assets' );

// ─── Google Analytics 4 (Placeholder) ───
// Replace 'G-XXXXXXXXXX' with your actual GA4 Measurement ID
function charmelle_ga4_tracking() {
    $ga4_id = ''; // <-- PASTE YOUR GA4 ID HERE, e.g. 'G-XXXXXXXXXX'
    if ( empty( $ga4_id ) ) return; // Skip if no ID set

    ?>
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4_id ); ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo esc_js( $ga4_id ); ?>', {
        'anonymize_ip': true,
        'cookie_flags': 'SameSite=None;Secure'
    });
    </script>
    <?php
}
add_action( 'wp_head', 'charmelle_ga4_tracking', 99 );

// ─── WebP Image Helper ───
// Usage in templates: <?php charmelle_img('hero-treatment', 'Alt text', 'eager', '580', '520'); ?>
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

    // Determine page-specific SEO data
    $seo = charmelle_get_page_seo();
    $og_image = 'https://www.charmelle.ch/wp-content/themes/charmelle/images/logo.png';
    ?>
    <meta name="description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $seo['keywords'] ); ?>">
    <meta name="author" content="Charmelle Beauty Center GmbH">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $seo['url'] ); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo esc_url( $seo['url'] ); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_CH">
    <meta property="og:site_name" content="Charmelle Beauty Center">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">
    <?php
}
add_action( 'wp_head', 'charmelle_meta_tags', 2 );

// ─── Structured Data (JSON-LD) — ALL PAGES ───
function charmelle_structured_data() {
    $theme_uri = get_template_directory_uri();
    $base      = 'https://www.charmelle.ch';
    $logo      = esc_url( $theme_uri . '/images/logo.png' );

    // ── BeautySalon + WebSite Schema (Homepage) ──
    if ( is_front_page() ) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "BeautySalon",
                    "@id": "<?php echo $base; ?>/#organization",
                    "name": "Charmelle Beauty Center",
                    "alternateName": ["Charmelle", "Beauty Center Charmelle", "Charmelle Beauty Center GmbH"],
                    "image": "<?php echo $logo; ?>",
                    "logo": "<?php echo $logo; ?>",
                    "url": "<?php echo $base; ?>/",
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
                },
                {
                    "@type": "WebSite",
                    "@id": "<?php echo $base; ?>/#website",
                    "url": "<?php echo $base; ?>",
                    "name": "Charmelle Beauty Center",
                    "description": "Premium Kosmetikstudio in Aarau seit über 30 Jahren",
                    "publisher": {"@id": "<?php echo $base; ?>/#organization"},
                    "inLanguage": "de-CH",
                    "potentialAction": {
                        "@type": "SearchAction",
                        "target": {
                            "@type": "EntryPoint",
                            "urlTemplate": "<?php echo $base; ?>/?s={search_term_string}"
                        },
                        "query-input": "required name=search_term_string"
                    }
                }
            ]
        }
        </script>
        <?php
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
            $crumbs[] = array( 'name' => '404 — Seite nicht gefunden' );
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
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo wp_json_encode( $items ); ?>
        }
        </script>
        <?php
    }

    // ── FAQPage Schema (Behandlungen page) ──
    if ( is_page( 'behandlungen' ) ) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "Wie oft sollte man eine Gesichtsbehandlung machen?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Wir empfehlen eine professionelle Gesichtsbehandlung alle 4-6 Wochen. So kann die Haut optimal regenerieren und die Ergebnisse werden nachhaltig verbessert. Bei speziellen Behandlungen wie Microneedling oder Hydra Facial besprechen wir den idealen Rhythmus individuell."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Was kostet eine Behandlung bei Charmelle?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Unsere Behandlungen starten ab CHF 15.— für Haarentfernung mit Wachs. Eine klassische Gesichtspflege kostet ab CHF 155.—, Hydra Facial ab CHF 165.—, Microneedling ab CHF 250.— und Permanent Make-Up ab CHF 350.—. Die genauen Preise finden Sie auf unserer Behandlungsseite."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Brauche ich einen Termin?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Ja, wir arbeiten ausschliesslich mit Terminen. So können wir uns voll und ganz auf Sie konzentrieren. Buchen Sie bequem online, per Telefon (062 822 66 47) oder WhatsApp (079 828 66 47)."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Welche Zahlungsmittel akzeptiert Charmelle?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Wir akzeptieren Bargeld, EC-Karte, Kreditkarte (Visa, Mastercard) und TWINT."
                    }
                }
            ]
        }
        </script>
        <?php
    }

    // ── Article Schema (Blog posts) ──
    if ( is_singular( 'post' ) ) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "<?php echo esc_js( get_the_title() ); ?>",
            "description": "<?php echo esc_js( wp_trim_words( get_the_excerpt(), 25, '…' ) ); ?>",
            "image": "<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url( null, 'large' ) ) : $logo; ?>",
            "datePublished": "<?php echo get_the_date( 'c' ); ?>",
            "dateModified": "<?php echo get_the_modified_date( 'c' ); ?>",
            "author": {
                "@type": "Organization",
                "name": "Charmelle Beauty Center"
            },
            "publisher": {
                "@type": "Organization",
                "@id": "<?php echo $base; ?>/#organization",
                "name": "Charmelle Beauty Center",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?php echo $logo; ?>"
                }
            },
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo esc_url( get_permalink() ); ?>"
            },
            "inLanguage": "de-CH"
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

// ─── Contact Form 7 Support (if installed) ───
// The contact form shortcode can be placed in page-kontakt.php using:
// <?php echo do_shortcode('[contact-form-7 id="FORM_ID" title="Kontakt"]'); ?>

// ─── Blog Import Tool (one-time use) ───
// Only loads when visiting: ?charmelle_import_blogs=1
// Delete import-blogs.php from theme after successful import.
if ( isset( $_GET['charmelle_import_blogs'] ) && file_exists( get_template_directory() . '/import-blogs.php' ) ) {
    require_once get_template_directory() . '/import-blogs.php';
}

// ─── Page-Specific SEO Data (replaces Yoast) ───
function charmelle_get_page_seo() {
    $base = 'https://www.charmelle.ch';

    // Default (front page)
    $seo = array(
        'title'       => 'Charmelle Beauty Center Aarau — Kosmetikstudio',
        'description' => 'Charmelle Beauty Center in Aarau — Ihr Kosmetikstudio für Hydra Facial, Microneedling, Anti-Aging, Wimpernlifting, Permanent Make-Up & LPG Endermologie. Erfahrene Kosmetikerinnen EFZ. Seit über 30 Jahren.',
        'keywords'    => 'Kosmetikstudio Aarau, Beauty Center Aarau, Hydra Facial Aarau, Microneedling Aarau, Anti-Aging Aarau, Gesichtspflege Aarau, Wimpernlifting Aarau, Permanent Make-Up Aarau, Kosmetikerin EFZ Aarau, LPG Endermologie Aarau',
        'url'         => $base . '/',
    );

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
    /* WooCommerce Product Grid — Charmelle Design System */
    .woocommerce ul.products {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
    }
    .woocommerce ul.products li.product {
        width: 100% !important;
        margin: 0 !important;
        float: none !important;
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-card);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .woocommerce ul.products li.product:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-elevated);
    }
    .woocommerce ul.products li.product a img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 0;
        margin: 0;
    }
    .woocommerce ul.products li.product .woocommerce-loop-product__title {
        font-family: var(--font-heading);
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-heading);
        padding: 16px 20px 4px;
        margin: 0;
    }
    .woocommerce ul.products li.product .price {
        font-family: var(--font-body);
        font-size: 1rem;
        color: var(--accent-gold);
        font-weight: 500;
        padding: 0 20px;
    }
    .woocommerce ul.products li.product .price del {
        color: var(--text-light);
        opacity: 0.6;
    }
    .woocommerce ul.products li.product .price ins {
        text-decoration: none;
        color: var(--accent-gold);
    }
    .woocommerce ul.products li.product .button,
    .woocommerce ul.products li.product .add_to_cart_button {
        display: block;
        margin: 12px 20px 20px;
        padding: 12px 20px;
        background: var(--accent-gold);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-body);
        font-size: 0.85rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        text-align: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .woocommerce ul.products li.product .button:hover {
        background: var(--accent-gold-dark, #A07A58);
    }
    .woocommerce ul.products li.product .onsale {
        background: var(--accent-gold);
        color: var(--text-white);
        font-family: var(--font-body);
        font-size: 0.72rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-radius: 4px;
        padding: 4px 12px;
        top: 12px;
        right: 12px;
        left: auto;
        min-height: auto;
        min-width: auto;
        line-height: 1.5;
    }
    .woocommerce ul.products li.product .star-rating {
        margin: 8px 20px 0;
        color: var(--accent-gold);
    }
    /* Single product page */
    .woocommerce div.product .product_title {
        font-family: var(--font-heading);
        color: var(--text-heading);
    }
    .woocommerce div.product .price {
        color: var(--accent-gold);
        font-size: 1.4rem;
    }
    .woocommerce div.product .single_add_to_cart_button {
        background: var(--accent-gold) !important;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-body);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 14px 32px;
    }
    .woocommerce div.product .single_add_to_cart_button:hover {
        background: var(--accent-gold-dark, #A07A58) !important;
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a {
        color: var(--accent-gold);
    }
    /* Cart & Checkout */
    .woocommerce .button.checkout-button,
    .woocommerce #place_order {
        background: var(--accent-gold) !important;
        font-family: var(--font-body);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    /* Responsive */
    @media (max-width: 900px) {
        .woocommerce ul.products {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }
    @media (max-width: 540px) {
        .woocommerce ul.products {
            grid-template-columns: 1fr;
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

