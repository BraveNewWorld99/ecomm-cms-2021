<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * Product.php
 */

/** Class to handle products **/

class Product
{

    //TODO Need to add stock to the database and update accordingly.
    //TODO Need to add dimensions for art piece to database and update accordingly.
    /**
     * @var int The art ID from the database
     */

    public $art_id = null;

    /**
     * @var varchar The sku from the database
     */

    public $sku = null;

    /**
     * @var varchar The file path for the thumbnail from the database
     */

    public $thumb = null;

    /**
     * @var varchar The file path for the midsize image from the database
     */

    public $midsize = null;

    /**
     * @var varchar The file path for the large image from the database
     */

    public $large = null;

    /**
     * @var varchar The style of the piece from the database
     */

    public $style = null;

    /**
     * @var decimal The price from the database
     */

    public $price = null;

    /**
     * @var varchar The medium from the database
     */

    public $medium = null;

    /**
     * @var varchar The artist from the database
     */

    public $artist = null;

    /**
     * @var varchar The mini-description from the database
     */
    public $mini_description = null;

    /**
     * @var tinyint The art by style category from the active categories table
     */
    public $art_by_style = null;

    /**
     * @var tinyint The popular art category from the active categories table
     */

    public $art_popular = null;

    /**
     * @var tinyint The art by price category from the active categories table
     */

    public $art_by_price = null;

    /**
     * @var tinyint The art on sale category from the active categories table
     */

    public $art_sale = null;

    /**
     * @var tinyint The art by medium category from the active categories table
     */

    public $art_by_medium = null;

    /**
     * Sets the object's properties using the values in the supplied array
     * @param assoc The property values
     */
    public function __construct($data=array() ) {
        if (isset($data['art_id'] ) ) $this->art_id = (int) $data['art_id'];
        if (isset($data['sku'] ) ) $this->sku = $data['sku'];
        if (isset($data['thumb'] ) ) $this->thumb = $data['thumb'];
        if (isset($data['midsize'] ) ) $this->midsize = $data['midsize'];
        if (isset($data['large'] ) ) $this->large = $data['large'];
        if (isset($data['style'] ) ) $this->style = $data['style'];
        if (isset($data['price'] ) ) $this->price = $data['price'];
        if (isset($data['medium'] ) ) $this->medium = $data['medium'];
        if (isset($data['artist'] ) ) $this->artist = $data['artist'];
        if (isset($data['mini_description'] ) ) $this->mini_description = $data['mini_description'];

    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */
    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );
    }


    /**
     * Returns a Products object matching with all the products
     *
     * @return $rows The rows of the query
     */

    public function getProducts() {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
        $sql = "SELECT * FROM getProducts";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }

    public function getProductsByID($art_id){

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
        $sql = "CALL getProductsByID(:art_id)";
        $st = $conn->prepare($sql);
        $st->bindValue(":art_id", $art_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Product($row);
    }

    public function insertProduct($sku,$thumb,$midsize,$style,$price, $medium, $artist, $mini_description) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL insertProduct(:sku,:thumb,:midsize,:style,:price,:medium,:artist,:mini_description)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":sku", $sku, PDO::PARAM_STR );
        $st->bindValue( ":thumb", $thumb, PDO::PARAM_STR );
        $st->bindValue( ":midsize", $midsize, PDO::PARAM_STR );
        $st->bindValue( ":style", $style, PDO::PARAM_STR );
        $st->bindValue( ":price", $price, PDO::PARAM_STR );
        $st->bindValue( ":medium", $medium, PDO::PARAM_STR );
        $st->bindValue( ":artist", $artist, PDO::PARAM_STR );
        $st->bindValue( ":mini_description", $mini_description, PDO::PARAM_STR );
        $st->execute();
        $conn=null;

    }

    public function updateProduct($art_id,$sku,$thumb,$midsize, $large, $style,$price, $medium, $artist, $mini_description) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL updateProduct(:art_id,:sku,:thumb,:midsize,:large,:style,:price,:medium,:artist,:mini_description)";
        $st = $conn->prepare ( $sql );
        $st->bindValue(":art_id", $art_id, PDO::PARAM_INT );
        $st->bindValue( ":sku", $sku, PDO::PARAM_STR );
        $st->bindValue( ":thumb", $thumb, PDO::PARAM_STR );
        $st->bindValue( ":midsize", $midsize, PDO::PARAM_STR );
        $st->bindValue( ":large", $large, PDO::PARAM_STR );
        $st->bindValue( ":style", $style, PDO::PARAM_STR );
        $st->bindValue( ":price", $price, PDO::PARAM_STR );
        $st->bindValue( ":medium", $medium, PDO::PARAM_STR );
        $st->bindValue( ":artist", $artist, PDO::PARAM_STR );
        $st->bindValue( ":mini_description", $mini_description, PDO::PARAM_STR );
        $st->execute();
        $conn = null;

    }

    public function updateActiveCategories($art_by_style, $art_popular, $art_by_price, $art_sale, $art_by_medium) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL updateActiveCategories(:art_by_style, :art_popular, :art_by_price, :art_sale, :art_by_medium)";
        $st = $conn->prepare ( $sql );
        $st->bindValue(":art_by_style", $art_by_style, PDO::PARAM_INT );
        $st->bindValue(":art_popular", $art_popular, PDO::PARAM_INT );
        $st->bindValue(":art_by_price", $art_by_price, PDO::PARAM_INT );
        $st->bindValue(":art_sale", $art_sale, PDO::PARAM_INT );
        $st->bindValue(":art_by_medium", $art_by_medium, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

    public function getActiveProductCategories(){
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * FROM getActiveProductCategories";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    public function getRandomArtByStyle() {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Update the Product
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL getRandomArtByStyle()";
    $st = $conn->prepare($sql);
    $st->execute();
    $rows = $st->fetchAll();
    $conn = null;
    if ( $rows ) return $rows;
}

public function getArtByStyle($style) {
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Update the Product
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL getArtByStyle(:style)";
    $st = $conn->prepare($sql);
    $st->bindValue( ":style", $style, PDO::PARAM_STR );
    $st->execute();
    $rows = $st->fetchAll();
    $conn = null;
    if ( $rows ) return $rows;


}

    public function getArtByMedium($medium) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getArtByMedium(:medium)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":medium", $medium, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;


    }

    public function getRandomArtByMedium() {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getRandomArtByMedium()";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    public function getArtByPriceRanges() {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getArtByPriceRanges()";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    public function getAllArtByPriceRange($price1, $price2) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getAllArtByPriceRange(:price1, :price2)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":price1", $price1, PDO::PARAM_INT );
        $st->bindValue( ":price2", $price2, PDO::PARAM_INT );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }


    public function getDistinctStyles(){
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * FROM getDistinctStyles";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }

    public function getDistinctMedium() {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * FROM getDistinctMedium";
        $st = $conn->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;


    }

    public function insertCart($user_session_id,$art_id,$quantity,$date_created,$date_modified) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL insertCart(:user_session_id,:art_id,:quantity,:date_created,:date_modified)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->bindValue( ":art_id", $art_id, PDO::PARAM_INT );
        $st->bindValue( ":quantity", $quantity, PDO::PARAM_INT );
        $st->bindValue( ":date_created", $date_created, PDO::PARAM_STR );
        $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
        $st->execute();
        $conn=null;

    }

    public function insertWishlist($user_session_id,$art_id,$quantity,$date_created,$date_modified) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL insertWishlist(:user_session_id,:art_id,:quantity,:date_created,:date_modified)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->bindValue( ":art_id", $art_id, PDO::PARAM_INT );
        $st->bindValue( ":quantity", $quantity, PDO::PARAM_INT );
        $st->bindValue( ":date_created", $date_created, PDO::PARAM_STR );
        $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
        $st->execute();
        $conn=null;

    }

    public function countCartItems($user_session_id) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL countCartItems(:user_session_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->execute();
        $count = $st->fetch();
        $conn = null;
        if ( $count ) return $count;

    }

    //TODO update this stored procedure to clear out old session data greater than the max session cookie lifetime
    public function getCartBySession($user_session_id) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getCartBySession(:user_session_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }


    public function removeCartItemBySession($user_session_id,$art_id) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL removeCartItemBySession(:user_session_id,:art_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->bindValue( ":art_id", $art_id, PDO::PARAM_INT );
        $st->execute();
        $conn=null;
    }

    public function updateCartItemQuantity($user_session_id,$art_id,$quantity,$date_created,$date_modified) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL updateCartItemQuantity(:user_session_id,:art_id,:quantity,:date_created,:date_modified)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->bindValue( ":art_id", $art_id, PDO::PARAM_INT );
        $st->bindValue( ":quantity", $quantity, PDO::PARAM_INT );
        $st->bindValue( ":date_created", $date_created, PDO::PARAM_STR );
        $st->bindValue( ":date_modified", $date_modified, PDO::PARAM_STR );
        $st->execute();
        $conn=null;

    }


    public function deleteAllCartItemsBySession($user_session_id) {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL deleteAllCartItemsBySession(:user_session_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_session_id", $user_session_id, PDO::PARAM_STR );
        $st->execute();
        $conn=null;
    }

    public function getShipStateDropDown() {

        $states	= array(
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
            'DC' => 'Washington D.C.'
        );

        $drop	= '';

        $drop	.= "<select id=\"state_drop_down\" name=\"ship_state\">";

        $drop	.= "<option value=\"none\">(Select)</option>";

        foreach ( $states as $value => $label ) {
            $drop .= "<option value=\"" . $value . "\">" . $label . "</option>";
        }

        $drop	.= "</select>";

        return $drop;

    }

    public function getBillStateDropDown() {

        $states	= array(
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
            'DC' => 'Washington D.C.'
        );

        $drop	= '';

        $drop	.= "<select id=\"state_drop_down\" name=\"bill_state\">";

        $drop	.= "<option value=\"none\">(Select)</option>";

        foreach ( $states as $value => $label ) {
            $drop .= "<option value=\"" . $value . "\">" . $label . "</option>";
        }

        $drop	.= "</select>";

        return $drop;

    }

    public function insertOrder($user_id,$art_id,$quantity,$transaction_id,$payment_status,$payment_amount,$shipping_amount,$date_created)
    {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
        $sql = "CALL insertOrder(:user_id,:art_id,:quantity,:transaction_id,:payment_status,:payment_amount,:shipping_amount,:date_created)";
        $st = $conn->prepare($sql);
        $st->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $st->bindValue(":art_id", $art_id, PDO::PARAM_INT);
        $st->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $st->bindValue(":transaction_id", $transaction_id, PDO::PARAM_STR);
        $st->bindValue(":payment_status", $payment_status, PDO::PARAM_STR);
        $st->bindValue(":payment_amount", $payment_amount, PDO::PARAM_INT);
        $st->bindValue(":shipping_amount", $shipping_amount, PDO::PARAM_INT);
        $st->bindValue(":date_created", $date_created, PDO::PARAM_STR);
        $st->execute();
        $conn = null;
    }

    public function getOrderConfirmation($user_id, $today, $tomorrow) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getOrderConfirmation(:user_id, :today, :tomorrow)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_id", $user_id, PDO::PARAM_STR );
        $st->bindValue( ":today", $today, PDO::PARAM_STR );
        $st->bindValue( ":tomorrow", $tomorrow, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    public function getTransactionIDs($user_id) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getTransactionIDs(:user_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":user_id", $user_id, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    public function getOrdersbyTransactionID($transaction_id) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        // Update the Product
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getOrdersbyTransactionID(:transaction_id)";
        $st = $conn->prepare($sql);
        $st->bindValue( ":transaction_id", $transaction_id, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }


    public function money_format($format, $number)
    {
        $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
            '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
            setlocale(LC_MONETARY, '');
        }
        $locale = localeconv();
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
        foreach ($matches as $fmatch) {
            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                    $match[1] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                    $match[0] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
            );
            $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
            $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
            $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
            $conversion = $fmatch[5];

            $positive = true;
            if ($value < 0) {
                $positive = false;
                $value  *= -1;
            }
            $letter = $positive ? 'p' : 'n';

            $prefix = $suffix = $cprefix = $csuffix = $signal = '';

            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
            switch (true) {
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                    $prefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                    $suffix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                    $cprefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                    $csuffix = $signal;
                    break;
                case $flags['usesignal'] == '(':
                case $locale["{$letter}_sign_posn"] == 0:
                    $prefix = '(';
                    $suffix = ')';
                    break;
            }
            if (!$flags['nosimbol']) {
                $currency = $cprefix .
                    ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                    $csuffix;
            } else {
                $currency = '';
            }
            $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

            $value = number_format($value, $right, $locale['mon_decimal_point'],
                $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
            $value = @explode($locale['mon_decimal_point'], $value);

            $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
            if ($left > 0 && $left > $n) {
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
            }
            $value = implode($locale['mon_decimal_point'], $value);
            if ($locale["{$letter}_cs_precedes"]) {
                $value = $prefix . $currency . $space . $value . $suffix;
            } else {
                $value = $prefix . $value . $space . $currency . $suffix;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                    STR_PAD_RIGHT : STR_PAD_LEFT);
            }

            $format = str_replace($fmatch[0], $value, $format);
        }
        return $format;
    }

}

?>