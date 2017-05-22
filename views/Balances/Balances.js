$(function () {
    sessionStorage.setItem('balancesModel', JSON.stringify(balancesModel));

    var jsSpreadsheetArray = [];
    $.each(balancesModel.spreadsheetArray, function (rowindex, row) {
        jsSpreadsheetArray[rowindex] = [];
        $.each(row, function (balanceindex, element) {
            jsSpreadsheetArray[rowindex][balanceindex] = element;
        });
    });

    const payerTypeTd = $('.PayerTypeTd'),
        payerTd = $('.PayerTd'),
        nameTd = $('.NameTd'),
        active = $('.active'),
        balanceColumn = $('.balanceColumn'),
        spreadsheetView = $('.spreadsheetView'),
        groupedTab=$('#groupedTab'),
        individualTab=$('#individualTab'),
        individualView=$('#individualView'),
        originalSpreadsheetView=$('#originalSpreadsheetView');

    let diplaying = '';

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

    /*balanceColumn.click(function (e) {
        spreadsheetView.css('display', "none");
        //individualBalance = new app.models.IndividualBalance(e.target.dataset.monthlyBalanceId);
        var controller = new app.classes.controller('IndividualBalance', 'render', e.target.dataset.monthlyBalanceId);

    });*/

    groupedTab.click(function(){
        console.log(groupedTab.attr('class'));
       if(groupedTab.attr('class')=='active'){
           return;
       }else{
           groupedTab.attr('class','active');
           individualTab.attr('class','');
           individualView.css('display','none');
           originalSpreadsheetView.css('display','block');
           
       }
    });

    individualTab.click(function(){
        console.log(individualTab.attr('class'));
       if(individualTab.attr('class')=='active'){
           return;
       }else{
           individualTab.attr('class','active');
           groupedTab.attr('class','');
           individualView.css('display','block');
           originalSpreadsheetView.css('display','none');
       }
    });
});


var app = app || {};
app.views = app.views || {};
app.classes = app.classes || {};
app.models = app.models || {};

app.views.IndividualBalance = function () {
    var body = $('body');

    this.render = function render(dataObject) {
        let facility = new app.classes.Facility(dataObject);
        let patient = new app.classes.Patient(dataObject);
        let responsiblePayer = new app.classes.ResponsiblePayer(dataObject);
        let monthlyBalance = new app.classes.MonthlyBalance(dataObject);

        body.append(`
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-4'>`+
            facility.renderInWell() +
            patient.renderInWell() +
            `                   </div>
                                <div class='col-sm-8'>
                                    <div class='well'>
                                        <div class='row'>`+
            responsiblePayer.render() +
            monthlyBalance.render() +
`                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
       `);
    };
};

app.models.IndividualBalance = function IndividualBalance(controller, monthlyBalanceId) {

    (function loadMonthlyBalance(monthlyBalanceId) {
        var balance = app.cache.search('individualBalance', { monthlyBalanceId: monthlyBalanceId });
        if (balance) {
            loadCollectibles(balance.respnsible_payer_id);
            controller.actionRequest(balance);
        } else {
            $.get('index.php?controller=IndividualBalance&action=render&monthlyBalanceID=' + monthlyBalanceId, function (data) {
                balance = JSON.parse(data);
                loadCollectibles(balance.respnsible_payer_id);
                app.cache.addToCache('individualBalance', balance);
                controller.actionRequest(balance);
            });
        }
    })(monthlyBalanceId);

    function loadCollectibles(responsiblePayerId){

    }

};

app.classes.Facility = function (dataObject) {

    this.facilityId = dataObject.facility_id;
    this.facilityName = dataObject.facility_name;
    this.address1 = dataObject.address_1;
    this.address2 = dataObject.address_2;
    this.city = dataObject.city;
    this.state = dataObject.state;
    this.zip = dataObject.zip;
    this.NPI = dataObject.NPI;
    this.taxID = dataObject.tax_id;

    this.renderInWell = function renderInWell() {
        return `<div class ='well'>
                    <h3>`+ this.facilityName + '</h3>' +
            this.address1 + '<br>' +
            this.address2 + '<br>' +
            this.city + ' ' + this.state + ' ' + this.zip + '<br><br>' +
            `<div class='row'>
                        <div class='col-xs-6'>
                            NPI: <strong>`+ this.NPI + `</strong>
                        </div>
                        <div class='col-xs-6'>
                            Tax ID: <strong>`+ this.taxID + `</strong>
                        </div>
            </div>   
                </div>`;
    };

};

app.classes.Patient = function (dataObject) {
  
    this.firstName = dataObject.first_name;
    this.lastName = dataObject.last_name;
    this.middleName = dataObject.middle_name;
    this.DOB = dataObject.DOB;
    this.medicaidId = dataObject.medicaid_id;
    this.medicareId = dataObject.medicare_id;
    this.ssId = dataObject.ss_id;
    this.otherInsurer1=dataObject.other_insurer_1;
    this.otherInsurer1Id=dataObject.other_insurer_1_id;
    this.otherInsurer2=dataObject.other_insurer_2;
    this.otherInsurer2Id=dataObject.other_insurer_2_id;
    this.facilityPatientId= dataObject.facility_patient_id;
    this.patientId= dataObject.patient_id;
    console.log(this);

    this.renderInWell = function(){
        
        return `<div class ='well'>
                    <h3>` + this.firstName +' '+ this.middleName +' '+ this.lastName + ' ('+ this.facilityPatientId+')</h3>'+
                    `<div class='row'>
                        <div class='col-xs-6'>
                            DOB: <strong>`+ this.DOB + `</strong>
                        </div>
                        <div class='col-xs-6'>
                            SS#: <strong>`+ this.ssId + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Medicare: <strong>`+ this.medicareId + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Medicaid: <strong>`+ this.medicaidId + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Insurance1: <strong>`+ this.otherInsurer1 + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Policy#: <strong>`+ this.otherInsurer1Id + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Insurance2: <strong>`+ this.otherInsurer2 + `</strong>
                        </div>
                        <div class='col-xs-6 padding-right-0'>
                            Policy#: <strong>`+ this.otherInsurer2Id + `</strong>
                        </div>
                    </div> 
                </div>`;
                    
    };


};

app.classes.ResponsiblePayer= function(dataObject){

    this.payerType= dataObject.payer_type;
    this.payer = dataObject.payer;
    this.responsiblepayerId = dataObject.responsible_payer_id;

    this.render = function(){
        //return `<div class='row'>
        return `   <div class ='col-xs-4'>
                        <h4>`+this.payerType+`</h4>
                    </div>
                    <div class ='col-xs-4'>
                        <h4>`+this.payer+`</h4>
                    </div>`;
        //        </div>`;
    };

};

app.classes.MonthlyBalance = function(dataObject){

    const monthsArray=['Dec','Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov'];
    this.month = monthsArray[dataObject.month_from_2000%12];
    this.year = Math.floor(dataObject.month_from_2000/12);
    this.monthlyBalance= dataObject.monthly_balance;
    this.monthlyBalanceId= dataObject.monthly_balance_Id;

    this.render = function(){
        //return `<div class='row'>
        return `    <div class ='col-xs-2 padding-right-0'>
                        <h4>`+this.month+ ' 20' +this.year+`</h4>
                    </div>
                    <div class ='col-xs-1'>
                        <h4><strong>$`+this.monthlyBalance+`</strong></h4>
                    </div>`;
        //        </div>`;
    };
};

app.classes.controller = function (model, action, params) {
    this.model = new app.models[model](this, params);
    this.action = action;

    this.actionRequest = function (dataObject) {
        new app.views[model]()[this.action](dataObject);
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

