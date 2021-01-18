DELIMITER $$

CREATE  PROCEDURE countCartItems(IN _user_session_id CHAR(32))

BEGIN

    START TRANSACTION;

    SELECT SUM(quantity) FROM carts WHERE user_session_id = _user_session_id;

    COMMIT;

END $$

DELIMITER ;