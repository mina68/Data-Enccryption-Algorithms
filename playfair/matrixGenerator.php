<?php

function matrix_generator($key){

    $matrix = array();
    $key = str_replace('J', 'I', $key);
    $key = str_replace(' ', '', $key);

    for($i=0; $i<strlen($key); $i++){
        if(ord($key{$i}) >= 65 && ord($key{$i}) <= 90){
            $found = false;
            for($j=0; $j<count($matrix); $j++){
                if(in_array($key{$i}, $matrix[$j])){
                    $found = true;
                    break;
                }
            }
            if(!$found){
                $added = false;
                for($x=0; $x<5; $x++){
                    for($y=0; $y<5; $y++){
                        if(empty($matrix[$x][$y])){
                            $matrix[$x][$y] = $key{$i};
                            $added = true;
                            break;
                        }
                    }
                    if($added)
                        break;
                }
            }
        }
    }

    for($i=0; $i<5; $i++){
        for($j=0; $j<5; $j++){
            if(empty($matrix[$i][$j])){
                for($charCode=65; $charCode<=90; $charCode++){
                    if($charCode == 74)
                        continue;
                    $found = false;
                    for($x=0; $x<count($matrix); $x++){
                        if(in_array(chr($charCode), $matrix[$x])){
                            $found = true;
                            break;
                        }
                    }
                    if(!$found){
                        $matrix[$i][$j] = chr($charCode);
                        break;
                    }
                }
            }
        }
    }

    return $matrix;
}

?>