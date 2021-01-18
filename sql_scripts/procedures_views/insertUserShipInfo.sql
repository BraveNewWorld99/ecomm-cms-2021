DELIMITER $$

CREATE  PROCEDURE  insertUserShipInfo(IN _user_login VARCHAR(50), IN _ship_first_name varchar(50),
                                      IN _ship_last_name varchar(50), IN _ship_address1 varchar(50),
                                      IN _ship_address2 varchar(50), IN _ship_city varchar(50),
                                      IN _ship_state varchar(25), IN _ship_country varchar(50),
                                      IN _ship_zip_code_post_code varchar(10), IN _date_modified datetime)
BEGIN

    START TRANSACTION;

    UPDATE users SET ship_first_name = _ship_first_name, ship_last_name = _ship_last_name, ship_address1 = _ship_address1, ship_address2 = _ship_address2, ship_city = _ship_city, ship_state = _ship_state, ship_country = _ship_country, ship_zip_code_post_code = _ship_zip_code_post_code, date_modified = _date_modified WHERE email = _user_login;

    COMMIT;

END;

