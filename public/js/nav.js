function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    $('.content').addClass('blurredElement');
    $('.nav-long').addClass('blurredElement');
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    $('.content').removeClass('blurredElement');
    $('.nav-long').removeClass('blurredElement');
}

function toggleNav() {
    var navWidth = parseInt(document.getElementById("mySidenav").style.width);
    if(navWidth === 300) {
        closeNav();
    } else {
        openNav();
    }
}

// bootstro: http://clu3.github.io/bootstro.js/#
$(document).ready(function() {
    // $(bootstro.start('.nav-long')).click('demo');
    //alert("ok bootstrap");
    //bootstro.start(selector, options);
    // bootstro.start('.nav-long');
    $( "#demo" ).click(function() {
        bootstro.start('.bootstro');
        // bootstro.next()

    });

});


