<?php
/**
 * Template Name: Team
 * Page template for the Team page.
 */
get_header();
$t = get_template_directory_uri();
?>

<style>
    .team-detail-card{display:grid;grid-template-columns:1fr 1.2fr;gap:48px;align-items:center;padding:60px 0;border-bottom:1px solid var(--border-color)}
    .team-detail-card:nth-child(even){direction:rtl}
    .team-detail-card:nth-child(even)>*{direction:ltr}
    .team-detail-card:last-child{border-bottom:none}
    .team-detail-image .arch-img{aspect-ratio:3/4;max-height:520px;box-shadow:var(--shadow-card)}
    .team-detail-info h3{font-size:1.8rem;margin-bottom:4px}
    .team-detail-info .team-role{color:var(--accent-gold);font-size:0.95rem;font-weight:400;margin-bottom:16px;display:block}
    .team-detail-info .team-qualifications-list{margin-bottom:20px}
    .team-detail-info .team-qualifications-list li{display:flex;align-items:center;gap:8px;padding:5px 0;font-size:0.92rem;color:var(--text-light)}
    .team-detail-info .team-qualifications-list li::before{content:'✦';color:var(--accent-gold);font-size:0.7rem;flex-shrink:0}
    .team-detail-info .team-languages{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px}
    .team-detail-info .team-bio{font-size:0.95rem;color:var(--text-light);line-height:1.7;margin-bottom:20px}
    .apprentice-badge{display:inline-flex;align-items:center;gap:6px;background:var(--accent-gold-light);color:var(--accent-gold);padding:6px 16px;border-radius:20px;font-size:0.82rem;font-weight:400;margin-bottom:16px}
    .studio-gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
    .studio-gallery .arch-img{aspect-ratio:3/4}
    .studio-gallery .arch-img:first-child{grid-column:span 2;grid-row:span 2;aspect-ratio:auto}
    @media(max-width:900px){
      .team-detail-card{grid-template-columns:1fr;gap:28px;padding:40px 0}
      .team-detail-card:nth-child(even){direction:ltr}
      .team-detail-image .arch-img{max-width:340px;margin:0 auto}
      .studio-gallery{grid-template-columns:repeat(2,1fr)}
      .studio-gallery .arch-img:first-child{grid-column:span 2;grid-row:span 1;aspect-ratio:16/9}
    }
</style>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Die Menschen hinter der Schönheit</span>
      <h1>Unser <em class="text-italic">Team</em></h1>
      <p>Erfahrene Kosmetikerinnen mit Leidenschaft, Fachwissen und dem Wunsch, Ihre natürliche Schönheit zum Strahlen zu bringen.</p>
    </div>
  </section>

  <!-- ===== PHILOSOPHY ===== -->
  <section class="section" id="philosophie">
    <div class="container container--narrow text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2.2rem; display: block; margin-bottom: 12px; color: var(--accent-gold);">Willkommen</span>
      <h2>bei der Charmelle-<em class="text-italic">Familie</em></h2>
      <hr class="golden-rule golden-rule--center">
      <p style="color: var(--text-light); font-size: 1.05rem; max-width: 680px; margin: 0 auto;">Wir sind ein Team von erfahrenen Kosmetikerinnen, die sich der Schönheit und dem Wohlbefinden unserer Kundinnen und Kunden verschrieben haben. Unsere Philosophie basiert auf der Verwendung von natürlichen und innovativen Produkten sowie der Anwendung der neuesten wissenschaftlichen Erkenntnisse und Technologien. Wir laden Sie ein, uns kennenzulernen und Teil unserer Charmelle-Familie zu werden ♥</p>
    </div>
  </section>

  <!-- ===== TEAM MEMBERS ===== -->
  <section class="section section--sand" id="team-members">
    <div class="container">

      <!-- AURORA -->
      <div class="team-detail-card reveal">
        <div class="team-detail-image"><div class="arch-img"><img src="<?php echo esc_url($t.'/images/aurora.jpg'); ?>" alt="Aurora Mezzaucella - Kosmetikerin EFZ, Berufsbildnerin und Visagistin bei Charmelle Beauty Center Aarau" width="1030" height="704" loading="lazy"></div></div>
        <div class="team-detail-info">
          <h3>Aurora Mezzaucella</h3>
          <span class="team-role">Inhaberin · Kosmetikerin EFZ · Berufsbildnerin · Visagistin · PMU &amp; Microblading Artistin</span>
          <ul class="team-qualifications-list"><li>Kosmetikerin EFZ</li><li>Berufsbildnerin</li><li>Diplomierte Visagistin</li><li>PMU &amp; Microblading Artistin</li><li>Sachkundenachweis V-Nissg</li></ul>
          <div class="team-languages"><span class="lang-tag">🇮🇹 Italiano</span><span class="lang-tag">🇩🇪 Deutsch</span></div>
          <p class="team-bio">Aurora vereint jahrelange Erfahrung mit Leidenschaft für Hautpflege. Ihre Expertise umfasst Hydra Facial, Microblading, Microneedling, Permanent Make-Up, Wimpernextensions sowie Aknebehandlungen und Body-Forming.</p>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Termin bei Aurora buchen</a>
        </div>
      </div>

      <!-- ORIANA -->
      <div class="team-detail-card reveal">
        <div class="team-detail-image"><div class="arch-img"><img src="<?php echo esc_url($t.'/images/oriana.jpg'); ?>" alt="Oriana Raso - Kosmetikerin EFZ und Berufsbildnerin bei Charmelle Beauty Center Aarau" width="1030" height="704" loading="lazy"></div></div>
        <div class="team-detail-info">
          <h3>Oriana Raso</h3>
          <span class="team-role">Inhaberin · Kosmetikerin EFZ · Berufsbildnerin · Visagistin</span>
          <ul class="team-qualifications-list"><li>Kosmetikerin EFZ</li><li>Berufsbildnerin</li><li>Diplomierte Visagistin</li><li>Sachkundenachweis V-Nissg</li></ul>
          <div class="team-languages"><span class="lang-tag">🇮🇹 Italiano</span><span class="lang-tag">🇩🇪 Deutsch</span></div>
          <p class="team-bio">Oriana bringt umfassende Fachkompetenz in Body-Forming, Hydra Facial, Micro- und Aquabrasion sowie Microneedling und Aknebehandlungen mit. Ihre Behandlungen folgen der bewährten Charmelle Pflege-Philosophie.</p>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Termin bei Oriana buchen</a>
        </div>
      </div>

      <!-- GIULIA -->
      <div class="team-detail-card reveal">
        <div class="team-detail-image"><div class="arch-img"><img src="<?php echo esc_url($t.'/images/giulia.jpg'); ?>" alt="Giulia Arcerito - Kosmetikerin EFZ bei Charmelle Beauty Center Aarau" width="1030" height="754" loading="lazy"></div></div>
        <div class="team-detail-info">
          <h3>Giulia Arcerito</h3>
          <span class="team-role">Kosmetikerin EFZ</span>
          <ul class="team-qualifications-list"><li>Kosmetikerin EFZ</li><li>Sachkundenachweis V-Nissg</li></ul>
          <div class="team-languages"><span class="lang-tag">🇮🇹 Italiano</span><span class="lang-tag">🇩🇪 Deutsch</span><span class="lang-tag">🇬🇧 English</span></div>
          <p class="team-bio">Giulia ist Expertin für Gesichtspflegen, Hydra Facial, Microneedling und LPG Endermologie. Sie beherrscht Wimpernlifting sowie verschiedene Wachstechniken.</p>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Termin bei Giulia buchen</a>
        </div>
      </div>

      <!-- ELIF -->
      <div class="team-detail-card reveal">
        <div class="team-detail-image"><div class="arch-img"><img src="<?php echo esc_url($t.'/images/elif.jpg'); ?>" alt="Elif Tasdemir - Lernende Kosmetikerin im 2. Lehrjahr bei Charmelle Beauty Center Aarau" width="1442" height="1055" loading="lazy"></div></div>
        <div class="team-detail-info">
          <span class="apprentice-badge">✦ Lernende - 2. Lehrjahr</span>
          <h3>Elif Tasdemir</h3>
          <span class="team-role">Kosmetikerin in Ausbildung</span>
          <div class="team-languages"><span class="lang-tag">🇩🇪 Deutsch</span><span class="lang-tag">🇹🇷 Türkçe</span><span class="lang-tag">🇬🇧 English</span></div>
          <p class="team-bio">«Der Beruf der Kosmetikerin hat mich schon immer fasziniert, weil er weit mehr ist als nur die Anwendung von Pflegeprodukten.»</p>
          <ul class="team-qualifications-list"><li>Piccolo Behandlung</li><li>Starter Best Ager</li><li>Manicure mit/ohne Lack und Shellac</li><li>Pedicure mit/ohne Lack und Shellac</li><li>LPG Endermologie</li><li>Wimpern/Brauen färben und regulieren</li><li>Haarentfernung mit Warmwachs</li><li>Shellac</li></ul>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--outline btn--small" target="_blank" rel="noopener">Termin buchen</a>
        </div>
      </div>

      <!-- STELLA -->
      <div class="team-detail-card reveal">
        <div class="team-detail-image"><div class="arch-img"><img src="<?php echo esc_url($t.'/images/stella.jpg'); ?>" alt="Stella Giangreco - Lernende Kosmetikerin im 1. Lehrjahr bei Charmelle Beauty Center Aarau" width="1442" height="1055" loading="lazy"></div></div>
        <div class="team-detail-info">
          <span class="apprentice-badge">✦ Lernende - 1. Lehrjahr</span>
          <h3>Stella Giangreco</h3>
          <span class="team-role">Kosmetikerin in Ausbildung</span>
          <div class="team-languages"><span class="lang-tag">🇮🇹 Italiano</span><span class="lang-tag">🇩🇪 Deutsch</span><span class="lang-tag">🇬🇧 English</span><span class="lang-tag">🇫🇷 Français</span></div>
          <p class="team-bio">«Ich freue mich riesig, hier meine Ausbildung zu machen und jeden Tag Neues zu lernen.»</p>
          <ul class="team-qualifications-list"><li>Manicure mit/ohne Lack und Shellac</li><li>Pedicure mit/ohne Lack und Shellac</li><li>Haarentfernung mit Warmwachs</li><li>Shellac</li></ul>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--outline btn--small" target="_blank" rel="noopener">Termin buchen</a>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== STUDIO IMPRESSIONS ===== -->
  <section class="section" id="studio">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">Unsere Räumlichkeiten</span>
        <h2>Das Charmelle <em class="text-italic">Studio</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p>Lichtdurchflutet, elegant und einladend - ein Ort, an dem Sie sich entspannen und geniessen können.</p>
      </div>
      <div class="studio-gallery reveal">
        <div class="arch-img"><img src="<?php echo esc_url($t.'/images/studio-1.jpg'); ?>" alt="Charmelle Beauty Center Aarau - Behandlungsraum" loading="lazy" width="773" height="1030"></div>
        <div class="arch-img"><img src="<?php echo esc_url($t.'/images/studio-2.jpg'); ?>" alt="Kosmetikliege und Ambiente bei Charmelle" loading="lazy" width="773" height="1030"></div>
        <div class="arch-img"><img src="<?php echo esc_url($t.'/images/studio-3.jpg'); ?>" alt="Professionelle Geräte bei Charmelle Aarau" loading="lazy" width="773" height="1030"></div>
        <div class="arch-img"><img src="<?php echo esc_url($t.'/images/studio-4.jpg'); ?>" alt="Studio Einrichtung Charmelle Beauty Center" loading="lazy" width="1024" height="1024"></div>
        <div class="arch-img"><img src="<?php echo esc_url($t.'/images/studio-5.jpg'); ?>" alt="Empfang und Lounge im Charmelle Aarau" loading="lazy" width="773" height="1030"></div>
      </div>
    </div>
  </section>

  <!-- ===== UNSERE PHILOSOPHIE ===== -->
  <section class="philosophy-inline" id="unsere-philosophie">
    <div class="container">
      <div class="philosophy-grid reveal">
        <div class="arch-img" style="aspect-ratio: 3/4;"><img src="<?php echo esc_url($t.'/images/studio-4.jpg'); ?>" alt="Charmelle Beauty Center - Unsere Philosophie" loading="lazy" width="1024" height="1024"></div>
        <div class="philosophy-text">
          <span class="subtitle">Unsere Philosophie</span>
          <h2>Mehr als nur Kosmetik - <em class="text-italic">eine Lebensphilosophie</em></h2>
          <hr class="golden-rule">
          <p>Was nicht in der Preisliste steht: Dass die massierenden Hände Sorgen und trübe Gedanken wegstreichen, dass in absoluter Entspannung Schlacken in Körper und Seele gelöst werden, dass man mit dem Rundum-Wohlbefinden Kraft, Zufriedenheit und Schönheit tanken kann.</p>
          <p>Wir bei Charmelle betrachten Schönheit ganzheitlich. Körper, Geist und Seele bilden eine Einheit. Seit über 30 Jahren ist es unsere Mission, dass Sie sich bei uns nicht nur schöner, sondern auch wohler und gestärkter fühlen.</p>
          <p>Unser Kosmetiksortiment basiert auf einer klaren Philosophie: Wir verwenden natürliche und innovative Inhaltsstoffe und bieten Ihnen hochwertige, wirksame Hautpflege. Alle unsere Produkte werden ohne Tierversuche und ökologisch unbedenklich hergestellt.</p>
        </div>
      </div>
      <div class="values-row reveal">
        <div class="value-item">
          <span class="value-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg></span>
          <h4>Natürlichkeit</h4>
          <p>Wir setzen auf natürliche Inhaltsstoffe und Produkte ohne Tierversuche. Nachhaltigkeit ist für uns Überzeugung.</p>
        </div>
        <div class="value-item">
          <span class="value-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 L2 7 L12 12 L22 7 Z"/><path d="M2 17 L12 22 L22 17"/><path d="M2 12 L12 17 L22 12"/></svg></span>
          <h4>Expertise</h4>
          <p>Unser Team besteht aus diplomierten Kosmetikerinnen EFZ mit langjähriger Erfahrung und Weiterbildung.</p>
        </div>
        <div class="value-item">
          <span class="value-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></span>
          <h4>Persönlichkeit</h4>
          <p>Bei uns sind Sie keine Nummer. Jede Behandlung wird individuell auf Ihre Hautsituation abgestimmt.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== CTA ===== -->
  <section class="section section--dark" id="cta">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Wir freuen uns auf Sie</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Buchen Sie Ihren persönlichen Termin</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Wählen Sie Ihre bevorzugte Kosmetikerin und vereinbaren Sie einen Termin - online oder per Telefon.</p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Online buchen</a>
        <a href="tel:+41628226647" class="btn btn--outline btn--large" style="border-color: rgba(253,251,247,0.3); color: var(--text-white);">062 822 66 47</a>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
