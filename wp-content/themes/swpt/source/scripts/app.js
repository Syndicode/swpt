import {initExamTimer} from "./modules/init-exam-timer.js";

(async () => {
  const {initAnimations} = await import('@scripts/modules/init-animations');
  const {initFancybox} = await import('@scripts/modules/init-fancybox');
  const {toggleAccordion} = await import('@scripts/modules/toggle-accordion');
  const {checkTest} = await import('@scripts/modules/check-test');
  const {authentication} = await import('@scripts/modules/authentication');
  const {resetProgress} = await import('@scripts/modules/reset-progress');
  const {toggleMobileNav} = await import('@scripts/modules/toggle-mobile-nav');
  const {initExamTimer} = await import('@scripts/modules/init-exam-timer');
  const {checkInternalExam} = await import('@scripts/modules/check-internal-exam');

  initAnimations();
  initFancybox();
  toggleAccordion();
  checkTest();
  authentication();
  resetProgress();
  toggleMobileNav();
  initExamTimer();
  checkInternalExam()
})();
