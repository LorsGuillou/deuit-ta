const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", (e) => {
    e.preventDefault();
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
});