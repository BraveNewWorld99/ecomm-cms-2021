DELIMITER $$

CREATE  PROCEDURE updateActiveCategories(IN _art_by_style TINYINT(1), IN _art_popular TINYINT(1), IN _art_by_price TINYINT(1), IN _art_sale TINYINT(1), IN _art_by_medium TINYINT(1))

BEGIN

    START TRANSACTION;

    UPDATE active_categories SET category_active = _art_by_style WHERE category_description = 'art_by_style';
    UPDATE active_categories SET category_active = _art_popular WHERE category_description = 'popular_products';
    UPDATE active_categories SET category_active = _art_by_price WHERE category_description = 'art_by_price';
    UPDATE active_categories SET category_active = _art_sale WHERE category_description = 'art_on_sale';
    UPDATE active_categories SET category_active = _art_by_medium WHERE category_description = 'art_by_medium';

    COMMIT;

END $$

DELIMITER ;