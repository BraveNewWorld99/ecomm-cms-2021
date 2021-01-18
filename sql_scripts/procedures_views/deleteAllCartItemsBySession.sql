DELIMITER $$

CREATE  PROCEDURE deleteAllCartItemsBySession(IN _user_session_id CHAR(40))

BEGIN

    START TRANSACTION;

    DELETE FROM carts WHERE user_session_id = _user_session_id;

    COMMIT;

END $$

DELIMITER ;