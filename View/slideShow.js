
(function () {
  const AUTOPLAY_MS = 5000; 

  document.querySelectorAll('.slideshow-container').forEach(setupSlideshow);

  function setupSlideshow(container) {
    const slides = Array.from(container.querySelectorAll('.mySlides'));
    const dots = Array.from(container.querySelectorAll('.dot-container .dot'));
    if (!slides.length || !dots.length) return;

    let index = 0;
    let timerId = null;

    
    if (!container.hasAttribute('tabindex')) {
      container.setAttribute('tabindex', '0');
    }

    function show(i) {
      index = (i + slides.length) % slides.length;

      slides.forEach((s, k) => {
        s.style.display = k === index ? 'block' : 'none';
        s.setAttribute('aria-hidden', k === index ? 'false' : 'true');
      });

      dots.forEach((d, k) => {
        d.classList.toggle('active', k === index);
        d.setAttribute('aria-pressed', k === index ? 'true' : 'false');
      });
    }

    function next(n = 1) {
      show(index + n);
    }

    function startAutoplay() {
      if (AUTOPLAY_MS > 0) {
        stopAutoplay();
        timerId = setInterval(() => next(1), AUTOPLAY_MS);
      }
    }

    function stopAutoplay() {
      if (timerId) {
        clearInterval(timerId);
        timerId = null;
      }
    }

    
    dots.forEach((dot, k) => {
      dot.addEventListener('click', () => {
        stopAutoplay();
        show(k);
        startAutoplay();
      });
      dot.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          stopAutoplay();
          show(k);
          startAutoplay();
        }
      });
    });

    
    container.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowRight') {
        stopAutoplay(); next(1); startAutoplay();
      } else if (e.key === 'ArrowLeft') {
        stopAutoplay(); next(-1); startAutoplay();
      }
    });

    
    let startX = null;
    container.addEventListener('pointerdown', (e) => { startX = e.clientX; });
    container.addEventListener('pointerup', (e) => {
      if (startX == null) return;
      const dx = e.clientX - startX;
      startX = null;
      const THRESH = 40; 
      if (Math.abs(dx) > THRESH) {
        stopAutoplay();
        next(dx < 0 ? 1 : -1);
        startAutoplay();
      }
    });

    
    show(0);
    startAutoplay();
  }
})();
