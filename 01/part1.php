<?php
$f = fopen('01-input.txt', 'r');
$sum = 0;
while (!feof($f)) {
    $str = fgets($f);
    $fnum = $lnum = null;
    for ($i=0; $i < strlen($str); $i++) {
        $num_asc = ord($str[$i]);
        if ($num_asc > 47 && $num_asc < 58) {
            if (!$fnum) $fnum = $str[$i];
            else $lnum = $str[$i];
        }
        if (!$lnum) $lnum = $fnum;
    }
    $cl = $fnum*10 + $lnum;
    $sum += $cl;
    echo $cl . ' | ' . $sum . '<br>'; // Parcial | Sum
}

fclose($f);

?>