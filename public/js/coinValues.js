$(document).ready(function () {
    getCurrenciesValues();
    setInterval(getCurrenciesValues, 60000);
});

function getCurrenciesValues() {
    $.get(
        '/getValues',
        function (data) {
            $('#bitcoinValue').text(data.bitcoin + "$");
            $('#ethereumValue').text(data.ethereum + "$");
            $('#litecoinValue').text(data.litecoin + "$");
            $('#rippleValue').text(data.ripple + "$");
        }
    )
}