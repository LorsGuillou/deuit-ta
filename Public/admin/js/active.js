const links = document.getElementById("admin-menu").getElementsByTagName("a");

for (i = 0; i < links.length; i++)  {
    if (location.href === links[i].href) {
        links[i].classList.toggle("active");
    }
}