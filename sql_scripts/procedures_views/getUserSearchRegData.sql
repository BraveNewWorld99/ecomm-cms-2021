DELIMITER $$

CREATE  PROCEDURE getUserSearchRegData(IN _query VARCHAR(255))

BEGIN

    START TRANSACTION;

    SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE deleted = 0 AND (`first_name` LIKE CONCAT('%',_query,'%')) OR (`last_name` LIKE CONCAT('%',_query,'%')) OR (`email` LIKE CONCAT('%',_query,'%')) ORDER BY registration_date ASC;

    COMMIT;

END $$

DELIMITER ;