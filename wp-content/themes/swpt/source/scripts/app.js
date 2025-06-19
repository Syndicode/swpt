(async () => {
  const {initAnimations} = await import('@scripts/modules/init-animations');
  const {initFancybox} = await import('@scripts/modules/init-fancybox');
  const {toggleAccordion} = await import('@scripts/modules/toggle-accordion');
  const {toggleMobileNav} = await import('@scripts/modules/toggle-mobile-nav');

  initAnimations();
  initFancybox();
  toggleAccordion();
  toggleMobileNav();
})();
