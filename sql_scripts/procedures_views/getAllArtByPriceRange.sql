DELIMITER $$

CREATE PROCEDURE getAllArtByPriceRange(IN _price1 INT(10), IN _price2 INT(10))

BEGIN


    START TRANSACTION;

    SELECT * FROM cms.art WHERE price BETWEEN _price1 AND _price2;

    COMMIT;

END $$

DELIMITER ;