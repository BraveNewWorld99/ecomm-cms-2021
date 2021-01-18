DELIMITER $$

CREATE  PROCEDURE getTransactionIDs(IN _user_id int(6))

BEGIN

    START TRANSACTION;

    SELECT DISTINCT transaction_id FROM orders WHERE user_id = _user_id;

    COMMIT;

END $$

DELIMITER ;