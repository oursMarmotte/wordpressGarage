document.addEventListener('DOMContentLoaded', () => {
  // Tiny helper: add a class when scrolling
  const header = document.querySelector('header, .wp-block-template-part[area="header"]');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('is-scrolled', window.scrollY > 10);
    });
  }
});