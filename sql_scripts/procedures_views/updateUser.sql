DELIMITER $$

CREATE  PROCEDURE updateUser(IN _user_id MEDIUMINT(6), IN title TINYTEXT, IN first_name VARCHAR(30), IN last_name VARCHAR(40), IN email VARCHAR(50), IN address1 VARCHAR(50), IN address2 VARCHAR(50), IN city VARCHAR(50), IN state CHAR(25), IN country CHAR(25), IN zip_code_post_code CHAR(10), IN phone CHAR(15), IN secret VARCHAR(30), IN user_level INT(1), IN date_modified DATETIME)

BEGIN

    START TRANSACTION;

    UPDATE users SET title=title, first_name=first_name, last_name=last_name, email=email, address1=address1, address2=address2, city=city, state=state, country=country, zip_code_post_code=zip_code_post_code, phone=phone, secret=secret, user_level=user_level, date_modified=date_modified WHERE user_id = _user_id;

    COMMIT;

END $$

DELIMITER ;