DELIMITER $$

CREATE  PROCEDURE deletePage(IN _page_id SMALLINT(5))

BEGIN

    START TRANSACTION;

    UPDATE pages SET deleted = 1 WHERE page_id = _page_id;

    COMMIT;

END $$

DELIMITER ;