$(function () {
    sessionStorage.setItem('spreadsheetArray', JSON.stringify(spreadsheetArray));
    sessionStorage.setItem('responsiblePayersInfo', JSON.stringify(responsiblePayersInfo));
    sessionStorage.setItem('balancesModel', JSON.stringify(balancesModel));

    var jsSpreadsheetArray = [];
    $.each(spreadsheetArray, function (rowindex, row) {
        jsSpreadsheetArray[rowindex] = [];
        $.each(row, function (balanceindex, element) {
            jsSpreadsheetArray[rowindex][balanceindex] = element;
        });
    });
    console.log('twice', jsSpreadsheetArray);

    var payerTypeTd = $('.PayerTypeTd'),
        payerTd = $('.PayerTd'),
        nameTd = $('.NameTd'),
        active = $('.active');

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
});