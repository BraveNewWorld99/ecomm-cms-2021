DELIMITER $$

CREATE  PROCEDURE getBillInfo(IN _user_login VARCHAR(50))

BEGIN

    START TRANSACTION;

    SELECT bill_first_name, bill_last_name, bill_address1, bill_address2, bill_city, bill_state, bill_country, bill_zip_code_post_code
    FROM users WHERE email = _user_login;

    COMMIT;

END $$

DELIMITER ;