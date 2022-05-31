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

if (eye) {
    eye.addEventListener("click", () => {
        const type = password.getAttribute("type") === "password" ? "text" : "password"; 
        password.setAttribute("type", type);
        eye.classList.toggle("fa-eye");
        eye.classList.toggle("fa-eye-slash");
    });
}

if (eyeConfirm) {
    eyeConfirm.addEventListener("click", () => {
        const typeConfirm = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
        confirmPassword.setAttribute("type", typeConfirm);
        eyeConfirm.classList.toggle("fa-eye");
        eyeConfirm.classList.toggle("fa-eye-slash");
    });
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