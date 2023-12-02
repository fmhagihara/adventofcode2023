<?php
$f = fopen('02-input.txt', 'r');
$sum = 0;

// Quantidades máximas de cubos possíveis por cor
$max_red = 12;
$max_green = 13;
$max_blue = 14;

// Lê linha a linha e faz os processamentos
while (!feof($f)) {
    $line = fgets($f);

    // Separa ID do conjunto de jogos
    $sepIdSets = explode(':', $line);
    $gameId = substr(trim($sepIdSets[0]), 5);
    $gameSets = trim($sepIdSets[1]);

    // Separa os grupos de jogos
    $groups = explode(';', $gameSets);
    $possible = true;

    // Separa os itens de cada grupo
    foreach ($groups as $gr) {
        $items = explode(',', $gr);
        foreach ($items as $it) {
            $clean = trim($it);
            $sep = explode(' ', $clean);
            $qty = $sep[0];
            $color = $sep[1];
            // Se alguma quantidade excede o máximo, o conjunto inteiro não é mais válido
            if (($color == 'red' && $qty > $max_red) ||
                ($color == 'green' && $qty > $max_green) ||
                ($color == 'blue' && $qty > $max_blue)) {
                    $possible = false;
                }
        }
    }
    echo "ID:$gameId|Sets:$gameSets|Groups:".count($groups)."|Possible:" . $possible . "<br>";
    if ($possible) $sum += $gameId;
}
echo 'SumOfIDs:' . $sum;

fclose($f);
?>