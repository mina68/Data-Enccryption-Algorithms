<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type'] == 'encrypt'){
        echo encrypt($_POST['string']);
    }
    if($_POST['type'] == 'decrypt'){
        echo decrypt($_POST['string']);
    }
}

function encrypt($string) {

    $encrypted_text = "";

    $p = 13;
    $q = 17;
    $n = $q*$p;
    $phi = ($q-1)*($p-1);
    $e = 7;
    $d = 55;

    for($x=0; $x<strlen($string); $x++){
        $c = ord($string{$x});
        $encrypted_c = bcpowmod($c, $e, $n);
        $encrypted_text.=chr($encrypted_c);
    }

    return $encrypted_text;
}

function decrypt($string) {

    $decrypted_text = "";

    $p = 13;
    $q = 17;
    $n = $q*$p;
    $phi = ($q-1)*($p-1);
    $e = 7;
    $d = 55;

    for($x=0; $x<strlen($string); $x++){
        $encrypted_c = ord($string{$x});
        $c = bcpowmod($encrypted_c, $d, $n);
        $decrypted_text.=chr($c);
    }

    return $decrypted_text;
}

?>