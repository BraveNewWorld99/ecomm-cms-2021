DELIMITER $$

CREATE  PROCEDURE insertPage(IN _url VARCHAR(255), IN _parentName VARCHAR(255), IN _pageTitle VARCHAR(255), IN _pageContent MEDIUMTEXT)

BEGIN

    START TRANSACTION;

    INSERT INTO pages (url, parentName, pageTitle, pageContent) VALUES (_url, _parentName, _pageTitle, _pageContent);

    COMMIT;

END $$

DELIMITER ;