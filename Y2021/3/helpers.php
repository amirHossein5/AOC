<?php

function filterHasChar(int $indexOf, string $char, array $items): array
{
    $filtered = [];

    foreach ($items as $item){
        (string) $item[$indexOf] !== $char ?: $filtered[] = $item;
    }

    return $filtered;
}

