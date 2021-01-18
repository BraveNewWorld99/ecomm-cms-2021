DELIMITER $$

CREATE  PROCEDURE getUserID(IN _user_logged_in VARCHAR(50))

BEGIN

    START TRANSACTION;

    SELECT user_id FROM users WHERE email = _user_logged_in;

    COMMIT;

END $$

DELIMITER ;