// Gestion de la classe active de la navigation

const links = document.getElementById("nav-menu").getElementsByTagName("a");
var url = location.href.split('/');
const lastElement = url[url.length - 1];

// Retirer la classe active native du bouton Accueil
function activateLink(linkIndex) {
    links[0].classList.remove("active");
    links[linkIndex].classList.add("active");            
}

// Donner la classe active aux boutons en fonction de l'URL
for (i = 0; i < links.length; i++) {
    if (lastElement.startsWith("about")) {
        activateLink(1);
    } else if (lastElement.startsWith("blog")) {
        activateLink(2);
    } else if (lastElement.startsWith("login") || lastElement.startsWith("contact")) {
        activateLink(3);
    } else if (lastElement.startsWith("register") || lastElement.startsWith("account")) {
        activateLink(4);
    }
}