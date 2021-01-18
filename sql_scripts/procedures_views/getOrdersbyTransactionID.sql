DELIMITER $$

CREATE  PROCEDURE getOrdersbyTransactionID(IN _transaction_id VARCHAR(45))

BEGIN

    START TRANSACTION;

    SELECT * FROM orders LEFT JOIN art ON orders.art_id = art.art_id WHERE transaction_id = _transaction_id;

    COMMIT;

END $$

DELIMITER ;