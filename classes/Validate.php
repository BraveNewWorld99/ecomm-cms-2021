<?php
/**
 * CMS by Adam Hott
 * Copyright 2020
 * Validate.php
 */

class Validate
{

    // supports AJAX validation, verifies a single value
    public function ValidateAJAX($input_value, $field_id)
    {
        // check which field is being validated and perform validation
        switch($field_id)
        {
            /* Form Fields on viewCreateAccount.php */

            //Check if user first name is valid
            case 'user_first_name':
                return $this->validateUserFirstName($input_value);
                break;

            //Check if user last name is valid
            case 'user_last_name':
                return $this->validateUserLastName($input_value);
                break;

            // Check if the username is valid
            case 'user_login':
                return $this->validateUserLogin($input_value);
                break;

            // Check if the password is valid
            case 'user_password':
                return $this->validatePassword($input_value);
                break;

            // Check if password confirm is valid
            case 'user_password_confirm':
                return $this->validatePassword($input_value);
                break;

            /* Form fields on viewShipInfo.php */

            //Check if ship to first name is valid
            case 'ship_first_name':
                return $this->validateUserFirstName($input_value);
                break;

            //Check if ship to last name is valid
            case 'ship_last_name':
                return $this->validateUserLastName($input_value);
                break;

            //Check if ship to city is valid
            case 'ship_city':
                return $this->validateCity($input_value);
                break;

            //Check if ship to country is valid
            case 'ship_country':
                return $this->validateCountry($input_value);
                break;
        }
    }

    // validates all form fields on form submit
    public function ValidatePHP($referrer_url)
    {
        // error flag, becomes 1 when errors are found.
        $errorsExist = 0;
        // clears the errors session flag
        if (isset($_SESSION['errors']))
            unset($_SESSION['errors']);
        // By default all fields are considered valid
        /* Form fields on viewCreateAccount.php */
        $_SESSION['errors']['user_first_name'] = 'hidden';
        $_SESSION['errors']['user_last_name'] = 'hidden';
        $_SESSION['errors']['user_login'] = 'hidden';
        $_SESSION['errors']['user_password'] = 'hidden';
        $_SESSION['errors']['user_password_confirm'] = 'hidden';
        /* Form fields on viewShipInfo.php */
        $_SESSION['errors']['ship_first_name'] = 'hidden';
        $_SESSION['errors']['ship_last_name'] = 'hidden';
        $_SESSION['errors']['ship_city'] = 'hidden';
        $_SESSION['errors']['ship_country'] = 'hidden';
        /* Form fields on viewBillInfo.php */
        $_SESSION['errors']['bill_first_name'] = 'hidden';
        $_SESSION['errors']['bill_last_name'] = 'hidden';
        $_SESSION['errors']['bill_city'] = 'hidden';
        $_SESSION['errors']['bill_country'] = 'hidden';


        //For viewcreateAccount.php
        if ($referrer_url == "http://localhost/cms5/views/viewFrontPage.php?view=viewCreateAccount") {

            /* For viewCreateAccount.php */
            //Validate user first name
            if (!$this->validateUserFirstName($_POST['user_first_name'])) {
                $_SESSION['errors']['user_first_name'] = 'error';
                $errorsExist = 1;
            }

            //Validate user first name
            if (!$this->validateUserLastName($_POST['user_last_name'])) {
                $_SESSION['errors']['user_last_name'] = 'error';
                $errorsExist = 1;
            }

            //Validate user first name
            if (!$this->validateUserLastName($_POST['user_last_name'])) {
                $_SESSION['errors']['user_last_name'] = 'error';
                $errorsExist = 1;
            }

            // Validate username
            if (!$this->validateUserLogin($_POST['user_login'])) {
                $_SESSION['errors']['user_login'] = 'error';
                $errorsExist = 1;
            }

            // Validate password
            if (!$this->validatePassword($_POST['user_password'])) {
                $_SESSION['errors']['user_password'] = 'error';
                $errorsExist = 1;
            }

            // Validate password confirm
            if (!$this->validatePassword($_POST['user_password_confirm'])) {
                $_SESSION['errors']['user_password_confirm'] = 'error';
                $errorsExist = 1;
            }

        }

        //For viewShipInfo.php

        if ($referrer_url == "http://localhost/cms5/views/viewFrontPage.php?view=viewShipInfo") {

            /* For viewShipInfo.php */
            if (!$this->validateShipFirstName($_POST['ship_first_name'])) {
                $_SESSION['errors']['ship_first_name'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateShipLastName($_POST['ship_last_name'])) {
                $_SESSION['errors']['ship_last_name'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateCity($_POST['ship_city'])) {
                $_SESSION['errors']['ship_city'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateCountry($_POST['ship_country'])) {
                $_SESSION['errors']['ship_country'] = 'error';
                $errorsExist = 1;
            }

        }

        // For viewBillInfo.php
        if ($referrer_url == "http://localhost/cms5/views/viewFrontPage.php?view=viewBillInfo") {

            /* For viewBillInfo.php */
            if (!$this->validateBillFirstName($_POST['bill_first_name'])) {
                $_SESSION['errors']['bill_first_name'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateBillLastName($_POST['bill_last_name'])) {
                $_SESSION['errors']['bill_last_name'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateCity($_POST['bill_city'])) {
                $_SESSION['errors']['bill_city'] = 'error';
                $errorsExist = 1;
            }

            if (!$this->validateCountry($_POST['bill_country'])) {
                $_SESSION['errors']['bill_country'] = 'error';
                $errorsExist = 1;
            }


        }


        // For viewRegisterLogin
        if ($referrer_url == "http://localhost/cms5/views/viewFrontPage.php?view=viewRegisterLogin") {

            // Validate username
            if (!$this->validateUserLogin($_POST['user_login'])) {
                $_SESSION['errors']['user_login'] = 'error';
                $errorsExist = 1;
            }

            // Validate password
            if (!$this->validatePassword($_POST['user_password'])) {
                $_SESSION['errors']['user_password'] = 'error';
                $errorsExist = 1;
            }

        }


        /*

        // Validate phone
        if (!$this->validatePhone($_POST['txtPhone']))
        {
            $_SESSION['errors']['txtPhone'] = 'error';
            $errorsExist = 1;
        }

        // Validate read terms
        if (!isset($_POST['chkReadTerms']) ||
            !$this->validateReadTerms($_POST['chkReadTerms']))
        {
            $_SESSION['errors']['chkReadTerms'] = 'error';
            $_SESSION['values']['chkReadTerms'] = '';
            $errorsExist = 1;
        }
        */

        // If no errors are found, point to a successful validation page
        if ($errorsExist == 0)
        {
            return $referrer_url;
        }
        else
        {
            // If errors are found, save current user input
            foreach ($_POST as $key => $value)
            {
                $_SESSION['values'][$key] = $_POST[$key];
            }
            return $referrer_url;
        }
    }


    //must not be empty and only a-z A-Z characters
    private function validateUserFirstName($value)
    {
        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }

    //must not be empty and only a-z A-Z characters
    private function validateUserLastName($value)
    {

        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }

    ///must not be empty and only a-z A-Z characters
    private function validateShipFirstName($value)
    {
        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }

    //must not be empty and only a-z A-Z characters
    private function validateShipLastName($value)
    {
        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }

    //must not be empty and only a-z A-Z characters
    private function validateBillFirstName($value)
    {
        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }

    //must not be empty and only a-z A-Z characters
    private function validateBillLastName($value)
    {
        //regex pattern
        $reg_ex = "/^[a-zA-Z]+$/";

        //check if value matches patter
        $match = preg_match($reg_ex, $value);

        // trim and escape input value
        $value = trim($value);
        // empty user name is not valid
        if ($value)

            if ($match == 1) {

                return 1; //valid

            }  else {

                return 0; //not valid

            }

        else {

            return 0; // not valid

        }

    }



    // validate email for user name (must not be empty, and must not be already registered)
    private function validateUserLogin($value)
    {

        if ($value = filter_var($value, FILTER_VALIDATE_EMAIL)) {

            $user = new User();
            $row = $user->checkUserLoginExists(trim($value));

            if ($row[0] == $value) {
                return 0; //not valid
            }
            else {

                return 1; //valid
            }
        }

        else {

            return 0; //not valid

        }

    }

    //validate password, must be greater or equal to 8 characters
    private function validatePassword($value)
    {

        if (strlen($value) >= 8) {

            return 1; //valid
        }

        else {

            return 0; //not valid
        }

    }

    private function validateCity($value)
    {

        $reg_ex = "/^[a-zA-Z]+$/";

        $match = preg_match($reg_ex, $value);

        if ($match == 1) {

            return 1; //valid

        }  else {

            return 0; //not valid

        }


    }

    private function validateCountry($value)
    {

        $value = trim($value);

        if ($value == "United States") {

            return 1; //valid

        }

        else {

            return 0; //not valid
        }


    }

    /*
    // validate phone
    private function validatePhone($value)
    {
        // valid phone format: ###-###-####
        return (!preg_match('/^[0-9]{3}-*[0-9]{3}-*[0-9]{4}$/', $value)) ? 0 : 1;
    }

    // check the user has read the terms of use
    private function validateReadTerms($value)
    {
        // valid value is 'true'
        return ($value == 'true' || $value == 'on') ? 1 : 0;
    }

    */

}

?>