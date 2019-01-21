$(document).ready(function() {

    $(".hamburger-close").hide();
    $("nav#nav-dashboard ul li a").hide();
    $("a.hamburger-open").click(function() {
        $("nav#nav-dashboard").show();
        $("nav#nav-dashboard ul li a").animate({width: 'toggle'}, "slow");
        $(".hamburger-open").hide();
        $(".hamburger-close" ).show();
    });
    
    $("a.hamburger-close").click(function() {
        $("nav#nav-dashboard ul li a").animate({width: 'toggle'}, "slow");
        $(".hamburger-close").hide();
        $(".hamburger-open" ).show();
    });

});