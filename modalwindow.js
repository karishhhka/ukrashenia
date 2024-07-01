const openRegModal = document.getElementById('open-reg-modal');
const regModal = document.getElementById('reg-modal');
const openLoginModal = document.getElementById('open-login-modal');
const loginModal = document.getElementById('login-modal');
const closeLoginModal = document.getElementById('close-login-modal');
const closeMod = document.getElementById('close');
const closeModTwo = document.getElementById('closeTwo');
const openInreg = document.getElementById('open-inReg-modal');
document.getElementById('signIn').addEventListener('click', () => {
  regModal.style.display = 'none';
  loginModal.style.display = 'block';
});

closeMod.addEventListener('click',   () => {
    regModal.style.display = 'none';
  });

 closeModTwo.addEventListener('click',  () => {
    loginModal.style.display = 'none';
  });


openRegModal.addEventListener('click', () => {
  regModal.style.display = 'block';
});

openLoginModal.addEventListener('click', () => {
  loginModal.style.display = 'block';
  regModal.style.display = 'none';
});
openInreg.addEventListener('click', () => {
    regModal.style.display = 'block';
    loginModal.style.display = 'none';
  });
  


