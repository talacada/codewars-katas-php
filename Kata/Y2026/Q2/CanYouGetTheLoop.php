<?php

declare(strict_types=1);

/*
You are given a node that is the beginning of a linked list. This list contains a dangling piece
and a loop. Your objective is to determine the length of the loop.

Use the `getNext()` method to get the following node.
node->getNext()

Notes:
- Do NOT mutate the nodes!
- In some cases there may be only a loop, with no dangling piece.

https://www.codewars.com/kata/can-you-get-the-loop
*/

namespace Kata\Y2026\Q2;

function loop_size(Node $node): int
{
    $objectList = [];
    while (true) {
        $now = $node;
        if (in_array($now, $objectList, true)) {
            return array_key_last($objectList) - array_search($now, $objectList, true) + 1;
        }
        $objectList[] = $now;
        $node = $node->getNext();
    }
}
