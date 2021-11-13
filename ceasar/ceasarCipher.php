<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type'] == 'encrypt'){
        echo encrypt($_POST['string'], $_POST['offset']);
    }
    if($_POST['type'] == 'decrypt'){
        echo decrypt($_POST['string'], $_POST['offset']);
    }
}

function encrypt($str, $offset) {
    $encrypted_text = "";
    $offset = $offset % 26; // make sure the number is less than 26
    if($offset < 0) { // make sure the number is positive
        $offset += 26;
    }
    $i = 0;
    while($i < strlen($str)) {
        $c = $str{$i}; 
        if(($c >= "A") && ($c <= 'Z') || ($c >= "a") && ($c <= 'z')) {
            if((ord($c) + $offset) > ord("z") || ((ord($c) + $offset) > ord("Z") && (ord($c) + $offset) < ord("a"))) {
                $encrypted_text .= chr(ord($c) + $offset - 26);
            } 
            else {
                $encrypted_text .= chr(ord($c) + $offset);
            }
        } else {
            $encrypted_text .= " ";
        }
        $i++;
    }
    return $encrypted_text;
}

function decrypt($str, $offset) {
    $decrypted_text = "";
    $offset = $offset % 26;
    if($offset < 0) {
        $offset += 26;
    }
    $i = 0;
    while($i < strlen($str)) {
        $c = $str{$i}; 
        if(($c >= "A") && ($c <= 'Z') || ($c >= "a") && ($c <= 'z')) {
            if((ord($c) - $offset) < ord("A") || ((ord($c) - $offset) < ord("a") && (ord($c) - $offset) > ord("Z"))) {
                $decrypted_text .= chr(ord($c) - $offset + 26);
            } 
            else {
            $decrypted_text .= chr(ord($c) - $offset);
            }
        } else {
              $decrypted_text .= " ";
        }
        $i++;
    }
    return $decrypted_text;
}

?>