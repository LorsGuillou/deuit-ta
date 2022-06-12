// Gestion de la classe active

const links = document.getElementById("admin-menu").getElementsByTagName("a");
var url = location.href.split('/');
const lastElement = url[url.length - 1];

function activateLink(linkIndex) {
    links[linkIndex].classList.add("active");            
}

// Donner la classe active aux boutons en fonction de l'URL
for (i = 0; i < links.length; i++)  {
    if (lastElement.startsWith("user")) {
        activateLink(0);
    } else if (lastElement.startsWith("mail")) {
        activateLink(1);
    } else if (lastElement.startsWith("blog")) {
        activateLink(2);
    }
}