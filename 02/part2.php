<?php
$f = fopen('02-input.txt', 'r');
$sum = 0;

// Lê linha a linha e faz os processamentos
while (!feof($f)) {
    $line = fgets($f);

    $red = $blue = $green = $power = 0;

    // Separa ID dos conjuntos de jogos
    $sepIdSets = explode(':', $line);
    $gameId = substr(trim($sepIdSets[0]), 5);
    $gameSets = trim($sepIdSets[1]);

    // Separa os grupos de jogos
    $groups = explode(';', $gameSets);

    // Separa os itens de cada grupo
    foreach ($groups as $gr) {
        $items = explode(',', $gr);
        foreach ($items as $it) {
            $clean = trim($it);
            $sep = explode(' ', $clean);
            $qty = $sep[0];
            $color = $sep[1];

            // Pega a maior quantidade de cada cor
            if ($color == 'red' && $qty > $red) $red = $qty;
            elseif ($color == 'blue' && $qty > $blue) $blue = $qty;
            elseif ($color == 'green' && $qty > $green) $green = $qty;

            // Calcula as multiplicação
            $power = $red * $blue * $green;
        }
    }
    echo "ID:$gameId|Sets:$gameSets|Red:$red|Blue:$blue|Green:$green|Power:" . $power . "<br>";
    $sum += $power;
}
echo 'SumOfPowers:' . $sum;

fclose($f);
?>