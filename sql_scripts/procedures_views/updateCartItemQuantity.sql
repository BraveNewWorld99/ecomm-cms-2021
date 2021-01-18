DELIMITER $$

CREATE  PROCEDURE updateCartItemQuantity(IN _user_session_id CHAR(40), IN _art_id MEDIUMINT(8), IN _quantity TINYINT(3), IN _date_created DATETIME, IN _date_modified DATETIME)

BEGIN

    START TRANSACTION;

    DELETE FROM carts WHERE user_session_id = _user_session_id AND art_id = _art_id;

    INSERT INTO carts (user_session_id, art_id, quantity, date_created, date_modified) VALUES (_user_session_id, _art_id, _quantity, _date_created, _date_modified);

    COMMIT;

END $$

DELIMITER ;