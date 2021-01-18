<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * viewFrontPage.php
 */

require( "../config.php" );

$view = isset( $_GET['view'] ) ? $_GET['view'] : "";

switch ( $view ) {
    case 'viewStyles':
        viewStyles();
        break;
    case 'viewPrices':
        viewPrices();
        break;
    case 'viewMedium':
        viewMedium();
        break;
    case 'viewProduct':
        viewProduct();
        break;
    case 'viewCart':
        viewCart();
        break;
    case 'viewShipInfo':
        viewShipInfo();
        break;
    case 'viewBillInfo':
        viewBillInfo();
        break;
    case 'viewPaymentInfo':
        viewPaymentInfo();
        break;
    case 'viewOrderConfirm':
        viewOrderConfirm();
        break;
    case 'viewLogin':
        viewLogin();
        break;
    case 'viewRegisterLogin':
        viewRegisterLogin();
        break;
    case 'viewCreateAccount':
        viewCreateAccount();
        break;
    case 'viewMyAccount':
        viewMyAccount();
        break;
    case 'viewMyAccountOrders';
        viewMyAccountOrders();
        break;
}

function viewStyles() {

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this wil show the left front menu and products by styles
    include "viewByStyles.php";

    //footer
    include "include/front_footer.php";

}

function viewPrices() {

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this will show the left front menu and products by prices
    include "viewByPrices.php";

    //footer
    include "include/front_footer.php";



}

function viewMedium() {

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this will show the left front menu and products by medium
    include "viewByMedium.php";

    //footer
    include "include/front_footer.php";


}

function viewProduct(){

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this will show the left product menu and the main product display
    include "viewProduct.php";

    //footer
    include "include/front_footer.php";

}

function viewCart() {
    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this will show the items in the cart
    include "viewCart.php";

    //footer
    include "include/front_footer.php";


}

function viewShipInfo() {

    //For redirection upon validation
    include "viewShipInfoRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    include "viewShipInfo.php";

}

function viewBillInfo() {

    //For redirection upon validation
    include "viewBillInfoRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    include "viewBillInfo.php";

}

function viewPaymentInfo() {

    //For redirection upon validation
    include "viewPaymentInfoRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    include "viewPaymentInfo.php";
}

function viewOrderConfirm() {
    //For redirection
    include "viewOrderConfirmRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this will show the items in the cart
    include "viewOrderConfirm.php";

    //footer
    include "include/front_footer.php";

}


function viewLogin() {

    //For redirection upon validation
    include "viewLoginRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this gives a link to create a new account or login
    include "viewLogin.php";

    //footer
    include "include/front_footer.php";

}

function viewRegisterLogin() {

    //For redirection upon validation
    include "viewRegisterLoginRedirect.php";

    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this gives a link to create a new account or login
    include "viewRegisterLogin.php";

    //footer
    include "include/front_footer.php";

}

function viewCreateAccount() {

    //For redirection upon validation
    include "viewCreateAccountRedirect.php";


    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this is the form to register as a new user
    include "viewCreateAccount.php";

    //footer
    include "include/front_footer.php";

}

function viewMyAccount() {
    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this is the form to register as a new user
    include "viewMyAccount.php";

    //footer
    include "include/front_footer.php";



}

function viewMyAccountOrders() {
    //Includes javascript and css supporting files.
    include "include/front_header.php";

    //this is the top black panel of the site which contains the phone number, search bar, and wish list
    include "include/top_panel.html";

    //this is the main menu section of the site which contains the logo, main menu bar, and cart
    include "include/header_wrap.php";

    //this is order view for the user
    include "viewMyAccountOrders.php";

    //footer
    include "include/front_footer.php";


}

?>