const links = document.getElementById("nav-menu").getElementsByTagName("a");
var url = location.href.split('/');
const lastElement = url[url.length - 1];

function activateLink(linkIndex) {
    links[0].classList.remove("active");
    links[linkIndex].classList.add("active");            
}

for (i = 0; i < links.length; i++) {
    if (lastElement.startsWith("about")) {
        activateLink(1);
    } else if (lastElement.startsWith("blog")) {
        activateLink(2);
    } else if (lastElement.startsWith("login")) {
        activateLink(3);
    } else if (lastElement.startsWith("register")) {
        activateLink(4);
    } else if (lastElement.startsWith("contact")) {
        activateLink(3);
    } else if (lastElement.startsWith("account")) {
        activateLink(4);
    }
}