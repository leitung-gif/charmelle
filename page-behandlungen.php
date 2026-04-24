<?php
/**
 * Template Name: Behandlungen
 * Page template for the Treatments page.
 */
get_header();
?>

<style>
/* Page-specific inline styles are minimal — core treatment styles are in styles.css */
</style>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Charmelle Beauty Center</span>
      <h1>Unsere <em class="text-italic">Behandlungen</em></h1>
      <p>Von medizinischer Hightech-Kosmetik bis zur klassischen Verwöhnpflege - entdecken Sie unser umfassendes Angebot, sorgfältig abgestimmt auf jede Hautsituation.</p>
    </div>
  </section>

  <!-- ===== BEHANDLUNGEN CONTENT ===== -->
  <section class="section" id="behandlungen-content">
    <div class="container">

      <!-- Tab Navigation -->
      <div class="tab-nav reveal" data-tab-group="treatments" role="tablist">
        <button class="tab-btn active" data-tab="tab-hightech" role="tab" aria-selected="true">Medizinische High-Tech</button>
        <button class="tab-btn" data-tab="tab-klassisch" role="tab" aria-selected="false">Klassische Pflege</button>
        <button class="tab-btn" data-tab="tab-ausdrucksstark" role="tab" aria-selected="false">Ausdrucksstark</button>
      </div>

      <!-- ==========================================
           TAB 1: MEDIZINISCHE HIGH-TECH
           ========================================== -->
      <div class="tab-panel active" id="tab-hightech" data-tab-group="treatments" role="tabpanel">
        <div class="treatment-list">

          <!-- Hydra Facial Syndeo -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Hydra Facial Syndeo</h4>
              <p>Die Hollywood-Behandlung der Stars. Diese sanfte Abrasion mit hochaktiven Seren radiert Linien, Flecken und Unebenheiten sanft aus - für ein strahlendes und frisches Hautbild. Falten werden vorgebeugt und die Faltentiefe reduziert.</p>
              <div class="treatment-meta"><span class="duration">⏱ 60–120 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 165.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Microneedling -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Microneedling mit Hyaluron</h4>
              <p>Die Medical-Kosmetik-Behandlung zur Erneuerung und Straffung des Hautbilds. Wirksam bei Falten, Narben und Pigmentflecken. Mit reiner Hyaluronsäure für maximale Tiefenwirkung.</p>
              <div class="treatment-meta"><span class="duration">⏱ ca. 60 Min.</span></div>
              <span class="addon-badge">✦ Vergünstigte Abo-Preise verfügbar</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 250.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Microdermabrasion -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Microdermabrasion / Aquabrasion</h4>
              <p>Zwei Methoden für ein erneuertes Hautbild: Die Microdermabrasion verfeinert die Haut mechanisch mit feinen Kristallen, während die Aquabrasion zusätzlich mit Wasser und Wirkstoffen arbeitet - besonders schonend und ideal für empfindliche Haut.</p>
              <div class="treatment-meta"><span class="duration">⏱ 75–90 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 170.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Face Endermologie -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Face <span class="text-accent">Endermologie</span>® (LPG)</h4>
              <p>Die patentierte LPG-Technologie stimuliert die natürliche Kollagen- und Elastinproduktion. Für eine straffere, glattere und verjüngte Haut - ganz ohne Nadeln oder Injektionen.</p>
              <div class="treatment-meta"><span class="duration">⏱ 30–45 Min.</span></div>
              <span class="addon-badge">✦ 10+1 Abo verfügbar</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 100.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Skin Rejuvenation -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Skin Rejuvenation</h4>
              <p>Lichtbasierte Hautverjüngung für eine ebenmässige Haut. Reduziert effektiv Pigmentflecken, Rötungen und erweiterte Gefässe für einen gleichmässigen, strahlenden Teint.</p>
              <div class="treatment-meta"><span class="duration">⏱ 30–60 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 150.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Haarentfernung Laser -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Haarentfernung mit Laser</h4>
              <p>Effektive und langanhaltende Haarentfernung mit modernster Laser-Technologie. Für glatte Haut an Gesicht und Körper - schonend und präzise.</p>
              <div class="treatment-meta"><span class="duration">⏱ je nach Zone</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">auf Anfrage</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Kryolipolyse -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Kryolipolyse Body Forming</h4>
              <p>Gezielte Kältebehandlung zur nicht-invasiven Fettreduktion. Hartnäckige Fettpölsterchen werden durch kontrollierte Kühlung abgebaut - ohne OP, ohne Ausfallzeit.</p>
              <div class="treatment-meta"><span class="duration">⏱ 60–90 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 250.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Body Endermologie -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Body <span class="text-accent">Endermologie</span>® (LPG)</h4>
              <p>Natürliche Cellulite-Behandlung und Body-Forming mit der patentierten LPG-Technologie. Strafft die Haut, formt die Silhouette und verbessert die Hautqualität nachhaltig.</p>
              <div class="treatment-meta"><span class="duration">⏱ 35–45 Min.</span></div>
              <span class="addon-badge">✦ 10+1 Abo verfügbar</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 100.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <!-- Stosswellenbehandlung -->
          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4><span class="text-accent">Stosswellenbehandlung</span></h4>
              <p>Gezielte Stosswellentherapie zur Straffung und Regeneration des Gewebes. Wirksam bei Cellulite, Bindegewebsschwäche und zur Verbesserung der Hautstruktur. Die Stosswellen regen die Durchblutung und Kollagenneubildung an.</p>
              <div class="treatment-meta"><span class="duration">⏱ 30–45 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">auf Anfrage</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>
        </div>

        <!-- FAQ: High-Tech -->
        <div class="faq-section reveal" id="faq-hightech">
          <h3>Häufige Fragen - <em class="text-italic">High-Tech</em></h3>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist ein Hydra Facial und für wen ist es geeignet?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Das Hydra Facial ist eine sanfte, nicht-invasive Behandlung, die Reinigung, Exfoliation, Extraktion und Hydration in einem Schritt kombiniert. Es eignet sich für alle Hauttypen - von empfindlicher bis öliger Haut, von jugendlicher Haut bis zur reifen Haut. Bereits nach der ersten Behandlung sehen und fühlen Sie den Unterschied.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Ist Microneedling schmerzhaft?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Vor der Behandlung wird die Haut gründlich gereinigt und vorbereitet. Die meisten Kundinnen und Kunden vergleichen das Microneedling mit einem leichten Kribbeln auf der Haut. Nach der Behandlung kann die Haut leicht gerötet sein - vergleichbar mit einem leichten Sonnenbrand, der nach 24–48 Stunden abklingt.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Wie oft sollte ich ein Hydra Facial machen lassen?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Für optimale Ergebnisse empfehlen wir ein Hydra Facial alle 4–6 Wochen. Dies entspricht dem natürlichen Erneuerungszyklus der Haut. Für akute Hautprobleme kann anfangs ein kürzerer Rhythmus sinnvoll sein - wir beraten Sie gerne persönlich.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Gibt es Risiken bei der Kryolipolyse?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Die Kryolipolyse ist eine medizinisch erprobte und sichere Methode. Während der Behandlung können Sie ein Kältegefühl und leichtes Ziehen spüren. Nach der Behandlung kann die behandelte Zone leicht gerötet oder empfindlich sein - dies klingt in der Regel innerhalb weniger Stunden ab.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist LPG Endermologie?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Die LPG Endermologie ist eine patentierte, nicht-invasive Technologie aus Frankreich. Sie nutzt eine motorisierte Rollenmassage, die sanft und gezielt auf das Bindegewebe einwirkt. Für das Gesicht stimuliert sie die natürliche Kollagen- und Elastinproduktion. Für den Körper wirkt sie effektiv gegen Cellulite. Wir empfehlen mindestens 10 Sitzungen für optimale Langzeitergebnisse.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist Skin Rejuvenation?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Skin Rejuvenation ist eine lichtbasierte Hautverjüngung, die mit intensiv gepulstem Licht (IPL) arbeitet. Besonders wirksam bei Pigmentflecken, Rötungen, erweiterten Gefässen und einem unebenen Teint. Die Behandlung ist schonend und erfordert keine Ausfallzeit.</div></div></div>
        </div>
      </div>

      <!-- ==========================================
           TAB 2: KLASSISCHE PFLEGE
           ========================================== -->
      <div class="tab-panel" id="tab-klassisch" data-tab-group="treatments" role="tabpanel">
        <div class="treatment-list">

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Charmelle Verwöhnpflege</h4>
              <p>Die individuelle «Verwöhnmichpflege» nach Art des Hauses. Tiefenreinigung, Brauenkorrektur, Ausreinigung, Wirkstoffkonzentrat, Einschleusung, Nacken- und Décolleté-Massage, Pflegepackung - alles abgestimmt auf Ihre Haut.</p>
              <div class="treatment-meta"></div>
              <span class="addon-badge">Brauenkorrektur und kleines Tages-Make-Up inklusive · Wimpernfärben +20.— · Brauenfärben/Oberlippe wachsen +20.— · Alginat- oder Vliesmaske +20.—</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 155.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Best Ager Verwöhnpflege</h4>
              <p>Eine Wohltat für Haut und Seele. Sanfte Tiefenreinigung, gezielte Entkrustung, straffende Wirkstoffmassage, Gesichts- und Décolleté-Massage und abgestimmte Pflegemaske. Bringt Ihre Haut zum Strahlen.</p>
              <div class="treatment-meta"></div>
              <span class="addon-badge">Brauenkorrektur und kleines Tages-Make-Up inklusive · Wimpernfärben +20.— · Brauenfärben/Oberlippe wachsen +20.— · Alginat- oder Vliesmaske +20.—</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 169.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Aknebehandlungen</h4>
              <p>Gezielte Behandlungen für unreine Haut, Spätakne und Akne-Narben. Wir analysieren Ihre Hautsituation und erstellen einen individuellen Behandlungsplan mit bewährten medizinischen Wirkstoffen.</p>
              <div class="treatment-meta"></div>
              <span class="addon-badge">Hinweis: Bei Teenie- und Jugendbehandlungen ist die Brauenkorrektur nicht inklusive.</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 75.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>De Luxe Behandlung</h4>
              <p>Unsere exklusive Intensivbehandlung. Gründliche Reinigung, sanftes Peeling, hochwertige Wirkstoffe, Vlies- oder Alginat-Maske, Gesichts-, Décolleté- und Nackenmassage sowie Kopfmassage.</p>
              <div class="treatment-meta"><span class="duration">⏱ ca. 120 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 220.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Fire + Ice Behandlung</h4>
              <p>Diese Gesichtspflege ist neu im Sortiment. Hier wird mit den iS Clinical Produkten gearbeitet. Eine erfrischende und intensive Behandlung für sofort sichtbare Ergebnisse.</p>
              <div class="treatment-meta"><span class="duration">⏱ ca. 60 Min.</span></div>
              <span class="addon-badge">✦ Neu im Sortiment - iS Clinical</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 125.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>
        </div>

        <!-- FAQ: Klassische Pflege -->
        <div class="faq-section reveal" id="faq-klassisch">
          <h3>Häufige Fragen - <em class="text-italic">Klassische Pflege</em></h3>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist in der Charmelle Verwöhnpflege enthalten?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Die Verwöhnpflege umfasst Tiefenreinigung, Brauenkorrektur, professionelle Ausreinigung, individuelles Wirkstoffkonzentrat, Einschleusung, Nacken- und Décolleté-Massage, Pflegepackung und kleines Tages-Make-Up. Extras wie Wimpernfärben, Brauenfärben oder Oberlippe wachsen kosten jeweils +CHF 20.—.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Kann ich Add-ons zu meiner Behandlung hinzufügen?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Ja! Zu den meisten Gesichtsbehandlungen können Sie Extras hinzubuchen: Wimpernfärben (+CHF 20.—), Brauenfärben (+CHF 20.—), Oberlippe wachsen (+CHF 20.—), Haarentfernung Gesicht (ab CHF 20.—) oder eine Alginat- bzw. Vliesmaske (+CHF 20.—).</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was unterscheidet die Best Ager Pflege von der Verwöhnpflege?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Die Best Ager Pflege ist speziell auf die Bedürfnisse reifer Haut abgestimmt. Sie enthält straffende Wirkstoffmassagen, Gesichts- und Décolleté-Massage und hochaktive Anti-Aging-Wirkstoffe für frischere, strahlendere Haut mit spürbarem Straffungseffekt.</div></div></div>
        </div>
      </div>

      <!-- ==========================================
           TAB 3: AUSDRUCKSSTARK
           ========================================== -->
      <div class="tab-panel" id="tab-ausdrucksstark" data-tab-group="treatments" role="tabpanel">
        <div class="treatment-list">

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4><span class="text-accent">Korean/Wimpernlifting</span></h4>
              <p>Der natürliche Wow-Effekt mit koreanischer Technik. Ihre eigenen Wimpern werden dauerhaft geschwungen und wirken sofort voller und länger - ganz ohne Extensions. Die koreanische Methode sorgt für besonders natürliche, langanhaltende Ergebnisse. Optional mit Färbung.</p>
              <div class="treatment-meta"><span class="duration">⏱ ca. 60 Min.</span></div>
              <span class="addon-badge">+ Wimpern färben zusätzlich buchbar</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 65.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4><span class="text-accent">Wimpernverlängerung</span> (Extensions)</h4>
              <p>Professionelle Wimpernverlängerung für einen umwerfenden Blick. Einzelne Seiden- oder Kunsthaarwimpern werden an Ihre natürlichen Wimpern angebracht.</p>
              <div class="treatment-meta"><span class="duration">⏱ 90–120 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 180.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4><span class="text-accent">Permanent Make-Up</span></h4>
              <p>Perfekt betonte Augenbrauen, Lippen oder Lidstriche - 24 Stunden am Tag. Mit modernster Pigmentiertechnik in natürlichen Farbtönen.</p>
              <div class="treatment-meta"><span class="duration">⏱ 90–120 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 350.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4><span class="text-accent">Microblading</span></h4>
              <p>Die Kunst der perfekten Augenbraue. Feinste Härchen werden mit einer speziellen Handmethode in die Haut gezeichnet - hyperrealistisch und natürlich.</p>
              <div class="treatment-meta"><span class="duration">⏱ ca. 120 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 450.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Hand- und Fusspflege</h4>
              <p>Gepflegte Hände und Füsse. Manicure und Pedicure mit oder ohne Lack, Shellac oder Gel - professionell und in entspannender Atmosphäre.</p>
              <div class="treatment-meta"><span class="duration">⏱ 45–75 Min.</span></div>
              <span class="addon-badge">+ Shellac · Gel · Lack</span>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 55.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Brauen und Wimpern färben</h4>
              <p>Definierte Brauen und intensive Wimpern - für einen wachen, ausdrucksstarken Blick auch ohne Make-Up.</p>
              <div class="treatment-meta"><span class="duration">⏱ 15–30 Min.</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 20.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>

          <div class="treatment-item reveal">
            <div class="treatment-info">
              <h4>Haarentfernung (Wachs)</h4>
              <p>Sanfte Haarentfernung mit Warmwachs an Gesicht und Körper. Für seidig glatte Haut die wochenlang anhält.</p>
              <div class="treatment-meta"><span class="duration">⏱ je nach Zone</span></div>
            </div>
            <div class="treatment-action">
              <span class="treatment-price-large">ab CHF 15.—</span>
              <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--small" target="_blank" rel="noopener">Buchen</a>
            </div>
          </div>
        </div>

        <!-- FAQ: Ausdrucksstark -->
        <div class="faq-section reveal" id="faq-ausdrucksstark">
          <h3>Häufige Fragen - <em class="text-italic">Ausdrucksstark</em></h3>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was kostet ein Korean/Wimpernlifting bei Charmelle?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Ein Korean/Wimpernlifting kostet ab CHF 65.—. Die koreanische Technik sorgt für besonders natürliche, langanhaltende Ergebnisse. Optional können Ihre Wimpern zusätzlich gefärbt werden. Die Behandlung dauert ca. 60 Minuten und das Ergebnis hält 6–8 Wochen.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Wie lange hält Permanent Make-Up?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Permanent Make-Up hält in der Regel 2–5 Jahre, je nach Hauttyp, Sonnenexposition und Pflege. Für ein optimales Ergebnis empfehlen wir nach 4–6 Wochen einen Nachstich.</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist der Unterschied zwischen Korean/Wimpernlifting und Extensions?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Beim Korean/Wimpernlifting werden Ihre natürlichen Wimpern mit koreanischer Technik dauerhaft geschwungen (hält 6–8 Wochen). Extensions sind einzelne Kunsthaar-Wimpern für ein dramatischeres Ergebnis (Refill alle 2–3 Wochen).</div></div></div>
          <div class="faq-item"><button class="faq-question" aria-expanded="false"><span>Was ist der Unterschied zwischen Microblading und Permanent Make-Up?</span><span class="faq-icon">+</span></button><div class="faq-answer" role="region"><div class="faq-answer-inner">Microblading ist manuell (Klinge, hyper-natürlich, 1–2 Jahre). Permanent Make-Up ist maschinell (definierte Linien, 2–5 Jahre).</div></div></div>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== CTA BANNER ===== -->
  <section class="section section--dark" id="cta-banner">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Bereit für Ihre Behandlung?</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Vereinbaren Sie jetzt Ihren Termin</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Online buchen oder rufen Sie uns an - wir beraten Sie gerne persönlich zu Ihrer individuellen Behandlung.</p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Online buchen</a>
        <a href="tel:+41628226647" class="btn btn--outline btn--large" style="border-color: rgba(253,251,247,0.3); color: var(--text-white);">062 822 66 47</a>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
