DELIMITER $$

CREATE  PROCEDURE getProductsByID(IN _art_id INT(8))

BEGIN

    START TRANSACTION;

    SELECT * FROM art WHERE art_id = _art_id;

    COMMIT;

END $$

DELIMITER ;