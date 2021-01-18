DELIMITER $$

CREATE  PROCEDURE updateProduct(IN _art_id INT(8), IN sku VARCHAR(24), IN thumb VARCHAR(100), IN style VARCHAR(50), IN price INT(10), IN medium VARCHAR(50), IN artist VARCHAR(50), IN mini_description VARCHAR(150))

BEGIN

    START TRANSACTION;

    UPDATE art SET sku=sku, thumb=thumb, style=style, price=price, medium=medium, artist=artist, mini_description=mini_description WHERE art_id = _art_id;

    COMMIT;

END $$

DELIMITER ;