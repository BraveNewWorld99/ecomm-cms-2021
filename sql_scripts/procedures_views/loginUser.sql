DELIMITER $$

CREATE  PROCEDURE loginUser(IN _user_login VARCHAR(50))

BEGIN

    START TRANSACTION;

    SELECT * FROM users WHERE email = _user_login;

    COMMIT;

END $$

DELIMITER ;