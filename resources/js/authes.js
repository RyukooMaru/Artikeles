function updateBackgroundByTime() {
  const body = document.querySelector('body');
  const cardBg = document.querySelector('.locardes');
  const root = document.documentElement;
  const hours = new Date().getHours();

  console.log(`Jam sekarang: ${hours}`);

  if (hours >= 6 && hours < 18) {
    body.style.background = "linear-gradient(#3D5688, #5373A1, #9DA3B7, #CBB6B0, #F9D69E, #F6BD73)";
    cardBg.style.setProperty('--gradient-colors', '#ff6700, #ff8100, #ffa700, #ff4d00');
    cardBg.style.setProperty('--oclr', '#ff6700');
    root.style.setProperty('--ftclr', 'black');
  } else {
    body.style.background = "linear-gradient(#1e2b58, #253569, #353283, #48459a, #614cbf)";
    cardBg.style.setProperty('--gradient-colors', '#dcdcdc, #8a7f8d, #e5e5e5, #91a3b0');
    cardBg.style.setProperty('--oclr', '#ffffff');
    root.style.setProperty('--ftclr', 'white');
  }
}

function clearFeedback() {
  const feedbacks = document.querySelectorAll('.feedback');
  feedbacks.forEach(feedback => {
    feedback.style.display = 'none';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  updateBackgroundByTime();

  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');

  const formToShow = document.body.getAttribute('data-show-form');

  if (formToShow === 'register') {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
  } else {
    registerForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
  }

  // Expose toggleForm to global scope
  window.toggleForm = function (formType) {
    clearFeedback();
    if (formType === 'register') {
      loginForm.classList.add('hidden');
      registerForm.classList.remove('hidden');
    } else {
      registerForm.classList.add('hidden');
      loginForm.classList.remove('hidden');
    }
  };
});

setInterval(updateBackgroundByTime, 60 * 60 * 1000);
