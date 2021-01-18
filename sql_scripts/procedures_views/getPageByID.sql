DELIMITER $$

CREATE  PROCEDURE getPageByID(IN _page_id INT(5))

BEGIN

    START TRANSACTION;

    SELECT * FROM pages WHERE page_id = _page_id;

    COMMIT;

END $$

DELIMITER ;