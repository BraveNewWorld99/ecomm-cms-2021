DELIMITER $$

CREATE  PROCEDURE getShipInfo(IN _user_login VARCHAR(50))

BEGIN

    START TRANSACTION;

    SELECT ship_first_name, ship_last_name, ship_address1, ship_address2, ship_city, ship_state, ship_country, ship_zip_code_post_code
        FROM users WHERE email = _user_login;

    COMMIT;

END $$

DELIMITER ;