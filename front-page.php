<?php
/**
 * Template Name: Front Page
 * The homepage template for Charmelle Beauty Center.
 */
get_header();
$t = get_template_directory_uri();
?>

  <!-- ===== HERO SECTION ===== -->
  <section class="hero section" id="hero" style="position:relative;overflow:hidden;">
    <div class="hero-glow"></div>
    <div class="blob blob--gold blob--lg blob--float-1" style="top:60px;left:-100px;opacity:0.06;"></div>
    <div class="blob blob--cream blob--md blob--float-2" style="bottom:-60px;right:10%;opacity:0.07;"></div>
    <div class="container">
      <div class="split-section">
        <div class="hero-content">
          <span class="subtitle">Ihr Kosmetikstudio in Aarau — seit über 30 Jahren</span>
          <h1>Professionelle Kosmetik und <em class="text-italic">Hautpflege</em></h1>
          <p style="color:var(--text-light);font-size:1.05rem;line-height:1.75;margin-bottom:28px;">Das Charmelle Beauty Center vereint seit über 30 Jahren medizinische Hightech-Kosmetik mit ganzheitlicher Schönheitspflege. Hydra Facial, Microneedling, LPG Endermologie, Korean/Wimpernlifting und mehr — durchgeführt von diplomierten Kosmetikerinnen EFZ im Herzen von Aarau.</p>
          <div class="hero-buttons" style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--large" target="_blank" rel="noopener">Termin Buchen</a>
            <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>" class="btn btn--outline btn--large">Behandlungen entdecken</a>
          </div>
        </div>
        <div class="hero-visual">
          <div class="arch-img" style="max-width:380px;margin-left:auto;">
            <video autoplay muted loop playsinline preload="auto" poster="<?php echo esc_url( $t . '/images/hero-treatment-new.png' ); ?>" style="width:100%;height:100%;object-fit:cover;display:block;">
              <source src="<?php echo esc_url( $t . '/images/hero-video.mp4' ); ?>" type="video/mp4">
            </video>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ===== INTRO TEXT - SEO RICH ===== -->
  <section class="section" id="intro" style="padding-bottom: 0;">
    <div class="container container--narrow text-center reveal">
      <h2>Ihr Kosmetikstudio in Aarau für <em class="text-italic">anspruchsvolle Hautpflege</em></h2>
      <hr class="golden-rule golden-rule--center">
      <p style="font-size: 1.05rem; color: var(--text-light);">
        Das Charmelle Beauty Center am Girixweg 7 in Aarau ist seit über 30 Jahren die erste Adresse für professionelle Kosmetik und Hautpflege im Kanton Aargau. Ob Sie aus Aarau, Buchs, Suhr, Rohr, Küttigen, Erlinsbach, Gränichen, Oberentfelden, Unterentfelden, Schönenwerd oder Niedergösgen kommen - bei uns erwartet Sie ein Team von diplomierten Kosmetikerinnen EFZ, die sich mit Leidenschaft Ihrer Schönheit und Ihrem Wohlbefinden widmen.
      </p>
      <p style="font-size: 1.05rem; color: var(--text-light);">
        Unser umfassendes Angebot reicht von medizinischer Hightech-Kosmetik wie <strong>Hydra Facial Syndeo</strong>, <strong>Microneedling mit Hyaluron</strong> und <strong>LPG Endermologie</strong> über klassische Gesichtspflege und Anti-Aging-Behandlungen bis hin zu <strong>Korean/Wimpernlifting</strong>, <strong>Permanent Make-Up</strong>, <strong>Microblading</strong>, <strong>Stosswellenbehandlung</strong> und professioneller Hand- und Fusspflege. Wir arbeiten ausschliesslich mit hochwertigen Produkten von <strong>Med Beauty Swiss</strong>, <strong>Team Dr. Joseph</strong>, <strong>iS Clinical</strong> und <strong>Thalgo</strong> - Marken, die für Innovation, Wirksamkeit und Nachhaltigkeit stehen.
      </p>
    </div>
  </section>

  <!-- ===== CATEGORY TEASERS ===== -->
  <section class="section section--sand" id="kategorien" style="position:relative;overflow:hidden;">
    <div class="blob blob--cream blob--lg blob--float-2" style="top: -120px; right: -80px; opacity: 0.1;"></div>
    <div class="blob blob--gold blob--sm blob--float-3" style="bottom: 10%; left: -40px; opacity: 0.06;"></div>
    <div class="container" style="position:relative;z-index:1;">
      <div class="section-header reveal">
        <span class="subtitle">Unsere Welten</span>
        <h2>Entdecken Sie Ihre <em class="text-italic">Behandlung</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p>Drei Kompetenzbereiche, ein Ziel - Ihre strahlendste Version. Von medizinischer Hightech-Kosmetik über klassische Verwöhnpflege bis zu ausdrucksstarken Wimpern und Brauen.</p>
      </div>
      <div class="grid grid--3">
        <a href="<?php echo esc_url( home_url( '/behandlungen/#hightech' ) ); ?>" class="category-card reveal reveal-delay-1">
          <img src="<?php echo esc_url( $t . '/images/studio-real-3.jpg' ); ?>" alt="Medizinische Hightech-Behandlungen - Hydra Facial, Microneedling, LPG Endermologie in Aarau" width="529" height="705" loading="lazy">
          <div class="category-card-overlay">
            <span class="card-arrow">↗</span>
            <h3>Medizinische High-Tech</h3>
            <p>Hydra Facial · Microneedling · LPG · Laser</p>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/behandlungen/#klassisch' ) ); ?>" class="category-card reveal reveal-delay-2">
          <img src="<?php echo esc_url( $t . '/images/studio-real-1.jpg' ); ?>" alt="Klassische Gesichtspflege und Anti-Aging-Behandlungen im Beauty Center Aarau" width="529" height="705" loading="lazy">
          <div class="category-card-overlay">
            <span class="card-arrow">↗</span>
            <h3>Klassische Pflege</h3>
            <p>Verwöhnpflege · Anti-Aging · Regeneration</p>
          </div>
        </a>
        <a href="<?php echo esc_url( home_url( '/behandlungen/#ausdrucksstark' ) ); ?>" class="category-card reveal reveal-delay-3">
          <img src="<?php echo esc_url( $t . '/images/studio-real-4.jpg' ); ?>" alt="Wimpernlifting, Permanent Make-Up, Nägel im Kosmetikstudio Aarau" width="529" height="705" loading="lazy">
          <div class="category-card-overlay">
            <span class="card-arrow">↗</span>
            <h3>Ausdrucksstark</h3>
            <p>Korean/Wimpernlifting · Nägel · Permanent Make-Up</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== ABOUT / PHILOSOPHY STRIP ===== -->
  <section class="section" id="philosophie" style="position:relative;overflow:hidden;">
    <div class="blob blob--sand blob--md blob--float-1" style="top: -40px; left: -60px; opacity: 0.07;"></div>
    <div class="blob blob--gold blob--sm blob--float-2" style="bottom: -30px; right: 5%; opacity: 0.05;"></div>
    <div class="container" style="max-width: 900px; text-align: center; position:relative; z-index:1;">
      <div class="reveal">
        <img src="<?php echo esc_url( $t . '/images/logo.png' ); ?>" alt="Charmelle Beauty Center" style="height: 56px; margin: 0 auto 16px; display: block;">
        <h2>Mehr als ein Kosmetikstudio - <em class="text-italic">Ihre Beauty-Oase in Aarau</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p style="font-size: 1.05rem; color: var(--text-light); max-width: 720px; margin: 0 auto;">
          Was nicht in der Preisliste steht: Dass die massierenden Hände Sorgen und trübe Gedanken wegstreichen, dass in absoluter Entspannung Schlacken in Körper und Seele gelöst werden, dass man mit dem Rundum-Wohlbefinden Kraft, Zufriedenheit und Schönheit tanken kann.
        </p>
        <p style="font-size: 1.05rem; color: var(--text-light); max-width: 720px; margin: 16px auto 0;">
          Unser Kosmetiksortiment basiert auf einer klaren Philosophie: Wir verwenden natürliche und innovative Inhaltsstoffe, setzen auf die neuesten wissenschaftlichen Erkenntnisse und bieten Ihnen hochwertige, wirksame Hautpflege. Alle unsere Produkte werden ohne Tierversuche und ökologisch unbedenklich hergestellt.
        </p>
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 28px;">
          <a href="<?php echo esc_url( home_url( '/team/#philosophie' ) ); ?>" class="btn btn--outline">Unsere Philosophie</a>
          <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="btn btn--ghost">Unser Team kennenlernen</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== AKTION DES MONATS ===== -->
  <section class="section section--sand" id="aktion">
    <div class="container">
      <div class="split-section reveal">
        <div class="arch-img" style="aspect-ratio: 4/3;">
          <img src="<?php echo esc_url( $t . '/images/hydra-facial.png' ); ?>" alt="Plop Fenster Behandlung bei Charmelle Beauty Center Aarau" loading="lazy">
        </div>
        <div>
          <span class="subtitle">Aktion des Monats</span>
          <h2>Plop <em class="text-italic">Fenster</em></h2>
          <hr class="golden-rule">
          <p>Unsere exklusive Aktion dieses Monats: Das Plop Fenster - eine innovative Behandlung für sofort sichtbare Ergebnisse. Profitieren Sie jetzt von attraktiven Konditionen bei Charmelle in Aarau.</p>
          <p style="color: var(--text-light); font-size: 0.95rem;">Fragen Sie uns nach den aktuellen Details und Kombinationsmöglichkeiten. Unser Team berät Sie gerne persönlich.</p>
          <div class="treatment-meta" style="margin-bottom: 24px;">
            <span class="duration">⏱ Auf Anfrage</span>
            <span class="price">✦ Aktionspreis</span>
          </div>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary" target="_blank" rel="noopener">Jetzt buchen</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== STUDIO IMPRESSIONS ===== -->
  <section class="section" id="studio-preview" style="position:relative;overflow:hidden;">
    <div class="blob blob--cream blob--lg blob--float-3" style="top: 20%; right: -120px; opacity: 0.08;"></div>
    <div class="blob blob--gold blob--md blob--float-1" style="bottom: -80px; left: 10%; opacity: 0.06;"></div>
    <div class="container" style="position:relative;z-index:1;">
      <div class="section-header reveal">
        <span class="subtitle">Unser Beauty Center</span>
        <h2>Willkommen in unserem <em class="text-italic">Studio</em> in Aarau</h2>
        <hr class="golden-rule golden-rule--center">
        <p>Lichtdurchflutet, elegant und einladend - ein Ort am Girixweg 7 in Aarau, an dem Sie sich entspannen und in professionellen Händen aufgehoben fühlen können.</p>
      </div>
      <div class="studio-collage reveal">
        <div class="blob-img"><img src="<?php echo esc_url( $t . '/images/studio-real-4.jpg' ); ?>" alt="Behandlungsliege mit Handtüchern und Kerze im Charmelle Beauty Center Aarau" loading="lazy" width="529" height="705"></div>
        <div class="blob-img"><img src="<?php echo esc_url( $t . '/images/studio-real-3.jpg' ); ?>" alt="LPG Endermologie Gerät und Kunst im Charmelle Behandlungsraum" loading="lazy" width="529" height="705"></div>
        <div class="blob-img"><img src="<?php echo esc_url( $t . '/images/studio-real-2.jpg' ); ?>" alt="Handtücher und Deko im Charmelle Kosmetikstudio Aarau" loading="lazy" width="529" height="705"></div>
        <div class="blob-img"><img src="<?php echo esc_url( $t . '/images/studio-real-1.jpg' ); ?>" alt="Entspannende Atmosphäre im Kosmetikstudio Charmelle Aarau" loading="lazy" width="529" height="705"></div>
      </div>
    </div>
  </section>

  <!-- ===== TEAM PREVIEW ===== -->
  <section class="section section--sand" id="team-preview">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">Erfahrene Kosmetikerinnen EFZ</span>
        <h2>Lernen Sie unser <em class="text-italic">Team</em> kennen</h2>
        <hr class="golden-rule golden-rule--center">
        <p>Ein eingespieltes Team von diplomierten Kosmetikerinnen mit jahrelanger Erfahrung.</p>
      </div>
      <div class="grid grid--3">
        <div class="team-card reveal reveal-delay-1">
          <div class="arch-img"><img src="<?php echo esc_url( $t . '/images/aurora.jpg' ); ?>" alt="Aurora Mezzaucella - Kosmetikerin EFZ, Berufsbildnerin und Visagistin bei Charmelle Aarau" width="1030" height="704" loading="lazy"></div>
          <h3>Aurora Mezzaucella</h3>
          <p class="team-role">Inhaberin · Kosmetikerin EFZ · Berufsbildnerin · Visagistin</p>
          <div class="team-languages">
            <span class="lang-tag">🇮🇹 Italiano</span>
            <span class="lang-tag">🇩🇪 Deutsch</span>
          </div>
        </div>
        <div class="team-card reveal reveal-delay-2">
          <div class="arch-img"><img src="<?php echo esc_url( $t . '/images/oriana.jpg' ); ?>" alt="Oriana Raso - Kosmetikerin EFZ und Berufsbildnerin bei Charmelle Aarau" width="1030" height="704" loading="lazy"></div>
          <h3>Oriana Raso</h3>
          <p class="team-role">Inhaberin · Kosmetikerin EFZ · Berufsbildnerin · Visagistin</p>
          <div class="team-languages">
            <span class="lang-tag">🇮🇹 Italiano</span>
            <span class="lang-tag">🇩🇪 Deutsch</span>
          </div>
        </div>
        <div class="team-card reveal reveal-delay-3">
          <div class="arch-img"><img src="<?php echo esc_url( $t . '/images/giulia.jpg' ); ?>" alt="Giulia Arcerito - Kosmetikerin EFZ bei Charmelle Aarau" width="1030" height="754" loading="lazy"></div>
          <h3>Giulia Arcerito</h3>
          <p class="team-role">Kosmetikerin EFZ</p>
          <div class="team-languages">
            <span class="lang-tag">🇮🇹 Italiano</span>
            <span class="lang-tag">🇩🇪 Deutsch</span>
            <span class="lang-tag">🇬🇧 English</span>
          </div>
        </div>
      </div>
      <div class="text-center mt-lg reveal">
        <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="btn btn--outline">Das gesamte Team kennenlernen</a>
      </div>
    </div>
  </section>

  <!-- ===== WHY CHARMELLE - SEO RICH ===== -->
  <section class="section" id="warum-charmelle">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">Warum Charmelle?</span>
        <h2>Das beste Kosmetikstudio in <em class="text-italic">Aarau und Umgebung</em></h2>
        <hr class="golden-rule golden-rule--center">
      </div>
      <div class="grid grid--3 reveal">
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg></span>
          <h4>30+ Jahre Erfahrung</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Seit über 30 Jahren sind wir ein erfolgreiches und innovatives Beauty Center in Aarau. Diese Erfahrung fliesst in jede einzelne Behandlung ein.</p>
        </div>
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"/></svg></span>
          <h4>Medizinische Expertise</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Von Hydra Facial über Microneedling bis LPG Endermologie - wir kombinieren modernste Technologien mit fundiertem Fachwissen unserer EFZ-diplomierten Kosmetikerinnen.</p>
        </div>
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg></span>
          <h4>Im Einklang mit der Natur</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Wir verwenden ausschliesslich Produkte, die ohne Tierversuche und ökologisch unbedenklich hergestellt werden. Nachhaltigkeit und Wirksamkeit gehen bei uns Hand in Hand.</p>
        </div>
      </div>
      <div class="grid grid--3 reveal" style="margin-top: 8px;">
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></span>
          <h4>5.0 Sterne bei Google</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Über 44 Google-Bewertungen mit durchschnittlich 5.0 Sternen sprechen für sich. Unsere Kundinnen und Kunden schätzen unsere Professionalität und Hingabe.</p>
        </div>
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
          <h4>Mehrsprachig</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Unser Team spricht Deutsch, Italienisch und Englisch. So fühlen Sie sich in Ihrer Sprache verstanden und gut beraten - egal woher Sie kommen.</p>
        </div>
        <div style="text-align:center; padding:20px;">
          <span style="display:block; margin-bottom:12px;"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg></span>
          <h4>Zentral in Aarau</h4>
          <p style="color:var(--text-light); font-size:0.95rem;">Unser Studio am Girixweg 7 in Aarau ist bestens erreichbar aus dem gesamten Kanton Aargau. Parkplätze stehen vor dem Haus zur Verfügung.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TESTIMONIALS ===== -->
  <section class="section section--sand" id="bewertungen" style="position:relative;overflow:hidden;">
    <div class="blob blob--gold blob--md blob--float-2" style="top: -50px; left: -40px; opacity: 0.07;"></div>
    <div class="blob blob--cream blob--sm blob--float-1" style="bottom: 20%; right: -30px; opacity: 0.06;"></div>
    <div class="container container--narrow" style="position:relative;z-index:1;">
      <div class="section-header reveal">
        <span class="subtitle">Kundenstimmen aus Aarau und Umgebung</span>
        <h2>Was unsere Kundinnen <em class="text-italic">sagen</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p>Über 44 Google-Bewertungen mit 5.0 Sternen - das sagen unsere Kundinnen und Kunden über ihre Erfahrungen bei Charmelle.</p>
      </div>
      <div class="testimonial-carousel reveal">
        <div class="testimonial-track">
          <div class="testimonial-card">
            <div class="stars">★ ★ ★ ★ ★</div>
            <blockquote>«Wie immer Top, bin einfach super zufrieden. 🫶 Hier kommt man einfach zur Ruhe und entspannt wieder raus.»</blockquote>
            <p class="author">- Katju Te, Google Rezension</p>
          </div>
          <div class="testimonial-card">
            <div class="stars">★ ★ ★ ★ ★</div>
            <blockquote>«Ich hatte das Vergnügen von Aurora eine wunderbare Gesichtsbehandlung zu geniessen und bin mehr als zufrieden. Sehr Professionell. 100% wieder!»</blockquote>
            <p class="author">- Wilton de Souza, Google Rezension</p>
          </div>
          <div class="testimonial-card">
            <div class="stars">★ ★ ★ ★ ★</div>
            <blockquote>«Super Beratung, Hygiene kann ich mir nicht besser vorstellen. War ein einzigartiges Erlebnis.»</blockquote>
            <p class="author">- EIVU 11, Google Rezension</p>
          </div>
          <div class="testimonial-card">
            <div class="stars">★ ★ ★ ★ ★</div>
            <blockquote>«Ich habs geliebt! Ich hatte noch nie eine sooooo gute Behandlung und habe mich auch noch nie so wohl gefühlt wie hier.»</blockquote>
            <p class="author">- Paulina Zapf, Google Rezension</p>
          </div>
          <div class="testimonial-card">
            <div class="stars">★ ★ ★ ★ ★</div>
            <blockquote>«Excellent service. I had my brows, my eyelashes and a facial done. Very professional and charming. I recommend this Beauty center 100%.»</blockquote>
            <p class="author">- Doralma De Lión Durán, Google Rezension</p>
          </div>
        </div>
        <div class="carousel-dots">
          <button class="carousel-dot active" aria-label="Rezension 1"></button>
          <button class="carousel-dot" aria-label="Rezension 2"></button>
          <button class="carousel-dot" aria-label="Rezension 3"></button>
          <button class="carousel-dot" aria-label="Rezension 4"></button>
          <button class="carousel-dot" aria-label="Rezension 5"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== STATS COUNTER BAR ===== -->
  <section class="stats-bar" id="stats">
    <div class="container">
      <div class="stats-grid reveal">
        <div class="stat-item">
          <div class="stat-number" data-count="30" data-suffix="+">0+</div>
          <div class="stat-label">Jahre Erfahrung</div>
        </div>
        <div class="stat-item">
          <div class="stat-number" data-count="5.0" data-suffix="">0.0</div>
          <div class="stat-label">Google Bewertung</div>
        </div>
        <div class="stat-item">
          <div class="stat-number" data-count="5" data-suffix="">0</div>
          <div class="stat-label">Kosmetikerinnen</div>
        </div>
        <div class="stat-item">
          <div class="stat-number" data-count="20" data-suffix="+">0+</div>
          <div class="stat-label">Behandlungen</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== BEHANDLUNGEN SEO SUMMARY ===== -->
  <section class="section" id="behandlungen-overview">
    <div class="container container--narrow">
      <div class="reveal">
        <h2 class="text-center">Alle Kosmetik-Behandlungen <em class="text-italic">auf einen Blick</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p style="text-align:center; color:var(--text-light); margin-bottom: 32px;">
          Im Charmelle Beauty Center in Aarau bieten wir Ihnen ein umfassendes Spektrum an professionellen Kosmetik-Behandlungen. Jede Behandlung wird individuell auf Ihre Hautsituation abgestimmt.
        </p>
        <div class="grid grid--2" style="gap: 16px;">
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">Hydra Facial Syndeo</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Die Hollywood-Behandlung - Reinigung, Exfoliation, Extraktion &amp; Hydration in einem Schritt. Ab CHF 165.—</p>
          </div>
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">Microneedling mit Hyaluron</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Hauterneuerung und Straffung. Wirksam bei Falten, Narben und Pigmentflecken. Ab CHF 250.—</p>
          </div>
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">LPG Endermologie (Face und Body)</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Natürliche Kollagenstimulation und Body-Forming. Strafft die Haut ohne Nadeln. Ab CHF 100.—</p>
          </div>
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">Korean/Wimpernlifting und Extensions</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Der natürliche Wow-Effekt für Ihre Wimpern mit koreanischer Technik - mit oder ohne Extensions. Ab CHF 65.—</p>
          </div>
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">Permanent Make-Up und Microblading</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Perfekte Augenbrauen, Lippen oder Lidstriche - 24h am Tag. Ab CHF 350.—</p>
          </div>
          <div style="padding: 16px 20px; border-bottom: 1px solid var(--border-color);">
            <h4 style="margin-bottom:4px;font-size:1rem;">Haarentfernung (Laser, Wachs)</h4>
            <p style="color:var(--text-light);font-size:0.9rem;margin:0;">Langanhaltende Haarentfernung mit modernster Technologie. Auf Anfrage.</p>
          </div>
        </div>
        <div class="text-center" style="margin-top: 32px;">
          <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>" class="btn btn--primary">Alle Behandlungen &amp; Preise ansehen</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FEATURED PRODUCTS FROM WOOCOMMERCE ===== -->
  <?php if ( class_exists( 'WooCommerce' ) ) : ?>
  <section class="section section--sand" id="bestseller">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">Unser Shop</span>
        <h2>Bestseller direkt <em class="text-italic">zu Ihnen nach Hause</em></h2>
        <hr class="golden-rule golden-rule--center">
        <p>Hochwertige Pflegeprodukte von Med Beauty Swiss, Team Dr. Joseph und Thalgo - jetzt online bestellen.</p>
      </div>
      <div class="reveal">
        <?php echo do_shortcode( '[products limit="3" columns="3" orderby="popularity" order="DESC"]' ); ?>
      </div>
      <div class="text-center mt-lg reveal">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn--outline">Alle Produkte im Shop</a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== BRAND PARTNERS MARQUEE ===== -->
  <section class="brand-marquee" aria-label="Unsere Marken">
    <span class="subtitle">Wir arbeiten mit den Besten</span>
    <div class="brand-track">
      <span class="brand-item"><span class="brand-dot"></span>Med Beauty Swiss</span>
      <span class="brand-item"><span class="brand-dot"></span>Team Dr. Joseph</span>
      <span class="brand-item"><span class="brand-dot"></span>Thalgo</span>
      <span class="brand-item"><span class="brand-dot"></span>iS Clinical</span>
      <span class="brand-item"><span class="brand-dot"></span>LPG Endermologie</span>
      <span class="brand-item"><span class="brand-dot"></span>Dr. Niedermeier Regulatpro</span>
      <span class="brand-item"><span class="brand-dot"></span>Med Beauty Swiss</span>
      <span class="brand-item"><span class="brand-dot"></span>Team Dr. Joseph</span>
      <span class="brand-item"><span class="brand-dot"></span>Thalgo</span>
      <span class="brand-item"><span class="brand-dot"></span>iS Clinical</span>
      <span class="brand-item"><span class="brand-dot"></span>LPG Endermologie</span>
      <span class="brand-item"><span class="brand-dot"></span>Dr. Niedermeier Regulatpro</span>
    </div>
  </section>

  <!-- ===== NEWSLETTER ===== -->
  <section class="section section--dark" id="newsletter">
    <div class="container text-center">
      <div class="reveal">
        <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Beauty News</span>
        <h2 style="color: var(--text-white);">Nie wieder eine Aktion verpassen</h2>
        <p style="color: rgba(253,251,247,0.6); max-width: 480px; margin: 8px auto 28px;">
          Erhalten Sie exklusive Angebote, Beauty-Tipps und Neuigkeiten direkt in Ihre Inbox. Wir informieren Sie über saisonale Aktionen und neue Behandlungen in unserem Kosmetikstudio in Aarau.
        </p>
        <form class="newsletter-form" action="#" method="post" aria-label="Newsletter Anmeldung">
          <input type="email" placeholder="Ihre E-Mail-Adresse" required aria-label="E-Mail-Adresse" id="newsletter-email">
          <button type="submit" class="btn btn--primary">Anmelden</button>
        </form>
        <p style="font-size: 0.75rem; color: rgba(253,251,247,0.35); margin-top: 12px;">Wir respektieren Ihre Privatsphäre. Abmeldung jederzeit möglich.</p>
      </div>
    </div>
  </section>

  <!-- ===== AKTION DES MONATS LIGHTBOX ===== -->
  <div class="lightbox-overlay auto-popup" id="aktion-lightbox" role="dialog" aria-label="Aktion des Monats">
    <div class="lightbox-content">
      <button class="lightbox-close" aria-label="Schliessen">✕</button>
      <span class="subtitle">Aktion des Monats</span>
      <h3 style="margin-bottom: 12px;">Plop Fenster</h3>
      <hr class="golden-rule golden-rule--center">
      <p style="color: var(--text-light); margin-top: 16px;">Unsere exklusive Aktion dieses Monats: Das Plop Fenster - eine innovative Behandlung für sofort sichtbare Ergebnisse. Jetzt bei Charmelle in Aarau.</p>
      <p style="font-family: var(--font-heading); font-size: 1.4rem; color: var(--accent-gold); margin: 16px 0;">Aktionspreis</p>
      <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--large" target="_blank" rel="noopener" style="width: 100%;">Jetzt Termin buchen</a>
    </div>
  </div>

<?php get_footer(); ?>
