//This file lays out the ajax calls for the site
const BASE_URI = "http://localhost/cms5/";

//viewPrices ajax calls
/*
$(document).ready(function () {
    $("input[name=prices_radio]:radio").change(function () {

        if ($(this).prop("checked", true)) {

            //parameters
            const value = $(this).val();

            //strings to display on banner
            const thousand = "$0 - $1000";
            const two_thousand = "$1000 - $2000";
            const five_thousand = "$2000 - $5000";
            const ten_thousand = "$5000 - $10000";

            $.ajax({
                type: 'get',
                url: 'viewByPrices.php',
                data: {
                    price: value
                },
                success: function() {
                   switch(value) {
                        case "0_to_1000":
                            $(".shopping_main_banner").html(thousand);
                            break;
                        case "1000_to_2000":
                            $(".shopping_main_banner").html(two_thousand);
                            break;
                        case "2000_to_5000":
                            $(".shopping_main_banner").html(five_thousand);
                            break;
                        case "5000_to_10000":
                            $(".shopping_main_banner").html(ten_thousand);
                            break;
                    }

                    $(".shopping_main_section").innerHTML = this.responseText;

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            })

        }
    })
});

 */


//Process form_add_to_cart form submit

$(document).ready(function() {

    $("#form_add_to_cart").submit(function(event) {

        //Stop the form from submitting normally and refreshing the page
        event.preventDefault();

        var $quantity = $('input[name=quantity]').val();
        //alert($quantity.valueOf());

        var $item_count_string = $("#item_count").text();
        //alert($item_count_string.valueOf());

        var $item_count = $item_count_string.match(/(\d+)/);
        //alert($item_count[0].valueOf());

        var $new_item_count = parseInt($item_count) + parseInt($quantity);

        if (isNaN($new_item_count)) {

            $new_item_count = $quantity;
            //alert("new count " + $new_item_count.valueOf());
        }

        $("#item_count").text($new_item_count + " item(s)");

        //get the form data
        var formData = {
            'art_id': $('input[name=art_id]').val(),
            'quantity': $('input[name=quantity]').val(),
            'validation_type' : 'ajax'
        };

        //TODO need to change this to POST requeset
        $.ajax({

            //process the form
            type: "GET",
            url: "include/ajax_add_to_cart.php",
            data: formData,
            dataType: "json",
            encode: true
        })
            //using the done callback
            .done(function (data) {

                //log data to console
                //console.log(data);

            });

    });

});

//Process add to wishlist click

$(document).ready(function() {

    $(".wishlist_form").on("click", function(event) {


        //Stop the form from submitting normally and refreshing the page
        event.preventDefault();

        //get the form data
        var formData = {
            'art_id': $('input[name=art_id]').val(),
            'quantity': $('input[name=quantity]').val(),
            'validation_type' : 'ajax'
        };

        $.ajax({

            //process the form
            type: "GET",
            url: "include/ajax_add_to_wishlist.php",
            data: formData,
            dataType: "json",
            encode: true
        })
            //using the done callback
            .done(function (data) {

                //log data to console
                console.log(data);

            });

    });

});