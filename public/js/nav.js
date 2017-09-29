function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function toggleNav() {
    var navWidth = parseInt(document.getElementById("mySidenav").style.width);
    if(navWidth === 300) {
        closeNav();
    } else {
        openNav();
    }
}