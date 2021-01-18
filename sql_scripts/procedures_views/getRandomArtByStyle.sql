DELIMITER $$

CREATE PROCEDURE getRandomArtByStyle()

BEGIN


    START TRANSACTION;

    SELECT a.*
    FROM art a
             INNER JOIN
         (SELECT style,
                 MIN(art_id) as id
          FROM art
          GROUP BY style
         ) AS b
         ON a.style = b.style
             AND a.art_id = b.id ORDER BY RAND() LIMIT 4;

    COMMIT;

END $$

DELIMITER ;

