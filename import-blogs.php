<?php
/**
 * Charmelle Blog Import Script
 * 
 * One-time use: Imports blog posts from data/blog.json into WordPress.
 * 
 * HOW TO USE:
 * 1. Place this file in the theme directory (already done)
 * 2. Navigate to: https://www.charmelle.ch/?charmelle_import_blogs=1
 * 3. You must be logged in as admin
 * 4. Posts will be created automatically
 * 5. DELETE THIS FILE after import (or it will be ignored on subsequent runs)
 */

// Hook into WordPress init
add_action( 'init', 'charmelle_import_blog_posts' );

function charmelle_import_blog_posts() {
    // Only run when triggered via URL parameter
    if ( ! isset( $_GET['charmelle_import_blogs'] ) || $_GET['charmelle_import_blogs'] !== '1' ) {
        return;
    }

    // Must be logged in as admin
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Sie müssen als Administrator eingeloggt sein.' );
    }

    $json_path = get_template_directory() . '/data/blog.json';

    if ( ! file_exists( $json_path ) ) {
        wp_die( 'blog.json nicht gefunden: ' . $json_path );
    }

    $json = file_get_contents( $json_path );
    $data = json_decode( $json, true );

    if ( ! $data || ! isset( $data['posts'] ) ) {
        wp_die( 'Ungültiges JSON-Format in blog.json' );
    }

    $imported = 0;
    $skipped  = 0;
    $results  = array();

    foreach ( $data['posts'] as $post ) {
        // Check if post already exists (by slug)
        $existing = get_page_by_path( $post['slug'], OBJECT, 'post' );
        if ( $existing ) {
            $skipped++;
            $results[] = '⏭ ÜBERSPRUNGEN: "' . $post['title'] . '" (existiert bereits)';
            continue;
        }

        // Convert Markdown body to HTML (basic conversion)
        $html_body = charmelle_markdown_to_html( $post['body'] );

        // Create or get category
        $cat_id = 0;
        if ( ! empty( $post['categoryLabel'] ) ) {
            $cat = get_term_by( 'name', $post['categoryLabel'], 'category' );
            if ( $cat ) {
                $cat_id = $cat->term_id;
            } else {
                $cat_id = wp_create_category( $post['categoryLabel'] );
            }
        }

        // Create the post
        $new_post_id = wp_insert_post( array(
            'post_title'   => sanitize_text_field( $post['title'] ),
            'post_content' => $html_body,
            'post_excerpt' => sanitize_text_field( $post['excerpt'] ),
            'post_name'    => sanitize_title( $post['slug'] ),
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => date( 'Y-m-d H:i:s', strtotime( $post['date'] ) ),
            'post_author'  => 1,
            'post_category' => $cat_id ? array( $cat_id ) : array(),
        ) );

        if ( is_wp_error( $new_post_id ) ) {
            $results[] = '❌ FEHLER: "' . $post['title'] . '" — ' . $new_post_id->get_error_message();
            continue;
        }

        // Set featured image from theme images directory
        if ( ! empty( $post['image'] ) ) {
            $image_path = get_template_directory() . '/' . $post['image'];
            if ( file_exists( $image_path ) ) {
                $attachment_id = charmelle_create_attachment( $image_path, $new_post_id );
                if ( $attachment_id ) {
                    set_post_thumbnail( $new_post_id, $attachment_id );
                }
            }
        }

        $imported++;
        $results[] = '✅ IMPORTIERT: "' . $post['title'] . '" (ID: ' . $new_post_id . ')';
    }

    // Output results
    $output = '<div style="font-family:Jost,sans-serif;max-width:800px;margin:60px auto;padding:40px;background:#FDFBF7;border:1px solid #E8E0D4;border-radius:12px;">';
    $output .= '<h1 style="font-family:Playfair Display,serif;color:#4A3B32;">Charmelle Blog Import</h1>';
    $output .= '<hr style="border:none;border-top:2px solid #C5A880;width:60px;margin:16px 0 24px;">';
    $output .= '<p><strong>' . $imported . '</strong> Beiträge importiert, <strong>' . $skipped . '</strong> übersprungen.</p>';
    $output .= '<ul style="list-style:none;padding:0;">';
    foreach ( $results as $r ) {
        $output .= '<li style="padding:8px 0;border-bottom:1px solid #E8E0D4;">' . $r . '</li>';
    }
    $output .= '</ul>';
    $output .= '<p style="margin-top:24px;color:#7A6B5D;">Sie können diese Datei jetzt löschen: <code>import-blogs.php</code></p>';
    $output .= '<a href="' . admin_url( 'edit.php' ) . '" style="display:inline-block;margin-top:16px;padding:12px 24px;background:#C5A880;color:#fff;text-decoration:none;border-radius:6px;">→ Beiträge anzeigen</a>';
    $output .= '</div>';

    wp_die( $output, 'Blog Import — Charmelle' );
}

/**
 * Basic Markdown to HTML converter
 */
function charmelle_markdown_to_html( $md ) {
    // Headers
    $html = preg_replace( '/^### (.+)$/m', '<h3>$1</h3>', $md );
    $html = preg_replace( '/^## (.+)$/m', '<h2>$1</h2>', $html );

    // Bold
    $html = preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', $html );

    // Links
    $html = preg_replace( '/\[(.+?)\]\((.+?)\)/', '<a href="$2">$1</a>', $html );

    // Ordered lists
    $html = preg_replace( '/^\d+\. (.+)$/m', '<li>$1</li>', $html );

    // Unordered lists
    $html = preg_replace( '/^- (.+)$/m', '<li>$1</li>', $html );

    // Wrap consecutive <li> tags in <ul> or <ol>
    $html = preg_replace( '/((?:<li>.*<\/li>\n?)+)/', '<ul>$1</ul>', $html );

    // Paragraphs (double newlines)
    $html = preg_replace( '/\n\n(?!<[hulo])/', '</p><p>', $html );
    $html = '<p>' . $html . '</p>';

    // Clean up empty paragraphs
    $html = str_replace( '<p></p>', '', $html );
    $html = str_replace( '<p><h', '<h', $html );
    $html = str_replace( '</h2></p>', '</h2>', $html );
    $html = str_replace( '</h3></p>', '</h3>', $html );
    $html = str_replace( '<p><ul>', '<ul>', $html );
    $html = str_replace( '</ul></p>', '</ul>', $html );

    return $html;
}

/**
 * Create WP attachment from a local file
 */
function charmelle_create_attachment( $filepath, $parent_post_id ) {
    $filetype = wp_check_filetype( basename( $filepath ), null );
    $wp_upload_dir = wp_upload_dir();

    // Copy to uploads
    $filename = basename( $filepath );
    $new_path = $wp_upload_dir['path'] . '/' . $filename;

    if ( ! file_exists( $new_path ) ) {
        copy( $filepath, $new_path );
    }

    $attachment = array(
        'guid'           => $wp_upload_dir['url'] . '/' . $filename,
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name( pathinfo( $filename, PATHINFO_FILENAME ) ),
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    $attach_id = wp_insert_attachment( $attachment, $new_path, $parent_post_id );

    if ( ! is_wp_error( $attach_id ) ) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $new_path );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }

    return $attach_id;
}
