<?php

function evenNumbers($array = [])
{
    $result = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                if ($v % 2 == 0) {
                    $result[$key][$k] = $v;
                }
            }
        }
    }
    return array_map('array_values', $result);
}

$arr = [
    [1, 2, 3,],
    [4, 5, 6,],
    [7, 8, 9,],
];

echo '<pre>' . print_r(evenNumbers($arr), true) . '</pre>';
// var_dump(evenNumbers($arr));
// evenNumbers($arr);
