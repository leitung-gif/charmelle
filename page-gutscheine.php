<?php
/**
 * Template Name: Gutscheine
 * Page template for the Voucher page.
 */
get_header();
$t = get_template_directory_uri();
?>

<style>
    .voucher-hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center}
    .voucher-visual{position:relative;display:flex;align-items:center;justify-content:center}
    .voucher-blob-img{
      position:relative;
      width:100%;
      max-width:520px;
      aspect-ratio:4/5;
      border-radius:42% 58% 62% 38% / 45% 55% 45% 55%;
      overflow:hidden;
      box-shadow:0 24px 60px rgba(74,59,50,0.15);
      animation:blob-morph 14s ease-in-out infinite alternate;
      transition:transform 0.6s cubic-bezier(0.34,1.56,0.64,1);
    }
    .voucher-blob-img:hover{transform:translateY(-10px) scale(1.02)}
    .voucher-blob-img img{
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
      filter:sepia(0.35) saturate(0.6) brightness(1.08) contrast(0.92);
    }
    @keyframes blob-morph{
      0%{border-radius:42% 58% 62% 38% / 45% 55% 45% 55%}
      33%{border-radius:55% 45% 38% 62% / 52% 48% 58% 42%}
      66%{border-radius:48% 52% 55% 45% / 38% 62% 42% 58%}
      100%{border-radius:58% 42% 45% 55% / 55% 45% 52% 48%}
    }
    .voucher-visual .floating-badge{position:absolute;bottom:20px;right:0;background:var(--accent-gold);color:var(--text-white);width:110px;height:110px;border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:var(--shadow-card);z-index:2;transition:transform 0.4s ease}
    .voucher-visual:hover .floating-badge{transform:scale(1.1) rotate(5deg)}
    .floating-badge .badge-text{font-family:var(--font-body);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.1em;opacity:0.8}
    .floating-badge .badge-amount{font-family:var(--font-heading);font-size:1.5rem;font-weight:600;line-height:1.1}
    .voucher-form-section{background:var(--bg-primary);border-radius:var(--border-radius-lg);padding:40px;box-shadow:var(--shadow-card)}
    .voucher-form-section h3{margin-bottom:8px}
    .voucher-form-section>p{color:var(--text-light);margin-bottom:28px;font-size:0.95rem}
    .form-group{margin-bottom:20px}
    .form-group label{display:block;font-size:0.82rem;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-heading);margin-bottom:8px}
    .form-group input,.form-group select,.form-group textarea{width:100%;padding:14px 18px;font-family:var(--font-body);font-size:0.95rem;font-weight:400;color:var(--text-heading);background:var(--bg-section);border:1.5px solid var(--border-color);border-radius:var(--border-radius-sm);transition:border-color var(--transition-fast)}
    .form-group input:focus,.form-group select:focus,.form-group textarea:focus{outline:none;border-color:var(--accent-gold)}
    .form-group textarea{resize:vertical;min-height:80px}
    .form-group select{appearance:none;-webkit-appearance:none;cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%234A3B32' fill='none' stroke-width='1.5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 16px center}
    .price-display{text-align:center;padding:24px;background:var(--accent-gold-light);border-radius:var(--border-radius-md);margin-bottom:24px}
    .price-display .total-label{font-size:0.82rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-light);margin-bottom:4px}
    .price-display .total-amount{font-family:var(--font-heading);font-size:2.2rem;color:var(--accent-gold);font-weight:600}
    .gift-benefits{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:28px}
    .gift-benefit{text-align:center;padding:20px}
    .gift-benefit-icon{font-size:2rem;margin-bottom:12px;display:block}
    .gift-benefit h4{font-size:0.95rem;margin-bottom:6px}
    .gift-benefit p{font-size:0.85rem;color:var(--text-light);margin-bottom:0}
    @media(max-width:900px){
      .voucher-hero-grid{grid-template-columns:1fr;gap:32px}
      .voucher-visual{max-width:380px;margin:0 auto}
      .voucher-blob-img{max-width:100%}
      .gift-benefits{grid-template-columns:1fr;gap:16px}
    }
</style>

  <!-- ===== PAGE HERO ===== -->
  <section class="page-hero">
    <div class="container">
      <span class="subtitle">Das perfekte Geschenk</span>
      <h1>Schenken Sie <em class="text-italic">Schönheit</em></h1>
      <p>Ein Wertgutschein von Charmelle - das schönste Geschenk für besondere Menschen. Einlösbar für alle Behandlungen und Produkte.</p>
    </div>
  </section>

  <!-- ===== VOUCHER SECTION ===== -->
  <section class="section" id="gutschein">
    <div class="container">
      <div class="voucher-hero-grid reveal">
        <div class="voucher-visual">
          <div class="voucher-blob-img">
            <img src="<?php echo esc_url($t.'/images/gutschein.jpg'); ?>" alt="Charmelle Geschenkgutschein mit Trockenblume" loading="lazy" width="768" height="1024">
          </div>
          <div class="floating-badge">
            <span class="badge-text">ab</span>
            <span class="badge-amount">CHF 50</span>
          </div>
        </div>

        <div class="voucher-form-section">
          <span class="subtitle">Wertgutschein</span>
          <h3>Charmelle Geschenkgutschein</h3>
          <p>Wählen Sie den gewünschten Betrag. Der Gutschein ist für alle Behandlungen und Produkte einlösbar.</p>

          <div class="form-group">
            <label for="voucher-amount">Betrag wählen</label>
            <select id="voucher-amount" name="amount">
              <option value="50">CHF 50.—</option>
              <option value="100" selected>CHF 100.—</option>
              <option value="150">CHF 150.—</option>
              <option value="200">CHF 200.—</option>
              <option value="250">CHF 250.—</option>
              <option value="300">CHF 300.—</option>
              <option value="custom">Eigener Betrag</option>
            </select>
          </div>

          <div class="form-group" id="custom-amount-group" style="display: none;">
            <label for="custom-amount">Eigener Betrag (CHF)</label>
            <input type="number" id="custom-amount" name="custom_amount" min="20" max="1000" placeholder="z.B. 175">
          </div>

          <div class="form-group">
            <label for="recipient-name">Name der beschenkten Person *</label>
            <input type="text" id="recipient-name" name="recipient" placeholder="z.B. Maria Müller" required>
          </div>

          <div class="price-display">
            <p class="total-label mb-0">Gutscheinwert</p>
            <span class="total-amount" id="price-total">CHF 100.—</span>
          </div>

          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary btn--large" style="width: 100%;" target="_blank" rel="noopener" id="buy-voucher-btn">Gutschein kaufen</a>

          <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 12px; text-align: center;">Sie werden zu unserem sicheren Bestellformular weitergeleitet. Kauf auch direkt im Studio möglich.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== HOW IT WORKS ===== -->
  <section class="section section--sand" id="so-funktionierts">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">In 3 Schritten</span>
        <h2>So einfach <em class="text-italic">geht's</em></h2>
        <hr class="golden-rule golden-rule--center">
      </div>
      <div class="voucher-steps reveal">
        <div class="voucher-step">
          <div class="step-number">1</div>
          <h4>Wählen</h4>
          <p>Wählen Sie den gewünschten Betrag - von CHF 50.— bis zu einem individuellen Wunschbetrag.</p>
        </div>
        <div class="voucher-step">
          <div class="step-number">2</div>
          <h4>Bezahlen</h4>
          <p>Bezahlen Sie sicher online oder direkt im Studio. Wir bereiten Ihren Gutschein vor.</p>
        </div>
        <div class="voucher-step">
          <div class="step-number">3</div>
          <h4>Verschenken</h4>
          <p>Erhalten Sie den eleganten Gutschein - zum Abholen im Studio oder per Post zu Ihnen nach Hause.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== GIFT BENEFITS ===== -->
  <section class="section" id="vorteile">
    <div class="container">
      <div class="section-header reveal">
        <span class="subtitle">Warum ein Charmelle Gutschein?</span>
        <h2>Das schönste <em class="text-italic">Geschenk</em></h2>
        <hr class="golden-rule golden-rule--center">
      </div>
      <div class="gift-benefits reveal">
        <div class="gift-benefit">
          <span class="gift-benefit-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5C9 3 12 8 12 8"/><path d="M16.5 8a2.5 2.5 0 0 0 0-5C15 3 12 8 12 8"/></svg></span>
          <h4>Für jeden Anlass</h4>
          <p>Geburtstag, Weihnachten, Hochzeit, Muttertag oder einfach weil Sie jemanden glücklich machen wollen.</p>
        </div>
        <div class="gift-benefit">
          <span class="gift-benefit-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg></span>
          <h4>Freie Wahl</h4>
          <p>Die beschenkte Person wählt selbst aus unserem gesamten Angebot - Behandlungen und Produkte.</p>
        </div>
        <div class="gift-benefit">
          <span class="gift-benefit-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#B8956A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></span>
          <h4>Elegant verpackt</h4>
          <p>Jeder Gutschein wird in einer hochwertigen Geschenkhülle überreicht - persönlich oder per Post.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== CTA ===== -->
  <section class="section section--dark" id="cta">
    <div class="container text-center reveal">
      <span style="font-family: var(--font-heading); font-size: 2rem; display: block; margin-bottom: 8px; color: var(--accent-gold);">Lieber einen Termin?</span>
      <h2 style="color: var(--text-white); margin-bottom: 16px;">Buchen Sie direkt eine Behandlung</h2>
      <p style="color: rgba(253,251,247,0.6); max-width: 500px; margin: 0 auto 28px;">Natürlich können Sie auch direkt einen Termin für sich selbst buchen - online oder per Telefon.</p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="https://charmelle.coboma.ch/booking" class="btn btn--white btn--large" target="_blank" rel="noopener">Termin buchen</a>
        <a href="<?php echo esc_url(home_url('/behandlungen/')); ?>" class="btn btn--outline btn--large" style="border-color: rgba(253,251,247,0.3); color: var(--text-white);">Behandlungen ansehen</a>
      </div>
    </div>
  </section>

<script>
// Voucher price logic
(function() {
  const amountSelect = document.getElementById('voucher-amount');
  const customGroup = document.getElementById('custom-amount-group');
  const customInput = document.getElementById('custom-amount');
  const priceTotal = document.getElementById('price-total');

  function updatePrice() {
    const selectedValue = amountSelect.value;
    if (selectedValue === 'custom') {
      customGroup.style.display = 'block';
      const customVal = parseInt(customInput.value) || 0;
      priceTotal.textContent = customVal > 0 ? `CHF ${customVal}.—` : 'CHF -.—';
    } else {
      customGroup.style.display = 'none';
      priceTotal.textContent = `CHF ${selectedValue}.—`;
    }
  }

  if (amountSelect) {
    amountSelect.addEventListener('change', updatePrice);
    if (customInput) customInput.addEventListener('input', updatePrice);
  }
})();
</script>

<?php get_footer(); ?>
