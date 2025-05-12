function validateForm() {
    let errors = [];
    const username = document.getElementById("username").value;
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // validate username
    if (username.trim().length === 0) {
        errors.push('Please enter a valid username');
    }

    // validate name
    if (name.trim().length === 0) {
        errors.push('Please enter your name');
    }

    // validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors.push('Please enter a valid email address');
    }

    // validate password
    if (password.length === 0) {
        errors.push('Please enter a password');
    } else if (password !== confirmPassword) {
        errors.push('Passwords do not match');
    }

    // display errors
    const errorList = document.getElementById("error-list");
    errorList.innerHTML = "";
    if (errors.length > 0) {
        for (const error of errors) {
            const li = document.createElement("li");
            li.textContent = error;
            errorList.appendChild(li);
        }
        return false;
    }

    return true;
}

function checkUsername() {
    const username = document.getElementById("username").value;
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            const errorList = document.getElementById("error-list");
            if (response.exists) {
                const li = document.createElement("li");
                li.textContent = "Username already exists";
                errorList.appendChild(li);
            }
        }
    };
    xhr.open("GET", "check_username.php?username=" + encodeURIComponent(username));
    xhr.send();
}
const passwordInput = document.getElementById('password');
const passwordStrengthIndicator = document.getElementById('password-strength');

passwordInput.addEventListener('input', updatePasswordStrength);

function updatePasswordStrength() {
const password = passwordInput.value;

let strength = 0;
if (password.match(/[a-z]/)) {
    strength += 1;
}
if (password.match(/[A-Z]/)) {
    strength += 1;
}
if (password.match(/[0-9]/)) {
    strength += 1;
}
if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)) {
    strength += 1;
}

switch (strength) {
    case 0:
    case 1:
        passwordStrengthIndicator.textContent = 'Weak';
        passwordStrengthIndicator.style.color = 'red';
        break;
    case 2:
        passwordStrengthIndicator.textContent = 'Fair';
        passwordStrengthIndicator.style.color = 'orange';
        break;
    case 3:
        passwordStrengthIndicator.textContent = 'Good';
        passwordStrengthIndicator.style.color = 'yellow';
        break;
    case 4:
        passwordStrengthIndicator.textContent = 'Strong';
        passwordStrengthIndicator.style.color = 'green';
        break;
    default:
        break;
}
}