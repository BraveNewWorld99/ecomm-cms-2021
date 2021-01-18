DELIMITER $$

CREATE  PROCEDURE checkUserLoginExists(IN _email VARCHAR(50))

BEGIN

    START TRANSACTION;

    SELECT * FROM users WHERE email = _email;

    COMMIT;

END $$

DELIMITER ;