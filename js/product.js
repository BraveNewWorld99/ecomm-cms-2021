$(document).on("click", ".quantity_down", function() {

    var oldValue = $(".single_product_quantity_input").val();

    // Don't allow decrementing below zero
    if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
    } else {
        newVal = 1;
    }

    $(".single_product_quantity_input").val(newVal);

});

$(document).on("click", ".quantity_up", function() {

    var oldValue = $(".single_product_quantity_input").val();

    var newVal = parseFloat(oldValue) + 1;

    $(".single_product_quantity_input").val(newVal);

});

//For viewShipInfo.php
$(document).ready(function(){
    $("#pull_ship_info").change(function() {
        if (this.checked) {
            var $ship_first_name = $("#hidden_ship_first_name").html();
            var $ship_last_name =  $("#hidden_ship_last_name").html();
            var $ship_address1 = $("#hidden_ship_address1").html();
            var $ship_address2 = $("#hidden_ship_address2").html();
            var $ship_city = $("#hidden_ship_city").html();
            var $ship_state = $("#hidden_ship_state").html();
            var $ship_country = $("#hidden_ship_country").html();
            var $ship_zip_code_post_code = $("#hidden_ship_zip_code_post_code").html();


            $("#ship_first_name").val($ship_first_name);
            $("#ship_last_name").val($ship_last_name);
            $("#ship_address1").val($ship_address1);
            $("#ship_address2").val($ship_address2);
            $("#ship_city").val($ship_city);
            $("#state_drop_down").val($ship_state);
            $("#ship_country").val($ship_country);
            $("#ship_zip_code_post_code").val($ship_zip_code_post_code);
        }
    });
});

//For viewBillInfo.php
$(document).ready(function(){
    $("#pull_bill_info").change(function() {
        if (this.checked) {
            var $bill_first_name = $("#hidden_bill_first_name").html();
            var $bill_last_name =  $("#hidden_bill_last_name").html();
            var $bill_address1 = $("#hidden_bill_address1").html();
            var $bill_address2 = $("#hidden_bill_address2").html();
            var $bill_city = $("#hidden_bill_city").html();
            var $bill_state = $("#hidden_bill_state").html();
            var $bill_country = $("#hidden_bill_country").html();
            var $bill_zip_code_post_code = $("#hidden_bill_zip_code_post_code").html();


            $("#bill_first_name").val($bill_first_name);
            $("#bill_last_name").val($bill_last_name);
            $("#bill_address1").val($bill_address1);
            $("#bill_address2").val($bill_address2);
            $("#bill_city").val($bill_city);
            $("#state_drop_down").val($bill_state);
            $("#bill_country").val($bill_country);
            $("#bill_zip_code_post_code").val($bill_zip_code_post_code);
        }
    });
});

$(document).ready(function(){
    $("#pull_ship_to_bill_info").change(function() {
        if (this.checked) {

            var $bill_first_name = $("#hidden_ship_first_name").html();
            var $bill_last_name =  $("#hidden_ship_last_name").html();
            var $bill_address1 = $("#hidden_ship_address1").html();
            var $bill_address2 = $("#hidden_ship_address2").html();
            var $bill_city = $("#hidden_ship_city").html();
            var $bill_state = $("#hidden_ship_state").html();
            var $bill_country = $("#hidden_ship_country").html();
            var $bill_zip_code_post_code = $("#hidden_ship_zip_code_post_code").html();


            $("#bill_first_name").val($bill_first_name);
            $("#bill_last_name").val($bill_last_name);
            $("#bill_address1").val($bill_address1);
            $("#bill_address2").val($bill_address2);
            $("#bill_city").val($bill_city);
            $("#state_drop_down").val($bill_state);
            $("#bill_country").val($bill_country);
            $("#bill_zip_code_post_code").val($bill_zip_code_post_code);
        }
    });
});

