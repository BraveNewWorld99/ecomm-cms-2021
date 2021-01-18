DELIMITER $$

CREATE  PROCEDURE getOrderConfirmation(IN _user_id INT(6), IN _today DATETIME, IN _tomorrow DATETIME)

BEGIN

    START TRANSACTION;

    SELECT DISTINCT transaction_id  FROM orders WHERE user_id = _user_id AND date_created >= _today AND date_created < _tomorrow;

    COMMIT;

END $$

DELIMITER ;