(function () {
  'use strict';

  /* ---- Search ---- */
  var searchInput   = document.getElementById('docsSearch');
  var sidebarSearch = document.getElementById('sidebarSearch');
  var navGroups     = document.querySelectorAll('.docs-nav-group');
  var noResults     = document.querySelector('.search-no-results');

  function filterNav(query) {
    var q = query.trim().toLowerCase();
    var anyVisible = false;

    navGroups.forEach(function (group) {
      var links = group.querySelectorAll('ul li');
      var groupVisible = false;

      links.forEach(function (li) {
        var text = li.textContent.toLowerCase();
        if (!q || text.includes(q)) {
          li.classList.remove('search-hidden');
          groupVisible = true;
          anyVisible = true;
        } else {
          li.classList.add('search-hidden');
        }
      });

      if (!q || groupVisible) {
        group.classList.remove('search-hidden');
      } else {
        group.classList.add('search-hidden');
      }
    });

    if (noResults) {
      noResults.style.display = (!anyVisible && q) ? 'block' : 'none';
    }
  }

  function syncSearch(value, other) {
    filterNav(value);
    if (other && other.value !== value) other.value = value;
  }

  if (searchInput) {
    searchInput.addEventListener('input', function () { syncSearch(this.value, sidebarSearch); });
  }
  if (sidebarSearch) {
    sidebarSearch.addEventListener('input', function () { syncSearch(this.value, searchInput); });
  }

  /* ---- Active nav on scroll ---- */
  var sections  = document.querySelectorAll('.docs-section[id]');
  var navLinks  = document.querySelectorAll('.docs-nav-group ul li a');
  var NAV_H     = 70;

  function setActiveNav() {
    var currentId = '';
    sections.forEach(function (section) {
      if (section.getBoundingClientRect().top <= NAV_H + 10) {
        currentId = section.id;
      }
    });

    navLinks.forEach(function (link) {
      var isActive = link.getAttribute('href') === '#' + currentId;
      link.classList.toggle('active', isActive);

      if (isActive) {
        var sidebar = document.querySelector('.docs-sidebar');
        if (sidebar) {
          var lr = link.getBoundingClientRect();
          var sr = sidebar.getBoundingClientRect();
          if (lr.top < sr.top + 40 || lr.bottom > sr.bottom - 40) {
            link.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
          }
        }
      }
    });
  }

  window.addEventListener('scroll', setActiveNav, { passive: true });
  setActiveNav();

  /* ---- Copy code button ---- */
  document.querySelectorAll('pre').forEach(function (pre) {
    var btn = document.createElement('button');
    btn.className = 'copy-btn';
    btn.textContent = 'Copy';
    pre.appendChild(btn);

    btn.addEventListener('click', function () {
      var code = pre.querySelector('code') || pre;
      var text = code.innerText;
      navigator.clipboard.writeText(text).then(function () {
        btn.textContent = 'Copied!';
        btn.classList.add('copied');
        setTimeout(function () {
          btn.textContent = 'Copy';
          btn.classList.remove('copied');
        }, 2000);
      }).catch(function () {
        btn.textContent = 'Failed';
        setTimeout(function () { btn.textContent = 'Copy'; }, 2000);
      });
    });
  });

  /* ---- Mobile sidebar toggle ---- */
  var sidebarToggle = document.getElementById('sidebarToggle');
  var sidebar       = document.querySelector('.docs-sidebar');

  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.toggle('open');
    });

    sidebar.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.innerWidth < 992) sidebar.classList.remove('open');
      });
    });

    document.addEventListener('click', function (e) {
      if (
        window.innerWidth < 992 &&
        sidebar.classList.contains('open') &&
        !sidebar.contains(e.target) &&
        e.target !== sidebarToggle
      ) {
        sidebar.classList.remove('open');
      }
    });
  }

  /* ---- Back to top ---- */
  var backToTop = document.getElementById('backToTop');
  if (backToTop) {
    window.addEventListener('scroll', function () {
      backToTop.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
  }

})();
