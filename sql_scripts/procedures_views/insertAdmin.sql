DELIMITER $$

CREATE  PROCEDURE insertAdmin(IN login VARCHAR(255), IN password VARCHAR(255), IN salt VARCHAR(255), IN hash_value VARCHAR(255), IN perm_level INT(11), IN per_name VARCHAR (255))

BEGIN

    START TRANSACTION;

        INSERT INTO auth ( login, password, salt, hash_value, perm_level, perm_name) VALUES ( login, password, salt, hash_value, perm_level, perm_name);

    COMMIT;

END $$

DELIMITER ;