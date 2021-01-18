<?php

/**
 * CMS by Adam Hott
 * Copyright 2019
 * Page.php
 */
 
/**
* Class to handle pages
*/

class Page
{
	//Properties
	
	/**
	* @var int The page ID from the database
	*/
	public $page_id = null;

    /**
     * @var varchar The url of the page
     */

    public $url = null;

    /**
     * @var varchar The name of the parent url of the page. This is a nested child menu item.
     */

    public $parentName = null;

	/**
	* @var varchar Full titel of the page
	*/
	public $pageTitle = null;
	
	/**
	* @var mediumtext The content of the page
	*/
	public $pageContent = null;



	/**
	* Sets the object's properties using the values in the supplied array
	* @param assoc The property values
	*/
	public function __construct($data=array() ) {
		if (isset($data['page_id'] ) ) $this->page_id = (int) $data['page_id'];
		if (isset($data['url'] ) ) $this->url = $data['url'];
        if (isset($data['parentName'] ) ) $this->parentName = $data['parentName'];
		if (isset($data['pageTitle'] ) ) $this->pageTitle = preg_replace ("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['pageTitle']);
		if (isset($data['pageContent'] ) ) $this->pageContent = $data['pageContent'];
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
  * Returns a Page object matching the given page ID
  *
  * @param int The page ID
  * @return Page|false The page object, or false if the record was not found or there was a problem
  */
 
  public static function getPageById( $page_id ) {

      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL getPageByID(:page_id)";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":page_id", $page_id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Page( $row );
  }

    /**
     * Returns array of the homepage's database contents
     *
     * @param var url - 'home' is hardcoded into this query.  Must set 'home' as the url in the admin console.
     */

    public static function getUrlParentNameList(){
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * FROM geturlparentnamelist";
        $st = $conn->prepare( $sql );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;
    }

    /**
     * Returns pages that are children of the parent url
     * @param var url
     * */

    public function getChildPagesfromParent ($url) {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "CALL getChildPagesfromParent(:url)";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":url", $url, PDO::PARAM_STR );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }

    /**
     * Returns pages that have a parentName of top_menu_item
     * */

    public function getTopMenuItems () {
        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * from pages WHERE parentName = 'top_menu_item' AND deleted =0";
        $st = $conn->prepare( $sql );
        $st->execute();
        $rows = $st->fetchAll();
        $conn = null;
        if ( $rows ) return $rows;

    }


    public static function getHomeContent() {

        //Set PDO Attributes in the options array
        $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
        $sql = "SELECT * FROM getHomeContent";
        $st = $conn->prepare( $sql );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Page( $row );
    }
  
   /**
  * Returns all (or a range of) Page objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the pages
  * @return Array|false A two-element array : results => array, a list of Page objects; totalRows => Total number of pages
  */
 
public static function getPageList() {

    //SET max rows
    $numRows=1000000;

    //TODO use getPageList store procedure here, probably can do a lot of this in SQL.
    //Set PDO Attributes in the options array
    $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

     $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options);
     $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM pages WHERE deleted = 0 LIMIT :numRows";
     $st = $conn->prepare($sql);
     $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
     $st->execute();
     $list = array();

     while ($row = $st->fetch())
         {
         $page = new Page($row);
         $list[] = $page;
         }
		 
	// Now get the total number of pages that matched the criteria
    //TODO Above we have $data which is pulling in all the page data, here we have $results.  Do we need both on each page?  Clean this up.
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }

    /**
     * Get all pages.  TODO need to create a view for this.
     */

  public function getPages() {
      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
      $sql = "SELECT * FROM pages WHERE deleted=0";
      $st = $conn->prepare( $sql );
      $st->execute();
      $rows = $st->fetchAll();
      $conn = null;
      if ( $rows ) return $rows;
  }
  
   /**
  * Inserts the current Page object into the database, and sets its ID property.
  */
 
  public function insertPage() {

    // Does the Page object already have an ID?
    if ( !is_null( $this->page_id ) ) trigger_error ( "Page::insertPage(): Attempt to insert a Page object that already has its ID property set (to $this->id).", E_USER_ERROR );

      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Insert the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL insertPage( :url, :parentName, :pageTitle, :pageContent)";
    $st = $conn->prepare ( $sql );
	$st->bindValue( ":url", $this->url, PDO::PARAM_STR );
      $st->bindValue( ":parentName", $this->parentName, PDO::PARAM_STR );
    $st->bindValue( ":pageTitle", $this->pageTitle, PDO::PARAM_STR );
      $st->bindValue( ":pageContent", $this->pageContent, PDO::PARAM_STR );
    $st->execute();
    $this->page_id = $conn->lastInsertId();
    $conn = null;
  }
  
  /**
  * Updates the current Page object in the database.
  */
 
  public function updatePage() {

    // Does the Page object have an ID?
    if ( is_null( $this->page_id ) ) trigger_error ( "Page::updatePage(): Attempt to update a Page object that does not have its ID property set.", E_USER_ERROR );

      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $sql = "CALL updatePage(:page_id, :url, :parentName,  :pageTitle, :pageContent)";
    $st = $conn->prepare ( $sql );
	$st->bindValue(":page_id", $this->page_id, PDO::PARAM_INT );
	$st->bindValue( ":url", $this->url, PDO::PARAM_STR );
      $st->bindValue( ":parentName", $this->parentName, PDO::PARAM_STR );
    $st->bindValue( ":pageTitle", $this->pageTitle, PDO::PARAM_STR );
    $st->bindValue( ":pageContent", $this->pageContent, PDO::PARAM_STR );
    $st->execute();
    $conn = null;
  }
  
    /**
  * Updates the Page object from the database to have a deleted value of 1, soft delete.
  */
 
  public function deletePage() {
 
    // Does the Page object have an ID?
    if ( is_null( $this->page_id ) ) trigger_error ( "Page::deletePage(): Attempt to delete a Page object that does not have its ID property set.", E_USER_ERROR );

      //Set PDO Attributes in the options array
      $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

    // Delete the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
    $st = $conn->prepare ( "CALL deletePage(:page_id)" );
    $st->bindValue( ":page_id", $this->page_id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}

?>
    