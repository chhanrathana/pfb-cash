<?php

function roundCurrency($amount){
    $last = substr($amount,-2);
    $remove = substr($amount, 0, -2);
    if($last != '00'){
        $amount = $remove + 1;
        $amount = (string) $amount."00";
    }

    echo $amount;
}
