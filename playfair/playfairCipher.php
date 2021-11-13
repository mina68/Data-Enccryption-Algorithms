<?php

require('matrixGenerator.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type'] == 'encrypt'){
        echo encrypt($_POST['string'], $_POST['key']);
    }
    if($_POST['type'] == 'decrypt'){
        echo decrypt($_POST['string'], $_POST['key']);
    }
}

function encrypt($str, $key) {

    $encrypted_text = "";

    $matrix = matrix_generator(strtoupper($key));

    $str = strtoupper($str);
    $str = str_replace('J', 'I', $str);
    $str = str_replace(' ', '', $str);
    for($i=1; $i<strlen($str); $i++){ // put X between any 2 duplicated chars
        if($str{$i} == $str{$i-1}){
            $str = substr_replace($str, 'X', $i, 0);
        }
    }

    if(strlen($str)%2 != 0) // make the string have even number of chars
        $str .= 'X';

    $couples = str_split($str, 2);

    foreach ($couples as $couple) {
        $encrypted_couple = "";
        $rows = array();
        $columns = array();
        for($i=0; $i<2; $i++){
            for($j=0; $j<5; $j++){
                if(in_array($couple{$i}, $matrix[$j])){
                    $rows[$i] = $j;
                    $columns[$i] = array_search($couple{$i}, $matrix[$j]);
                    break;
                }
            }
        }

        if($columns[0] == $columns[1]){
            $encrypted_couple = $matrix[($rows[0]+1)%5][$columns[0]] . $matrix[($rows[1]+1)%5][$columns[1]];
        }
        else if($rows[0] == $rows[1]){
            $encrypted_couple = $matrix[$rows[0]][($columns[0]+1)%5] . $matrix[$rows[1]][($columns[1]+1)%5];
        }
        else {
            $encrypted_couple = $matrix[$rows[0]][$columns[1]] . $matrix[$rows[1]][$columns[0]];;
        }

        $encrypted_text .= $encrypted_couple;
    }

    return $encrypted_text;
}

function decrypt($str, $key) {

    $decrypted_text = "";

    $matrix = matrix_generator(strtoupper($key));

    $str = strtoupper($str);
    if(strlen($str)%2 != 0)
        $str .= 'X';

    $couples = str_split($str, 2);

    foreach ($couples as $couple) {
        $decrypted_couple = "";
        $rows = array();
        $columns = array();
        for($i=0; $i<2; $i++){
            for($j=0; $j<5; $j++){
                if(in_array($couple{$i}, $matrix[$j])){
                    $rows[$i] = $j;
                    $columns[$i] = array_search($couple{$i}, $matrix[$j]);
                    break;
                }
            }
        }

        if($columns[0] == $columns[1]){
            $decrypted_couple = $matrix[($rows[0]-1)<0?($rows[0]+4):($rows[0]-1)][$columns[0]] 
            . $matrix[($rows[1]-1)<0?($rows[1]+4):($rows[1]-1)][$columns[1]];
        }
        else if($rows[0] == $rows[1]){
            $decrypted_couple = $matrix[$rows[0]][($columns[0]-1)<0?($columns[0]+4):($columns[0]-1)] 
            . $matrix[$rows[1]][($columns[1]-1)<0?($columns[1]+4):($columns[1]-1)];
        }
        else {
            $decrypted_couple = $matrix[$rows[0]][$columns[1]] . $matrix[$rows[1]][$columns[0]];;
        }

        $decrypted_text .= $decrypted_couple;
    }

    return $decrypted_text;
}

?>