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

    // check which page were on and add the active class to related nav item
    if (window.location.href.indexOf("contact") >= 0) {
        $(".nav #nav-contact").addClass("nav-active");
    } else if (window.location.href.indexOf("about") >= 0) {
        $(".nav #nav-about").addClass("nav-active");
    } else if (window.location.href.indexOf("profile/cuisines") >= 0) {
        $(".nav #nav-cuisines").addClass("nav-active");
    } else if (window.location.href.indexOf("profile/saved_recipes") >= 0) {
        $(".nav #nav-saved-recipe").addClass("nav-active");
    } else {
        $(".nav #nav-home").addClass("nav-active");
    }

});