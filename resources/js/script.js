const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

// Buttons inside auth page
registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

// Auto-detect URL param
const params = new URLSearchParams(window.location.search);
const action = params.get('action');

if(action === 'signup'){
    container.classList.add('active'); // show signup
} else {
    container.classList.remove('active'); // show signin
}
