DELIMITER $$

CREATE  PROCEDURE deleteUser(IN _user_id MEDIUMINT(6), IN _date_modified DATETIME)

BEGIN

    START TRANSACTION;

    UPDATE users SET date_modified=_date_modified, deleted=1  WHERE user_id = _user_id LIMIT 1;

    COMMIT;

END $$

DELIMITER ;