/* ============================================================
   CHARMELLE BEAUTY — BLOG ENGINE
   Dynamic blog loading from CMS data, filtering, and post view
   ============================================================ */

(function() {
  'use strict';

  const BLOG_URL = '/data/blog.json';
  let allPosts = [];
  let activeFilter = 'all';

  const grid = document.getElementById('blog-grid');
  const filterBtns = document.querySelectorAll('.blog-categories .filter-btn');
  const postView = document.getElementById('blog-post-view');

  if (!grid) return;

  // --- Fetch Blog Posts ---
  async function loadPosts() {
    try {
      const res = await fetch(BLOG_URL);
      if (!res.ok) throw new Error('Failed to load blog');
      const data = await res.json();
      allPosts = data.posts || data;
      // Sort by date, newest first
      allPosts.sort((a, b) => new Date(b.date) - new Date(a.date));
      
      // Check if URL has a post slug
      const hash = window.location.hash.replace('#', '');
      if (hash && hash !== 'blog-posts' && hash !== 'blog-newsletter') {
        const post = allPosts.find(p => p.slug === hash);
        if (post) {
          showPost(post);
          return;
        }
      }
      
      renderGrid();
    } catch (err) {
      console.error('Blog: Could not load posts', err);
      grid.innerHTML = '<p style="text-align:center;color:var(--text-light);padding:40px;">Blog-Beiträge konnten nicht geladen werden.</p>';
    }
  }

  // --- Format Date ---
  function formatDate(dateStr) {
    const months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 
                    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
    const d = new Date(dateStr);
    return `${d.getDate()}. ${months[d.getMonth()]} ${d.getFullYear()}`;
  }

  // --- Render Blog Grid ---
  function renderGrid() {
    if (postView) postView.style.display = 'none';
    grid.style.display = '';

    const filtered = activeFilter === 'all' 
      ? allPosts 
      : allPosts.filter(p => p.category === activeFilter);

    if (filtered.length === 0) {
      grid.innerHTML = '<p style="text-align:center;color:var(--text-light);padding:40px;grid-column:1/-1;">Keine Beiträge in dieser Kategorie.</p>';
      return;
    }

    grid.innerHTML = filtered.map((post, i) => `
      <article class="blog-card reveal${i % 3 === 1 ? ' reveal-delay-1' : i % 3 === 2 ? ' reveal-delay-2' : ''}" data-category="${post.category}">
        <a href="#${post.slug}" class="blog-card-link" data-slug="${post.slug}">
          <div class="blog-card-image">
            ${post.image ? `<img src="${post.image}" alt="${post.title}" loading="lazy">` : '<div style="aspect-ratio:3/4;background:var(--bg-section);"></div>'}
            <span class="blog-category-tag">${post.categoryLabel || post.category}</span>
          </div>
          <div class="blog-card-body">
            <p class="blog-date">${formatDate(post.date)}</p>
            <h3>${post.title}</h3>
            <p>${post.excerpt}</p>
            <span class="read-more">Weiterlesen</span>
          </div>
        </a>
      </article>
    `).join('');

    // Click handlers for post cards
    grid.querySelectorAll('.blog-card-link').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const slug = link.dataset.slug;
        const post = allPosts.find(p => p.slug === slug);
        if (post) {
          window.location.hash = slug;
          showPost(post);
        }
      });
    });
  }

  // --- Show Individual Post ---
  function showPost(post) {
    if (!postView) return;
    
    grid.style.display = 'none';
    postView.style.display = 'block';

    // Parse markdown to simple HTML
    const bodyHtml = simpleMarkdown(post.body);

    postView.innerHTML = `
      <article class="blog-post-full">
        <a href="#blog-posts" class="blog-back-link" id="blog-back">← Zurück zum Blog</a>
        <div class="blog-post-meta">
          <span class="blog-category-tag" style="position:static;">${post.categoryLabel || post.category}</span>
          <span class="blog-date">${formatDate(post.date)}</span>
          <span class="blog-author">von ${post.author || 'Charmelle Beauty Center'}</span>
        </div>
        <h1 class="blog-post-title">${post.title}</h1>
        ${post.image ? `<div class="blog-post-hero"><img src="${post.image}" alt="${post.title}"></div>` : ''}
        <div class="blog-post-body">${bodyHtml}</div>
        <div class="blog-post-cta">
          <hr class="golden-rule golden-rule--center">
          <p>Möchten Sie mehr erfahren? Unsere Kosmetikerinnen beraten Sie gerne persönlich.</p>
          <a href="https://charmelle.coboma.ch/booking" class="btn btn--primary" target="_blank" rel="noopener">Termin buchen</a>
        </div>
      </article>
    `;

    // Back button
    document.getElementById('blog-back').addEventListener('click', (e) => {
      e.preventDefault();
      window.location.hash = '';
      renderGrid();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // --- Simple Markdown Parser ---
  function simpleMarkdown(md) {
    if (!md) return '';
    return md
      .replace(/^### (.+)$/gm, '<h3>$1</h3>')
      .replace(/^## (.+)$/gm, '<h2>$1</h2>')
      .replace(/^\d+\. \*\*(.+?)\*\* — (.+)$/gm, '<li><strong>$1</strong> — $2</li>')
      .replace(/^\d+\. \*\*(.+?)\*\*(.*)$/gm, '<li><strong>$1</strong>$2</li>')
      .replace(/^- \*\*(.+?)\*\*(.*)$/gm, '<li><strong>$1</strong>$2</li>')
      .replace(/^- (.+)$/gm, '<li>$1</li>')
      .replace(/(<li>.*<\/li>\n?)+/gm, '<ul>$&</ul>')
      .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
      .replace(/\*(.+?)\*/g, '<em>$1</em>')
      .replace(/\[(.+?)\]\((.+?)\)/g, '<a href="$2" target="_blank" rel="noopener">$1</a>')
      .replace(/^(?!<[hulo]).+$/gm, (match) => match.trim() ? `<p>${match}</p>` : '')
      .replace(/<\/ul>\s*<ul>/g, '');
  }

  // --- Filter Buttons ---
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeFilter = btn.dataset.filter;
      renderGrid();
    });
  });

  // --- Hash Change (back/forward) ---
  window.addEventListener('hashchange', () => {
    const hash = window.location.hash.replace('#', '');
    if (!hash || hash === 'blog-posts' || hash === 'blog-newsletter') {
      renderGrid();
    } else {
      const post = allPosts.find(p => p.slug === hash);
      if (post) showPost(post);
    }
  });

  // --- Init ---
  loadPosts();

})();
