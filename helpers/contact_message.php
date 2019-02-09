<?php

function friendlly_string($string){
    $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą',
        'ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
    $b = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a',
        's', 'l', 'z', 'z', 'c', 'n' );

    $string = str_replace( $a, $b, $string );
    $string = preg_replace( '#[^a-z0-9]#is', ' ', $string );
    $string = trim( $string );
    $string = preg_replace( '#\s{2,}#', ' ', $string );
    $string = str_replace( ' ', '-', $string );
    return $string;
}

function writeComment($imie, $email, $phone, $message){
    $file_name = friendlly_string($email);
    $fp=null;
    if(file_exists("mails/".$file_name.".txt")){
        $fp = fopen('mails/'.$file_name.'.txt', 'a');
    }else{
        $fp = fopen('mails/'.$file_name.'.txt', 'w');
    }

    fwrite($fp, 'Dane wiadomości:'."\n");
    fwrite($fp, 'Imie: '. $imie . "\n");
    fwrite($fp, 'Adres email: '. $email . "\n");
    fwrite($fp, 'Numer telefonu: '. $phone . "\n");
    fwrite($fp, 'Treść wiadomości: '. $message . "\n"."\n");
    fclose($fp);
    return true;
}