USE planigo;

DELIMITER //

-- Slugify function to generate slugs from names (unchanged)
CREATE FUNCTION IF NOT EXISTS slugify(input_string VARCHAR(255))
    RETURNS VARCHAR(255)
    READS SQL DATA
    DETERMINISTIC
BEGIN
RETURN LOWER(REPLACE(input_string, ' ', '-'));
END;

-- Automatically generate slugs for Categories based on name
CREATE TRIGGER IF NOT EXISTS `insert_category_slug`
    BEFORE INSERT ON `Category`
    FOR EACH ROW SET NEW.slug = slugify(NEW.name);

-- Automatically generate slugs for Shops based on name
CREATE TRIGGER IF NOT EXISTS `insert_shop_slug`
    BEFORE INSERT ON `Shop`
    FOR EACH ROW SET NEW.slug = slugify(NEW.name);

//
DELIMITER ;
