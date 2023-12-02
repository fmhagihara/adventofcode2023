<?php
$f = fopen('01-input.txt', 'r');
$sum = 0;

// Lista de literais pelo nome
$literals = array(
    0 => 'zero',
    1 => 'one',
    2 => 'two',
    3 => 'three',
    4 => 'four',
    5 => 'five',
    6 => 'six',
    7 => 'seven',
    8 => 'eight',
    9 => 'nine'
);

// Lê linha a linha, fazendo os processamentos
while (!feof($f)) {
    $str = fgets($f);
    // Zera as variáveis
    $fnum = $lnum = null;
    $flit = $llit = null;
    $fnumpos = $lnumpos = null;
    $flitpos = 1000;
    $llitpos = 0;

    // Percorre caractere a caractere buscando a primeira e a última ocorrência de um número
    for ($i=0; $i < strlen($str); $i++) {
        $num_asc = ord($str[$i]);
        if ($num_asc > 47 && $num_asc < 58) {
            if (!$fnum) {
                $fnum = $str[$i];
                $fnumpos = $i;
            }
            else {
                $lnum = $str[$i];
                $lnumpos = $i;
            }
        }
        if (!$lnum) {
            $lnum = $fnum;
            $lnumpos = $fnumpos;
        }
    }

    // Em cada linha, percorre a array de números literais para saber a posição
    foreach ($literals as $key=>$value) {
        $fpos = strpos($str, $value);
        // Quando a posição não é encontrada, retorna null. A primeira posição é 0 (zero)
        if (is_numeric($fpos) && ($fpos < $flitpos)) {
            $flit = $key;
            $flitpos = $fpos;
        }
        $lpos = strrpos($str, $value);
        if (is_numeric($lpos) && ($lpos > $llitpos)) {
            $llit = $key;
            $llitpos = $lpos;
        }
    }

    // Compara as posições dos números literais com os números em si, substituindo os números se necessário
    if ($flitpos < $fnumpos) $fnum = $flit;
    if ($llitpos > $lnumpos) $lnum = $llit;

    // O PHP transforma automaticamente char em int, por isso eu realizo as contas diretamente
    $cl = $fnum*10 + $lnum;
    $sum += $cl;
    echo "$cl | $sum  | $str<br>"; // Parcial | Sum | String
}

fclose($f);

?>