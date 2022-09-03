<?php

require __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/helpers.php';

use Classes\Read;

$puzzle = Read::lineByline(__DIR__.'/puzzle.txt');

$allCoordinates = [];
$maxNumber = 0;

foreach ($puzzle as $coordinates) {
    preg_match('/^(\d+),(\d+) -> (\d+),(\d+)$/', $coordinates, $numbers);
    array_splice($numbers, 0, 1);

    foreach ($numbers as $number) {
        $maxNumber > $number ?: $maxNumber = $number;
    }

    // ordering
    $orderedNumbers = $numbers;
    if ($numbers[1] > $numbers[3]) {
        $orderedNumbers = [
            $numbers[2],
            $numbers[3],
            $numbers[0],
            $numbers[1],
        ];
    }
    // on 45 dgree
    if($orderedNumbers[1] + abs($orderedNumbers[2] - $orderedNumbers[0]) === (int) $orderedNumbers[3]) {
        $coordinates = getCoordinatesArray($orderedNumbers[0], $orderedNumbers[1], $orderedNumbers[2], $orderedNumbers[3]);

        $allCoordinates[] = [
            'x' => $coordinates[1]['x'],
            'y' => $coordinates[1]['y'],
        ];
        $allCoordinates[] =[
            'x' => $coordinates[2]['x'],
            'y' => $coordinates[2]['y'],
        ];

        for ($i=1; $i < abs($coordinates[2]['x']-$coordinates[1]['x']); $i++) {
            $allCoordinates[] = [
                'x' => $coordinates[1]['x'] > $coordinates[2]['x']
                    ? $coordinates[1]['x'] - $i
                    : $coordinates[1]['x'] + $i,
                'y' => $coordinates[1]['y'] > $coordinates[2]['y']
                    ? $coordinates[1]['y'] - $i
                    : $coordinates[1]['y'] + $i,
            ];
        }
    }

    // vertically or horizontally coordinates
    if ($numbers[0] === $numbers[2] or $numbers[1] === $numbers[3]) {
        $orderedNumbers = $numbers;
        if ($numbers[0] > $numbers[2]) {
            $orderedNumbers = [
                $numbers[2],
                $numbers[3],
                $numbers[0],
                $numbers[1],
            ];
        }

        $coordinates = getCoordinatesArray($orderedNumbers[0], $orderedNumbers[1], $orderedNumbers[2], $orderedNumbers[3]);

        $allCoordinates[] = [
            'x' => $coordinates[1]['x'],
            'y' => $coordinates[1]['y'],
        ];
        $allCoordinates[] =[
            'x' => $coordinates[2]['x'],
            'y' => $coordinates[2]['y'],
        ];

        // horizontally-> 0,9->5,9
        if ($coordinates[2]['x'] - $coordinates[1]['x'] > 0 and $coordinates[2]['y'] === $coordinates[1]['y']) {
            for ($i=1; $i < abs($coordinates[2]['x']-$coordinates[1]['x']); $i++) {
                $allCoordinates[] = [
                    'x' => $coordinates[1]['x'] + $i,
                    'y' => $coordinates[1]['y'],
                ];
            }
        } else {
            // vertically
            if ($numbers[1] > $numbers[3]){
                $orderedNumbers = [
                    $numbers[2],
                    $numbers[3],
                    $numbers[0],
                    $numbers[1],
                ];
            }

            $coordinates = getCoordinatesArray($orderedNumbers[0], $orderedNumbers[1], $orderedNumbers[2], $orderedNumbers[3]);

            for ($i=1; $i < abs($coordinates[2]['y']-$coordinates[1]['y']); $i++) {
                $allCoordinates[] = [
                    'x' => $coordinates[1]['x'],
                    'y' => $coordinates[1]['y'] + $i,
                ];
            }
        }
    }
}

/* draw vanilla diagram */
file_put_contents(__DIR__.'/diagram.txt', '');

// append horizontally
for ($i = 0; $i <= $maxNumber; $i++) {
    file_put_contents(__DIR__.'/diagram.txt', file_get_contents(__DIR__.'/diagram.txt').'.');
}
// append vertically
$appendLine = explode(PHP_EOL, file_get_contents(__DIR__.'/diagram.txt'))[0];

for ($i = 0; $i < $maxNumber; $i++) {
    $diagramFile = fopen(__DIR__.'/diagram.txt', 'a');
    fwrite($diagramFile, PHP_EOL.$appendLine);
    fclose($diagramFile);
}

/** draw numbers */
$leastTwoLineOverlapCount = 0;
$diagram = Read::lineByline(__DIR__.'/diagram.txt');

foreach ($allCoordinates as $coordinates) {
    $x = $coordinates['x'];
    $y = $coordinates['y'];

    $row = str_split($diagram[$y]);

    '.' === $row[$x]
        ? $row[$x] = 1
        : $row[$x]++;

    2 !== $row[$x] ?: $leastTwoLineOverlapCount++;

    $diagram[$y] = implode('', $row);
}


if (env() !== 'testing') {
    file_put_contents(__DIR__.'/diagram.txt', $diagram);

    var_dump($leastTwoLineOverlapCount);
}
return $leastTwoLineOverlapCount;
