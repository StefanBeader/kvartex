$(document).ready(function () {

    getWalletNumber($("#currency_id").val());

    $(".showForm").click(function () {
        showForm($(this));
    });

    $(".cancelOrderButton").click(function () {
        closeForm($(this));
    });

    $('#currency_id').change(function () {
        getWalletNumber($(this).val());
    });

    $(".submitOrderButton").click(function () {
        var orderType = $(this).data('type');
        var form = $("#" + orderType + "Form");
        var orderTypeId = orderType === 'buy' ? 1 : 2;
        form.hide();

        let data = {
            currency_id: $("#" + orderType + "Form " + "select[name='currency_id']").val(),
            amount: form.find("#amount").val(),
            wallet: form.find("#wallet").val(),
            bank_account: form.find("#bank_account").val(),
            order_type_id: orderTypeId,
        };
        submitOrder(data, orderType);
    });

    $(".closePostViewButton").click(function () {
        var orderType = $(this).data('type');
        console.log($('#' + orderType + 'Button'));
        $('#' + orderType + 'PostSubmitView').hide();
        $('#' + orderType + 'Button').fadeIn();
        $('#' + orderType + 'Background').fadeIn();
    });

});

function getWalletNumber(currency_id) {
    $.get('/getWalletForCurrency?currency_id=' + currency_id, function (response) {
        if (response.status) {
            $('#wallet').val(response.data);
            jQuery('#qrcode').qrcode(response.data);
        } else {
            alert("Desila se greska, molimo pokusajte ponovo");
            $('#sellButton').fadeIn();
        }
    });
}

function showForm(button) {
    var orderType = button.data('type');
    $("#" + orderType + "Button").hide();
    $("#" + orderType + "Background").hide();
    $("#" + orderType + "FormContainer").fadeIn();
}

function closeForm(button) {
    var orderType = button.data('type');

    $("#" + orderType + "FormContainer").hide();
    $(".showForm[data-type='" + orderType + "']").fadeIn();
    $("#" + orderType + "Background").fadeIn();
}

function submitOrder(data, orderType) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(
        '/submitOrder',
        data,
        function (response) {
            if (response === 'success') {
                $("#" + orderType + "PostSubmitView").fadeIn();
            }
        }
    );
}