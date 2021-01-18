// the function handles the validation for any form field
function validate(input_value, field_id) {


    // the data to be sent to the server through POST
    var formData = {
        'validation_type' : 'ajax',
        'input_value' : input_value,
        'field_id' : field_id
    }

    //TODO need to change this to POST request
    $.ajax({

        //process the form
        type: "GET",
        url: "include/front_validate.php",
        data: formData,
        dataType: "json",
        encode: true
    })
        //using the done callback
        .done(function (response) {


            var result = response.result;
            var field_id = response.field_id;
            // find the HTML element that displays the error
            var field_failed = field_id + "_failed";

            if (result == "0") {


                $("#" + field_failed).removeClass("hidden");
                $("#" + field_failed).addClass("error");

            }

            else {

                $("#" + field_failed).removeClass("error");
                $("#" + field_failed).addClass("hidden");

            }

            //log data to console
            //console.log("response: " + response);
            //console.log("result: " + result);
            //console.log("field_id :" + field_id);
            //console.log("message :" + message);

        });

}