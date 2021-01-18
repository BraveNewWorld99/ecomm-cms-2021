DELIMITER $$

CREATE  PROCEDURE removeCartItemBySession(IN _user_session_id CHAR(40), IN _art_id MEDIUMINT(8))

BEGIN

    START TRANSACTION;

    DELETE FROM carts WHERE user_session_id = _user_session_id and art_id = _art_id;

    COMMIT;

END $$

DELIMITER ;