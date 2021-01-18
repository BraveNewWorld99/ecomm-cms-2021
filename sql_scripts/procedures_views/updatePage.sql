DELIMITER $$

CREATE  PROCEDURE updatePage(IN _page_id SMALLINT(5), IN _parentName VARCHAR(255), IN _url VARCHAR(255), IN _pageTitle VARCHAR(255), IN _pageContent MEDIUMTEXT)

BEGIN

    START TRANSACTION;

    UPDATE pages SET url=_url, parentName=_parentName, pageTitle=_pageTitle, pageContent=_pageContent WHERE page_id = _page_id;

    COMMIT;

END $$

DELIMITER ;