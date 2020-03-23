<?php

class Main
{
    private $main_array = [];
    function __construct($input)
    {
        $this->main_array = $input;
    }

    public function checker()
    {
        if ($this->horizontalCheck() && $this->verticalCheck() && $this->blockCheck()) {
            return "PERFECT SUDOKU";
        } else {
            return "NAAH, TRY AGAIN!";
        }
    }

    private function horizontalCheck()
    {
        $arr = array();
        for ($i = 0; $i < count($this->main_array); $i++) {
            for ($j = 0; $j < count($this->main_array[$i]); $j++) {
                /**
                 * Creating an object from the values of sudoku, 
                 * the object would have a unique key(combination of rowNumber _ value) 
                 * the object arr would be like {'0_0':true, '0_1':true ...}
                 * 
                 * if there is some missing values or repeated values then the object won't have all
                 * the elements from 0,0 to 8,8
                 * 
                 */
                $arr[$i . '_' . $this->main_array[$i][$j]] = true;
            }
        }

        return $this->result_arr_checker($arr);
    }

    private function verticalCheck()
    {
        $arr = array();
        for ($i = 0; $i < count($this->main_array); $i++) {
            for ($j = 0; $j < count($this->main_array[$i]); $j++) {
                $arr[$i . '_' . $this->main_array[$j][$i]] = true;
            }
        }

        return $this->result_arr_checker($arr);
    }

    private function blockCheck()
    {
        for ($i = 0; $i < count($this->main_array); $i++) {
            for ($j = 0; $j < count($this->main_array); $j++) {
                //simple mathematical formula to get the coordinates based on the block number[0-8] and block element number [0-8] 
                $x = 3 * floor($i / 3) + floor($j / 3);
                $y = 3 * ($i % 3) + ($j % 3);

                $arr[$i . '_' . $this->main_array[$x][$y]] = true;
            }
        }
        return $this->result_arr_checker($arr);
    }

    private function result_arr_checker($arr)
    {
        if (count($arr) == pow(count($this->main_array), 2)) {
            return true;
        } else {
            return false;
        }
    }
}


$input = array(
    [1, 8, 2, 5, 4, 3, 6, 9, 7],
    [9, 6, 5, 1, 7, 8, 3, 4, 2],
    [7, 4, 3, 9, 6, 2, 8, 1, 5],
    [3, 7, 4, 8, 9, 6, 5, 2, 1],
    [6, 2, 8, 4, 5, 1, 7, 3, 9],
    [5, 1, 9, 2, 3, 7, 4, 6, 8],
    [2, 9, 7, 6, 8, 4, 1, 5, 3],
    [4, 3, 1, 7, 2, 5, 9, 8, 6],
    [8, 5, 6, 3, 1, 9, 2, 7, 4],
);

$main = new Main($input);
var_dump($main->checker());
