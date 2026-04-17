<?php
/**
 * Template Name: Kontakt
 * Page template for the Contact / Legal page.
 */
get_header();
?>

<style>
    .contact-main-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:60px;align-items:start}
    .contact-card{background:var(--bg-primary);border-radius:var(--border-radius-lg);padding:48px;box-shadow:var(--shadow-card)}
    .contact-card h2{margin-bottom:8px}
    .contact-card>p{color:var(--text-light);margin-bottom:32px}
    .contact-detail{display:flex;gap:16px;align-items:start;margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid var(--border-color)}
    .contact-detail:last-of-type{border-bottom:none;margin-bottom:28px}
    .contact-detail-icon{width:48px;height:48px;border-radius:50%;background:var(--accent-gold-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--accent-gold);font-size:1.2rem}
    .contact-detail-content h4{font-family:var(--font-body);font-size:0.82rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-light);margin-bottom:4px;font-weight:500}
    .contact-detail-content p,.contact-detail-content a{font-size:1.05rem;color:var(--text-heading);font-weight:400;margin-bottom:2px}
    .contact-detail-content a{text-decoration:none;transition:color var(--transition-fast)}
    .contact-detail-content a:hover{color:var(--accent-gold)}
    .contact-detail-content .hours-grid{display:grid;grid-template-columns:auto 1fr;gap:4px 16px;font-size:0.92rem}
    .hours-grid .day{color:var(--text-light)}
    .hours-grid .time{color:var(--text-heading);font-weight:400}
    .contact-cta-buttons{display:flex;gap:12px;flex-wrap:wrap}
    .contact-map{border-radius:var(--border-radius-lg);overflow:hidden;box-shadow:var(--shadow-card);height:100%;min-height:500px}
    .contact-map iframe{width:100%;height:100%;min-height:500px;border:none}
    .legal-section{scroll-margin-top:140px}
    .legal-section h3{margin-bottom:16px}
    .legal-section p{color:var(--text-light);font-size:0.95rem;max-width:800px}
    .legal-section+.legal-section{margin-top:48px;padding-top:48px;border-top:1px solid var(--border-color)}
    @media(max-width:900px){
      .contact-main-grid{grid-template-columns:1fr;gap:32px}
      .contact-map{min-height:350px}
      .contact-map iframe{min-height:350px}
    }
</style>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Wir freuen uns auf Sie</span>
      <h1>Kontakt und Anfahrt</h1>
      <p>Besuchen Sie uns in unserem Studio am Girixweg 7 in Aarau oder kontaktieren Sie uns per Telefon, WhatsApp oder E-Mail.</p>
    </div>
  </section>

  <!-- ===== CONTACT SECTION ===== -->
  <section class="section" id="kontakt-info">
    <div class="container">
      <div class="contact-main-grid reveal">

        <!-- Contact Card -->
        <div class="contact-card">
          <span class="subtitle">Charmelle Beauty Center</span>
          <h2>So erreichen Sie <em class="text-italic">uns</em></h2>
          <p>Wir sind für Sie da - persönlich, telefonisch oder digital.</p>

          <div class="contact-detail">
            <div class="contact-detail-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div class="contact-detail-content">
              <h4>Adresse</h4>
              <p class="mb-0">Charmelle Beauty Center GmbH</p>
              <p class="mb-0">Girixweg 7</p>
              <p>5000 Aarau</p>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-detail-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
            <div class="contact-detail-content">
              <h4>Telefon</h4>
              <a href="tel:+41628226647">062 822 66 47</a>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-detail-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div class="contact-detail-content">
              <h4>WhatsApp (Terminanfragen)</h4>
              <a href="https://wa.me/+41798286647" target="_blank" rel="noopener">079 828 66 47</a>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-detail-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></div>
            <div class="contact-detail-content">
              <h4>E-Mail</h4>
              <a href="mailto:info@charmelle.ch">info@charmelle.ch</a>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-detail-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
            <div class="contact-detail-content">
              <h4>Öffnungszeiten</h4>
              <div class="hours-grid">
                <span class="day">Montag &amp; Donnerstag</span><span class="time">09:00 - 19:00 Uhr</span>
                <span class="day">Dienstag</span><span class="time">09:00 - 18:30 Uhr</span>
                <span class="day">Mittwoch &amp; Freitag</span><span class="time">09:00 - 18:30 Uhr</span>
                <span class="day">Samstag</span><span class="time">08:30 - 14:00 Uhr</span>
                <span class="day">Sonntag</span><span class="time">Geschlossen</span>
              </div>
            </div>
          </div>

          <div class="contact-cta-buttons">
            <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary" target="_blank" rel="noopener">Online Termin buchen</a>
            <a href="https://wa.me/+41798286647" class="btn btn--outline" target="_blank" rel="noopener">WhatsApp</a>
          </div>
        </div>

        <!-- Map -->
        <div class="contact-map">
          <iframe src="https://maps.google.com/maps?q=Charmelle+Beauty+Center,+Girixweg+7,+5000+Aarau,+Schweiz&t=&z=16&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps - Charmelle Beauty Center, Girixweg 7, 5000 Aarau"></iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== INSTAGRAM TEASER ===== -->
  <section class="section section--sand" id="instagram">
    <div class="container text-center reveal">
      <span class="subtitle">Folgen Sie uns</span>
      <h2>Auf <em class="text-italic">Instagram</em></h2>
      <hr class="golden-rule golden-rule--center">
      <p style="color: var(--text-light); max-width: 500px; margin: 0 auto 28px;">Entdecken Sie unsere neuesten Behandlungen, Aktionen und einen Blick hinter die Kulissen von Charmelle.</p>
      <a href="https://www.instagram.com/beauty_charmelle/" class="btn btn--primary" target="_blank" rel="noopener">@beauty_charmelle folgen</a>
    </div>
  </section>

  <!-- ===== LEGAL / IMPRESSUM / DATENSCHUTZ ===== -->
  <section class="section" id="legal">
    <div class="container container--narrow">

      <div class="legal-section reveal" id="agb">
        <h3>Allgemeine Geschäftsbedingungen (AGB)</h3>
        <p><strong>Terminabsagen:</strong> Wir bitten um rechtzeitige Absage (mindestens 24 Stunden vor dem Termin). Bei kurzfristigen Absagen oder Nichterscheinen behalten wir uns vor, den vollen Behandlungspreis in Rechnung zu stellen.</p>
        <p><strong>Gutscheine:</strong> Gutscheine sind 5 Jahre ab Kaufdatum gültig und einlösbar für alle Behandlungen und Produkte im Charmelle Beauty Center. Barauszahlung ist ausgeschlossen.</p>
        <p><strong>Zahlungsmittel:</strong> Wir akzeptieren Bargeld, EC-Karte, Kreditkarte (Visa, Mastercard) und TWINT.</p>
        <p><strong>Haftung:</strong> Die Behandlungen werden nach bestem Wissen und Gewissen durchgeführt. Für individuelle Hautreaktionen kann keine Haftung übernommen werden.</p>
      </div>

      <div class="legal-section reveal" id="datenschutz">
        <h3>Datenschutzerklärung</h3>
        <p><strong>Verantwortlich:</strong> Charmelle Beauty Center GmbH, Girixweg 7, 5000 Aarau, Schweiz.</p>
        <p><strong>Datenerhebung:</strong> Wir erheben personenbezogene Daten nur im Rahmen der Terminbuchung, des Newsletter-Abonnements und der Gutscheinbestellung. Ihre Daten werden vertraulich behandelt und nicht an Dritte weitergegeben.</p>
        <p><strong>Cookies:</strong> Diese Website verwendet technisch notwendige Cookies. Analytische Cookies werden nur mit Ihrer Einwilligung eingesetzt.</p>
        <p><strong>Ihre Rechte:</strong> Sie haben das Recht auf Auskunft, Berichtigung und Löschung Ihrer personenbezogenen Daten. Kontaktieren Sie uns unter <a href="mailto:info@charmelle.ch">info@charmelle.ch</a>.</p>
        <p><strong>Anwendbares Recht:</strong> Es gilt das schweizerische Datenschutzgesetz (DSG).</p>
      </div>

      <div class="legal-section reveal" id="impressum">
        <h3>Impressum</h3>
        <p><strong>Firma:</strong> Charmelle Beauty Center GmbH</p>
        <p><strong>Adresse:</strong> Girixweg 7, 5000 Aarau, Schweiz</p>
        <p><strong>Telefon:</strong> <a href="tel:+41628226647">062 822 66 47</a></p>
        <p><strong>E-Mail:</strong> <a href="mailto:info@charmelle.ch">info@charmelle.ch</a></p>
        <p><strong>Website:</strong> <a href="https://www.charmelle.ch">www.charmelle.ch</a></p>
        <p><strong>Handelsregistereintrag:</strong> Eingetragen im Handelsregister des Kantons Aargau.</p>
        <p><strong>Webdesign:</strong> <a href="https://www.lorien.group/" target="_blank" rel="noopener">Lorien Group</a></p>
      </div>

    </div>
  </section>

<?php get_footer(); ?>
