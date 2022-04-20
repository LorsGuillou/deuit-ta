const links = document.getElementById("nav-menu").getElementsByTagName("a");

for (i = 0; i < links.length; i++)  {
    if (location.href === links[i].href) {
        links[0].classList.remove("active");
        links[i].classList.add("active");
    }
}