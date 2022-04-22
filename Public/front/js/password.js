// Constantes

const password = document.getElementById("password");
const eye = document.getElementById("togglePswd");
const confirmPassword = document.getElementById("confirmPswd");
const eyeConfirm = document.getElementById("toggleConfirm");
const message = document.getElementById("pswdMessage");
const pswdLength = document.getElementById("pswdLength");
const number = document.getElementById("pswdNumber");
const upper = document.getElementById("pswdUpper");
const lower = document.getElementById("pswdLower");
const button = document.getElementById("submit-register");

// Voir / cacher le mot de passe et la confirmation

eye.addEventListener("click", () => {
    const type = password.getAttribute("type") === "password" ? "text" : "password"; 
    password.setAttribute("type", type);
    eye.classList.toggle("fa-eye");
    eye.classList.toggle("fa-eye-slash");
});

eyeConfirm.addEventListener("click", () => {
    const typeConfirm = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
    confirmPassword.setAttribute("type", typeConfirm);
    eyeConfirm.classList.toggle("fa-eye");
    eyeConfirm.classList.toggle("fa-eye-slash");
});

// Construction du mot de passe

password.addEventListener("focus", () => {
    message.style.display = "block";
});

password.addEventListener("blur", () => {
    message.style.display = "none";
});

password.addEventListener("keyup", () => {
    if (password.value.length >= 8) {
        pswdLength.classList.remove("invalid");
        pswdLength.classList.add("valid");
        checkmark
    } else {
        pswdLength.classList.remove("valid");
        pswdLength.classList.add("invalid");
    }

    var numbers = /[0-9]/g;
    if(password.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    var lowerLetters = /[a-z]/g;
    if (password.value.match(lowerLetters)) {
        lower.classList.remove("invalid");
        lower.classList.add("valid");
    } else {
        lower.classList.remove("valid");
        lower.classList.add("invalid");
    }

    var upperLetters = /[A-Z]/g;
    if (password.value.match(upperLetters)) {
        upper.classList.remove("invalid");
        upper.classList.add("valid");
    } else {
        upper.classList.remove("valid");
        upper.classList.add("invalid");
    }
});

// Confirmer le mot de passe

// button.addEventListener("click", (e) => {
//     var ogPass = password.value;
//     var passCheck = confirmPassword.value;

//     if (ogPass != passCheck) {
//         alert("Les mots de passes ne correspondent pas.");
//         e.preventDefault();
//         return false;
//     }
//     return true;
// });