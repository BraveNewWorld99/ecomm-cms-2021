CREATE VIEW getActiveProductCategories AS
SELECT * FROM active_categories WHERE category_active = 1;