<?php

/**
 * Modulo Three Example
 *
 * This example demonstrates how to use finite state machine (FSM) to solve Modulo Three Exercise.
 */

use Fedman2010\Fsm\FSM;

include __DIR__ . '/vendor/autoload.php';

// FSM configuration; could be put in separate config file and included using require('config.php')
$config = [
    'initial_state' => 'S0',
    'rules' => [
        'S0' => [
            [
                'next' => 'S1',
                'value' => '1'
            ],
            [
                'next' => 'S0',
                'value' => '0'
            ]
        ],
        'S1' => [
            [
                'next' => 'S0',
                'value' => '1'
            ],
            [
                'next' => 'S2',
                'value' => '0'
            ]
        ],
        'S2' => [
            [
                'next' => 'S2',
                'value' => '1'
            ],
            [
                'next' => 'S1',
                'value' => '0'
            ]
        ]
    ]
];

$obj = new FSM($config);

// example 1
$str = '110';
for ($i = 0; $i < strlen($str); $i++) {
    $state = $obj->transition($str[$i]);
}
echo "Final State: " . $obj->getCurrentState() . "\n";

// example 2
// function to determine mod 3 of a binary string
function modThree(string $input) {
    global $obj;
    $obj->reset();
    for ($i = 0; $i < strlen($input); $i++) {
        $obj->transition($input[$i]);
    }
    
    switch ($obj->getCurrentState()) {
        case 'S0':
            return 0;
        case 'S1':
            return 1;
        case 'S2':
            return 2;
    }
}

$str = '1101';
echo "Modulo 3 of $str: " . modThree($str) . "\n";

$str = '1110';
echo "Modulo 3 of $str: " . modThree($str) . "\n";

$str = '1111';
echo "Modulo 3 of $str: " . modThree($str) . "\n";
