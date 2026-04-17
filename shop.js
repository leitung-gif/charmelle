/* ============================================================
   CHARMELLE BEAUTY — SHOP ENGINE
   Dynamic product loading, filtering, search, and Snipcart cart
   ============================================================ */

(function() {
  'use strict';

  const PRODUCTS_URL = '/data/products.json';
  let allProducts = [];
  let activeFilter = 'alle';
  let activeSearch = '';

  // --- DOM Elements ---
  const grid = document.getElementById('product-grid');
  const filterBtns = document.querySelectorAll('.shop-filter-btn');
  const searchInput = document.getElementById('shop-search');
  const resultCount = document.getElementById('result-count');
  const emptyState = document.getElementById('shop-empty');

  if (!grid) return;

  // --- Fetch Products ---
  async function loadProducts() {
    try {
      const res = await fetch(PRODUCTS_URL);
      if (!res.ok) throw new Error('Failed to load products');
      const data = await res.json();
      allProducts = data.products || data;
      // Sort by sortOrder, then featured first
      allProducts.sort((a, b) => {
        if (a.featured && !b.featured) return -1;
        if (!a.featured && b.featured) return 1;
        return (a.sortOrder || 100) - (b.sortOrder || 100);
      });
      renderProducts();
    } catch (err) {
      console.error('Shop: Could not load products', err);
      grid.innerHTML = '<p class="shop-error">Produkte konnten nicht geladen werden. Bitte versuchen Sie es später erneut.</p>';
    }
  }

  // --- Filter & Search ---
  function getFilteredProducts() {
    return allProducts.filter(p => {
      if (!p.inStock) return false;
      const matchesFilter = activeFilter === 'alle' || p.brand === activeFilter || p.category === activeFilter;
      const matchesSearch = !activeSearch || 
        p.name.toLowerCase().includes(activeSearch) ||
        p.brand.toLowerCase().includes(activeSearch) ||
        (p.description && p.description.toLowerCase().includes(activeSearch));
      return matchesFilter && matchesSearch;
    });
  }

  // --- Render Product Cards ---
  function renderProducts() {
    const filtered = getFilteredProducts();
    
    if (resultCount) {
      resultCount.textContent = `${filtered.length} Produkt${filtered.length !== 1 ? 'e' : ''}`;
    }

    if (filtered.length === 0) {
      grid.innerHTML = '';
      if (emptyState) emptyState.style.display = 'block';
      return;
    }
    if (emptyState) emptyState.style.display = 'none';

    grid.innerHTML = filtered.map(product => createProductCard(product)).join('');

    // Trigger reveal animations
    grid.querySelectorAll('.product-card').forEach((card, i) => {
      card.style.animationDelay = `${i * 0.06}s`;
    });
  }

  function createProductCard(p) {
    const brandSlug = p.brand.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-');
    const priceFormatted = `CHF ${p.price.toFixed(2).replace('.', '.—').replace('.—00', '.—')}`;
    const priceDisplay = p.price % 1 === 0 ? `CHF ${p.price.toFixed(0)}.—` : `CHF ${p.price.toFixed(2)}`;
    const hasImage = p.image && p.image.trim() !== '';

    return `
      <article class="product-card" data-brand="${p.brand}" data-category="${p.category}">
        <div class="product-card-image ${!hasImage ? 'product-card-image--placeholder' : ''}" data-brand="${brandSlug}">
          ${hasImage 
            ? `<img src="${p.image}" alt="${p.name} - ${p.brand}" loading="lazy" width="400" height="400">` 
            : `<div class="product-placeholder-icon">${getBrandIcon(p.brand)}</div>`
          }
          ${p.featured ? '<span class="product-badge">Bestseller</span>' : ''}
        </div>
        <div class="product-card-body">
          <span class="product-brand-tag">${p.brand}</span>
          <h3 class="product-name">${p.name}</h3>
          ${p.size ? `<span class="product-size">${p.size}</span>` : ''}
          <p class="product-desc">${p.shortDescription || ''}</p>
          <div class="product-card-footer">
            <span class="product-price">${priceDisplay}</span>
            <button 
              class="btn btn--primary btn--small snipcart-add-item"
              data-item-id="${p.id}"
              data-item-name="${p.name} (${p.brand})"
              data-item-price="${p.price}"
              data-item-url="/produkte.html"
              data-item-description="${p.shortDescription || p.description}"
              ${hasImage ? `data-item-image="${p.image}"` : ''}
            >
              In den Warenkorb
            </button>
          </div>
        </div>
      </article>
    `;
  }

  function getBrandIcon(brand) {
    const icons = {
      'Med Beauty Swiss': '✦',
      'Team Dr. Joseph': '🌿',
      'Thalgo': '🌊',
      'Dr. Niedermeier Regulatpro': '💎',
      'iS Clinical': '⚗'
    };
    return icons[brand] || '✦';
  }

  // --- Event Listeners ---
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeFilter = btn.dataset.filter;
      renderProducts();
    });
  });

  if (searchInput) {
    let debounceTimer;
    searchInput.addEventListener('input', (e) => {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        activeSearch = e.target.value.toLowerCase().trim();
        renderProducts();
      }, 250);
    });
  }

  // --- Cart Counter ---
  function updateCartCount() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount && window.Snipcart) {
      const count = window.Snipcart.store.getState().cart.items.count;
      cartCount.textContent = count;
      cartCount.style.display = count > 0 ? 'flex' : 'none';
    }
  }

  // Listen for Snipcart events
  document.addEventListener('snipcart.ready', () => {
    window.Snipcart.store.subscribe(updateCartCount);
    updateCartCount();
  });

  // --- Init ---
  loadProducts();

})();
