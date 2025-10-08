(function () {
  const btn = document.getElementById('userMenuBtn');
  const menu = document.getElementById('userMenu');

  const openMenu = () => {
    menu.classList.add('open');
    btn.setAttribute('aria-expanded','true');
  };
  const closeMenu = () => {
    menu.classList.remove('open');
    btn.setAttribute('aria-expanded','false');
  };

  // toggle on button click
  btn.addEventListener('click', (e) => {
    e.stopPropagation();               // don’t let it bubble to document
    menu.classList.contains('open') ? closeMenu() : openMenu();
  });

  // close when clicking anywhere else
  document.addEventListener('click', (e) => {
    if (!menu.classList.contains('open')) return;
    if (!menu.contains(e.target) && e.target !== btn) closeMenu();
  });

  // close on Esc
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });
})();
