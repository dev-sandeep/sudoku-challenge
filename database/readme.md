## Creating the table: Authors
CREATE TABLE `authors` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `country` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`));

## Creating the table: Books
CREATE TABLE `books` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `author` VARCHAR(100) NOT NULL , `pages` INT NOT NULL,  PRIMARY KEY (`id`));


## Inserting the values
INSERT INTO `authors` (`name`, `country`) VALUES 
("name", "country"),
("J. D. Salinger", "US"),
("F. Scott. Fitzgerald", "US"),
("Jane Austen", "UK"),
("Leo Tolstoy", "RU"),
("Sun Tzu", "CN"),
("Johann Wolfgang von Goethe", "DE"),
("Janis Eglitis", "LV");

INSERT INTO `books` (`name`, `author`, `pages`) VALUES
"name", "author", "pages"
("The Catcher in the Rye", "J. D. Salinger", 300),
("Nine Stories", "J. D. Salinger", 200),
("Franny and Zooey", "J. D. Salinger", 150),
("The Great Gatsby", "F. Scott. Fitzgerald", 400),
("Tender is the Night", "F. Scott. Fitzgerald", 500),
("Pride and Prejudice", "Jane Austen", 700),
("The Art of War", "Sun Tzu", 128),
("Faust I", "Johann Wolfgang von Goethe", 300),
("Faust II", "Johann Wolfgang von Goethe", 300);

## Find author by name "Leo"
SELECT * FROM `authors` WHERE `name` LIKE '%Leo%'

## Find books of author "Fitzgerald"
SELECT name FROM `books` WHERE `author` LIKE '%Fitzgerald%'

## Find authors without books
SELECT * FROM `authors` WHERE `name` NOT IN (SELECT DISTINCT `author` FROM `books`)

## Count books per country
SELECT `authors`.`country`, COUNT(`books`.`name`) AS count FROM `authors` LEFT JOIN `books` ON `authors`.`name` = `books`.`author` GROUP BY `country`

##  Count average book length (in pages) per author
SELECT `authors`.`name`, AVG(`books`.`pages`) AS avg_pages FROM `authors` LEFT JOIN `books` ON `authors`.`name` = `books`.`author` GROUP BY `authors`.`name`