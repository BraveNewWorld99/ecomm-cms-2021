DELIMITER $$

CREATE  PROCEDURE insertUser(IN title TINYTEXT, IN first_name VARCHAR(30), IN last_name VARCHAR(40), IN email VARCHAR(50), IN password VARCHAR(90), IN registration_date DATETIME, IN address1 VARCHAR(50), IN address2 VARCHAR(50), IN city VARCHAR(50), IN state CHAR(25), IN country CHAR(25), IN zip_code_post_code CHAR(10), IN phone CHAR(15), IN secret VARCHAR(30), IN user_level INT(1))

BEGIN

    START TRANSACTION;

    INSERT INTO users ( title, first_name, last_name, email, password, registration_date, address1, address2, city, state, country, zip_code_post_code, phone, secret, user_level) VALUES (title, first_name, last_name, email, password, registration_date, address1, address2, city, state, country, zip_code_post_code, phone, secret, user_level);

    COMMIT;

END $$

DELIMITER ;