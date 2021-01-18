DELIMITER $$

CREATE  PROCEDURE getChildPagesfromParent(IN _url VARCHAR(255))

BEGIN

    START TRANSACTION;

    SELECT * FROM pages WHERE parentName = _url AND parentName <> 'top_menu_item' AND deleted=0;

    COMMIT;

END $$

DELIMITER ;