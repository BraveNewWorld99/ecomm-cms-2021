DELIMITER $$

CREATE  PROCEDURE  insertUserBillInfo(IN _user_login VARCHAR(50), IN _bill_first_name varchar(50),
                                      IN _bill_last_name varchar(50), IN _bill_address1 varchar(50),
                                      IN _bill_address2 varchar(50), IN _bill_city varchar(50),
                                      IN _bill_state varchar(25), IN _bill_country varchar(50),
                                      IN _bill_zip_code_post_code varchar(10), IN _date_modified datetime)
BEGIN

    START TRANSACTION;

    UPDATE users SET bill_first_name = _bill_first_name, bill_last_name = _bill_last_name, bill_address1 = _bill_address1, bill_address2 = _bill_address2, bill_city = _bill_city, bill_state = _bill_state, bill_country = _bill_country, bill_zip_code_post_code = _bill_zip_code_post_code, date_modified = _date_modified WHERE email = _user_login;

    COMMIT;

END;

