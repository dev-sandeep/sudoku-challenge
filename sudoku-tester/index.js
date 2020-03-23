//change input to check with other values
// const input = [
//     [1, 8, 2, 5, 4, 3, 6, 9, 7, 2, 5, 4, 3, 6, 9, 7],
//     [9, 6, 5, 1, 7, 8, 3, 4, 2, 5, 1, 7, 8, 3, 4, 2],
//     [7, 4, 3, 9, 6, 2, 8, 1, 5, 3, 9, 6, 2, 8, 1, 5],
//     [7, 4, 3, 9, 6, 2, 8, 1, 5, 3, 9, 6, 2, 8, 1, 5],
//     [3, 7, 4, 8, 9, 6, 5, 2, 1, 4, 8, 9, 6, 5, 2, 1],
//     [3, 7, 4, 8, 9, 6, 5, 2, 1, 4, 8, 9, 6, 5, 2, 1],
//     [6, 2, 8, 4, 5, 1, 7, 3, 9, 8, 4, 5, 1, 7, 3, 9],
//     [6, 2, 8, 4, 5, 1, 7, 3, 9, 8, 4, 5, 1, 7, 3, 9],
//     [5, 1, 9, 2, 3, 7, 4, 6, 8, 9, 2, 3, 7, 4, 6, 8],
//     [5, 1, 9, 2, 3, 7, 4, 6, 8, 9, 2, 3, 7, 4, 6, 8],
//     [2, 9, 7, 6, 8, 4, 1, 5, 3, 7, 6, 8, 4, 1, 5, 3],
//     [2, 9, 7, 6, 8, 4, 1, 5, 3, 7, 6, 8, 4, 1, 5, 3],
//     [4, 3, 1, 7, 2, 5, 9, 8, 6, 1, 7, 2, 5, 9, 8, 6],
//     [4, 3, 1, 7, 2, 5, 9, 8, 6, 1, 7, 2, 5, 9, 8, 6],
//     [8, 5, 6, 3, 1, 9, 2, 7, 4, 6, 3, 1, 9, 2, 7, 4],
//     [8, 5, 6, 3, 1, 9, 2, 7, 4, 6, 3, 1, 9, 2, 7, 4],
// ];
const inputData = [
    [1, 8, 2, 5, 4, 3, 6, 9, 7],
    [9, 6, 5, 1, 7, 8, 3, 4, 2],
    [7, 4, 3, 9, 6, 2, 8, 1, 5],
    [3, 7, 4, 8, 9, 6, 5, 2, 1],
    [6, 2, 8, 4, 5, 1, 7, 3, 9],
    [5, 1, 9, 2, 3, 7, 4, 6, 8],
    [2, 9, 7, 6, 8, 4, 1, 5, 3],
    [4, 3, 1, 7, 2, 5, 9, 8, 6],
    [8, 5, 6, 3, 1, 9, 2, 7, 4],
];

const main = (data) => {
    console.time("execution-time");

    if (horizontalCheck(data) && VerticalCheck(data) && blockCheck(data)) {
        console.log("PERFECT SUDOKU");
        console.timeEnd("execution-time");
        return true;
    }
    console.log("NAAH, TRY AGAIN!");
    console.timeEnd("execution-time");
    return false;
}

const horizontalCheck = (input) => {
    var arr = {};
    for (var i = 0; i < input.length; i++) {
        for (j = 0; j < input[i].length; j++) {


            /**
             * Creating an object from the values of sudoku, 
             * the object would have a unique key(combination of rowNumber _ value) 
             * the object arr would be like {'0_0':true, '0_1':true ...}
             * 
             * if there is some missing values or repeated values then the object won't have all
             * the elements from 0,0 to 8,8
             * 
             */
            arr[i + '_' + input[i][j]] = true;
        }
    }

    return checker(arr, input);
}

const VerticalCheck = (input) => {
    var arr = {};
    for (var i = 0; i < input.length; i++) {
        for (j = 0; j < input[i].length; j++) {

            arr[i + '_' + input[j][i]] = true;
        }
    }

    return checker(arr, input);
}

const blockCheck = (input) => {
    var arr = {};
    for (var i = 0; i < input.length; i++) {//traversing the block
        for (j = 0; j < input.length; j++) {//traversing the elements in the block

            //simple mathematical formula to get the coordinates based on the block number[0-8] and block element number [0-8] 
            var x = 3 * Math.floor(i / 3) + Math.floor(j / 3);
            var y = 3 * (i % 3) + (j % 3);

            arr[i + '_' + input[x][y]] = true;
        }
    }

    return checker(arr, input);
}

const checker = (arr, input) => {
    //simply checking if the length of the object is 9
    if (Object.keys(arr).length == Math.pow(input.length, 2))
        return true;

    return false;
}

main(inputData);

