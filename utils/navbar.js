(eventHandler=function () {
    "use strict";

    var facilityLink = $('.facilityLink'),
        sessionFacilityId = $("#sessionFacility"),
        agingListId;

    facilityLink.click(function (event) {
        if (sessionFacilityId.html() !== this) {
            var target = $(event.target);
            event.preventDefault();
            $.get('index.php?controller=Navbar&action=setSessionFacility&facility=' + target.html(), function (facility) {
                sessionFacilityId.html(facility);
                agingListId = $("#agingList");
                $.getJSON('index.php?controller=Navbar&action=setAgingList', function (agingList) {
                    agingListId.replaceWith(function () {
                        var replacement = '<ul id="agingList" class="dropdown-menu">';
                        agingList.forEach(function (aging) {
                            replacement += '<li><a href="index.php?controller=balances&action=originalSpreadsheet&agingID=' + aging.aging_id + '"><span class="agingLink">' + aging.aging_name + '</span></a></li>';
                        });
                        replacement += '</ul>';
                        console.log(replacement);
                        return replacement;

                    });
                });
            });
        }
    });

} ());