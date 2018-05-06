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
        $("#" + orderType + "FormContainer").fadeOut();

        let data = {
            currency_id: $("#" + orderType + "Form " + "select[name='currency_id']").val(),
            amount: form.find("#amount").val(),
            wallet: $("input[name=wallet]").val(),
            bank_account: form.find("#bank_account1").val() + form.find("#bank_account2").val() + form.find("#bank_account3").val(),
            order_type_id: orderTypeId,
        };
        if (orderType === "sell") {
            data.wallet = $("#wallet").val();
        }
        if (orderType === "buy") {
            data.bank_account = $(".bank-slip-bank-account-number").text().replace(/[^0-9.]/g, "");;
        }
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
            $("#qrcode").empty();
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
    $("#" + orderType + "Button").fadeIn();
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
            if (response.message === 'success') {
                $(".bank-slip-amount span").text(response.order.amount);
                $(".bank-slip-message span").text(response.order.id);
                $(".bank-slip-payment-purpose span").text(response.order.id);
                $("#" + orderType + "PostSubmitView").fadeIn();
            }
            if (response.message === 'error') {
                $("#" + orderType + "Form .invalid-feedback").empty();
                $("#" + orderType + "FormContainer").fadeIn();
                var errors = response.errors;

                $.each(errors, function (key, val) {
                    $("." + orderType + "_" + key + "_error").text(val[0]);
                });
                }
        }
    );
}