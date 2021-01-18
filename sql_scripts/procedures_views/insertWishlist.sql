DELIMITER $$

CREATE  PROCEDURE insertWishlist(IN _user_session_id CHAR(40), IN _art_id INT(8), IN _quantity INT(3), IN _date_created DATETIME, IN _date_modified DATETIME)

BEGIN

    START TRANSACTION;

    INSERT INTO wish_lists (user_session_id, art_id, quantity, date_created, date_modified) VALUES (_user_session_id, _art_id, _quantity, _date_created, _date_modified);

    COMMIT;

END $$

DELIMITER ;