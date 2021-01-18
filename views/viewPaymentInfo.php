<div class="row">

    <div class="confirm_order_wrapper">

        <div class="order_summary">

            <div class="order_summary_title"><h3>Order Summary</h3></div>

<?php


//TODO consider putting higher above, it's breaking html with an extra </div> being added due to code location here
if (isset($rows)) {

    echo "<table class=\"checkout_table\">";

    $grand_total = 0;

    foreach ($rows as $value) {

        $price_calc = $value['price'];
        $quantity_calc = $value['quantity'];
        $total_price = $price_calc * $quantity_calc;
        $grand_total = $grand_total + $total_price;

        echo "<tr><td><div class=\"checkout_img_container\"><img class=\"checkout_img\" src=" . BASE_URI . $value['midsize'] . "></div></td><td><div class=\"checkout_item_description\">" . $value['mini_description'] .
            "</div></td><td><div class=\"checkout_total_price\">" . $product->money_format('%i', $total_price / 100) . "</div></td></tr>";

    }

    //TODO need to fix alignment in of this div in css
    echo "<tr><td></td><td></td><td><div class=\"check_grand_total\">" . $product->money_format('%i', $grand_total / 100) . "</div></td>";

    echo "</table>";

    echo "</div>"; //End order_summary

?>

    <div class="purchase_links">
        <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewShipInfo"?>">Shipping Info ></a>
        <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewBillInfo"?>">Billing Info ></a>
        <a href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewPaymentInfo"?>">Payment Info</a>
    </div>

<div class="credit_card_title"><h3>Enter Credit Card Details</h3></div>

<div class="order_disclaimer">

    This is a demo website only.  Credit card information can't be entered below.
    However, clicking the place order button below will create a fake order for you to review in your account.
    This is not a real order, you will receive no goods.  Check the terms and conditions checkbox below if you agree.
    Checkbox must be checked to place fake order.

</div>
<form id="credit_card_form" action="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewPaymentInfo"?>" method="POST">

    <div class="form_group">
    <input type="text" id="card_number" name="card_number" placeholder="Card Number" value="" readonly>
    </div>

    <div class="form_group_inline">
    <input type ="text" id="card_month" name="card_month" placeholder="MM" value="" readonly>
    </div>

    <div class="form_group_inline">
    <input type="text" id="card_year" name="card_year" placeholder="YY" value="" readonly>
    </div>

    <div class="form_group_inline">
    <input type="text" id="card_cvc" name="card_cvc" placeholder="CVC" value="" readonly>
    </div>

    <div class="form_group">
    <input type="checkbox" name="ts_and_cs" value="terms_accepted">
    <span id="tcs_and_cs_span">I accept the terms and conditions.</span>

    </div>

    <div class="form_group">
    <span class="<?php echo $terms_not_accepted ?>" id="terms_not_accepted">Please accept the terms and conditions to process your fake order.</span>
    </div>

    <button type="submit" id="place_order" name="place_order" value="place_order" >Place Order</button>

</form>

<?php

    } else {

    echo "<div class=\"no_ship_cart_items\">There are no items in your cart.</div>";

}

echo "</div>"; //end confirm_order_wrapper

echo "</div>"; //End row

?>