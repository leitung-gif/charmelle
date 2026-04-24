<?php
/**
 * Template Name: Behandlungen
 * Page template for the Treatments page — all 22 categories, ~150 treatments.
 */
get_header();
$t = get_template_directory_uri();

// Load all treatment data
$all_categories = array_merge(
  include get_template_directory() . '/data/treatments-1.php',
  include get_template_directory() . '/data/treatments-2.php',
  include get_template_directory() . '/data/treatments-3.php'
);
?>

<style>
.behandlung-nav{position:sticky;top:var(--header-height);z-index:90;background:rgba(253,251,247,0.95);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border-bottom:1px solid var(--border-color);padding:12px 0;transition:box-shadow var(--transition-smooth)}
.behandlung-nav.shadowed{box-shadow:var(--shadow-soft)}
.behandlung-nav-inner{display:flex;gap:8px;overflow-x:auto;scrollbar-width:none;-ms-overflow-style:none;padding:0 24px;max-width:var(--container-max);margin:0 auto}
.behandlung-nav-inner::-webkit-scrollbar{display:none}
.cat-pill{white-space:nowrap;padding:8px 18px;font-family:var(--font-body);font-size:0.78rem;font-weight:400;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-light);background:transparent;border:1.5px solid var(--border-color);border-radius:30px;cursor:pointer;transition:all var(--transition-fast);flex-shrink:0;text-decoration:none;display:inline-flex;align-items:center;gap:6px}
.cat-pill:hover{color:var(--accent-gold);border-color:var(--accent-gold)}
.cat-pill.active{background:var(--accent-gold);color:var(--text-white);border-color:var(--accent-gold)}
.treatment-category{padding:60px 0 40px;border-bottom:1px solid var(--border-color)}
.treatment-category:last-of-type{border-bottom:none}
.cat-header{margin-bottom:40px}
.cat-header h2{font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:6px}
.cat-header p{color:var(--text-light);font-size:0.95rem;margin-bottom:0}
.treatment-grid{display:flex;flex-direction:column;gap:0}
.t-item{display:grid;grid-template-columns:1fr auto;gap:24px;align-items:center;padding:20px 0;border-bottom:1px solid rgba(213,195,161,0.2)}
.t-item:last-child{border-bottom:none}
.t-name{font-family:var(--font-heading);font-size:1.05rem;font-weight:500;color:var(--text-heading);margin-bottom:4px;display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.t-desc{font-size:0.88rem;color:var(--text-light);line-height:1.6;margin-bottom:6px;max-width:700px}
.t-meta{display:flex;align-items:center;gap:16px;flex-wrap:wrap}
.t-duration{font-size:0.8rem;color:var(--text-light)}
.t-right{text-align:right;display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0}
.t-price{font-family:var(--font-heading);font-size:1.2rem;color:var(--text-heading);font-weight:500;white-space:nowrap}
.t-price.free{color:var(--accent-gold)}
.t-badge{display:inline-block;font-size:0.7rem;padding:3px 10px;border-radius:20px;font-weight:400;text-transform:uppercase;letter-spacing:0.06em}
.t-badge.neu{background:#e8f5e9;color:#2e7d32}
.t-badge.lehrjahr{background:#fff3e0;color:#e65100}
.t-badge.kombi{background:#e3f2fd;color:#1565c0}
.t-badge.addon{background:var(--accent-gold-light);color:var(--accent-gold)}
.t-badge.spezial{background:#f3e5f5;color:#7b1fa2}
.cat-count{font-size:0.75rem;color:var(--text-light);font-weight:300;margin-left:4px}
@media(max-width:768px){
  .t-item{grid-template-columns:1fr;gap:12px}
  .t-right{flex-direction:row;align-items:center;justify-content:space-between;width:100%}
  .behandlung-nav{top:var(--header-height)}
}
</style>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Charmelle Beauty Center Aarau</span>
      <h1>Unsere <em class="text-italic">Behandlungen</em></h1>
      <p>Über 150 professionelle Behandlungen — von medizinischer Hightech-Kosmetik über klassische Verwöhnpflege bis zu Permanent Make-up. Entdecken Sie unser umfassendes Angebot.</p>
    </div>
  </section>

  <!-- ===== CATEGORY NAVIGATION ===== -->
  <nav class="behandlung-nav" id="behandlung-nav" aria-label="Behandlungskategorien">
    <div class="behandlung-nav-inner">
      <?php foreach ($all_categories as $cat): ?>
        <a href="#<?php echo esc_attr($cat[1]); ?>" class="cat-pill"><?php echo esc_html($cat[0]); ?></a>
      <?php endforeach; ?>
    </div>
  </nav>

  <!-- ===== TREATMENT SECTIONS ===== -->
  <div class="container">
    <?php foreach ($all_categories as $cat):
      $cat_title = $cat[0];
      $cat_id    = $cat[1];
      $cat_sub   = $cat[2];
      $treatments = $cat[3];
    ?>
    <section class="treatment-category" id="<?php echo esc_attr($cat_id); ?>">
      <div class="cat-header reveal">
        <span class="subtitle"><?php echo esc_html($cat_title); ?></span>
        <h2><?php echo esc_html($cat_title); ?> <span class="cat-count">(<?php echo count($treatments); ?>)</span></h2>
        <hr class="golden-rule">
        <p><?php echo esc_html($cat_sub); ?></p>
      </div>
      <div class="treatment-grid">
        <?php foreach ($treatments as $tr):
          $name  = $tr[0];
          $price = $tr[1];
          $time  = $tr[2];
          $desc  = $tr[3];
          $flag  = isset($tr[4]) ? $tr[4] : '';
          $price_str = $price == 0 ? 'Kostenlos' : 'CHF ' . number_format($price, 0, '.', "'") . '.—';
        ?>
        <div class="t-item reveal">
          <div>
            <div class="t-name">
              <?php echo $name; ?>
              <?php if ($flag === 'neu'): ?><span class="t-badge neu">Neu</span><?php endif; ?>
              <?php if ($flag === 'lehrjahr'): ?><span class="t-badge lehrjahr">Lernende %</span><?php endif; ?>
              <?php if ($flag === 'kombi'): ?><span class="t-badge kombi">Kombi-Preis</span><?php endif; ?>
              <?php if ($flag === 'addon'): ?><span class="t-badge addon">Add-on</span><?php endif; ?>
              <?php if ($flag === 'spezial'): ?><span class="t-badge spezial">Spezial</span><?php endif; ?>
              <?php if ($flag === 'lernende'): ?><span class="t-badge lehrjahr">Bei Lernenden</span><?php endif; ?>
            </div>
            <?php if ($desc): ?><p class="t-desc"><?php echo $desc; ?></p><?php endif; ?>
            <div class="t-meta">
              <span class="t-duration">⏱ <?php echo esc_html($time); ?></span>
            </div>
          </div>
          <div class="t-right">
            <span class="t-price<?php echo $price == 0 ? ' free' : ''; ?>"><?php echo $price_str; ?></span>
            <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endforeach; ?>
  </div>

  <!-- ===== CTA BANNER ===== -->
  <section class="section section--dark" id="cta-banner">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Bereit für Ihre Behandlung?</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Vereinbaren Sie jetzt Ihren Termin</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Online buchen oder rufen Sie uns an — wir beraten Sie gerne persönlich zu Ihrer individuellen Behandlung.</p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Online buchen</a>
        <a href="tel:+41628226647" class="btn btn--outline btn--large" style="border-color: rgba(253,251,247,0.3); color: var(--text-white);">062 822 66 47</a>
      </div>
    </div>
  </section>

<script>
// Scroll-spy for category nav
(function(){
  const nav = document.getElementById('behandlung-nav');
  const pills = nav ? nav.querySelectorAll('.cat-pill') : [];
  const sections = document.querySelectorAll('.treatment-category');
  if (!nav || !sections.length) return;

  // Smooth scroll on pill click
  pills.forEach(function(pill) {
    pill.addEventListener('click', function(e) {
      e.preventDefault();
      const id = this.getAttribute('href').substring(1);
      const target = document.getElementById(id);
      if (target) {
        const navH = nav.offsetHeight;
        const headerH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 80;
        const y = target.getBoundingClientRect().top + window.pageYOffset - navH - headerH - 10;
        window.scrollTo({ top: y, behavior: 'smooth' });
      }
    });
  });

  // Active pill on scroll
  let ticking = false;
  function updateActive() {
    const navH = nav.offsetHeight;
    const headerH = 80;
    const offset = navH + headerH + 40;
    let current = '';
    sections.forEach(function(sec) {
      if (sec.getBoundingClientRect().top <= offset) current = sec.id;
    });
    pills.forEach(function(p) {
      p.classList.toggle('active', p.getAttribute('href') === '#' + current);
    });
    // Scroll active pill into view
    const active = nav.querySelector('.cat-pill.active');
    if (active) {
      const container = nav.querySelector('.behandlung-nav-inner');
      const left = active.offsetLeft - container.offsetWidth / 2 + active.offsetWidth / 2;
      container.scrollTo({ left: left, behavior: 'smooth' });
    }
    ticking = false;
  }
  window.addEventListener('scroll', function() {
    if (!ticking) { requestAnimationFrame(updateActive); ticking = true; }
  });
  updateActive();
})();
</script>

<?php get_footer(); ?>
