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
        $.get('index.php?controller=IndividualBalance&action=render&monthlyBalanceID=' + e.target.dataset.monthlyBalanceId, function (data) {
            //var facility = new app.classes.facility();
            app.views.individualBalance.render(JSON.parse(data));
        });
    });
});


var app = app || {};
app.views= app.views || {};
app.classes = app.classes || {};

app.views.individualBalance = function () {
    return {
        render: function(dataObject){
            app.classes.facility.setFacilityFields(dataObject);
            app.classes.facility.renderInWell();
        }
    };
} ();

app.classes.facility = function () {
    var body = $('body'),
        facilityName,
        address1,
        address2,
        city,
        state,
        zip,
        NPI,
        taxID;

     return{
         setFacilityFields:function(dataObject){
             this.facilityName=dataObject.facility_name;
             this.address1=dataObject.address_1;
             this.address2=dataObject.address_2;
             this.city=dataObject.city;
             this.state=dataObject.state;
             this.zip=dataObject.zip;
             this.NPI=dataObject.NPI;
             this.taxID=dataObject.tax_id;
         },
         renderInWell:function () {
            body.append(`
<div class='container'>
    <div class='row'>
        <div class='col-sm-4'>
            <div class ='well'>
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
           </div>
        </div>
    </div>
</div>
                `);
        }
     };

}() ;

