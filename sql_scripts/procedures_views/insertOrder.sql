DELIMITER $$

CREATE  PROCEDURE insertOrder(IN _user_id INT(8), IN _art_id INT(8), IN _quantity INT(8), _transaction_id VARCHAR(45), _payment_status VARCHAR(45), _payment_amount INT(7), _shipping_amount INT(10), IN _date_created DATETIME)


BEGIN

    START TRANSACTION;

    INSERT INTO orders (user_id, art_id, quantity, transaction_id, payment_status, payment_amount, shipping_amount, date_created) VALUES (_user_id, _art_id, _quantity, _transaction_id, _payment_status, _payment_amount, _shipping_amount, _date_created);

    COMMIT;

END $$

DELIMITER ;