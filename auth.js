document.addEventListener('DOMContentLoaded', () => {
    // --- SIGN UP LOGIC ---
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const uname = document.getElementById('uname').value.trim();
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const password = document.getElementById('password').value;

            let users = JSON.parse(localStorage.getItem('pitoysenpai_users')) || [];

            // Check kung may kaparehong username
            const existingUser = users.find(u => u.uname === uname);
            if (existingUser) {
                alert('Username is already taken. Please choose another.');
                return;
            }

            // I-save ang user
            users.push({ uname, fname, lname, password });
            localStorage.setItem('pitoysenpai_users', JSON.stringify(users));

            alert('Registration successful! Please login.');
            window.location.href = 'login.html';
        });
    }

    // --- LOGIN LOGIC ---
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const uname = document.getElementById('uname').value.trim();
            const password = document.getElementById('password').value;

            let users = JSON.parse(localStorage.getItem('pitoysenpai_users')) || [];

            // Hanapin ang user
            const user = users.find(u => u.uname === uname && u.password === password);

            if (user) {
                sessionStorage.setItem('current_user', JSON.stringify(user));
                window.location.href = 'index.html';
            } else {
                alert('Invalid username or password.');
            }
        });
    }
});