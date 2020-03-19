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
![solved program](index.js)

## How to run
> install the node server
> come to the location of `sudoku-tested` folder with cd ./.../sudoku/tested
> run  `node index.js`

you could change the `const input` at the top to check the program with other sudoku values
  

## ------------------------------------------------------------------------------------------------
