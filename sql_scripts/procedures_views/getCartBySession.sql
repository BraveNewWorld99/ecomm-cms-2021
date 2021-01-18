DELIMITER $$

CREATE  PROCEDURE getCartBySession(IN _user_session_id CHAR(32))

BEGIN

    START TRANSACTION;

    SELECT carts.art_id, SUM(carts.quantity) as quantity, art.sku, art.thumb, art.midsize, art.large, art.style, art.price, art.medium, art.artist, art.mini_description
    FROM carts RIGHT JOIN art ON carts.art_id = art.art_id WHERE user_session_id = _user_session_id GROUP BY carts.art_id;

    COMMIT;

END $$

DELIMITER ;