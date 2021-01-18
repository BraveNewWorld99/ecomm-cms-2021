DELIMITER $$

CREATE  PROCEDURE insertProduct(IN _sku VARCHAR(24), IN _thumb VARCHAR(100), IN _style VARCHAR(50), IN _price INT(10), IN _medium VARCHAR(50), IN _artist VARCHAR(50), IN _mini_description VARCHAR(150))

BEGIN

    START TRANSACTION;

    INSERT INTO art (sku, thumb, style, price, medium, artist, mini_description) VALUES (_sku, _thumb, _style, _price, _medium, _artist, _mini_description);

    COMMIT;

END $$

DELIMITER ;