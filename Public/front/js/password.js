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

// Voir / cacher le mot de passe et la confirmation

function togglePswdVisibility (toggle, input) {
    toggle.addEventListener("click", () => {
        let type = input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);
        toggle.classList.toggle("fa-eye");
        toggle.classList.toggle("fa-eye-slash");
    });
}

if (eye) {
    togglePswdVisibility(eye, password);
}

if (eyeConfirm) {
    togglePswdVisibility(eyeConfirm, confirmPassword);
}

// Construction du mot de passe

function pswdMsgGreen(lineName) {
    lineName.classList.remove("invalid");
    lineName.classList.add("valid");
}

function pswdMsgRed(lineName) {
    lineName.classList.remove("valid");
    lineName.classList.add("invalid");
}

if (password && confirmPassword && message && pswdLength && number && upper && lower) {
    password.addEventListener("focus", () => {
        message.style.display = "block";
    });

    password.addEventListener("blur", () => {
        message.style.display = "none";
    });

    password.addEventListener("keyup", () => {
        if (password.value.length >= 8) {
            pswdMsgGreen(pswdLength);
        } else {
            pswdMsgRed(pswdLength);
        }

        var numbers = /[0-9]/g;
        if(password.value.match(numbers)) {
            pswdMsgGreen(number);
        } else {
            pswdMsgRed(number);
        }

        var lowerLetters = /[a-z]/g;
        if (password.value.match(lowerLetters)) {
            pswdMsgGreen(lower);
        } else {
            pswdMsgRed(lower);
        }

        var upperLetters = /[A-Z]/g;
        if (password.value.match(upperLetters)) {
            pswdMsgGreen(upper);
        } else {
            pswdMsgRed(upper);
        }
    });
}