<?php
/**
 * Generic page template (fallback for pages without a specific template).
 */
get_header();
?>

  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Charmelle Beauty Center</span>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section" id="page-content">
    <div class="container container--narrow">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="entry-content reveal">
          <?php the_content(); ?>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </section>

<?php get_footer(); ?>
