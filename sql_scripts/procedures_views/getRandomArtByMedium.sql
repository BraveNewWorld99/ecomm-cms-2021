DELIMITER $$

CREATE PROCEDURE getRandomArtByMedium()

BEGIN


    START TRANSACTION;

    SELECT a.*
    FROM art a
             INNER JOIN
         (SELECT medium,
                 MIN(art_id) as id
          FROM art
          GROUP BY medium
         ) AS b
         ON a.medium = b.medium
             AND a.art_id = b.id ORDER BY RAND() LIMIT 4;

    COMMIT;

END $$

DELIMITER ;

