###################################################################################################################

## Database Challenge

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

###################################################################################################################
## Review Factor

## code review
- Would it be safe to go into production?

  * No, There are high chances that code would run in to errors especially while dealing with calling CURL and file opertaions, 
  as there are no error handling done. 
  * In case the CURL and file operations are successful, there might be some un expected results as there are no breaks and default in switch statement.
  * CURLOPT_URL is passing the url as `string` (there are additional quotes) while the expectation of Curl function may be different.


- Does it follow best practices?

  NO, Following are my findings:
  1. No error handlings
  2. No Breaks in Switch-Case statement
  3. It is `assumed` that the user would pass only string while calling the function quote
  4. There is no point of using Class, the followed code could be written in a one single `big` function
  5. The Urls should be declared seperately and at one place, as it would be difficult to change them in future
     if they are inside code.
  6. Default providers could be written seperately
  7. It would have great if some of the generic operations would have been written in seperate function, for code re-usability


- How could we verify that it's always working as intended?
  We could write unit tests for the code, with the following tests:
  1. when a single string is passed -> we get an array with 1 element, with key being the passed string 
     eg: Input: `insuarance`, output: [`insuarance`]=>data

  2. when an array of length 1 is passed -> we get an array with 1 element, with key being the passed array's elements
     eg: Input: [`insuarance`], output: [`insuarance`]=>data

  3. when an array of length greater than 1 is passed -> we get an array with length greater than 1 element, with key being the 
     passed array's elements
     eg: Input: [`insuarance`, `bank`], output: {[`insuarance`]=>data, [`bank`]=>data}
  4. If we know a fixed `format` of response from curl_call and file_get_content, we could check the formats in response-values as well
 

 ## Refactoring

The refactored file is ![refactored php file](https://github.com/dev-sandeep/sudoku-challenge/blob/master/review-refactor/file-refactored.php)

###################################################################################################################

## SUDOKU TESTER

### Task

As discussed in my last discusion with @Marco, he said - I could use any language of my preference, So I've used Javascript here instead of php.
But, if you still insist to use php, I could convert the logic in to php

## Time and difficulties
It took me around `1.5` hour to solve the program, in which the maximum time was consumed in coming up with a mathematical expression which would return the coordinate of an array element, when block number[0-9] and block element number is passed[0-9]

## Thought process
* I have tried to divide the problem in to 3 parts - 1. Horizontal Check, 2. Vertical Check, 3. Block level check
* Then, tried to access all the elements with the help of nested-loops
* For Vertical and Horizontally it was easy, but accessing elements block-wise(00, 01, 02, 10, 11, 12 ....) was little tough, which I
 solved with the help of a small mathematical expression.
* Once all the data is accessible the next step was to check the conditions - no number shall be repeated horizontally, vertically and 
  in small-blocks. Now, this could be done in various ways, But, I felt using Objects(or associative_array) is the most efficient way.
* The simplest `IDEA` is to put all the values in Sudoku in an object with key being the combination of 
  `(row/column/block number[0 to 9] _  element num[0 to 9])` So in case there are some repeated or same values in row/column/block, then automatically the Object's length would be less than 9^2(81).
* The code is generic and could work for any nxn matrix


* I tried to solved the problem in O(n) time, where n = width*height of 2d array 
* The average time for executing 9x9 matrix is `1.9ms`
* The average time for executing 16x16 matrix is `2.1ms`
* execution time is logged in the code

## Solved Program
![solved program](https://github.com/dev-sandeep/sudoku-challenge/blob/master/sudoku-tester/index.js)

## How to run
> install the node server
> come to the location of `sudoku-tested` folder with cd ./.../sudoku/tested
> run  `node index.js`

you could change the `const input` at the top to check the program with other sudoku values
  

## ------------------------------------------------------------------------------------------------
