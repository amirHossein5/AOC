<?php

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/helpers.php';

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

    // just those coordinates that are vertically or horizontally
    if ($numbers[0] === $numbers[2] or $numbers[1] === $numbers[3]) {
        // ordering
        if ($numbers[0] < $numbers[2] or $numbers[1] < $numbers[3]) {
            $coordinates = getCoordinatesArray($numbers[0], $numbers[1], $numbers[2], $numbers[3]);
        } else {
            $coordinates = getCoordinatesArray($numbers[2], $numbers[3], $numbers[0], $numbers[1]);
        }

        /** between cordinates */
        // horizontally-> 0,9->5,9
        if ($coordinates[2]['x'] - $coordinates[1]['x'] > 0) {
            $minusResult = $coordinates[2]['x'] - $coordinates[1]['x'];

            for ($i = 0; $i <= $minusResult; $i++) {
                $allCoordinates[] = [
                    'x' => $coordinates[1]['x'] + $i,
                    'y' => $coordinates[1]['y']
                ];
            }
        } else {
            $minusResult = $coordinates[2]['y'] - $coordinates[1]['y'];

            for ($i = 0; $i <= $minusResult; $i++) {
                $allCoordinates[] = [
                    'x' => $coordinates[1]['x'],
                    'y' => $coordinates[1]['y'] + $i
                ];
            }
        }
    }
}

/** draw vanilla . diagram */
file_put_contents(__DIR__.'/diagram.txt', '');

// append horizontally
for ($i = 0; $i <= $maxNumber; $i++) {
    file_put_contents(__DIR__.'/diagram.txt', file_get_contents(__DIR__.'/diagram.txt') . '.');
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
$diagram = Read::contents(__DIR__.'/diagram.txt');

foreach ($allCoordinates as $coordinates) {
    $x = $coordinates['x'];
    $y = $coordinates['y'];

    $row = str_split(Read::getLine($diagram, line: $y));

    $row[$x] === '.'
        ? $row[$x] = 1
        : $row[$x] ++;

    $row[$x] !== 2 ?: $leastTwoLineOverlapCount ++;

    $diagram = Read::putLine($diagram, line: $y, content: implode('', $row));
}

file_put_contents(__DIR__.'/diagram.txt', $diagram);

return ($leastTwoLineOverlapCount);
