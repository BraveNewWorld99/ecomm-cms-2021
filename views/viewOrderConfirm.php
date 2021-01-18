<div class="order_confirm_title"><h3>Fake Order Confirmation</h3></div>

<div class="order_confirm_text">
    Your fake order confirmation number is: <br /><br /> <b><?php echo $transaction_id; ?> </b><br /> <br />

    A fake email confirmation has been seen to: <br /> <br /> <b> <?php echo $user_logged_in; ?> </b>
</div>

<div class="order_confirm_next">
<a class="order_confirm_buttons" href="<?php echo BASE_URI . "views/viewFrontPage.php?view=viewMyAccountOrders"?>">View My Orders</a>
<a class="order_confirm_buttons" href="<?php echo BASE_URI ?>">Continue Shopping</a>
</div>
