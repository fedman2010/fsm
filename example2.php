<?php

/**
 * Example 2
 *
 * This example demonstrates how to use finite state machine (FSM) to solve a simple
 * state transition problem.
 */

use Fedman2010\Fsm\FSM;

include __DIR__ . '/vendor/autoload.php';

$config = [
    'initial_state' => 'first',
    'rules' => [
        'first' => [
            [
                'next' => 'second',
                'value' => 1
            ],
            [
                'next' => 'third',
                'value' => 2
            ]
        ],
        'second' => [
            [
                'next' => 'third',
                'value' => 1
            ],
            [
                'next' => 'first',
                'value' => 2
            ]
        ],
        'third' => [
            [
                'next' => 'first',
                'value' => 1
            ],
            [
                'next' => 'second',
                'value' => 2
            ]
        ]
    ]
];

$obj = new FSM($config);

echo "Initial State: " . $obj->getCurrentState() . "\n";
$inputs = [1, 2, 1, 1, 2, 2, 1];
foreach ($inputs as $input) {
    echo "Input: $input, ";
    $obj->transition($input);
    echo "Current State: " . $obj->getCurrentState() . "\n";
}
echo "Final State: " . $obj->getCurrentState() . "\n";
