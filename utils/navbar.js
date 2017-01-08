(function () {
    "use strict";

    var facilityLink = $('.facilityLink');

    facilityLink.click(function (event) {
        var target=$(event.target);
        console.log('licked');
        event.preventDefault();
        $.get('index.php?controller=Navbar&action=setSessionFacility&facility=' + target.html(),function(facility){
           $("#sessionFacility").html(facility);
        });
    });
} ());