const initExamTimer = () => {
  const timerContainer = document.querySelector('#internal-exam-timer');
  if (timerContainer) {
    let isInit= false;
    let countDownDate = (timerContainer.dataset.timestamp * 1000) + 1800000;

// Update the count down every 1 second
    let timer = setInterval(function () {

      // Get today's date and time
      const now = new Date().getTime();

      // Find the distance between now and the count down date
      const distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);
      seconds = seconds <= 9 ? '0' + seconds : seconds;

      // Display the result in the element with id="demo"
      timerContainer.innerHTML = minutes + ":" + seconds;
      if (!isInit) {
        isInit = true;
        timerContainer.classList.add('questions__timer--active');
      }

      // If the count down is finished, write some text
      if (distance <= 0) {
        clearInterval(timer);
        timerContainer.innerHTML = '';
      }
    }, 1000);
  }
}

export {initExamTimer}
