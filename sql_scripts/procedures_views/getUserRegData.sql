DELIMITER $$

CREATE  PROCEDURE getUserRegData(IN _start INT, IN _pagerows INT)

BEGIN

    START TRANSACTION;

    SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE deleted = 0 ORDER BY registration_date ASC LIMIT _start, _pagerows;

    COMMIT;

END $$

DELIMITER ;