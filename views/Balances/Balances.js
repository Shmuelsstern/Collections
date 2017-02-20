$(function () {
    /*sessionStorage.setItem('spreadsheetArray', JSON.stringify(spreadsheetArray));
    sessionStorage.setItem('responsiblePayersInfo', JSON.stringify(responsiblePayersInfo));*/
    sessionStorage.setItem('balancesModel', JSON.stringify(balancesModel));

    var jsSpreadsheetArray = [];
    $.each(balancesModel.spreadsheetArray, function (rowindex, row) {
        jsSpreadsheetArray[rowindex] = [];
        $.each(row, function (balanceindex, element) {
            jsSpreadsheetArray[rowindex][balanceindex] = element;
        });
    });
    // console.log('twice', jsSpreadsheetArray);

    var payerTypeTd = $('.PayerTypeTd'),
        payerTd = $('.PayerTd'),
        nameTd = $('.NameTd'),
        active = $('.active'),
        balanceColumn = $('.balanceColumn'),
        spreadsheetView = $('.spreadsheetView');

    payerTypeTd.click(function (event) {
        $('tbody tr').css('display', 'none');
        $('.' + $(this).attr('class').split(' ')[1]).parent('tr').css('display', 'table-row');
    });

    payerTd.click(function (event) {
        $('tbody tr').css('display', 'none');
        $('.' + $(this).attr('class').split(' ')[1]).parent('tr').css('display', 'table-row');
    });

    active.click(function () {
        $('tbody tr').css('display', 'table-row');
    });

    balanceColumn.click(function (e) {
        spreadsheetView.css('display', "none");
        individualBalance = new app.models.IndividualBalance(e.target.dataset.monthlyBalanceId);
        // individualBalanceView = new app.views.IndividualBalance();
        // individualBalanceView.render(individualBalance.monthlyBalance);
    });
});


var app = app || {};
app.views = app.views || {};
app.classes = app.classes || {};
app.models = app.models || {};

app.views.IndividualBalance = function () {
    console.log('constructiong view');
    var body = $('body');

    this.render = function render(dataObject) {
        var facility = new app.classes.Facility(dataObject);
        body.append(`
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-4'>`+
            facility.renderInWell() +
            `</div>
                            </div>
                        </div>
       `);
    };

};

app.models.IndividualBalance = function IndividualBalance(monthlyBalanceId) {
    console.log('constructiong model');
    let controller = new app.classes.controller('IndividualBalance', 'render');
    //var monthlyBalance;

    function loadMonthlyBalance(monthlyBalanceId) {
        var balance = app.cache.search('individualBalance', { monthlyBalanceId: monthlyBalanceId });
        if (balance) {
            controller.actionRequest(balance);
        } else {
            $.get('index.php?controller=IndividualBalance&action=render&monthlyBalanceID=' + monthlyBalanceId, function (data) {
                balance = JSON.parse(data);
                console.log('parsed', balance);
                app.cache.addToCache('individualBalance', balance);
                controller.actionRequest(balance);
            });
        }
    }

    this.monthlyBalance = loadMonthlyBalance(monthlyBalanceId);

    this.getMonthlyBalance = () => {
        return monthlyBalance;
    };

};

app.classes.Facility = function (dataObject) {
    console.log('constructiong facility');

    this.setFacilityFields = function setFacilityFields(dataObject) {
        this.facilityName = dataObject.facility_name;
        this.address1 = dataObject.address_1;
        this.address2 = dataObject.address_2;
        this.city = dataObject.city;
        this.state = dataObject.state;
        this.zip = dataObject.zip;
        this.NPI = dataObject.NPI;
        this.taxID = dataObject.tax_id;
    };


    this.setFacilityFields(dataObject);

    this.renderInWell = function renderInWell() {
        return `<div class ='well'>
                    <h4>`+ this.facilityName + '</h4>' +
            this.address1 + '<br>' +
            this.address2 + '<br>' +
            this.city + ' ' + this.state + ' ' + this.zip + '<br><br>' +
            `<div class='row'>
                        <div class='col-xs-6'>
                            <strong>NPI: </strong>`+ this.NPI +
                        `</div>
                        <div class='col-xs-6'>
                            <strong>Tax ID: </strong>`+ this.taxID +
                        `</div>
                    </div>   
                </div>`;
    };

    function loadfacility(monthlyBalanceId) {

    }

};

app.classes.controller = function (model, action) {
    this.model = model;
    this.action = action;

    this.actionRequest = function (params) {
    new app.views[this.model]()[this.action](params);
    };
};

app.cache = function () {
    var localVariables = {};
    return {
        search: function (arrayToSearch, itemToFind) {
            if (localVariables[arrayToSearch] === undefined) {
                return null;
            }
            console.log('returning from array');
            return localVariables[arrayToSearch].find(function (item) {
                return item.monthlyBalanceId === itemToFind.monthlyBalanceId;
            });
        },
        addToCache: function (arrayToAddTo, itemToAdd) {
            if (!localVariables[arrayToAddTo]) {
                localVariables[arrayToAddTo] = [];
            }
            localVariables[arrayToAddTo].push(itemToAdd);
        }
    };
}();

