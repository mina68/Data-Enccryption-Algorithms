<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo encrypt_decrypt($_POST['string'], $_POST['key']);
}

function encrypt_decrypt($string, $key) {
    $encrypted_text = "";
    $s = array();
    $t = array();

    // first step initialization
    for($i=0; $i<256; $i++){
        $s[$i] = $i;
        $t[$i] = $key[$i%count($key)];
    }

    // second step initialization
    $j = 0;
    for($i=0; $i<256; $i++){
        $j = ($j + $s[$i] + ord($t[$i]))%256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
    }

    // key generation
    $j = 0;
    for($x=0; $x<strlen($string); $x++){

        $i = ($x+1)%256;
        $j = ($j+$s[$i])%265;

        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;

        $k = $s[($s[$i] + $s[$j])%256];
        $encrypted_char = _xor(decbin(ord($string{$x})), decbin($k));
        $encrypted_char = chr(bindec($encrypted_char));
        $encrypted_text .= $encrypted_char;
    }

    return $encrypted_text;
}

function _xor($string, $key){
    $text = '';
    for($i=strlen($string); $i<8; $i++){
        $string = '0' . $string;
    }
    for($i=strlen($key); $i<8; $i++){
        $key = '0' . $key;
    }
    for($i=0; $i<8; $i++){
        $bit = intval($string{$i}) ^ intval($key{$i});
        $text .= ($bit);
    }
    return $text;
}

?>